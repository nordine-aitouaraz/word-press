<footer class="site-footer" role="contentinfo">
    <div class="conteneur">

        <div class="footer-grille">

            <!-- Colonne 1 : À propos du blog -->
            <div class="footer-bloc">
                <h3><?php bloginfo( 'name' ); ?></h3>
                <p><?php bloginfo( 'description' ); ?></p>
                <p style="margin-top:12px; font-size:0.85rem;">
                    Un blog créé avec WordPress et un thème 100% personnalisé.
                </p>
            </div>

            <!-- Colonne 2 : Widget footer-1 ou liens rapides -->
            <div class="footer-bloc">
                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                <?php else : ?>
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a></li>
                        <?php
                        $pages = get_pages();
                        foreach ( $pages as $page ) {
                            echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( $page->post_title ) . '</a></li>';
                        }
                        ?>
                    </ul>
                <?php endif; ?>
            </div>

            <!-- Colonne 3 : Widget footer-2 ou catégories -->
            <div class="footer-bloc">
                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                <?php else : ?>
                    <h3>Catégories</h3>
                    <ul>
                        <?php
                        wp_list_categories( array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => true,
                            'title_li'   => '',
                            'number'     => 6,
                        ) );
                        ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div><!-- .footer-grille -->

        <!-- Barre du bas -->
        <div class="footer-bas">
            <p>
                &copy; <?php echo date( 'Y' ); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                &mdash;
                Propulsé par <a href="https://wordpress.org" target="_blank" rel="noopener">WordPress</a>
                &mdash;
                Thème <strong>Mon Blog</strong> (thème personnalisé)
            </p>
        </div>

    </div><!-- .conteneur -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
