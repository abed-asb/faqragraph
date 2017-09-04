<?php
/**
 * bs-social-share.php
 *---------------------------
 * [bs-social-share] short code & widget
 *
 */


/**
 * Publisher Social Share Shortcode
 */
class Publisher_Social_Share_Shortcode extends BF_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-social-share';

		$_options = array(
			'defaults'            => array(
				'title'              => publisher_translation_get( 'widget_share' ),
				'show_title'         => 1,
				'icon'               => '',
				'heading_color'      => '',
				'heading_style'      => 'default',
				'show-section-title' => TRUE,
				'style'              => 'button',
				'colored'            => TRUE,
				'sites'              => array(
					'facebook'    => TRUE,
					'twitter'     => TRUE,
					'google_plus' => TRUE,
					'reddit'      => TRUE,
					'whatsapp'    => TRUE,
					'pinterest'   => TRUE,
					'email'       => TRUE,
					'telegram'    => FALSE,
					'linkedin'    => FALSE,
					'digg'        => FALSE,
					'vk'          => FALSE,
					'stumbleupon' => FALSE,
					'tumblr'      => FALSE,
					'line'        => FALSE,
					'bbm'         => FALSE,
					'viber'       => FALSE,
				),
				'bs-show-desktop'    => TRUE,
				'bs-show-tablet'     => TRUE,
				'bs-show-phone'      => TRUE,
			),
			'have_widget'         => TRUE,
			'have_vc_add_on'      => TRUE,
			'have_tinymce_add_on' => TRUE,
		);

		if ( isset( $options['shortcode_class'] ) ) {
			$_options['shortcode_class'] = $options['shortcode_class'];
		}

		if ( isset( $options['widget_class'] ) ) {
			$_options['widget_class'] = $options['widget_class'];
		}

		parent::__construct( $id, $_options );

	}


	/**
	 * Filter custom css codes for shortcode widget!
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function register_custom_css( $fields ) {

		return $fields;
	}


	/**
	 * Handle displaying of shortcode
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	function display( array $atts, $content = '' ) {

		ob_start();

		publisher_set_prop( 'shortcode-bs-social-share-atts', $atts );
		publisher_get_view( 'shortcodes', 'bs-social-share' );
		publisher_clear_props();

		return ob_get_clean();

	}


	public function get_fields() {

		return array(
			array(
				'type' => 'tab',
				'name' => __( 'Style', 'publisher' ),
				'id'   => 'style',
			),
			array(
				'name'           => __( 'Style', 'publisher' ),
				'section_class'  => 'style-floated-left',
				'id'             => 'style',
				//
				'type'           => 'image_radio',
				'options'        => array(
					'button'                 => array(
						'label' => __( 'Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button.png' )
					),
					'button-no-text'         => array(
						'label' => __( 'Icon Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button-no-text.png' )
					),
					'outline-button'         => array(
						'label' => __( 'Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button.png' )
					),
					'outline-button-no-text' => array(
						'label' => __( 'Icon Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button-no-text.png' )
					),
				),
				//
				'vc_admin_label' => TRUE,
			),
			array(
				'name' => __( 'Show in colored  style?', 'publisher' ),
				'type' => 'switch',
				'id'   => 'colored',
			),
			array(
				'name'             => __( 'Active and Sort Sites', 'publisher' ),
				'section_class'    => 'bs-theme-social-share-sorter',
				'id'               => 'sites',
				//
				'type'             => 'sorter_checkbox',
				'deferred-options' => array(
					'callback' => 'publisher_social_share_option_list',
				),
				//
				'vc_admin_label'   => TRUE,
			),
			array(
				'type' => 'tab',
				'name' => __( 'Heading', 'publisher' ),
				'id'   => 'heading',
			),
			array(
				'name'           => __( 'Section Title', 'publisher' ),
				'type'           => 'text',
				'id'             => 'title',
				'vc_admin_label' => TRUE,
			),
			array(
				'name' => __( 'Show Title?', 'publisher' ),
				'id'   => 'show_title',
				'type' => 'switch',
			),
			array(
				'desc'           => __( 'Select custom icon for share widget.', 'publisher' ),
				'name'           => __( 'Title Icon (Optional)', 'publisher' ),
				'type'           => 'icon_select',
				'id'             => 'icon',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'name'           => __( 'Heading Custom Color', 'publisher' ),
				'desc'           => __( 'Change block heading color.', 'publisher' ),
				'id'             => 'heading_color',
				'type'           => 'color',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'name'             => __( 'Custom Heading Style', 'publisher' ),
				'desc'             => __( 'Specialize this block with custom heading.', 'publisher' ),
				'id'               => 'heading_style',
				'type'             => 'select_popup',
				'deferred-options' => array(
					'callback' => 'publisher_cb_heading_option_list',
					'args'     => array(
						TRUE
					),
				),
				//
				'vc_admin_label'   => FALSE,
			),
			array(
				'type' => 'tab',
				'name' => __( 'Design options', 'publisher' ),
				'id'   => 'design_options',
			),
			array(
				'section_class'  => 'style-floated-left bordered bf-css-edit-switch',
				'name'           => __( 'Show on Desktop', 'publisher' ),
				'id'             => 'bs-show-desktop',
				'type'           => 'switch',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'section_class'  => 'style-floated-left bordered bf-css-edit-switch',
				'name'           => __( 'Show on Tablet Portrait', 'publisher' ),
				'id'             => 'bs-show-tablet',
				'type'           => 'switch',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'section_class'  => 'style-floated-left bordered bf-css-edit-switch',
				'name'           => __( 'Show on Phone', 'publisher' ),
				'id'             => 'bs-show-phone',
				'type'           => 'switch',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'name' => __( 'CSS box', 'publisher' ),
				'type' => 'css_editor',
				'id'   => 'css',
			),
			array(
				'name'           => __( 'Custom CSS Class', 'publisher' ),
				'section_class'  => 'bf-section-two-column',
				'id'             => 'custom-css-class',
				'type'           => 'text',
				//
				'vc_admin_label' => FALSE,
			),
			array(
				'name'           => __( 'Custom ID', 'publisher' ),
				'section_class'  => 'bf-section-two-column',
				'id'             => 'custom-id',
				'type'           => 'text',
				//
				'vc_admin_label' => FALSE,
			),
		);
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map( array(
			'name'           => __( 'Social Share Buttons', 'publisher' ),
			"base"           => $this->id,
			"weight"         => 1,
			"wrapper_height" => 'full',
			"category"       => __( 'Publisher', 'publisher' ),
			"params"         => $this->vc_map_listing_all(),

		) );
	}


	function tinymce_settings() {

		return array(
			'name' => __( 'Social Share Buttons', 'publisher' ),
		);
	}
} // Publisher_Social_Share_Shortcode


if ( ! function_exists( 'publisher_shortcode_social_share_get_li' ) ) {
	/**
	 * Used for generating lis for social share list
	 *
	 * @param string  $id
	 * @param    bool $show_title
	 * @param    int  $count_label
	 *
	 * @return string
	 */
	function publisher_shortcode_social_share_get_li( $id = '', $show_title = TRUE, $count_label = 0 ) {

		if ( empty( $id ) ) {
			return '';
		}


		static $initialized;
		static $page_title;
		static $page_permalink;

		// Disable inner cache in Ajax loading
		if ( bf_is_doing_ajax() ) {

			static $post_cache;

			if ( is_null( $post_cache[ $id ] ) ) {
				$initialized = NULL;
			} else {
				$initialized = TRUE;
			}
		}
 
		wp_reset_postdata(); // fix for after other loops

		if ( is_null( $initialized ) ) {
			$cur_page       = bf_social_share_guss_current_page( publisher_get_query() );
			$page_title     = esc_attr( $cur_page['page_title'] );
			$page_permalink = urlencode( $cur_page['page_permalink'] );
			$initialized    = TRUE;
		}

		switch ( $id ) {

			case 'facebook':
				$link  = 'https://www.facebook.com/sharer.php?u=' . $page_permalink;
				$title = __( 'Facebook', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-facebook"></i>';
				break;

			case 'twitter':

				$by = '';
				if ( class_exists( 'Better_Social_Counter' ) ) {
					$by = Better_Social_Counter::get_option( 'twitter_username' );

					if ( $by === 'BetterSTU' && ! class_exists( 'BS_Demo_Helper' ) ) {
						$by = '';
					}

					if ( ! empty( $by ) ) {
						$by = ' @' . $by;
					} else {
						$by = '';
					}
				}

				$link  = 'https://twitter.com/share?text=' . $page_title . $by . '&url=' . $page_permalink;
				$title = __( 'Twitter', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-twitter"></i>';
				break;

			case 'google_plus':
				$link  = 'https://plus.google.com/share?url=' . $page_permalink;
				$title = __( 'Google+', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-google"></i>';
				break;

			case 'pinterest':
				$_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$link     = 'https://pinterest.com/pin/create/button/?url=' . $page_permalink . '&media=' . $_img_src[0] . '&description=' . $page_title;
				$title    = __( 'Pinterest', 'publisher' );
				$icon     = '<i class="bf-icon fa fa-pinterest"></i>';
				break;

			case 'linkedin':
				$link  = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $page_permalink . '&title=' . $page_title;
				$title = __( 'Linkedin', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-linkedin"></i>';
				break;

			case 'tumblr':
				$link  = 'https://www.tumblr.com/share/link?url=' . $page_permalink . '&name=' . $page_title;
				$title = __( 'Tumblr', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-tumblr"></i>';
				break;

			case 'email':
				$link  = "mailto:?subject=" . $page_title . "&body=" . $page_permalink;
				$title = publisher_translation_get( 'widget_email' );
				$icon  = '<i class="bf-icon fa fa-envelope-open"></i>';
				break;

			case 'telegram':
				$link  = 'https://telegram.me/share/url?url=' . $page_permalink . '&text=' . $page_title;
				$title = __( 'Telegram', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-send"></i>';
				break;

			case 'whatsapp':
				$link  = 'whatsapp://send?text=' . $page_title . ' %0A%0A ' . $page_permalink;
				$title = __( 'WhatsApp', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-whatsapp"></i>';
				break;

			case 'digg':
				$link  = 'https://www.digg.com/submit?url=' . $page_permalink;
				$title = __( 'Digg', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-digg"></i>';
				break;

			case 'reddit':
				$link  = 'https://reddit.com/submit?url=' . $page_permalink . '&title=' . $page_title;
				$title = __( 'ReddIt', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-reddit-alien"></i>';
				break;

			case 'stumbleupon':
				$link  = 'https://www.stumbleupon.com/submit?url=' . $page_permalink . '&title=' . $page_title;
				$title = __( 'StumbleUpon', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-stumbleupon"></i>';
				break;

			case 'vk':
				$link  = 'https://vkontakte.ru/share.php?url=' . $page_permalink;
				$title = __( 'VK', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-vk"></i>';
				break;

			case 'line':
				$link  = 'https://line.me/R/msg/text/?' . $page_title . '%0D%0A' . $page_permalink;
				$title = __( 'LINE', 'publisher' );
				$icon  = '<i class="bf-icon bsfi-line"></i>';
				break;

			case 'bbm':
				$link  = 'bbmi://api/share?message=Hello&userCustomMessage=' . $page_title . '%0D%0A' . $page_permalink;
				$title = __( 'BlackBerry', 'publisher' );
				$icon  = '<i class="bf-icon bsfi-bbm"></i>';
				break;

			case 'viber':
				$link  = 'viber://forward?text=' . $page_title . ' ' . $page_permalink;
				$title = __( 'Viber', 'publisher' );
				$icon  = '<i class="bf-icon bsfi-viber"></i>';
				break;

			case 'print':
				$link  = '#';
				$title = __( 'Print', 'publisher' );
				$icon  = '<i class="bf-icon fa fa-print"></i>';
				break;

			default:
				return '';
		}

		$extra_classes = $count_label ? ' has-count' : '';
		$extra_classes .= $show_title ? ' has-title' : '';
		$output        = '<span class="social-item ' . esc_attr( $id ) . $extra_classes . '"><a href="' . $link . '" target="_blank" rel="nofollow" class="bs-button-el" ' . ( $id !== 'print' ? 'onclick="window.open(this.href, \'share-' . $id . '\',\'left=50,top=50,width=600,height=320,toolbar=0\'); return false;"' : '' ) . '>';

		$output .= '<span class="icon">' . $icon . '</span>';

		if ( $show_title ) {
			$output .= '<span class="item-title">' . wp_kses( $title, bf_trans_allowed_html() ) . '</span>';
		}

		if ( $count_label ) {
			$output .= sprintf( '<span class="number">%s</span>', bf_human_number_format( $count_label ) );
		}

		$output .= '</a></span>';

		return $output;

	}// publisher_shortcode_social_share_get_li
}// if


if ( ! function_exists( 'publisher_social_share_option_list' ) ) {
	/**
	 * Handy callback to set all social share sites list (DRY & Performance)
	 *
	 * @return array
	 */
	function publisher_social_share_option_list() {

		return array(
			'facebook'    => array(
				'label'     => '<i class="fa fa-facebook"></i> ' . __( 'Facebook', 'publisher' ),
				'css-class' => 'active-item'
			),
			'twitter'     => array(
				'label'     => '<i class="fa fa-twitter"></i> ' . __( 'Twitter', 'publisher' ),
				'css-class' => 'active-item'
			),
			'google_plus' => array(
				'label'     => '<i class="fa fa-google-plus"></i> ' . __( 'Google+', 'publisher' ),
				'css-class' => 'active-item'
			),
			'pinterest'   => array(
				'label'     => '<i class="fa fa-pinterest"></i> ' . __( 'Pinterest', 'publisher' ),
				'css-class' => 'active-item'
			),
			'reddit'      => array(
				'label'     => '<i class="fa fa-reddit-alien"></i> ' . __( 'ReddIt', 'publisher' ),
				'css-class' => 'active-item'
			),
			'linkedin'    => array(
				'label'     => '<i class="fa fa-linkedin"></i> ' . __( 'Linkedin', 'publisher' ),
				'css-class' => 'active-item'
			),
			'tumblr'      => array(
				'label'     => '<i class="fa fa-tumblr"></i> ' . __( 'Tumblr', 'publisher' ),
				'css-class' => 'active-item'
			),
			'telegram'    => array(
				'label'     => '<i class="fa fa-send"></i> ' . __( 'Telegram', 'publisher' ),
				'css-class' => 'active-item'
			),
			'whatsapp'    => array(
				'label'     => '<i class="fa fa-whatsapp"></i> ' . __( 'Whatsapp (Only Mobiles)', 'publisher' ),
				'css-class' => 'active-item'
			),
			'email'       => array(
				'label'     => '<i class="fa fa-envelope"></i> ' . __( 'Email', 'publisher' ),
				'css-class' => 'active-item'
			),
			'stumbleupon' => array(
				'label'     => '<i class="fa fa-stumbleupon"></i> ' . __( 'StumbleUpon', 'publisher' ),
				'css-class' => 'active-item'
			),
			'vk'          => array(
				'label'     => '<i class="fa fa-vk"></i> ' . __( 'VK', 'publisher' ),
				'css-class' => 'active-item'
			),
			'digg'        => array(
				'label'     => '<i class="fa fa-digg"></i> ' . __( 'Digg', 'publisher' ),
				'css-class' => 'active-item'
			),
			'line'        => array(
				'label'     => '<i class="fa bsfi-line"></i> ' . __( 'LINE (Only Mobiles)', 'publisher' ),
				'css-class' => 'active-item'
			),
			'bbm'         => array(
				'label'     => '<i class="fa bsfi-bbm"></i> ' . __( 'BlackBerry (Only Mobiles)', 'publisher' ),
				'css-class' => 'active-item'
			),
			'viber'       => array(
				'label'     => '<i class="fa bsfi-viber"></i> ' . __( 'Viber (Only Mobiles)', 'publisher' ),
				'css-class' => 'active-item'
			),
			'print'       => array(
				'label'     => '<i class="fa fa-print"></i> ' . __( 'Print', 'publisher' ),
				'css-class' => 'active-item'
			),
		);
	}

}


/**
 * Publisher Social Share Widget
 */
class Publisher_Social_Share_Widget extends BF_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		// haven't title in any location
		$this->with_title = TRUE;

		parent::__construct(
			'bs-social-share',
			__( 'Publisher - Social Share', 'publisher' ),
			array( 'description' => __( 'Social Share Widget', 'publisher' ) )
		);
	} // __construct


	/**
	 * Adds backend fields
	 */
	function load_fields() {

		// Back end form fields
		$this->fields = array(
			array(
				'name' => __( 'Title', 'publisher' ),
				'id'   => 'title',
				'type' => 'text',
			),
			array(
				'name'          => __( 'Buttons Style', 'publisher' ),
				'id'            => 'style',
				'type'          => 'image_select',
				'section_class' => 'style-floated-left',
				'value'         => 'clean',
				'options'       => array(
					'button'                 => array(
						'label' => __( 'Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button.png' )
					),
					'button-no-text'         => array(
						'label' => __( 'Icon Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button-no-text.png' )
					),
					'outline-button'         => array(
						'label' => __( 'Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button.png' )
					),
					'outline-button-no-text' => array(
						'label' => __( 'Icon Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button-no-text.png' )
					),
				),
			),
			array(
				'name'      => __( 'Colored Style', 'publisher' ),
				'id'        => 'colored',
				'type'      => 'switch',
				'on-label'  => __( 'Yes', 'publisher' ),
				'off-label' => __( 'No', 'publisher' ),
			),
			array(
				'name'             => __( 'Active Sites', 'publisher' ),
				'id'               => 'sites',
				'type'             => 'sorter_checkbox',
				'deferred-options' => array(
					'callback' => 'publisher_social_share_option_list',
				),
				'section_class'    => 'bs-theme-social-share-sorter',
			),
		);

	}
} // Publisher_Social_Share_Widget class
