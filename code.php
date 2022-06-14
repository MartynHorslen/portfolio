<?php 
require_once('templates/head.php');
require_once('templates/header.php');
?>
<section class="hero" id="small-hero">
    <figure>
        <img src="img/pexels-stanislav-kondratiev-10816120.jpg" alt="Background of programming code."/>
        <figcaption>
            <h1>Coding Examples</h1>
        </figcaption>
    </figure>
</section>
<section id="examples">
    <div class="code-example">
        <h3>SQL Challenge</h3>
        <p>The objective for this challenge was to create a query with formatted outputs that includes a subquery and that is sorted by a value.</p>
        <p>I opted to use a <a href="https://www.w3resource.com/sql-exercises/movie-database-exercise/subqueries-exercises-on-movie-database.php" target="_blank">movie database</a> and, after working through a couple of practice examples, naturally got curious to see what the first movie in the database was to cast a female actress. This made for a good query for the challenge.</p>
        <p>The database structure is as follows:</p>
        <img src="img/movie-database.png" alt="Relational structure for a movie database"/>
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
</section>
<footer>
    <a href="#">
        <!-- Up arrow icon -->
        <i class="fa-solid fa-chevron-up"></i>
        <h3>Back To Top</h3>  
    </a> 
</footer>
<?php require_once('templates/footer.php'); ?>