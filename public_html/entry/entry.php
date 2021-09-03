	<?php 
    $per_page_row = 8;	

    // Comment like, dislike	
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

	    			$sql2 = "SELECT comment_dislike_num FROM comment WHERE topic_name = '$title'AND comment_date ='$date' AND comment_username = '$username' ";

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
		    		$sql = "INSERT INTO interval_like(topic_title,comment_text,comment_username,comment_date,liked_username) VALUES('$title','$text','$username','$date', '$liked_username')";
		    		mysqli_query($connection,$sql);

			    	$sql2 = "SELECT comment_like_num FROM comment WHERE topic_name = '$title' AND comment_date ='$date'
			    	AND comment_username = '$username' ";

			    	$result = mysqli_query($connection, $sql2);
				    $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

				    $comment_like_num = $comment['comment_like_num'];

				    $comment_like_num = $comment_like_num + 1;

			    	$sql3 = "UPDATE comment SET comment_like_num = '$comment_like_num' WHERE topic_name = '$title' AND comment_date ='$date' AND comment_username = '$username'";
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

	    			$sql2 = "SELECT comment_like_num FROM comment WHERE topic_name = '$title' AND comment_date ='$date' AND comment_username = '$username' ";

		    		$result = mysqli_query($connection, $sql2);
			    	$comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

	    			$comment_like_num = $comment['comment_like_num'];

				    $comment_like_num = $comment_like_num - 1;

			    	$sql3 = "UPDATE comment SET comment_like_num = '$comment_like_num' WHERE topic_name = '$title' AND comment_date ='$date' AND comment_username = '$username'";
			    	mysqli_query($connection, $sql3);				    
			    }	    		



		    	$sql = "INSERT INTO disliked_comment(topic_name,comment_text,comment_username,comment_date,disliked_username) 
		    	VALUES('$title','$text','$username','$date', '$disliked_username')";

		    	if(mysqli_query($connection,$sql))
		    	{

		    		$sql = "INSERT INTO interval_dislike(topic_title,comment_text,comment_username,comment_date,disliked_username) VALUES('$title','$text','$username','$date', '$disliked_username')";
		    		mysqli_query($connection,$sql);		    		

			    	$sql2 = "SELECT comment_dislike_num FROM comment WHERE topic_name = '$title' AND comment_date ='$date' AND comment_username = '$username' ";

			    	$result = mysqli_query($connection, $sql2);
				    $comment = mysqli_fetch_array($result, MYSQLI_ASSOC);

				    $comment_dislike_num = $comment['comment_dislike_num'];

				    $comment_dislike_num = $comment_dislike_num + 1;

			    	$sql3 = "UPDATE comment SET comment_dislike_num = '$comment_dislike_num' WHERE topic_name = '$title' AND comment_date ='$date' AND comment_username = '$username'";
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
	
	// Add comment

    if(isset($_POST['user_comment']))
    {
    	if($_POST['user_comment']!='')
    	{
			$topic_name = $_SESSION["topic_title"];
	        $comment =$_POST['user_comment'];   
	        date_default_timezone_set('Europe/Istanbul');
	        $curr_date = date("Y.m.d H.i.s");
	        $username = $_SESSION['username'];

	        $sql = "INSERT INTO comment(topic_name,comment_text,comment_like_num,comment_dislike_num,comment_date,comment_username) 
	        VALUES('$topic_name','$comment', 0, 0, '$curr_date', '$username')";

	        
	        if(mysqli_query($connection,$sql))
	        {   

			$sql = "INSERT INTO interval_comment(topic_title,comment_text,comment_date,comment_username) VALUES('$topic_name','$comment', '$curr_date', '$username')";
			mysqli_query($connection,$sql);

	            $_POST['topic_title'] = $topic_name;
	        	if($_SESSION['final_page_row'] == $per_page_row)
	        	{
	        		$_POST["page"] = $_SESSION['final_page'] + 1;
	        	}
	        	else 
	        	{
	        		$_POST["page"] = $_SESSION['final_page'];
	        	}

	        		$sql = "SELECT * FROM feedback";
					$result = mysqli_query($connection, $sql);
					$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

					$user_found = 'false';
					foreach($users as $user)
					{
						if($username == $user['username'])
						{
							$user_found = 'true';
						}
					}

					if($user_found == 'false')
					{?>
						<input type="hidden" name="show_survey" id="show_survey" value="true">
					<?php

				    }

	        	echo 
	            '<script>
	              Swal.fire({icon: "success",title: "Comment has been added!",showConfirmButton: false,timer: 1000});
	            </script>';	

	        	
	        }
	        else
	        {
	            echo 
	            '<script>
	              Swal.fire({icon: "error",title: "Something went wrong!",showConfirmButton: false,timer: 1500});
	            </script>';
	        }
    	}
    	else
    	{
    			echo 
	            '<script>
	              Swal.fire({icon: "error",title: "Comment can not be empty!",showConfirmButton: false,timer: 1000});
	            </script>';
    	}
        
     
    }
 ?>




	<?php 
		
		if(isset($_POST['topic_title']))
		{ 
			if($_SESSION['hot_topic'] != "Hot topics")
			{
				$_SESSION['topic_type_active'] = "true";
			}
			else
			{
				$_SESSION['topic_type_active'] = "false";
			}
			
			$_SESSION['active_page'] = 1;
			$_SESSION["topic_title"] = $_POST['topic_title'];
	 
			$topic_name = $_POST['topic_title'];
			$sql = "SELECT * FROM comment WHERE topic_name = '$topic_name' ORDER BY comment_date ASC ";
        	$result = mysqli_query($connection, $sql);
        	$comment_infos = mysqli_fetch_all($result, MYSQLI_ASSOC);

			$total_row = count($comment_infos);
			
			$_SESSION["total_row"] = $total_row;
			$_SESSION["comment_infos"] = $comment_infos;

			if(fmod($total_row,$per_page_row)!=0)
			{
				$final_page = intval(($total_row/$per_page_row))+1;
				$final_page_row = fmod($total_row,$per_page_row);
				$_SESSION['final_page'] = $final_page;
				$_SESSION['final_page_row'] = $final_page_row;
			}
			else
			{
				$final_page = $total_row/$per_page_row;
				$final_page_row = $per_page_row;
				$_SESSION['final_page'] = $final_page;
				$_SESSION['final_page_row'] = $final_page_row;
			}

			// GET IP OF THE USER
			include "click/click.php";
			$user_ip = getUserIP();
			$sql = "INSERT INTO user_click(user_ip,topic_title) VALUES('$user_ip', '$topic_name')";

	    	mysqli_query($connection,$sql);



	    	$sql = "INSERT INTO total_user_click(user_ip,topic_title) VALUES('$user_ip', '$topic_name')";

	    	mysqli_query($connection,$sql);

		}
		// Random topic
		elseif(!isset($_POST["page"]) && !isset($_POST['user_comment']) && !isset($_POST['comment_form']))       
		{
			if($_SESSION['hot_topic'] != "Hot topics")
			{
				$_SESSION['topic_type_active'] = "true";
			}
			else
			{
				$_SESSION['topic_type_active'] = "false";
			}

			$_SESSION['active_page'] = 1;

			if(isset($_POST['topic_type']) || (isset($_SESSION['hot_topic']) && $_SESSION['hot_topic'] != "Hot topics") )
			{
				if(isset($_POST['topic_type']))
				{
					$topic_type = $_POST['topic_type'];
				}
				else
				{
					$topic_type = $_SESSION['hot_topic'];
				}
				$sql = "SELECT topic_name FROM topic WHERE topic_type='$topic_type' ";
			}
			else
			{
				$sql = "SELECT topic_name FROM topic ";
			}

        	$result = mysqli_query($connection, $sql);
        	$topic_names = mysqli_fetch_all($result, MYSQLI_ASSOC);

			$total_row = count($topic_names);

			if($total_row != 0)
			{
				$random_topic_name_num = rand(0,($total_row-1));
				$random_topic_name = $topic_names[$random_topic_name_num];
				$topic_name = $random_topic_name["topic_name"];
				$_SESSION["topic_title"] = $topic_name; 
				$sql = "SELECT * FROM comment WHERE topic_name = '$topic_name' ORDER BY comment_date ASC ";
	        	$result = mysqli_query($connection, $sql);
	        	$comment_infos = mysqli_fetch_all($result, MYSQLI_ASSOC);

	        	$total_row = count($comment_infos);

	        	$_SESSION["comment_infos"] = $comment_infos;
	        	$_SESSION['total_row'] = $total_row;

				if(fmod($total_row,$per_page_row)!=0)
				{
					$final_page = intval(($total_row/$per_page_row))+1;
					$final_page_row = fmod($total_row,$per_page_row);
					$_SESSION['final_page'] = $final_page;
					$_SESSION['final_page_row'] = $final_page_row;
				}
				else
				{
					$final_page = $total_row/$per_page_row;
					$final_page_row = $per_page_row;
					$_SESSION['final_page'] = $final_page;
					$_SESSION['final_page_row'] = $final_page_row;				
				}	
			}
			else // empty topic type
			{

			}

			
		}


	 ?>

	<div id="entry" class=" DivToScroll DivWithScroll">
	<h2 id="big_topic_title"><?php echo htmlspecialchars($_SESSION["topic_title"]); ?></h2>

	<form id="page_nums_form_copy"></form>

	<div id="comment_box">
	
		<?php 
	    if(isset($_POST["page"]))
	    {	
	    	$_SESSION['active_page'] = $_POST['page'];

	        $start_row = $per_page_row*($_POST["page"]-1);
	        $end_row = $per_page_row * $_POST["page"]-1;

	        if($_POST["page"] == $_SESSION['final_page'])
	        {
	            $end_row = $start_row + $_SESSION['final_page_row'] - 1;
	        }
	        elseif ($_SESSION['total_row']==0) {
	            $end_row = -1;
	        }

	        $_SESSION['row_no'] = 0;

	       	?> <form name="profile_link_form" method="POST" action="main_profile.php">
    				<input type="hidden" name="profile_name" id="profile_name" value="">
			   </form>
			<?php 

	        for($row = $start_row ; $row <= $end_row; $row++)
	        {
	            $info=$_SESSION["comment_infos"][$row];

	            include "entry_box/entry_box.php";
	            $_SESSION['row_no'] = $_SESSION['row_no'] + 1;
	        }

	    }
	    // First page
		else
		{
			$start_row = 0;
			$end_row = $per_page_row-1;
			if($_SESSION['final_page'] == 1)
			{
				$end_row = $_SESSION['final_page_row'] -1;
			}
			elseif ($_SESSION['total_row'] == 0) {
				$end_row = -1;
			}

	        ?> <form name="profile_link_form" method="POST" action="main_profile.php">
    				<input type="hidden" name="profile_name" id="profile_name" value="">
			   </form>
			<?php

			$_SESSION['row_no'] = 0;
			for($row = $start_row ; $row <= $end_row; $row++)
			{	
	            $info=$_SESSION["comment_infos"][$row];
	            include "entry_box/entry_box.php";
	            $_SESSION['row_no'] = $_SESSION['row_no'] + 1;
			}
		
		}

		?>	
	</div>


	<form  id="page_nums_form_orig" method="POST" action="main.php">
		<div id="page_div">
		<label id="page_label" for="page" >Page:</label>	
		<select onchange="this.form.submit();" class="custom-select" id="page" name="page">
			<?php 

				if ($_SESSION['total_row'] == 0) 
				{?>
					<option value="<?php echo("1"); ?>"> <?php echo("1");?> </option>
				<?php }			
				for($row=1; $row <= $_SESSION['final_page']; $row++)
				{

					if($_SESSION['active_page'] == $row)
					{
						?> 
						<option selected value="<?php echo($row); ?>"> <?php echo($row);?> </option>
					<?php } 
					else
					{?>
						<option value="<?php echo($row); ?>"> <?php echo($row);?> </option>
					<?php }
					
				 } 
				  ?>
		</select>	
		</div>
	
	</form>

	<?php 


		if(isset($_SESSION["username"]))
        {        
       		include "add_comment/add_comment.php"; 
        }	

	 ?>

</div>


<script type="text/javascript">	

	// 2 page scroll
  	var form = document.getElementById("page_nums_form_orig");
  	var copy = form.cloneNode(true);
  	document.getElementById("page_nums_form_copy").appendChild(copy);

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

	$(document).ready(function() {
	    $("#comment_box .like_button svg").click(function(event) {
	    	var form_id = $(this).closest('form').attr("id");

	    	form_id = '#' + form_id;

	    	var title = document.getElementById('big_topic_title').textContent;
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
	    $("#comment_box .dislike_button svg").click(function(event) {
	    	var form_id = $(this).closest('form').attr("id");

	    	form_id = '#' + form_id;

	    	var title = document.getElementById('big_topic_title').textContent;
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
