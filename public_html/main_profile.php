<?php session_start(); ?>

<?php include("header/header.php"); ?>

<?php 

  if(isset($_POST['following_name']))
  {
    
     $user = ltrim($_POST['following_name'], '@');
     $_POST['profile_name'] = $user;
  }


  if(isset($_POST['follower_name']))
  {
    
     $user = ltrim($_POST['follower_name'], '@');
     $_POST['profile_name'] = $user;
  }

 ?>

<div id="main_profile" class="container-fluid">

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

        <div class="profile">

            <div id="inside_profile" class="container-fluid">
                <?php

                if(isset($_POST['profile_name']))
                {
                    $_SESSION['profile_name'] = $_POST['profile_name'];
                }
                    

                if($_SESSION['profile_name'] == $_SESSION['username'])
                {
                    include("profile_owner/profile_owner.php"); 
                }
                else
                {
                    include("profile_host/profile_host.php"); 
                }
                ?>
            </div>

        </div>

        <div class="footer" > 
            <?php include("footer/footer.php"); ?>
        </div>
</div>
    </body>
</html>


<script type="text/javascript">
  var height = $(".owner_box_3").height();
  $("#inside_profile .DivWithScroll").height(height);

    var height = $(".host_box_3").height();
  $("#inside_profile .DivWithScroll").height(height);
</script>

