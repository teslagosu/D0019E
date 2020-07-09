<?php
//start session
session_start();

//if session has not started redirect to login.php
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
//set username and userid
$username = $_SESSION['username'];
$userid = $_SESSION['id'];
$message = "";
//includes
include_once "../controller/db_controller.php";
include_once "../model/message.php";
include_once "../constants.php";


//if the post request button for uploading a post is pressed
if(isset($_POST['load-blog-post'])){
    //set variables
    $message = "";
    $title = $_POST['post-title'];
    $text = $_POST['post-text-area'];
    $imageName = "";
    $date = date("Y-m-d");
    $tmp_file = $_FILES['post-image']['tmp_name'];
    $upload_status = 1;
    $image_status = 1;
//if the title field is empty display error message
    if(empty($title)){
        $message = errorTitleMissingMsg();
    }
    //if text field is empty display error message
    elseif(empty($text)){
        $message = errorBlogTextMissingMsg();
    }else{
    //check if a image is uploaded
    if(is_uploaded_file($tmp_file)){
        //set image name to the uploaded files name
        $imageName = $_FILES['post-image']['name'];
        $upload_status = 1;
        $image_status =1;
        //check if the uploaded file exists on the server
        if(file_exists("../uploads/".$imageName)){
            //if it exists send error message.
           $message=  renameImageFileMsg();
           $upload_status = 0;
           $image_status = 0;
        }
    }else{
        //if user didnt upload any image. Set image name to blank

        $imagename ="";
        $upload_status = 1;
        $image_status=0;
    }
    if($upload_status == 1){
        //if upload status is 1 insert into database
    insertPostToDatabase($userid,$title,$text,$date);
    $message = successUploadedPostMsg();
        header("Location: myblogposts.php");
        if($image_status == 1){
            move_uploaded_file($tmp_file,"../uploads/".$imageName);
            $postid = getPostIdForUser($userid);
            insertImageToDatabase($postid,$imageName);

        }//end of image status

    }//end of upload status
    }//end of user inputs











}//end of $_POST['load-blog-post']
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

    ?>
    <!--start of content-->
    <div class="col-8">
        <?=$message;

        ?>
        <h2> Skriv inlägg </h2>

        <form method="post" enctype="multipart/form-data">
            <!--titel-->
            <div class="form-group">
                <label">Titel</label>
                <input type="text" class="form-control" aria-describedby="textHelp" name="post-title" value="" placeholder="Skriv Rubrik">

            </div>
            <!--textarea-->
            <div class="form-group">
                <label">Blogg inlägg</label>
                <textarea class="form-control" rows="3" name="post-text-area" placeholder="Skriv din text här"></textarea>

            </div>

            <div class="form-group">
                <label>Ladda upp bild(valfritt)</label>
                <input type="file" class="form-control-file" name="post-image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark" name="load-blog-post">Ladda upp inlägg</button>

        </form>
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