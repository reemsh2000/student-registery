<?php
session_start();
$msg='';


if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
            if($username=='admin'){
            if($password == '123456'){
                 $_SESSION['username'] = $username;
                header("Location:reem-home.php");                         
            }else{
                $msg = "تمت كتابة كلمة السر او اسم المستخدم بشكل خاطئ ";
            }
        }
        else{
            $msg = "تمت كتابة كلمة السر او اسم المستخدم بشكل خاطئ ";
        }
    }
    

?>
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
        }

        form {
            width: 30%;
            min-height: 300px;
            background-color: #E0FFFF;
            display: flex;
            flex-direction: column;
            margin-top: 100px;
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


        input[type=submit] {
            height: 35px;
            margin-top: 20px;
            width: 40%;
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
    </style>
</head>

<body>

    <form method="post">
    <h3>  تسجيل الدخول</h3>
        <div class="field">
            <label>اسم المستخدم  </label>
            <input type="text" name="username" />
        </div>
        <div class="field">
            <label>كلمة السر  </label>
            <input type="password" name="password" />
        </div>
       
        <input type="submit" value="تسجيل الدخول" name="login" />

        <h5> <?php echo $msg; ?> </h5>
    </form>
</body>

</html>