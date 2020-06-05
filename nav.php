<?php
session_start();
//includes
include_once "constants.php";
include_once "config.php";
include_once __DIR__."/controller/db_controller.php";
//check if a session is running, else redirect to login screen
if(!isset($_SESSION['username'])) {
    //if the login button i clicked, redirect to login.php
    if(isset($_POST['log_in_nav'])){
        header("Location:".base."login.php");

    }
    //if the register button is clicked, redirect to register.php
    if(isset($_POST['register_nav'])){
        header("Location:".base."register.php");
    }


//html for the menu not in a session
?>
    <!--navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" name="back-to-index" href="<?=base?>index.php">H4CK3RBL0GG3N</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        </ul>
        <!--form for log in and register buttons-->
        <form class="form-horizontal" method="post" >
            <button class="btn btn-outline-dark my-2 my-sm-0 mr-4" id="btn-log-in" name="log_in_nav">Logga in</button>
            <button class="btn btn-dark my-2 my-sm-0 mr-4" type="submit" id="btn-register" name="register_nav">Registrera</button>
        </form>
    </div>
</nav>

<?php
}else{
    //get the username of the session username variable
    $username =$_SESSION['username'];


//html for users in a session
?>
    <!--Navigation-->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" name="logged-in-back-to-index" href="<?=base ?>index.php">H4CK3RBL0GG3N</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?=base?>index.php">Startsida</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base?>admin/mainpage.php">Min Sida</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base?>admin/myblogposts.php">Mina inlägg</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="<?=base?>admin/newpost.php">Skriv inlägg</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item avatar">
                <a class="nav-link p-0" href="<?=base?>admin/mainpage.php">
                    <img src="<?=base?>uploads/<?=getProfileImage($username);?>" class="rounded-circle z-depth-0"
                         alt="avatar image" height="30">
                </a>
            </li>
        </ul>
        <!--form for the button log out-->
        <form class="form-inline my-2 my-lg-0" method="post">
            <button class="btn btn-dark my-2 my-sm-0 mr-4" type="submit" name="log_out">Logga ut</button>
        </form>
    </div>
</nav>
<?php
}

//if log out button is clicked. log out and redirect to index.php
if(isset($_POST['log_out'])){
    session_destroy();
    header("Location:".base."index.php");

}


?>

