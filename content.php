<!--Start of content-->
<div id="content" class="col-8">
    <?php
    //include db controller
    include_once (__DIR__."/controller/db_controller.php");


    ?>

<h2 style="text-align: center">Alla inlägg</h2>


        <?php
        //shows all blog posts in content
        $data = getLatestBlogPost();
        ?>

</div>
<!--End of content.php-->