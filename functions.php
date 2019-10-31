<?php
/**
 * Base Install functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Digital Scholarship
 */

if ( ! function_exists( 'digitalscholarship_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function digitalscholarship_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Base Install, use a find and replace
		 * to change 'digitalscholarship' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'digitalscholarship', get_template_directory() . '/languages' );

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
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'digitalscholarship' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'digitalscholarship_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'digitalscholarship_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function digitalscholarship_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'digitalscholarship_content_width', 640 );
}
add_action( 'after_setup_theme', 'digitalscholarship_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function digitalscholarship_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'digitalscholarship' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'digitalscholarship' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'digitalscholarship_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function digitalscholarship_scripts() {

	// minified stylesheet
	wp_enqueue_style( 'digitalscholarship-min-style', get_template_directory_uri() . '/assets/css/main.css', array(), time() ); 
	
	// theme styles
	wp_enqueue_style( 'digitalscholarship-css', get_stylesheet_uri() );

	// theme scripts
	wp_enqueue_script( 'digitalscholarship-js', get_template_directory_uri() . '/assets/js/main.js', array(), '20151215', true ); 

	// responsive media queries for IE
	wp_enqueue_script( 'digitalscholarship-respond', get_template_directory_uri().'/assets/vendor/js/respond.min.js' );
	wp_script_add_data( 'digitalscholarship-respond', 'conditional', 'lt IE 9' );

	// html5shiv for IE
	wp_enqueue_script( 'digitalscholarship-html5shiv', get_template_directory_uri().'/assets/vendor/js/html5shiv.min.js');
	wp_script_add_data( 'digitalscholarship-html5shiv', 'conditional', 'lt IE 9' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'digitalscholarship_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}






/**
 * CUSTOM FUNCTIONS START BELOW
 * below are some optional additions to theme functionality
 * feel free to edit or delete to suit your needs
 */



/**
 * Custom nav walker to add consistent class/ID for CSS/JS targeting.
 */
require get_template_directory() . '/inc/nav-walker.php';


/**
 * RESET LOGO LINK IN TOP NAVIGATION
 * Switch link in custom logo to go to Colby Libraries homepage
 */
function digitalscholarship_custom_logo_link() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
            esc_url( 'https://www.colby.edu/libraries/' ),
            wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                'class'    => 'custom-logo',
            ) )
        );
    return $html;   
}
add_filter( 'get_custom_logo', 'digitalscholarship_custom_logo_link' );


/**
 * RESPONSIVE VIDEO EMBED
 * Filter for adding wrappers around embedded objects
 */
function digitalscholarship_responsive_embeds( $content ) {
	$content = preg_replace( "/<object/Si", '<div class="video-container"><object', $content );
	$content = preg_replace( "/<\/object>/Si", '</object></div>', $content );
	
	// Added iframe filtering for embedded YouTube/Vimeo videos.
	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="video-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
	$content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );
	return $content;
}
add_filter( 'the_content', 'digitalscholarship_responsive_embeds' );


/**
 * RESPONSIVE TABLES
 * Filter for adding horizontal scroll wrap around tables
 */
function digitalscholarship_responsive_table($content) {
  return preg_replace_callback('~<table.*?</table>~is', function($match) {
    return '<div class="responsive-table">' . $match[0] . '</div>';
  }, $content);
}

add_filter('the_content', 'digitalscholarship_responsive_table');



/**
 * SET GALLERY LINKS TO MEDIA FILE
 * Ensures photo gallery media items will trigger lightbox when clicked
 */
function digitalscholarship_set_gallery_links($out, $pairs, $atts) {
	$atts = shortcode_atts( array( 
		'link' => 'file' 
		), $atts );
	$out['link'] = $atts['link'];
	return $out;
}
add_filter('shortcode_atts_gallery', 'digitalscholarship_set_gallery_links', 10, 3);



/**
 * LINK SCROLL
 * Remove link scroll from "read more" excerpt links
 */
function digitalscholarship_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'digitalscholarship_remove_more_link_scroll' );



/**
 * MORE LINK
 * Wrap more-link with div and change text
 */
function digitalscholarship_wrap_readmore($more_link) {
    return '<div class="post-readmore"><a class="more-link" href="' . get_permalink() . '">Read Full Post</a></div>';
}
add_filter('the_content_more_link', 'digitalscholarship_wrap_readmore', 10, 1);



/**
 * ADD FEATURED IMAGE TO HERO
 * Enable featured image to be background of hero block (default hero image in hero.scss)
 * If featured image has been set, this function gets ID/URL of image and overrides default CSS 
 */
function digitalscholarship_custom_header_image(){
	if (has_post_thumbnail()) { // if a thumbnail has been set
		$imgID = get_post_thumbnail_id($post->ID); // get id of featured image
		$featuredImage = wp_get_attachment_image_src($imgID, 'full' ); // get url of featured image (returns array)
		$imgURL = $featuredImage[0]; // get url of image from array
		?>
		<style type="text/css">
			.hero {
				background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url(<?php echo $imgURL ?>);
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'digitalscholarship_custom_header_image' );




/**
 * THEME WRAPPER
 * Don't Repeat Yourself - header, footer, and sidebar are called in base.php for staying DRY
 * You can have multiple wrappers (base-single.php, base-page.php, etc.) and they can be overwritten like any other template
 * Based on Scribu and Sage
 */
function digitalscholarship_template_path() {
	return digitalscholarship_wrapper::$main_template;
}
function digitalscholarship_template_base() {
	return digitalscholarship_wrapper::$base;
}
class digitalscholarship_wrapper {

	// Stores the full path to the main template file
	static $main_template;

	// Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	static $base;
	static function wrap( $template ) {
		self::$main_template = $template;
		self::$base = substr( basename( self::$main_template ), 0, -4 );
		if ( 'index' == self::$base )
			self::$base = false;
		$templates = array( 'base.php' );
		if ( self::$base )
			array_unshift( $templates, sprintf( 'base-%s.php', self::$base ) );
		return locate_template( $templates );
	}
}
add_filter( 'template_include', array( 'digitalscholarship_wrapper', 'wrap' ), 99 );



/**
 * POST/ARCHVE PAGINATION
 * Adds numbered pagination with previous/next links
 * at the bottom of post/archive pages if number of posts
 * exceeds the maximum number set to display 
 */
function digitalscholarship_numeric_posts_nav() {
	
	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul>' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( 'Previous Page' ) );

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( 'Next Page' ) );

	echo '</ul></div>' . "\n";
}


