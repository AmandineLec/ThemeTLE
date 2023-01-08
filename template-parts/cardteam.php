<?php

//Template permettant l'affichage des différentes cartes d'équipes. 
$imagejeu = get_field('image_jeu');
?>
            <div class="cardequipe">
                <a class="cardequipe__container" href="<?php the_permalink();?>">
                    <div class="cardequipe__img"><?php echo wp_get_attachment_image($imagejeu, array(500, 400), "", array("class" => "cardequipe__img")); ?></div>
                    <div class="cardequipe__btn">
                        <h3 class="cardequipe__title"><?php the_title();?></h3>
                    </div>
                </a>
            </div>
