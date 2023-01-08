<?php  
//Template pour la page de résultat des recherches. 

	if ( is_front_page()) :
        get_header( 'front-page' );
    else :
        get_header('second');
    endif; 

$backgroundtitle = get_field('svg_titre', 'svg');
$vaisseau = get_field('svg_vaisseau', 'svg'); 
$lienretour = get_field('retour_recherche', 'infos');?>


<section class="section">
	<div class="listplayer__header"> 
	<div class="section__vecteur"><?php echo wp_get_attachment_image($backgroundtitle, array(400, 400), "", array("class" => "section__vecteur"));?></div>          
			<h2 class="section__title">Votre recherche</h2>
    </div> 
	<article class="section__listplayer listplayer">
<!-- On va chercher la sidebar contenant la barre de recherche ainsi que le widget des filtres  -->
		<aside class="site__sidebar">
		<?php get_search_form();?>
		<ul class="recherche__filtre">
			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
			<?php do_shortcode( "[fe_widget show_selected='yes' show_count='yes']");?>
		</ul>
	</aside>
	<!-- On va chercher le template part card afin d'afficher notre recherche avec la mise en forme des cards, vu que celle-ci ne s'effectue que sur les adhérents.  -->
		<?php
			if(have_posts()) :
				while(have_posts()) : the_post(); 
					get_template_part('template-parts/card');				
				endwhile;
			else : ?>
			<!-- On affiche une image et un lien permettant de retourner sur la page des adhérents en cas d'absence de résultat. -->
				<div class="recherche__resultat">
					<div class="recherche__logo"><?php echo wp_get_attachment_image($vaisseau, array(800, 800), "", array("class" => "recherche__logo"));?></div>
					<p class="recherche__msg">Aucun joueur ne correspond à votre recherche</p>
				</div>
			<?php endif;?>
		<div class="recherche__link"><a class="recherche__lien" href="<?php echo $lienretour;?>">Retour à la liste des joueurs</a></div>
<?php get_footer()?>