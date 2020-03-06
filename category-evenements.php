<?php
    get_header();

    echo "<h1> Nos événements importants cette année </h1>";

    if ( have_posts() ) :
        echo '<div class="container-evenements">';
            while ( have_posts() ) : the_post();
            $jour = (int) get_the_date('j');
                $mois = (int) get_the_date('n');
                $jourGrid = get_the_date('j') + 1;
                $moisGrid = convertMoisEnColone($mois);
                $gridArea = ''.$jour.'/'.$mois.'/'.$jourGrid.'/'.$moisGrid.'';

            echo '
            <article class="articles-evenements" style="
                grid-area: '.$gridArea.';
            ">
                <div class="content-post">
                    <h3 class="title-article"><a target=_blank href='.get_the_permalink().'>'.substr(get_the_title(), 0, 20).'</a></h3>
                    <h4 class=post-date>'.get_the_date().'</h4>
                    <p>Grid : '.$gridArea.'</p>
                </div>
            </article>
            ';
            endwhile;
        echo '</div>';
    endif;

    get_footer();

    function convertMoisEnColone($value){
        switch ($value) {
            case 9:
                return 1;
                break;
            case 10:
                return 2;
                break;
            case 11:
                return 3;
                break;
            default: 
                return 0;
                break;
        }
    }
?>