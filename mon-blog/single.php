<?php
/**
 * Template article unique
 */
get_header();
?>

<div class="zone-principale">
    <div class="conteneur">
        <div class="grille-blog">

            <!-- Article complet -->
            <main id="contenu-principal" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-complet' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'miniature-hero', array( 'class' => 'image-principale', 'alt' => get_the_title() ) ); ?>
                    <?php endif; ?>

                    <div class="article-complet-corps">

                        <!-- Méta -->
                        <div class="meta-article" style="margin-bottom:16px;">
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
                            <span>Par <strong><?php the_author(); ?></strong></span>
                            <span><?php comments_number( 'Aucun commentaire', '1 commentaire', '% commentaires' ); ?></span>
                        </div>

                        <!-- Titre -->
                        <h1><?php the_title(); ?></h1>

                        <!-- Contenu -->
                        <div class="contenu-article">
                            <?php the_content(); ?>
                        </div>

                        <!-- Étiquettes -->
                        <?php
                        $etiquettes = get_the_tags();
                        if ( $etiquettes ) : ?>
                            <div style="margin-top:24px; padding-top:16px; border-top:1px solid var(--couleur-bordure);">
                                <strong>Étiquettes :</strong>
                                <?php foreach ( $etiquettes as $tag ) : ?>
                                    <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                                       style="background:#f0f0f0; padding:3px 10px; border-radius:20px; font-size:0.82rem; color:var(--couleur-texte); margin:0 4px;">
                                        <?php echo esc_html( $tag->name ); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Navigation articles précédent / suivant -->
                        <nav class="nav-articles" aria-label="Navigation entre articles">
                            <?php
                            $prev = get_previous_post();
                            $next = get_next_post();
                            if ( $prev ) :
                            ?>
                                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
                                    &larr; <?php echo esc_html( get_the_title( $prev ) ); ?>
                                </a>
                            <?php else : ?>
                                <span></span>
                            <?php endif; ?>

                            <?php if ( $next ) : ?>
                                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="text-align:right;">
                                    <?php echo esc_html( get_the_title( $next ) ); ?> &rarr;
                                </a>
                            <?php endif; ?>
                        </nav>

                    </div><!-- .article-complet-corps -->
                </article>

                <!-- Section commentaires -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

                <?php endwhile; ?>

            </main>

            <!-- Barre latérale -->
            <aside class="barre-laterale" role="complementary">

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
                        $recents = new WP_Query( array(
                            'posts_per_page'      => 5,
                            'post_status'         => 'publish',
                            'post__not_in'        => array( get_the_ID() ),
                        ) );
                        if ( $recents->have_posts() ) :
                            while ( $recents->have_posts() ) : $recents->the_post();
                                echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
                            endwhile;
                            wp_reset_postdata();
                        endif;
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
