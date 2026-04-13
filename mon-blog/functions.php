<?php
/**
 * Fonctions du thème Mon Blog
 */

// Empêcher l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* =========================================
   CONFIGURATION DU THÈME
   ========================================= */
function mon_blog_setup() {

    // Traductions (prêt pour l'internationalisation)
    load_theme_textdomain( 'mon-blog', get_template_directory() . '/languages' );

    // Titre dynamique dans l'onglet du navigateur
    add_theme_support( 'title-tag' );

    // Vignettes d'articles (images à la une)
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'miniature-carte', 800, 440, true );
    add_image_size( 'miniature-hero', 1200, 500, true );

    // Formats d'articles
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'video' ) );

    // Logo personnalisé
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 sémantique
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    // Flux RSS automatiques
    add_theme_support( 'automatic-feed-links' );

    // Enregistrement des menus de navigation
    register_nav_menus( array(
        'menu-principal' => __( 'Menu Principal', 'mon-blog' ),
        'menu-footer'    => __( 'Menu Pied de page', 'mon-blog' ),
    ) );
}
add_action( 'after_setup_theme', 'mon_blog_setup' );

/* =========================================
   LARGEUR DU CONTENU
   ========================================= */
function mon_blog_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'mon_blog_content_width', 720 );
}
add_action( 'after_setup_theme', 'mon_blog_content_width', 0 );

/* =========================================
   CHARGEMENT DES STYLES ET SCRIPTS
   ========================================= */
function mon_blog_scripts() {
    // Feuille de style principale
    wp_enqueue_style(
        'mon-blog-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Police Google Fonts (optionnel)
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;600&display=swap',
        array(),
        null
    );

    // Script de navigation mobile (hamburger)
    wp_enqueue_script(
        'mon-blog-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'mon_blog_scripts' );

/* =========================================
   ENREGISTREMENT DES WIDGETS (SIDEBAR)
   ========================================= */
function mon_blog_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Barre latérale principale', 'mon-blog' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets affichés dans la barre latérale', 'mon-blog' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-titre">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Pied de page - Colonne 1', 'mon-blog' ),
        'id'            => 'footer-1',
        'description'   => __( 'Première colonne du pied de page', 'mon-blog' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Pied de page - Colonne 2', 'mon-blog' ),
        'id'            => 'footer-2',
        'description'   => __( 'Deuxième colonne du pied de page', 'mon-blog' ),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'mon_blog_widgets_init' );

/* =========================================
   EXTRAIT PERSONNALISÉ
   ========================================= */
function mon_blog_longueur_extrait( $length ) {
    return 30; // Nombre de mots dans l'extrait
}
add_filter( 'excerpt_length', 'mon_blog_longueur_extrait' );

function mon_blog_suite_extrait( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'mon_blog_suite_extrait' );

/* =========================================
   TITRE DE PAGE POUR LES ARCHIVES
   ========================================= */
function mon_blog_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'mon_blog_archive_title' );

/* =========================================
   CLASSES CSS PERSONNALISÉES SUR BODY
   ========================================= */
function mon_blog_body_classes( $classes ) {
    if ( is_singular() ) {
        $classes[] = 'page-singuliere';
    }
    if ( is_home() || is_archive() || is_search() ) {
        $classes[] = 'page-liste';
    }
    return $classes;
}
add_filter( 'body_class', 'mon_blog_body_classes' );
