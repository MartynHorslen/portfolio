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
            <span class="keyword">php?&gt;</span>
        </div>


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