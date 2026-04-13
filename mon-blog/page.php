<?php
/**
 * Template pour les pages statiques (À propos, Contact, etc.)
 */
get_header();
?>

<div class="zone-principale">
    <div class="conteneur">
        <div class="grille-blog">

            <main id="contenu-principal" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-contenu' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'miniature-hero', array( 'class' => 'image-principale', 'style' => 'border-radius:8px; margin-bottom:28px;', 'alt' => get_the_title() ) ); ?>
                    <?php endif; ?>

                    <h1><?php the_title(); ?></h1>

                    <div class="contenu-article">
                        <?php the_content(); ?>
                    </div>

                </article>

                <?php endwhile; ?>

            </main>

            <!-- Barre latérale -->
            <aside class="barre-laterale" role="complementary">

                <div class="widget">
                    <h3 class="widget-titre">Navigation</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a></li>
                        <?php
                        $pages = get_pages( array( 'sort_column' => 'menu_order' ) );
                        foreach ( $pages as $p ) {
                            $current = ( $p->ID === get_the_ID() ) ? ' style="color:var(--couleur-accent); font-weight:600;"' : '';
                            echo '<li><a href="' . esc_url( get_permalink( $p->ID ) ) . '"' . $current . '>' . esc_html( $p->post_title ) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

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

                <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                <?php endif; ?>

            </aside>

        </div><!-- .grille-blog -->
    </div><!-- .conteneur -->
</div><!-- .zone-principale -->

<?php get_footer(); ?>
