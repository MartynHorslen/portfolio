<?php 
require_once('templates/head.php');
require_once('templates/header.php');
?>
<section class="hero" id="small-hero">
    <figure>
        <img src="img/pexels-stanislav-kondratiev-10816120.jpg" alt="Background of programming code."/>
        <figcaption>
            <h1>Code Examples</h1>
        </figcaption>
    </figure>
</section>
<section id="examples">
<div class="code-example">
        
        <h3>Vue SPA Reflection</h3>
        <p>For my view reflection, I created a single page application (SPA) that used third party football data and displayed it to the user.</p>
        <p>Some key features used in my reflection were Vue-Router and localStorage which assisted in creating a fast app that doesn't need to reload from the server and limits the number of requests made to third party APIs.</p>

        <pre><code class="language-javascript">import { requestData } from '../api.js';

export default {  
    data() {
        return {
        loading: true,
        errors: false,
        newsData: []
        }
    },

    methods: {
        async getNewsData() {
        this.loading = true;
        let url = 'https://football98.p.rapidapi.com/premierleague/news';
        let headers = {
            'X-RapidAPI-Key': '1444ece9f5msh125fb1f7cc0f8c5p1d2f3bjsn40e719f58738',
            'X-RapidAPI-Host': 'football98.p.rapidapi.com'
        };
        let response = await requestData(url, headers);
        if (response.data) {
            this.newsData = response.data;
            localStorage.newsData = JSON.stringify(response.data);
            this.loading = false;
        }    
        }
    },

    mounted () {
        if (localStorage.newsData) {
        this.newsData = JSON.parse(localStorage.newsData);
        this.loading = false;
        } else {
        this.getNewsData();
        }
    }
}</code></pre>
    </div>
<div class="code-example">
        <h3>Laravel Reflection</h3>
        <p>This project was to build an admin dashboard that would allow a hypothetical company to create, read, update and delete (CRUD functionality) records for client companies and their employees.
        <p>The Laravel app itself should have: basic authorisation, make use of database seeders and migrations, use Laravel storage with public access to logos and use the 7 RESTful actions.</p>
        <p>The code example below shows the form validation and file storage for creating a company. For more Laravel code examples from this project, please review my <a href="https://github.com/MartynHorslen/laravel-dashboard" target="_blank">Laravel repository</a>.</p>
        <pre><code class="language-php">public function store()
{
    $attributes = request()->validate([
        'name' => ['required', Rule::unique('companies', 'name'), 'min:2', 'max:255'],
        'logo' => 'required|image|dimensions:min_width=100,min_height=100',
        'website' => ['max:255', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
        'email' => ['required', Rule::('companies', 'email'), 'email', 'min:2', 'max:255'],
    ]);

    if(isset($attributes['logo'])){
        $attributes['logo'] = '/storage/' . request()->file('logo')->store('logo');
    }

    $created = Company::create($attributes);

    if($created){
        session()->flash('success', 'Company Created!');
        return redirect('/companies');
    } else {
        session()->flash('success', 'Company could not be created!',/ );
        return redirect('/companies/create');
    }
}</code></pre>
    </div>


    <div class="code-example">
        <h3>SQL Challenge</h3>
        <p>The objective for this challenge was to create a query with formatted outputs that includes a subquery and that is sorted by a value.</p>
        <p>I opted to use a <a href="https://www.w3resource.com/sql-exercises/movie-database-exercise/subqueries-exercises-on-movie-database.php" target="_blank">movie database</a> and, after working through a couple of practice examples, naturally got curious to see what the first movie in the database was to cast a female actress. This made for a good query for the challenge.</p>
        <p>The database structure is as follows:</p>
        <div class="img">
            <img src="img/movie-database.png" alt="Relational structure for a movie database"/>
        </div>
        <p>There are only 3 relavent tables needed for a query like mine; 'movies', 'movie_cast' and 'actor'.</p>
        <p>My query was as follows:</p>
        <pre><code class="language-sql">SELECT
        mov_title AS "Movie_Title",
        mov_year AS "Year_Released",
        actor.act_fname || ' ' || actor.act_lname AS "Name",
        actor.act_gender AS "Gender"
    FROM movie
    INNER JOIN movie_cast
    ON movie.mov_id = movie_cast.mov_id
    INNER JOIN actor
    ON movie_cast.act_id = actor.act_id
    WHERE movie.mov_id
    IN (
        SELECT movie_cast.mov_id
        FROM movie_cast
        INNER JOIN actor
        ON movie_cast.act_id = actor.act_id
        WHERE act_gender = 'F'
    )
    ORDER BY mov_year
    LIMIT 1</code></pre>
        
        <p>As you can see from the code example above, I selected the columns that I was interested in from the 3 tables, joined them together and created appropriate aliases for each. I then filtered this by the movie id's that were returned from the subquery. The subquery filters for all the female actresses in the 'actor' table and returns the movie id's, stored in the 'movie_cast' table, that they were cast for.</p>
        
        <p>Finally I ordered the results set by the movie year column, which by default is set to ascending, and returned the top result - giving me the first movie in the database to cast a female actress. The result was as follows:</p>
        
        <div class="table">                    
            <table>
                <thead>
                    <th>Movie Title</th>
                    <th>Year Released</th>
                    <th>Name</th>
                    <th>Gender</th>
                </thead>
                <tbody>
                    <td>The Innocents</td>
                    <td>1961</td>
                    <td>Deborah Kerr</td>
                    <td>F</td>
                </tbody>
            </table>
        </div>
    </div>
    <div class="code-example">
        <h3>PHP Reflection</h3>
        <p>For part of my Scion Coalition Scheme training, I was tasked with converting both my Netmatters reflection and my portfolio to PHP. This was to include contact forms and sections of content that interact with a database - such as the Netmatters news section.</p>
        <p>Below is a code snippet that demonstrates the server-side filtering, validation and storage of user input from the Netmatters contact form.</p>
        <p class="italics">To save space, some repetitive code has been omitted.</p>

        <pre><code class="language-php">//Check if there is POST data that has been submitted.
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //Set empty errors array.
    $errors = [];

    //Check if contact-form was the form that was submitted
    if (isset($_POST['contact-btn'])){

        //Check all input fields were posted and not empty strings.
        if(!isset($_POST['full_name']) || $_POST['full_name'] == ""){
            //If empty/not set, add error to the array.
            $errors['name'] = "The name field is required.";
        }
        /*** Repeat for email, telephone, subject and message. ***/

        //Filter inputs.
        $name = trim(filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $telephone = trim(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        /*** Repeat for subject and message. ***/

        //Regex Validation
        //If input doesn't pass regex test and there isn't already an error for this field...
        if(!preg_match("/[a-z0-9!#$%&'*+\/=?^_`\"{|}~-]+(?:\.[a-z0-9!#$%&'*+\
        /=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9]{2}(?:[
        a-z0-9-]*[a-z0-9])?/", $email) && !isset($errors['email'])){
        $errors[] = "Email does meet required format.";
        }
        /*** Repeat for full_name, telephone, subject and message using relavent regex. ***/

        //If no errors
        if(empty($errors)){
            //Add to database
            include 'connection.php';
            $query = "INSERT INTO contact (`name`, `email`, telephone, `subject`, `message`, marketing) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $telephone, PDO::PARAM_STR);
            $stmt->bindParam(4, $subject, PDO::PARAM_STR);
            $stmt->bindParam(5, $message, PDO::PARAM_STR);
            $stmt->bindParam(6, $marketing, PDO::PARAM_INT);

            $result = $stmt->execute();

            //If query doesn't get successfully executed
            if ($db->lastInsertId() == 0){
            //Add to errors array
            $errors[] = "There was an error sending your messages. Please try again.";
            } else {
            //Add a success message
            $success = "Your message has been sent.";
            //Clear field variables so that form empties user's input.
            $name = $email = $telephone = $subject = $message = "";
            $marketing = 0;
            }
        }
    }
}</code></pre>
    </div>

    
</section>
        
        
<footer>
    <a href="#">
        <!-- Up arrow icon -->
        <i class="fa-solid fa-chevron-up"></i>
        <h3>Back To Top</h3>  
    </a> 
</footer>
<?php require_once('templates/footer.php'); ?>