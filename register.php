<?php
include_once __DIR__."/model/message.php";
include_once __DIR__."/controller/db_controller.php";
include_once __DIR__ . "/config.php";
include_once __DIR__. "/constants.php";

//if register button is clicked, set variables.
if(isset($_POST['reg-register'])) {
    //variables
    $username = checkInput($_POST['reg-username']);
    $password = $_POST['reg-password'];
    $info = $_POST['reg-textarea'];
    $message = "";
    $profileImage = $_FILES['reg-image'];
    $imageName = $profileImage['name'];
    $uploadOK = 0;


    // check if username and password fields are empty
    if (empty($username) && empty($password)) {

        $message = usernameAndPasswordMissingMsg();
    } //check else if only username field is empty
    elseif (empty($username)) {
        $message = usernameNotEnteredMsg();
    } //check else if only password field is empty
    elseif (empty($password)) {
        $message = passwordNotEnteredMsg();

    } //check else if info textarea is empty
    elseif (empty($info)) {
        $message = regInfoIsMissingMsg();
    } else {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            $errorMessage = wrongCharactersMsg();
        }

        //check if username already exist
        if (checkIfUserExist($username) == 1 || checkIfUserExist(strtolower($username)) == 1 || checkIfUserExist(strtoupper($username)) == 1) {
            $message = regUserAlreadyExistMsg();
        } else {
            //tmp_filenameX:\Program Files (x86)\Ampps\tmp\phpA909.tmp
            $tmp_filename = $_FILES['reg-image']['tmp_name'];
            //uploads/
            $upload_dir = "uploads/";
            //image name of uploaded image insäne.jpg
            $target_file = basename($_FILES['reg-image']['name']);
            //if a file is uploaded
            if(is_uploaded_file($tmp_filename)) {
                //make upload image ok
                $uploadOK = true;
                //if the file already exist make upload not okey.
                if (file_exists($upload_dir . $target_file)) {

                    $message = renameImageFileMsg();
                    $uploadOK = false;

                }
                //if upload is okey, move the uploaded image to the folder else return error message
                if($uploadOK == 1){
                if(move_uploaded_file($tmp_filename, $upload_dir . $target_file))
                    {
                        $imageName = $target_file;
                        $message = uploadSuccessfulMsg();
                    }
                    else
                    {
                        $message = uploadFailedMsg();
                    }
                }
                }else{
                //if no image was uploaded. set imagename to a deafult picture and make upload ok
                $imageName = "anon_user.jpg";
                $uploadOK = true;
            }//end of uploaded och file_exists

        }//end of check if user exist
        //if upload is okey, insert into database and start a session
            if($uploadOK == 1){

            registerUser($username,$password,$imageName,$info);
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = getUserId($username);
            //redirect user to the mainpage as logged in.
           header("Location:".base."admin/mainpage.php");
            }


    }// end of user inputs


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
    //
    ?>
    <div class="col-8">
        <?php echo($message); ?>
        <h2> Registrera en användare </h2>
        <form method="post" enctype="multipart/form-data">
            <!--username-->
            <div class="form-group">
                <label>Användarnamn</label>
                <input type="text" name="reg-username" class="form-control" placeholder="Välj ett användarnamn">
            </div>
            <!--password-->
            <div class="form-group">
                <label>Lösenord</label>
                <input type="password" name="reg-password" class="form-control" placeholder="Välj ett lösenord">
            </div>
            <!--textarea-->
            <div class="form-group">
                <label>Information om bloggen</label>
                <textarea class="form-control" name="reg-textarea" rows="3" placeholder="Vad handlar bloggen om"></textarea>
            </div>
            <!--Avatar-->
            <div class="form-group">
                <label>Profilbild</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input type="file" class="form-control-file" name="reg-image" accept="image/*">
            </div>
            <!--button-->
            <div class="form-group">
                <button type="submit" class="btn btn-dark" name="reg-register" >Registrera</button>
            </div>



        </form>
    </div>
    <!--footer-->
    <?php
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