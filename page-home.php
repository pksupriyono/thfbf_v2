<?php
/*
    Template Name: Home Page
    
*/

get_header(); ?>
 
 <!-- Countdown -->
 <div class="animated fadeIn" id="countdown">
        <div class="container">
            <!-- Display the countdown timer in an element -->
            <p id="timer"></p><p id="message"></p><a href="#" class="ml-3 btn btn-sm btn-light btn-zoom"><b>Reserve tickets</b> <i class="fas fa-arrow-right"></i></a>
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("Feb 21, 2018 00:00:00").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));

                // Display the result in the element with id="timer"
                document.getElementById("timer").innerHTML = days + " days";

                // If the count down is finished, write some text
                if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "The book fair is currently running!";
                }
                }, 1000);
            </script>
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("Feb 21, 2018 00:00:00").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));

                // Display the result in the element with id="timer"
                document.getElementById("message").innerHTML = " until the book fair starts!";

                // If the count down is finished, write some text
                if (distance < 0) {
                clearInterval(x);
                document.getElementById("message").innerHTML = "";
                }
                }, 1000);
            </script>
        </div>
    </div>

    <main>

        <!-- Hero -->
        <div id="intro">
            <div class="modcontainer">
                <div class="row animated fadeIn" id="hero">
                    <div class="col-md-5">
                    <h1 class="title">The Hague <br><b>Freedom Book Fair 2018</b></h1>
                    <hr class="hr-thick" width="10%" align="left">
                    <p class="lead">The Freedom Book Fair is where writers, activists, artists and civilians come together to debate, discuss, connect and celebrate freedom of expression.</p>
                    <em id="location"><p>21 - 25 February 2018
                        <br>Het Koorenhuis
                        <br>Prinsegracht 27
                        <br>2512 EW The Hague</p></em>
                    </div>
                    <div class="col">
                        <div class="videoWrapper">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/PbwKr81VjhM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="animated fadeIn container frontpage-options">
            <div class="card" id="speakers">
                <img class="card-img-top" src="<?php bloginfo('stylesheet_directory'); ?>/assets/cards/guests.jpg" alt="Guests">
                <div class="card-body flex-vert">
                    <p class="card-text">Writers, artists, journalists and activists from all over the world will come together during the Book Fair.</p>
                    <a href="#" class="btn btn-dark btn-zoom mt-auto">Guests &amp; speakers <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="card" id="books">
                <img class="card-img-top" src="<?php bloginfo('stylesheet_directory'); ?>/assets/cards/books.jpeg" alt="Books">
                <div class="card-body flex-vert">
                    <p class="card-text">Get a glimpse of the wide range of literature that will be for sale during the Book Fair.</p>
                    <a href="#" class="btn btn-dark btn-zoom mt-auto">Publishers &amp; booksellers <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="card " id="program">
                <img class="card-img-top" src="<?php bloginfo('stylesheet_directory'); ?>/assets/cards/panel.jpg" alt="Program">
                <div class="card-body flex-vert">
                    <p class="card-text">There will be various activities over the course of the five days. See when and where they are held.</p>
                    <a href="#" class="btn btn-dark btn-zoom mt-auto">Program &amp; tickets <i class="fas fa-arrow-right mt-auto"></i></a>
                </div>
            </div>
        </div>

        <!-- Social media -->
        <div class="container">
            <div class="row social">
                <div class="col-md-7">
                    <h1 class="title mr-3 mb-3">Be sure to follow Freedom Book Fair on social media for the latest updates.</h1>
                    <a target="_blank" href="https://www.facebook.com/freedombookfairthehague/?ref=br_rs" class="btn btn-success btn-zoom mr-2">Facebook <i class="fas fa-thumbs-up ml-2"></i></a>
                    <a target="_blank" href="https://twitter.com/peacehague?lang=en" class="btn btn-danger btn-zoom">Twitter <i class="fab fa-twitter ml-2"></i></a>
                </div>
                <div class="col">
                    <a class="twitter-timeline" href="https://twitter.com/hashtag/FreedomBookFair" data-widget-id="957707555433742336">Tweets over #FreedomBookFair</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>     
                </div>
            </div>
        </div>

    </main>

    <?php
get_footer();
