<!DOCTYPE html>
<html >
<head>
	<title>View Class</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	session_start();
if(isset($_SESSION["AdminID"]))
{
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	$error="";
	$Class=$Section=$RoomNo=$Capacity="";
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
    {
	   $sqlQuery = "SELECT Class,Section,RoomNumber FROM class WHERE ClassName='{$_SESSION['Class']}'";
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	   while($row=mysqli_fetch_array($result))
	   {
		   $Class=$row['Class'];
		   $Section=$row['Section'];
		   $RoomNo=$row['RoomNumber'];
		   $sql="SELECT Capacity FROM classroom where RoomNo='$RoomNo'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$Capacity=$row['Capacity'];
	   }
    }
}
if(!isset($_SESSION["AdminID"]))
{
	$error="* Unauthorized user. Admin not found";
}
?>
	<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
		
	<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
	<div class="Table" style="height:55%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li style="background-color: #5379fa"><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="ViewModifyClass.php">View/ Edit/ Remove Class</a></font>
		<span id="span1"><center><u>Class Details</u></center></span><br>
		<center>
			   <table border="1" cellspacing="3" cellpadding="5">
			     <tr><th>Class</th><td><?php echo $Class; ?></td><tr>
				 <tr><th>Section</th><td><?php echo $Section; ?></td><tr>
				 <tr><th>Room Number</th><td><?php echo $RoomNo; ?></td><tr>
				 <tr><th>Maximum students</th><td><?php echo $Capacity; ?></td><tr>
			   </table>
		</center><br>
		<center style="color:red"><?php echo $error;?></span></center>
	</div>
</body>
</html>
