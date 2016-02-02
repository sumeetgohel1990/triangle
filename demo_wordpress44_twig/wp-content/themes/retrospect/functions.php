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
        $context['menu'] = new TimberMenu();
        //$context['custom_wp_nav_menu'] = wp_nav_menu( array( 'container_class' => 'menu-header', 'echo' => false, 'menu_class' => 'nav-menu' ) );
        $context['custom_wp_nav_menu'] = wp_nav_menu( array( 'container_class' => 'menu-header', 'echo' => false, 'menu_class' => 'nav-menu' ) );
        
        $context['site'] = $this;

        $context['theme_url'] = get_stylesheet_directory_uri();
        $context['is_logged_in'] = is_user_logged_in();
        $context['theme_mod'] = get_theme_mods();
        $context['options'] = wp_load_alloptions();
        $context['site_url'] = site_url();
        if(is_home() || is_front_page()) $context['is_home'] = true;
        
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
