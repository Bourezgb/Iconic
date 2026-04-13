/**
 * ICONIC Theme - Main JavaScript
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Remove no-js class
        document.documentElement.classList.remove('no-js');
        document.body.classList.add('js-enabled');

        // Initialize modules
        initHeader();
        initMobileMenu();
        initSearch();
        initAnimations();
        initSmoothScroll();
    });

    /**
     * Header scroll effect
     */
    function initHeader() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        }, { passive: true });
    }

    /**
     * Mobile menu toggle
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const menuClose = document.querySelector('.menu-close');
        const mobileMenu = document.querySelector('.mobile-menu-overlay');

        if (!menuToggle || !mobileMenu) return;

        function openMenu() {
            mobileMenu.classList.add('active');
            menuToggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            mobileMenu.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        menuToggle.addEventListener('click', openMenu);
        
        if (menuClose) {
            menuClose.addEventListener('click', closeMenu);
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMenu();
            }
        });
    }

    /**
     * Search overlay
     */
    function initSearch() {
        const searchToggle = document.querySelector('.search-toggle');
        const searchClose = document.querySelector('.search-close');
        const searchOverlay = document.querySelector('.search-overlay');

        if (!searchToggle || !searchOverlay) return;

        function openSearch() {
            searchOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus search input
            setTimeout(function() {
                const searchInput = searchOverlay.querySelector('input[type="search"]');
                if (searchInput) searchInput.focus();
            }, 100);
        }

        function closeSearch() {
            searchOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        searchToggle.addEventListener('click', openSearch);
        
        if (searchClose) {
            searchClose.addEventListener('click', closeSearch);
        }

        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                closeSearch();
            }
        });
    }

    /**
     * GSAP Animations
     */
    function initAnimations() {
        if (typeof gsap === 'undefined') return;

        // Register ScrollTrigger
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        // Animate article cards on scroll
        const cards = document.querySelectorAll('.article-card');
        if (cards.length) {
            gsap.from(cards, {
                scrollTrigger: {
                    trigger: '.article-grid',
                    start: 'top 80%',
                },
                y: 60,
                opacity: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out'
            });
        }

        // Animate section headers
        const sectionTitles = document.querySelectorAll('.section-title');
        sectionTitles.forEach(function(title) {
            gsap.from(title, {
                scrollTrigger: {
                    trigger: title,
                    start: 'top 85%',
                },
                x: -30,
                opacity: 0,
                duration: 0.6,
                ease: 'power2.out'
            });
        });

        // Animate manifesto section
        const manifestoQuote = document.querySelector('.manifesto-quote');
        if (manifestoQuote) {
            gsap.from(manifestoQuote, {
                scrollTrigger: {
                    trigger: '.manifesto-section',
                    start: 'top 75%',
                },
                y: 40,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            });
        }

        // Hero content animation
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            gsap.from(heroContent.children, {
                y: 30,
                opacity: 0,
                duration: 0.8,
                stagger: 0.15,
                delay: 0.3,
                ease: 'power3.out'
            });
        }
    }

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

})();
