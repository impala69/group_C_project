<?php
session_start();
ob_start();


include_once('dbconn.php');

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
mysqli_set_charset($conn, 'utf8');


if (!$conn) {
    die("Connection failed : " . mysqli_error());
}

$result = mysqli_query($conn, "SELECT * FROM jozve ORDER BY id DESC LIMIT 4");


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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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

        #login-form label {
            text-align: right !important;
            position: relative;
        !important;
            padding-right: 5%;
        }

        #info p {
            font-size: larger;
            padding-right: 2%;
        }

        #info h5 {
            padding-right: 2%;

        }

        .slider .indicators .indicator-item {
            background-color: #666666;
            border: 3px solid #ffffff;
            -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        }

        .slider .indicators .indicator-item.active {
            background-color: #ffffff;
        }

        .slider {
            width: 900px;
            margin: 0 auto;
        }

        .slider .indicators {
            bottom: 60px;
            z-index: 100;
            /* text-align: left; */
        }

        h4 {
            text-align: right;
        }

        a:link {
            color: beige;
        }

        a:hover {
            color: blue;
        }
        .circle_img
        {
            width:200px;
            height: 200px;
            border-radius: 50%;
            font-size: 100%;
            color: #fff;
            line-height: 30px;
            padding-top: 30%;
            text-align: center;
            background: #000;
            margin-top: 5%;
        }

    </style>
</head>
<body class="cyan loaded">
<?php

if (isset($_SESSION['user']) != "") {
    include_once('header-after-login.html');
} else {
    include_once('header-before-login.html');
}
?>
<br><br>
<div class="container">
    <div class="slider">
        <ul class="slides">
            <li>
                <img alt="جزوه یاب" src="http://lorempixel.com/580/250/nature/1"> <!-- random image -->
                <div class="caption center-align">
                    <h3>جزوه یاب</h3>
                    <h5 class="light grey-text text-lighten-3">برترین مرجع دانلود جزوات درسی و غیر درسی</h5>
                </div>
            </li>
            <li>
                <img alt="جزوه یاب" src="http://lorempixel.com/580/250/nature/2"> <!-- random image -->
                <div class="caption left-align">
                    <h3>جزوه یاب</h3>
                    <h5 class="light grey-text text-lighten-3">برترین مرجع دانلود جزوات درسی و غیر درسی</h5>
                </div>
            </li>
            <li>
                <img alt="جزوه یاب" src="http://lorempixel.com/580/250/nature/3"> <!-- random image -->
                <div class="caption right-align">
                    <h3>جزوه یاب</h3>
                    <h5 class="light grey-text text-lighten-3">برترین مرجع دانلود جزوات درسی و غیر درسی</h5>
                </div>
            </li>
            <li>
                <img alt="جزوه یاب" src="http://lorempixel.com/580/250/nature/4"> <!-- random image -->
                <div class="caption center-align">
                    <h3>جزوه یاب</h3>
                    <h5 class="light grey-text text-lighten-3">برترین مرجع دانلود جزوات درسی و غیر درسی</h5>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div id="box" style="text-align: right!important;" class="container">
        <a style="float: left;font-size: larger;" target="_blank" href="morenews.php">برای مشاهده جزوه های جدید بیشتر
            کلیک کنید</a>
        <h4>جدیدترین جزوه ها</h4>
        <hr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $post_id = $row['id'];
            $download = mysqli_query($conn, "SELECT `views` FROM `views` WHERE `post_id`='$post_id'");
            $counter_for_download = mysqli_fetch_array($download);
            $counter_for_download = $counter_for_download['views'];

            $like = mysqli_query($conn, "SELECT `likes` FROM `likes` WHERE `post_id`='$post_id'");
            $likes = mysqli_fetch_array($like);
            $likes = $likes['likes'];

            echo '<div id="box" style="margin: 2%;width: 21%;float: right" class="col s3 center z-depth-2 card-panel">
                <div class="circle_img">' . $row['jozve_name'] . '</div>
                <hr>
                <p>' . $row['jozve_name'] . '</p>
                <hr>
                <a href="detail.php?post_id=' . $row['id'] . '" class="green-text" target="_blank" style="font-size: 0.9rem; float: left">دانلود جزوه</a>
                <span style="float: right;"><i class="material-icons light-blue-text tooltipped" data-position="top" data-delay="50" data-tooltip="' . $counter_for_download . ' Views" style="font-size: 1.3rem; padding-right: 10px;cursor: pointer;">visibility</i> <i class="material-icons pink-text tooltipped action-like" data-workpad-key="D84lCquI0azsJt7V5qQEHn" data-position="top" data-delay="50" data-tooltip="Likes ' . $likes . '" style="font-size: 1.3rem; padding-right: 10px; cursor: pointer;">favorite</i> <span style="float: left;"></span></span>

            </div>';
        }
        ?>


    </div>
</div>

<div class="row">
    <div id="box" style="text-align: right!important;" class="container">
        <a style="float: left;font-size: larger;" target="_blank" href="morelike.php">برای مشاهده جزوه های محبوب بیشتر
            کلیک کنید</a>
        <h4>محبوب ترین جزوه ها</h4>
        <hr>
        <?php
        $query = "SELECT * FROM likes ORDER BY likes DESC LIMIT 4";
        $res = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($res)) {
            $id = $data['post_id'];
            $query2 = "SELECT * FROM jozve WHERE `id`='$id'";
            $res2 = mysqli_query($conn, $query2);
            $row = mysqli_fetch_assoc($res2);

            $post_id = $row['id'];
            $download = mysqli_query($conn, "SELECT `views` FROM `views` WHERE `post_id`='$post_id'");
            $counter_for_download = mysqli_fetch_array($download);
            $counter_for_download = $counter_for_download['views'];

            $like = mysqli_query($conn, "SELECT `likes` FROM `likes` WHERE `post_id`='$post_id'");
            $likes = mysqli_fetch_array($like);
            $likes = $likes['likes'];

            echo '<div id="box" style="margin: 2%;width: 21%;float: right" class="col s3 center z-depth-2 card-panel">
                <div class="circle_img">' . $row['jozve_name'] . '</div>
                <hr>
                <p>' . $row['jozve_name'] . '</p>
                <hr>
                <a href="http://localhost/group_C_project/jozveyab/detail.php?post_id=' . $row['id'] . '" class="green-text" target="_blank" style="font-size: 0.9rem; float: left">دانلود جزوه</a>
                <span style="float: right;"><i class="material-icons light-blue-text tooltipped" data-position="top" data-delay="50" data-tooltip="' . $counter_for_download . ' Views" style="font-size: 1.3rem; padding-right: 10px;cursor: pointer;">visibility</i> <i class="material-icons pink-text tooltipped action-like" data-workpad-key="D84lCquI0azsJt7V5qQEHn" data-position="top" data-delay="50" data-tooltip="Likes ' . $likes . '" style="font-size: 1.3rem; padding-right: 10px; cursor: pointer;">favorite</i> <span style="float: left;"></span></span>

            </div>';

        }

        ?>


    </div>
</div>
<div class="row">
    <div id="box" style="text-align: right!important;" class="container">
        <a style="float: left;font-size: larger;" target="_blank" href="moreview.php">برای مشاهده جزوه های پربازدید
            بیشتر کلیک کنید</a>
        <h4>پربازدید ترین جزوه ها</h4>
        <hr>
        <?php
        $query = "SELECT * FROM views ORDER BY views DESC LIMIT 4";
        $res = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($res)) {
            $id = $data['post_id'];
            $query2 = "SELECT * FROM jozve WHERE `id`='$id'";
            $res2 = mysqli_query($conn, $query2);
            $row = mysqli_fetch_assoc($res2);

            $post_id = $row['id'];
            $download = mysqli_query($conn, "SELECT `views` FROM `views` WHERE `post_id`='$post_id'");
            $counter_for_download = mysqli_fetch_array($download);
            $counter_for_download = $counter_for_download['views'];

            $like = mysqli_query($conn, "SELECT `likes` FROM `likes` WHERE `post_id`='$post_id'");
            $likes = mysqli_fetch_array($like);
            $likes = $likes['likes'];
            echo '<div id="box" style="margin: 2%;width: 21%;float: right;" class="col s3 center z-depth-2 card-panel">
                <div class="circle_img">' . $row['jozve_name'] . '</div>
                <hr>
                <p>' . $row['jozve_name'] . '</p>
                <hr>
                <a href="http://localhost/group_C_project/jozveyab/detail.php?post_id=' . $row['id'] . '" class="green-text" target="_blank" style="font-size: 0.9rem; float: left">دانلود جزوه</a>
                <span style="float: right;"><i class="material-icons light-blue-text tooltipped" data-position="top" data-delay="50" data-tooltip="' . $counter_for_download . ' Views" style="font-size: 1.3rem; padding-right: 10px;cursor: pointer;">visibility</i> <i class="material-icons pink-text tooltipped action-like" data-workpad-key="D84lCquI0azsJt7V5qQEHn" data-position="top" data-delay="50" data-tooltip="Likes ' . $likes . '" style="font-size: 1.3rem; padding-right: 10px; cursor: pointer;">favorite</i> <span style="float: left;"></span></span>

            </div>';

        }

        $conn = null;
        ?>


    </div>
</div>
<script>
    $(document).ready(function () {
        $('.slider').slider();
    });</script>
<?php
include_once('footer.html');
?>
</body>

</html>
