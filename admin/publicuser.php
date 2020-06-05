<?php
//start session
session_start();
//includes
include_once __DIR__."../../constants.php";
include_once __DIR__."../../controller/db_controller.php";


//check if session is started else redirect to login.php
if(empty($_SESSION['username'])){
    header("Location: ../login.php");
    die("redirecting to login.php");
}
//set username
$username = $_SESSION['username'];
//if a get request is user after .php? (.php?user=)
if(isset($_GET['user'])){
    //set userid, by the session id of the user.
    $user_id = $_GET['user'];
    //get user data by id
    $data = getUserByID($user_id);

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
//shows the navigation and menu.php
    include_once "../nav.php";
    include_once "../menu.php";
    //echo out profile image of user, information about the users blog and the users posts
    ?>
    <div id="content" class="col-8" align="center">
    <img src="<?=base?>uploads/<?=$data['user_image']?>" id="profileImage" class="figure-img rounded" alt="Profile Image"/>
    <h2 class="public-user-name"><?php echo($data['user_name']) ?></h2>
        <h4>Information om bloggen</h4>
    <p><?php echo($data['user_presentation'])?></p>


        <div class="row justify-content-center">
            <h3>Blogginlägg</h3>
            <table class="table" style="width:100%">

                <tr>
                <?php
                //if a get request of the user is set loop out the information about the users posts
                if(isset($_GET['user'])){
                    foreach(getPublicUsersPost($_GET['user']) as $value){
                        ?>
                        <td><a href="<?=base."admin/blogpost.php?user?".$value['post_user_id']."&id=".$value['post_id'] ?>"><?php echo($value['post_title']);?></a></td>
                    <td><?php echo($value['post_date'])?></td>
                </tr>
                        <?php
                    }
                }
                ?>

            </table>

        </div>
    </div>

    <?php
    //shows info and footer.php
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