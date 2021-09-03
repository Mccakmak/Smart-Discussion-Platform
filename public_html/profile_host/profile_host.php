<?php 
   
   // Comment like dislike  
    if(isset($_POST['comment_form']))
    {
      if(!isset($_SESSION['username']))
      {
        echo 
            '<script>
              Swal.fire({icon: "error",title: "You need to login to like or dislike a comment!",showConfirmButton: false,timer: 1500});
            </script>';   
      $_POST['page'] = $_SESSION['active_page'];                
      }
      else
      {
        if($_POST['type'] == 'like')
        {
          $_POST["page"] = $_SESSION['active_page'];

          $title = $_POST['title'];
          $text = $_POST['text'];
          $username = $_POST['username'];
          $date = $_POST['date'];
          $liked_username = $_SESSION['username'];

          $sql = "SELECT * FROM disliked_comment WHERE topic_name = '$title'  
          AND comment_username = '$username' AND comment_date ='$date' AND disliked_username = '$liked_username' ";
        
          $result = mysqli_query($connection, $sql);
          $comment_num = mysqli_num_rows($result);

          if($comment_num != 0)   // has already disliked that comment
          {
            $sql = "DELETE FROM disliked_comment WHERE topic_name = '$title'  
            AND comment_username = '$username' AND comment_date ='$date' AND disliked_username = '$liked_username'" ;

            mysqli_query($connection, $sql);

            $sql2 = "SELECT comment_dislike_num FROM comment WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username' ";

            $result = mysqli_query($connection, $sql2);
            $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $comment_dislike_num = $comment['comment_dislike_num'];

            $comment_dislike_num = $comment_dislike_num - 1;

            $sql3 = "UPDATE comment SET comment_dislike_num = '$comment_dislike_num' WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username'";
            mysqli_query($connection, $sql3);           
          } 



          $sql = "INSERT INTO liked_comment(topic_name,comment_text,comment_username,comment_date,liked_username) 
          VALUES('$title','$text','$username','$date', '$liked_username')";

          if(mysqli_query($connection,$sql))
          {
            $sql2 = "SELECT comment_like_num FROM comment WHERE topic_name = '$title'  AND comment_date ='$date'
            AND comment_username = '$username' ";

            $result = mysqli_query($connection, $sql2);
            $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $comment_like_num = $comment['comment_like_num'];

            $comment_like_num = $comment_like_num + 1;

            $sql3 = "UPDATE comment SET comment_like_num = '$comment_like_num' WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username'";
            if(!mysqli_query($connection, $sql3))
            {
              echo 
                  '<script>
                    Swal.fire({icon: "error",title: "Sql error!",showConfirmButton: false,timer: 1500});
                  </script>';                 
            }
            $_POST['topic_title'] = $title;
            $_POST['page'] = $_SESSION['active_page'];
            
          }
          $_POST['profile_title'] = $_SESSION['profil_button_type'];
        }
        elseif($_POST['type'] == 'dislike')
        {
          $_POST["page"] = $_SESSION['active_page'];

          $title = $_POST['title'];
          $text = $_POST['text'];
          $username = $_POST['username'];
          $date = $_POST['date'];
          $disliked_username = $_SESSION['username'];


          $sql = "SELECT * FROM liked_comment WHERE topic_name = '$title'  
          AND comment_username = '$username' AND comment_date ='$date' AND liked_username = '$disliked_username' ";
        
          $result = mysqli_query($connection, $sql);
          $comment_num = mysqli_num_rows($result);

          if($comment_num != 0)   // has already liked that comment
          {
            $sql = "DELETE FROM liked_comment WHERE topic_name = '$title'  
            AND comment_username = '$username' AND comment_date ='$date' AND liked_username = '$disliked_username'" ;

            mysqli_query($connection, $sql);

            $sql2 = "SELECT comment_like_num FROM comment WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username' ";

            $result = mysqli_query($connection, $sql2);
            $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $comment_like_num = $comment['comment_like_num'];

            $comment_like_num = $comment_like_num - 1;

            $sql3 = "UPDATE comment SET comment_like_num = '$comment_like_num' WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username'";
            mysqli_query($connection, $sql3);           
          }         



          $sql = "INSERT INTO disliked_comment(topic_name,comment_text,comment_username,comment_date,disliked_username) 
          VALUES('$title','$text','$username','$date', '$disliked_username')";

          if(mysqli_query($connection,$sql))
          {
            $sql2 = "SELECT comment_dislike_num FROM comment WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username' ";

            $result = mysqli_query($connection, $sql2);
            $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $comment_dislike_num = $comment['comment_dislike_num'];

            $comment_dislike_num = $comment_dislike_num + 1;

            $sql3 = "UPDATE comment SET comment_dislike_num = '$comment_dislike_num' WHERE topic_name = '$title'  AND comment_date ='$date' AND comment_username = '$username'";
            if(!mysqli_query($connection, $sql3))
            {
              echo 
                  '<script>
                    Swal.fire({icon: "error",title: "Sql error!",showConfirmButton: false,timer: 1500});
                  </script>';                 
            }

            $_POST['topic_title'] = $title;
            $_POST['page'] = $_SESSION['active_page'];
            
          }
          $_POST['profile_title'] = $_SESSION['profil_button_type'];
        }
        else
        {
          echo 
              '<script>
                Swal.fire({icon: "error",title: "Could not like or dislike!",showConfirmButton: false,timer: 1500});
              </script>';
        }       
      }
    }

  ?>


<?php 

    $profil_username = $_SESSION['profile_name'];

 ?>

<div id="host_box_1">

    <ul class="list1">
    
      <li>
        <font size="5" class="name"><?php echo htmlspecialchars($profil_username); ?> Profile</font>
      </li>
      
       <?php 
    
          $sql2 = "SELECT * FROM user_follow WHERE username = '$profil_username' ";
          
          $result = mysqli_query($connection, $sql2);
          $following_no = mysqli_num_rows($result);
       ?>

      <li style="color:black;">
      Following: <?php echo htmlspecialchars($following_no) ?>
      </li>

       <?php 
    
          $sql2 = "SELECT * FROM user_follow WHERE following_user = '$profil_username' ";
          
          $result = mysqli_query($connection, $sql2);
          $follower_no = mysqli_num_rows($result);
       ?>
      
      <li style="color:black;">
      Followers: <?php echo htmlspecialchars($follower_no) ?>
      </li>

      <li style="color:black;">
      
      <?php 
          $sql2 = "SELECT * FROM topic WHERE topic_creator_username = '$profil_username' ";
          
          $result = mysqli_query($connection, $sql2);
          $topic_no = mysqli_num_rows($result);
       ?>

      Topics: <?php echo htmlspecialchars($topic_no) ?>
        
      </li>

      <li style="color:black;">

      <?php 

          $sql2 = "SELECT * FROM comment WHERE comment_username = '$profil_username' ";
        
          $result = mysqli_query($connection, $sql2);
          $comment_no = mysqli_num_rows($result);

       ?>
      Comments: <?php echo htmlspecialchars($comment_no); ?>
      </li>
     
       <li class="follow">
        <button name="follow_button" type="submit" form="follow_form" class="follow_button btn btn-primary border rounded-pill" >

        <?php
          $username = $_SESSION['username']; 
          $sql2 = "SELECT * FROM user_follow WHERE username = '$username' AND following_user = '$profil_username' ";
        
          $result = mysqli_query($connection, $sql2);
          $followed_no = mysqli_num_rows($result);
          
          if($followed_no != 0)
          {
            echo htmlspecialchars('Unfollow');
            $_SESSION['following'] = 'yes';
          }
          else
          {
            echo htmlspecialchars('Follow');
            $_SESSION['following'] = 'no';

          }

         ?>  
        </button>
      </li>        
    
    </ul>
  
    
</div>

<form id="follow_form" name="follow_form" method="POST"></form>


<div class="host_box_2">

  <ul class="list2" style="color:black;">
    
    <form id="profile_titles_form" method="POST">
      <input type="hidden" name="profile_title" id="profile_title" value="">

      <li class="btn btn-primary rounded-pill
        <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Topics")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_topics" style="cursor:pointer;">Topics</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Comments")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_comments" style="cursor:pointer;">Comments</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Likes")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_likes" style="cursor:pointer;">Likes</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Dislikes")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_dislikes" style="cursor:pointer;">Dislikes</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Following")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_following" style="cursor:pointer;">Following</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Follower")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="profile_follower" style="cursor:pointer;">Follower</li>
    </form>
  </ul>
</div>


<div class="host_box_3">

<form name="profile_link_form" method="POST" action="main_profile.php">
      <input type="hidden" name="profile_name" id="profile_name" value="">
</form>

<form name="profile_title_form" method="POST" action="main.php">
        <input type="hidden" name="topic_title" id="topic_title" value="">
</form>

<?php 

  if(isset($_POST['profile_title']) && $_POST['profile_title'] == "Topics")
  {
      include("profile_topics/profile_topics.php");
  }
  elseif(isset($_POST['profile_title']) && $_POST['profile_title'] == "Comments")
  {

      $_SESSION['profil_button_type'] = 'Comments';
      include("profile_comments/profile_comments.php");
  }
  elseif(isset($_POST['profile_title']) && $_POST['profile_title'] == "Likes")
  {

      $_SESSION['profil_button_type'] = 'Likes';
      include("profile_likes/profile_likes.php");
  }
  elseif(isset($_POST['profile_title']) && $_POST['profile_title'] == "Dislikes")
  {
      $_SESSION['profil_button_type'] = 'Dislikes';
      include("profile_dislikes/profile_dislikes.php");
  }
  elseif(isset($_POST['profile_title']) && $_POST['profile_title'] == "Following")
  {
      include("profile_following/profile_following.php");
  }
  elseif(isset($_POST['profile_title']) && $_POST['profile_title'] == "Follower")
  {
      include("profile_follower/profile_follower.php");
  }
?>

</div>



<script type="text/javascript">
  $("#profile_topics").click(function(event) {
    $('#profile_title').val("Topics");
    $("#profile_titles_form").submit();  
  });

  $("#profile_comments").click(function(event) {
    $('#profile_title').val("Comments");
    $("#profile_titles_form").submit();  
  });

  $("#profile_likes").click(function(event) {
    $('#profile_title').val("Likes");
    $("#profile_titles_form").submit();  
  });    

  $("#profile_dislikes").click(function(event) {
    $('#profile_title').val("Dislikes");
    $("#profile_titles_form").submit();  
  });

  $("#profile_following").click(function(event) {
    $('#profile_title').val("Following");
    $("#profile_titles_form").submit();  
  });

  $("#profile_follower").click(function(event) {
    $('#profile_title').val("Follower");
    $("#profile_titles_form").submit();  
  });


  $('.profile_comment_div h4').click(function(event)
  { 
    var form_title_id = $(this).closest('.profile_comment_div').attr('id');
    form_title_id = '#' + form_title_id;

    var title = $(form_title_id + ' h4').text();

    document.profile_title_form.topic_title.value = title
    document.profile_title_form.submit();
  });

    $(document).ready(function() {
      $("form .like_button svg").click(function(event) {

        var form_title_id = $(this).closest('.profile_comment_div').attr('id');
        var form_id = $(this).closest('form').attr("id");

        form_title_id = '#' + form_title_id;
        form_id = '#' + form_id;

        var title = $(form_title_id + ' h4').text();
        var text = $(form_id + ' #comment_text').text();
        var username = $(form_id + ' .comment_username').text();
        username = username.replace(/\s/g, ''); //remove space
        var date = $(form_id + ' #comment_date').text();


        $(form_id + ' #title').val(title);
        $(form_id + ' #text').val(text);
        $(form_id + ' #username').val(username);
        $(form_id + ' #date').val(date);
        $(form_id + ' #type').val('like');
        $(form_id).submit();  
      });
  });

  $(document).ready(function() {
      $("form .dislike_button svg").click(function(event) {

        var form_title_id = $(this).closest('.profile_comment_div').attr('id');
        var form_id = $(this).closest('form').attr("id");

        form_title_id = '#' + form_title_id;
        form_id = '#' + form_id;

        var title = $(form_title_id + ' h4').text();
        var text = $(form_id + ' #comment_text').text();
        var username = $(form_id + ' .comment_username').text();
        username = username.replace(/\s/g, ''); //remove space
        var date = $(form_id + ' #comment_date').text();

        $(form_id + ' #title').val(title);
        $(form_id + ' #text').val(text);
        $(form_id + ' #username').val(username);
        $(form_id + ' #date').val(date);
        $(form_id + ' #type').val('dislike');
      $(form_id).submit(); 
      });
  });

</script>

<?php 

  if(isset($_POST['follow_button']))
  {

    if($_SESSION['following'] == 'no')
    {
      $username = $_SESSION['username'];  
      $sql = "INSERT INTO user_follow(username,following_user) VALUES('$username', '$profil_username')";            
      if(mysqli_query($connection, $sql))
      {
         
         echo '<script>
              Swal.fire({icon: "success",title: "Following is successful!",showConfirmButton: false,timer: 1000}).then(function(){window.location = "main_profile.php";});
          </script>';
/*          echo '<script>
              window.location = "main_profile.php";
          </script>';*/
      }
      else
      {
        echo '<script>
            Swal.fire({icon: "error",title: "Something went wrong!",showConfirmButton: false,timer: 1500})
        </script>';
      }
    }
    elseif($_SESSION['following'] == 'yes')
    {
       $username = $_SESSION['username'];
       $sql = "DELETE FROM user_follow WHERE username = '$username' AND following_user = '$profil_username' ";

      if(mysqli_query($connection, $sql))
      {
         
         echo '<script>
              Swal.fire({icon: "success",title: "Unfollowing is successful!",showConfirmButton: false,timer: 1000}).then(function(){window.location = "main_profile.php";});
          </script>';
/*          echo '<script>
              window.location = "main_profile.php";
          </script>';*/
      }
      else
      {
        echo '<script>
            Swal.fire({icon: "error",title: "Something went wrong!",showConfirmButton: false,timer: 1500})
        </script>';
      }
    }



  }

 ?>

