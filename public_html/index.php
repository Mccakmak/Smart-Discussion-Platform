<?php session_start(); ?>

<?php include("header/header.php"); ?>




<div class="container-fluid">

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

        <div class="intro" >   
            <?php include("introduction/introduction.php"); ?>
        </div>

        <div class="footer" > 
            <?php include("footer/footer.php"); ?>
        </div>
        
</div>
    </body>
</html>





