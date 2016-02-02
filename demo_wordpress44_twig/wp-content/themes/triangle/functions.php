<?php

if (!class_exists('Timber')) {
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });
    return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

    function __construct() {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }

    function register_post_types() {
        //this is where you can register custom post types
    }

    function register_taxonomies() {
        //this is where you can register custom taxonomies
    }

    function add_to_context($context) {
        $context['foo'] = 'bar';
        $context['stuff'] = 'I am a value set in your functions.php file';
        $context['notes'] = 'These values are available everytime you call Timber::get_context();';
        $context['menu'] = new TimberMenu('primary');
        //$context['custom_wp_nav_menu'] = wp_nav_menu( array( 'container_class' => 'menu-header', 'echo' => false, 'menu_class' => 'nav-menu' ) );
        $context['custom_wp_nav_menu'] = wp_nav_menu( array( 'container_class' => 'menu-header', 'echo' => false, 'menu_class' => 'nav-menu' ) );
        
        $context['site'] = $this;

        $context['no_image']=  get_template_directory_uri().'/images/no_image.png';
        
        $context['theme_url'] = get_stylesheet_directory_uri();
        $context['is_logged_in'] = is_user_logged_in();
        $context['theme_mod'] = get_theme_mods();
        $context['options'] = wp_load_alloptions();
        $context['site_url'] = site_url();
        if(is_home() || is_front_page()) $context['is_home'] = true;
        /*
         *  Header Image
         */
         $context['site_logo']=get_option('upload_image');;
         $context['menu_upload_image']=get_option('menu_upload_image');;
         /*
         *  Footer 
         */
        $context['footer_tag_line'] = get_option('footer_text');
        $context['footer_address'] = get_option('address');
        $context['footer_site_url'] = site_url();
        $context['footer_inquiry_mail'] = get_option('inquiry_mail');
        $context['footer_telephone'] = get_option('telephone');
        $context['s_facebook'] = get_option('facebook');
        $context['s_twitter'] = get_option('twitter');
        $context['s_linkedin'] = get_option('linkedin');
        $context['footer_copyright'] = get_option('copyright');
        
        /* Sidebar */
        $context['blogsidebar']=Timber::get_sidebar('sidebar-blog.php');
        
        
        return $context;
    }

    function add_to_twig($twig) {
        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        $twig->addExtension(new Twig_Extension_Debug());
        $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
        return $twig;
    }

}

new StarterSite();

function myfoo($text) {
    $text .= ' bar!';
    return $text;
}

add_action('custom_get_post_author_link', 'my_function_with_args', 10, 1);

function my_function_with_args($author_id){
   // $get_all =get_the_author_meta($pid);
   echo get_author_posts_url($author_id);
   //var_dump($author_id);
}
 
function my_search_form( $form ) {
//	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
//	<div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
//	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
//	<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
//	</div>
//	</form>';
                
                  $form ='<div class="search">
                        <form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
                            <i class="fa fa-search"></i>
                            <div class="field-toggle">
                                <input type="text" class="search-form" autocomplete="off" placeholder="Search"  value="' . get_search_query() . '" name="s" id="s" >
                            </div>
                        </form>
                    </div>';

	return $form;
}
add_action( 'get_search_form', 'my_search_form' );

/* Wordpress Default */
if (!function_exists('my_theme_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * Create your own my_theme_setup() function to override in a child theme.
     *
     * @since Twenty Sixteen 1.0
     */
    function my_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Sixteen, use a find and replace
         * to change 'my_theme' to the name of your theme in all the template files
         */
        load_theme_textdomain('my_theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1200, 0, true);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'my_theme'),
            'social' => __('Social Links Menu', 'my_theme'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        //add_editor_style(array('css/editor-style.css', my_theme_fonts_url()));
    }
endif; // my_theme_setup
add_action( 'after_setup_theme', 'my_theme_setup' );


/****
 *  Widgets
 */
function theme_widgets_init(){
    register_sidebar(array(
    'name' => __('Homepage Widget Area', 'theme'),
    'id' => 'sidebar-content-box',
    'description' => __('Appears after silder', 'twentyfourteen'),
    'before_widget' => '<div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms"><div class="single-service">',
    'after_widget' => '</div></div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
    'before_image' => '<div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">',
    'after_image' => '</div>',
    'before_widget_content' => '<p>',
    'after_widget_content' => '</p>',
));
}
add_action( 'widgets_init', 'theme_widgets_init' );



/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {
	$screens = array('page' );
                  global $post;
                  $frontpage_id = get_option('page_on_front');
                   if($post->ID == $frontpage_id):
                            add_meta_box(
                                    'myplugin_sectionid',
                                    __( 'Take a tour - Post/Page ID', 'myplugin_textdomain' ),
                                    'myplugin_meta_box_callback',
                                    $screens
                            );
                   endif;
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_save_meta_box_data', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="myplugin_new_field">';
	_e( 'Insert post/page id for tour', 'myplugin_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['myplugin_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );