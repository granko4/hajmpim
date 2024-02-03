<?php

include("lidhja.php");

$username_err="";
$email_err="";
$password_err="";
$adresa_err="";

if(isset($_POST["rregjistro"]))
{
    //regex per username
    if(empty($_POST["perdoruesi"])){
        //cili do error qe vjen prej validimit behet show me posht ku e kemi deklaru edhe niher username err me echo e shkrujm
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

        //validimi per email
        if(empty($_POST["emaili"]))
        {
            $email_err="Emaili duhet plotsuar";
        }
        else if(!filter_var($_POST["emaili"], FILTER_VALIDATE_EMAIL)) {
            $email_err = "Emaili nuk eshte sakt";
          }
          else{
            $email=$_POST["emaili"];
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
            //me pass hash ne database nuk shihet passwordi por ne menyr te hashume del aty 
            $password=password_hash($_POST["passwordi"],PASSWORD_DEFAULT);
          }

          //validimi adresa
          if(empty($_POST["adresabanimit"]))
          {
            $adresa_err="Ju lutem shenoni adresen";
          }
          else{
            $adresa=$_POST["adresabanimit"];
          }

          if(isset($username) && isset ($email) && isset ($password) && isset($adresa))
          {

    $shto="INSERT INTO perdoruesit(emri_perdoruesit, email, passwordat,adresa )VALUES('$username','$email','$password','$adresa')";

    $shtoje=mysqli_query($lidhja,$shto);

    mysqli_close($lidhja);
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Forma</title>
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
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
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
            <h1>REGISTER</h1>
            <form action="register.php" method="POST">

                <label>Username</label>
                <input type="text" name="perdoruesi" id="username"/>

                <?php
                    echo $username_err;//gjithmone error mesazhin po mer nalt prej username_err qka vendoset aty 
                ?>

                <label>E-Mail :</label>
                <input type="text" name="emaili" id="email"/>

                <?php
                    echo $email_err;
                ?>

                <label>Password :</label>
                <input type="password" name="passwordi" id="password"/>

                <?php
                    echo $password_err;
                ?>

                <label>Adresa :</label>
                <input type="text" name="adresabanimit" id="adresa"/>

                <?php
                    echo $adresa_err;
                ?>

                <div id="errorMessage"></div>

                <button type="submit" name="rregjistro" id="submitbuton">Rregjistrohu</button>
                <a href="loginform.php"><div class="flexbox-item" >LOGIN</div></a> 
            </form>
        </div>
    </div>

    <!-- ktu esht kodi prej fazes pare me html qe esht punu kurse siper ne PHP nuk mujta me kthy kodin prej html ne php direk e shkrujta ne php -->

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            function validate(event) {
                event.preventDefault();
                const username = document.getElementById('username');
                const password = document.getElementById('password');
                const adresa = document.getElementById('adresa');
                const email = document.getElementById('email');

                if (username.value === "") {
                    alert("Ju lutem shtoni perdoruesin.");
                    username.focus();
                    return false;
                }
                if (password.value === "") {
                    alert("Ju lutem shtoni Fjalkalimin.");
                    password.focus();
                    return false;
                }
                if (adresa.value === "") {
                    alert("Ju lutem shtoni emrin e Plote.");
                    adresa.focus();
                    return false;
                }
                if (email.value === "") {
                    alert("Ju lutem shtoni email'in.");
                    email.focus();
                    return false;
                }
                if (!emailValid(email.value)) {
                    alert("Ju lutem te shtoni email'in valid.");
                    email.focus();
                    return false;
                }
                return true;
            }
            function emailValid(email) {
                const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
                return emailRegex.test(email.toLowerCase());
            }
            const btnSubmit = document.getElementById('submitbuton');
            btnSubmit.addEventListener('click', validate);
        });
    </script> -->
</body>
</html>