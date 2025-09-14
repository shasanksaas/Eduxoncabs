<?php

$start_book_time = "2018-05-12 18:00:00";

$end_book_time = "2018-05-16 18:00:00";
$vehicle_cost = 2200;
$vehicle_weekend_cost = 2300;

echo calc_price($start_book_time,$end_book_time,$vehicle_cost,$vehicle_weekend_cost);

function calc_price($start_book_time, $end_book_time , $vehicle_cost , $vehicle_weekend_cost){

        $strt_dt_tm = $start_book_time;
        $strt_date_tm = $start_book_time;
        $end_dt_tm = $end_book_time;


        $end_date_only = date('Y-m-d 00:00:00', strtotime($end_dt_tm)); // only date not time
        $start_date_only = date('Y-m-d 00:00:00', strtotime($strt_date_tm)); // only date not time


        $totalhr = round((strtotime($end_dt_tm) - strtotime($start_date_only))/3600);
        if($totalhr<24){
            return $total_price=$vehicle_cost;
        }


        $time1 = strtotime($strt_date_tm);
        $time2 = strtotime($end_dt_tm);
         //$no_of_loop =  ceil( ($time2-$time1) /(60*60*24));
         $no_of_loop = ceil($totalhr/24);
         if($totalhr%24==0){
                                
            $no_of_loop+=1;
        }


        $cur_date = "";
        $total_price="";

        for ($i = 0; $i < $no_of_loop; $i++) {
            $strtdt = strtotime($strt_dt_tm);
            $day = strtolower(date("l", $strtdt));
           
           $price = $vehicle_cost;;
           
            if ($day == 'saturday' || $day == 'sunday') {
                $price = $vehicle_weekend_cost;
            }
            
             $perhour = $price / 24;

             $day_end_time = date('Y-m-d 00:00:00', strtotime($strt_dt_tm . "+1 day"));// next day start is end of last date
           
            
             $totalhrperday = (strtotime($day_end_time) - strtotime($strt_dt_tm)) / 3600; // no of hour per day
            
             $daystart_time =date('Y-m-d 00:00:00', strtotime($strt_dt_tm)); // new day start time from 12.00 pm
             
             $cur_date = date('Y-m-d',strtotime($strt_dt_tm));  // date of current date
             $start_new_date = date('Y-m-d',strtotime($day_end_time)); // new date start
             
           
            $end_date = date('Y-m-d',strtotime($end_dt_tm)); // date of end date

            if ( $cur_date == $end_date) {
                
                $totalhrperday = (strtotime($end_dt_tm) - strtotime($daystart_time) )/3600; 
                $total_price += round($totalhrperday* $perhour);
                
                
            }else{
            
             $total_price += round($totalhrperday * $perhour); 

             //console.log(cur_date + " : " + totalHourPerday + " : " + perhour + " : " + total_price);
              //echo " : ".$total_price ." - $totalhrperday : $perhour <br>";
            }
            echo $cur_date ." - $totalhrperday : $perhour :".$total_price ."<br>";
           
            $strt_dt_tm = date('Y-m-d 00:00:00', strtotime($strt_dt_tm . "+1 day"));
        }
return  round($total_price);
}

?>