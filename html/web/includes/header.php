<div style="background:url(images/top1.jpg) repeat-x;height:100px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="130" align="left"><a href="<?=SITE_HOME?>aumadmin"><img src="images/logo.png"  border="0" alt="Logo" title="IHM" height="98px"/></a></td>
	 <td align="left">
		<div>
			<div style="font-size:1.5em;font-weight: 500; color:#FFFFFF;text-align:center;">Green Field Manor</div>
			<div>&nbsp;</div>
			<div style="font-size:1.5em;font-weight: 500; color:#CCCCCC;text-align:center;">Digital Note</div>
		</div>
	</td>
    <td width="180" align="center" valign="top">
	<?php if(isLoggedin()) { ?>
	<div class="headerlinkbox">
        <div class="headerlinks">Welcome</div>
        <div class="headerlinks"><?=$_SESSION[SES]['admin']['admin_name']?><br />You are signed in as: <b><?=$_SESSION[SES]['admin']['admin_user']?></b> &nbsp;</div>
        <div class="headerlinks"><a href="logout.php" class="signout">Signout</a></div>
      </div>
	 <?php } else {echo '&nbsp';}?> 
	 </td>
  </tr>
</table>
</div>
