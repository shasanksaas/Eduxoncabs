<?php 
include_once 'config.php'; 
require_once 'includes/functions/common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - EduxonCabs | Self Drive Car Rental Bhubaneswar</title>
    <meta name="description" content="Privacy Policy for EduxonCabs - Learn how we protect your personal information and data privacy for our self drive car rental services in Bhubaneswar.">
    
    <!-- Canonical URL -->
    <?php outputCanonicalTag('/privacy.php'); ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/modern-design.css" rel="stylesheet">
    
    <style>
        .privacy-container {
            padding: 120px 0 60px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        
        .privacy-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            padding: 60px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .privacy-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #007bff, #28a745, #17a2b8);
        }
        
        .privacy-title {
            font-size: 3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        
        .privacy-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 500;
        }
        
        .privacy-last-updated {
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 40px;
            text-align: center;
            border-left: 4px solid #007bff;
        }
        
        .privacy-section {
            margin-bottom: 40px;
        }
        
        .privacy-heading {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            position: relative;
        }
        
        .privacy-heading::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, #007bff, #28a745);
        }
        
        .privacy-text {
            color: #495057;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 20px;
        }
        
        .privacy-list {
            margin: 20px 0;
        }
        
        .privacy-list li {
            color: #495057;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 10px;
            padding-left: 10px;
            position: relative;
        }
        
        .privacy-list li::before {
            content: '✓';
            color: #28a745;
            font-weight: bold;
            position: absolute;
            left: -15px;
        }
        
        .privacy-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .privacy-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        .summary-box {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            position: relative;
        }
        
        .summary-box::before {
            content: '📋';
            font-size: 1.5rem;
            position: absolute;
            top: -15px;
            left: 30px;
            background: white;
            padding: 0 15px;
        }
        
        .contact-box {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin-top: 40px;
        }
        
        .contact-box h3 {
            color: white;
            margin-bottom: 15px;
        }
        
        .contact-email {
            color: #b3d9ff;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .privacy-card {
                padding: 30px 20px;
                margin: 0 10px;
            }
            
            .privacy-title {
                font-size: 2rem;
            }
            
            .privacy-container {
                padding: 100px 0 40px;
            }
        }
    </style>
</head>
<body>

<?php include_once 'includes1/modern-header-only.php'; ?>

<div class="privacy-container">
    <div class="container">
        <div class="privacy-card">
            <h1 class="privacy-title">Privacy Policy</h1>
            <p class="privacy-subtitle">Your privacy is important to us. Learn how we protect your personal information.</p>
            
            <div class="privacy-last-updated">
                <strong>Last updated: May 13, 2024</strong>
            </div>
            
            <div class="privacy-section">
                <p class="privacy-text">
                    This privacy notice for <strong>Eduxon Technologies Private Limited</strong> ('<strong>we</strong>', '<strong>us</strong>', or '<strong>our</strong>'), 
                    describes how and why we might collect, store, use, and/or share ('<strong>process</strong>') your information when you use our 
                    services ('<strong>Services</strong>'), such as when you:
                </p>
                
                <ul class="privacy-list">
                    <li>Download and use our mobile application (Eduxon Cabs), or any other application of ours that links to this privacy notice</li>
                    <li>Engage with us in other related ways, including any sales, marketing, or events</li>
                </ul>
                
                <p class="privacy-text">
                    <strong>Questions or concerns?</strong> Reading this privacy notice will help you understand your privacy rights and choices. 
                    If you do not agree with our policies and practices, please do not use our Services. If you still have any questions or concerns, 
                    please contact us at <a href="mailto:eduxontechnologies@gmail.com" class="privacy-link">eduxontechnologies@gmail.com</a>.
                </p>
            </div>
            
            <div class="summary-box">
                <h2 class="privacy-heading">Summary of Key Points</h2>
                <p class="privacy-text">
                    <strong><em>This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for.</em></strong>
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">What personal information do we process?</h3>
                <p class="privacy-text">
                    When you visit, use, or navigate our Services, we may process personal information depending on how you interact with us and the Services, 
                    the choices you make, and the products and features you use.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">Do we process any sensitive personal information?</h3>
                <p class="privacy-text">
                    We do not process sensitive personal information.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">Do we receive any information from third parties?</h3>
                <p class="privacy-text">
                    We do not receive any information from third parties.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">How do we process your information?</h3>
                <p class="privacy-text">
                    We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, 
                    and to comply with law. We may also process your information for other purposes with your consent. We process your information only 
                    when we have a valid legal reason to do so.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">In what situations and with which parties do we share personal information?</h3>
                <p class="privacy-text">
                    We may share information in specific situations and with specific third parties.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">How do we keep your information safe?</h3>
                <p class="privacy-text">
                    We have organisational and technical processes and procedures in place to protect your personal information. However, no electronic 
                    transmission over the internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee 
                    that hackers, cybercriminals, or other unauthorised third parties will not be able to defeat our security and improperly collect, 
                    access, steal, or modify your information.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">What are your rights?</h3>
                <p class="privacy-text">
                    Depending on where you are located geographically, the applicable privacy law may mean you have certain rights regarding your personal information.
                </p>
            </div>
            
            <div class="privacy-section">
                <h3 class="privacy-heading">How do you exercise your rights?</h3>
                <p class="privacy-text">
                    The easiest way to exercise your rights is by submitting a 
                    <a href="https://app.termly.io/notify/40462e28-0f9d-4d29-9178-9deb2d842736" target="_blank" rel="noopener noreferrer" class="privacy-link">data subject access request</a>, 
                    or by contacting us. We will consider and act upon any request in accordance with applicable data protection laws.
                </p>
            </div>
            
            <div class="contact-box">
                <h3>Have Questions About Your Privacy?</h3>
                <p>We're here to help! Contact us for any privacy-related inquiries.</p>
                <div class="contact-email">eduxontechnologies@gmail.com</div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/site-footer.php'; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>