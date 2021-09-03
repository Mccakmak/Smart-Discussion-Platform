<div id="hot_topics" class=" DivToScroll DivWithScroll">

	  <?php 


	    if(isset($_POST['check_title']))
	    {
	    	$_SESSION['hot_topic'] = "Hot topics";
	    	$_SESSION['topic_type_active'] = "false";
	    }



	  	if(empty($connection) || (!mysqli_ping($connection)))
	  	{
	  		include("connect_db/connection.php");
	  	}

	    $sql = "";

	    if(isset($_POST['topic_type']) || (isset($_SESSION['hot_topic']) && $_SESSION['hot_topic'] != "Hot topics") || (isset($_SESSION['topic_type_active']) && $_SESSION['topic_type_active'] == "true"))
	    {	
	    	$topic_type ="";
	    	if(isset($_POST['topic_type']))
	    	{
				$topic_type = $_POST['topic_type'];
				$_SESSION['hot_topic'] = $topic_type;
	    	}
	    	else
	    	{
	    		$topic_type = $_SESSION['hot_topic'];
	    	}
	    	
	    	
	    ?>	<h4 id="hot_topics_header"><?php echo htmlspecialchars($topic_type) ?></h4>
	    <?php


	    	$sql = "SELECT topic_title FROM hot_topics INNER JOIN topic ON hot_topics.topic_title = topic.topic_name WHERE topic_type = '$topic_type' ORDER BY EMA DESC";

	    	//$sql = "SELECT topic_name FROM topic WHERE topic_type='$topic_type' ";
	    }
	    else
	    {?>
	    	<h4 id="hot_topics_header">Hot topics</h4> 
	    <?php
	    	$_SESSION['hot_topic'] = 'Hot topics';
	     	
	    	$sql = "SELECT topic_title FROM hot_topics ORDER BY EMA DESC";
	    }

	    $result = mysqli_query($connection, $sql);
	    $topic_names = mysqli_fetch_all($result, MYSQLI_ASSOC);
	  	?>

	  	<form id="hot_topics_form" name="hot_topics_form" action="main.php" method="POST">
	  		<input type="hidden" name="topic_title" id="topic_title" value="">
		  	<?php  
		    foreach ($topic_names as $topic ) 
		    { 

		    	$topic_name = $topic['topic_title'];

		    	$sql = "SELECT * FROM comment WHERE topic_name = '$topic_name' ";
		    	$result = mysqli_query($connection, $sql);
	    		$comment_no = mysqli_num_rows($result);

		   	?>
		    	
		    	<div class="row">
		    		<div class="col">
		    			<p style="cursor:pointer;" id="topics"><?php echo htmlspecialchars($topic["topic_title"]) ?></p>
		    		</div>
		    		<div class="col2">
		    			<p style="color: #999"><?php echo $comment_no ?></p>
		    		</div>
		    	</div>
		    <?php } 

		    ?>	  		
	  	</form>

</div>

<script type="text/javascript">

	$("#hot_topics p").click(function(event) {
    var title = $(event.target).text();
    document.hot_topics_form.topic_title.value = title;
    document.forms["hot_topics_form"].submit();
	});

	$("#topic_types #topic_dropdown a").click(function(event) {
    var topic_type = $(event.target).text();
    document.getElementById('hot_topics_header').innerHTML = topic_type;
    document.topic_type_form.topic_type.value = topic_type;
    document.forms["topic_type_form"].submit();
	});



</script>
