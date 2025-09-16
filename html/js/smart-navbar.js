/**
 * Smart Navbar - Auto Hide/Show on Scroll
 * Hides navbar when scrolling down, shows when scrolling up
 */

(function() {
    'use strict';
    
    let lastScrollTop = 0;
    let scrollThreshold = 10; // Minimum scroll distance to trigger
    let isScrolling = false;
    
    const navbar = document.querySelector('.navbar.fixed-top');
    
    if (!navbar) {
        console.warn('Smart Navbar: No fixed navbar found');
        return;
    }
    
    // Throttle scroll events for better performance
    function throttle(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    function handleNavbarVisibility() {
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Prevent negative scrolling (bounce effect on mobile)
        if (currentScrollTop < 0) {
            return;
        }
        
        // Don't hide navbar when at the very top
        if (currentScrollTop <= 100) {
            navbar.classList.remove('navbar-hidden', 'scrolled');
            navbar.classList.add('navbar-visible');
            return;
        }
        
        // Add scrolled class when past threshold
        navbar.classList.add('scrolled');
        
        // Calculate scroll direction and distance
        const scrollDirection = currentScrollTop > lastScrollTop ? 'down' : 'up';
        const scrollDistance = Math.abs(currentScrollTop - lastScrollTop);
        
        // Only trigger if scroll distance is greater than threshold
        if (scrollDistance > scrollThreshold) {
            if (scrollDirection === 'down') {
                // Scrolling down - hide navbar
                navbar.classList.add('navbar-hidden');
                navbar.classList.remove('navbar-visible');
            } else {
                // Scrolling up - show navbar
                navbar.classList.remove('navbar-hidden');
                navbar.classList.add('navbar-visible');
            }
        }
        
        lastScrollTop = currentScrollTop;
    }
    
    // Throttled scroll handler
    const throttledScrollHandler = throttle(handleNavbarVisibility, 16); // ~60fps
    
    // Initial state
    navbar.classList.add('navbar-visible');
    
    // Add scroll event listener
    window.addEventListener('scroll', throttledScrollHandler, { passive: true });
    
    // Handle navbar state on page load
    document.addEventListener('DOMContentLoaded', function() {
        handleNavbarVisibility();
    });
    
    // Optional: Add touch support for mobile devices
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        touchEndY = e.changedTouches[0].screenY;
        
        // Determine swipe direction
        const swipeDistance = Math.abs(touchEndY - touchStartY);
        
        if (swipeDistance > 50) { // Minimum swipe distance
            if (touchEndY > touchStartY) {
                // Swiping down - show navbar
                navbar.classList.remove('navbar-hidden');
                navbar.classList.add('navbar-visible');
            } else {
                // Swiping up - could hide navbar (but let scroll handle it)
                // This prevents accidental hiding during touch scrolling
            }
        }
    }, { passive: true });
    
})();