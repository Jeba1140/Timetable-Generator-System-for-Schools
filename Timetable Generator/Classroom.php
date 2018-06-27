<!DOCTYPE html>
<html >
<head>
	<title>Add Classroom</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$RoomNo=$Capacity="";
	$RoomNoErr=$CapacityErr="";
	$existsErr="";
	$count=0;
	
	if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SESSION["AdminID"]))) 
	{
	   if (empty($_POST["crno"])) 
	   {
			$RoomNoErr= "* Room Number is required";
			$count+=1;
       }
	   else 
	   {
			$RoomNo = test_input($_POST["crno"]);
			if (!preg_match("/^[0-9]{3}$/",$RoomNo)) 
			{
			$RoomNoErr = "* Room Number should contain three digits. Ex:001"; 
			$count+=1;
			$RoomNo="";
			}
	   }
	   
	   if (empty($_POST["crcapacity"])) 
	   {
			$CapacityErr = "* Enter capacity";
			$count+=1;
       }
	   else 
	   {
			$Capacity = test_input($_POST["crcapacity"]);
			if (!preg_match("/^[0-9]{2}$/",$Capacity)) 
			{
			$CapacityErr = "* Maximum capacity should not exist 99"; 
			$count+=1;
			$Capacity="";
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
			$sql="INSERT INTO classroom(RoomNo, Capacity) VALUES ('".$RoomNo."', '".$Capacity."')";			
            
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Classroom added successfully";
				$RoomNo=$Capacity="";
			}
			else
			{
				$existsErr="* Classroom already exists";
				//echo "Error:".$sql."<br>".mysqli_error();
			}
	      } 
	   }
	}
	if(!isset($_SESSION["AdminID"]))
	{
		$existsErr="* Unauthorized user. Admin not found";
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
		<span id="span1"><center><u>Add Classroom</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:32%">Room Number </span><input type="text" name="crno" value="<?php echo $RoomNo;?>">
				<span style="color:red"> <?php echo $RoomNoErr;?></span><br><br>
			<span style="margin-left:35%">Capacity </span><input type="text" name="crcapacity" value="<?php echo $Capacity;?>">
				<span style="color:red"> <?php echo $CapacityErr;?></span><br><br>
			<input type="submit" value="Add" style="margin-left:45%" name="submit5"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
