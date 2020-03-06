<?php 

$args = array(
    'category_name' => 'Conférences',
    'posts_per_page' => 5,
    'orderby' => 'date'
);
 
//Query des articles de la catégorie : Conférences
$queryConferences = new WP_Query( $args );

$args = array(
    'category_name' => 'Nouvelles',
    'posts_per_page' => 4,
    'orderby' => 'date'
);

//Query des articles de la catégorie : Nouvelles
$queryNouvelles = new WP_Query( $args );

//Appel du header
get_header();

?>

<!-- Figure qui controle la cadre de l'image de mise en avant -->
<figure class="figure-post-thumbnail">
    <?php
        //Appel de la fonction qui affiche l'image de mise en avant
        tp2_veille_post_thumbnail(); 
    ?>
</figure>

<?php

// Appel du Query : Conférences
echo '<div class="categorie-conferences">';
echo '<h1>Nos dernières conférences</h1>';

while ( $queryConferences->have_posts() ) {
    $queryConferences->the_post();
    echo '
    <article class="articles-conferences">
        <img src="'.get_the_post_thumbnail_url().'" alt="" class="image-article">
        <div class="content-post">
            <h3 class="title-article"><a target=_blank href='.get_the_permalink().'>'.get_the_title().'</a></h3>
            <h4 class=post-date>'.get_the_date().'</h4>
            <p class="text-extract">'.substr(get_the_excerpt(),0,200).'</p>
        </div>
    </article>
    ';
}

wp_reset_postdata();

echo '</div>';


// Appel du Query : Nouvelles
echo '<div class="categorie-nouvelles">';
echo '<h1>Nos dernières nouvelles</h1>';
echo '<div class="categorie-nouvelle-contenu">';

while ( $queryNouvelles->have_posts() ) {
    $queryNouvelles->the_post();
    echo '
    <article class="articles-nouvelles">
        <h3 class="title-article"><a target=_blank href='.get_the_permalink().'>'.substr(get_the_title(), 0, 18).'</a></h3>
        <img src="'.get_the_post_thumbnail_url().'" alt="" class="image-article">
    </article>
    ';
}

wp_reset_postdata();

echo '</div>';
echo '</div>';
?>

<?php 
//Appel du footer
get_footer();
?>