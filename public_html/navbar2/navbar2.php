<?php 

if(isset($_POST['profile_username']))
{
    $_SESSION['profile_name'] = $_SESSION['username'];
}

 ?>

<!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    
    <form id="check_title_form" method="POST" action="main.php">
      <a id="back_to_main_navbar2" class="navbar-brand" style="cursor:pointer;" >Smart Discussion Platform</a>
      <input type="hidden" name="check_title" id="check_title" value="">
    </form>
    
    
    <!-- Sandwich button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    
    <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Sandwich button -->

    <!-- Start Container div -->
    <div class="collapse navbar-collapse" id="navbarColor01">

      <!-- Start navbar auto from left side -->
      <form name="topic_type_form" id="topic_type_form" method="POST">
        <ul class="navbar-nav mr-auto" id="topic_types">
        <!-- <li class="nav-item active"> </li> -->

        <input type="hidden" name="topic_type" id="topic_type" value="">

<!--           <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Sports</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Health</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Politics</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Economy</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Education</a>    
          </li>

          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Other</a>    
          </li> -->
      

        <!-- Start Dropdown -->

    <li class="nav-item dropdown">
          <a id="main_topic_drop" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Topics</a>
          <div id="topic_dropdown" class="dropdown-menu" >
            <a class="dropdown-item" href="#">Sports</a>
            <a class="dropdown-item" href="#">Health</a>
            <a class="dropdown-item" href="#">Politics</a>
            <a class="dropdown-item" href="#">Economy</a>
            <a class="dropdown-item" href="#">Education</a>
            <a class="dropdown-item" href="#">Tech/Science</a>
            <a class="dropdown-item" href="#">Art</a>
            <a class="dropdown-item" href="#">History</a>
            <a class="dropdown-item" href="#">Entertainment</a>


            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Other</a>
          </div>
        </li> 
</form>
        
                <li class='nav-item'>
            <!-- Add Discussion icon -->
            <svg  data-target ="#add_entry_modal" data-toggle="modal" type="button" id="add_entry" xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            <!-- Add Discussion icon  --> 
            <div class="modal fade" id="add_entry_modal" tabindex="-1" aria-labelledby="add_entry_label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="add_entry_label">Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="main.php">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Entry Title:</label>
                          <input name="title" type="text" class="form-control " id="recipient-name" maxlength="50" required>
                      </div>
                      <label for="entry_type">Entry Type:</label>

                      <select class="custom-select" name="entry_type" id="entry_type">
                        <option value="Sports">Sports</option>
                        <option value="Health">Health</option>
                        <option value="Politics">Politics</option>
                        <option value="Economy">Economy</option>
                        <option value="Education">Education</option>
                        <option value="Tech/Science">Tech/Science</option>
                        <option value="Art">Art</option>
                        <option value="History">History</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Other">Other</option>

                      </select> 
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Your Comment: </label>
                        <textarea name="comment" class="form-control" id="message-text" rows="3" maxlength="200" required></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="crate_topic" type="submit" class="btn btn-primary">Create Entry</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>            
        </li>
        
      <form id="search_name_form" name="search_name_form" method="POST">
        <input type="hidden" name="search_name" value="">
      </form>        
      
        <li class='nav-item'>    

            <div id="myDropdown" class="dropdown-content">
              <input type="text" autocomplete="off" class="form-control mr-sm-2 border border-white "  placeholder="Search.." id="myInput">
              <div id="search_jquery"></div>
               <?php

                include("search/search.php");

                ?>
            </div>
          
        </li>
        
        

      </ul>
      
      <!-- End navbar auto from left side -->

      <!-- Start navbar right side -->
      <ul class="navbar-nav ml-auto">


        <li class='nav-item'>
          <button type="submit" onclick="location.href = 'feed.php'" class="btn btn-primary border border-white rounded-pill" id="feed">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window" viewBox="0 0 16 16">
              <path d="M3 6.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v1H1V2a1 1 0 0 1 1-1h12zm1 3v10a1 1 0 0 1-1 1h-2V4h3zm-4 0v11H2a1 1 0 0 1-1-1V4h10z"/>
            </svg>
          Following Feeds</button>
        </li>



        <li class='nav-item'>
        <form id="profile_button_form" action="main_profile.php" method="POST">
          <input type="hidden" name="profile_username" id="profile_username" value="">
          <button type="submit" class="btn btn-primary border border-white rounded-pill" id="my_profile_button">
            <!-- Start Login icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
            <!-- End Login icon --> 
          My Profile</button>          
        </form>

        </li>

        <li class='nav-item'>
          <button type="submit" onclick="location.href = 'logout/logout.php'" class="btn btn-primary border border-white rounded-pill" id="sign_out">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z">
              </path>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z">
              </path>
            </svg>
          Sign Out</button>
        </li>



    </ul>
    <!-- End navbar right side -->
  </div>
  <!-- End Container div -->
</nav>
<!-- End Navbar -->

<?php 
    include("connect_db/connection.php");

  if (isset($_POST['crate_topic']))
  {

    $title = mysqli_real_escape_string($connection, $_POST['title']); 
    $type = mysqli_real_escape_string($connection, $_POST['entry_type']);
    $comment = mysqli_real_escape_string($connection, $_POST['comment']);
  

    $sql = "SELECT topic_name FROM topic";
    $result = mysqli_query($connection, $sql);
    $topic_names = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    $error = "false"; 

    if($title =="")
    {
      $error = "true"; 
      echo 
      '<script>
          Swal.fire({icon: "error",title: "Title can not be empty!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "main.php";}); 
      </script>';
    }

    foreach ($topic_names as $topic ) 
    {
      if($title == $topic['topic_name'])
      {
      $error = "true"; 
      echo 
      '<script>
          Swal.fire({icon: "error",title: "Title has already used!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "main.php";}); 
      </script>';
      break;
      }
    }
    
    if($error == "false")
    {
      $curr_user = $_SESSION["username"];
      date_default_timezone_set('Europe/Istanbul');
      $curr_date = date("Y.m.d H.i.s");
      $title = strtolower($title);

      $sql = "INSERT INTO topic(topic_name,topic_type,topic_creator_username,created_time) VALUES('$title', '$type', '$curr_user', '$curr_date')";
      $sql2 = "INSERT INTO comment(topic_name,comment_text,comment_like_num,comment_dislike_num,comment_date,comment_username) 
      VALUES('$title', '$comment', 0, 0, '$curr_date', '$curr_user')";

      if(mysqli_query($connection,$sql) && mysqli_query($connection,$sql2) )
      { 
        $topic_metaphone = metaphone($title);

        $sql = "INSERT INTO metaphone_topic(topic_name,topic_metaphone) VALUES('$title', '$topic_metaphone')";
        mysqli_query($connection,$sql);

        $sql = "INSERT INTO hot_topics(EMA,topic_title) VALUES(0,'$title')";
        mysqli_query($connection,$sql);

        $_POST['topic_title'] = $title;
      }
      else
      {
        echo 
        '<script>
            Swal.fire({icon: "error",title: "Something went wrong!",showConfirmButton: false,timer: 1500});
        </script>';
      }
    }
  }

?>



<script type="text/javascript">
    $("#back_to_main_navbar2").click(function(event) {
    $('#check_title').val("hot");
    $("#check_title_form").submit();  
  });

$(document).ready(function(){
  $("#myInput").keyup(function(){
     var input = $(this).val();
     $.post("search/search.php", {search: input}, 
      function(data,status)
      {
        $("#search_jquery").html(data);
      });
  });
});


  $(document).mouseup(function (e) {
      if ($(e.target).closest(".search_res").length === 0) {
          $(".search_res").hide();
      }
  });


  $(".search_res").hide();
</script>