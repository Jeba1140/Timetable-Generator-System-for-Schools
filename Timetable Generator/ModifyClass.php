<!DOCTYPE html>
<html >
<head>
	<title>Update Class</title>
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
	
	$ClassName=$RoomNo="";
	$RoomNo2="";
	$RoomNoErr="";
	$updation="";
	$count=0;
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sqlQuery = "SELECT ClassName,RoomNumber FROM class WHERE ClassName='{$_SESSION['Class']}'";
	   $result=mysqli_query($conn, $sqlQuery);
	   $count=0;
	  while($row=mysqli_fetch_array($result))
	   {
		   $ClassName=$row['ClassName'];
		   $RoomNo=$row['RoomNumber'];
	   }
   }
   
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{  
	   if (empty($_POST["croomno"])) 
	   {
			$RoomNoErr = "* Choose room number";
			$count+=1;
       }
	   else 
	   {
			$RoomNo2 = test_input($_POST["croomno"]);
			if (!preg_match("/^[0-9]{3}$/",$RoomNo2)) 
			{
			$RoomNoErr = "* Room Number should contain three digits. Ex:001"; 
			$count+=1;
			$RoomNo2=$RoomNo;
			}
	   }
	   
	   if (isset($_POST['submit4']))
	   {
		  if($count==0)
		  {
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="UPDATE class set RoomNumber='$RoomNo2' WHERE ClassName='{$_SESSION['Class']}'";		
			if(mysqli_query($conn,$sql))
			{
				header("location: ModifyClass.php"); 
				$updation="* Class Updated successfully";
			}
			else
			{
				$updation="* Something wrong. Classroom exists";
				//echo "Error:".$sql."<br>".mysqli_error();
			}
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
		<span id="span1"><center><u>Update Class Details</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:37%">Class </span><input type="text" name="cid" value="<?php echo $ClassName;?>" disabled><br><br>
			<span style="margin-left:32%">Room Number </span>
				<?php
			           $getRooms = "SELECT RoomNo from classroom";
				       $result = mysqli_query($conn,$getRooms);
				       echo "<select name='croomno'>"; 
				       echo "<option value='$RoomNo'>$RoomNo</option>";
		               while ($row = mysqli_fetch_array($result)) 
						{
							if($row[0]!=$RoomNo)
							{
							echo '<option value="'.$row[0].'">'.$row[0].'</option>';
							}
						}
						echo '</select>';
				?>
				<span style="color:red"> <?php echo $RoomNoErr;?></span><br><br>
			<input type="submit" value="Update" style="margin-left:45%" name="submit4"><br><br>
			<center style="color:red"><?php echo $updation;?></span></center>
		</form>	
	</div>
</body>
</html>
