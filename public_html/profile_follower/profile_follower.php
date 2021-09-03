<?php 
    $sql2 = "SELECT * FROM user_follow WHERE following_user = '$profil_username' ";

    $result = mysqli_query($connection, $sql2);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="DivToScroll DivWithScroll" id="profile_topics_style">
    <div class="limiter">
      <div class="container-table100">
        <div class="wrap-table100">
            <div class="table">

              <div class="row header">
                <div class="cell">
                  Followers
                </div>
              </div>

              <form id= "follower_name_form" name="follower_name_form" method="POST">
                <input type="hidden" name="follower_name" value="">
              </form>
              
              <?php  
        
              foreach ($users as $user) {
              ?>
              <div class="row">
                <div id="follower_link" class="cell" data-title="Followers">
                 <a style="cursor:pointer; color: #081aa1; " ><?php echo htmlspecialchars('@'. $user['username'])?></a> 
                </div>
              </div>
              <?php  } ?>
            </div>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">
  $("#follower_link a").click(function(event) {
    var follower_name = $(event.target).text();
    //search_name = search_name.replace(/\s/g, ''); //remove space
    follower_name = follower_name.trim();               // remove space not between only beginning and end
    document.follower_name_form.follower_name.value = follower_name;

    if(follower_name.charAt(0) == '@' )
    { 

      $("#follower_name_form").attr("action","main_profile.php");
      document.forms["follower_name_form"].submit();
    }
    
  });
</script>



              


