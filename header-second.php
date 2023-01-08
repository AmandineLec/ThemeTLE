<!-- Header des autres pages  -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="esport, e-sport, association, toulouse, jeu vidéo, jeux vidéos, jeux videos, jeux vidéo, ">
    
    
    <?php wp_head(); ?>  
    </head>
<body>
    <!-- Section pour l'affichage des étoiles filantes -->
    <section class="ciel">
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    <span class="etoile"></span>
    </section>
    <header class="headerbis">
        <!-- Appel du logo customisé du site en php en boucle if, si le site possède un logo customisé alors on va le chercher-->
        <?php if(has_custom_logo()) : 
            $logo = wp_get_attachment_image_src( get_theme_mod('custom_logo'));
        ?>
        <!--barre du menu avec le logo et le bouton d'ouverture du menu-->
            <div class="headerbis__barre">
                <a class="headerbis__link" href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="headerbis__logo" src="<?php echo $logo[0]; ?>" alt="Logo Toulouse Landers">
                </a>
        <?php endif; ?>   
<!-- Permet d'afficher le bouton du menu burger sous forme de trois barres avec le css-->
                <div id="burger-menu" class="headerbis__burger burger">
                    <span class="burger__barre"></span>
                </div>

            </div>
        <!-- Les boutons de header sont dans un champs répéteur dans la page d'options infos, on utilise donc if have rows et while have rows, 
        et on spécifie bien le slug de la page d'option -->
        <?php if( have_rows( 'bouton_header', 'infos' ) ): ?>    
            <div id="bouton" class="headerbis__bouton">
                <?php while(have_rows('bouton_header', 'infos')): the_row();
                    $libellebtn = get_sub_field('libelle_btn_header');
                    $linkbtn = get_sub_field('lien_btn_header');
                ?>
                    <a class="headerbis__btn" href="<?php echo $linkbtn['url']; ?>"><?php echo $libellebtn;?></a>
                <?php endwhile;?>
            </div>
        <?php endif; ?>
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
    <main>