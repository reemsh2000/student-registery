<!-- 
    Reem Raed Shamia
    20181188
    echo "<h2> Reem Raed Shamia  20181188 </h2> ";

    
 -->

 <?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:index.php");

}

$host = "localhost";
$username="root";
$password = '';
$database = "exam";
$msg='';
$id='';
$con = mysqli_connect($host,$username,$password,$database);

if(!$con){
  die("failed".mysqli_connect_error($con));
}

//  ****************Logout*********************
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location:index.php");
}

// *******************Insert*****************
if(isset($_POST['add'])){
    $std_id=$_POST['id'];
    $query = "SELECT * from student WHERE id = '$std_id'";
    $result = mysqli_query($con,$query);
   if(mysqli_num_rows($result)>0){
         $msg="رقم الطالب موجود من قبل ";
          }
    else {
        $name=$_POST['name'];
        $email = $_POST['email'];
        $DOB=$_POST['DOB'];
        $gender=$_POST['gender'];

       $query2= "INSERT INTO student (id ,stdname,gender,birthday,stdemail) Values ('$std_id','$name','$gender','$DOB','$email')";
        if(mysqli_query($con,$query2)){
            $msg = "تم اضافة بيانات الطالب   ";
        }else{
            $msg="هناك خلل ";
            $msg=" $email ";

        }
    }
}
// *******************Delete ****************

if(isset($_POST['delete'])){
    if(!($_POST['id']=='')){
 if (isset($_POST['id'])){
    $student_id=$_POST['id'];
    $query3 = "DELETE FROM student WHERE id = $student_id";
    if(mysqli_query($con,$query3)){
       $msg="تم حذف الطالب ";  
   }
   else {
      $msg="هناك خلل ";
   }
} 
    }
else{
        $msg = "يجب ادخال رقم الطالب المراد حذفه";
    }

}
// ******************Update******************************

if(isset($_POST['update'])){
if(!($_POST['id']=='')){
    if (isset($_POST['id'])){
    $student_id=$_POST['id'];
    $name=$_POST['name'];
    $email = $_POST['email'];
    $DOB=$_POST['DOB'];
    $gender=$_POST['gender'];

    $query = "UPDATE student SET 
    stdname = '$name',
    gender='$gender' ,
    birthday='$DOB'
    WHERE id =$student_id ";
    if(mysqli_query($con,$query)){
        $msg = "تم تعديل بيانات الطالب   ";
    }else{
        $msg="هناك خلل ";
    }
    }
}
    else {
        $msg = "يجب ادخال رقم الطالب المراد تعديل بياناته"; 
    }
}

?>


<!--*************  Front End Start**************  -->
<!DOCTYPE html >
<html lang="en" dir="rtl">

<head>
    <title>Form</title>
    <style>
        *{
            outline:none;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction:column;
        }

        form {
            width: 40%;
            min-height: 300px;
            background-color: #E0FFFF;
            display: flex;
            flex-direction: column;
            margin-top: 10px;
            padding: 30px;
        }
    h3{
        text-align:center;
        font-size:25px;
    }

        .field {
            display: flex;
            align-items: center;
            margin-bottom:  10px;
        }

        .field label {
            margin: 15px 0px;
            display:inline;
            width:100px;
        }

        .field input {
            height: 20px;
            border:none;
        }
    .btns{
        display:flext;
        flex-wrap:wrap;
    }

        input[type=submit] {
            height: 35px;
            margin-top: 20px;
            width: 150px;
            align-self: center;
            outline: none;
            border: none;
            font-size:20px;
        }
        input[type=submit]:hover{
            background-color:lightseagreen;
            color:black;
            cursor:pointer;
        }
    .tab{
        border:2px solid #000;
        margin-top:20px;
        border-collapse:collapse;
    }
    .tab td{
     border:2px solid #000;
     width:150px;
     background-color:rgb(204, 224, 224);
    }
.frow td{
    background-color:rgb(58, 26, 239);
    text-align:center;
}
    </style>
</head>

<body>

    <form method="post">
    <h3>  تسجيل الدخول</h3>
        <div class="field">
            <label> رقم الطالب </label>
            <input type="text" name="id" >
        </div>
        <div class="field">
            <label> اسم الطالب </label>
            <input type="text" name="name" />
        </div>
        <div class="field">
            <label> جنس الطالب </label>
            <select name="gender">
                <option name="female"  value="female" >  أنثى</option>
                <option name="male"  value="male">  ذكر</option>
          </select>
        </div>
        <div class="field">
            <label> تاريخ الميلاد   </label>
            <input type="text" name="DOB" />
        </div>
        <div class="field">
            <label>  ايميل الطالب   </label>
            <input type="text" name="email" />
        </div>
        <div class="btns">
        <input type="submit" value=" اضافة" name="add" />
        <input type="submit" value=" حذف" name="delete" />
        <input type="submit" value=" تعديل" name="update" />
        <input type="submit" value="استعراض" name="show" />
        <input type="submit" value=" تسجيل خروج" name="logout" />
    </div>
        <h5> <?php echo $msg; ?> </h5>
    </form>
<!--  ****************SHOW ************************* -->
 <?php  
 if(isset($_POST['show'])){
   
$name = $email =$gender=$DOB=$id ='';
$select_query = "SELECT * FROM student ";
$result = mysqli_query($con, $select_query);
echo "<table class='tab'>";
echo "<tr class='frow'>";
echo "<td> رقم الطالب </td>";
echo "<td> اسم الطالب </td>";
echo "<td> جنس الطالب </td>";
echo "<td> تاريخ الميلاد</td>";
echo "<td> ايميل </td>";
echo "</tr>";
 while($row=mysqli_fetch_array($result)) {
  $id=$row[0];
  $name=$row[1];
  $gender=$row[2];
  $dob=$row[3];
  $email=$row[4];
  echo "<tr>";
  echo "<td> $id </td>";
  echo "<td> $name </td>";
  echo "<td>$gender </td>";
  echo "<td> $dob</td>";
  echo "<td> $email </td>";
  echo "</tr>";
 }
echo "</table>";
 }
 ?>
</body>

</html>

<!--************** Front End finish ************** -->