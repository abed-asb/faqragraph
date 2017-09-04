<?php
/**
 * Prints branding information's of site
 *
 * @author     BetterStudio
 * @package    Publisher
 * @version    1.9.0
 */

$site_name = publisher_get_option( 'logo_text' );
if ( empty( $site_name ) ) {
	$site_name = get_bloginfo( 'name' );
}                   // Site name
$site_name = do_shortcode( $site_name );

$logo   = publisher_get_option( 'logo_image' );        // Site logo
$logo2x = publisher_get_option( 'logo_image_retina' ); // Site 2X logo

// Custom logo for categories
if ( is_category() && bf_get_term_meta( 'logo_image' ) != '' ) {
	$logo   = bf_get_term_meta( 'logo_image' );
	$logo2x = bf_get_term_meta( 'logo_image_retina' );
} // Custom logo for categories
elseif ( is_singular( 'page' ) && bf_get_post_meta( 'logo_image' ) != '' ) {
	$logo   = bf_get_post_meta( 'logo_image' );
	$logo2x = bf_get_post_meta( 'logo_image_retina' );
}


// Make it retina friendly
if ( $logo2x != '' ) {
	$logo2x = ' data-bsrjs="' . esc_url( $logo2x ) . '" ';
}


$tag = 'p';

if ( is_home() || is_front_page() ) {
	$tag = 'h1';
}

?>
<div id="site-branding" class="site-branding">
	<<?php echo $tag, ' '; ?> id="site-title" class="logo h1 <?php echo empty( $logo ) ? 'text-logo' : 'img-logo'; ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php publisher_attr( 'site-url' ); ?>>
		<?php

		// Site logo
		if ( ! empty( $logo ) ) { ?>
			<img id="site-logo" src="<?php echo esc_url( $logo ); ?>"
			     alt="<?php echo esc_attr( $site_name ); ?>" <?php echo $logo2x; // escaped before ?> />

			<span class="site-title"><?php echo $site_name, ' - ', get_bloginfo( 'description' ); ?></span>
			<?php
		} // Site title as text logo
		else {
			echo $site_name; // escaped before in WP
		}

		?>
	</a>
</<?php echo $tag; ?>>
</div><!-- .site-branding -->
