<!DOCTYPE html>
<html >
<head>
	<title>Add Teacher</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
    session_start();
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$TeacherID=$TeacherName=$Subject=$Lectures=$MobileNo="";
	$IDErr=$NameErr=$SubjectErr=$LectureErr=$MobileNoErr="";
	$existsErr="";
	$count=0;
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SESSION["AdminID"])))
	{
	   if (empty($_POST["tid"])) 
	   {
			$IDErr = "* Techer ID is required";
			$count+=1;
       }
	   else 
	   {
			$TeacherID = test_input($_POST["tid"]);
			if (!preg_match("/^[0-9]{5,8}$/",$TeacherID)) 
			{
			$IDErr = "* Length should be between 5-8"; 
			$count+=1;
			$TeacherID="";
			}
	   }
	   
	   if (empty($_POST["tname"])) 
	   {
			$NameErr = "* Teacher name is required";
			$count+=1;
       }
	   else 
	   {
			$TeacherName = test_input($_POST["tname"]);
			if (!preg_match("/^[A-Z][a-z]+$/",$TeacherName)) 
			{
			$NameErr = "* Enter the correct name. Ex:Rakhesh"; 
			$count+=1;
			$TeacherName ="";
			}
	   }
	   
	   if (empty($_POST["tsubject"])) 
	   {
			$SubjectErr = "* Choose the Subject";
			$count+=1;
       }
	   else 
	   {
			$Subject = test_input($_POST["tsubject"]);
	   }
	   
	   if (empty($_POST["tlecture"])) 
	   {
			$LectureErr = "* Choose the Number of Lectures";
			$count+=1;
       }
	   else 
	   {
			$Lectures = test_input($_POST["tlecture"]);
	   }
	   
	   if (empty($_POST["tphoneno"])) 
	   {
			$MobileNoErr = "* Enter your mobile number";
			$count+=1;
       }
	   else 
	   {
			$MobileNo = test_input($_POST["tphoneno"]);
			if (!preg_match("/^[0-9]{10}+$/",$MobileNo)) 
			{
			$MobileNoErr = "* Mobile number should have 10 digits"; 
			$count+=1;
			$MobileNo="";
			}
	   }
	   
	   if (isset($_POST['submit2']))
	   {
		  if($count==0)
		  {
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="INSERT INTO teacher(ID, Name, Subject, NoOfLectures, MobileNo) VALUES ('".$TeacherID."', '".$TeacherName."', '".$Subject."', '".$Lectures."', '".$MobileNo."')";			
            
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Teacher added successfully";
				$TeacherID=$TeacherName=$Subject=$Lectures=$MobileNo="";
			}
			else
			{
				$existsErr="* Teacher/Mobile No already exists";
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
	<div class="Table" style="height:65%;">
		<ul>
			<li style="background-color: #5379fa"><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<!--<a href="ViewModifyTeacher.php" style="text-decoration:none"><input type="submit" value="View/Edit"></a>-->
		<font style="font-size:20px"><a href="ViewModifyTeacher.php">View/ Edit/ Remove Teacher</a></font>
		<span id="span1"><center><u>Add Teacher</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:39%">Id </span><input type="text" name="tid" value="<?php echo $TeacherID;?>">
				<span style="color:red"> <?php echo $IDErr;?></span><br><br>
			<span style="margin-left:37%">Name </span><input type="text" name="tname" value="<?php echo $TeacherName;?>">
				<span style="color:red"> <?php echo $NameErr;?></span><br><br>
			<span style="margin-left:36%">Subject </span>
				<?php
			           $getSubjects = "SELECT DISTINCT Name from subject";
				       $result = mysqli_query($conn,$getSubjects);
				       echo "<select name='tsubject'>"; 
				       echo "<option value='$Subject'>$Subject</option>";
		               while ($row = mysqli_fetch_array($result)) 
						{
							if($row[0]!=$Subject)
							{
							echo '<option value="'.$row[0].'">'.$row[0].'</option>';
							}
						}
						echo '</select>';
				?>
				<span style="color:red"> <?php echo $SubjectErr;?></span><br><br>
			<span style="margin-left:32%">No of Lectures </span>
				<select name="tlecture">
					   <option value="<?php echo $Lectures;?>"><?php echo $Lectures;?></option>
					   <?php
					       $LecturesArr=array("1","2","3","4","5");
							$length2 = count($LecturesArr);
							for ($i = 0; $i < $length2; $i++) 
							{
								if($LecturesArr[$i]!=$Lectures)
								{
									echo '<option value="'.$LecturesArr[$i].'">'.$LecturesArr[$i].'</option>';
								}			
							}
					   ?>
				</select>
			    <span style="color:red"> <?php echo $LectureErr;?></span><br><br>
			<span style="margin-left:32%">Phone Number </span><input type="text" name="tphoneno" value="<?php echo $MobileNo;?>">
				<span style="color:red"> <?php echo $MobileNoErr;?></span><br><br>
			<input type="submit" value="Add" style="margin-left:45%" name="submit2"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
