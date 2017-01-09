<?php
/**
 * Themotion functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themotion
 */

define( 'THEMOTION_PHP_INCLUDE',  get_template_directory() . '/inc' );

if ( ! function_exists( 'themotion_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function themotion_setup() {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on themotion, use a find and replace
         * to change 'themotion' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'themotion', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails', array( 'post', 'page', 'product', 'download' ) );
				set_post_thumbnail_size( 1200, 9999 );

		add_image_size( 'themotion-post-thumbnail', 370, 215, true );

		add_image_size( 'themotion-thumbnail-no-crop', 345, 200 );

		add_image_size( 'themotion-playlist-thumbnail', 175, 100, true );

		add_image_size( 'themotion-thumbnail-blog', 770, 425, true );

		add_image_size( 'themotion-thumbnail-blog-no-crop', 770, 425 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'themotion' ),
		) );

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'video'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'themotion_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for custom logo
		add_theme_support( 'custom-logo', array(
			'height'      => 55,
			'width'       => 280,
			'flex-width' => true,
		) );

		add_theme_support( 'woocommerce' );

		/**
	 * WooCommerce
	 *
	 * Unhook sidebar
	 */
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		/**
		***********  Welcome screen */

		if ( is_admin() ) {
			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'themotion_setup' );

/**
 * Check for static page
 *
 * Checks if the page is static and returns a boolean.
 */
function themotion_is_not_static_page() {
	return ('posts' != get_option( 'show_on_front' ));
}
/**
 * Content Width
 *
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function themotion_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'themotion_content_width', 640 );
}
add_action( 'after_setup_theme', 'themotion_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function themotion_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'themotion' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'themotion' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Single Widget Area', 'themotion' ),
	    'id'            => 'footer-widget-area',
	    'description'   => esc_html__( 'Add widgets here.', 'themotion' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebars(3, array(
		'name'          => esc_html__( 'Footer Widget Area %d', 'themotion' ),
		'id'            => 'footer-area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'themotion_widgets_init' );


/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since themotion 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function themotion_fonts_url() {
	$fonts_url = '';

	/*
     Translators: If there are characters in your language that are not
     * supported by Source Sans Pro, translate this to 'off'. Do not translate
     * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Merriweather font: on or off', 'themotion' );

	/*
     Translators: If there are characters in your language that are not
     * supported by Bitter, translate this to 'off'. Do not translate into your
     * own language.
	 */
	$bitter = _x( 'on', 'Cabin font: on or off', 'themotion' );

	if ( 'off' != $source_sans_pro || 'off' != $bitter ) {
		$font_families = array();

		if ( 'off' != $source_sans_pro ) {
			$font_families[] = 'Merriweather:400';
		}

		if ( 'off' != $bitter ) {
			$font_families[] = 'Cabin:400,500,600,700';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Registers an editor stylesheet for the theme.
 */
function themotion_add_editor_styles() {
	add_editor_style( array( 'css/custom-editor-style.css', themotion_fonts_url() ) );
}
add_action( 'admin_init', 'themotion_add_editor_styles' );

/**
 * Enqueue scripts and styles.
 */
function themotion_scripts() {
	wp_enqueue_style( 'themotion-style', get_stylesheet_uri(), array( 'bootstrap' ) );

	wp_enqueue_style( 'wp-mediaelement' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/vendor/bootstrap.min.css', array(), '3.3.6', 'all' );

	wp_enqueue_style( 'themotion-fonts', themotion_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/vendor/font-awesome.min.css', array(), '4.5.0' );

	wp_enqueue_script( 'themotion-functions-js', get_template_directory_uri() . '/js/functions.js', array(), '1.0.1', true );

	wp_localize_script( 'themotion-functions-js', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'themotion' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'themotion' ) . '</span>',
	) );

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array( 'jquery' ), '20130115', true );

	wp_enqueue_script( 'themotion-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( get_option( 'thread_comments' ) && is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'themotion_scripts' );


/**
 * Load customize controls js
 */
function themotion_customizer_script() {
	wp_enqueue_script( 'themotion-customizer-script', get_template_directory_uri() . '/js/themotion_customizer.js', array( 'jquery', 'jquery-ui-draggable' ), '1.0.4', true );
	wp_enqueue_style( 'themotion-admin-stylesheet', get_stylesheet_directory_uri() . '/css/admin-style.css','1.0.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'themotion_customizer_script' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load homepage sections.
 */
require get_template_directory() . '/inc/frontpage-sections.php';

if ( ! function_exists( 'themotion_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ...
	 * and a Continue reading link.
	 *
	 * @since themotion 1.4
	 *
	 * @param string $more Default Read More excerpt link.
	 * @return string Filtered Read More excerpt link.
	 */
	function themotion_excerpt_more( $more ) {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'themotion' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
		return ' &hellip; ' . $link;
	}
	add_filter( 'excerpt_more', 'themotion_excerpt_more' );
endif;


/**
 * Adds inline style from customizer
 *
 * @since TheMotion 1.0
 */
function themotion_inline_style() {
	$header_image = get_header_image();
	$custom_css = '';

	if ( ! empty( $header_image ) ) {
	    $custom_css .= '
                .home-top-area{
	                    background-image: url(' . esc_url( $header_image ) . ');
	            }';
	}

	if ( ! themotion_has_three_videos_section() ) {
		$custom_css .= '@media screen and (min-width: 992px){
			.home-top-area {
			    padding: 210px 0;
			}}';
	}

	$themotion_home_b_header_text = get_theme_mod( 'themotion_home_b_header_text', esc_html__( 'A collection of high quality videos focused on putting your business in motion.','themotion' ) );
	$themotion_home_b_button_text = get_theme_mod( 'themotion_home_b_button_text',esc_html__( 'See all videos','themotion' ) );

	if ( empty( $themotion_home_b_header_text ) && empty( $themotion_home_b_button_text ) && empty( $header_image ) ) {
		$custom_css .= '.home-ribbon-intro {
                            margin-top: 0;
						}';
	}
	wp_add_inline_style( 'themotion-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'themotion_inline_style' );


/**
 * Return the site brand
 *
 * @since TheMotion 1.0
 */
function themotion_brand() {
	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		the_custom_logo(); ?>
		<div class="header-logo-wrap themotion-only-customizer">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
	<?php
	} else {
		if ( is_customize_preview() ) {  ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link themotion-only-customizer" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>">
				<img src="">
			</a>
		<?php
		} ?>

		<div class="header-logo-wrap">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
	<?php
	}
}


/**
 * Display the search icon
 *
 * @since TheMotion 1.0
 */
function themotion_search_icon() {
	$themotion_show_search = get_theme_mod( 'themotion_show_search' ); ?>
	<li <?php echo ( ( ( ! isset( $themotion_show_search ) || ( 1 == $themotion_show_search ) ) && is_customize_preview() ) ? 'class="themotion-only-customizer"' : '' ); ?>>
		<?php
		if ( 1 != $themotion_show_search && is_customize_preview() || ( isset( $themotion_show_search ) ) ) {  ?>
			<button type="button" class="search-opt search-toggle">
			</button>
			<div class="header-search">
				<div class="container container-header-search">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php
		} ?>
	</li>
<?php
}


/**
 * Custom Excerpt Length
 *
 * Set the length of the post excerpt.
 *
 * @since TheMotion 1.0
 */
function themotion_custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'themotion_custom_excerpt_length', 999 );


/**
 * Define Allowed Files to be included
 *
 * @param array $array all files from /inc folder.
 *
 * @return array
 */
function themotion_filter_phpfiles( $array ) {
	return array_merge($array,array(
		'/features/feature-copyright-controls',
		'/features/feature-search-toggle',
		'/features/feature-color-palettes',
		'/features/feature-homepage-b',
		'/features/feature-about-page',
        '/features/feature-calendar-page',
		'/features/feature-services-page',
		'/features/feature-homepage-a-ribbon',
		'/features/feature-footer-content',
		'/features/palette-content',
		'/features/feature-customizer-links',
		'/features/feature-inquiry-1',
		'/features/feature-inquiry-2',
		'/features/feature-inquiry-3',
	));
}
add_filter( 'themotion_filter_phpfiles', 'themotion_filter_phpfiles' );

/**
 * Auto include features files.
 */
function themotion_include_files() {
	$themotion_inc_dir = rtrim( THEMOTION_PHP_INCLUDE, '/' );
	$themotion_allowed_phps = array();
	$themotion_allowed_phps = apply_filters( 'themotion_filter_phpfiles',$themotion_allowed_phps );

	foreach ( $themotion_allowed_phps as $file ) {
		$themotion_file_to_include = $themotion_inc_dir . $file . '.php';
		if ( file_exists( $themotion_file_to_include ) ) {
			include_once( $themotion_file_to_include );
		}
	}
}

add_action( 'after_setup_theme','themotion_include_files' );

/**
 * Checkout page
 * Move the coupon fild and message info after the order table
 **/
function themotion_coupon_after_order_table_js() {
	wc_enqueue_js( '
		$( $( ".woocommerce-info, .checkout_coupon" ).detach() ).appendTo( "#themotion-checkout-coupon" );
	');
}
add_action( 'woocommerce_before_checkout_form', 'themotion_coupon_after_order_table_js' );

/**
 * Checkout page
 * Move the coupon fild and message info after the order table
 **/
function themotion_coupon_after_order_table() {
	echo '<div id="themotion-checkout-coupon"></div><div style="clear:both"></div>';
}
add_action( 'woocommerce_checkout_order_review', 'themotion_coupon_after_order_table' );

/**
 * Escape Lightbox iFrame
 *
 * Escape the iFrame for embedds.
 */
function themotion_escape_lightbox( $input ) {

	$allowed_tags = array(
		'video' => array(
			'autoplay'  => true,
			'controls'  => true,
			'height'    => true,
			'loop'      => true,
			'muted'     => true,
			'poster'    => true,
			'preload'   => true,
			'src'       => true,
			'width'     => true,
			'class'     => true,
			'id'        => true,
			'style'     => true,
			'title'     => true,
			'role'      => true,
		),
		'iframe' => array(
			'height'    => true,
			'width'     => true,
			'name'      => true,
			'sandbox'   => true,
			'src'       => true,
			'srcdoc'    => true,
			'class'     => true,
			'id'        => true,
			'style'     => true,
			'title'     => true,
			'role'      => true,
			'frameborder' => true,
			'webkitallowfullscreen' => true,
			'allowfullscreen' => true,
		),
		'source' => array(
			'type'     => true,
			'src'      => true,
			'class'    => true,
			'id'       => true,
			'style'    => true,
			'role'     => true,
			'title'    => true,
		),
	);

	return wp_kses( $input, $allowed_tags );
}
