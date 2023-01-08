<?php 
//Template pour le formulaire de recherche. 

$loupe = get_field('svg_loupe_recherche', 'svg');
$lienretour = get_field('retour_recherche', 'infos');?>


<!-- Formulaire de recherche contenant la barre de recherche, une recherche avec un champ vide renvoie vers la page des adhérents, une image de loupe décorative et un bouton rechercher.  -->
<form class= "recherche__form" id="searchform" method="get" action="<?php echo esc_url($lienretour); ?>">
        <div class="recherche__loupe"><?php echo wp_get_attachment_image($loupe, array(20, 20),"", array("class" => "recherche__img") );?></div>
        <input class="recherche__barre" type="text" class="search-field" name="s" placeholder="Votre recherche" value="<?php echo get_search_query(); ?>">
        <input class="recherche__submit" type="submit" value="Rechercher">
</form>


       

