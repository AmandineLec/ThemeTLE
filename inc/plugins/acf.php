<?php 

//Permet d'ajouter les deux pages d'options présents dans le back office de wordpress. 
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page([
            'page_title' => 'Infos',
            'menu_title' => 'Infos',
            'menu_slug' => 'infos-site',
            'capability' => 'edit_posts',
            'parent_slug' => '',
            'position' => 3,
            'icon_url' => false,
            'redirect' => false,
            'post_id' => 'infos',
            'autoload' => false,
            'update_button' => 'Mettre à jour',
        ]);
        acf_add_options_page([
            'page_title' => 'SVG',
            'menu_title' => 'Svg du site',
            'menu_slug' => 'scg-site',
            'capability' => 'edit_posts',
            'parent_slug' => '',
            'position' => 3,
            'icon_url' => false,
            'redirect' => false,
            'post_id' => 'svg',
            'autoload' => false,
            'update_button' => 'Mettre à jour',
        ]);
    }
?>