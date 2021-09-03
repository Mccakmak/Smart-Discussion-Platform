<?php session_start(); ?>

<?php include("header/header.php"); ?>

<?php 

if(isset($_SESSION["username"]))
{ ?>
    <div id="feed_page" class="container-fluid">

        <div class="site_navbar">    
            <?php include("navbar2/navbar2.php"); ?>
        </div>  
      
        <div class="hot_topics" > 
            <?php include("hot_topics/hot_topics.php"); ?>
        </div>

        <div class="feed_entry" >   
            <?php include("feed_entry/feed_entry.php"); ?>
        </div>

        <div class="activity">
            <?php include("activity/activity.php"); ?>
        </div>

        <div class="footer" > 
            <?php include("footer/footer.php"); ?>
        </div>
    </div>

        </body>
    </html>
<?php 
}

    else
    {
        header('Location: ../index.php');
    }

 ?>





