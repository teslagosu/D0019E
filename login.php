<?php
//includes
include_once (__DIR__."/model/message.php");
include_once (__DIR__."/controller/db_controller.php");
include_once "constants.php";
//check if login button is clicked
if(isset($_POST['log_in_user'])){
    //variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $message = "";
    // check if username and password fields are empty
    if(empty($username) && empty($password)){
        $message = usernameAndPasswordMissingMsg();
    }
    //check else if only username field is empty
    elseif(empty($username)){
        $message=usernameNotEnteredMsg();
    }
    //check else if only password field is empty
    elseif(empty($password)){
        $message = passwordNotEnteredMsg();

    }
    //If both fields are filled in, continue with Log in.
    else{
        //check if username and password match the inputs
        if(checkIfUserExist($username) == true &&  checkHashedPassword($username,$password) == true){
            //start session and redirect user to mainpage
            session_start();
            $_SESSION['username'] = htmlentities(getUsername($username));
            $_SESSION['id'] = htmlentities(getUserId($username));
            //redirect user to mainpage.php
          header("Location:../lab4/admin/mainpage.php");
        }else{
            //if username, password and hashed password dont match. Show error message.
            $message = wrongUsernameOrPasswordMsg();
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
    <link rel="stylesheet" href="css/styles.css">
    <title>H4CK3RBL0GG3N 1.0</title>
</head>
<body>
<div class="container-fluid">
    <!--navigation-->
    <?php
    include_once "nav.php";
    include_once "menu.php";
    ?>
    <div class="col-8">
        <?php echo($message); ?>
    <h2> Logga in </h2>

    <form method="post">
        <!--username-->
        <div class="form-group">
            <label">Användarnamn</label>
            <input type="username" class="form-control" aria-describedby="usernameHelp" name="username" placeholder="Användarnamn">

        </div>
        <!--password-->
        <div class="form-group">
            <label">Lösenord</label>
            <input type="password" class="form-control"  name="password" placeholder="Lösenord">

        </div>

        <button type="submit" class="btn btn-dark" name="log_in_user">Logga in</button>

    </form>
    </div>
    <!--footer-->
    <?php
//shows footer and info.php
    include_once "info.php";
    include_once "footer.php";
    ?>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

