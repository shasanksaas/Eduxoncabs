<?php
$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
if (!$mysqli_conn) {
            die("Database Connection Failed: " . $mysqli_conn->connect_error);
        }

if ($_GET['act'] == "del") {
    $delid = $_GET['delid'];
	$image_r=mysqli_fetch_assoc(mysqli_query($mysqli_conn,"select banner_image from tbl_banner where id=$delid"));
   	$imgpath="../uploadedDocument/banner/".$image_r['banner_image'];
    $sql_del = mysqli_query($mysqli_conn,"delete from tbl_banner where id= " . $delid . "");
	 if(file_exists($imgpath)){
      @unlink($imgpath);  
    }
    $msg = "Banner Deleted Successfully";
	setMessage($msg, 'alert alert-success');?>
	<script>window.location = 'managebanner.php';</script>
<?php }
?>
<div class="col-md-12"><a href="managebanner.php?q=add" class="btn btn-success float-right" style="margin-bottom:1%;">Add New Image</a></div>

	<div class="col-md-12 ">
			
				<div class="col-md-12 top-content">
                <section id="no-more-tables">
                
                    <table class="table-bordered table-striped table-condensed cf">
                        <thead>
                          <tr>
                              <th>S.N.</th>
                              <th>Image Name</th>	  
                              <th>Image</th> 
                              <th>Description</th>  
                              <th>Sequence</th>
                              <th colspan="3">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						$i = 1;
						$banner_sql = mysqli_query($mysqli_conn,"select * from tbl_banner order by id desc");
						while ($row = mysqli_fetch_array($banner_sql)) {
						?>
                          <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $row['banner_name'];?></td>	  
                              <td>
                              <?php if ($row['banner_image']) { ?>
                                <img src="../uploadedDocument/banner/<?php print $row['banner_image']; ?>" width="150" height="100" />
                            <?php } ?>
                              </td>
                              <td><?php echo $row['banner_desc'];?></td>
                              <td><?php echo $row['banner_sequence']; ?></td>
                              <td><a href="managebanner.php?q=edit&id=<?php print $row['id'] ?>"> <img border="0" src="images/edit.png" align="Edit" title="Edit" /></a></td>
                              <td><a href="managebanner.php?act=del&delid=<?php print $row['id'] ?>" onClick="javascript:return confirm('Are you sure to delete ?')"><img border="0" src="images/delete.png" align="Delete" title="Delete" /></a>      </td>
                            </tr>
                        <?php $i++; } ?>  
                        </tbody>
                    </table>
                 
                      
                   
				</section>
				</div>
			
	</div>
