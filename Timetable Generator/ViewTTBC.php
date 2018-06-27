!DOCTYPE html>
<html >
<head>
	<title>View timetable by class</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
table
{
	width:80%;
}
table, th, td 
{
   border: 1px solid black;
   border-collapse: collapse;
}
th, td 
{
    padding: 18px;
	text-align: center;
}
th
{
	font-size:13px;
}
td
{
	font-size:12px;
}
table th
{
	background-color:#99CCFF;  //#d0dafd
}
table#tabColor tr:nth-child(even) {
    background-color: rgb(204, 255, 51);  //#eee
}
table#tabColor tr:nth-child(odd) {
   background-color: rgb(204, 255, 51);  //#fff
}
</style>

<body>
<?php
	session_start();
if(isset($_SESSION["AdminID"]))
{
	$servername="localhost";
	$username="root";
	$password="";
    $dbname="Timetable";
	$conn=mysqli_connect($servername,$username,$password,$dbname);
	$error="";
	$t1=$t2=$t3=$t4=$t5=$t6=$t7=$t8=$t9=$t10=$t11=$t12=$t13=$t14=$t15=$t16=$t17=$t18=$t19=$t20=$t21=$t22=$t23=$t24=$t25=$t26=$t27=$t28=$t29=$t30=$t31=$t32=$t33=$t34=$t35=$t36=$t37=$t38=$t39=$t40="";
	$s1=$s2=$s3=$s4=$s5=$s6=$s7=$s8=$s9=$s10=$s11=$s12=$s13=$s14=$s15=$s16=$s17=$s18=$s19=$s20=$s21=$s22=$s23=$s24=$s25=$s26=$s27=$s28=$s29=$s30=$s31=$s32=$s33=$s34=$s35=$s36=$s37=$s38=$s39=$s40="";
	$r1=$r2=$r3=$r4=$r5=$r6=$r7=$r8=$r9=$r10=$r11=$r12=$r13=$r14=$r15=$r16=$r17=$r18=$r19=$r20=$r21=$r22=$r23=$r24=$r25=$r26=$r27=$r28=$r29=$r30=$r31=$r32=$r33=$r34=$r35=$r36=$r37=$r38=$r39=$r40="";
    if(!$conn)
    {
	 die("Connection failed:".mysqli_connect_error());
    }
	else
   {
	   $sql1 = "SELECT * FROM timetable WHERE Timeslot='A1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result1=mysqli_query($conn, $sql1);
	   $rc1=mysqli_fetch_array($result1);
	   $cnt1 = mysqli_num_rows($result1);
	   if($cnt1>0)
	   {
		   $t1=$rc1[1].'('.$rc1[0].')';
		   $s1=$rc1[3].'('.$rc1[2].')';
		   $r1='Classroom:'.$rc1[5];
	   }
	   else
	   {
		   $t1="A1";
	   }
	   
	   $sql2 = "SELECT * FROM timetable WHERE Timeslot='B1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result2=mysqli_query($conn, $sql2);
	   $rc2=mysqli_fetch_array($result2);
	   $cnt2 = mysqli_num_rows($result2);
	   if($cnt2>0)
	   {
		   $t2=$rc2[1].'('.$rc2[0].')';
		   $s2=$rc2[3].'('.$rc2[2].')';
		   $r2='Classroom:'.$rc2[5];
	   }
	   else
	   {
		   $t2="B1";
	   }
	   
	   $sql3 = "SELECT * FROM timetable WHERE Timeslot='C1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result3=mysqli_query($conn, $sql3);
	   $rc3=mysqli_fetch_array($result3);
	   $cnt3 = mysqli_num_rows($result3);
	   if($cnt3>0)
	   {
		   $t3=$rc3[1].'('.$rc3[0].')';
		   $s3=$rc3[3].'('.$rc3[2].')';
		   $r3='Classroom:'.$rc3[5];
	   }
	   else
	   {
		   $t3="C1";
	   }
	   
	   $sql4 = "SELECT * FROM timetable WHERE Timeslot='D1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result4=mysqli_query($conn, $sql4);
	   $rc4=mysqli_fetch_array($result4);
	   $cnt4 = mysqli_num_rows($result4);
	   if($cnt4>0)
	   {
		   $t4=$rc4[1].'('.$rc4[0].')';
		   $s4=$rc4[3].'('.$rc4[2].')';
		   $r4='Classroom:'.$rc4[5];
	   }
	   else
	   {
		   $t4="D1";
	   }
	   
	   $sql5 = "SELECT * FROM timetable WHERE Timeslot='E1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result5=mysqli_query($conn, $sql5);
	   $rc5=mysqli_fetch_array($result5);
	   $cnt5 = mysqli_num_rows($result5);
	   if($cnt5>0)
	   {
		   $t5=$rc5[1].'('.$rc5[0].')';
		   $s5=$rc5[3].'('.$rc5[2].')';
		   $r5='Classroom:'.$rc5[5];
	   }
	   else
	   {
		   $t5="E1";
	   }
	   
	   $sql6 = "SELECT * FROM timetable WHERE Timeslot='F1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result6=mysqli_query($conn, $sql6);
	   $rc6=mysqli_fetch_array($result6);
	   $cnt6 = mysqli_num_rows($result6);
	   if($cnt6>0)
	   {
		   $t6=$rc6[1].'('.$rc6[0].')';
		   $s6=$rc6[3].'('.$rc6[2].')';
		   $r6='Classroom:'.$rc6[5];
	   }
	   else
	   {
		   $t6="F1";
	   }
	   
	   $sql7 = "SELECT * FROM timetable WHERE Timeslot='G1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result7=mysqli_query($conn, $sql7);
	   $rc7=mysqli_fetch_array($result7);
	   $cnt7 = mysqli_num_rows($result7);
	   if($cnt7>0)
	   {
		   $t7=$rc7[1].'('.$rc7[0].')';
		   $s7=$rc7[3].'('.$rc7[2].')';
		   $r7='Classroom:'.$rc7[5];
	   }
	   else
	   {
		   $t7="G1";
	   }
	   
	   $sql8 = "SELECT * FROM timetable WHERE Timeslot='H1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result8=mysqli_query($conn, $sql8);
	   $rc8=mysqli_fetch_array($result8);
	   $cnt8 = mysqli_num_rows($result8);
	   if($cnt8>0)
	   {
		   $t8=$rc8[1].'('.$rc8[0].')';
		   $s8=$rc8[3].'('.$rc8[2].')';
		   $r8='Classroom:'.$rc8[5];
	   }
	   else
	   {
		   $t8="H1";
	   }
	   
	   $sql9 = "SELECT * FROM timetable WHERE Timeslot='I1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result9=mysqli_query($conn, $sql9);
	   $rc9=mysqli_fetch_array($result9);
	   $cnt9 = mysqli_num_rows($result9);
	   if($cnt9>0)
	   {
		   $t9=$rc9[1].'('.$rc9[0].')';
		   $s9=$rc9[3].'('.$rc9[2].')';
		   $r9='Classroom:'.$rc9[5];
	   }
	   else
	   {
		   $t9="I1";
	   }
	   
	   $sql10 = "SELECT * FROM timetable WHERE Timeslot='J1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result10=mysqli_query($conn, $sql10);
	   $rc10=mysqli_fetch_array($result10);
	   $cnt10 = mysqli_num_rows($result10);
	   if($cnt10>0)
	   {
		   $t10=$rc10[1].'('.$rc10[0].')';
		   $s10=$rc10[3].'('.$rc10[2].')';
		   $r10='Classroom:'.$rc10[5];
	   }
	   else
	   {
		   $t10="J1";
	   }
	   
	   $sql11 = "SELECT * FROM timetable WHERE Timeslot='K1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result11=mysqli_query($conn, $sql11);
	   $rc11=mysqli_fetch_array($result11);
	   $cnt11 = mysqli_num_rows($result11);
	   if($cnt11>0)
	   {
		   $t11=$rc11[1].'('.$rc11[0].')';
		   $s11=$rc11[3].'('.$rc11[2].')';
		   $r11='Classroom:'.$rc11[5];
	   }
	   else
	   {
		   $t11="K1";
	   }
	   
	   $sql12 = "SELECT * FROM timetable WHERE Timeslot='L1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result12=mysqli_query($conn, $sql12);
	   $rc12=mysqli_fetch_array($result12);
	   $cnt12 = mysqli_num_rows($result12);
	   if($cnt12>0)
	   {
		   $t12=$rc12[1].'('.$rc12[0].')';
		   $s12=$rc12[3].'('.$rc12[2].')';
		   $r12='Classroom:'.$rc12[5];
	   }
	   else
	   {
		   $t12="L1";
	   }
	   
	   $sql13 = "SELECT * FROM timetable WHERE Timeslot='M1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result13=mysqli_query($conn, $sql13);
	   $rc13=mysqli_fetch_array($result13);
	   $cnt13 = mysqli_num_rows($result13);
	   if($cnt13>0)
	   {
		   $t13=$rc13[1].'('.$rc13[0].')';
		   $s13=$rc13[3].'('.$rc13[2].')';
		   $r13='Classroom:'.$rc13[5];
	   }
	   else
	   {
		   $t13="M1";
	   }
	   
	   $sql14 = "SELECT * FROM timetable WHERE Timeslot='N1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result14=mysqli_query($conn, $sql14);
	   $rc14=mysqli_fetch_array($result14);
	   $cnt14 = mysqli_num_rows($result14);
	   if($cnt14>0)
	   {
		   $t14=$rc14[1].'('.$rc14[0].')';
		   $s14=$rc14[3].'('.$rc14[2].')';
		   $r14='Classroom:'.$rc14[5];
	   }
	   else
	   {
		   $t14="N1";
	   }
	   
	   $sql15 = "SELECT * FROM timetable WHERE Timeslot='O1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result15=mysqli_query($conn, $sql15);
	   $rc15=mysqli_fetch_array($result15);
	   $cnt15 = mysqli_num_rows($result15);
	   if($cnt15>0)
	   {
		   $t15=$rc15[1].'('.$rc15[0].')';
		   $s15=$rc15[3].'('.$rc15[2].')';
		   $r15='Classroom:'.$rc15[5];
	   }
	   else
	   {
		   $t15="O1";
	   }
	   
	   $sql16 = "SELECT * FROM timetable WHERE Timeslot='P1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result16=mysqli_query($conn, $sql16);
	   $rc16=mysqli_fetch_array($result16);
	   $cnt16 = mysqli_num_rows($result16);
	   if($cnt16>0)
	   {
		   $t16=$rc16[1].'('.$rc16[0].')';
		   $s16=$rc16[3].'('.$rc16[2].')';
		   $r16='Classroom:'.$rc16[5];
	   }
	   else
	   {
		   $t16="P1";
	   }
	   
	   $sql17 = "SELECT * FROM timetable WHERE Timeslot='Q1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result17=mysqli_query($conn, $sql17);
	   $rc17=mysqli_fetch_array($result17);
	   $cnt17 = mysqli_num_rows($result17);
	   if($cnt17>0)
	   {
		   $t17=$rc17[1].'('.$rc17[0].')';
		   $s17=$rc17[3].'('.$rc17[2].')';
		   $r17='Classroom:'.$rc17[5];
	   }
	   else
	   {
		   $t17="Q1";
	   }
	   
	   $sql18 = "SELECT * FROM timetable WHERE Timeslot='R1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result18=mysqli_query($conn, $sql18);
	   $rc18=mysqli_fetch_array($result18);
	   $cnt18 = mysqli_num_rows($result18);
	   if($cnt18>0)
	   {
		   $t18=$rc18[1].'('.$rc18[0].')';
		   $s18=$rc18[3].'('.$rc18[2].')';
		   $r18='Classroom:'.$rc18[5];
	   }
	   else
	   {
		   $t18="R1";
	   }
	   
	   $sql19 = "SELECT * FROM timetable WHERE Timeslot='S1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result19=mysqli_query($conn, $sql19);
	   $rc19=mysqli_fetch_array($result19);
	   $cnt19 = mysqli_num_rows($result19);
	   if($cnt19>0)
	   {
		   $t19=$rc19[1].'('.$rc19[0].')';
		   $s19=$rc19[3].'('.$rc19[2].')';
		   $r19='Classroom:'.$rc19[5];
	   }
	   else
	   {
		   $t19="S1";
	   }
	   
	   $sql20 = "SELECT * FROM timetable WHERE Timeslot='T1' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result20=mysqli_query($conn, $sql20);
	   $rc20=mysqli_fetch_array($result20);
	   $cnt20 = mysqli_num_rows($result20);
	   if($cnt20>0)
	   {
		   $t20=$rc20[1].'('.$rc20[0].')';
		   $s20=$rc20[3].'('.$rc20[2].')';
		   $r20='Classroom:'.$rc20[5];
	   }
	   else
	   {
		   $t20="T1";
	   }
	   
	   
	   $sql21 = "SELECT * FROM timetable WHERE Timeslot='A2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result21=mysqli_query($conn, $sql21);
	   $rc21=mysqli_fetch_array($result21);
	   $cnt21 = mysqli_num_rows($result21);
	   if($cnt21>0)
	   {
		   $t21=$rc21[1].'('.$rc21[0].')';
		   $s21=$rc21[3].'('.$rc21[2].')';
		   $r21='Classroom:'.$rc21[5];
	   }
	   else
	   {
		   $t21="A2";
	   }
	   
	   $sql22 = "SELECT * FROM timetable WHERE Timeslot='B2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result22=mysqli_query($conn, $sql22);
	   $rc22=mysqli_fetch_array($result22);
	   $cnt22 = mysqli_num_rows($result22);
	   if($cnt22>0)
	   {
		   $t22=$rc22[1].'('.$rc22[0].')';
		   $s22=$rc22[3].'('.$rc22[2].')';
		   $r22='Classroom:'.$rc22[5];
	   }
	   else
	   {
		   $t22="B2";
	   }
	   
	   $sql23 = "SELECT * FROM timetable WHERE Timeslot='C2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result23=mysqli_query($conn, $sql23);
	   $rc23=mysqli_fetch_array($result23);
	   $cnt23 = mysqli_num_rows($result23);
	   if($cnt23>0)
	   {
		   $t23=$rc23[1].'('.$rc23[0].')';
		   $s23=$rc23[3].'('.$rc23[2].')';
		   $r23='Classroom:'.$rc23[5];
	   }
	   else
	   {
		   $t23="C2";
	   }
	   
	   $sql24 = "SELECT * FROM timetable WHERE Timeslot='D2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result24=mysqli_query($conn, $sql24);
	   $rc24=mysqli_fetch_array($result24);
	   $cnt24 = mysqli_num_rows($result24);
	   if($cnt24>0)
	   {
		   $t24=$rc24[1].'('.$rc24[0].')';
		   $s24=$rc24[3].'('.$rc24[2].')';
		   $r24='Classroom:'.$rc24[5];
	   }
	   else
	   {
		   $t24="D2";
	   }
	   
	   $sql25 = "SELECT * FROM timetable WHERE Timeslot='E2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result25=mysqli_query($conn, $sql25);
	   $rc25=mysqli_fetch_array($result25);
	   $cnt25 = mysqli_num_rows($result25);
	   if($cnt25>0)
	   {
		   $t25=$rc25[1].'('.$rc25[0].')';
		   $s25=$rc25[3].'('.$rc25[2].')';
		   $r25='Classroom:'.$rc25[5];
	   }
	   else
	   {
		   $t25="E2";
	   }
	   
	   $sql26 = "SELECT * FROM timetable WHERE Timeslot='F2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result26=mysqli_query($conn, $sql26);
	   $rc26=mysqli_fetch_array($result26);
	   $cnt26 = mysqli_num_rows($result26);
	   if($cnt26>0)
	   {
		   $t26=$rc26[1].'('.$rc26[0].')';
		   $s26=$rc26[3].'('.$rc26[2].')';
		   $r26='Classroom:'.$rc26[5];
	   }
	   else
	   {
		   $t26="F2";
	   }
	   
	   $sql27 = "SELECT * FROM timetable WHERE Timeslot='G2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result27=mysqli_query($conn, $sql27);
	   $rc27=mysqli_fetch_array($result27);
	   $cnt27 = mysqli_num_rows($result27);
	   if($cnt27>0)
	   {
		   $t27=$rc27[1].'('.$rc27[0].')';
		   $s27=$rc27[3].'('.$rc27[2].')';
		   $r27='Classroom:'.$rc27[5];
	   }
	   else
	   {
		   $t27="G2";
	   }
	   
	   $sql28 = "SELECT * FROM timetable WHERE Timeslot='H2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result28=mysqli_query($conn, $sql28);
	   $rc28=mysqli_fetch_array($result28);
	   $cnt28 = mysqli_num_rows($result28);
	   if($cnt28>0)
	   {
		   $t28=$rc28[1].'('.$rc28[0].')';
		   $s28=$rc28[3].'('.$rc28[2].')';
		   $r28='Classroom:'.$rc28[5];
	   }
	   else
	   {
		   $t28="H2";
	   }
	   
	   $sql29 = "SELECT * FROM timetable WHERE Timeslot='I2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result29=mysqli_query($conn, $sql29);
	   $rc29=mysqli_fetch_array($result29);
	   $cnt29 = mysqli_num_rows($result29);
	   if($cnt29>0)
	   {
		   $t29=$rc29[1].'('.$rc29[0].')';
		   $s29=$rc29[3].'('.$rc29[2].')';
		   $r29='Classroom:'.$rc29[5];
	   }
	   else
	   {
		   $t29="I2";
	   }
	   
	   $sql30 = "SELECT * FROM timetable WHERE Timeslot='J2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result30=mysqli_query($conn, $sql30);
	   $rc30=mysqli_fetch_array($result30);
	   $cnt30 = mysqli_num_rows($result30);
	   if($cnt30>0)
	   {
		   $t30=$rc30[1].'('.$rc30[0].')';
		   $s30=$rc30[3].'('.$rc30[2].')';
		   $r30='Classroom:'.$rc30[5];
	   }
	   else
	   {
		   $t30="J2";
	   }
	   
	   $sql31 = "SELECT * FROM timetable WHERE Timeslot='K2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result31=mysqli_query($conn, $sql31);
	   $rc31=mysqli_fetch_array($result31);
	   $cnt31 = mysqli_num_rows($result31);
	   if($cnt31>0)
	   {
		   $t31=$rc31[1].'('.$rc31[0].')';
		   $s31=$rc31[3].'('.$rc31[2].')';
		   $r31='Classroom:'.$rc31[5];
	   }
	   else
	   {
		   $t31="K2";
	   }
	   
	   $sql32 = "SELECT * FROM timetable WHERE Timeslot='L2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result32=mysqli_query($conn, $sql32);
	   $rc32=mysqli_fetch_array($result32);
	   $cnt32 = mysqli_num_rows($result32);
	   if($cnt32>0)
	   {
		   $t32=$rc32[1].'('.$rc32[0].')';
		   $s32=$rc32[3].'('.$rc32[2].')';
		   $r32='Classroom:'.$rc32[5];
	   }
	   else
	   {
		   $t32="L2";
	   }
	   
	   $sql33 = "SELECT * FROM timetable WHERE Timeslot='M2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result33=mysqli_query($conn, $sql33);
	   $rc33=mysqli_fetch_array($result33);
	   $cnt33 = mysqli_num_rows($result33);
	   if($cnt33>0)
	   {
		   $t33=$rc33[1].'('.$rc33[0].')';
		   $s33=$rc33[3].'('.$rc33[2].')';
		   $r33='Classroom:'.$rc33[5];
	   }
	   else
	   {
		   $t33="M2";
	   }
	   
	   $sql34 = "SELECT * FROM timetable WHERE Timeslot='N2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result34=mysqli_query($conn, $sql34);
	   $rc34=mysqli_fetch_array($result34);
	   $cnt34 = mysqli_num_rows($result34);
	   if($cnt34>0)
	   {
		   $t34=$rc34[1].'('.$rc34[0].')';
		   $s34=$rc34[3].'('.$rc34[2].')';
		   $r34='Classroom:'.$rc34[5];
	   }
	   else
	   {
		   $t34="N2";
	   }
	   
	   $sql35 = "SELECT * FROM timetable WHERE Timeslot='O2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result35=mysqli_query($conn, $sql35);
	   $rc35=mysqli_fetch_array($result35);
	   $cnt35 = mysqli_num_rows($result35);
	   if($cnt35>0)
	   {
		   $t35=$rc35[1].'('.$rc35[0].')';
		   $s35=$rc35[3].'('.$rc35[2].')';
		   $r35='Classroom:'.$rc35[5];
	   }
	   else
	   {
		   $t35="O2";
	   }
	   
	   $sql36 = "SELECT * FROM timetable WHERE Timeslot='P2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result36=mysqli_query($conn, $sql36);
	   $rc36=mysqli_fetch_array($result36);
	   $cnt36 = mysqli_num_rows($result36);
	   if($cnt36>0)
	   {
		   $t36=$rc36[1].'('.$rc36[0].')';
		   $s36=$rc36[3].'('.$rc36[2].')';
		   $r36='Classroom:'.$rc36[5];
	   }
	   else
	   {
		   $t36="P2";
	   }
	   
	   $sql37 = "SELECT * FROM timetable WHERE Timeslot='Q2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result37=mysqli_query($conn, $sql37);
	   $rc37=mysqli_fetch_array($result37);
	   $cnt37 = mysqli_num_rows($result37);
	   if($cnt37>0)
	   {
		   $t37=$rc37[1].'('.$rc37[0].')';
		   $s37=$rc37[3].'('.$rc37[2].')';
		   $r37='Classroom:'.$rc37[5];
	   }
	   else
	   {
		   $t37="Q2";
	   }
	   
	   $sql38 = "SELECT * FROM timetable WHERE Timeslot='R2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result38=mysqli_query($conn, $sql38);
	   $rc38=mysqli_fetch_array($result38);
	   $cnt38 = mysqli_num_rows($result38);
	   if($cnt38>0)
	   {
		   $t38=$rc38[1].'('.$rc38[0].')';
		   $s38=$rc38[3].'('.$rc38[2].')';
		   $r38='Classroom:'.$rc38[5];
	   }
	   else
	   {
		   $t38="R2";
	   }
	   
	   $sql39 = "SELECT * FROM timetable WHERE Timeslot='S2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result39=mysqli_query($conn, $sql39);
	   $rc39=mysqli_fetch_array($result39);
	   $cnt39 = mysqli_num_rows($result39);
	   if($cnt39>0)
	   {
		   $t39=$rc39[1].'('.$rc39[0].')';
		   $s39=$rc39[3].'('.$rc39[2].')';
		   $r39='Classroom:'.$rc39[5];
	   }
	   else
	   {
		   $t39="S2";
	   }
	   
	   $sql40 = "SELECT * FROM timetable WHERE Timeslot='T2' and ClassName='{$_SESSION['ClassNameTT']}'";
	   $result40=mysqli_query($conn, $sql40);
	   $rc40=mysqli_fetch_array($result40);
	   $cnt40 = mysqli_num_rows($result40);
	   if($cnt40>0)
	   {
		   $t40=$rc40[1].'('.$rc40[0].')';
		   $s40=$rc40[3].'('.$rc40[2].')';
		   $r40='Classroom:'.$rc40[5];
	   }
	   else
	   {
		   $t40="T2";
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
	<div class="Table" style="height:100%;">
		<ul>
			<li><a href="Teacher.php">Add Teacher</a></li>
			<li><a href="Subject.php">Add Subject</a></li>
			<li><a href="Class.php">Add Class</a></li>
			<li><a href="Classroom.php">Add Classroom</a></li>
			<li style="background-color: #5379fa"><a href="Timetable.php">Time table</a></li>
			<li><a href="Logout.php">Logout</a></li>
        </ul>
		<font style="font-size:20px"><a href="GetClassName.php">View/ Remove Time Slots By Class</a></font><br>
		<span id="span1"><center><u>Time table for <?php echo $_SESSION["ClassNameTT"];?> class</u></center></span><br>
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
					<td>
					   <?php echo $s1 ?><br/>
					   <?php echo $t1 ?><br/>
						<?php echo $r1 ?><br/>
					</td>
					<td>
						<?php echo $s6 ?><br/>
					    <?php echo $t6 ?><br/>
						<?php echo $r6 ?><br/>
					</td>
					<td>
						<?php echo $s11 ?><br/>
					    <?php echo $t11 ?><br/>
						<?php echo $r11 ?><br/>
					</td>
					<td>
						<?php echo $s16 ?><br/>
					    <?php echo $t16 ?><br/>
						<?php echo $r16 ?><br/>
					</td>
					
					<td>
					   <?php echo $s21 ?><br/>
					   <?php echo $t21 ?><br/>
						<?php echo $r21 ?><br/>
					</td>
					<td>
						<?php echo $s26 ?><br/>
					    <?php echo $t26 ?><br/>
						<?php echo $r26 ?><br/>
					</td>
					<td>
						<?php echo $s31 ?><br/>
					    <?php echo $t31 ?><br/>
						<?php echo $r31 ?><br/>
					</td>
					<td>
						<?php echo $s36 ?><br/>
					    <?php echo $t36 ?><br/>
						<?php echo $r36 ?><br/>
					</td>
					
		         </tr>
				 <tr>
					<th>Tueday</th>
					<td>
					   <?php echo $s2 ?><br/>
					   <?php echo $t2 ?><br/>
						<?php echo $r2 ?><br/>
					</td>
					<td>
					   <?php echo $s7 ?><br/>
					   <?php echo $t7 ?><br/>
						<?php echo $r7 ?><br/>
					</td>
					<td>
					   <?php echo $s12 ?><br/>
					   <?php echo $t12 ?><br/>
						<?php echo $r12 ?><br/>
					</td>
					<td>
					   <?php echo $s17 ?><br/>
					   <?php echo $t17 ?><br/>
						<?php echo $r17 ?><br/>
					</td>
				
					<td>
					   <?php echo $s22 ?><br/>
					   <?php echo $t22 ?><br/>
						<?php echo $r22 ?><br/>
					</td>
					<td>
					   <?php echo $s27 ?><br/>
					   <?php echo $t27 ?><br/>
						<?php echo $r27 ?><br/>
					</td>
					<td>
					   <?php echo $s32 ?><br/>
					   <?php echo $t32 ?><br/>
						<?php echo $r32 ?><br/>
					</td>
					<td>
					   <?php echo $s37 ?><br/>
					   <?php echo $t37 ?><br/>
						<?php echo $r37 ?><br/>
					</td>
		         </tr>
				 <tr>
					<th>Wednesday</th>
					<td>
					   <?php echo $s3 ?><br/>
					   <?php echo $t3 ?><br/>
						<?php echo $r3 ?><br/>
					</td>
					<td>
					   <?php echo $s8 ?><br/>
					   <?php echo $t8 ?><br/>
						<?php echo $r8 ?><br/>
					</td>
					<td>
					   <?php echo $s13 ?><br/>
					   <?php echo $t13 ?><br/>
						<?php echo $r13 ?><br/>
					</td>
					<td>
					   <?php echo $s18 ?><br/>
					   <?php echo $t18 ?><br/>
						<?php echo $r18 ?><br/>
					</td>
					
					<td>
					   <?php echo $s23 ?><br/>
					   <?php echo $t23 ?><br/>
						<?php echo $r23 ?><br/>
					</td>
					<td>
					   <?php echo $s28 ?><br/>
					   <?php echo $t28 ?><br/>
						<?php echo $r28 ?><br/>
					</td>
					<td>
					   <?php echo $s33 ?><br/>
					   <?php echo $t33 ?><br/>
						<?php echo $r33 ?><br/>
					</td>
					<td>
					   <?php echo $s38 ?><br/>
					   <?php echo $t38 ?><br/>
						<?php echo $r38 ?><br/>
					</td>
		         </tr>
				 <tr>
					<th>Thursday</th>
					<td>
					   <?php echo $s4 ?><br/>
					   <?php echo $t4 ?><br/>
						<?php echo $r4 ?><br/>
					</td>
					<td>
					   <?php echo $s9 ?><br/>
					   <?php echo $t9 ?><br/>
						<?php echo $r9 ?><br/>
					</td>
					<td>
					   <?php echo $s14 ?><br/>
					   <?php echo $t14 ?><br/>
						<?php echo $r14 ?><br/>
					</td>
					<td>
					   <?php echo $s19 ?><br/>
					   <?php echo $t19 ?><br/>
						<?php echo $r19 ?><br/>
					</td>
					
					<td>
					   <?php echo $s24 ?><br/>
					   <?php echo $t24 ?><br/>
						<?php echo $r24 ?><br/>
					</td>
					<td>
					   <?php echo $s29 ?><br/>
					   <?php echo $t29 ?><br/>
						<?php echo $r29 ?><br/>
					</td>
					<td>
					   <?php echo $s34 ?><br/>
					   <?php echo $t34 ?><br/>
						<?php echo $r34 ?><br/>
					</td>
					<td>
					   <?php echo $s39 ?><br/>
					   <?php echo $t39 ?><br/>
						<?php echo $r39 ?><br/>
					</td>
		         </tr>
				 <tr>
					<th>Friday</th>
					<td>
					   <?php echo $s5 ?><br/>
					   <?php echo $t5 ?><br/>
						<?php echo $r5 ?><br/>
					</td>
					<td>
					   <?php echo $s10 ?><br/>
					   <?php echo $t10 ?><br/>
						<?php echo $r10 ?><br/>
					</td>
					<td>
					   <?php echo $s15 ?><br/>
					   <?php echo $t15 ?><br/>
						<?php echo $r15 ?><br/>
					</td>
					<td>
					   <?php echo $s20 ?><br/>
					   <?php echo $t20 ?><br/>
						<?php echo $r20 ?><br/>
					</td>
					
					
					<td>
					   <?php echo $s25 ?><br/>
					   <?php echo $t25 ?><br/>
						<?php echo $r25 ?><br/>
					</td>
					<td>
					   <?php echo $s30 ?><br/>
					   <?php echo $t30 ?><br/>
						<?php echo $r30 ?><br/>
					</td>
					<td>
					   <?php echo $s35 ?><br/>
					   <?php echo $t35 ?><br/>
						<?php echo $r35 ?><br/>
					</td>
					<td>
					   <?php echo $s40 ?><br/>
					   <?php echo $t40 ?><br/>
						<?php echo $r40 ?><br/>
					</td>
		         </tr>
			   </table>
		</center><br>
		<center style="color:red"><?php echo $error;?></span></center>
	</div>
</body>
</html>