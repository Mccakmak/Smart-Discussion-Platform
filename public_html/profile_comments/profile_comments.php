<?php 

      $sql2 = "SELECT * FROM comment WHERE comment_username = '$profil_username' ORDER BY comment_date DESC ";

      $result = mysqli_query($connection, $sql2);
      $infos = mysqli_fetch_all($result, MYSQLI_ASSOC);

      ?>

      
      <div class=" DivToScroll DivWithScroll">
        
      <?php 
      $_SESSION['row_no'] = 0; 
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
      ?>  
      </div>            
      
