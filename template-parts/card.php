<?php 
//Template permettant l'affichage des cartes des joueurs. 

//Déclaration des variables pour les différents champs ACF dont on va avoir besoin.
$prenom = get_field('prenom_joueur');
$datearrivee = get_field('date_arrivee');
$ville = get_field('ville');
$jeux = get_field('jeux');
$img_joueur = get_field('photo_joueur');
$teams = get_field('equipe_joueur');
$hexagone = get_field('svg_hexagone', 'svg');
$rs_joueurs = get_field('rs_joueurs');
$pseudo = get_field('pseudo');
$palmares = get_field('palmares');
?>
                     
            <div class="listplayer__card card">
                <a class="card__lien" href="<?php the_permalink();?>"></a>
                <div class="card__header">
                    <div class="card__image" ><?php echo wp_get_attachment_image( $img_joueur, array(200, 180), "", array("class" => "card__img")); ?></div>
                    <h3 class=card__title><?php echo $prenom; ?></h3>

                    <!--On affiche cette partie de la carte si elle contient la taxonomie "fondateur" ou "coach"-->
                    <?php if($tax) : $taxonomies = $tax;
                            else : $taxonomies = get_post_taxonomies();   
                    endif;                         
                    if ($taxonomies) : 
                        $i=0;
                        foreach($taxonomies as $taxonomy) :  
                            if ($i==0) : 
                                $taxonomy;
                                $i++;             
                                if($staff) : 
                                    $roles = get_the_terms(get_the_ID($staff), 'role');
                                    $pays = get_the_terms(get_the_ID($staff), 'pays');
                                elseif($equipe) : 
                                    $pays = get_the_terms(get_the_ID($equipe), 'pays');
                                else :
                                    $roles = get_the_terms( get_the_ID(), 'role');
                                    $pays = get_the_terms(get_the_ID(), 'pays');
                                endif;
                            if($roles) :
                                // La variable $j permet de limiter l'affichage à un jeu rôle si l'adhérent en a ajouté plusieurs
                                $j=0;
                                foreach($roles as $role) : 
                                    if($j==0) : 
                                        $role;
                                        $j++;
                                    $rolejoueur = $role->name;
                                    if(has_term(array('fondateur','coach'), 'role')) : ?>
                                        <div class="card__roles">
                                            <div class="card__hexa"><?php echo wp_get_attachment_image($hexagone, array(0, 0), "", array("class" => "card__hexagone"));?></div>
                                            <p class="card__role"><?php echo $rolejoueur;?></p>
                                        </div>
                                    <?php 
                                    endif;
                                endif;
                                endforeach;
                            endif;
                            if($pays) : 
                                foreach($pays as $country) : 
                                    $flag = get_field('drapeau', $country);?> 
                            <div class="card__drapeau"><?php echo wp_get_attachment_image($flag, array(0, 0), "", array("class" => "card__flag"));?></div>
                            <?php endforeach;
                            endif;
                        endif;
                        endforeach;
                    endif;?>        
                   
                
                        <div class="card__desc desc">
                            <p class="desc__pseudo">Pseudo : <?php echo $pseudo; ?></p>
                            <!-- On réalise une query afin d'aller chercher le nom de la là ou des équipes selectionnée par le joueur.  -->
                            <?php if($teams) : ?>
                                <p class="desc__team">Equipe : 
                                    <?php foreach($teams as $team):
                                            $teamjoueur = $team['team_joueur']; 
                                            $args = array(
                                                'post_type' => 'team',
                                                'posts_per_page' => 1,
                                            );
                                            $myquery = new WP_Query($args);
                                            if($myquery->have_posts()) : 
                                                while($myquery -> have_posts()) : 
                                                    $myquery -> the_post();
                                                        if($teamjoueur) : 
                                                            foreach($teamjoueur as $post) : 
                                                                $nomequipe = the_title();
                                                                setup_postdata($post);
                                                                echo $nomequipe . ' ';
                                                            endforeach;
                                                            wp_reset_postdata();
                                                        endif;
                                                    endwhile;
                                            endif;
                                     endforeach;?>
                                </p>
                            <?php endif;?>
                            <p class="desc__town">Ville : <?php echo $ville; ?></p>
                        </div>
                </div>                        

                
                <!-- De même, on affiche cette partie de la carte si elle se trouve sur une page archive ou sur la page d'accueil--> 
                <?php if(is_archive() || is_front_page()) :                               
                        if($palmares) :
                            foreach($palmares as $tournoi) ;
                            $tournoijoueur = $tournoi['tournoi_joueur'];
                //On effectue une query particulière pour n'afficher que le dernier tournoi ajouté par le joueur 
                            $args = array (
                                'post_type' => 'tournois',
                                'posts_per_page' => 1,
                            );
                            $myquery = new WP_Query($args);
                            if($myquery->have_posts()) : 
                                while($myquery->have_posts()) : 
                                    $myquery->the_post(); 
                                        if( $tournoijoueur): 
                                            foreach( $tournoijoueur as $post):
                                                $imagetournoi = get_field('image_tournoi'); 
                                                setup_postdata($post);?>
                                                    <div class="card__trophy trophy">
                                                        <p class="trophy__title">Palmarès :</p>
                                                        <div class="trophy__image"><?php echo wp_get_attachment_image($imagetournoi, array(0, 0), "", array("class" => "trophy__img"));?></div>
                                                        <p class="card__desc trophy__desc"><?php the_title();?></p>
                                                    </div>                                  
                                            <?php endforeach;     
                                        endif;
                                    endwhile;
                                endif;
                            wp_reset_postdata();
                        endif;
                endif;?>

             <!-- le champ réseau est un répéteur, il faut donc aussi aller chercher les sous champs pour bien les afficher -->
             <?php if( $rs_joueurs): 
                        foreach( $rs_joueurs as $rs_joueur): 
                            $rs = $rs_joueur['rs_joueur'];
                            $linkrs= $rs_joueur['link_rs_joueur']['url'];?>
                            <a href="<?php echo $linkrs; ?>"><?php echo wp_get_attachment_image($rs, array(100, 100), "", array("class" => "reseau__player"));?></a>
                        <?php endforeach;    
                    endif; ?>
                </div>
            </div>
