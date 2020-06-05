<?php

//start session
session_start();
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
//variables
$username = $_SESSION['username'];
$userid = $_SESSION['id'];
$postid = $_GET['id'];
//includes
include_once "../controller/db_controller.php";
include_once "../model/message.php";
include_once "../constants.php";

//check if a get request is incoming.
if(isset($_GET['id'])){
$data = getPostByID($postid);
$image = getImageByPostId($postid);


}
?>

<!doctype html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--own CSS-->
    <link rel="stylesheet" href="<?=base?>css/styles.css">
    <title>H4CK3RBL0GG3N 1.0</title>
</head>
<body>
<div class="container-fluid">
    <!--navigation-->
    <?php
    include_once "../nav.php";
    include_once "../menu.php";
//print out data from the post.
    ?>
    <!--start of content-->
    <div class="col-8">
        <h3 id="blogpost-header"><?php  echo $data['post_title']?></h3>
        <p id="date">skrivet av: <a href="<?= base?>admin/publicuser.php?user=<?=$data['post_user_id']?>"><?php  echo $data['user_name']?></a> <?php echo $data['post_date']?></p>
        <p><?php echo $data['post_content']?></p>
        <?php
        if($image != null) {

            ?>

            <img src = "<?=base."uploads/".$image['image_name']?>"  class="figure" alt = "Blog Image" width="50%" height="50%" align="center" />
 <?php
}
?>

    </div>
    <!--end of content-->
    <!--footer-->
    <?php
    include_once "../info.php";
    include_once "../footer.php";
    ?>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>