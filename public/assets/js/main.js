(() => {
  'use strict';

  /* =====================================================
     DOM READY — lógica que NO depende de imágenes
  ===================================================== */
  document.addEventListener('DOMContentLoaded', () => {

    /* ---------- MENU + HEADER ---------- */
    const burgerBtns = document.querySelectorAll('.openSideMenu');
    const menu   = document.querySelector('.menu');
    const links  = document.querySelectorAll('.js-scroll');
    const header = document.querySelector('.Web-Header');
    const hero   = document.querySelector('#section-trigger');

    let forceHeaderVisible = false;

    burgerBtns.forEach(burger => {
      burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        menu?.classList.toggle('active');
        document.body.classList.toggle('menu-open');
      });
    });

    links.forEach(link => {
      link.addEventListener('click', e => {
        const href = link.getAttribute('href');
        if (!href) return;

        // 👉 Extrae el hash del href: soporta "#seccion" y "http://sitio/#seccion"
        const hashIndex = href.indexOf('#');
        if (hashIndex === -1) return;
        const hash = href.slice(hashIndex);

        // 👉 Si el link apunta a OTRA página, dejar que navegue normal
        try {
          const linkUrl = new URL(href, window.location.href);
          const current = window.location.origin + window.location.pathname;
          if (linkUrl.origin + linkUrl.pathname !== current) return;
        } catch {
          return;
        }

        e.preventDefault();

        const target = document.querySelector(hash);
        if (!target || !header) return;

        forceHeaderVisible = true;
        header.classList.add('visible');

        burgerBtns.forEach(b => b.classList.remove('active'));
        menu?.classList.remove('active');
        document.body.classList.remove('menu-open');

        const offset =
          target.getBoundingClientRect().top +
          window.pageYOffset -
          header.offsetHeight;

        window.scrollTo({ top: offset, behavior: 'smooth' });

        setTimeout(() => forceHeaderVisible = false, 600);
      });
    });

    if (hero && header) {
      const observer = new IntersectionObserver(([entry]) => {
        if (!forceHeaderVisible) {
          header.classList.toggle('visible', !entry.isIntersecting);
        }
      });
      observer.observe(hero);
    }

    /* ---------- FONDO DEL HERO (editado desde el panel) ---------- */
    const heroBgMeta = document.querySelector('meta[name="hero-bg"]');
    if (heroBgMeta && heroBgMeta.content && hero) {
      hero.style.backgroundImage = 'url(' + heroBgMeta.content + ')';
    }

  });

  /* =====================================================
     WINDOW LOAD — assets, sliders, preload
  ===================================================== */
  window.addEventListener('load', () => {

    /* ---------- PRELOADER ---------- */
    const preloader = document.getElementById('preloader');
    if (preloader) {
      setTimeout(() => {
        preloader.classList.add('hide');
        setTimeout(() => preloader.remove(), 700);
      }, 400);
    }

    /* ---------- TINY SLIDER ---------- */
    if (window.tns) {

      if (document.querySelector('.carrusel_temas')) {
        tns({
          container: '.carrusel_temas',
          items: 3,
          loop: true,
          autoplay: true,
          autoplayButton: false,
          autoplayButtonOutput: false,
          autoplayTimeout: 3000,
          controls: false,
          // controlsContainer: '.carrusel_galeria_control',
          nav: false,
          gutter: 15,
          speed: 1000,
          center: true,
          autoWidth: true
        });
      }

      if (document.querySelector('.carrusel_testimonios')) {
        tns({
          container: '.carrusel_testimonios',
          items: 1,
          loop: true,
          autoplay: true,
          autoplayButton: false,
          autoplayButtonOutput: false,
          autoplayTimeout: 3000,
          controls: false,
          // controlsContainer: '.carrusel_galeria_control',
          nav: false,
          gutter: 40,
          speed: 1000,
          autoWidth: true
        });
      }

    }

  });

})();
