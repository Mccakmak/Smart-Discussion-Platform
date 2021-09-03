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
            $_POST['owner_profile_title'] = $_SESSION['profil_button_type'];
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
           $_POST['owner_profile_title'] = $_SESSION['profil_button_type'];
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

  $sql2 = "SELECT * FROM user WHERE username = '$profil_username'";

  $result = mysqli_query($connection, $sql2);
  $user = mysqli_fetch_array($result, MYSQLI_ASSOC);


  $user_mail = $user['email'];
  $user_password = $user['password'];

  $password_length = strlen($user['password']);

  $sql2 = "SELECT * FROM user_profile WHERE username = '$profil_username'";
  $result = mysqli_query($connection, $sql2);
  $user_num = mysqli_num_rows($result);

  $user_realname = "";
  $user_realsurname = "";
  $user_age = "";
  $user_gender = "";
  if($user_num != 0)
  {
      $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $user_realname = $user['user_realname'];
      $user_realsurname = $user['user_realsurname'];
      $user_age = $user['user_age'];
      $user_gender = $user['user_gender'];
  }

?>

<?php 

    if(isset($_POST['update_profile']))
    {
        // if the input is empty do not update 

        $mail = !empty($_POST['mail']) ? $_POST['mail'] : $user_mail;
        $password = !empty($_POST['password']) ? $_POST['password'] : $user_password;

        $name = !empty($_POST['name']) ? $_POST['name'] : $user_realname;
        $surname = !empty($_POST['surname']) ? $_POST['surname'] : $user_realsurname;
        $age = !empty($_POST['age']) ? $_POST['age'] : $user_age;
        $gender = !empty($_POST['gender']) ? $_POST['gender'] : $user_gender;

        $sql = "UPDATE user SET email = '$mail', password = '$password' WHERE username = '$profil_username'";

        mysqli_query($connection, $sql);


        if($user_num !=0)
        {
            $sql = "UPDATE user_profile SET user_realname = '$name' , user_realsurname = '$surname', user_age = '$age', user_gender = '$gender'  WHERE username = '$profil_username'";
        }
        else
        {
            $sql = "INSERT INTO user_profile(username,user_realname,user_realsurname,user_age,user_gender) 
            VALUES('$profil_username', '$name', '$surname', '$age', '$gender')";            
        }

        if(mysqli_query($connection, $sql))
        {
            echo 
            '<script>
                Swal.fire({icon: "success",title: "Informations are updated!",showConfirmButton: false,timer: 1000}).
                then(
                  function()
                  {
                    $(document).ready(function()
                    {
                      $("#owner_profile_information").click();
                      });
                    }); 
            </script>';      
        }


    }

?>


<div id="owner_box_1">

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
    </ul>
  
    
</div>


<div class="owner_box_2">

  <ul class="list2" style="color:black;">
    
    <form id="owner_profile_titles_form" method="POST">
      <input type="hidden" name="owner_profile_title" id="owner_profile_title" value="">
      <li class="btn btn-primary rounded-pill 
      <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Informations")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" 
        id="owner_profile_information" style="cursor:pointer;">Informations
      </li>
      <li class="btn btn-primary rounded-pill
        <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Topics")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_topics" style="cursor:pointer;">Topics</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Comments")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_comments" style="cursor:pointer;">Comments</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Likes")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_likes" style="cursor:pointer;">Likes</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Dislikes")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_dislikes" style="cursor:pointer;">Dislikes</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Following")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_following" style="cursor:pointer;">Following</li>
      <li class="btn btn-primary rounded-pill
            <?php  
        if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Follower")
        {
          echo htmlspecialchars('border border-white');
        }
        ?>" id="owner_profile_follower" style="cursor:pointer;">Follower</li>

    </form>
  </ul>
</div>


<div class="owner_box_3">

<form name="profile_link_form" method="POST" action="main_profile.php">
      <input type="hidden" name="profile_name" id="profile_name" value="">
</form>

<form name="profile_title_form" method="POST" action="main.php">
        <input type="hidden" name="topic_title" id="topic_title" value="">
</form>

<?php

  if(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Informations")
  {
      //$_SESSION['profil_button_type'] = 'Informations';
      include("profile_informations/profile_informations.php"); 
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Topics")
  {   
      //$_SESSION['profil_button_type'] = 'Topics';
      include("profile_topics/profile_topics.php");
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Comments")
  { 
      $_SESSION['profil_button_type'] = 'Comments';
      include("profile_comments/profile_comments.php");
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Likes")
  { 
      $_SESSION['profil_button_type'] = 'Likes';
      include("profile_likes/profile_likes.php");
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Dislikes")
  {

      $_SESSION['profil_button_type'] = 'Dislikes';
      include("profile_dislikes/profile_dislikes.php");
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Following")
  {
      include("profile_following/profile_following.php");
  }
  elseif(isset($_POST['owner_profile_title']) && $_POST['owner_profile_title'] == "Follower")
  {
      include("profile_follower/profile_follower.php");
  }

?>

</div>



<script type="text/javascript">

  $("#owner_profile_information").click(function(event) {
      $('#owner_profile_title').val("Informations");    
      $("#owner_profile_titles_form").submit();  
    });

  $("#owner_profile_topics").click(function(event) {
    $('#owner_profile_title').val("Topics");
    $("#owner_profile_titles_form").submit();  
  });

  $("#owner_profile_comments").click(function(event) {
    $('#owner_profile_title').val("Comments");
    $("#owner_profile_titles_form").submit();  
  });

  $("#owner_profile_likes").click(function(event) {
    $('#owner_profile_title').val("Likes");
    $("#owner_profile_titles_form").submit();  
  });    

  $("#owner_profile_dislikes").click(function(event) {
    $('#owner_profile_title').val("Dislikes");
    $("#owner_profile_titles_form").submit();  
  });

    $("#owner_profile_following").click(function(event) {
    $('#owner_profile_title').val("Following");
    $("#owner_profile_titles_form").submit();  
  });

    $("#owner_profile_follower").click(function(event) {
    $('#owner_profile_title').val("Follower");
    $("#owner_profile_titles_form").submit();  
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



