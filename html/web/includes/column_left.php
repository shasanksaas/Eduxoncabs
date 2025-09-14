<?php $admin_type = $_SESSION[SES]['admin']['admin_type'];?>
<div class="style2">Links</div>
<div class="submenu" id="sub1">
	<div><a href="index.php">Home</a></div>
	<div><a href="my-account.php">My Account</a></div>
	<?php if($admin_type==1){?><div><a href="admin-manager.php">Admin Manager</a></div><?php }?>
    <div><a href="expenses.php">I/O Note</a></div>
    <!--<?php if($admin_type==1){?><div><a href="leave-manager.php">Leave Manager</a></div><?php }else{?>
    <div><a href="leavesManagement.php">Leave Management</a></div> <?php }?>-->
	
	
	</div>
<script type="text/javascript">
var file, n;
file = window.location.pathname;
n = file.lastIndexOf('/');
if (n >= 0) {
    file = file.substring(n + 1);
}
var flag=0;
$('.submenu').children('div').each(function () {
    if($(this).children('a').attr("href")==file) {		
		$(this).addClass("active");
		flag=1;
	}
});
if(file=="") {
	$('.submenu div:first-child(1)').addClass("active");
}
</script>