# EduxonCabs SMS OTP Setup Guide

## Quick Setup Instructions

### Step 1: Register for SMS Service (FREE)
1. Visit: https://www.fast2sms.com/
2. Click "Sign Up" 
3. Enter your mobile number and verify with OTP
4. Complete registration with email/password

### Step 2: Get API Key
1. Login to Fast2SMS dashboard
2. Go to "Dev API" section (left menu)
3. Copy your API key (looks like: xyz123abc456def789)

### Step 3: Configure EduxonCabs
Edit file: `includes/sms-config.php`

Replace:
```php
define('SMS_API_KEY', 'YOUR_FAST2SMS_API_KEY');
define('SMS_ENABLED', false);
define('DEMO_MODE', true);
```

With:
```php
define('SMS_API_KEY', 'your-actual-api-key-here');
define('SMS_ENABLED', true);
define('DEMO_MODE', false);
```

### Step 4: Test
1. Go to profile page
2. Enter any 10-digit mobile number
3. OTP will be sent to that mobile number
4. Enter OTP to verify

## Free Account Limits
- 50 SMS per day (perfect for testing)
- No setup cost
- Upgrade to paid plan for higher volume

## Alternative SMS Services (if needed)
1. **TextLocal**: https://www.textlocal.in/ (Popular in India)
2. **MSG91**: https://msg91.com/ (Good rates)
3. **Twilio**: https://www.twilio.com/ (International)

## Current Status
- ✅ SMS code is ready
- ✅ Demo mode working (shows OTP on screen)
- ⏳ Waiting for API key configuration
- ⏳ Production mode (actual SMS sending)

## Security Features Already Implemented
- ✅ OTP expires in 5 minutes
- ✅ Session timeout after 30 minutes
- ✅ Phone number validation
- ✅ Rate limiting protection
- ✅ Secure session management

## Need Help?
Contact Fast2SMS support or let me know if you face any issues!
