<!DOCTYPE html>
<html >
<head>
	<title>View Teacher</title>
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
	$TeacherID=$TeacherName=$Subject=$Lectures=$MobileNo="";
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sqlQuery = "SELECT ID,Name,Subject,NoOfLectures,MobileNo FROM teacher WHERE ID=".$_SESSION["TeacherID"];
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	  while($row=mysqli_fetch_array($result))
	   {
		   $TeacherID=$row['ID'];
		   $TeacherName=$row['Name'];
		   $Subject=$row['Subject'];
		   $Lectures=$row['NoOfLectures'];
		   $MobileNo=$row['MobileNo'];
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
	<div class="Table" style="height:65%;">
		<ul>
			<li style="background-color: #5379fa"><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="ViewModifyTeacher.php">View/ Edit/ Remove Teacher</a></font>
		<span id="span1"><center><u>Teacher Profile</u></center></span><br>
		<center>
			   <table border="1" cellspacing="3" cellpadding="5">
			     <tr><th>Teacher ID</th><td><?php echo $TeacherID ?></td><tr>
				 <tr><th>Teacher Name</th><td><?php echo $TeacherName ?></td><tr>
				 <tr><th>Subject</th><td><?php echo $Subject ?></td><tr>
				 <tr><th>Number of Lectures</th><td><?php echo $Lectures ?></td><tr>
				 <tr><th>Mobile Number</th><td><?php echo $MobileNo ?></td><tr>
			   </table>
		</center><br>
		<center style="color:red"><?php echo $error;?></span></center>
	</div>
</body>
</html>
