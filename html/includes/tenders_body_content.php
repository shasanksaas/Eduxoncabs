<div style="min-height:300px;">

<?php if($tender_total>0){?>
<div align="right"><?=$pagination?></div>
  <table width="100%" border="1" bordercolor="#BCBCBC" cellspacing="0" cellpadding="2" class="table" align="center">
                <thead>
                  <tr>
                    <th width="40" align="center">S.N.</th>
                    <th align="left">&nbsp;Title</th>
                    <th width="50" align="center">Download</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
		$j=$start;
		for($i=0;$i<$tender_total;$i++) { 
			$j++;
			$tender_id = $tender[$i]['tender_id'];
			$tender_title = outText($tender[$i]['title']);
			$description = outText($tender[$i]['description']);
			$publish_date = ($tender[$i]['publish_date']!="")?outText($tender[$i]['publish_date']):""; 
			$expiry_date = ($tender[$i]['expiry_date']!="")?outText($tender[$i]['expiry_date']):""; 
			$tender_file = outText($tender[$i]['tender_file']); 
			$tender_status = outText($tender[$i]['status']); 
			if($tender_status=='1') {?>
                  <tr>
                    <td align="center" valign="top"><?=($j)?></td>
                    <td align="left" valign="top"><?php 
					if($publish_date!="") {echo '&nbsp;<span class="fleft"><b>Published On :</b> '.$publish_date.'</span>';}
					if($expiry_date!="") {echo '<span class="fright"><b>Expires On :</b> '.$expiry_date.'</span>';}
					echo '<div class="bold">'.$tender_title.'</div>';?>
                      <?php if($description!="") {echo '<div class="clear">'.$description.'</div>';}?></td>
                    <td align="center" valign="top">
					<?php if($tender_file){?>
					<a href="<?=SITE_HOME?>tenders/<?=$tender_file?>" target="_blank" title="Download" class="link"><img src="<?=SITE_HOME?>images/download.png" alt="download" align="absmiddle" border="0"/></a>
					<?php }else{?>
					<a href="javascript:void(0)" title="Download" class="link"><img src="<?=SITE_HOME?>images/download.png" alt="download" align="absmiddle" border="0"/></a>
					<?php }?>
					</td>
                  </tr>
                  <?php } 
                      } ?>
                </tbody>
              </table>
          
		  <div align="right"><?=$pagination?></div>
<?php }else{?>
<div align="center" style="color:#990000; font-weight:bold; min-height:240px;">No data found</div>
<?php }?>
</div>