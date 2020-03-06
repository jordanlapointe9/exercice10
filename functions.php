<?php
/* 
 Permet d'adapter la requête principale avant qu'elle
 ne s'exécute.
- La liste de conférences pourra s'afficher entièrement sur un page
- Elle sera triée selon la date des conférences
- En ordre ascendant
 */
function extraire_evenements( $query ) {
    if ($query->is_category('evenements'))
    {
       $query->set( 'posts_per_page', -1 );
       $query->set( 'orderby', 'date' );
       $query->set( 'order', 'asc' );
    }
 }
 add_action( 'pre_get_posts', 'extraire_evenements' );

?>