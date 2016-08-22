<?php
session_start();
ob_start();
if(isset($_SESSION['user']) != ""){
    header('Location : index.php');
    echo 1;
}

if(isset($_POST['btn-login'])){
    echo 1;
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'jozveyab';

    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

    if ( !$conn ) {
        die("Connection failed : " . mysqli_error());
    }

    //scape variables for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);


    //can not sql injection for server
    //strip string from tags like script tags
    $username = strip_tags($username);
    $pass = strip_tags($pass);


    //hash the password for trust
    $pass = hash('sha256', $pass);

    $result = mysqli_query($conn, "SELECT `id`, `username`, `email`, `password` FROM `user` WHERE username='$username' AND password='$pass'");
    header('Location : index.php');
    $row = mysqli_fetch_array($result);

    //there is one row if username and password is correct
    $count = mysqli_num_rows($result);

}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>جزوه یاب، اولین مرجع جزوه های درسی و غیر درسی</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>


    <style>
        @font-face {
            font-family: 'Font';
            src: url(static/font/BPaatchBold.ttf) format('truetype');
        }

        body {
            font-family: Font;
        }

        #login-form input {
            font-family: Font;
            text-align: right;

        }

        #login-form {
            margin-top: 5%;
        }
        #login-form label{
            text-align: right!important;
            position: relative;!important;
            padding-right: 2%;
        }


    </style>
</head>
<body class="cyan loaded">

<div id="login-form" class="row">

    <div style="text-align: right!important;" class="col s8 offset-s2 center z-depth-6 card-panel">
        <br>
        <h5>تماس با جزوه یاب</h5>
    <hr>
        <p style="font-size: medium">برای تماس با جزوه یاب می توانید از راه های زیر استفاده کنید و یا فرم زیر را پر کنید و سوال ، پیشنهاد و یا انتقاد خود را با در میان بگذارید ، اعضای بخش پشتیبانی در اسرع وقت به شما پاسخ خواهند داد</p>
        <p style="font-size: medium">با تشکر از حسن انتخاب شما</p>
        <hr>
    <form action="" method="post" class="login-form">

        <div class="row">
            <div class="input-field col s12">
                <label for="username" class="active right-align">پست الکترونیک</label>
                <input id="username" name="username" type="email" required>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <label for="subject" class="active right-align">موضوع</label>
                <input id="subject" name="subject" type="text" required>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <label for="text" class="active right-align">متن پیام</label>
                <textarea style="margin-top: 3%;height: 150px" id="text" name="text" required></textarea>
            </div>
        </div>



        <div class="col s12">
            <button style="margin-bottom: 5%;margin-top: 5%;width: 100%" class="btn waves-effect waves-light" type="submit" name="btn-edit-pass">فرستادن پیام</button>
        </div>


    </form>
    <div class="row">
        <div class="input-field col s6 m6 l6">
            <p class="margin left-align medium-small"><a href="about.php">درباره ما</a></p>
        </div>
        <div class="input-field col s6 m6 l6">
            <p class="margin right-align medium-small"><a href="index.php">صفحه ی اصلی</a></p>
        </div>
    </div>
</div>
</div>
</body>

</html>