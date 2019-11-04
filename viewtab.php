<?php
include("db_connect/db_connect.php");
?>
<!doctype html>
<html>
    <head>
        <title>SCOUL AUTO SCREEN</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
  <body>
  <div id="controller">
  <div id="header"> 
  <form method="post" action="viewtab.php">
  <table style="width:700px; margin:0px auto;">
  <tr>
  <td>
  Weigh Bridge Date:
  </td>
  <td>
  <input type="text" value="<?php if(isset($_POST['form_submit'])){ echo $_POST['weigh_date']; }else{ echo @date('Y-m-d'); }?>" name="weigh_date" placeholder="Weigh Bridge Date"/>
</td>
 <td>
  Weigh Bridge Number:
  </td>
  <td>
  <input type="text" value="<?php if(isset($_POST['form_submit'])){ echo $_POST['receipt_no']; }else{ } ?>" name="receipt_no" placeholder="Weigh Bridge No"/>
  <input type="submit" value="Go" style="background-color:green; color:white;" name="form_submit"/>
</td>
</table>
  </form>
</div>
<div id="content">
  <?php
  if(isset($_POST['form_submit'])){
  $weigh_no=strtoupper($_POST['receipt_no']);
  $weigh_date=$_POST['weigh_date'];
  }else{
  $weigh_no="";
  $weigh_date=@date('Y-m-d');
}
  $result=OpenCon()->query("select * from ipcam_table where (UPPER(CONCAT(receipt_no,receipt_date,vehicle_no)) LIKE '%".$weigh_no."%' OR '".$weigh_no."' IS NULL) AND receipt_date='". $weigh_date."' order by ip_id desc limit 150");
  while($row =$result->fetch_array()) {
   ?>
    <h1><?php echo $row['receipt_no'] ?> :<?php echo $row['vehicle_no'] ?> (<?php echo $row['receipt_date'] ?> )</h1>
   <div class="row" style="width:220px; float:left;">
    <a href="uploads/<?php echo $row['receipt_no'] ?>_CAM1_N.png"><img src="uploads/<?php echo $row['receipt_no'] ?>_CAM1_N.png" height="200px" width="220px">
    NEW CAM 1
    </a>
  </div>
   <div class="row" style="width:220px; float:left;">
    <a href="uploads/<?php echo $row['receipt_no'] ?>_CAM2_N.png"><img src="uploads/<?php echo $row['receipt_no'] ?>_CAM2_N.png" height="200px" width="220px">
    NEW CAM 2
    </a>
   </div>
      <div class="row" style="width:220px; float:left;">
    <a href="uploads/<?php echo $row['receipt_no'] ?>_CAM1_C.png"><img src="uploads/<?php echo $row['receipt_no'] ?>_CAM1_C.png" height="200px" width="220px">
    COMPLETE CAM 1
  </a>
   </div>
    <div class="row" style="width:220px; float:left;">
    <a href="uploads/<?php echo $row['receipt_no'] ?>_CAM2_C.png"><img src="uploads/<?php echo $row['receipt_no'] ?>_CAM2_C.png" height="200px" width="220px">
    COMPLETE CAM 2
  </a>
  </div>
   <?php
   }
   CloseCon(OpenCon());
  ?>
  </div>
  </div>
  </body>
</html>