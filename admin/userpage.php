<?php
//start session
session_start();
//check if session is started, else redirect to login page
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
//includes
include_once __DIR__."/../controller/db_controller.php";
include_once __DIR__."/../model/message.php";
include_once __DIR__."/../config.php";
//username set
$username = $_SESSION['username'];
//if the button for edit is selected redirect to edit profile page
if(isset($_POST['user-image-edit'])){
    header("Location: editprofileimage.php");
}

?>

<!--Start of userpage-->
<div id="content" class="col-8" align="center">

    <h2>Min sida</h2>
    <img src="<?=base?>uploads/<?=getProfileImage($username)?>" id="profileImage" class="figure-img rounded" alt="Profile Image"/>
    </a>
    <h2><?php echo $_SESSION['username']?></h2>



    <form method="post" enctype="multipart/form-data">
        <!--button-->
        <div class="form-group">
            <button type="submit" class="btn btn-dark" name="user-image-edit" >Ändra inställningar</button>
        </div>



    </form>
    <p></p>
    <?php
    //prints out the information about the user
    echo(getProfileInfo($username));

    ?>



</div>
