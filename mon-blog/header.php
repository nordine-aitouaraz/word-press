<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="conteneur">
        <div class="header-inner">

            <!-- Logo / Titre du site -->
            <div class="site-titre">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <?php
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description ) : ?>
                        <p class="site-description-header"><?php echo esc_html( $description ); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <!-- Navigation principale -->
            <nav class="nav-principale" aria-label="Navigation principale">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-principal',
                    'menu_id'        => 'menu-nav-principal',
                    'container'      => false,
                    'fallback_cb'    => 'mon_blog_menu_defaut',
                ) );
                ?>
            </nav>

        </div><!-- .header-inner -->
    </div><!-- .conteneur -->
</header>

<?php
// Menu par défaut si aucun menu n'est configuré dans WordPress
function mon_blog_menu_defaut() {
    echo '<ul>';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Accueil</a></li>';
    // Récupère les pages publiées
    $pages = get_pages( array( 'sort_column' => 'menu_order' ) );
    foreach ( $pages as $page ) {
        echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( $page->post_title ) . '</a></li>';
    }
    echo '</ul>';
}
