<?php

//fonction d'initialisation du thème
function tletheme_setup(){

    //permet de gérer la balise de titre et remplace wp_title
    add_theme_support( 'title-tag');


    //rend le thème compatible avec les règles de validation HTML 5
    add_theme_support( 'html5', array (
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ) );

    //Active le support pour un logo personnalisé
    add_theme_support( 'custom-logo', array (
        'height' => 250,
        'width' => 250,
        'flex-width' => true, 
        'flex-height' => true, 
    ) );

    //permet de limiter les choix dans l'éditeur pour la couleur et la taille de police de caractère. 
    add_theme_support('disable-custom-font-sizes');
    add_theme_support( 'disable-custom-colors');
    add_theme_support( 'editor-color-palette');

    //active le champ extrait des pages
    add_post_type_support( 'page', 'excerpt');

    register_sidebar( array(
        'id' => 'blog-sidebar',
        'name' => 'Blog',
    ) );      
}

function tletheme_scripts_styles() {
    //Script qui ne se charge que sur la page d'accueil
    if (is_front_page()) : 
        wp_enqueue_script( 'tle-parallax', get_template_directory_uri() . '/dist/src/js/parallax.js-1.5.0/parallax.min.js');
        wp_enqueue_style( 'tle-style-slick', get_template_directory_uri() . '/dist/slick/slick/slick.css');	
        wp_enqueue_script( 'tle-slick', get_template_directory_uri() . '/dist/slick/slick/slick.js', array('jquery'), true);
        wp_enqueue_script( 'tle-slider', get_template_directory_uri() . '/dist/src/js/slider.js', array(), '', true );

    endif;
    wp_enqueue_style( 'tle-style', get_template_directory_uri() . '/dist/src/css/style.min.css' );
    wp_enqueue_script( 'tle-burger', get_template_directory_uri() . '/dist/src/js/burger.js', array(), '', true );
}

//Permet l'ajour des différents menus personnalisés ajoutés dans le back office de wordpress. 
function tletheme_register_menus() {
    register_nav_menus( array(
      'main-menu' => esc_html__( 'En-tête de page', 'tletheme'),
      'footer-menu' => esc_html__( 'A propos', 'tletheme' ),
      'webtv-menu' => esc_html__( 'Web tv', 'tletheme' ),
      'partner-menu' => esc_html__( 'Nos partenaires', 'tletheme' ),
      'contact-menu' => esc_html__( 'Nous rejoindre', 'tletheme' ),
    ) );
  }

  //Permet de gérer le problèmes des CORS policy
  function handle_preflight() {
    //    $origin = get_http_origin();
    //    if ($origin === 'https://yourfrontenddomain/%27) {
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
            header("Access-Control-Allow-Credentials: true");
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
            if ('OPTIONS' == $_SERVER['REQUEST_METHOD']) {
                status_header(200);
                exit();
            }
    //    }
    }

    // Permet de supprimer des éléments dans la barre de navigation du tableau de bord wordpress, on supprime donc le type de publication article, la page outils et commentaires. 
function remove_links_tab_menu_pages() {
        remove_menu_page('edit.php');
        remove_menu_page('tools.php');
        remove_menu_page('edit-comments.php');
}




