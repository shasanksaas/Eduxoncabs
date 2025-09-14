/* ============================================
   MOBILE RESPONSIVE JAVASCRIPT FOR HOMEPAGE
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // MOBILE NAVIGATION ENHANCEMENTS
    // ============================================
    
    // Auto-close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const navCollapse = document.querySelector('.navbar-collapse');
    const navToggler = document.querySelector('.navbar-toggler');
    
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992 && navCollapse.classList.contains('show')) {
                navToggler.click();
            }
        });
    });
    
    // ============================================
    // SMOOTH SCROLLING FOR ANCHOR LINKS
    // ============================================
    
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    
    smoothScrollLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const headerHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // ============================================
    // FORM ENHANCEMENTS FOR MOBILE
    // ============================================
    
    // Auto-resize textareas on mobile
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(function(textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
    
    // Prevent zoom on input focus for iOS
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
        const inputs = document.querySelectorAll('input, select, textarea');
        inputs.forEach(function(input) {
            input.addEventListener('focus', function() {
                if (this.style.fontSize !== '16px') {
                    this.style.fontSize = '16px';
                }
            });
        });
    }
    
    // ============================================
    // MOBILE-SPECIFIC DATE PICKER HANDLING
    // ============================================
    
    // Enhanced date picker for mobile devices
    const dateInputs = document.querySelectorAll('input[type="text"][name="pdate"], input[type="text"][name="ddate"]');
    
    if (window.innerWidth <= 767) {
        dateInputs.forEach(function(input) {
            input.addEventListener('focus', function() {
                // For mobile, we might want to use native date picker
                if ('ontouchstart' in window) {
                    input.type = 'date';
                }
            });
        });
    }
    
    // ============================================
    // MOBILE FORM VALIDATION
    // ============================================
    
    const bookingForm = document.querySelector('.modern-booking-form');
    
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            // Remove previous error states
            requiredFields.forEach(function(field) {
                field.classList.remove('error');
                const errorMsg = field.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            });
            
            // Check each required field
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    // Add error message
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message';
                    errorDiv.style.color = '#dc3545';
                    errorDiv.style.fontSize = '12px';
                    errorDiv.style.marginTop = '4px';
                    errorDiv.textContent = 'This field is required';
                    
                    field.parentNode.appendChild(errorDiv);
                    
                    // Scroll to first error on mobile
                    if (window.innerWidth <= 767) {
                        field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                
                // Show a user-friendly error message
                if (window.innerWidth <= 767) {
                    const toast = createToast('Please fill in all required fields', 'error');
                    document.body.appendChild(toast);
                    setTimeout(() => toast.remove(), 3000);
                }
            }
        });
    }
    
    // ============================================
    // MOBILE TOUCH GESTURES
    // ============================================
    
    // Swipe gestures for mobile navigation (optional enhancement)
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    
    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 100;
        const swipeDistance = touchEndX - touchStartX;
        
        if (Math.abs(swipeDistance) > swipeThreshold) {
            if (swipeDistance > 0 && touchStartX < 50) {
                // Swipe right from left edge - open menu
                if (navCollapse && !navCollapse.classList.contains('show')) {
                    navToggler.click();
                }
            } else if (swipeDistance < 0 && navCollapse && navCollapse.classList.contains('show')) {
                // Swipe left - close menu
                navToggler.click();
            }
        }
    }
    
    // ============================================
    // MOBILE PERFORMANCE OPTIMIZATIONS
    // ============================================
    
    // Throttle scroll events
    let ticking = false;
    
    function updateOnScroll() {
        // Add any scroll-based animations or effects here
        ticking = false;
    }
    
    document.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    });
    
    // ============================================
    // ORIENTATION CHANGE HANDLING
    // ============================================
    
    window.addEventListener('orientationchange', function() {
        // Close mobile menu on orientation change
        if (navCollapse && navCollapse.classList.contains('show')) {
            navToggler.click();
        }
        
        // Resize form elements if needed
        setTimeout(function() {
            const activeElement = document.activeElement;
            if (activeElement && (activeElement.tagName === 'INPUT' || activeElement.tagName === 'SELECT')) {
                activeElement.blur();
                setTimeout(() => activeElement.focus(), 100);
            }
        }, 500);
    });
    
    // ============================================
    // UTILITY FUNCTIONS
    // ============================================
    
    // Create toast notification for mobile
    function createToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `mobile-toast mobile-toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: ${type === 'error' ? '#dc3545' : '#007bff'};
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            z-index: 1100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            animation: slideDown 0.3s ease;
        `;
        toast.textContent = message;
        
        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from { transform: translateX(-50%) translateY(-100%); opacity: 0; }
                to { transform: translateX(-50%) translateY(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);
        
        return toast;
    }
    
    // Check if device is mobile
    function isMobile() {
        return window.innerWidth <= 767 || /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }
    
    // Optimize images for mobile
    function optimizeImagesForMobile() {
        if (isMobile()) {
            const images = document.querySelectorAll('img');
            images.forEach(function(img) {
                // Add lazy loading
                if ('loading' in HTMLImageElement.prototype) {
                    img.loading = 'lazy';
                }
                
                // Add responsive sizing
                if (!img.style.maxWidth) {
                    img.style.maxWidth = '100%';
                    img.style.height = 'auto';
                }
            });
        }
    }
    
    // Initialize mobile optimizations
    optimizeImagesForMobile();
    
    // ============================================
    // MOBILE-SPECIFIC FORM IMPROVEMENTS
    // ============================================
    
    // Auto-advance to next field on mobile
    const timeSelects = document.querySelectorAll('select[name="ptime"], select[name="dtime"]');
    timeSelects.forEach(function(select, index) {
        select.addEventListener('change', function() {
            if (isMobile() && this.value) {
                const nextField = timeSelects[index + 1];
                if (nextField) {
                    setTimeout(() => nextField.focus(), 100);
                }
            }
        });
    });
    
    // Better mobile keyboard handling
    const locationSelects = document.querySelectorAll('select[name="pickuploc"], select[name="droploc"]');
    locationSelects.forEach(function(select) {
        select.addEventListener('change', function() {
            if (isMobile()) {
                // Scroll the changed field into view
                this.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    });
    
});

// ============================================
// MOBILE VIEWPORT HEIGHT FIX
// ============================================

// Fix for mobile viewport height issues
function setMobileViewportHeight() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}

// Set initial value
setMobileViewportHeight();

// Update on resize and orientation change
window.addEventListener('resize', setMobileViewportHeight);
window.addEventListener('orientationchange', function() {
    setTimeout(setMobileViewportHeight, 100);
});
