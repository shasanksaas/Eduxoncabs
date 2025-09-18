<script src="assets/js/jquery.min.js"></script>
<!-- Load jQuery UI asynchronously to reduce critical path latency -->
<script>
// Load jQuery UI only when needed to reduce initial load time
function loadJQueryUI() {
  if (!window.jQueryUILoaded) {
    const script = document.createElement('script');
    script.src = 'https://code.jquery.com/ui/1.12.1/jquery-ui.js';
    script.async = true;
    script.onload = function() {
      window.jQueryUILoaded = true;
      // Initialize any jQuery UI components if needed
      if (typeof initJQueryUIComponents === 'function') {
        initJQueryUIComponents();
      }
    };
    document.head.appendChild(script);
  }
}

// Load on user interaction or after DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', function() {
    setTimeout(loadJQueryUI, 500);
  });
} else {
  setTimeout(loadJQueryUI, 500);
}
</script>
      <!-- JQUERY:: APPEAR.JS -->
      <script src="assets/js/plugins/appear/appear.js"></script>

      <!-- JQUERY:: COUNTER.JS -->
      <script src="assets/js/plugins/counter/jquery.easing.min.js"></script>
      <script src="assets/js/plugins/counter/counter.min.js"></script>


      <!-- JQUERY:: BOOTSTRAP.JS -->
      <script src="assets/js/tether.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

      <!-- JQUERY:: DATEPICKER.JS - Deferred loading for better performance -->
      <script>
      // Load heavy date picker libraries only when needed
      function loadDatePickerLibs() {
        if (!window.datePickerLoaded) {
          // Load moment.js (300KB) asynchronously
          const momentScript = document.createElement('script');
          momentScript.src = 'assets/js/plugins/datepicker/moment-with-locales.min.js';
          momentScript.onload = function() {
            // Load moment-timezone after moment.js
            const timezoneScript = document.createElement('script');
            timezoneScript.src = 'assets/js/plugins/datepicker/moment-timezone.js';
            timezoneScript.onload = function() {
              // Load bootstrap-datepicker after dependencies
              const datepickerScript = document.createElement('script');
              datepickerScript.src = 'assets/js/plugins/datepicker/bootstrap-datepicker.js';
              datepickerScript.onload = function() {
                window.datePickerLoaded = true;
                // Initialize datepickers if any exist
                if (typeof initDatePickers === 'function') {
                  initDatePickers();
                }
              };
              document.head.appendChild(datepickerScript);
            };
            document.head.appendChild(timezoneScript);
          };
          document.head.appendChild(momentScript);
        }
      }
      
      // Load when user interacts with date inputs or after 2 seconds
      document.addEventListener('click', function(e) {
        if (e.target.matches('input[type="date"], .datepicker, [data-provide="datepicker"]')) {
          loadDatePickerLibs();
        }
      });
      
      // Fallback load after 2 seconds
      setTimeout(loadDatePickerLibs, 2000);
      </script>

      <!-- JQUERY:: PLUGINS -->
      <script src="assets/js/plugins/owl/owl.carousel.min.js"></script>
      <script src="assets/js/plugins/lightcase/lightcase.js"></script>
      <script src="assets/js/plugins/owl/owl.carousel2.thumbs.js"></script>

      <!-- JQUERY:: MAP -->
      <!--<script src="assets/js/map.js"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK7lXLHQgaGdP3IvMPi1ej0B9JHUbcqB0&amp;callback=initMap"></script>-->


      <!-- JQUERY:: CUSTOM.JS -->
      <script src="assets/js/custom.js"></script>
      
      <!-- MOBILE RESPONSIVE JS -->
      <script src="assets/js/mobile-responsive.js"></script>
      
      <!-- NAVBAR FIX JS -->
      <script src="assets/js/navbar-fix.js"></script>