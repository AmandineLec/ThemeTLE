<?php  
//Template pour l'affichage des contenus type archives (liste des joueurs, liste des équipes et liste des trophées. 
	if ( is_front_page() ) :
        get_header( 'front-page' );
    else :
        get_header('second');
    endif; 

$backgroundtitle = get_field('svg_titre', 'svg')

?>
<section class="section listplayer">
	<div class="listplayer__header"> 
	<div class="section__vecteur"><?php echo wp_get_attachment_image($backgroundtitle, array(400, 400), "", array("class" => "section__vecteur"));?></div>
	<!-- On appelle les éléments en fonction de la page afficher, ici, si la page correspong aux adhérents, alors on affiche le template "card"-->               
		<?php if(is_post_type_archive('adherent')) : ?>
			<h2 class="section__title">Nos Joueurs</h2>
    </div>  
	<!--Une sidebar est nécessaire pour apeller les wigets-->
	<aside class="site__sidebar">
			<!--Appel du formulaire de recherches searchform.php-->
			<?php get_search_form();?>
        	<ul class="recherche__filtre">
				<!--appel de la sidebar-->
            	<?php dynamic_sidebar( 'blog-sidebar' ); ?>
				<!-- Appel du widget de filtre-->
				<?php do_shortcode( "[fe_widget show_selected='yes' show_count='yes']");?>
            </ul>
    </aside>
	<article class="section__listplayer listplayer">
	<?php
		if(have_posts()) :
			while(have_posts()) : the_post(); 
				get_template_part('template-parts/card');         
			endwhile;
		endif;
	?>
	<!-- Si la page corresponds aux trophées, on appelle le template "cardtrophy"-->
	<?php 
		elseif(is_post_type_archive('tournois')) : ?>
			<h2 class="section__title">Salle des trophées</h2>
		</div>
		<article class="trophee__article" >
			<!--On effectue une query afin de classer les trounois selon les rangs obtenus, les 1er place en premier-->
			<?php $args = array(
				'post_type' => 'tournois',
				'order'   => 'ASC',
				'orderby' => 'meta_value_num',
				'meta_key' => 'rang_tournoi',
					);    
				$the_query = new WP_Query( $args );

					if ( $the_query->have_posts() ) {    
						while ( $the_query->have_posts() ) {
							$the_query->the_post();           
							get_template_part('template-parts/cardtrophy', 'cardtrophy');         
							wp_reset_postdata();}
				}
			?>
		<!-- Si la page correspond aux équipes, on affiche le template card "cardteam"-->	
		<?php elseif(is_post_type_archive('team')) : ?>
				<h2 class="section__title">Nos équipes</h2>
			</div>
			<article class="listequipe__article">
			<?php
				if(have_posts()) :
					while(have_posts()) : the_post(); 
						get_template_part('template-parts/cardteam', 'cardteam');         
					endwhile;
				endif;
			?>
		<!--Si la page correspond aux fondateurs, on affiche le template "card"-->				
		<?php elseif(is_tax( 'role', 'fondateur' )) : ?>
					<h2 class="section__title">Les fondateurs</h2>
				</div>
				<article class="section__listplayer listplayer">
					<?php 
						// On affiche uniquement les cartes avec le rôle fondateur
						if(has_term('fondateur', 'role')) : 
							if(have_posts()) :
								while(have_posts()) : the_post(); 
									get_template_part('template-parts/card', 'card');         
								endwhile;
							endif;
						endif;
					?>
			</div>
		<!-- Si lapage ne correspond à rien, on affiche le template "content-none"-->	
		<?php else :
				get_template_part( 'template-parts/content', 'none' );
		endif;?>
		</article>
</section>
<?php get_footer(); ?>