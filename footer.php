<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Marka_Cadey_WordPress_Theme
 */

?>

<footer class="footer">
	<div class="container">
		<div class="footer-inner">
			<?php if (is_active_sidebar('footer-widget')) : ?>
				<div class="footer-widget">
					<?php dynamic_sidebar('footer-widget'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>