<!DOCTYPE html>
<html>
<head>
<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>404 - Page Not Found | EduxonCabs - Self Drive Car Rental Bhubaneswar</title>
<meta name="keywords" content="404 error, page not found, EduxonCabs, self drive car rental Bhubaneswar" />
<meta name="description" content="The page you are looking for does not exist. Return to EduxonCabs homepage for self drive car rental in Bhubaneswar."/>
<meta name="author" content="Eduxoncabs.com">
<!-- Favicon -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Web Fonts  -->
<?php include("includes/inc-css.php");?>
<style>
.error-page {
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}
.error-content {
  max-width: 600px;
  padding: 60px 30px;
}
.error-code {
  font-size: 120px;
  font-weight: 700;
  color: #3b82f6;
  margin-bottom: 20px;
  text-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
}
.error-title {
  font-size: 32px;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 20px;
}
.error-description {
  font-size: 18px;
  color: #6b7280;
  margin-bottom: 40px;
  line-height: 1.6;
}
.error-actions {
  display: flex;
  gap: 20px;
  justify-content: center;
  flex-wrap: wrap;
}
.btn-home {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  padding: 15px 30px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-home:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
  color: white;
  text-decoration: none;
}
.btn-cars {
  background: transparent;
  color: #3b82f6;
  border: 2px solid #3b82f6;
  padding: 15px 30px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-cars:hover {
  background: #3b82f6;
  color: white;
  text-decoration: none;
}
.error-icon {
  font-size: 80px;
  color: #d1d5db;
  margin-bottom: 30px;
}
@media (max-width: 768px) {
  .error-code { font-size: 80px; }
  .error-title { font-size: 24px; }
  .error-actions { flex-direction: column; align-items: center; }
  .btn-home, .btn-cars { width: 100%; max-width: 250px; justify-content: center; }
}
</style>
</head>
<body>
<div class="body">
  <?php include("includes/site-header-inner.php");?>

  <div role="main" class="main">
    <div class="error-page">
      <div class="error-content">
        <div class="error-icon">
          <i class="fa fa-car"></i>
        </div>
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Oops! Page Not Found</h2>
        <p class="error-description">
          The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
          <br>Let's get you back on the road!
        </p>
        <div class="error-actions">
          <a href="/" class="btn-home">
            <i class="fa fa-home"></i>
            Go to Homepage
          </a>
          <a href="all-cars-for-self-drive-bhubaneswar.php" class="btn-cars">
            <i class="fa fa-car"></i>
            Browse Cars
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <?php include("includes/site-footer.php");?>
</div>
<?php include("includes/inc-js.php");?>
</body>
</html>
