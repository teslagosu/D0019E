<?php

//include the database from the rootfolder and into the db.php folder.
include_once __DIR__."/../model/db.php";
include_once __DIR__."/../config.php";
include_once __DIR__."/../constants.php";

//error function that displays messages of errors
function mysql_fatal_error()
{
    echo <<< _END
We are sorry, but it was not possible to complete
the requested task. The error message we got was:
<p>Fatal Error</p>
Please click the back button on your browser
and try again. If you are still having problems,
please <a href="mailto:admin@server.com">email
our administrator</a>. Thank you.
_END;
}

//open up connection to the database.
function openConnection(){
    //new instance of the class database
    $db = new Database();
    //set conn as a new msqli with getfunctions from db class
    $conn = new mysqli($db->getServer(), $db->getUsername(), $db->getPassword(), $db->getDatabase());
    if($conn->connect_error)
        die("Could not connect: " .mysqli_error());
    //set charset to utf8 so that åäö can get displayed.
   $conn->set_charset("utf8");

    return $conn;
}
//get the latest blog post
function getLatestBlogPost(){
    $link = openConnection();
    $query = "SELECT p.post_id, p.post_user_id, p.post_title, u.user_name FROM  user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) ORDER BY post_id DESC";

    if($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    //print out the blog posts
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class=\"results\">";
        echo "<a href=".base."admin/blogpost.php?user=".$row['post_user_id']."&id=".$row['post_id']." class='title'>".$row['post_title']."</a>";


        //spara
        echo("<p id='written-by'>Skrivet av: <a href='".base."admin/publicuser.php?user=".$row['post_user_id']."'>".$row['user_name']."</a></p>");
        echo " </div>";
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);


}
/*
function getFiveLatestBlogPosts(){

    $link = openConnection();
    $query = "SELECT u.user_name ,u.user_image,p.post_id,p.post_user_id, p.post_title, post_date FROM user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) ORDER BY post_id DESC LIMIT 5 ";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result))
    {
        echo"<div class='top5-border'>";
        echo("<img src='".base."uploads/".$row['user_image']."' id='top5profileimg'></a>");
        //echo("<img src='".base."uploads/".getProfileImage($row['user_name'])."' id='top5profileimg'></a>");
        echo ("<a id='top5-title'href=".base."admin/blogpost.php?user=".$row['post_user_id']."&id=".$row['post_id']."id='top5-title'>".mb_strimwidth($row['post_title'],0,15,"...")."</a>");
        // echo "<p id=\"written-by\">Skrivet av: <a href=\"http://google.com/\">Kalle 123";
        echo("<p><a href='".base."admin/publicuser.php?user=".$row['post_user_id']."'>".$row['user_name']."</a></p><p>".$row['post_date']."</p>");
        echo("</div>");
    }
    // Close statement
    mysqli_stmt_close($stmt);
// Close connection
    mysqli_close($link);

}
*/
// gets five latest blog posts
function getFiveLatestBlogs(){
    //create an array
    $rows = array();
    //open connection to db
    $link = openConnection();
    //prepared statement
    $query = "SELECT u.user_name,u.user_image,p.post_id,p.post_user_id, p.post_title, post_date FROM user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) ORDER BY post_id DESC LIMIT 5 ";
    //if everything went okey with the query set it to statement
    if($stmt = mysqli_prepare($link, $query)) {
        //execute the statement
        mysqli_stmt_execute($stmt);
    }
    // get the result
    $result = $stmt->get_result();
    //loop through the results and put it into an array
   while($row = mysqli_fetch_assoc($result)){
       $rows[] = $row;
   }

    // Close statement
    mysqli_stmt_close($stmt);
// Close connection
    mysqli_close($link);

//return the array with data
    return $rows;
}
// gets the data of all the users posts to the public
function getPublicUsersPost($user_id){
    //an array
    $rows = array();
    $link = openConnection();
    $query = "SELECT p.post_id,p.post_user_id, p.post_title, post_date FROM user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) WHERE p.post_user_id = ? ORDER BY post_id DESC";

    if($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
    }
    //store the results in an array
    $result = $stmt->get_result();
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    // Close statement
    mysqli_stmt_close($stmt);
// Close connection
    mysqli_close($link);
//return the array filled with data
    return $rows;
}

// get all blog posts by title
function getAllBlogPostsByTitle(){
    openConnection();
    $query ="SELECT post_title from Post ORDER BY post_date DESC ";
    $result = openConnection()->query($query);
    if (!$result) die(mysql_fatal_error());
    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo htmlspecialchars($row['post_title']) . '<br>';
    }
    $result->close();
    openConnection()->close();

}
// get the newest user
function getNewestUser(){
    openConnection();
    $query ="SELECT user_name from User ORDER BY user_id DESC LIMIT 1 ";
    $result = openConnection()->query($query);
    if (!$result) die(mysql_fatal_error());
    $rows = $result->num_rows;

    for ($j = 0 ; $j < $rows ; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo htmlspecialchars($row['user_name']) . '<br>';
    }
    $result->close();
    openConnection()->close();
}
/*
function checkIfUserExist($username){
    openConnection();
    $query = "SELECT * FROM user WHERE user_name='$username'";
    $result = openConnection()->query($query);
    if (!$result) die(mysqli_error());
    $rows = $result->num_rows;
    $result->close();
    openConnection()->close();
    if($rows > 0){
        return true;
    }else{
        return false;
    }


}
*/
//gets the username form the db
function getUsername($username){
    $dbName ="";
    openConnection();
    $query = "SELECT user_name FROM user WHERE user_name='$username'";
    $result = openConnection()->query($query);
    if (!$result) die(mysql_fatal_error());

    $row = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    openConnection()->close();
    return htmlspecialchars($row[user_name]);
}
//checks if the user exists already
function checkifUserExist($username){
    //open connection
    $link = openConnection();
    //prepared statement query
    $query = "SELECT user_name FROM User WHERE user_name = ?";

    if($stmt = mysqli_prepare($link, $query)) {
        //bind the username to the ? and execute
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        //bind the result from username
        $stmt->bind_result($username);
        $result = $stmt->get_result();
        //how many rows did come up from the result
        $rows =$result->num_rows;

    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
// if rows is bigger then 0, then the user exist. else return 0 (false)
    if($rows > 0){
        return 1;
        }else{
        return 0;
    }


}
//gets the users id
function getUserId($username){
    //open connection
    $link = openConnection();
    //select all from user where the username is ?
    $query = "SELECT * FROM User WHERE user_name = ?";
    // if ok, execute statement
    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $username);

        mysqli_stmt_execute($stmt);
    }
    //get the result and fetch array
    $result = $stmt->get_result();
    $user = $result->fetch_array(MYSQLI_ASSOC);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//returns the id
return htmlspecialchars($user[user_id]);

}
//get post id from userid
function getPostIdForUser($userid){
//open connection
    $link = openConnection();
    $query = "SELECT post_id FROM Post WHERE post_user_id = ? ORDER BY post_id DESC LIMIT 1";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $userid);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    $user = $result->fetch_array(MYSQLI_ASSOC);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//return post id
    return htmlspecialchars($user[post_id]);

}

function getPostTitlesFromUserId($userid){

    $link = openConnection();
    $query = "SELECT p.post_id, p.post_user_id, p.post_title, post_content, post_date FROM user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) WHERE post_user_id = ? ORDER BY post_id DESC";

    if($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $userid);
        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr><td>". (htmlspecialchars($row['post_title'])."</td>");
        echo "<td><a href=".base."admin/blogpost.php?user=".$row['post_user_id']."&id=".$row['post_id']." class='btn btn-info'>Visa</a></td>";
        echo "<td><a href=".base."admin/myblogposts.php?edit=".$row['post_id']."&title=".$row['post_title']."&blogtext=".$row['post_content']."&date=".$row['post_date']." class='btn btn-warning'>Ändra</a></td>";
        echo "<td><a href=".base."admin/myblogposts.php?delete=".$row['post_id']." class='btn btn-danger'>Radera</a></td>";

        echo "</tr>";

    }
    // Close statement
    mysqli_stmt_close($stmt);
// Close connection
    mysqli_close($link);

}

//get post content by id
function getPostByID($postid){

    $link = openConnection();
    $query = "SELECT * FROM user AS u JOIN Post AS p ON (u.user_id = p.post_user_id) WHERE post_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $postid);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//return post content
    return $row;

}
//get the title of the post by id
function getPostTitleByID($postid){

    $link = openConnection();
    $query = "SELECT post_title FROM Post WHERE post_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $postid);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//return the title
    return $row['post_title'];

}
//get only the content of the post
function getPostContentByID($postid){

    $link = openConnection();
    $query = "SELECT post_content FROM Post WHERE post_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $postid);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//return the content
    return $row['post_content'];

}
// get image that belongs to the post by id
function getImageByPostId($postid){
    $link = openConnection();
    $query = "SELECT i.image_name FROM Image AS i JOIN Post AS p ON (i.post_id = p.post_id) WHERE i.post_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $postid);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    if($result == false) {
      return 0;

    }else{
        $row = mysqli_fetch_assoc($result);

    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);

    return $row;
    }
}
//get username, presentation and image from user by id
function getUserByID($userId){
    $link = openConnection();
    $query = "SELECT user_name, user_presentation, user_image FROM user WHERE user_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $userId);


        mysqli_stmt_execute($stmt);
    }
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
//return array of data
    return $row;

}


//escape characters
function db_escape($str)
{
    $db = new Database();
    $conn = new mysqli($db->getServer(), $db->getUsername(), $db->getPassword(), $db->getDatabase());
    return mysqli_real_escape_string($conn, $str);
}
//register user
function registerUser($username,$password,$imageName,$information){
    //open connection
    $link = openConnection();
    //prepared statement query
    $query = "INSERT INTO User (user_name, user_password,user_image,user_presentation) VALUES(?,?,?,?)";

if($stmt = mysqli_prepare($link, $query)) {
    //bind the ?,?,?,? with the variables inserted to the function
    mysqli_stmt_bind_param($stmt, 'ssss', $user_name, $user_password, $user_image, $user_presentation);
    $user_name = $username;
    $user_password = password_hash($password,PASSWORD_DEFAULT);
    $user_image = $imageName;
    $user_presentation = $information;
    //execute statement
    mysqli_stmt_execute($stmt);
}
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
// checks the hashed password from the user when loggin in
function checkHashedPassword($username,$password){
    openConnection();
    $query ="SELECT user_password from User WHERE user_name = '$username' ";
    $result = openConnection()->query($query);
    if (!$result) die(mysql_fatal_error());
    $rows = $result->num_rows;
        $row = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    openConnection()->close();
    if(password_verify($password,$row['user_password'])){
        return true;
    }else{
       return false;
    }

}
//return profile image by username
function getProfileImage($username){
        openConnection();
        $query = "SELECT user_image FROM user WHERE user_name='$username'";
        $result = openConnection()->query($query);
        if (!$result) die(mysql_fatal_error());

        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
        openConnection()->close();
        return $row[user_image];

}
//gets information about the user from username
function getProfileInfo($username){
    openConnection();
    $query = "SELECT user_presentation FROM user WHERE user_name='$username'";
    $result = openConnection()->query($query);
    if (!$result) die(mysql_fatal_error());

    $row = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    openConnection()->close();
    //returns the presentation
    return $row[user_presentation];
}

//update the users profile picture
function updateUserProfileImage($username,$imageName){
    $link = openConnection();
    $query = "UPDATE User SET user_image=? WHERE user_name=?";

    if($stmt = mysqli_prepare($link, $query)) {
        //bind the ? where the username is the same
        mysqli_stmt_bind_param($stmt, 'ss',  $user_image,$user_name);
        $user_image = $imageName;
        $user_name = $username;

        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//updates users information by user id
function updateUserProfileInformation($userid,$user_presentation){
    $link = openConnection();
    $query = "UPDATE User SET user_presentation=? WHERE user_id=?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 'ss',  $user_presentation,$userid);



        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//update a blog post
function updatePost($postid,$title,$content,$date){
    $link = openConnection();
    $query = "UPDATE Post SET post_title=?,post_content=?,post_date=? WHERE post_id=?";

    if($stmt = mysqli_prepare($link, $query)) {
//bind ? ? ? with title, content and date, where post id is the same
        mysqli_stmt_bind_param($stmt, 'ssss',  $title,$content,$date,$postid);


        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//updates the image of a blog post
function updateImage($postid,$imagename){
    $link = openConnection();
    $query = "UPDATE Image SET image_name=? WHERE post_id=?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 'si',  $imagename,$postid);


        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//check if an image exist in a post by post id
function doesImageExistInPost($postid){
    $link = openConnection();
    $query = "SELECT image_name FROM IMAGE WHERE post_id=?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 'i', $postid);
        mysqli_stmt_execute($stmt);
        $stmt->store_result();
        $result = $stmt->num_rows;

    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
    //returns amount of rows
    return $result;
}
//insert blog post into database
function insertPostToDatabase($userid,$title,$text,$date){
    $link = openConnection();
    $query = "INSERT INTO Post (post_user_id, post_title,post_content,post_date) VALUES(?,?,?,?)";

    if($stmt = mysqli_prepare($link, $query)) {
        //binds the statement by user id, title, content and date.
        mysqli_stmt_bind_param($stmt, 'ssss', $post_user_id, $post_title, $post_content, $post_date);
        $post_user_id = $userid;
        $post_title = $title;
        $post_content = $text;
        $post_date = $date;
        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//inserts one image into the database with help of post id
function insertImageToDatabase($postid,$imageName){
    $link = openConnection();
    $query = "INSERT INTO Image (post_id,image_name) VALUES(?,?)";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 'is', $post_id, $image_name);
        $post_id = $postid;
        $image_name = $imageName;

        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}
//deletes a blog post from the database
function deletePostFromDatabase($postid){
    $link = openConnection();
    $query = "DELETE FROM Post WHERE post_id = ?";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $postid);

        mysqli_stmt_execute($stmt);
    }
    // Close statement
    mysqli_stmt_close($stmt);

// Close connection
    mysqli_close($link);
}




//fixes the string from attacks
function mysql_fix_string($conn, $string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
}
?>
