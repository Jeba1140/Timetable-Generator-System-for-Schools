<!DOCTYPE html>
<html >
<head>
	<title>Create timetable</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	
	$TeacherID=$Code=$Class=$Timeslot="";
	$TeacherIDErr=$CodeErr=$ClassNameErr=$TimeslotErr="";
	$existsErr="";
	$count=0;
	
	$TeacherName=$SubjectName=$ClassRoom=$SlotTiminig=$SlotDay="";
	
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn)
	{
		die("Connection failed:".mysqli_connect_error());
	}
	
	if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SESSION["AdminID"])))
	{
	   if (empty($_POST["tid"])) 
	   {
			$TeacherIDErr= "* Techer ID is required";
			$count+=1;
       }
	   else 
	   {
			$TeacherID = test_input($_POST["tid"]);
			$sql="SELECT Name FROM teacher where ID='$TeacherID'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$TeacherName=$row["Name"];
	   }
	   
	   if (empty($_POST["scode"])) 
	   {
			$CodeErr = "* Subject code is required";
			$count+=1;
       }
	   else 
	   {
			$Code = test_input($_POST["scode"]);
			$sql1="SELECT Subject FROM teacher where ID='$TeacherID'";	
			$sql2="SELECT Name FROM subject where Code='$Code'";
			$result1=mysqli_query($conn,$sql1);
			$result2=mysqli_query($conn,$sql2);
			$row1=mysqli_fetch_array($result1);
			$row2=mysqli_fetch_array($result2);
			$SubjectName=$row2['Name'];
			if($row1['Subject']!=$row2['Name'])
			{
				$CodeErr ="* $TeacherID won't take this subject. He/She'll take only ".$row1['Subject'];
				$count+=1;
				$Code="";
			}
	   }
	   
	   if (empty($_POST["class"])) 
	   {
			$ClassNameErr = "* Choose class";
			$count+=1;
       }
	   else 
	   {
			$Class = test_input($_POST["class"]);
			
			$sql="SELECT RoomNumber FROM class where Class='$Class'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$ClassRoom=$row["RoomNumber"];
			
			$sql3="SELECT ClassNo FROM subject where Code='$Code'";	
			$sql4="SELECT Class FROM class where ClassName='$Class'";
			$result3=mysqli_query($conn,$sql3);
			$result4=mysqli_query($conn,$sql4);
			$row3=mysqli_fetch_array($result3);
			$row4=mysqli_fetch_array($result4);
			if($row3['ClassNo']!=$row4['Class'])
			{
				$ClassNameErr ="* $Code subject is only suitable for class ".$row3['ClassNo'];
				$count+=1;
				$Class="";
			}	
			else
			{
				$sql7="SELECT TeacherID FROM timetable where SubjectCode='$Code' and ClassName='$Class'";
				$result7=mysqli_query($conn,$sql7);
				$row7=mysqli_fetch_array($result7);
				$preferenceTeacher=$row7['TeacherID'];
				$cnt7 = mysqli_num_rows($result7);
				if($cnt7>0)
				{
					if($TeacherID!=$preferenceTeacher)
					{
						$ClassNameErr="* $preferenceTeacher teacher already taking the $Code subject for $Class class";
						$count+=1;
						$Class="";	
					}
					else
					{
						$sql="select count(Timeslot) from timetable where SubjectCode='$Code' and ClassName='$Class'";
						$sql1="select Credits from subject where Code='$Code'";
						$result=mysqli_query($conn,$sql);
						$result1=mysqli_query($conn,$sql1);
						$row=mysqli_fetch_array($result);
						$row1=mysqli_fetch_array($result1);
						$allotedSlots=$row['count(Timeslot)'];
						$totalSlots=$row1['Credits'];
						if($allotedSlots==$totalSlots)
						{
							$existsErr="* $Code is a $totalSlots credit subject. Maximum reached for $Class class.";
							$count+=1;
						}
						/*else
						{
							$sql="select count(distinct ClassName) from timetable where teacherID='$TeacherID'";
							$sql1="select NoOfLectures from teacher where ID='$TeacherID'";
							$result=mysqli_query($conn,$sql);
							$result1=mysqli_query($conn,$sql1);
							$row=mysqli_fetch_array($result);
							$row1=mysqli_fetch_array($result1);
							$allotedClasses=$row['count(distinct ClassName)'];
							$totalClasses=$row1['NoOfLectures'];
							if($allotedClasses==$totalClasses)
							{
								$sql2="select * from timetable where teacherID='$TeacherID' and ClassName='$Class'";
								$result2=mysqli_query($conn,$sql2);
								$row2=mysqli_fetch_array($result2);
								$cnt2 = mysqli_num_rows($result2);
								if($cnt2<1)
								{
									$TeacherIDErr="* $TeacherID won't take classes more than $totalClasses. Maximum reached.";
									$count+=1;	
								}
							}
						}*/
					}
				}
			}
	   }
	   
	   if (empty($_POST["timeslot"])) 
	   {
			$TimeslotErr = "* Enter timeslot";
			$count+=1;
       }
	   else 
	   {
			$Timeslot = test_input($_POST["timeslot"]);
		
			$sql="SELECT Time,Day FROM timeslot where Slot='$Timeslot '";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_array($result);
			$SlotTiminig=$row["Time"];
			$SlotDay=$row["Day"];
				
			$sql5="SELECT * FROM timetable where TeacherID='$TeacherID' and Timeslot='$Timeslot'";	
			$result5=mysqli_query($conn,$sql5);
			$row5=mysqli_fetch_array($result5);
			$cnt5 = mysqli_num_rows($result5);
			if($cnt5>0)
			{
				$TimeslotErr="* $Timeslot slot already allocated for the $TeacherID teacher. Choose another slot";
				$count+=1;
			    $Timeslot="";
			}
			else
			{
				$sql6="SELECT * FROM timetable where ClassName='$Class' and Timeslot='$Timeslot'";
				$result6=mysqli_query($conn,$sql6);
				$row6=mysqli_fetch_array($result6);
				$cnt6 = mysqli_num_rows($result6);
				$subject6=$row6["SubjectCode"];
				if($cnt6>0)
				{
					$TimeslotErr="* $Class class have $subject6 subject on $Timeslot slot";
					$count+=1;
					$Timeslot="";
				}
				else
				{
					$sql="select count(distinct ClassName) from timetable where teacherID='$TeacherID'";
					$sql1="select NoOfLectures from teacher where ID='$TeacherID'";
					$result=mysqli_query($conn,$sql);
					$result1=mysqli_query($conn,$sql1);
					$row=mysqli_fetch_array($result);
					$row1=mysqli_fetch_array($result1);
					$allotedClasses=$row['count(distinct ClassName)'];
					$totalClasses=$row1['NoOfLectures'];
					if($allotedClasses==$totalClasses)
					{
						$sql2="select * from timetable where teacherID='$TeacherID' and ClassName='$Class'";
						$result2=mysqli_query($conn,$sql2);
						$row2=mysqli_fetch_array($result2);
						$cnt2 = mysqli_num_rows($result2);
						if($cnt2<1)
						{
							$TeacherIDErr="* $TeacherID won't take subject for more than $totalClasses classes. Maximum reached.";
							$count+=1;	
						}
					}
				}
			}
	   }
	   
	   if (isset($_POST['submit6']))
	   {
		  if($count==0)
		  {
			if(!$conn)
			{
				die("Connection failed:".mysqli_connect_error());
			}
			$sql="INSERT INTO timetable(TeacherID, TeacherName, SubjectCode, SubjectName, ClassName, ClassRoom, Timeslot, SlotTiminig, SlotDay) VALUES ('".$TeacherID."', '".$TeacherName."', '".$Code."', '".$SubjectName."', '".$Class."', '".$ClassRoom."', '".$Timeslot."', '".$SlotTiminig."', '".$SlotDay."')";			
                                                       
			if(mysqli_query($conn,$sql))
			{
				$existsErr="* Time Slot allotted successfully";
				$TeacherID=$Code=$Class=$Timeslot="";
			}
			else
			{
				$existsErr="* Timeslot already exists for teacher";
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
	<div class="Table" style="height:70%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li style="background-color: #5379fa"><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="GetClassName.php">View/ Remove Time Slots By Class</a></font><br>
		<font style="font-size:20px"><a href="GetTeacherID.php">View/ Remove Time Slots By Teacher</a></font><br>
		<font style="font-size:20px"><a href="ViewNT.php">View Normal Timetable</a></font>
		<span id="span1"><center><u>Create Timetable</u></center></span><br>
		
		<form method="POST">
			<span style="margin-left:33%">Teacher ID </span>
			<?php
			   $getTeachers = "SELECT * from teacher";
				$result = mysqli_query($conn,$getTeachers);
				echo "<select name='tid'>";
				echo "<option value='$TeacherID'>$TeacherID</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$TeacherID)
					{
					echo '<option value="'.$row[0].'">'.$row[1].' - '.$row[0].'</option>';
					}
				}
			   echo '</select>';
			?>
			<span style="color:red"> <?php echo $TeacherIDErr;?></span><br><br>
			<span style="margin-left:32%">Subject Code </span>
			<?php
			   $getSubjects = "SELECT * from subject";
				$result = mysqli_query($conn,$getSubjects);
				echo "<select name='scode'>"; 
				echo "<option value='$Code'>$Code</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$Code)
					{
					echo '<option value="'.$row[0].'">'.$row[1].' - '.$row[0].'</option>';
					}
				}
			   echo '</select>';
			?>
				<span style="color:red"> <?php echo $CodeErr;?></span><br><br>
			<span style="margin-left:33%">Class Name</span>
			<?php
			   $getClassName = "SELECT * from class";
				$result = mysqli_query($conn,$getClassName);
				echo "<select name='class'>"; 
				echo "<option value='$Class'>$Class</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$Class)
					{
					echo '<option value="'.$row[2].'">'.$row[2].'</option>';
					}
				}
			   echo '</select>';
			?>
				<span style="color:red"> <?php echo $ClassNameErr;?></span><br><br>
			<span style="margin-left:35%">Timeslot </span>
			<?php
			   $getTimeslot = "SELECT * from timeslot";
				$result = mysqli_query($conn,$getTimeslot);
				echo "<select name='timeslot'>"; 
				echo "<option value='$Timeslot'>$Timeslot</option>";
		        while ($row = mysqli_fetch_array($result)) 
				{
					if($row[0]!=$Timeslot)
					{
					echo '<option value="'.$row[0].'">'.$row[0].'</option>';
					}
				}
			   echo '</select>';
			?>
				<span style="color:red"> <?php echo $TimeslotErr;?></span><br><br>
			<input type="submit" value="Create" style="margin-left:44%" name="submit6"><br><br>
			<center style="color:red"><?php echo $existsErr;?></span></center>
		</form>	
	</div>
</body>
</html>
