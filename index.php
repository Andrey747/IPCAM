<?php 

require("db_connect/db_connect.php");
if(isset($_GET['weigh_no']) && isset($_GET['weigh_date']) && isset($_GET['vehicle_no'])){

$weigh_no=$_GET['weigh_no']; ;
$weigh_date=$_GET['weigh_date'];
$vehicle_no=$_GET['vehicle_no'];
if(checkInsert($weigh_no,$weigh_date,$vehicle_no) > 0){
file_put_contents("uploads/".$weigh_no."_CAM1_C.png", fopen("http://admin:admin@123@192.168.4.63/ISAPI/Streaming/channels/101/picture", 'r'));
file_put_contents("uploads/".$weigh_no."_CAM2_C.png", fopen("http://admin:admin@123@192.168.4.69/ISAPI/Streaming/channels/101/picture", 'r'));
}else{
file_put_contents("uploads/".$weigh_no."_CAM1_N.png", fopen("http://admin:admin@123@192.168.4.63/ISAPI/Streaming/channels/101/picture", 'r'));
file_put_contents("uploads/".$weigh_no."_CAM2_N.png", fopen("http://admin:admin@123@192.168.4.69/ISAPI/Streaming/channels/101/picture", 'r'));
}
}
?>
<!doctype html>
<html>
    <head>
        <title>SCOUL AUTO SCREEN</title>
    </head>
    <body>
		<input type='hidden' id='weigh_no' value='<?php echo $_GET['weigh_no']; ?>'>
		<input type='hidden' id='weigh_date' value='<?php echo $_GET['weigh_date']; ?>'>
        <input type='hidden' id='vehicle_no' value='<?php echo $_GET['vehicle_no']; ?>'>
        <script type='text/javascript'>
       var weigh_no=document.getElementById("weigh_no").value;
       var weigh_date=document.getElementById("weigh_date").value;
       var vehicle_no=document.getElementById("vehicle_no").value;
       var host_name= window.location.hostname;
       var wind = window.open('http://'+host_name+'/IPCAM/index.php?weigh_no='+weigh_no+'&weigh_date='+weigh_date+'&vehicle_no='+vehicle_no+'','_self'); //open the current window
        wind.close(); 
        </script>

    </body>
</html>