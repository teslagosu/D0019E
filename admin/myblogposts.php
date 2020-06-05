<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
include_once "../constants.php";

$username = $_SESSION['username'];
$userid = $_SESSION['id'];
include_once "../controller/db_controller.php";
include_once "../model/message.php";

if(isset($_GET['edit'])){
$postid = $_GET['edit'];
$post_title = getPostTitleByID($postid);
$post_content = getPostContentByID($postid);
$post_image = getImageByPostId($postid);
console_log($post_content);
}

//check if get request = delete
if(isset($_GET['delete'])){
    console_log("inne i GET DELETE");
    $postid = $_GET['delete'];
    console_log("före deletepost");
    deletePostFromDatabase($postid);
    $message = deletePostMsg();
    console_log("Message i delete: $message");
    console_log("efter deletepost");
    //header("Location:myblogposts.php");

}

if(isset($_POST['edit-load-blog-post'])) {
    $post_title = $_POST['edit-title'];
    $post_content = $_POST['edit-text-area'];
    $post_image = "";
    $tmp_file = $_FILES['edit-image']['tmp_name'];
    $date = date("Y-m-d");

    if (is_uploaded_file($tmp_file)) {
        //set image name to the uploaded files name
        $imageName = $_FILES['edit-image']['name'];
        $upload_status = 1;
        $image_status = 1;
        console_log("inne i is_uploaded_file");
        //check if the uploaded file exists on the server
        if (file_exists("../uploads/" . $imageName)) {
            console_log("inne i file_exists");
            //if it exists send error message.
            $message = renameImageFileMsg();
            $upload_status = 0;
            $image_status = 0;
        }
    } else {
        //if user didnt upload any image. Set image name to blank

        $imagename = "";
        $upload_status = 1;
        $image_status = 0;
    }

    if ($image_status == 1) {
        console_log("imagestatus = 1");
        if(doesImageExistInPost($postid) == 1){
            console_log("imageexist in post = 1");
            move_uploaded_file($tmp_file, "../uploads/" . $imageName);
            updateImage($postid,$imageName);
        }else{
            console_log("imageexist != 1");
            console_log("Du har ingen fil uppladdad i databasen");
            insertImageToDatabase($postid,$imageName);

        }

    }
    if ($upload_status == 1) {
        console_log("upload status = 1");
        updatePost($postid, $post_title, $post_content, $date);
        echo("uppladdad!!");
        $message = editPostSuccessMsg();
        console_log("message efter upload: ".$message);
    }

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
    ?>
    <!--start of content-->
    <div class="col-8">
        <?php

        echo($message);
        console_log("message i början av sidan: " .$message);
        ?>
        <h2> Mina inlägg </h2>
        <form method="post">
            <div class="form-group">
       <div class="row justify-content-center">
           <table class="table">

               <thead>
               <tr>
                   <th>Titel</th>

                   <th colspan="2">Action</th>
               </tr>

               </thead>
                <?php
                getPostTitlesFromUserId($userid);

                ?>



           </table>

       </div>
            </div>
        </form>

        <?php
        if(isset($_GET['edit'])) {

        ?>
        <form method="post" enctype="multipart/form-data">
            <!--titel-->
            <div class="form-group">
                <label">Titel</label>
                <input type="text" class="form-control" aria-describedby="textHelp" name="edit-title" value="<?php echo$post_title ?>" placeholder="">

            </div>
            <!--textarea-->
            <div class="form-group">
                <label">Blogg inlägg</label>
                <textarea class="form-control" rows="3" name="edit-text-area" placeholder="Skriv din text här"><?=$post_content ?></textarea>

            </div>

            <div class="form-group">
                <label>Ladda upp bild(valfritt)</label>
                <input type="file" class="form-control-file" name="edit-image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark" name="edit-load-blog-post">Ladda upp inlägg</button>

        </form>
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