<!--Start of info-->
<div class="col-2 bg-dark text-white text-center">
    <h4>Nyaste bloggaren:</h4>
    <?php
    //includes
    include_once "controller/db_controller.php";
    //shows the newest user
    getNewestUser();
    ?>
</div>
</div>
<!--End of info-->
