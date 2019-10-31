<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Digital Scholarship
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<span class="copyright">Copyright &copy; <?php echo date("Y"); ?> Colby College Libraries</span>
	</div>
</footer>

<a id="scroll-to-top" href="#page"></a>

<script>
	// change text of breadcrumb text first item from "DWQA Questions" to "FAQ"
	(function($, window, document) {
		$('.dwqa-breadcrumbs a:first-of-type').text('FAQ');
	}(window.jQuery, window, document));
</script>
