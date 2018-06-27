<!DOCTYPE html>
<html >
<head>
	<title>Update Classroom</title>
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
	
	$RoomNo=$Capacity="";
	$RoomNo2=$Capacity2="";
	$RoomNoErr=$CapacityErr="";
	$updation="";
	$count=0;
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sqlQuery = "SELECT RoomNo,Capacity FROM classroom WHERE RoomNo=".$_SESSION["Classroom"];
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	  while($row=mysqli_fetch_array($result))
	   {
		   $RoomNo=$row['RoomNo'];
		   $Capacity=$row['Capacity'];
	   }
   }
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	   if (empty($_POST["crcapacity"])) 
	   {
			$CapacityErr = "* Enter capacity";
			$count+=1;
       }
	   else 
	   {
			$Capacity2 = test_input($_POST["crcapacity"]);
			if (!preg_match("/^[0-9]{2}$/",$Capacity2)) 
			{
			$CapacityErr = "* Maximum capacity should not exist 99"; 
			$count+=1;
			$Capacity2=$Capacity;
			}
	   }
	   
	   if (isset($_POST['submit5']))
	   {
		  if($count==0)
		  {
			$conn=mysqli_connect($servername,$username,$password,$dbname);
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="UPDATE classroom set Capacity='$Capacity2' WHERE RoomNo=".$_SESSION["Classroom"];			
			if(mysqli_query($conn,$sql))
			{
				header("location: ModifyClassroom.php"); 
				$updation="* Data Updated successfully";
			}
			else
			{
				$updation="* Something wrong. Already exists";
				//echo "Error:".$sql."<br>".mysqli_error();
			}
			mysqli_close($conn);
	      } 
	   }
	}
}
if(!isset($_SESSION["AdminID"]))
{
	$updation="* Unauthorized user. Admin not found";
}

	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
	<div class="grad"></div>
	<div class="header2">
		<div>Time Table Generator System</div>
	</div>
		
	<div class="Table" style="height:50%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li style="background-color: #5379fa"><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="ViewModifyRoom.php">View/ Edit/ Remove Classroom</a></font>
		<span id="span1"><center><u>Update Classroom Details</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:32%">Room Number </span><input type="text" name="crno" value="<?php echo $RoomNo;?>" disabled>
				<span style="color:red"> <?php echo $RoomNoErr;?></span><br><br>
			<span style="margin-left:35%">Capacity </span><input type="text" name="crcapacity" value="<?php echo $Capacity;?>">
				<span style="color:red"> <?php echo $CapacityErr;?></span><br><br>
			<input type="submit" value="Update" style="margin-left:45%" name="submit5"><br><br>
			<center style="color:red"><?php echo $updation;?></span></center>
		</form>	
	</div>
</body>
</html>
