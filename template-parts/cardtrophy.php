<?php

//Template permettant l'affichage des différents trophées. 
$imagetournoi = get_field('image_tournoi');
$rangtournoi = get_field('rang_tournoi');
?>
            <div class="cardtrophee">
                <div class="cardtrophee__image"><?php echo wp_get_attachment_image($imagetournoi, array(0, 0), "", array("class" => "cardtrophee__img"));?></div>
                <p class="cardtrophee__desc"><?php the_title();?></p>
                <div class="cardtrophee__rang">
                    <p class="cardtrophee__place"><?php echo $rangtournoi;?></p>
                </div>
            </div>