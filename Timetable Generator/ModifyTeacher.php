<!DOCTYPE html>
<html >
<head>
	<title>Update Teacher</title>
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
	
	$TeacherID=$TeacherName=$Subject=$Lectures=$MobileNo="";
	$TeacherID2=$TeacherName2=$Subject2=$Lectures2=$MobileNo2="";
	$IDErr=$NameErr=$SubjectErr=$LectureErr=$MobileNoErr="";
	$updation="";
	$count=0;
	
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
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	   if (empty($_POST["tname"])) 
	   {
			$NameErr = "* Teacher name is required";
			$count+=1;
       }
	   else 
	   {
			$TeacherName2 = test_input($_POST["tname"]);
			if (!preg_match("/^[A-Z][a-z]+$/",$TeacherName2)) 
			{
			$NameErr = "* Enter the correct name. Ex:Rakhesh"; 
			$count+=1;
			$TeacherName2 = $TeacherName;
			}
	   }
	   
	   if (empty($_POST["tsubject"])) 
	   {
			$SubjectErr = "* Choose the Subject";
			$count+=1;
       }
	   else 
	   {
			$Subject2 = test_input($_POST["tsubject"]);
	   }
	   
	   if (empty($_POST["tlecture"])) 
	   {
			$LectureErr = "* Choose the Number of Lectures";
			$count+=1;
       }
	   else 
	   {
			$Lectures2 = test_input($_POST["tlecture"]);
	   }
	   
	   if (empty($_POST["tphoneno"])) 
	   {
			$MobileNoErr = "* Enter your mobile number";
			$count+=1;
       }
	   else 
	   {
			$MobileNo2 = test_input($_POST["tphoneno"]);
			if (!preg_match("/^[0-9]{10}+$/",$MobileNo2)) 
			{
			$MobileNoErr = "* Mobile number should have 10 digits"; 
			$count+=1;
			$MobileNo2=$MobileNo;
			}
	   }
	   
	   if (isset($_POST['submit2']))
	   {
		  if($count==0)
		  {
			$conn=mysqli_connect($servername,$username,$password,$dbname);
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="UPDATE teacher set Name='$TeacherName2', Subject='$Subject2', NoOfLectures='$Lectures2', MobileNo='$MobileNo2' WHERE ID=".$_SESSION["TeacherID"];			
			if(mysqli_query($conn,$sql))
			{
				header("location: ModifyTeacher.php"); 
				$updation="* Data Updated successfully";
			}
			else
			{
				$updation="* Something wrong. Check your mobile number";
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
		<span id="span1"><center><u>Update Teacher Details</u></center></span><br>
		
		
		<form method="POST">
			<span style="margin-left:39%">Id </span><input type="text" name="tid" value="<?php echo $TeacherID;?>" disabled>
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
			<input type="submit" value="Update" style="margin-left:45%" name="submit2"><br><br>
			<center style="color:red"><?php echo $updation;?></span></center>
		</form>	
	</div>
</body>
</html>
