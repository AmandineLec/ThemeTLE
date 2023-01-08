<!-- Header de la page d'accueil.  -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="esport, e-sport, association, toulouse, jeu vidéo, jeux vidéos, jeux videos, jeux vidéo, ">
    <!--Appel de la librairie ajax pour le parallax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!--carousel slick-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      


    <?php wp_head(); ?>  
    </head>
<body class="container">
    <?php wp_body_open(); ?>
    <header class="header">

        <!-- Appel du logo customisé du site en php en boucle if, si le site possède un logo customisé alors on va le chercher-->
        <?php if(has_custom_logo()) : 
        $logo = wp_get_attachment_image_src( get_theme_mod('custom_logo'));
        ?>
        <!--barre du menu avec le logo et le bouton d'ouverture du menu-->
        <div class="header__barre">
            <a class="header__link" href="<?php echo esc_url(home_url('/')); ?>">
                <img class="header__logo" src="<?php echo $logo[0]; ?>" alt="Logo Toulouse Landers">
            </a>
        <?php endif; ?> 
<!-- Permet d'afficher le bouton du menu burger sous forme de trois barres avec le css-->                   
            <div id="burger-menu" class="header__burger burger">
                <span class="burger__barre"></span>
            </div>
        </div>
        <!--menu qui s'ouvre lorsque l'on appuie sur le bouton grâce à un script-->
           <div id="menu" class="header__menu menu">
            <nav class="menu__nav nav">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'container'      => false,
                        'menu_class'     => 'nav__list',
                        'depth'          => 1,
                        'walker'         => new WPDocs_Walker_Nav_Menu(),
                    ) );
                ?>
            </nav>
<!-- Les réseaux sociaux sont dans un champ répéteur d'un epage d'option, on utilise donc if have rows while have rows et on spécifie bien le slug de la page d'option.  -->
            <?php if( have_rows( 'reseaux_sociaux', 'infos' ) ): ?>
                <ul class="menu__list">
                <?php while(have_rows('reseaux_sociaux', 'infos')): the_row();
                    $iconrs = get_sub_field('icon_rs');
                    $url = get_sub_field('link_rs');
                ?>
                <li class="menu__item">
                    <a class="menu__link" href="<?php echo $url; ?>">
                        <div class="menu__icon"><?php echo wp_get_attachment_image($iconrs, array(400, 400), "", array("class" => "menu__icon"));?></div>
                    </a>
                </li>
                <?php endwhile; ?>               
            </ul>
            <?php endif; ?>
        </div>
    </header>
    <!--élément sorti du header pour permettre la position sticky de la barre-->
    <?php 
        $banniere = get_field('banniere', 'infos'); 
    ?>
        <main> 
        <div class="header__banniere" data-parallax="scroll" 
        data-image-src="<?php echo $banniere['url'];?>">
        </div>
        <!-- Les boutons de header sont dans un champs répéteur dans la page d'options infos, on utilise donc if have rows et while have rows, 
        et on spécifie bien le slug de la page d'option -->
        <?php if( have_rows( 'bouton_header', 'infos' ) ): ?>    
             <div id="bouton" class="header__button">
            <?php while(have_rows('bouton_header', 'infos')): the_row();
                $libellebtn = get_sub_field('libelle_btn_header');
                $linkbtn = get_sub_field('lien_btn_header');
            ?>
            <a class="header__btn" href="<?php echo $linkbtn['url']; ?>"><?php echo $libellebtn;?></a>
            <?php endwhile;?>
        </div>
        <?php endif; ?>





