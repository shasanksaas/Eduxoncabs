<!DOCTYPE html>
<html>
<body>

Output : 

<p id="demo"></p>


<script>
  

/*
 *  Date Difference between two date
 *  
 * var day_start = new Date("2018-03-09 09:00");
    var day_end = new Date("2018-03-11 10:00");

    var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
    var no_of_loop = total_days+1;
    
document.getElementById("demo").innerHTML = Math.round(total_days);
*/

/*  getting day name from date
var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
var d = new Date("2018-03-11 10:00");
var dayName = days[d.getDay()];
alert(dayName)
*/

/* var date = new Date("2018-03-09 09:00");
// add a day
var next_dt = new Date(date.setDate(date.getDate() + 1));
alert(next_dt)
*/

/* total hour
var day_start = new Date("2018-03-09 09:00");
var day_end = new Date("2018-03-12 10:00");

var diff = (day_end.getTime() - day_start.getTime()) / 1000;

diff /= (60 * 60);

var res = Math.abs(Math.round(diff));

document.getElementById("demo").innerHTML = Math.round(res);
*/

/*   add one day and start new date
 * 
var date = new Date("2018-03-09 09:00");
// add a day
var dt = new Date(date.setDate(date.getDate() + 1));
var dt1 = dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate()+" 00:00";
alert(dt1);
*/

    var day_start = new Date("2018-03-09 09:00");
    var day_start_date = new Date("2018-03-09 09:00");
    var day_end = new Date("2018-03-12 10:00");

    var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);
    var no_of_loop = Math.round(total_days+1);
    
    var price=0;
    var totalHourPerday=0;
    var total_price =0;
    for (var i = 0; i <no_of_loop; i++) {
        
        // getting day name from date
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var dayName = days[day_start.getDay()];
        console.log(dayName);
        if (dayName == 'Saturday' || dayName == 'Sunday') {
        price = 48;
        }else{
            price = 24;
        }
        var perhour = price / 24;
        
        var newstartTime = new Date(day_start_date.setDate(day_start.getDate() + 1)); // next day start is end of last date
            newstartTime = new Date(newstartTime.getFullYear() + "-" + (newstartTime.getMonth() + 1) + "-" + newstartTime.getDate()+" 00:00");  // next day start is end of last date
            
        var cur_date = new Date(day_start.getFullYear() + "-" + (day_start.getMonth() + 1) + "-" + day_start.getDate());  // only date not time
        var end_date = new Date(day_end.getFullYear() + "-" + (day_end.getMonth() + 1) + "-" + day_end.getDate());  // only date not time
         // Calculate total hour
        var current_day_start = newstartTime;
        
        // Total hour per day
        var diff = (newstartTime.getTime() - day_start.getTime())/ 1000;
            diff /= (60*60);
            totalHourPerday = Math.round(diff);

            
 
        if ("'"+cur_date +"'" == "'"+end_date+"'") {
            var diff = (day_end.getTime() - day_start.getTime())/ 1000;
            diff /= (60*60);
            totalHourPerday = Math.round(diff);
            total_price +=totalHourPerday*perhour
            console.log(day_start+" : "+newstartTime +" : "+totalHourPerday+" : "+total_price);
            
        }else{
 
            total_price +=totalHourPerday*perhour
            
            console.log(day_start+" : "+newstartTime +" : "+totalHourPerday+" : "+total_price);
        }

        day_start = newstartTime;

        
    }

</script>

</body>
</html> 
