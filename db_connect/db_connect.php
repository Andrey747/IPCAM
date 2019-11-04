<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "db_ipcam";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 return $conn;
 }
 //.......................check insert.....................
 function checkInsert($weigh_no,$weigh_date,$vehicle_no)
 {
 $result=OpenCon()->query("select * from ipcam_table where receipt_no='".$weigh_no."'");
 $rows= $result->num_rows;
 if($rows > 0){
    OpenCon()->query("UPDATE ipcam_table SET trans_status='COMPLETED' WHERE receipt_no='".$weigh_no."'");
    CloseCon(OpenCon());
    return  $rows;
 }else{

    OpenCon()->query("INSERT INTO ipcam_table (receipt_no,receipt_date,vehicle_no,trans_status) values ('".$weigh_no."','".$weigh_date."','".$vehicle_no."','PENDING')");
    CloseCon(OpenCon());
 	return 0;
 }
 }
//.......................close panel.........................
function CloseCon($conn)
 {
 $conn -> close();
 }
?>