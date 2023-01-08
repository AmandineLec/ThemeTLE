<?php  

//Template des contenu type page (webtv, association, partenaire, contact, politique de confidentialité)

    if ( is_front_page()) :
        get_header( 'front-page' );
    else :
        get_header('second');
    endif; 
        
?>

<?php 
$backgroundtitle = get_field('svg_titre', 'svg');
$barre = get_field('svg_barre', 'svg');
?>
<section class="section">
    <div class="listplayer__header"> 
        <div class="section__vecteur"><?php echo wp_get_attachment_image($backgroundtitle, array(400, 400), "", array("class" => "section__vecteur"));?></div>
        <h2 class="section__title"><?php the_title();?></h2> 
    </div> 
    <?php 
        //Ne m'affiche que la page web tv. 
        if(is_page('web-tv')) : 
    ?>
    <!-- Contenu embarqué twitch pour l'affichage de la web tv -->
            <iframe 
                class="live"
                src="https://player.twitch.tv/?channel=landers_esports&amp;parent=www.toulouse-landers.fr" 
                frameborder="0" 
                allowfullscreen="true" 
                scrolling="yes" 
                height="550px" 
                width="100%">
            </iframe>
    <!-- Contenu embarqué twitch pour l'affichage du chat -->
            <iframe 
                class="chat"
                id="chat_embed" 
                src="https://www.twitch.tv/embed/landers_esports/chat?parent=www.toulouse-landers.fr" 
                frameborder="0" 
                height="550px"
                width="100%">
            </iframe>
        
    <?php
    //Ne m'affiche que la page association.
        elseif(is_page('association')) :
    ?>
        <article class="asso__article">
            <!-- Les différents éléments composant cette page est un répéteur avec des sous-champs répéteur, on les apelle donc avec la fonctionif have rows/while have rows -->
            <?php if(have_rows('contenu_association')): 
                while(have_rows('contenu_association')) : the_row(); 
                    $subtitleasso = get_sub_field('subtitle_asso');
                    $imageasso= get_sub_field('image_asso');?>
                        <div class="asso__div">
                            <h3 class="asso__subtitle"><?php echo $subtitleasso;?></h3>
                            <div class="asso__desc">
                            <?php 
                                if(have_rows('paragraphes_asso')) : 
                                    while(have_rows('paragraphes_asso')): the_row();
                                        $paragrapheasso = get_sub_field('paragraphe_asso');?>
                                            <p class="asso__text"><?php echo $paragrapheasso;?></p>
                                    <?php endwhile;?>
                                <?php endif;?>
                                    <div class="asso__img"><?php echo wp_get_attachment_image($imageasso, array(400, 400), "", array("class" => "asso__img"));?></div>
                            </div>
                        </div>
                <?php endwhile;?>
            <?php endif;?>          
        </article>
    <?php 
        //Ne m'affiche que la page partenaire.
        elseif(is_page('partenaires') || is_front_page()) : 
            $linkpartner = get_field('boutonpartner');
            $partners = get_field('partners');
    ?>
    <a class="listpartenaire__btn" href="<?php echo $linkpartner['url'];?>">Devenir partenaire</a>
        <article class="listpartenaire__article">
        <?php if( $partners): 
                foreach( $partners as $partner):
                    $logopartner = $partner['logo_partner'];
                    $linkpartner = $partner['link_partner'];
                    $descpartner = $partner['description_partner'];
                    $nompartner = $partner['nom_partner'];?> 
                        <div class="listpartenaire__card cardpartner">
                            <a class="cardpartner__link"  target="_blank" href="<?php echo $linkpartner['url'];?>">
                                <h3 class="cardpartner__title"><?php echo $nompartner;?></h3>
                                <div class="cardpartner__img"><?php echo wp_get_attachment_image($logopartner, array(400, 400), "", array("class" => "cardpartner__img"));?></div>
                                <p class="cardpartner__desc"><?php echo $descpartner;?></p>
                            </a>
                        </div>
                        <div class="listpartenaire__barre"><?php echo wp_get_attachment_image($barre, array(400, 400), "", array("class" => "listpartenaire__barre"));?></div>
                <?php endforeach;?>                                   
        <?php endif;?>           
        </article>
        <!-- Ne m'affiche que la page contact. -->
        <?php elseif(is_page('contact')): ?>
            <div class ="contact__form">
            <?php the_content();?>
            </div>
        <!-- N'affiche que la page de la politique de confidentialité     -->
        <?php elseif(is_page('politique-de-confidentialite')) : ?>
            <div class="politique">
                <?php the_content();?>
            </div> 
        <?php 
        // Renvoie vers la page de content-none si la page demandé n'éxiste pas.
        else :
            get_template_part( 'template-parts/content', 'none' );
        
    endif;?>        
</section>

<?php get_footer(); ?>