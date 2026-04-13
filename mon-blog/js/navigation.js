/**
 * Navigation responsive - Menu hamburger mobile
 */
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.nav-principale');
    if (!nav) return;

    // Créer le bouton hamburger
    const bouton = document.createElement('button');
    bouton.setAttribute('aria-controls', 'menu-nav-principal');
    bouton.setAttribute('aria-expanded', 'false');
    bouton.setAttribute('aria-label', 'Ouvrir le menu');
    bouton.innerHTML = '&#9776;';
    bouton.style.cssText = [
        'display:none',
        'background:transparent',
        'border:none',
        'color:white',
        'font-size:1.4rem',
        'cursor:pointer',
        'padding:8px',
    ].join(';');

    nav.insertBefore(bouton, nav.firstChild);

    const menu = document.getElementById('menu-nav-principal');
    if (!menu) return;

    // Afficher le bouton sur mobile
    function gererResponsive() {
        if (window.innerWidth <= 768) {
            bouton.style.display = 'block';
            const estOuvert = bouton.getAttribute('aria-expanded') === 'true';
            menu.style.display = estOuvert ? 'flex' : 'none';
            if (estOuvert) {
                menu.style.flexDirection = 'column';
                menu.style.position = 'absolute';
                menu.style.top = '64px';
                menu.style.left = '0';
                menu.style.right = '0';
                menu.style.background = '#2c3e50';
                menu.style.padding = '8px 24px 16px';
            }
        } else {
            bouton.style.display = 'none';
            menu.style.display = '';
            menu.style.flexDirection = '';
            menu.style.position = '';
        }
    }

    bouton.addEventListener('click', function () {
        const estOuvert = bouton.getAttribute('aria-expanded') === 'true';
        bouton.setAttribute('aria-expanded', !estOuvert);
        bouton.setAttribute('aria-label', estOuvert ? 'Ouvrir le menu' : 'Fermer le menu');
        gererResponsive();
    });

    window.addEventListener('resize', gererResponsive);
    gererResponsive();
});
