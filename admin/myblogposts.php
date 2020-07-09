<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
include_once "../constants.php";

$username = $_SESSION['username'];
$userid = $_SESSION['id'];
$message = "";

include_once "../controller/db_controller.php";
include_once "../model/message.php";


if(isset($_GET['edit'])){

$postid = $_GET['edit'];
$author = getUsernameFromPostID($postid);
//check if post belongs to user
    if($username != $author){
        $message = unauthorizedAuthorMsg();
        header("Location: myblogposts.php");
        die("redirecting to myblogposts.php");

    }else{


$post_title = getPostTitleByID($postid);
$post_content = getPostContentByID($postid);
$post_image = getImageByPostId($postid);



    }
}

//check if get request = delete
if(isset($_GET['delete'])) {
   //post id
    $postid = $_GET['delete'];
    //get username from postid
    $author = getUsernameFromPostID($postid);
    //check if logged in user is the same as author for the postid.
    if ($username != $author) {

        header("Location: myblogposts.php");
        die("redirecting to myblogposts.php");
        $message = unauthorizedAuthorMsg();

    } else {
        //delete the post from database
        deletePostFromDatabase($postid);
        $message = deletePostMsg();
    }
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

        //check if the uploaded file exists on the server
        if (file_exists("../uploads/" . $imageName)) {

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

    //if upload status is ok update post.
    if ($upload_status == 1) {

        updatePost($postid, $post_title, $post_content, $date);

        $message = editPostSuccessMsg();

        //if an image is uploaded
        if ($image_status == 1) {
            //checks if image exist in post,
            if(doesImageExistInPost($postid) == 1){
                //move image to directory
                move_uploaded_file($tmp_file, "../uploads/" . $imageName);
                updateImage($postid,$imageName);
            }else{

                //insert image name into db
                move_uploaded_file($tmp_file, "../uploads/" . $imageName);
                insertImageToDatabase($postid,$imageName);

            }

        }
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

        if(isset($_POST['edit-load-blog-post'])) {
            echo($message);
        }

        if(isset($_GET['delete'])) {
            echo($message);
        }

        ?>
        <h2> Mina inlägg </h2>
        <form method="post">
            <div class="form-group">
       <div class="row justify-content-center">
           <table class="table">

               <thead>
               <tr>
                   <th>Titel</th>

                   <th colspan="2"></th>
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