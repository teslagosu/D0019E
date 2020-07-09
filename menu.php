<!--start of menu-->
<div class="row">
    <div id="menu" class="col-2 bg-dark text-white">
        <h4>Nya inlägg</h4>
        <div class="top5-border">
        <?php
        //includes
        include_once (__DIR__."/controller/db_controller.php");
        include_once "constants.php";
        //loop through the array from db of the five latest blogs
        foreach(getFiveLatestBlogs() as $db_data){
            //print out userimage,username,post title and date.
            ?>
            <div class="top5-border">
            <img src="<?php echo base."uploads/".$db_data['user_image']?>" class="top5img" alt="avatar">
            <a href="<?php echo base."admin/blogpost.php?user=".$db_data['post_user_id']."&id=".$db_data['post_id'] ?>" class="top5-title"><?php echo mb_strimwidth($db_data['post_title'],0,15,"...")?></a>
            <br>
            <div class="menu-user"><a href="<?=base."admin/publicuser.php?user=".$db_data['post_user_id']?>"><?php echo$db_data['user_name'] ?></a></div><div class="menu-date"><?php echo $db_data['post_date']?></div>
            </div>
                <?php
        }
        ?>




            </div>

    </div>
<!--end of menu-->