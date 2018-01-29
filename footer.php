<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thfbf_v2
 */

?>

<footer>
<!-- Footer -->
<div class="footer">
<div class="container">
	<div class="footeritems">
		<div class="footer-col">
			<h4 class="footer-title">Sitemap</h4>
			<?php 

					$args = array(
						'theme_location' => 'footer',
						'container' => 'ul',
						'container_class' => 'footer-col',
						'menu_class' => 'footer-nav'
					);

					wp_nav_menu($args); ?>
			<!-- <ul class="footer-nav">
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="#">About</a>
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="#">Guests 2018</a>
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="#">Publishers &amp; booksellers</a>
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="#">Program &amp; tickets</a>
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="#">Contact</a>
				</li>
			</ul> -->
		</div>
		<div class="footer-col">
			<h4 class="footer-title">Contact</h4>
			<ul class="footer-nav">
				<li class="footer-nav-item">
					The Hague Peace Projects
				</li>
				<li class="footer-nav-item">
					Paviljoensgracht 20
				</li>
				<li class="footer-nav-item">
					2512 BP The Hague
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="mailto:info@thehaguepeace.org">info@thehaguepeace.org</a>
				</li>
				<li class="footer-nav-item">
					<a class="footer-nav-link" href="tel:+0031618051097">+31(6) 18 05 10 97</a>
				</li>
			</ul>
		</div>
		<div class="footer-col" id="sponsors">
			<h4 class="footer-title">Made possible by</h4>
			<div class="partnercol">
				<div class="partnerdiv">
					<a target="_blank" href="http://inhetkoorenhuis.nl/"><img src="<?php bloginfo('stylesheet_directory');?>/assets/partners/koorenhuis.png" alt="In het Koorenhuis" width="100px" class="partner"></a>
				</div>
				<div class="partnerdiv">
					<a target="_blank" href="https://www.freepressunlimited.org/en"><img src="<?php bloginfo('stylesheet_directory');?>/assets/partners/freepressunlimited.png" alt="Free Press Unlimited" width="100px" class="partner"></a>
				</div>
				<div class="partnerdiv">
						<a target="_blank" href="https://thehaguepeace.org/"><img src="<?php bloginfo('stylesheet_directory');?>/assets/partners/thpp.png" alt="The Hague Peace Projects" width="100px" class="partner"></a>
				</div>
			</div>
		</div>
	</div>

</div>
</div>

<!-- cr -->
<div class="copyright">
<div class="container">
	<p>&copy; 2018 The Hague Peace Projects</p>
</div>
</div>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
