<?php
/**
 * Template page 404 - Page introuvable
 */
get_header();
?>

<div class="zone-principale">
    <div class="conteneur">
        <div class="aucun-resultat" style="padding:80px 20px;">
            <div style="font-size:5rem; font-family:var(--police-titre); color:var(--couleur-accent); font-weight:bold;">404</div>
            <h2 style="font-size:1.8rem; margin:16px 0;">Page introuvable</h2>
            <p style="max-width:480px; margin:0 auto 28px;">
                La page que vous cherchez n'existe pas ou a été déplacée.
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Retour à l'accueil</a>
            <div style="margin-top:40px; max-width:400px; margin-left:auto; margin-right:auto;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
