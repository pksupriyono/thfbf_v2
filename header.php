<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thfbf_v2
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

    <!-- Styesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/styles_bootstrap.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/custom.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">



</head>

<body>

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
				<div class="container-fluid">
					<a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/brand/logo-black.png" alt="Freedom Book Fair" width="180"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsedmenu" aria-controls="collapsedmenu" aria-expanded="false" aria-label="Toggle navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="navbar-collapse collapse" id="collapsedmenu">

					<?php 

					$args = array(
						'theme_location' => 'primary',
						'container' => 'navbar-nav',
						'container_class' => 'navbar-collapse collapse',
						'menu_class' => 'navbar-nav ml-auto mr-auto'
					);

					wp_nav_menu($args); ?>
					
						<!-- <ul class="navbar-nav ml-auto mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="#">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Guests 2018</a>
								</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Publishers &amp; booksellers</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Program &amp; tickets</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Contact</a>
							</li>
						</ul> -->
						<span class="navbar-text">
						<b style="font-weight:900">21 - 25 Feb 2018</b>
						</span>
					</div>
				</div>
			</nav>

			