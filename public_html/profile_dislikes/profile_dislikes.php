<div class=" DivToScroll DivWithScroll">
<?php 

      $sql2 = "SELECT * FROM disliked_comment WHERE disliked_username = '$profil_username' ORDER BY comment_date DESC ";
      
      $result = mysqli_query($connection, $sql2);
      $queries = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $_SESSION['row_no'] = 0;  
      foreach ($queries as $query)
      {

            $title = $query['topic_name'];
            $text = $query['comment_text'];
            $comment_date = $query['comment_date'];
            $username = $query['comment_username'];
            
            $sql = "SELECT * FROM comment WHERE  topic_name = '$title'  AND comment_date ='$comment_date' AND comment_username = '$username'";


            $result = mysqli_query($connection, $sql);
            $infos = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
      ?>

  
      <?php 
      foreach ($infos as $info) {
      ?>
      <div class="profile_comment_div" id="profile_comment_div_<?php echo htmlspecialchars($_SESSION['row_no']) ?>">
      <h4><?php echo htmlspecialchars($info['topic_name']); ?></h4>

      <?php

      include "entry_box/entry_box.php";
      $_SESSION['row_no'] = $_SESSION['row_no'] + 1;
      
      ?>
      </div>
      <?php 
      }
      }?>  
      </div>
