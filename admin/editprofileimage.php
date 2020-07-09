<?php
//flushes output buffering
ob_end_flush();
//start session
session_start();
//includes
include_once __DIR__."../../controller/db_controller.php";
include_once __DIR__."../../model/message.php";
//check if a session is started else redirect to login page
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
//set variables
$message ="";
$userid = getUserId($_SESSION['username']);
console_log($userid);

if(isset($_POST['update-profile-textarea'])){
    $profile_text_area = $_POST['update-profile-textarea'];
}


$userName = $_SESSION['username'];

//if update profile button is pushed
if(isset($_POST['update-profile'])){
    //set variables
    $tmp_file = $_FILES['update-user-image']['tmp_name'];
    $filename = $_FILES['update-user-image'];
    $imageName = $filename['name'];
//if a file is uploaded, set upload status and image status to 1, aslo the name of img
    if (is_uploaded_file($tmp_file)) {
        //set image name to the uploaded files name
        $imageName = $_FILES['update-user-image']['name'];
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

        $imageName = "";
        $upload_status = 1;
        $image_status = 0;
    }
    //if upload status is ok, update the users information
    if ($upload_status == 1) {

        updateUserProfileInformation($userid,$profile_text_area);
        $message = changeProfileInformationSuccessfulMsg();
        //if image status is okey update the profile picture and move it to uploads folder
        if ($image_status == 1) {

            move_uploaded_file($tmp_file,"../uploads/".$imageName);
            updateUserProfileImage($userName,$imageName);




        }

    }


}
?>
<!doctype html>

<html lang="sv">
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
    <div class="col-8">
        <?=($message) ?>
        <h2> Ändra inställningar </h2>
        <form method="post" enctype="multipart/form-data">
            <!--username-->

            <!--textarea-->
            <div class="form-group">
                <label>Information om bloggen</label>
                <textarea class="form-control" name="update-profile-textarea" rows="3" ><?php echo(getProfileInfo($userName))?></textarea>
            </div>
            <!--Avatar-->
            <div class="form-group">
                <label>Profilbild</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input type="file" class="form-control-file" name="update-user-image">
            </div>
            <!--button-->
            <div class="form-group">
                <button type="submit" class="btn btn-dark" name="update-profile" >Uppdatera profil</button>
            </div>
        </form>
    </div>


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



