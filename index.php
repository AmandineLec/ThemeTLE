<?php  if ( is_front_page()) :
            get_header( 'front-page' );
        else :
            get_header('second');
        endif; 
//Permet de renvoyer vers les pages demandées en fonction du titre (fiche joueur ou fiche équipe.)
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;
	else :
			get_template_part( 'template-parts/content', 'none' );
	endif;
?>

<?php get_footer()?>