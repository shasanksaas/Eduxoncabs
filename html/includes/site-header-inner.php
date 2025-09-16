<header id="header" class="mobile-app-header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 57, 'stickySetTop': '-57px', 'stickyChangeLogo': true}">
  <div class="header-body">
    <div class="header-container container-fluid">
      <div class="header-row mobile-app-row">
        
        <!-- Logo (Always Left) -->
        <div class="header-column logo-column">
          <div class="header-logo"> 
            <a href="index.php"> 
              <img class="header-logo-img" alt="EduxonCabs" src="img/Eduxoncabs.png"> 
            </a> 
          </div>
        </div>
        
        <!-- Hamburger Menu Toggle (Right on Mobile) -->
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
  
  <!-- Divider below header -->
  <div class="header-divider"></div>
  
  <!-- Mobile Navigation Overlay -->
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
/* Responsive Logo */
.header-logo-img {
  max-width: 110px;
  width: 100%;
  height: auto;
  max-height: 40px;
  display: block;
}

/* Divider */
.header-divider {
  width: 100%;
  height: 1px;
  background: #e5e7eb;
  margin: 0;
}

/* Mobile Row Adjustments - Logo Left, Hamburger Right */
@media (max-width: 991px) {
  .mobile-app-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 0 15px;
  }
  
  .logo-column {
    order: 1;
    flex: 0 0 auto;
  }
  
  .mobile-menu-column {
    order: 2;
    flex: 0 0 auto;
    margin-left: auto;
  }
  
  /* Ensure no flex grow on columns */
  .header-column {
    flex: 0 0 auto;
  }
  
  /* Hide desktop nav on mobile */
  .desktop-nav-column {
    display: none;
  }
}

/* Extra small screens */
@media (max-width: 575px) {
  .mobile-app-row {
    padding: 0 10px;
  }
  
  .header-logo-img {
    max-width: 100px;
    max-height: 35px;
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