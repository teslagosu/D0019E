<!--Start of info-->
<div class="col-2 bg-dark text-white text-center">
    <h4>Aktiva bloggare:</h4>
    <div class="top5-border">
    <?php
    //includes
    include_once "controller/db_controller.php";
    //shows the newest user
    $data= getActiveUsers();

    foreach($data as $value){
       ?>

        <!--Profile picture-->
        <img src="<?php echo base. "uploads/".$value['user_image']?>" class="top5img" alt="avatar">
        <!--username-->
    <div class="info-user"><a href="<?=base."admin/publicuser.php?user=".$value['user_id']?>"><?php echo$value['user_name'] ?></a></div>
    <?php
    }

    ?>
</div>
</div>
</div>
<!--End of info-->
