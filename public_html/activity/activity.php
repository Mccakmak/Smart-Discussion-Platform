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

    $sql = "SELECT * FROM topic  WHERE topic_creator_username IN ('" . implode("','", $following_user) . "') ORDER BY created_time DESC" ;

    $result = mysqli_query($connection, $sql);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);


 ?>


<div id="activity_topic" class=" DivToScroll DivWithScroll">

	  <form id= "activity_link_form" name="activity_link_form" method="POST">
        <input type="hidden" name="profile_name" value="">
      </form>

      <form name="activity_title_form" method="POST" action="main.php">
        <input type="hidden" name="topic_title" id="topic_title" value="">
	  </form>
	

		<h4> Topic Activity List </h4>
	<?php 

		foreach($topics as $topic)
		{?>
			<div id="activity_title_link">
				<div class="row">
					<label >Topic:&nbsp</label>
					<p><?php echo(htmlspecialchars($topic['topic_name'])) ?></p> 
				</div>
			</div>


			<div id="activity_user_link">
				<div class="row">
					<label for="most_user_text">User:&nbsp</label>
					<p id="most_user_text"><?php echo(htmlspecialchars('@'.$topic['topic_creator_username'])) ?></p> 
				</div>
			</div>

				
			
			<hr class="hr-primary">
		<?php  }?>
	
</div>

<script type="text/javascript">
	$("#activity_user_link p").click(function(event) {
    var profile_username = $(event.target).text();
    //search_name = search_name.replace(/\s/g, ''); //remove space
    profile_username = profile_username.trim();               // remove space not between only beginning and end
    profile_username = profile_username.substring(1);
    document.activity_link_form.profile_name.value = profile_username;
    
    $("#activity_link_form").attr("action","main_profile.php");
    document.forms["activity_link_form"].submit();
  });

	
	$('#activity_title_link p').click(function(event)
	{ 
		var title = $(event.target).text();
		title = title.trim();

		document.activity_title_form.topic_title.value = title
		document.activity_title_form.submit();
	});

</script>