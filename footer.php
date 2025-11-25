<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 */

// Get footer settings
$widgets_areas = $footer_styles = (int) get_theme_mod( 'footer-widget-areas', zoom_customizer_get_default_option_value( 'footer-widget-areas', inspiro_customizer_data() ) );
$footer_layout = get_theme_mod('footer-layout-type', zoom_customizer_get_default_option_value('footer-layout-type', inspiro_customizer_data()));

$has_active_sidebar = false;
$site_info_classnames = '';

//Default columns classname
$widget_columns_classname = 'widget-columns-4';

//0 - 4 columns classname
if(  0 < $widgets_areas && 4 >= $widgets_areas ) {
	$widget_columns_classname = 'widget-columns-' . esc_attr( $widgets_areas );
}

if(  4 < $widgets_areas && 6 !== $widgets_areas && 7 !== $widgets_areas ) {
	$site_info_classnames = 'site-info-style-' . $footer_styles;
	$widgets_areas = 4;
}
if( 6 == $widgets_areas ) {
	$site_info_classnames = 'site-info-style-5';
	$widgets_areas = 3;
	$widget_columns_classname = 'widget-columns-4';
}

if( 7 == $widgets_areas ) {
    // $site_info_classnames = 'site-info-style-5';
    $widgets_areas = 3;
    $widget_columns_classname = 'widget-columns-4';
}

if ( $widgets_areas > 0 ) {
    $i = 1;

    while ( $i <= $widgets_areas ) {
        if ( is_active_sidebar( 'footer_' . $i ) ) {
            $has_active_sidebar = true;
            break;
        }

        $i++;
    }
}


?>

<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>

    <?php if ( is_active_sidebar( 'footer_instagram_section' ) ) : ?>
        <section class="site-widgetized-section section-footer">
            <div class="widgets clearfix">
                <?php dynamic_sidebar( 'footer_instagram_section' ); ?>
            </div>
        </section><!-- .site-widgetized-section -->
    <?php endif; ?>

    <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="inner-wrap <?php echo ' ' . $footer_layout; ?>">

            <?php if ( $has_active_sidebar ) : ?>

                <div class="footer-widgets widgets <?php echo $widget_columns_classname; ?>">

					<?php if( 6 == $footer_styles || 7 == $footer_styles ) { ?>
						<div class="column column-footer-logo">
							<?php inspiro_footer_custom_logo(); ?>
							<?php if( is_active_sidebar( 'footer_social' ) && 7 == $footer_styles ) : ?>
							<div class="footer_social">
								<?php dynamic_sidebar('footer_social'); ?>
							</div>
							<?php endif; ?>
						</div>
					<?php } ?>

                    <?php for ( $i = 1; $i <= $widgets_areas; $i ++ ) : ?>

                        <div class="column">
                            <?php dynamic_sidebar( 'footer_' . $i ); ?>
                        </div><!-- .column -->

                    <?php endfor; ?>

                    <div class="clear"></div>

                    <div class="site-footer-separator"></div>

                </div><!-- .footer-widgets -->


            <?php endif; ?>


            <div class="site-info <?php echo $site_info_classnames; ?>">

                <?php if( is_active_sidebar( 'footer_social' ) && ( 5 == $footer_styles || 6 == $footer_styles ) ) : ?>
                    <div class="footer_social">
                        <?php dynamic_sidebar('footer_social'); ?>
                    </div>
                <?php endif; ?>


                <?php if( has_nav_menu( 'footer' ) && ( 5 == $footer_styles || 6 == $footer_styles || 7 == $footer_styles || 8 == $footer_styles  ) ) : ?>

                    <div class="footer-menu">
                        <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-footer', 'theme_location' => 'footer', 'depth' => '1' ) ); ?>
                    </div>

                <?php endif; ?>

                <p class="copyright"><?php zoom_show_customizer_partial_blogcopyright(); ?></p>
                <p class="designed-by">
                    <?php printf( __( 'Designed by %s', 'wpzoom' ), '<a href="https://www.laureline-auger.fr/" target="_blank">Laureline Auger</a>' ); ?>
                </p>

            </div><!-- .site-info -->

        </div>

    </footer><!-- #colophon -->

<?php } ?>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>