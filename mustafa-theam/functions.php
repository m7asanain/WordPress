<?php

    // include NavWalker class for bootstrap navigation menu
    include_once('wp-bootstrap-navwalker.php');

    // Add a featured image
    add_theme_support('post-thumbnails'); 

    /* 
    **  wp_enqueue_style()
    **  Function to add custom style
    **  add by @mustafa
    */

    function mustafa_add_styles() {
        wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/css/fontawesome.min.css');
        wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css');
    }

    /* 
    **  wp_enqueue_script()
    **  Function to add custom script
    **  add by @mustafa
    */

    function mustafa_add_scripts() {
        // removie registeration old jQuery
        wp_deregister_script('jquery');
        // register a new jQuery in footer
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '', true);
        // enqueue the new jQuery
        wp_enqueue_script('jquery');
        // add bootstrap script file
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
        // add main script file
        wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
        // add icone file
        wp_enqueue_script('iconawesome-js', get_template_directory_uri() . '/js/iconawesome.js', array(), false, true);
        // add html5shiv for old browser
        wp_enqueue_script('html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js');
        // add conditional comment fot html5shiv
        wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
        // add respond for old browser
        wp_enqueue_script('respond', get_template_directory_uri() . '/js/respond.min.js');
        // add conditional comment fot respond
        wp_script_add_data('respond', 'conditional', 'lt IE 9');
    }

    /* 
    **  register_custome_menu();
    **  Registers navigation menu locations for a theme
    **  add by @mustafa
    */

    // function mustafa_register_custome_menu() {
    //     register_nav_menu('bootstrap-menu', __('Navigation Bar'));
    // }

    function mustafa_register_custome_menu() {
        register_nav_menus(array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'Footer Menu'
        ));
    }

    /* 
    **  wp_nav_menu():
    **  Registers navigation menu locations for a theme
    **  add by @mustafa
    */

    function mustafa_bootstrap_menu() {
        wp_nav_menu(array(
            'theme_location' => 'bootstrap-menu',
            'menu_class' => 'navbar-nav mr-auto',
            'container' => false,
            'depth' => 2,
            'walker' => new wp_bootstrap_navwalker()
        ));
    }

    /*
    **  excerpt_length() / excerpt_more()
    **  Customize the excerpt word lengh /and/ read more
    **  add by @mustafa
    */

    function mustafa_extend_excerpt_length($length) {
        if (is_author()) {
            return 40;
        } else if(is_category()) {
            return 60;
        }else {
            return 80;
        }
    }

    add_filter( 'excerpt_length', 'mustafa_extend_excerpt_length');

    function mustafa_extend_excerpt_more($more) {
        return '...';
    }

    add_filter( 'excerpt_more', 'mustafa_extend_excerpt_more');

    /*
    **  wp_enqueue_style()
    **  Add function 
    **  add by @mustafa
    */

    add_action('wp_enqueue_scripts', 'mustafa_add_scripts');
    add_action('wp_enqueue_scripts', 'mustafa_add_styles');
    add_action('init', 'mustafa_register_custome_menu');

    // Numbering Pagination

    function numbering_pagination() {
        global $wp_query;       // make wp_query global
        $all_pages = $wp_query->max_num_pages;      // get all pages
        $current_page = max(1, get_query_var('paged'));     // get currnt page

        if ($all_pages > 1) {
            return paginate_links(array(
                'base'      => get_pagenum_link() . '%_%',
                'format'    => 'page/%#%',
                'current'   =>  $current_page,
                'mid_size'  => 1,
                'end_size'  => 2,
                'prev_text' => '«',
                'next_text' => '»',
            ));
        }
    }

    // resgister sidebar

    function mustafa_main_sidebar() {
        // resgister main sidebar
        register_sidebar(array(
            'name'          => 'Main Sidebar',
            'id'            => 'main-sidebar',
            'description'   => 'Main Sidebar Appear Everywhere',
            'class'         => 'main-sidebar',
            'before_widget' => '<div class="widget-content">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }

    add_action('widgets_init', 'mustafa_main_sidebar');

    // remove paragraph element from posts
    // it's not working

    function mustafa_remove_paragraph($content) {
        remove_filter('the_content', 'wpautop');
        return $content;
    }

    add_filter('the_content', 'mustafa_remove_paragraph');

?>