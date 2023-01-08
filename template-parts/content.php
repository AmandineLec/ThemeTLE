<?php  
//Template pour l'affichage des contenus type fiche (fiche des joueurs et fiche des équipes)
    if ( is_front_page()) :
        get_header( 'front-page' );
    else :
        get_header('second');
    endif; 

$backgroundtitle = get_field('svg_titre', 'svg');

?>


    <section class="section">
        <div class="listplayer__header"> 
        <div class="section__vecteur"><?php echo wp_get_attachment_image($backgroundtitle, array(400, 400), "", array("class" => "section__vecteur"));?></div>
            <h2 class="section__title"><?php the_title();?></h2> 
        </div> 
        <!-- Le contenu d'affiche si la page d'archive correspond aux adhérents.  -->
        <?php if(is_singular('adherent')) : 
            $nom = get_field('nom_joueur');
            $prenom = get_field('prenom_joueur');
            $datearrivee = get_field('date_arrivee');
            $ville = get_field('ville');
            $img_joueur = get_field('photo_joueur');
            $equipe = get_field('equipe_joueur'); 
            $taxonomies = get_post_taxonomies();   
            // On appelle les différents taxonomy (role, pays et jeux)                      
                if ($taxonomies) : 
                $i =0;
                foreach($taxonomies as $taxonomy) : 
                    if($i==0) : 
                         $taxonomy;
                        $i++;                           
                        $roles = get_the_terms( get_the_ID(),'role');
                        $pays = get_the_terms(get_the_ID(), 'pays');
                        $jeux = get_the_terms(get_the_ID(), 'jeux');?>


        <div class="fichejoueur__header">
            <div class="fichejoueur__image"><?php echo wp_get_attachment_image($img_joueur, array(500, 400), "", array("class" => "fichejoueur__img")); ?></div>
            <div class="fichejoueur__desc desc">
                <?php if($pays) : 
                    foreach($pays as $country) : 
                        $flag = get_field('drapeau', $country);?> 
                        <div class="fichejoueur__flag"><?php echo wp_get_attachment_image($flag, array(100, 100), "", array("class" => "fichejoueur__drapeau"));?></div>
                    <?php endforeach;
                endif;?>
                <div class="fichejoueur__infos">
                    <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Prénom : </p>
                        <p class="fichejoueur__rep"><?php echo $prenom; ?></p>   
                    </div>
                    <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Nom : </p>
                        <p class="fichejoueur__rep"><?php echo $nom; ?></p>
                    </div>
                    <!-- On fait un foreach pour appeller tous les jeux ajoutés par l'adhérent -->
                    <?php if($jeux) : ?>
                        <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Jeu(x) : </p>
                        <?php foreach($jeux as $jeu) : ?> 
                            <p class="fichejoueur__rep"><?php echo $jeu->name . ' ';?></p>
                        <?php endforeach;?>
                        </div>
                    <?php endif;?>
                    
                    <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Date d'arrivée : </p>
                        <p class="fichejoueur__rep"><?php echo $datearrivee;?></p>
                    </div>           
                    <!-- On fait un foreach pour appeller tous les rôles ajoutés par l'adhérent-->
                    <?php if($roles) :?>
                        <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Rôle(s) : </p>
                         <?php foreach($roles as $role) :?>                            
                                <p class="fichejoueur__rep"> <?php echo $role->name.' ';?></p>
                    <?php endforeach;?>
                        </div>
                        <?php endif;
                    endif;
                endforeach;
            endif;?>
            <!-- Les réseaux sociaux sont dans un champs répéteur, on utilise donc if have rows/while have rows -->
                    <?php  if( have_rows('rs_joueurs')):?>
                        <div class="fichejoueur__information">
                        <p class="fichejoueur__info">Réseau(x) : </p>
                            <div class="card__reseau reseau">
                                <?php while(have_rows('rs_joueurs')): the_row();
                                    $rsjoueur = get_sub_field('rs_joueur');
                                    $linkrsjoueur = get_sub_field('link_rs_joueur');?>
                                    <a href="<?php echo $linkrsjoueur['url']; ?>">
                                    <?php echo wp_get_attachment_image($rsjoueur, array(100, 100), "", array("class" => "reseau__player"));?></a>
                                <?php endwhile;?>  
                            </div>            
                    <?php endif;?>
                                 
                                        
                                            
                    </div>
                </div>             
            </div>
        </div>
        <div class="fichejoueur__trophees trophees">
            <!-- De même, on affiche cette partie de la carte si elle contient les taxonomies "joueurs", "streamers" ou coach--> 
            <?php if (has_term(array('joueur','coach', 'streamer'), 'role')) : ?>
                <?php if(have_rows('palmares')) :?>
                        <p class="trophees__title">Palmarès : </p> 
                            <?php while(have_rows('palmares')) : the_row();
                                $tournoijoueur = get_sub_field('tournoi_joueur');
                                    if( $tournoijoueur): 
                                                foreach( $tournoijoueur as $post): 
                                                    setup_postdata($post);?>
                                    <!-- //Afin de ne pas répéter le code, on va chercher le template part relatif aux trophées. -->
                                                        <?php get_template_part('template-parts/cardtrophy');
                                                endforeach; 
                                            wp_reset_postdata();     
                                    endif;
                            endwhile; 
                        endif;
                    endif;?>    
        </div>
        <div class="fichejoueur__about abt">
            <!-- Le champ description est un répéteur, on utilise donc if have rows/while have rows -->
            <?php if(have_rows('description')) :
                        while(have_rows('description')) : the_row();
                            $descriptionjoueur = get_sub_field('description_joueurs');?>                            
                                <p class="fichejoueur__abt"><?php echo $descriptionjoueur;?></p>
                        <?php endwhile; 
            endif;?>
        </div>
<!-- On affiche cette partie si la page correspond à la page d'archive des équipes       -->
<?php elseif(is_singular('team')) :
    $photoequipe = get_field('photo_equipe');
?>

    <div class="equipe__img"><?php echo wp_get_attachment_image($photoequipe, array(3000, 3000), "", array("class" => "equipe__img"));?></div>
    <article class="equipe__art equipe__composition">
        <!-- Le champ composition de l'équipe est un répéteur, pour pouvoir appeller tous les joueurs composant l'équipe -->
            <?php if(have_rows('player')) : ?>
                <h3 class="equipe__subtitle">Composition de l'équipe :</h3> 
                    <?php while(have_rows('player')) : the_row();
                        $equipe = get_sub_field('team_player');
                            if( $equipe): 
                                foreach( $equipe as $post): 
                                    setup_postdata($post);
               //Afin de ne pas répéter le code, on va chercher le template part des cartes des adhérents. -->
                                    get_template_part('template-parts/card');
                                endforeach; 
                                    wp_reset_postdata();     
                            endif;
                    endwhile; 
            endif;?>
        </article>
<!-- Le champ composition du staff est un répéteur, pour pouvoir appeller tous les adhérents composant le staff -->   
        <article class="equipe__art equipe__staff">
            <?php if(have_rows('staffs')) : ?>
                <h3 class="equipe__subtitle staff__subtitle">Staff : </h3>
                        <?php while(have_rows('staffs')) : the_row();
                            $staff = get_sub_field('staff');
                                if( $staff): 
                                    foreach( $staff as $post): 
                                        setup_postdata($post);
                                        //Afin de ne pas répéter le code, on va chercher le template part des cartes des adhérents. -->
                                        get_template_part('template-parts/card');
                                    endforeach; 
                                        wp_reset_postdata();     
                                endif;
                        endwhile; 
                endif;?>
        </article>
<!-- Le champ des trophées est un répéteur, pour pouvoir appeller tous les trophées remportés par l'équipe -->   
        <article class="equipe__art palmares">
            <?php if(have_rows('palmares_equipe')) :
                            while(have_rows('palmares_equipe')) : the_row();
                                $tournoiequipe = get_sub_field('team_tournoi');
                                    if( $tournoiequipe): ?>
                                        <h3 class="equipe__subtitle palmares__subtitle">Palmarès : </h3> 
                                                <?php foreach( $tournoiequipe as $post): 
                                                    setup_postdata($post);?>
                                                        <!-- //Afin de ne pas répéter le code, on va chercher le template part relatif aux trophées. -->
                                                        <?php get_template_part('template-parts/cardtrophy');
                                                endforeach; 
                                                    wp_reset_postdata();     
                                    endif;
                            endwhile; 
                        endif;
                    endif;?>    
        </article>

    </section>
<?php get_footer(); ?>
