<?php

include("lidhja.php");

$username_err="";
$password_err="";

if(isset($_POST["LOGIN"]))
{
    //regex per username
    if(empty($_POST["perdoruesi"])){
        $username_err="Ju lutem shenoni username";
    }
    else if(strlen($_POST["perdoruesi"])<6){
        $username_err="Username duhet minimum 6 karaktere";
    }
    else if (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["perdoruesi"])) {
        $username_err="Username duhet me posedu shkronja tvogla tmdhaja dhe numra. ";
        }
        else{
            $username=$_POST["perdoruesi"];
        }

          //validimi passwordit
          if(empty($_POST["passwordi"]))
          {
            $password_err="Ju lutem shenoni passwordin";
          }
          else if(strlen($_POST["passwordi"])<8){
            $password_err="Passwordi duhet te kete minimum 8 karaktere";
          }
          else{
            $password=$_POST["passwordi"];
          }

          if(isset($username) && isset ($password))

          {

          $secim="SELECT * FROM perdoruesit WHERE emri_perdoruesit = '$username'";
          $calistir=mysqli_query($lidhja,$secim);
          $numrirregjistrimeve= mysqli_num_rows($calistir);//ose 1 ose 0 ,po kqyr nese esht 1 e ka gjet user dmth nese jo esht 0

          if($numrirregjistrimeve>0)
          {
            $connection=mysqli_fetch_assoc($calistir);
            $passihash=$connection["passwordat"];

            if(password_verify($password,$passihash))
            {
                session_start();
                $_SESSION["emri_perdoruesit"]=$connection["emri_perdoruesit"];
                $_SESSION["email"]=$connection["email"];
            
                if ($username === "granitadmin" && password_verify("123456789", $passihash))//pass verify me kthy prej hashume ne te lexuar passwordin
                {
                    header("location:Restaurantet.php");//nese esht useri granitadmin po shkon ket link 
                    exit();
                } 
                else {
                    header("location:HOMEPAGE.php");
                    exit();
                }
            }
        }
    }

    echo "Username or password is incorrect";

    mysqli_close($lidhja);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN Forma</title>
    <style>
        body {
            background-image: url('wallpaper.jpg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .registerform {
            background-color: rgba(255, 255, 255,1); 
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .main {
            width: 300px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #submitbuton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .flexbox-item {
            cursor: pointer;
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
    
</head>
<body>
    <a href="HOMEPAGE.php"><img src="hajmpimlogo.png" width="400" height="100"></a>
    <div class="registerform">
        <div class="main">
            <h1>LOGIN</h1>
            <form action="loginform.php" method="POST">

                <label>Username</label>
                <input type="text" name="perdoruesi" id="username"/>

                <?php
                    echo $username_err;
                ?>

                <label>Password :</label>
                <input type="password" name="passwordi" id="password"/>

                <?php
                    echo $password_err;
                ?>

                <div id="errorMessage"></div>

                <button type="submit" name="LOGIN" id="submitbuton">HYR</button>
                <a href="register.php"><div class="flexbox-item" >Rregjistrohu</div></a> 
            </form>
        </div>
    </div>
</body>
</html>