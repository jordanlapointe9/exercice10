<?php

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main nouvelles-main">

        <div class="categories-container">
        <?php

        //Appel de : Nouvelles
        echo '<div class="categories-container">';
        echo '<h1>Catégorie : Nouvelles</h1>';

        if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                echo '
                <article class="categories-articles">
                    <img src="'.get_the_post_thumbnail_url().'" alt="" class="image-article">
                    <div class="content-post">
                        <h3 class="title-article"><a href='.get_the_permalink().'>'.get_the_title().'</a></h3>
                        <input type="button" value="Lire la suite" id="button-article">
                        <p class="text-extract">'.substr(get_the_excerpt(),0,200).'</p>
                    </div>
                </article>
                ';
                endwhile;
        endif;
        echo '</div>';

        ?>
    </div>
    </main><!-- #main -->

</div><!-- #primary -->

<?php

get_footer();
?>