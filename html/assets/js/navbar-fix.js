// Navbar Toggle Fix for Bootstrap 4 - AGGRESSIVE FIX
document.addEventListener('DOMContentLoaded', function() {
    // Force show navbar toggler on mobile
    function forceShowToggler() {
        const navbarToggler = document.querySelector('.navbar-toggler');
        if (navbarToggler && window.innerWidth < 992) {
            navbarToggler.style.display = 'block';
            navbarToggler.style.visibility = 'visible';
            navbarToggler.style.opacity = '1';
            navbarToggler.style.position = 'relative';
            navbarToggler.style.zIndex = '9999';
        }
    }
    
    // Run on load and resize
    forceShowToggler();
    window.addEventListener('resize', forceShowToggler);
    
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        // Ensure toggler is visible
        forceShowToggler();
        
        navbarToggler.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Navbar toggler clicked!'); // Debug log
            
            // Toggle the 'show' class
            navbarCollapse.classList.toggle('show');
            
            // Update aria-expanded
            const isExpanded = navbarCollapse.classList.contains('show');
            navbarToggler.setAttribute('aria-expanded', isExpanded);
            
            // Add collapsed class to toggler
            if (isExpanded) {
                navbarToggler.classList.remove('collapsed');
            } else {
                navbarToggler.classList.add('collapsed');
            }
        });
        
        // Close navbar when clicking outside
        document.addEventListener('click', function(e) {
            if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e.target)) {
                navbarCollapse.classList.remove('show');
                navbarToggler.setAttribute('aria-expanded', 'false');
                navbarToggler.classList.add('collapsed');
            }
        });
        
        // Close navbar when clicking on nav links
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                navbarCollapse.classList.remove('show');
                navbarToggler.setAttribute('aria-expanded', 'false');
                navbarToggler.classList.add('collapsed');
            });
        });
    } else {
        console.log('Navbar elements not found!'); // Debug log
    }
});
