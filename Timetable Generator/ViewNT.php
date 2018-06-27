!DOCTYPE html>
<html >
<head>
	<title>View timetable by class</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
table, th, td 
{
   border: 1px solid black;
   border-collapse: collapse;
}
th, td 
{
    padding: 15px;
	text-align: center;
}

table th
{
	background-color:#d0dafd;
}
table#tabColor tr:nth-child(even) {
    background-color: #eee;
}
table#tabColor tr:nth-child(odd) {
   background-color: #fff;
}
</style>

<body>
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
        </ul><br>
		<span id="span1"><center><u>Normal Timetable</u></center></span><br>
		<center>
			   <table id="tabColor">
			     <tr><th> </th>
					 <th>8.00-8.50</th>
					 <th>9.00-9.50</th>
					 <th>10.00-10.50</th>
					 <th>11.00-11.50</th>
					 <th rowspan="6">L<br/><br/>U<br/><br/>N<br/><br/>C<br/><br/>H</th>
					 <th>1.00-1.50</th>
					 <th>2.00-2.50</th>
					 <th>3.00-3.50</th>
					 <th>4.00-4.50</th>
				 </tr>
				 <tr>
					<th>Monday</th>
					<td>A1</td>
					<td>F1</td>
					<td>K1</td>
					<td>P1</td>
					
					<td>A2</td>
					<td>F2</td>
					<td>K2</td>
					<td>P2</td>
		         </tr>
				 <tr>
					<th>Tueday</th>
					<td>B1</td>
					<td>G1</td>
					<td>L1</td>
					<td>Q1</td>
				
					<td>B2</td>
					<td>G2</td>
					<td>L2</td>
					<td>Q2</td>
		         </tr>
				 <tr>
					<th>Wednesday</th>
					<td>C1</td>
					<td>H1</td>
					<td>M1</td>
					<td>R1</td>
					
					<td>C2</td>
					<td>H2</td>
					<td>M2</td>
					<td>R2</td>
		         </tr>
				 <tr>
					<th>Thursday</th>
					<td>D1</td>
					<td>I1</td>
					<td>N1</td>
					<td>S1</td>
					
					<td>D2</td>
					<td>I2</td>
					<td>N2</td>
					<td>S2</td>
		         </tr>
				 <tr>
					<th>Friday</th>
					<td>E1</td>
					<td>J1</td>
					<td>O1</td>
					<td>T1</td>
					
					<td>E2</td>
					<td>J2</td>
					<td>O2</td>
					<td>T2</td>
		         </tr>
			   </table>
		</center>
	</div>
</body>
</html>