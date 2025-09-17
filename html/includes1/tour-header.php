<!-- Modern SaaS-style Header for Tour Packages -->
<style>
  /* Ensure header always stays on top */
  .modern-header .navbar {
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
    background-color: white !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
  }
  
  /* Add body padding to prevent content from going under header */
  body {
    padding-top: 70px !important;
  }
  
  @media (max-width: 767px) {
    /* Smaller padding for mobile */
    body {
      padding-top: 56px !important;
    }
  }

  /* Mobile Menu Button Styling */
  .mobile-app-menu-toggle {
    background: transparent !important;
    border: none !important;
    font-size: 20px;
    color: #333;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .mobile-app-menu-toggle:hover,
  .mobile-app-menu-toggle:focus {
    background: #f1f5f9 !important;
    color: #2563eb !important;
    box-shadow: none !important;
  }

  /* Hide mobile menu button on desktop */
  @media (min-width: 992px) {
    .mobile-app-menu-toggle {
      display: none !important;
    }
  }

  /* Show mobile menu button on mobile, hide desktop nav */
  @media (max-width: 991px) {
    .desktop-nav-menu {
      display: none !important;
    }
    
    .mobile-app-menu-toggle {
      display: block !important;
    }
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
    cursor: pointer;
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
  body.mobile-menu-open .container {
    pointer-events: none !important;
    user-select: none !important;
  }

  /* Ensure mobile menu content is always interactive */
  .mobile-app-nav-content * {
    pointer-events: all !important;
    user-select: auto !important;
  }

  @media (max-width: 768px) {
    .mobile-app-nav-content {
      width: 260px;
    }
  }
</style>

<header class="modern-header">
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" style="display: flex !important; align-items: center !important; justify-content: space-between !important;">
    <div class="container" style="display: flex !important; align-items: center !important; justify-content: space-between !important; width: 100% !important;">
      <!-- Brand Logo - Always on Left -->
      <a class="navbar-brand" href="/" style="order: 1 !important; flex: 0 0 auto !important;">
        <img src="img/Eduxoncabs.png" alt="EduxonCabs - Self Drive Car Rental Bhubaneswar" class="d-inline-block align-top" fetchpriority="high" loading="eager">
      </a>
      
      <!-- Desktop Navigation Menu - Center -->
      <div class="collapse navbar-collapse justify-content-center desktop-nav-menu" id="modernNavbar" style="order: 2 !important; flex: 1 !important;">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="about-us.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="all-cars-for-self-drive-bhubaneswar.php">All Cars</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="all-bikes-bike-for-rental-bhubaneswar.php">All Bikes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="tour-packages-odisha.php">Tour Packages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="contact-us.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="faq.php">FAQ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link font-weight-600 px-3" href="profile.php">User Profile</a>
          </li>
        </ul>
        
        <!-- Pay Now Button -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="https://razorpay.me/@eduxoncars" target="_blank" class="btn btn-primary px-4 py-2 rounded-pill font-weight-600">
              Pay Now
            </a>
          </li>
        </ul>
      </div>
      
      <!-- Mobile Menu Toggle Button - Always on Right -->
      <button class="btn mobile-app-menu-toggle navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation" style="order: 3 !important; flex: 0 0 auto !important; margin-left: auto !important;width: 48px;!important;">
        <i class="fa fa-bars"></i>
      </button>
    </div>
  </nav>
</header>

<!-- Mobile App-Style Navigation Overlay -->
<div class="mobile-app-nav collapse">
  <div class="mobile-app-nav-overlay"></div>
  <div class="mobile-app-nav-content">
    <div class="mobile-app-nav-header">
      <div class="mobile-app-nav-logo">
        <img src="img/Eduxoncabs.png" alt="EduxonCabs" height="35">
      </div>
      <button class="mobile-app-nav-close">
        <i class="fa fa-times"></i>
      </button>
    </div>
    
    <nav class="mobile-app-nav-menu">
      <ul>
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="about-us.php"><i class="fa fa-info-circle"></i> About Us</a></li>
        <li><a href="all-cars-for-self-drive-bhubaneswar.php"><i class="fa fa-car"></i> All Cars</a></li>
        <li><a href="all-bikes-bike-for-rental-bhubaneswar.php"><i class="fa fa-motorcycle"></i> All Bikes</a></li>
        <li><a href="tour-packages-odisha.php"><i class="fa fa-map-signs"></i> Tour Packages</a></li>
        <li><a href="contact-us.php"><i class="fa fa-phone"></i> Contact</a></li>
        <li><a href="faq.php"><i class="fa fa-question-circle"></i> FAQ</a></li>
        <li><a href="profile.php"><i class="fa fa-user"></i> User Profile</a></li>
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

<script>
// Mobile App Navigation with Blur Effect
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

  // Simple header fix - just ensure it stays fixed
  const header = document.querySelector('.modern-header .navbar');
  if (header) {
    // Just ensure the CSS classes are correct
    header.style.position = 'fixed';
    header.style.top = '0';
    header.style.zIndex = '9999';
    header.classList.add('fixed-top');
  }
});
</script>
