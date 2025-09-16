<header id="header" class="mobile-app-header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-57px', 'stickyChangeLogo': true}">
    <div class="header-body">
      <div class="header-container container-fluid">
        <div class="header-row mobile-app-row">
          <!-- Logo Section -->
          <div class="header-column logo-column">
            <div class="header-logo"> 
              <a href="index.php"> 
                <img alt="EduxonCabs" width="110px" height="40px" src="img/Eduxoncabs.png"> 
              </a> 
            </div>
          </div>
          
          <!-- Mobile Menu Toggle (Right Side) -->
          <div class="header-column mobile-menu-column">
            <button class="btn mobile-app-menu-toggle" data-toggle="collapse" data-target=".mobile-app-nav" aria-expanded="false"> 
              <i class="fa fa-bars"></i> 
            </button>
          </div>
          
          <!-- Desktop Navigation -->
          <div class="header-column desktop-nav-column">
            <div class="header-row">
              <div class="header-nav header-nav-dark-dropdown">
                <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                  <nav>
                    <ul class="nav nav-pills" id="mainNav">
                      <li><a href="/">Home</a></li>
                      <li><a href="about-us.php">About Us</a></li>
                      <li class="dropdown">
                        <a class="dropdown-toggle" href="all-cars-for-self-drive-bhubaneswar.php">All Cars</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-submenu">
                            <a href="#" style="color:#fff;">Bhubaneswar</a>
                            <ul class="dropdown-menu">
                              <li><a href="all-cars-for-self-drive-bhubaneswar.php" style="color:#fff;">Airport Location</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li><a href="all-bikes-bike-for-rental-bhubaneswar.php">All Bikes</a></li>
                      <li><a href="contact-us.php">Contact</a></li>
                      <li><a href="profile.php">Profile</a></li>
                      <li><a href="faq.php">FAQ</a></li>
                      <li><a href="https://razorpay.me/@eduxoncars" target="_blank" rel="noopener noreferrer">Pay Now</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Mobile App-Style Navigation Overlay -->
    <div class="mobile-app-nav collapse">
      <div class="mobile-app-nav-overlay"></div>
      <div class="mobile-app-nav-content">
        <div class="mobile-app-nav-header">
          <div class="mobile-app-nav-logo">
            <img src="img/Eduxoncabs.png" alt="EduxonCabs" height="35">
          </div>
          <button class="mobile-app-nav-close" data-toggle="collapse" data-target=".mobile-app-nav">
            <i class="fa fa-times"></i>
          </button>
        </div>
        
        <nav class="mobile-app-nav-menu">
          <ul>
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="about-us.php"><i class="fa fa-info-circle"></i> About Us</a></li>
            <li><a href="all-cars-for-self-drive-bhubaneswar.php"><i class="fa fa-car"></i> All Cars</a></li>
            <li><a href="all-bikes-bike-for-rental-bhubaneswar.php"><i class="fa fa-motorcycle"></i> All Bikes</a></li>
            <li><a href="contact-us.php"><i class="fa fa-phone"></i> Contact</a></li>
            <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="faq.php"><i class="fa fa-question-circle"></i> FAQ</a></li>
            <li><a href="https://razorpay.me/@eduxoncars" target="_blank"><i class="fa fa-credit-card"></i> Pay Now</a></li>
          </ul>
        </nav>
        
        <div class="mobile-app-nav-footer">
          <div class="mobile-contact-info">
            <p><i class="fa fa-phone"></i> +91-9437144274</p>
            <p><i class="fa fa-envelope"></i> eduxontechnologies@gmail.com</p>
          </div>
        </div>
      </div>
    </div>
  </header>

  <style>
  /* Mobile App Header Styles */
  .mobile-app-header {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000; /* Lower than mobile menu but higher than content */
    transition: transform 0.3s ease-in-out;
    transform: translateY(0);
  }
  
  /* Smart navbar states */
  .mobile-app-header.navbar-hidden {
    transform: translateY(-100%);
  }
  
  .mobile-app-header.navbar-visible {
    transform: translateY(0);
  }

  .mobile-app-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 15px;
    min-height: 60px;
  }

  .logo-column {
    flex: 0 0 auto;
  }

  .mobile-menu-column {
    flex: 0 0 auto;
    display: none !important; /* Hide by default - only show on mobile */
    margin-left: auto;
  }

  .desktop-nav-column {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  .mobile-app-menu-toggle {
    background: transparent;
    border: none;
    font-size: 20px;
    color: #333;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .mobile-app-menu-toggle:hover {
    background: #f1f5f9;
    color: #2563eb;
  }

  /* Mobile App Navigation Overlay */
  .mobile-app-nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999999 !important; /* Extremely high z-index */
    display: none;
    pointer-events: none; /* Allow events only when shown */
  }

  .mobile-app-nav.show {
    display: block !important;
    pointer-events: all; /* Enable all pointer events when shown */
  }

  .mobile-app-nav-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(6px);
    z-index: 999998 !important;
    cursor: pointer;
  }

  .mobile-app-nav-content {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    background: #fff;
    box-shadow: 4px 0 30px rgba(0,0,0,0.2);
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    z-index: 999999 !important;
    overflow-y: auto;
  }

  .mobile-app-nav.show .mobile-app-nav-content {
    transform: translateX(0);
  }

  .mobile-app-nav-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    background: #f8fafc;
  }

  .mobile-app-nav-close {
    background: transparent;
    border: none;
    font-size: 18px;
    color: #6b7280;
    padding: 8px;
    border-radius: 4px;
  }

  .mobile-app-nav-close:hover {
    background: #e5e7eb;
    color: #374151;
  }

  .mobile-app-nav-menu {
    flex: 1;
    padding: 20px 0;
    overflow-y: auto;
  }

  .mobile-app-nav-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .mobile-app-nav-menu li {
    margin: 0;
  }

  .mobile-app-nav-menu a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
  }

  .mobile-app-nav-menu a:hover,
  .mobile-app-nav-menu a:focus {
    background: #f1f5f9;
    color: #2563eb;
    border-left-color: #2563eb;
    text-decoration: none;
  }

  .mobile-app-nav-menu i {
    margin-right: 12px;
    font-size: 16px;
    width: 20px;
    text-align: center;
    color: #6b7280;
  }

  .mobile-app-nav-menu a:hover i {
    color: #2563eb;
  }

  .mobile-app-nav-footer {
    padding: 20px;
    border-top: 1px solid #e5e7eb;
    background: #f8fafc;
  }

  .mobile-contact-info p {
    margin: 8px 0;
    color: #6b7280;
    font-size: 14px;
    display: flex;
    align-items: center;
  }

  .mobile-contact-info i {
    margin-right: 8px;
    width: 16px;
    color: #2563eb;
  }

  /* Mobile Responsive */
  @media (max-width: 991px) {
    .mobile-menu-column {
      display: block !important; /* Only show on mobile */
      margin-left: auto !important;
    }
    
    .desktop-nav-column {
      display: none !important; /* Hide desktop nav on mobile */
    }
    
    /* CRITICAL FIX: Force mobile header row to flex and push burger to far right */
    #header .header-row.mobile-app-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      width: 100% !important;
    }
    
    /* Ensure logo stays on left */
    #header .header-row.mobile-app-row .logo-column {
      order: 1 !important;
      flex: 0 0 auto !important;
    }
    
    /* Push mobile menu column to far right */
    #header .header-row.mobile-app-row .mobile-menu-column {
      order: 3 !important;
      flex: 0 0 auto !important;
      margin-left: auto !important;
    }
    
    .mobile-app-row {
      padding: 8px 15px;
      min-height: 56px;
      justify-content: space-between;
    }
    
    .header-logo img {
      width: 100px !important;
      height: 36px !important;
    }
  }

  @media (min-width: 992px) {
    .mobile-menu-column {
      display: none !important; /* Ensure mobile menu is hidden on desktop */
    }
    
    .desktop-nav-column {
      display: flex !important; /* Ensure desktop nav shows on desktop */
    }
    
    .mobile-app-nav {
      display: none !important; /* Hide mobile nav overlay on desktop */
    }
  }

  @media (max-width: 768px) {
    .mobile-app-nav-content {
      width: 260px;
    }
    
    .mobile-app-row {
      padding: 8px 12px;
      justify-content: space-between; /* Maintain alignment on smaller screens */
    }
  }

  /* Close mobile menu when clicking overlay */
  .mobile-app-nav-overlay {
    cursor: pointer;
  }

  /* Prevent body scroll when mobile menu is open */
  body.mobile-menu-open {
    overflow: hidden !important;
    position: fixed !important;
    width: 100% !important;
    height: 100% !important;
  }

  /* Ensure mobile menu is above all content */
  .mobile-app-nav.show {
    display: block !important;
    z-index: 999999 !important;
  }

  /* Hide all content behind mobile menu when open */
  body.mobile-menu-open .body,
  body.mobile-menu-open .main,
  body.mobile-menu-open .container,
  body.mobile-menu-open .compact-filter-section {
    pointer-events: none !important;
    user-select: none !important;
  }
  
  /* CRITICAL FIX: Lower filter section z-index when mobile menu is open */
  body.mobile-menu-open .compact-filter-section {
    z-index: 1 !important;
    position: relative !important;
  }

  /* Ensure mobile menu content is always interactive */
  .mobile-app-nav-content * {
    pointer-events: all !important;
    user-select: auto !important;
  }
  </style>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.querySelector('.mobile-app-nav-overlay');
    const mobileNav = document.querySelector('.mobile-app-nav');
    const menuToggle = document.querySelector('.mobile-app-menu-toggle');
    const closeBtn = document.querySelector('.mobile-app-nav-close');
    
    // Store original body styles
    let originalBodyStyle = '';
    
    function closeMobileMenu() {
      if (mobileNav) {
        mobileNav.classList.remove('show');
        document.body.classList.remove('mobile-menu-open');
        // Restore original body style
        if (originalBodyStyle) {
          document.body.setAttribute('style', originalBodyStyle);
        } else {
          document.body.removeAttribute('style');
        }
      }
    }
    
    function openMobileMenu() {
      if (mobileNav) {
        // Store current body style
        originalBodyStyle = document.body.getAttribute('style') || '';
        
        mobileNav.classList.add('show');
        document.body.classList.add('mobile-menu-open');
        
        // Prevent any scrolling and fix position
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '0';
        document.body.style.left = '0';
        document.body.style.width = '100%';
        document.body.style.height = '100%';
      }
    }
    
    // Event listeners
    if (overlay) {
      overlay.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeMobileMenu();
      });
    }
    
    if (menuToggle) {
      menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if (mobileNav && mobileNav.classList.contains('show')) {
          closeMobileMenu();
        } else {
          openMobileMenu();
        }
      });
    }
    
    if (closeBtn) {
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeMobileMenu();
      });
    }
    
    // Close menu when clicking on internal links
    const menuLinks = document.querySelectorAll('.mobile-app-nav-menu a:not([target="_blank"])');
    menuLinks.forEach(link => {
      link.addEventListener('click', function() {
        setTimeout(() => {
          closeMobileMenu();
        }, 150);
      });
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('show')) {
        closeMobileMenu();
      }
    });
    
    // Prevent scroll on mobile when menu is open
    document.addEventListener('touchmove', function(e) {
      if (document.body.classList.contains('mobile-menu-open')) {
        e.preventDefault();
      }
    }, { passive: false });
    
    // Smart navbar - hide on scroll down, show on scroll up
    let lastScrollTop = 0;
    let scrollThreshold = 5; // Reduced threshold for more responsive behavior
    const header = document.getElementById('header');
    
    function handleSmartNavbar() {
      const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollDiff = Math.abs(currentScrollTop - lastScrollTop);
      
      // Only trigger if scroll difference is significant enough
      if (scrollDiff < scrollThreshold) {
        return;
      }
      
      // Always show navbar at the very top of the page
      if (currentScrollTop <= 50) {
        header.classList.remove('navbar-hidden');
        header.classList.add('navbar-visible');
      } else {
        // Scrolling down - hide navbar (only if scrolling down significantly)
        if (currentScrollTop > lastScrollTop && scrollDiff > 8) {
          header.classList.add('navbar-hidden');
          header.classList.remove('navbar-visible');
        }
        // Scrolling up - show navbar immediately (even small upward scrolls)
        else if (currentScrollTop < lastScrollTop) {
          header.classList.remove('navbar-hidden');
          header.classList.add('navbar-visible');
        }
      }
      
      lastScrollTop = currentScrollTop;
    }
    
    // Throttle scroll events for better performance
    let scrollTimer = null;
    window.addEventListener('scroll', function() {
      if (scrollTimer !== null) {
        clearTimeout(scrollTimer);
      }
      scrollTimer = setTimeout(handleSmartNavbar, 10);
    });
    
    // Initialize navbar state
    header.classList.add('navbar-visible');
  });
  </script>