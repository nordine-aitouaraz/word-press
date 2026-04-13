<form class="widget-recherche" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div style="display:flex; gap:8px;">
        <input type="search"
               name="s"
               placeholder="Rechercher un article..."
               value="<?php echo get_search_query(); ?>"
               aria-label="Rechercher"
               style="flex:1; padding:8px 12px; border:1px solid var(--couleur-bordure); border-radius:4px; font-size:0.9rem; outline:none;">
        <button type="submit" style="background:var(--couleur-accent); color:white; border:none; padding:8px 14px; border-radius:4px; cursor:pointer;">
            &#128269;
        </button>
    </div>
</form>
