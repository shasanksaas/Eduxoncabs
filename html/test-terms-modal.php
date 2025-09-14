<!DOCTYPE html>
<html>
<head>
    <title>Test Terms Modal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { padding: 50px; font-family: Arial, sans-serif; }
        .test-button { 
            background: #2563eb; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h2>Test Terms & Conditions Modal</h2>
    <p>Click the link below to test the modal:</p>
    
    <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; background: #f9f9f9;">
        <input type="checkbox" id="terms-checkbox">
        <label for="terms-checkbox">
           I have read and accepted all 
           <a href="#" id="terms-link" style="color: #2563eb; font-weight: 600; text-decoration: underline;" onclick="openTermsModal()">Terms & Conditions</a>, 
           payment policies, and booking guidelines. *
        </label>
    </div>

    <!-- Terms & Conditions Modal (copied from checkout.php) -->
    <div id="termsModal" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 10000; display: flex; align-items: center; justify-content: center;">
       <div class="modal-content-modern" style="background: white; border-radius: 20px; max-width: 500px; width: 90%; max-height: 80vh; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);">
          <div class="modal-header-modern" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center;">
             <h2 style="margin: 0; font-size: 1.5rem; font-weight: 600;"><i class="fas fa-file-contract me-2"></i>Terms & Conditions</h2>
             <button type="button" class="close-modal" onclick="closeTermsModal()" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0.5rem; border-radius: 50%;">
                ✕
             </button>
          </div>
          <div class="modal-body-modern" style="padding: 2rem;">
             <div class="terms-options" style="display: grid; gap: 1rem;">
                <div class="option-card" onclick="openTermsInNewTab()" style="border: 2px solid #e5e7eb; border-radius: 12px; padding: 1.5rem; cursor: pointer; text-align: center; transition: all 0.3s ease;">
                   <div style="font-size: 2rem; color: #2563eb; margin-bottom: 1rem;">🔗</div>
                   <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">View in New Tab</h3>
                   <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">Open Terms & Conditions in a new browser tab</p>
                </div>
                <div class="option-card" onclick="redirectToTerms()" style="border: 2px solid #e5e7eb; border-radius: 12px; padding: 1.5rem; cursor: pointer; text-align: center; transition: all 0.3s ease;">
                   <div style="font-size: 2rem; color: #2563eb; margin-bottom: 1rem;">➡️</div>
                   <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem;">Go to FAQ Page</h3>
                   <p style="color: #6b7280; margin: 0; font-size: 0.9rem;">Navigate directly to our FAQ & Terms page</p>
                </div>
             </div>
          </div>
       </div>
    </div>

    <script>
        function openTermsModal() {
            $('#termsModal').show();
        }

        function closeTermsModal() {
            $('#termsModal').hide();
        }

        function openTermsInNewTab() {
            alert('Would open: faq.php in new tab');
            closeTermsModal();
        }

        function redirectToTerms() {
            alert('Would redirect to: faq.php');
            closeTermsModal();
        }

        // Close modal when clicking outside
        $(document).on('click', '.modal-overlay', function(e) {
            if (e.target === this) {
               closeTermsModal();
            }
        });
    </script>
</body>
</html>
