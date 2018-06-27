<!DOCTYPE html>
<html >
<head>
	<title>Add Class</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$Class=$Section=$RoomNo="";
	$ClassErr=$SectionErr=$RoomNoErr="";
	$existsErr="";
	$count=0;
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	
	if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SESSION["AdminID"])))
	{
	   if (empty($_POST["cno"])) 
	   {
			$ClassErr = "* Class field is required";
			$count+=1;
       }
	   else 
	   {
			$Class = test_input($_POST["cno"]);
			if (!preg_match("/^[1-9]{1}[0-2]{0,1}$/",$Class)) 
			{
			$ClassErr = "* Class should be between 1-12"; 
			$count+=1;
			$Class="";
			}
	   }
	   
	   if (empty($_POST["csection"])) 
	   {
			$SectionErr = "* Choose the Number of Sections";
			$count+=1;
       }
	   else 
	   {
			$Section= test_input($_POST["csection"]);
	   }
	   
	   if (empty($_POST["croomno"])) 
	   {
			$RoomNoErr = "* Choose room number";
			$count+=1;
       }
	   else 
	   {
			$RoomNo = test_input($_POST["croomno"]);
			if (!preg_match("/^[0-9]{3}$/",$RoomNo)) 
			{
			$RoomNoErr = "* Room Number should contain three digits. Ex:001"; 
			$count+=1;
			$RoomNo="";
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
			$ClassName=$Class.$Section;
			$sql="INSERT INTO class(Class, Section, ClassName, RoomNumber) VALUES ('".$Class."', '".$Section."', '".$ClassName."', '".$RoomNo."')";			
            
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Class added successfully";
				$Class=$Section=$RoomNo="";
			}
			else
			{
				$existsErr="* Class/ClassRoom already exists";
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
		<span id="span1"><center><u>Add Class</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:37%">Class </span><input type="text" name="cno" value="<?php echo $Class;?>">
				<span style="color:red"> <?php echo $ClassErr;?></span><br><br>
			<span style="margin-left:36%">Section </span>
				<select name="csection" value="<?php echo $Section;?>">
					<option value="<?php echo $Section;?>"><?php echo $Section;?></option>
					   <?php
					       $SectionArr=array("A","B","C","D","E");
							$length3 = count($SectionArr);
							for ($i = 0; $i < $length3; $i++) 
							{
								if($SectionArr[$i]!=$Section)
								{
									echo '<option value="'.$SectionArr[$i].'">'.$SectionArr[$i].'</option>';
								}			
							}
					   ?>
				</select>
				<span style="color:red"> <?php echo $SectionErr;?></span><br><br>
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
			<input type="submit" value="Add" style="margin-left:45%" name="submit4"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
