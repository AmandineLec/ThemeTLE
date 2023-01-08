<?php  
//Template de la page 404. 

    if ( is_home() ) :
        get_header( 'home' );
    else :
        get_header('second');
    endif; 

    $vaisseau = get_field('svg_vaisseau', 'svg'); ?>

    <div class="recherche__resultat">
			<div class="recherche__logo"><?php echo wp_get_attachment_image($vaisseau, array(800, 800), "", array("class" => "recherche__logo"));?></div>
			<p class="recherche__msg">Vous vous êtes perdus dans la galaxie.</p>
	</div>
    <div class="recherche__link"><a class="recherche__lien"href="<?php echo esc_url(home_url("/"));?>">Revenir à la base de lancement</a></div>
            
<?php get_footer(); ?>