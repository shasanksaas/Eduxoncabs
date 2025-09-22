<!-- Bootstrap CSS -->
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

<!-- FontAwesome -->
<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">

<!-- Animate CSS -->
<link rel="stylesheet" href="vendor/animate/animate.min.css">

<!-- Theme CSS -->
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/theme-elements.css">
<link rel="stylesheet" href="css/theme-blog.css">
<link rel="stylesheet" href="css/theme-shop.css">
<!-- theme-animate.css doesn't exist, removing to fix 404 -->

<!-- Skin CSS -->
<link rel="stylesheet" href="css/skins/default.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="css/custom.css">

<!-- Critical inline CSS for above-the-fold -->
<style>
/* Only essential above-the-fold styles */
body { 
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important; 
  margin: 0;
  padding: 0;
}
.navbar {
  background-color: #fff !important;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.hero-section {
  min-height: 100vh;
  display: flex;
  align-items: center;
}
</style>

<!-- Defer ALL external CSS to after page render -->
<script>
window.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    var stylesheets = [
      'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light&display=swap',
      'vendor/bootstrap/css/bootstrap.min.css',
      'vendor/font-awesome/css/font-awesome.min.css',
      'vendor/animate/animate.min.css',
      'vendor/simple-line-icons/css/simple-line-icons.min.css',
      'vendor/owl.carousel/assets/owl.carousel.min.css',
      'vendor/owl.carousel/assets/owl.theme.default.min.css',
      'vendor/magnific-popup/magnific-popup.min.css',
      'css/theme.css',
      'css/theme-elements.css',
      'css/theme-blog.css',
      'css/theme-shop.css',
      'vendor/rs-plugin/css/settings.css',
      'vendor/rs-plugin/css/layers.css',
      'vendor/rs-plugin/css/navigation.css',
      'css/skins/skin-corporate-7.css',
      'css/custom.css',
      'assets/css/modern-design.css',
      'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
    ];
    
    stylesheets.forEach(function(href) {
      var link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = href;
      document.head.appendChild(link);
    });
  }, 10);
});
</script>