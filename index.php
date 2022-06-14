<?php 
require_once('templates/head.php');
require_once('templates/header.php');
?>
    
            <main>
                <section class="hero">
                    <figure>
                        <img src="img/pexels-andrew-neel-2312369.jpg" alt="Background of laptop, coffee and notepad on a desk." />
                        <figcaption>
                            <h1 >My Name is Martyn Horslen</h1>
                            <h2 id="type-effect">I am a Web Developer</h2>
                            <a href="#portfolio" class="scroll">
                                <h3>Scroll Down</h3>
                                <!-- Down arrow icon -->
                                <i class="fa-solid fa-chevron-down"></i>
                            </a>
                        </figcaption>
                    </figure>
                </section>    
                <section id="portfolio">
                    <div class="project">
                        <figure>
                            <img src="img/netmatters-project.jpg" alt="">
                        </figure>
                        <h2>Netmatters</h2>
                        <p><a href="https://netmatters.martyn-horslen.netmatters-scs.co.uk/" target="_blank">View Project <i class="fa-solid fa-arrow-right"></i></a></p>
                        <p><a href="https://github.com/MartynHorslen/netmatters" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                    </div>
                    <div class="project">
                        <figure>
                            <img src="img/JS-Array-Project.jpg" alt="">
                        </figure>
                        <h2>Image Search</h2>
                        <p><a href="https://image-search.martyn-horslen.netmatters-scs.co.uk/" target="_blank">View Project</a> <i class="fa-solid fa-arrow-right"></i></p>
                        <p><a href="https://github.com/MartynHorslen/js-array" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                        
                    </div>
                    <div class="project coming-soon">
                        <figure>
                            <img src="https://loremflickr.com/800/600/website?random=3" alt="">
                        </figure>
                        <h2>Coming Soon</h2>
                        <p><a href="" target="_blank">View Project</a> <i class="fa-solid fa-arrow-right"></i></p>
                        <p><a href="" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                        
                    </div>
                    <!--<div class="project">
                        <figure>
                            <img src="https://loremflickr.com/800/600?random=4" alt="">
                        </figure>
                        <h2>Project Four</h2>
                        <p><a href="" target="_blank">View Project</a> <i class="fa-solid fa-arrow-right"></i></p>
                        <p><a href="" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                        
                    </div>
                    <div class="project">
                        <figure>
                            <img src="https://loremflickr.com/800/600?random=5" alt="">
                        </figure>
                        <h2>Project Five</h2>
                        <p><a href="" target="_blank">View Project</a> <i class="fa-solid fa-arrow-right"></i></p>
                        <p><a href="" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                        
                    </div>
                    <div class="project">
                        <figure>
                            <img src="https://loremflickr.com/800/600?random=6" alt="">
                        </figure>
                        <h2>Project Six</h2>
                        <p><a href="" target="_blank">View Project</a> <i class="fa-solid fa-arrow-right"></i></p>
                        <p><a href="" target="_blank">View Repository <i class="fa-solid fa-arrow-right"></i></a></p>
                        
                    </div>-->
                </section>
                <section id="contact">
                    <div id="info">
                        <h2>Get In Touch</h2>
                        <p>To enquire about my services, please use the following contact form, phone number or email address.</p>
                        <h3>07984 245214</h3>
                        <h4>martynhorlsen@gmail.com</h4>
                        <p>You can expect a response to all enquiries within 1 working day between the hours of 9 AM and 5 PM GMT.</p>
                    </div>
                    <div id="contact-form">
                        <form method="POST" action="#contact-form">
                            <div class="errors">
                                <?php
                                if(!empty($errors)){
                                    foreach($errors as $error){
                                        echo '<div class="err-msg">' . $error . '<i class="fa-solid fa-xmark"></i></div>';
                                    }
                                }
                                if(!empty($success)){
                                    echo '<div class="success-msg">' . $success . '<i class="fa-solid fa-xmark"></i></div>';
                                }
                                ?>
                            </div> 
                            <fieldset>
                                <input type="text" id="first-name" name="first_name" placeholder="First Name*" pattern="^[a-zA-Z-]{2,16}$" title="Letters and hyphens only. 2-16 characters in lengths." required>
                                <label for="first-name">Letters and hyphens only. 2-16 characters in lengths.</label>
                            </fieldset>
                            <fieldset>
                            <input type="text" id="last-name" name="last_name" placeholder="Last Name*" pattern="^[a-zA-Z-]{2,16}$" title="Letters and hyphens only. 2-16 characters in lengths." required>
                            <label for="last-name">Letters and hyphens only. 2-16 characters in lengths.</label>
                            </fieldset>
                            <input type="text" id="email" name="email" placeholder="Email Address*" pattern="[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.?)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?" title="Most email formats accepted. Use lowercase." required>
                            <label for="email">Most email formats accepted. Use lowercase.</label>
                            <input type="text" id="subject" name="subject" placeholder="Subject*" pattern="[A-Za-z0-9\W]{4,80}" title="Please enter a descriptive subject line between 4 and 80 characters." required>
                            <label for="subject">Please enter a descriptive subject line between 4 and 80 characters.</label>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Message" pattern="[A-Za-z0-9\W]+" required></textarea>
                            <label for="message">Please enter your message.</label>
                            <fieldset id="btn">
                                <button id="submit" value="submit" class="btn">Submit</button>
                            </fieldset>
                        </form>
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