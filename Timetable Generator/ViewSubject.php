<!DOCTYPE html>
<html >
<head>
	<title>View Subject</title>
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
	
	$Code=$Name=$Credits=$Class="";
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sqlQuery = "SELECT Code,Name,Credits,ClassNo FROM subject WHERE Code=".$_SESSION["SubjectCode"];
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	  while($row=mysqli_fetch_array($result))
	   {
		   $Code=$row['Code'];
		   $Name=$row['Name'];
		   $Credits=$row['Credits'];
		   $Class=$row['ClassNo'];
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
	<div class="Table" style="height:60%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li style="background-color: #5379fa"><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="ViewModifySubject.php">View/ Edit/ Remove Subject</a></font>
		<span id="span1"><center><u>Subject Details</u></center></span><br>
		<center>
			   <table border="1" cellspacing="3" cellpadding="5">
			     <tr><th>Subject Code</th><td><?php echo $Code ?></td><tr>
				 <tr><th>Subject Name</th><td><?php echo $Name ?></td><tr>
				 <tr><th>Credits</th><td><?php echo $Credits ?></td><tr>
				 <tr><th>For which class</th><td><?php echo $Class."th" ?></td><tr>
			   </table>
		</center><br>
		<center style="color:red"><?php echo $error;?></span></center>
	</div>
</body>
</html>
