<header id="header" class="mobile-app-header">
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
  /* Global body adjustment for fixed header */
  body {
    padding-top: 50px !important; /* REDUCED from 70px */
  }
  
  /* Mobile App Header Styles - ALWAYS STICKY */
  .mobile-app-header {
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed !important;
    top: 0 !important;
    left: 0;
    right: 0;
    z-index: 9999 !important;
    transition: none !important;
    transform: translateY(0) !important;
    min-height: 50px !important; /* REDUCED from 60px */
    height: 50px !important; /* FIXED HEIGHT */
  }
  
  /* CRITICAL: Override smart navbar behavior completely */
  .mobile-app-header.navbar-hidden,
  .mobile-app-header.navbar-visible,
  .mobile-app-header.scrolled {
    transform: translateY(0) !important; /* NO MOVEMENT EVER */
    transition: none !important;
    top: 0 !important;
  }

  .mobile-app-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 15px !important; /* REDUCED padding */
    min-height: 50px !important; /* REDUCED height */
    height: 50px !important; /* FIXED HEIGHT */
  }

  .logo-column {
    flex: 0 0 auto;
  }

  .mobile-menu-column {
    flex: 0 0 auto;
    display: none !important;
    margin-left: auto;
  }

  .desktop-nav-column {
    flex: 1;
    display: flex;
    justify-content: center;
  }

  /* SMALLER logo */
  .header-logo img {
    width: 95px !important; /* REDUCED from 110px */
    height: 35px !important; /* REDUCED from 40px */
  }

  .mobile-app-menu-toggle {
    background: transparent;
    border: none;
    font-size: 18px !important; /* REDUCED from 20px */
    color: #333;
    padding: 6px 10px !important; /* REDUCED padding */
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
    z-index: 999999 !important;
    display: none;
    pointer-events: none;
  }

  .mobile-app-nav.show {
    display: block !important;
    pointer-events: all;
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
    body {
      padding-top: 45px !important; /* EVEN SMALLER for mobile */
    }
    
    .mobile-menu-column {
      display: block !important;
      margin-left: auto !important;
    }
    
    .desktop-nav-column {
      display: none !important;
    }
    
    .mobile-app-header {
      min-height: 45px !important; /* SMALLER mobile header */
      height: 45px !important;
    }
    
    #header .header-row.mobile-app-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      width: 100% !important;
      min-height: 45px !important;
      height: 45px !important;
    }
    
    #header .header-row.mobile-app-row .logo-column {
      order: 1 !important;
      flex: 0 0 auto !important;
    }
    
    #header .header-row.mobile-app-row .mobile-menu-column {
      order: 3 !important;
      flex: 0 0 auto !important;
      margin-left: auto !important;
    }
    
    .mobile-app-row {
      padding: 6px 15px !important; /* SMALLER padding for mobile */
      min-height: 45px !important;
      height: 45px !important;
      justify-content: space-between;
    }
    
    .header-logo img {
      width: 90px !important; /* SMALLER for mobile */
      height: 32px !important;
    }
  }

  @media (min-width: 992px) {
    .mobile-menu-column {
      display: none !important;
    }
    
    .desktop-nav-column {
      display: flex !important;
    }
    
    .mobile-app-nav {
      display: none !important;
    }
  }

  @media (max-width: 768px) {
    .mobile-app-nav-content {
      width: 260px;
    }
    
    .mobile-app-row {
      padding: 6px 12px !important;
      justify-content: space-between;
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
  
  body.mobile-menu-open .compact-filter-section {
    z-index: 1 !important;
    position: relative !important;
  }

  /* Ensure mobile menu content is always interactive */
  .mobile-app-nav-content * {
    pointer-events: all !important;
    user-select: auto !important;
  }

  /* Beautiful desktop dropdowns */
  @media (min-width: 992px) {
    .header-nav .dropdown::after {
      content: '' !important;
      position: absolute !important;
      left: 0 !important; 
      right: 0 !important;
      bottom: -15px !important;
      height: 15px !important;
      z-index: 2001 !important;
    }
    
    .header-nav .dropdown { position: relative; }

    .header-nav .dropdown-menu {
      position: absolute !important;
      top: 100% !important;
      left: 0 !important;
      display: block !important;
      opacity: 0 !important;
      visibility: hidden !important;
      transform: translateY(5px) scale(0.98) !important;
      pointer-events: none !important;
      background: #ffffff !important;
      min-width: 320px !important;
      padding: 10px 6px !important;
      margin-top: 0px !important;
      border-radius: 14px !important;
      border: 1px solid rgba(0,0,0,0.08) !important;
      box-shadow: 0 24px 48px rgba(2, 6, 23, 0.18), 0 8px 16px rgba(2, 6, 23, 0.12) !important;
      transition: opacity 250ms cubic-bezier(0.4,0,0.2,1),
                  transform 250ms cubic-bezier(0.4,0,0.2,1),
                  visibility 0s linear 250ms !important;
      z-index: 2000 !important;
      backdrop-filter: saturate(120%) blur(8px);
    }

    .header-nav .dropdown:hover > .dropdown-menu {
      opacity: 1 !important;
      visibility: visible !important;
      transform: translateY(0) scale(1) !important;
      pointer-events: auto !important;
      transition-delay: 0s, 0s, 0s !important;
    }
    
    .header-nav .dropdown-menu:hover {
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: auto !important;
    }

    .header-nav .dropdown-menu > li { list-style: none !important; }
    .header-nav .dropdown-menu > li + li { margin-top: 2px !important; }
    .header-nav .dropdown-menu a {
      display: block !important;
      padding: 12px 16px !important;
      margin: 0 8px !important;
      border-radius: 10px !important;
      text-decoration: none !important;
      font-weight: 600 !important;
      font-size: 14px !important;
      color: #1f2937 !important;
      transition: transform 140ms ease, background-color 160ms ease, color 160ms ease !important;
    }
    .header-nav .dropdown-menu a:hover {
      background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%) !important;
      color: #2563eb !important;
      transform: translateX(4px) !important;
    }

    .header-nav .dropdown-submenu { position: relative !important; }
    .header-nav .dropdown-submenu > .dropdown-menu {
      top: -8px !important;
      left: calc(100% + 5px) !important;
      margin-top: 0 !important;
      min-width: 260px !important;
      transform: translateY(0) scale(0.98) !important;
      transition-delay: 0.1s !important;
    }
    
    .header-nav .dropdown-submenu::after {
      content: '' !important;
      position: absolute !important;
      top: 0 !important;
      right: -10px !important;
      bottom: 0 !important;
      width: 15px !important;
      z-index: 2001 !important;
    }
    .header-nav .dropdown-submenu:hover > .dropdown-menu {
      opacity: 1 !important;
      visibility: visible !important;
      transform: translateY(0) scale(1) !important;
      pointer-events: auto !important;
      transition-delay: 0s !important;
    }
    
    .header-nav .dropdown-menu {
      transition: opacity 250ms cubic-bezier(0.4,0,0.2,1),
                  transform 250ms cubic-bezier(0.4,0,0.2,1),
                  visibility 0s linear 500ms !important;
    }

    .header-nav .dropdown-submenu > a { position: relative !important; }
    .header-nav .dropdown-submenu > a::after {
      content: "\f105" !important;
      font-family: FontAwesome !important;
      position: absolute !important;
      right: 14px !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      color: #9ca3af !important;
      font-size: 12px !important;
      transition: transform 140ms ease, color 160ms ease !important;
    }
    .header-nav .dropdown-submenu:hover > a::after {
      color: #2563eb !important;
      transform: translateY(-50%) translateX(2px) !important;
    }

    .header-nav .dropdown > .dropdown-toggle { position: relative !important; }
    .header-nav .dropdown > .dropdown-toggle::after {
      content: "\f107" !important;
      font-family: FontAwesome !important;
      margin-left: 8px !important;
      font-size: 12px !important;
      color: #6b7280 !important;
      transition: transform 180ms ease, color 160ms ease !important;
    }
    .header-nav .dropdown:hover > .dropdown-toggle::after {
      transform: rotate(180deg) !important;
      color: #2563eb !important;
    }
  }
  </style>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.querySelector('.mobile-app-nav-overlay');
    const mobileNav = document.querySelector('.mobile-app-nav');
    const menuToggle = document.querySelector('.mobile-app-menu-toggle');
    const closeBtn = document.querySelector('.mobile-app-nav-close');
    
    let originalBodyStyle = '';
    
    function closeMobileMenu() {
      if (mobileNav) {
        mobileNav.classList.remove('show');
        document.body.classList.remove('mobile-menu-open');
        if (originalBodyStyle) {
          document.body.setAttribute('style', originalBodyStyle);
        } else {
          document.body.removeAttribute('style');
        }
      }
    }
    
    function openMobileMenu() {
      if (mobileNav) {
        originalBodyStyle = document.body.getAttribute('style') || '';
        mobileNav.classList.add('show');
        document.body.classList.add('mobile-menu-open');
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = '0';
        document.body.style.left = '0';
        document.body.style.width = '100%';
        document.body.style.height = '100%';
      }
    }
    
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
    
    const menuLinks = document.querySelectorAll('.mobile-app-nav-menu a:not([target="_blank"])');
    menuLinks.forEach(link => {
      link.addEventListener('click', function() {
        setTimeout(() => {
          closeMobileMenu();
        }, 150);
      });
    });
    
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('show')) {
        closeMobileMenu();
      }
    });
    
    document.addEventListener('touchmove', function(e) {
      if (document.body.classList.contains('mobile-menu-open')) {
        e.preventDefault();
      }
    }, { passive: false });
  });
  </script>