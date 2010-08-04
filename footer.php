<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<?php global $options; ?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>


		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<div id="wrapper" style="border: none;">

<div class="footermeta_right">
	<span class="bgtextcolor">
	<a href="<?php print stripslashes($options['theme-url']); ?>">
	<?php print stripslashes($options['theme-name']); ?></a>
	<a href="<?php print stripslashes($options['background-source-url']); ?>">
	<?php print stripslashes($options['background-source-credit']); ?></a>
	| <a href="http://www.wordpress.org/">WordPress</a>	
	</span><br/>
</div>

<div class="footermeta_left">
	<span class="bgtextcolor">
	<?php print stripslashes($options['footerleft']); ?>
	</span><br/>
</div>
</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
