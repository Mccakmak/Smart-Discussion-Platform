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

			    if($comment_num != 0)		// has already disliked that comment
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

			    if($comment_num != 0)		// has already liked that comment
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

 		$username = $_SESSION['username'];

		$sql = "SELECT * FROM user_follow WHERE username = '$username' ";
	
    	$result = mysqli_query($connection, $sql);
	    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	    $following_user = array();

	    foreach($users as $user)
	    {
	    	array_push($following_user,$user['following_user']);
	    }
  
	    $sql = "SELECT * FROM comment  WHERE comment_username IN ('" . implode("','", $following_user) . "') ORDER BY comment_date DESC" ;

	    $result = mysqli_query($connection, $sql);
	    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

 	 ?>

 	 <div class=" DivToScroll DivWithScroll">
        <form name="profile_link_form" method="POST" action="main_profile.php">
    				<input type="hidden" name="profile_name" id="profile_name" value="">
		</form>

		<form name="feed_title_form" method="POST" action="main.php">
    				<input type="hidden" name="topic_title" id="topic_title" value="">
		</form>
      <?php
      	  $_SESSION['row_no'] = 0; 
	      foreach ($comments as $info) {
	      ?>
	      
	      <div class="feed_comment" id="feed_comment_box_<?php echo htmlspecialchars($_SESSION['row_no']) ?>">
	      	<h4 style="cursor:pointer; "><?php echo htmlspecialchars($info['topic_name']); ?></h4>
		      <?php

		      include "entry_box/entry_box.php";
		      $_SESSION['row_no'] = $_SESSION['row_no'] + 1;
		      ?> 
		  </div>
		   <?php  } ?>
      </div>            



<script type="text/javascript">	

	$('.feed_comment h4').click(function(event)
	{	
		var form_title_id = $(this).closest('.feed_comment').attr('id');
		form_title_id = '#' + form_title_id;

		var title = $(form_title_id + ' h4').text();

		document.feed_title_form.topic_title.value = title
		document.feed_title_form.submit();
	});


    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	$(document).ready(function() {
	    $(".like_button svg").click(function(event) {

	    	var form_title_id = $(this).closest('.feed_comment').attr('id');
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
	    $(" .dislike_button svg").click(function(event) {

	    	var form_title_id = $(this).closest('.feed_comment').attr('id');
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


