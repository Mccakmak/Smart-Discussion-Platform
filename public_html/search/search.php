<?php 
  session_start();
 ?>

<?php 
    
    if(file_exists("../connect_db/connection.php"))
    {
        
      include ("../connect_db/connection.php");
        
    }
    else
    {
      include ("connect_db/connection.php");
    
    }

  if(isset($_POST['search']))
  {
    $input=$_POST['search'];
    
    $input_metaphone = metaphone($input);

    if($input_metaphone != "")
    {

        $sql = "SELECT * FROM metaphone_topic ";
        $result = mysqli_query($connection, $sql);
        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        
         
        $similar_topic_names = array();
        foreach ($topics as $topic) 
        {
          if (strpos($topic['topic_metaphone'], $input_metaphone) !== false) {
              array_push($similar_topic_names,$topic['topic_name']);
          }

        }

        $sql = "SELECT * FROM metaphone_user";
        $result = mysqli_query($connection, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $similar_user_names = array();
        foreach ($users as $user) 
        {
          if (strpos($user['user_metaphone'], $input_metaphone) !== false)
          {
            $user['username'] ="@" . $user['username'];
            array_push($similar_user_names,$user['username']);
          }
           
           
        }

        $similar_names = array_merge($similar_topic_names, $similar_user_names);

        $_SESSION['sim_names'] = $similar_names;
    }
    else
    {
      $_SESSION['sim_names'] = null;
    }
  }     
?>            

<?php 

  if(!empty($_SESSION['sim_names']))
  {
    $names = $_SESSION['sim_names'];
    $no = 0;

    ?>

    <?php 
    foreach($names as $name)
    {?>
      <a style="cursor:pointer;" id="search_res_<?php echo(htmlspecialchars($no))?>" class="search_res">
        <?php echo htmlspecialchars($name);  ?>
      </a> 
                        
    <?php $no=$no+1;  }
    
    ?> 
    <?php 
  }
  else
  {?>
    <a  class="search_res">
      <?php echo htmlspecialchars("No result");  ?>
    </a>
  <?php } 
 ?>


    <?php
      $check_user_login = '';
      if(isset($_SESSION['username']))
      {
        $check_user_login = 'true';
      }
      else
      {
        $check_user_login = 'false';
      }
    ?>

<script type="text/javascript">
  $("#search_jquery a").click(function(event) {
    var search_name = $(event.target).text();
    //search_name = search_name.replace(/\s/g, ''); //remove space
    search_name = search_name.trim();               // remove space not between only beginning and end
    document.search_name_form.search_name.value = search_name;

    if(search_name.charAt(0) == '@' )
    { 
      var username = '<?php echo $check_user_login; ?>';
      if(username == 'false')
      {
         Swal.fire({icon: "error",title: "Please login first to see the profiles!",showConfirmButton: false,timer: 1000});
      }
      else
      {
        $("#search_name_form").attr("action","main_profile.php");
        document.forms["search_name_form"].submit();
      }
    }
    else if(search_name == 'No result')
    {
        
    }
    else
    {
      $("#search_name_form").attr("action","main.php");
      document.forms["search_name_form"].submit();
    }
    
  });

  $("#myInput").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
</script>

<?php 
  
  if(isset($_POST['search_name']))
  {
    if(substr($_POST['search_name'], 0,1) == "@" )
    {
       $user = ltrim($_POST['search_name'], '@');
       $_POST['profile_name'] = $user;
    }
    else
    {
      $_POST['topic_title'] = $_POST['search_name'];
    }  
  }

 ?>

