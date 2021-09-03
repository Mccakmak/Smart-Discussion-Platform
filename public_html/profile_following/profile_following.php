<?php 
    $sql2 = "SELECT * FROM user_follow WHERE username = '$profil_username' ";

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
                  Following
                </div>
              </div>
              
              <form id= "following_name_form" name="following_name_form" method="POST">
                <input type="hidden" name="following_name" value="">
              </form>

              <?php  
              
              foreach ($users as $user) {
              ?>
              <div class="row">
                <div id="following_link" class="cell" data-title="Following">
                 <a style="cursor:pointer; color: #081aa1; " ><?php echo htmlspecialchars('@'. $user['following_user'])?></a> 
                </div>
              </div>
              <?php  } ?>
            </div>
        </div>
      </div>
  </div>
</div>





<script type="text/javascript">
  $("#following_link a").click(function(event) {
    var following_name = $(event.target).text();
    //search_name = search_name.replace(/\s/g, ''); //remove space
    following_name = following_name.trim();               // remove space not between only beginning and end
    document.following_name_form.following_name.value = following_name;

    if(following_name.charAt(0) == '@' )
    { 

      $("#following_name_form").attr("action","main_profile.php");
      document.forms["following_name_form"].submit();
    }
    
  });
</script>


