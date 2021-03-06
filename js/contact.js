//If JavaScript is active, remove the labels.
$("label").addClass('hide-label');

//Turn off regex pattern validation as this will now be handled by JavaScript.
$("#contact-form form").attr("novalidate", "");

//Regex patterns
const test = ["^[a-zA-Z0-9-]{2,16}$", "^[a-zA-Z0-9-]{2,16}$", "^[a-z0-9!#$%&'*+\/=?^_`\"{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9\[](?:[a-z0-9-]*[a-z0-9])?(?:\.){0,1})+[a-z]{2}(?:[a-z0-9-]*[a-z0-9])?$", "[A-Za-z0-9\W]{4,80}", "^[A-Za-z0-9\W]+"];

//Regex test function
const regexTest = (value, testRegex) => {
    let regex = new RegExp (testRegex);
    return regex.test(value);
}

let successCount = 0;
//Event handler for clicking submit button
$("#contact-form button").on("click", (e) => {
    //Prevent form from reloading the page.
    //e.preventDefault();

    //Count for valid form fields
    let valid = 0;

    // For each input field...
    $("#contact-form input").each((i, element) => {
        //...get the value
        let val = $(element).val();
        
        // Run the regex test
        if (!regexTest(val, test[i])){
            //If test fails, show the label and add a border to the element.
            $("label").eq(i).removeClass('hide-label').css("color", "red");
            $(element).css("border", "2px solid red").css("color", "red");
        } else {
            // If test passes, hide the label.
            $("label").eq(i).addClass('hide-label');
            valid++;
        }

        //Remove the element styling above once user edits the input so that the stylesheet handles valid/invalid styling again.
        $(element).on('input', () => {
            $(element).attr("style", "none");
        });
    });
    // For the textarea field...
    $("#contact-form textarea").each((i, element) => {
        //...get the value
        let val = $(element).val()
        
        // Run the regex test for message textarea.
        if (!regexTest(val, test[4])){
            //If test fails, show the label and add a border to the element.
            $("label").eq(4).removeClass('hide-label').css("color", "red");
            $(element).css("border", "2px solid red").css("color", "red");
        } else {
            // If test passes, hide the label.
            $("label").eq(4).addClass('hide-label');
            valid++;
        }

        //Remove the element styling above once user edits the input so that the stylesheet handles valid/invalid styling again.
        $(element).on('input', () => {
            $(element).attr("style", "none");
        });
    });
    //If all inputs are valid..
    if (valid === 5) {
        console.log("All imputs valid. Process form.");
        //let form submit so the php can run on reload.
    } else {
        // prevent reload and let the js above handle the errors.
        e.preventDefault();
    }
});
//if success message is displaying, hide it when user starts filling out the form again.
$("#contact-form").on("input", () => {
    $(".contact-message").hide();
});