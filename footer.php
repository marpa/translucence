<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */
?>
<?php global $translucence_options; ?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">	</div><!-- #colophon -->

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>

	</div><!-- #footer -->

</div><!-- #wrapper -->

<div class="sitewrapper">

<div class="footermeta_right">
	<span class="bgtextcolor">
	<a href="<?php print stripslashes($translucence_options['theme-url']); ?>">
	<?php print stripslashes($translucence_options['theme-name']); ?></a>
	<a href="<?php print stripslashes($translucence_options['background-source-url']); ?>">
	<?php print stripslashes($translucence_options['background-source-credit']); ?></a>
	| <a href="http://www.wordpress.org/">WordPress</a>	
	</span><br/>
</div>

<div class="footermeta_left">
	<span class="bgtextcolor">
	<?php print stripslashes($translucence_options['footerleft']); ?>
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
