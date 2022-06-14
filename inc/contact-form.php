<?php 
$firstName = $lastName = $email = $subject = $message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $errors = [];
    

    //Check if contact-form was the form that was submitted and all fields were set.
    if (isset($_POST['submit'])){
        if(!isset($_POST['first_name']) || $_POST['first_name'] == ""){
            $errors['first_name'] = "The first name field is required.";
        }
        if(!isset($_POST['last_name']) || $_POST['last_name'] == ""){
            $errors['last_name'] = "The last name field is required.";
        }
        if(!isset($_POST['email']) || $_POST['email'] == ""){
            $errors['email'] = "The email field is required.";
        }
        if(!isset($_POST['subject']) || $_POST['subject'] == ""){
            $errors['subject'] = "The subject field is required.";
        }
        if(!isset($_POST['message']) || $_POST['message'] == ""){
            $errors['message'] = "The message field is required.";
        }
        //filter the inputs and validate with regex.
        $firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $lastName = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    
        //Regex Validation
        if(!preg_match("/^[a-zA-Z- ]{2,35}$/", $firstName) && !isset($errors['first_name'])){
            $errors[] = "First name does meet required format.";
        }

        if(!preg_match("/^[a-zA-Z- ]{2,35}$/", $lastName) && !isset($errors['last_name'])){
            $errors[] = "Last name does meet required format.";
        }

        if(!preg_match("/[a-z0-9!#$%&'*+\/=?^_`\"{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9]{2}(?:[a-z0-9-]*[a-z0-9])?/", $email) && !isset($errors['email'])){
            $errors[] = "Email does meet required format.";
        }
        
        if(!preg_match("/[A-Za-z0-9\W]{4,100}/", $subject) && !isset($errors['subject'])){
            $errors[] = "Subject does meet required format.";
        }
        
        if(!preg_match("/^[A-Za-z0-9\W]+/", $message) && !isset($errors['message'])){
            $errors[] = "Message does meet required format.";
        }
            
        if(empty($errors)){
            //Add to database
            include 'connection.php';
            $query = "INSERT INTO contact (`first_name`, `last_name`, `email`, `subject`, `message`) VALUES (?, ?, ?, ?, ?)"; 
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $subject, PDO::PARAM_STR);
            $stmt->bindParam(5, $message, PDO::PARAM_STR);

            $result = $stmt->execute();

            if ($db->lastInsertId() == 0){
                $errors[] = "There was an error sending your messages. Please try again.";
            } else {
                $success = "Your message has been sent.";
                $firstName = $lastName = $email = $subject = $message = "";
            }
        }
    }

}
?>