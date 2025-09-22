<?php
session_start();
require_once("includes/settings.php");
require_once("includes/database.php");
require_once("includes/classes/db.cls.php");
require_once("includes/classes/sitedata.cls.php");
require_once("includes/functions/common.php");
require_once("includes/classes/DBquery.cls.php");
$db = new SiteData();
?>
<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>FAQ - Self Drive Car Rental Bhubaneswar | Booking Process & Policies</title>
<meta name="keywords" content="self drive car rental FAQ, car rental booking process Bhubaneswar, self drive cars rental policies, how to book car rental Bhubaneswar, car rental documents required, self drive car charges Bhubaneswar, EduxonCabs FAQ, car rental without driver Bhubaneswar" />
<meta name="description" content="FAQ for self drive car rental Bhubaneswar. Learn about booking process, documents required, charges, policies for car rental without driver. Get answers about EduxonCabs services."/>
<meta name="author" content="Eduxoncabs.com">
<!-- Canonical URL -->
<?php outputCanonicalTag('/faq-modern.php'); ?>
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<link rel="stylesheet" href="assets/css/modern-faq-page.css">
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>
  <div role="main" class="main modern-faq-page">
   
    <!-- FAQ Header Section -->
    <section class="faq-header-section">
      <div class="container">
        <div class="faq-header-content">
          <h1 class="faq-title">Frequently Asked Questions</h1>
          <p class="faq-subtitle">Everything you need to know about our self-drive car rental services</p>
        </div>
      </div>
    </section>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="faq-content-wrapper">
            
            <!-- Policy Section 1: Terms of Service -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">1</span>
                Terms of Service
              </h2>
              <div class="policy-card">
                <p class="policy-text">
                  The Customer agrees and acknowledges that the use of the services offered by Eduxon is at the sole risk of the Customer. The liability of EDUXON is excluded to the fullest extent permitted by law. Customer can rent a vehicle under Eduxon platform for Tourist Purposes.
                </p>
              </div>
            </div>

            <!-- Policy Section 2: Required Documents -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">2</span>
                Required Documents
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Essential Documents</h3>
                  <p class="policy-text">
                    <strong>Driving license</strong> and <strong>Adhar Card</strong>, <strong>Voter Id, Mobile Number (Adhar Linked)</strong> Issued by Authority or Institution.
                  </p>
                </div>
                
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Local Residents & Students</h3>
                  <p class="policy-text">
                    Localites/Students must carry their Job/College/Institution ID Card for address proof.
                  </p>
                </div>
                
                <div class="policy-subsection">
                  <h3 class="subsection-title">c. Important Note</h3>
                  <p class="policy-text">
                    Without absence of Job/Collage ID, No Local IDs is eligible to rent a car under Eduxon Platform.
                  </p>
                </div>
                
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Pre-Verification</h3>
                  <p class="policy-text">
                    Customers can email their Driving License, Aadhar Card copy, other ID, and a <strong>live photo</strong> to <u><strong>hello@eduxoncabs.com</strong></u> for pre-verification of documents.
                  </p>
                </div>
                
                <div class="policy-subsection">
                  <h3 class="subsection-title">e. Document Validation</h3>
                  <p class="policy-text">
                    In the absence of any valid or required documents, the booking will be treated as cancelled and ₹500 + online transaction charges will be deducted from the total amount paid.
                  </p>
                </div>
              </div>
            </div>

            <!-- Policy Section 3: Age Requirements -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">3</span>
                Age Requirements
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Normal Vehicles</h3>
                  <p class="policy-text">Minimum 21 years for normal vehicles.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Premium Vehicles</h3>
                  <p class="policy-text">Minimum 24 years for premium-range vehicles such as BMW, Audi, Mercedes, Endeavour, Fortuner, Benelli, and Harley.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 4: Over Speeding Charges -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">4</span>
                Over Speeding Charges (Exceeding 80–85 km/h)
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. First Instance</h3>
                  <p class="policy-text">A penalty of ₹200 shall be charged on the first instance.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Subsequent Violations</h3>
                  <p class="policy-text">An additional penalty of Rs 500/- shall be charged each time from the second instance of speed violation.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">c. Multiple Violations</h3>
                  <p class="policy-text">In case of multiple overspeeding occurrences, the security deposit will be forfeited.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Damage Liability</h3>
                  <p class="policy-text">The customer is liable for any damages, mechanical or technical failures that occur after multiple overspeeding incidents.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 5: Security Deposit -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">5</span>
                Refundable Security Money
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Standard Vehicles</h3>
                  <p class="policy-text"><strong>Rs.999/-</strong> for cars and <strong>Rs.499/-</strong> for bikes.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Premium Vehicles</h3>
                  <p class="policy-text"><strong>Rs.5,000/-</strong> for premium-range vehicles (BMW, Audi, Mercedes, Harley, Benelli).</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">c. Payment Methods</h3>
                  <p class="policy-text"><strong>Cash, Paytm, PhonePe, UPI, Card Payments, or Online.</strong> <strong>(Only Pay In Verified Company Account/Upi/Qr Codes in The Name of <u><em>Eduxon Technologies Pvt. Ltd.)</em></u>.</strong></p>
                  <div class="alert alert-warning">
                    <strong>NOTE: Do not pay any amount into anyone's personal account or UPI.</strong>
                  </div>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Refund Process</h3>
                  <p class="policy-text">Security money will be refunded via the same mode of payment used by the customer.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">e. Refund Timeline</h3>
                  <p class="policy-text">If any violation of the terms and conditions is done by the customer, the security money will be refunded or adjusted within 24 hours from the drop time to the respective <strong>bank account, PhonePe, GPay, Paytm, etc.</strong></p>
                </div>
              </div>
            </div>

            <!-- Policy Section 6: Kilometers Limitation -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">6</span>
                Kilometers Limitation
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Normal Vehicles</h3>
                  <p class="policy-text">Unlimited kilometers are offered to the customer for normal-range vehicles.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Premium Vehicles</h3>
                  <p class="policy-text"><strong>180 km / 24 hours</strong> is the limit for premium vehicles such as BMW, Mercedes, and Audi. Extra kilometers will be charged at <strong>₹30/km</strong> from the customer.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">c. Outside Odisha</h3>
                  <p class="policy-text">Customers must inform in advance if they plan to cross the Odisha state border, at least 24 hours before the pick-up time. Bookings made for outside Odisha trips without prior information will be treated as invalid, and no refund will be issued.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Additional Limitations</h3>
                  <p class="policy-text"><strong>d.1:</strong> Unlimited kilometers are applicable only for bookings of 24 hours or more.</p>
                  <p class="policy-text"><strong>d.2:</strong> 250 Kms is Limited for 12 Hours Booking.</p>
                  <p class="policy-text"><strong>d.3:</strong> 180 Kms/24 Hours is Limited For Two Wheelers.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 7: Prohibited Use -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">7</span>
                Prohibited Use
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">General Restrictions</h3>
                  <p class="policy-text">Customers are not allowed to carry arms, ammunitions, banned drugs & pets. In addition, use of car for commercial activity such as product sell and promotion, and carry goods is strictly prohibited. In such cases, customers will be charged a penalty of Rs. 5000 or the penalty charged by the authorities whichever is higher.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">Specific Prohibitions</h3>
                  <p class="policy-text"><strong>a.</strong> For any speed race or competition;</p>
                  <p class="policy-text"><strong>b.</strong> For the purpose of towing, pushing, Marraige or propelling any trailer or any other vehicle;</p>
                  <p class="policy-text"><strong>c.</strong> For the primary business purpose of transporting people or operating a taxi service;</p>
                  <p class="policy-text"><strong>d.</strong> By any person who is under the influence of (i) alcohol or (ii) any drug or medication under the effects of which the operation of a vehicle is prohibited or not recommended;</p>
                  <p class="policy-text"><strong>e.</strong> For the purpose of commission of any crime or other illegal or unlawful activity.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">Driver Authorization</h3>
                  <p class="policy-text"><strong>e.</strong> Only Renter is authorised to drive the vehicle. If any other person found Driving the vehicle or Sub letting of vehicle then Security money will be forfeited of the renter.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">Vehicle Care</h3>
                  <p class="policy-text"><strong>f.</strong> Smoking, Drinking & Other Types of Drugs Not Allowed Inside The car. If Anything Found inside the car then it will be chargble Rs.2000/-</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">Restricted Areas</h3>
                  <p class="policy-text"><strong>g.</strong> Restricted areas: Phulbani, Koraput, Malkangiri Belts in Odisha. Booking of the car for trip in these areas will be treated as cancelled.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 8: Roadside Assistance -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">8</span>
                Roadside Assistance
              </h2>
              <div class="policy-card">
                <p class="policy-text">Eduxon makes reasonable best efforts to provide roadside assistance support in all cases. If, however, a User's need for Roadside Assistance results from a breach of these Terms and Conditions, the User may be charged for the full costs of the service.</p>
              </div>
            </div>

            <!-- Policy Section 9: Late Charges -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">9</span>
                Late Charges
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Late Return Penalty</h3>
                  <p class="policy-text">If the Customer Exceeds the Time Limit without any information Before 06 Hours of expiry Of time then it will be Chargeable Rs. 500/- as a fine in addition to extra Per Hour Charge Rs. 200/Hour.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Extension Rules</h3>
                  <p class="policy-text">Extension Rules are Subject to availability of vehicles.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 10: Insurance & Damage -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">10</span>
                Insurance & Damage Charges
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Customer Liability</h3>
                  <p class="policy-text">The company will not be responsible for any damages during the travel. If any damage occurs while travel, renter should take care of the repair charges by their own up to Rs.25000/- in Normal range vehicles & Rs. 75,000/- in Premium range Vehicles.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Insurance Claims</h3>
                  <p class="policy-text">Insurance claim can be applicable for damage or repair charges above Rs.25000/- For Normal vehicles & Rs.75,000/- for premium range Vehicles only and any excess charges apart from claim amount, the renter will be liable to pay with the Minimum Liability Amount of Rs.25000/-</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Additional Information</h3>
                  <p class="policy-text">For More Information Regarding Damage Charges refer the Car Mannual available in Respective Sites.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 11: GPS Tracking -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">11</span>
                GPS Tracking
              </h2>
              <div class="policy-card">
                <p class="policy-text">Vehicles registered with Eduxon may be continuously tracked by using GPS for security reasons or for reasons deemed fit and proper by Eduxon.</p>
              </div>
            </div>

            <!-- Policy Section 12: Termination Rights -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">12</span>
                Termination Rights
              </h2>
              <div class="policy-card">
                <p class="policy-text">Eduxon shall be entitled to terminate any booking at any time without giving any reason or prior notice to the Customer.</p>
              </div>
            </div>

            <!-- Policy Section 13: Home Delivery -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">13</span>
                Home Delivery
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Airport Delivery</h3>
                  <p class="policy-text">Airport Delivery is free. (Only toll charges applicable)</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Home Delivery</h3>
                  <p class="policy-text">Home delivery is Chargeble Rs. 400/- Including Pick up/Drop up within the radius of 20Km.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 14: Cancellation Policy -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">14</span>
                Cancellation Policy
              </h2>
              <div class="policy-card">
                <div class="policy-subsection">
                  <h3 class="subsection-title">a. Before 24 Hours</h3>
                  <p class="policy-text">50% of the total rental amount will be deduct in any cancellation before 24 hours from the time of Pick up. However Customer can Postponed the booking with no extra charges subject to availability of Car.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">b. Within 24 Hours</h3>
                  <p class="policy-text">75% of The Total Amount of Rental Will be Deductable in case of any cancellation within 24 hours from the time of Pick up.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">c. Vehicle Change</h3>
                  <p class="policy-text">Rs.500 Will be Deductable on Swiping/Change of Vehicle. In Covid Cases of Lock down/Shut Down/Night Curfew Customers can Postponed their booking to the future dates subject to availability. No Refuns in case of any cancellation for Covid Reasons.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">d. Company Cancellation</h3>
                  <p class="policy-text">Eduxon Can Cancel or Swipe the Car in the case of Non availability of car due to breakdown or some reasons. In that case full amount is refundable to the customer without any deductions.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">e. Service Sustainability</h3>
                  <p class="policy-text">Eduxon Car does not assure a complete sustainability of its Service and shall not be held responsible or liable for the same, in any manner.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">f. No-Show Policy</h3>
                  <p class="policy-text">If Customer Doesn't Pick Up the Vehicle Within 06 Hours From the Pick up time without Information then the Booking will be Treated as Cancelled & No amount will be refunded.</p>
                </div>
                <div class="policy-subsection">
                  <h3 class="subsection-title">g. Refund Timeline</h3>
                  <p class="policy-text">Cancellation refund amount will be credited within 07 Working Days from the Date of Cancellation.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 15: Working Hours -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">15</span>
                Working Hours
              </h2>
              <div class="policy-card">
                <p class="policy-text"><strong>Working Hours:</strong> 06:00 am - 11:00 pm all Days.</p>
              </div>
            </div>

            <!-- Policy Section 16: Fuel Policy -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">16</span>
                Fuel Policy
              </h2>
              <div class="policy-card">
                <p class="policy-text">The vehicle must be returned by the customer, upon completion of the booking, with fuel at the same level as at start of the booking. If the vehicle is returned with lesser fuel than the fuel level at the start of the trip, then refueling charge will be applicable.</p>
              </div>
            </div>

            <!-- Policy Section 17: Contact Information -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">17</span>
                Contact Information
              </h2>
              <div class="policy-card">
                <div class="contact-highlight">
                  <p class="policy-text">In case of any questions or concerns/Complains about the Policy or data processing, Users shall mail us on: <strong>hello@eduxoncabs.com</strong> or Reach us on <strong>+91-9439825591, +91-7873001464</strong>.</p>
                </div>
              </div>
            </div>

            <!-- Policy Section 18: Social Media -->
            <div class="faq-section">
              <h2 class="section-title">
                <span class="section-number">18</span>
                Social Media Connect
              </h2>
              <div class="policy-card">
                <div class="contact-highlight">
                  <p class="policy-text"><strong>Whatsapp:</strong> +91-9078212872, <strong>Instagram:</strong> eduxon_cars, <strong>Facebook:</strong> @eduxoncabs.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>
</body>
</html>
