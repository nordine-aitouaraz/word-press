<?php
/**
 * Template résultats de recherche
 */
get_header();
?>

<div class="zone-principale">
    <div class="conteneur">
        <div class="grille-blog">

            <main id="contenu-principal" role="main">

                <h1 class="section-titre">
                    <?php
                    if ( get_search_query() ) {
                        echo 'Résultats pour : <em>' . esc_html( get_search_query() ) . '</em>';
                    } else {
                        echo 'Recherche';
                    }
                    ?>
                </h1>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'carte-article' ); ?>>
                            <div class="carte-article-corps">
                                <div class="meta-article">
                                    <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date( 'd/m/Y' ); ?></time>
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="extrait"><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="lien-lire-plus">Lire la suite</a>
                            </div>
                        </article>

                    <?php endwhile; ?>

                    <div class="pagination">
                        <?php the_posts_pagination( array( 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
                    </div>

                <?php else : ?>
                    <div class="aucun-resultat">
                        <h2>Aucun résultat</h2>
                        <p>Votre recherche "<strong><?php echo esc_html( get_search_query() ); ?></strong>" n'a retourné aucun résultat.</p>
                        <div style="margin-top:24px;">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            </main>

            <aside class="barre-laterale" role="complementary">
                <div class="widget widget-recherche">
                    <h3 class="widget-titre">Nouvelle recherche</h3>
                    <?php get_search_form(); ?>
                </div>
                <div class="widget">
                    <h3 class="widget-titre">Catégories</h3>
                    <ul>
                        <?php wp_list_categories( array( 'show_count' => true, 'title_li' => '' ) ); ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</div>

<?php get_footer(); ?>
