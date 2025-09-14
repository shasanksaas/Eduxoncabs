<?php
 $date = date('Y-m-d H:i:s');
//19800
echo $date = date('Y-m-d H:i:s',strtotime($date)+19800);
echo "<br>";
echo $nxt6hr = date('Y-m-d H:i:s',strtotime($date ."+6 hour"));
echo "<br>";
echo $nxt18hr = date('Y-m-d H:i:s',strtotime($date ."+18 hour"));
?>