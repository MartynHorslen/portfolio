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
        <h3>SQL Challenge</h3>
        <p>The objective for this challenge was to create a query with formatted outputs that includes a subquery and that is sorted by a value.</p>
        <p>I opted to use a <a href="https://www.w3resource.com/sql-exercises/movie-database-exercise/subqueries-exercises-on-movie-database.php" target="_blank">movie database</a> and, after working through a couple of practice examples, naturally got curious to see what the first movie in the database was to cast a female actress. This made for a good query for the challenge.</p>
        <p>The database structure is as follows:</p>
        <div class="img">
            <img src="img/movie-database.png" alt="Relational structure for a movie database"/>
        </div>
        <p>There are only 3 relavent tables needed for a query like mine; 'movies', 'movie_cast' and 'actor'.</p>
        <p>My query was as follows:</p>
        <div class="code-block">
            <span class="keyword">SELECT</span><br />
                <span class="indented">mov_title <span class="keyword">AS</span> </span><span class="text">"Movie_Title"</span>,<br /> 
                <span class="indented">mov_year <span class="keyword">AS</span> <span class="text">"Year_Released"</span>,</span> <br />
                <span class="indented">actor.act_fname || <span class="text">' '</span> || actor.act_lname <span class="keyword">AS</span> <span class="text">"Name"</span>,</span> <br />
                    <span class="indented">actor.act_gender <span class="keyword">AS</span> <span class="text">"Gender"</span></span><br />
            <span class="keyword">FROM</span> movie <br />
            <span class="keyword">INNER JOIN</span> movie_cast<br />
            <span class="keyword">ON</span> movie.mov_id = movie_cast.mov_id<br />
            <span class="keyword">INNER JOIN</span> actor<br />
            <span class="keyword">ON</span> movie_cast.act_id = actor.act_id<br />
            <span class="keyword">WHERE</span> movie.mov_id <br />
            <span class="keyword">IN</span> <span class="bracket">(</span> <br />
                <span class="indented"><span class="keyword">SELECT</span> movie_cast.mov_id</span> <br />
                <span class="indented"><span class="keyword">FROM</span> movie_cast</span> <br />
                <span class="indented"><span class="keyword">INNER JOIN</span> actor</span><br />
                <span class="indented"><span class="keyword">ON</span> movie_cast.act_id = actor.act_id</span><br />
                <span class="indented"><span class="keyword">WHERE</span> act_gender = <span class="text">'F'</span></span> <br />
            <span class="bracket">)</span><br />
            <span class="keyword">ORDER BY</span> mov_year<br />
            <span class="keyword">LIMIT</span> 1<br />
        </div>
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

        <div class="code-block">
            <span class="keyword">&lt;?php</span><br />
            <span class="comment">//Check if there is POST data that has been submitted.</span><br />
            <span class="php">if</span><span class="bracket">(</span><span class="var">$_SERVER</span><span class="bracket">[</span><span class="text">'REQUEST_METHOD'</span><span class="bracket">]</span> == <span class="text">'POST'</span><span class="bracket">)</span><br />
            <span class="bracket">{</span><br />
                <span class="indented"></span><span class="comment">//Set empty errors array.</span><br />
                <span class="indented"></span><span class="var">$errors</span> = <span class="bracket">[]</span>;<br />
                <br />
                <span class="indented"></span><span class="comment">//Check if contact-form was the form that was submitted</span><br />
                <span class="indented"></span><span class="php">if</span> <span class="bracket">(</span><span class="func">isset</span><span class="bracket">(</span><span class="var">$_POST</span><span class="bracket">[</span><span class="text">'contact-btn'</span><span class="bracket">]</span><span class="bracket">)</span><span class="bracket">)</span><span class="bracket">{</span><br /><br />
                    <span class="indented-2"></span><span class="comment">//Check all input fields were posted and not empty strings.</span><br />
                    <span class="indented-2"></span><span class="php">if</span><span class="bracket">(</span><span class="func">!isset</span><span class="bracket">(</span><span class="var">$_POST</span><span class="bracket">[</span><span class="text">'full_name'</span><span class="bracket">]</span><span class="bracket">)</span> || <span class="var">$_POST</span><span class="bracket">[</span><span class="text">'full_name'</span><span class="bracket">]</span> == ""<span class="bracket">)</span><span class="bracket">{</span><br /><br />
                        <span class="indented-3"></span><span class="comment">//If empty/not set, add error to the array.</span><br />
                        <span class="indented-3"></span><span class="var">$errors</span><span class="bracket">[</span><span class="text">'name'</span><span class="bracket">]</span> = <span class="text">"The name field is required."</span>;<br />
                        <span class="indented-2"></span><span class="bracket">}</span><br />
                        <span class="indented-2"></span><span class="comment">/*** Repeat for email, telephone, subject and message. ***/</span><br /><br /><br />
                        <span class="indented-2"></span><span class="comment">//Filter inputs.</span><br />
                        <span class="indented-2"></span><span class="var">$name</span> = <span class="func">trim</span><span class="bracket">(</span><span class="func">filter_input</span><span class="bracket">(</span>INPUT_POST, <span class="text">'full_name'</span>, FILTER_SANITIZE_FULL_SPECIAL_CHARS<span class="bracket">)</span><span class="bracket">)</span>;<br />
                        <span class="indented-2"></span><span class="var">$email</span> = <span class="func">trim</span><span class="bracket">(</span><span class="func">filter_input</span><span class="bracket">(</span>INPUT_POST, <span class="text">'email'</span>, FILTER_SANITIZE_EMAIL<span class="bracket">)</span><span class="bracket">)</span>;<br />
                        <span class="indented-2"></span><span class="var">$telephone</span> = <span class="func">trim</span><span class="bracket">(</span><span class="func">filter_input</span><span class="bracket">(</span>INPUT_POST, <span class="text">'telephone'</span>, FILTER_SANITIZE_FULL_SPECIAL_CHARS<span class="bracket">)</span><span class="bracket">)</span>;<br />
                        <span class="indented-2"></span><span class="comment">/*** Repeat for subject and message. ***/</span><br /><br /><br />
                        <span class="indented-2"></span><span class="comment">//Regex Validation<br />
                        <span class="indented-2"></span>//If input doesn't pass regex test and there isn't already an error for this field...</span><br />
                        <span class="indented-2"></span><span class="php">if</span><span class="bracket">(</span><span class="func">!preg_match</span><span class="bracket">(</span><span class="text">"</span></span><span class="regex">/[a-z0-9!#$%&'*+\/=?^_`\"{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9]{2}(?:[a-z0-9-]*[a-z0-9])?/</span><span class="text">"</span>, <span class="var"> $email</span><span class="bracket">)</span> && <span class="func">!isset</span><span class="bracket">(</span><span class="var">$errors</span><span class="bracket">[</span><span class="text">'email'</span><span class="bracket">]</span><span class="bracket">)</span><span class="bracket">)</span><span class="bracket">{</span><br />
                            <span class="indented-3"></span><span class="var">$errors</span><span class="bracket">[]</span> = <span class="text">"Email does meet required format."</span>;<br />
                        <span class="indented-2"></span><span class="bracket">}</span><br />
                        <span class="indented-2"></span><span class="comment">/*** Repeat for full_name, telephone, subject and message using relavent regex. ***/</span><br /><br /><br />
                        <span class="indented-2"></span><span class="comment">//If no errors</span>   <br />
                        <span class="indented-2"></span><span class="php">if</span><span class="bracket">(</span><span class="func">empty</span><span class="bracket">(</span><span class="var">$errors</span><span class="bracket">)</span><span class="bracket">)</span><span class="bracket">{</span><br />
                            <span class="indented-3"></span><span class="comment">//Add to database</span><br />
                            <span class="indented-3"></span>include <span class="text">'connection.php'</span>;<br />
                            <span class="indented-3"></span><span class="var">$query</span> = <span class="text">"</span><span class="keyword">INSERT INTO</span> <span class="text">contact <span class="bracket">(</span>`name`, `email`, telephone, `subject`, `message`, marketing<span class="bracket">)</span></span> <span class="keyword">VALUES</span> <span class="text"><span class="bracket">(</span>?, ?, ?, ?, ?, ?<span class="bracket">)</span>"</span>; <br />
                            <span class="indented-3"></span><span class="var">$stmt</span> = <span class="var">$db</span>-><span class="func">prepare</span><span class="bracket">(</span><span class="var">$query</span><span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span><span class="bracket">(</span>1, <span class="var">$name</span>, <span class="pdo">PDO</span>::PARAM_STR<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span><span class="bracket">(</span>2, <span class="var">$email</span>, <span class="pdo">PDO</span>::PARAM_STR<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span></span><span class="bracket">(</span>3, <span class="var">$telephone</span>, <span class="pdo">PDO</span>::PARAM_STR<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span><span class="bracket">(</span>4, <span class="var">$subject</span>, <span class="pdo">PDO</span>::PARAM_STR<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span><span class="bracket">(</span>5, <span class="var">$message</span>, <span class="pdo">PDO</span>::PARAM_STR<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><span class="var">$stmt</span>-><span class="func">bindParam</span><span class="bracket">(</span>6, <span class="var">$marketing</span>, <span class="pdo">PDO</span>::PARAM_INT<span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><br />
                            <span class="indented-3"></span><span class="var">$result</span> = <span class="var">$stmt</span>-><span class="func">execute</span><span class="bracket">(</span><span class="bracket">)</span>;<br />
                            <span class="indented-3"></span><br />
                            <span class="indented-3"></span><span class="comment">//If query doesn't get successfully executed</span><br />
                            <span class="indented-3"></span><span class="php">if</span> <span class="bracket">(</span><span class="var">$db</span>-><span class="func">lastInsertId</span></span><span class="bracket">(</span><span class="bracket">)</span> == 0<span class="bracket">)</span><span class="bracket">{</span><br />
                                <span class="indented-4"></span><span class="comment">//Add to errors array</span><br />
                                <span class="indented-4"></span><span class="var">$errors</span><span class="bracket">[]</span> = <span class="text">"There was an error sending your messages. Please try again."</span>;<br />
                            <span class="indented-3"></span><span class="bracket">}</span> <span class="php">else</span> <span class="bracket">{</span><br />
                                <span class="indented-4"></span><span class="comment">//Add a success message</span><br />
                                <span class="indented-4"></span><span class="var">$success</span> = <span class="text">"Your message has been sent."</span>;<br />
                                <span class="indented-4"></span><span class="comment">//Clear field variables so that form empties user's input.</span><br />
                                <span class="indented-4"></span><span class="var">$name</span> = <span class="var">$email</span> = <span class="var">$telephone</span> = <span class="var">$subject</span> = <span class="var">$message</span> = <span class="text">""</span>;<br />
                                <span class="indented-4"></span><span class="var">$marketing</span> = 0;<br />
                            <span class="indented-3"></span><span class="bracket">}</span><br />
                        <span class="indented-2"></span><span class="bracket">}</span><br />
                    <span class="indented"></span><span class="bracket">}</span><br />
                <span class="bracket">}</span><br />
            <span class="keyword">?&gt;</span>
        </div>


    </div>
    <div class="code-example">
        <h3>Laravel Reflection</h3>
        <p>This project was to build an admin dashboard that would allow a hypothetical company to create, read, update and delete (CRUD functionality) records for client companies and their employees.
        <p>The Laravel app itself should have: basic authorisation, make use of database seeders and migrations, use Laravel storage with public access to logos and use the 7 RESTful actions.</p>
        <p>The code example below shows the form validation and file storage for creating a company. For more Laravel code examples from this project, please review my <a href="https://github.com/MartynHorslen/laravel-dashboard" target="_blank">Laravel repository</a>.</p>
        <div class="code-block">
        <span class="keyword">public function</span> <span class="func">store</span><span class="bracket">()<br/>
            {</span><br/>
                <span class="indented"></span><span class="var">$attributes</span> = <span class="func">request</span><span class="bracket">()</span>-><span class="func">validate</span><span class="bracket">([</span><br/>
                <span class="indented-2"></span><span class="text">'name'</span> => <span class="bracket">[</span><span class="text">'required'</span>, <span class="pdo">Rule::</span><span class="func">unique</span><span class="bracket">(</span><span class="text">'companies'</span>, <span class="text">'name'</span><span class="bracket">)</span>, <span class="text">'min:2'</span>, <span class="text">'max:255'</span><span class="bracket">]</span>,<br/>
                <span class="indented-2"></span><span class="text">'logo'</span> => <span class="text">'required|image|dimensions:min_width=100,min_height=100'</span>,<br/>
                <span class="indented-2"></span><span class="text">'website'</span> => <span class="bracket">[</span><span class="text">'max:255'</span>, <span class="text">'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'</span><span class="bracket">]</span>,<br/>
                <span class="indented-2"></span><span class="text">'email'</span> => <span class="bracket">[</span><span class="text">'required'</span>, <span class="pdo">Rule::</span><span class="bracket">(</span><span class="text">'companies'</span>, <span class="text">'email'</span><span class="bracket">)</span>, <span class="text">'email'</span>, <span class="text">'min:2'</span>, <span class="text">'max:255'</span><span class="bracket">]</span>,<br/>
                <span class="indented"></span><span class="bracket">])</span>;<br/>
                <br/>
                <span class="indented"></span><span class="php">if</span><span class="bracket">(</span><span class="func">isset</span><span class="bracket">(</span><span class="var">$attributes</span><span class="bracket">[</span><span class="text">'logo'</span><span class="bracket">])){</span><br/>
                    <span class="indented-2"></span><span class="var">$attributes</span><span class="bracket">[</span><span class="text">'logo'</span><span class="bracket">]</span> = <span class="text">'/storage/'</span> . <span class="func">request</span><span class="bracket">()</span>-><span class="func">file</span><span class="bracket">(</span><span class="text">'logo'</span><span class="bracket">)</span>-><span class="func">store</span><span class="bracket">(</span><span class="text">'logo'</span><span class="bracket">)</span>;<br/>
                <span class="indented"></span><span class="bracket">}</span><br/>
                <br/>
                <span class="indented"></span><span class="var">$created</span> = <span class="pdo">Company::</span><span class="func">create</span><span class="bracket">(</span><span class="var">$attributes</span><span class="bracket">)</span>;<br/>
                <br/>
                <span class="indented"></span><span class="php">if</span><span class="bracket">(</span><span class="var">$created</span><span class="bracket">){</span><br/>
                    <span class="indented-2"></span><span class="func">session</span><span class="bracket">()</span>-><span class="func">flash</span><span class="bracket">(</span><span class="text">'success'</span>, <span class="text">'Company Created!'</span><span class="bracket">)</span>;<br/>
                    <span class="indented-2"></span><span class="php">return</span> <span class="func">redirect</span><span class="bracket">(</span><span class="text">'/companies'</span><span class="bracket">)</span>;<br/>
                    <span class="indented"></span><span class="bracket">}</span> <span class="php">else</span> <span class="bracket">{</span><br/>
                        <span class="indented-2"></span><span class="func">session</span><span class="bracket">()</span>-><span class="func">flash</span><span class="bracket">(</span><span class="text">'success'</span>, <span class="text">'Company could not be created!',/
                            <span class="bracket">)</span>;<br/>
                        <span class="indented-2"></span><span class="php">return</span> <span class="func">redirect</span><span class="bracket">(</span><span class="text">'/companies/create'</span><span class="bracket">)</span>;<br/>
                <span class="indented"></span><span class="bracket">}</span>  <br/>
            <span class="bracket">}</span><br/>
        </div>
    </div>
    <div class="code-example">
        
        <h3>Vue SPA Reflection</h3>
        <p>For my view reflection, I created a single page application (SPA) that used third party football data and displayed it to the user.</p>
        <p>Some key features used in my reflection were Vue-Router and localStorage which assisted in creating a fast app that doesn't need to reload from the server and limits the number of requests made to third party APIs.</p>

        <pre>
            <code class="language-javascript">
<script>
import { requestData } from '../api.js';

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
}
</script>
            </code>
        </pre>
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