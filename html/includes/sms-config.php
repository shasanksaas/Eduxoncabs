<?php
/*
 * SMS API Configuration for EduxonCabs
 * 
 * To enable SMS OTP functionality:
 * 1. Register at https://www.fast2sms.com/ (Free account available)
 * 2. Get your API key from the dashboard
 * 3. Replace 'YOUR_FAST2SMS_API_KEY' with your actual API key
 * 4. Update the sender ID if needed
 * 
 * Alternative SMS Services:
 * - TextLocal (https://www.textlocal.in/)
 * - MSG91 (https://msg91.com/)
 * - Twilio (https://www.twilio.com/)
 */

// Fast2SMS Configuration
define('SMS_API_KEY', '6u5DsfknicX2NrCIzYVhZFwojHaRK0SdeW8L3MOtP1lpxJ4bgqbN3qXPWCQkDRUsFgr5vLtAe8SlGOwY'); // Your Fast2SMS API key
define('SMS_SENDER_ID', 'EDUXON'); // Your approved sender ID
define('SMS_ENABLED', true); // SMS functionality enabled

// OTP Configuration
define('OTP_LENGTH', 6); // OTP length (4-6 digits recommended)
define('OTP_EXPIRY_MINUTES', 5); // OTP expiry time in minutes
define('SESSION_TIMEOUT_MINUTES', 30); // Verified session timeout

// Demo Mode (for testing without SMS)
define('DEMO_MODE', false); // Production mode - SMS will be sent
define('DEMO_SHOW_OTP', false); // Don't show OTP in browser

/*
 * Instructions for Fast2SMS Setup:
 * 
 * 1. Visit https://www.fast2sms.com/
 * 2. Sign up for a free account
 * 3. Verify your mobile number
 * 4. Go to Dashboard > Dev API
 * 5. Copy your API key
 * 6. Paste it in SMS_API_KEY above
 * 7. Set SMS_ENABLED to true
 * 8. Set DEMO_MODE to false for production
 * 
 * Free Account Limits:
 * - 50 SMS per day
 * - Perfect for testing and small usage
 * 
 * For higher volume, upgrade to paid plan
 */
?>
