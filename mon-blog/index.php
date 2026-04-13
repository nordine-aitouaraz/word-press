<?php
/**
 * Template principal - Page d'accueil / liste des articles
 */
get_header();
?>

<?php
// Afficher une bannière hero uniquement sur la vraie page d'accueil
if ( is_home() && is_front_page() ) : ?>
<section class="hero">
    <div class="conteneur">
        <h1><?php bloginfo( 'name' ); ?></h1>
        <p><?php bloginfo( 'description' ); ?></p>
        <a href="#articles" class="btn">Lire les articles</a>
    </div>
</section>
<?php endif; ?>

<div class="zone-principale" id="articles">
    <div class="conteneur">
        <div class="grille-blog">

            <!-- Contenu principal -->
            <main id="contenu-principal" role="main">

                <?php if ( is_home() && ! is_front_page() ) : ?>
                    <header>
                        <h1 class="section-titre"><?php single_post_title(); ?></h1>
                    </header>
                <?php elseif ( is_archive() ) : ?>
                    <header>
                        <h1 class="section-titre">
                            <?php
                            if ( is_category() ) {
                                echo 'Catégorie : ' . single_cat_title( '', false );
                            } elseif ( is_tag() ) {
                                echo 'Étiquette : ' . single_tag_title( '', false );
                            } elseif ( is_author() ) {
                                echo 'Articles de : ' . get_the_author();
                            } elseif ( is_date() ) {
                                echo 'Archives : ' . get_the_date( 'F Y' );
                            } else {
                                echo 'Archives';
                            }
                            ?>
                        </h1>
                        <?php the_archive_description( '<div class="description-archive">', '</div>' ); ?>
                    </header>
                <?php else : ?>
                    <h2 class="section-titre">Derniers articles</h2>
                <?php endif; ?>

                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'carte-article' ); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                    <?php the_post_thumbnail( 'miniature-carte', array( 'class' => 'miniature', 'alt' => get_the_title() ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="carte-article-corps">

                                <!-- Méta : catégorie + date + auteur -->
                                <div class="meta-article">
                                    <?php
                                    $categories = get_the_category();
                                    if ( $categories ) :
                                        foreach ( $categories as $cat ) :
                                    ?>
                                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="categorie-badge">
                                            <?php echo esc_html( $cat->name ); ?>
                                        </a>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                                        <?php echo get_the_date( 'd/m/Y' ); ?>
                                    </time>
                                    <span>Par <?php the_author(); ?></span>
                                </div>

                                <!-- Titre -->
                                <h2>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <!-- Extrait -->
                                <p class="extrait"><?php the_excerpt(); ?></p>

                                <!-- Lien lire plus -->
                                <a href="<?php the_permalink(); ?>" class="lien-lire-plus" aria-label="Lire l'article : <?php the_title_attribute(); ?>">
                                    Lire la suite
                                </a>

                            </div><!-- .carte-article-corps -->
                        </article>

                    <?php endwhile; ?>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '&larr; Précédent',
                            'next_text' => 'Suivant &rarr;',
                        ) );
                        ?>
                    </div>

                <?php else : ?>

                    <div class="aucun-resultat">
                        <h2>Aucun article trouvé</h2>
                        <p>Il n'y a pas encore d'articles publiés. Revenez bientôt !</p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn" style="margin-top:16px;">Retour à l'accueil</a>
                    </div>

                <?php endif; ?>

            </main><!-- #contenu-principal -->

            <!-- Barre latérale -->
            <aside class="barre-laterale" role="complementary">

                <!-- Widget recherche -->
                <div class="widget widget-recherche">
                    <h3 class="widget-titre">Rechercher</h3>
                    <?php get_search_form(); ?>
                </div>

                <!-- Catégories -->
                <div class="widget">
                    <h3 class="widget-titre">Catégories</h3>
                    <ul>
                        <?php
                        wp_list_categories( array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => true,
                            'title_li'   => '',
                        ) );
                        ?>
                    </ul>
                </div>

                <!-- Articles récents -->
                <div class="widget">
                    <h3 class="widget-titre">Articles récents</h3>
                    <ul>
                        <?php
                        $articles_recents = new WP_Query( array(
                            'posts_per_page' => 5,
                            'post_status'    => 'publish',
                        ) );
                        if ( $articles_recents->have_posts() ) :
                            while ( $articles_recents->have_posts() ) : $articles_recents->the_post();
                                echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>

                <!-- Widgets WordPress -->
                <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                <?php endif; ?>

            </aside><!-- .barre-laterale -->

        </div><!-- .grille-blog -->
    </div><!-- .conteneur -->
</div><!-- .zone-principale -->

<?php get_footer(); ?>
