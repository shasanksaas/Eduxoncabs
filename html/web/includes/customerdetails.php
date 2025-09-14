<div class="col-md-12"></div>

<div class="col-md-12"> <form action ='' method='post' >
        <input type='text' name='customer' placeholder='Contact No' /> 
        <input type='submit' name='search' value='Search' /> 
    </form>
</div>

<div class="col-md-12 ">



    <div class="col-md-12 top-content">

        <section id="no-more-tables">


            <?php
            if (isset($_POST['search']) && $_POST['customer'] != "") {
                $phone = $_POST['customer'];
                $getdta = $dbObj->fetch_data("tbl_order", "phone='$phone' and status='Completed'", " submit_dte DESC");
                $count = $dbObj->countRec("tbl_order", "phone='$phone' and status='Completed'", " submit_dte DESC");

                ?>
                <div class="col-md-12"> Name  :<?php echo $getdta[0]['buyer_name']; ?> </div>
                <div class="col-md-12"> Phone :<?php echo $getdta[0]['phone']; ?> </div>
                <div class="col-md-12"> Email :<?php echo $getdta[0]['email']; ?> </div>

                <table class="table-bordered table-striped table-condensed cf">

                    <thead>

                        <tr>

                            <th>S.N.</th>

                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th>From date & time</th>
                            <th>To date & time</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $i = 1;
                        if ($count > 0) {
                            foreach ($getdta as $key) {
                                ?>

                                <tr>

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $key['booked_car']; ?></td>
                                    <td><?php echo $key['amount']; ?></td>
                                    <td><?php echo $key['booked_dte']." ".$key['booked_tme'];
                    ?></td>
                                    <td><?php echo $key['returned_dte']." ".$key['return_tme'];
                                ?></td>



                                </tr>

                                <?php
                                $i++;
                            }
                        } else {
                            ?>

                            <tr><td colspan="5">Sorry No Record Found!!!</td></tr>

    <?php } ?>  

                    </tbody>

                </table>

    <?php
}
?>







        </section>

    </div>



</div>

