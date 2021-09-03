<?php session_start(); ?>


<?php 

include("header/header.php");
include("survey.php"); 

?>


<div id="main_page" class="container-fluid">

        <?php
                    
                    if(isset($_SESSION["username"]))
                    {
            ?>      
                        <div class="site_navbar">    
                            <?php include("navbar2/navbar2.php"); ?>
                        </div>  
            <?php }
                    else
                    {
            ?>      
                        <div class="site_navbar">    
                            <?php include("navbar/navbar.php"); ?>
                        </div>                
        <?php } ?>  
        
        <div class="hot_topics" > 
            <?php include("hot_topics/hot_topics.php"); ?>
        </div>

        <div class="entry" >   
            <?php 

            include("entry/entry.php"); 
            ?>
        </div>

        <div class="most">
            <?php include("most/most.php"); ?>
        </div>

        <div class="footer" > 
            <?php include("footer/footer.php"); ?>
        </div>
</div>
    </body>
</html>




 <script type="text/javascript">
     $(document).ready(function($) {
        if($('#show_survey').val() == 'true')
        {
            $('#feedback_modal').modal('show');
        }
    
});


 </script>