<?php 

//initialisation des fonctions personalisées du thème 
add_action('after_setup_theme', 'tletheme_setup');

//appel des styles et des scripts
add_action('wp_enqueue_scripts', 'tletheme_scripts_styles');

//appel des menus du header et footer
add_action('init', 'tletheme_register_menus');

//appel de la fonction pour les CORS policy
add_action('init', 'handle_preflight');

//appel de la fonctionnalité pour supprimer des éléments dans la barre de navigation de l'administration wordpress
add_action('admin_menu', 'remove_links_tab_menu_pages');