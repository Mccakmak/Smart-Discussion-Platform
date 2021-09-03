<?php 

ob_start();

$connection = mysqli_connect('localhost', 'admin', 'h3l8Ig1jUZTA', 'website');
	
//Follower Relationship Matrix

$follower_matrix = array();

// Gather all users from database

$sql = "SELECT username FROM user";
$result = mysqli_query($connection, $sql);
$user_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

// User array
$users = array();

foreach($user_list as $user)
{
	array_push($users, $user['username']);
}

// Filling follower matrix
foreach($users as $user_row)
{
	$sql = "SELECT following_user FROM user_follow WHERE username = '$user_row' ";
	$result = mysqli_query($connection, $sql);
	$user_follower_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$followers = array();
	foreach($user_follower_list as $user)
	{
		array_push($followers, $user['following_user']);
	}

	$follower_matrix[$user_row] = array();
    foreach($users as $user_col)
	{	
		// If same user
		if($user_row == $user_col)
		{
			$follower_matrix[$user_row][$user_col] = "1";
		}
		// If user follows the user
		elseif(in_array($user_col, $followers))
		{
			$follower_matrix[$user_row][$user_col] = "1";
		}
		// If user not follows the user
		else
		{
			$follower_matrix[$user_row][$user_col] = "0";
		}
    	
    }
}

// User-Topic Type Relationship Matrix

$user_topic_matrix = array();

// Gather all users from database

$sql = "SELECT DISTINCT topic_type FROM topic";
$result = mysqli_query($connection, $sql);
$topic_type_list = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Topic Types Array
$topic_types = array();
// Topic type => topic names array
$topic_dict = array();

foreach($topic_type_list as $topic)
{	
	$topic_type = $topic['topic_type'];
	$sql = "SELECT topic_name FROM topic WHERE topic_type = '$topic_type' ";
	$result = mysqli_query($connection, $sql);
	$topic_names = mysqli_fetch_all($result, MYSQLI_ASSOC);

	array_push($topic_types, $topic_type);

	$topic_dict[$topic_type] = array();
	foreach($topic_names as $topic_name)
	{
		array_push($topic_dict[$topic_type],$topic_name['topic_name']);
	}
}


// Filling user-topic matrix
foreach($users as $user)
{
	foreach($topic_types as $topic_type)
	{	
		$total_comment = 0;

		// topic type => all topic names
		foreach($topic_dict[$topic_type] as $topic_name)
		{
			$sql = "SELECT * FROM comment WHERE topic_name = '$topic_name' AND comment_username = '$user' ";
			$result = mysqli_query($connection, $sql);
			$comment_num = mysqli_num_rows($result);

			$total_comment = $total_comment + $comment_num;
		}
		// Add total comment to the matrix
		$user_topic_matrix[$user][$topic_type] = $total_comment;
	}
}


// Normalization
$normalized_user_topic_matrix = array();
$row_sum_array = array();
foreach($users as $user)
{
	$row_sum = 0;
	foreach($topic_types as $topic_type)
	{
		$row_sum = $row_sum + $user_topic_matrix[$user][$topic_type];
	}
	array_push($row_sum_array, $row_sum);
}

$i = 0;
foreach($users as $user)
{
	$normalized_user_topic_matrix[$user] = array();
	foreach($topic_types as $topic_type)
	{
		if(!$row_sum_array[$i]==0)
		{
			$normalized_user_topic_matrix[$user][$topic_type] = $user_topic_matrix[$user][$topic_type] / $row_sum_array[$i];
		}
		else
		{
			$normalized_user_topic_matrix[$user][$topic_type] = 0;
		}	
	}
	$i++;
}


$user_friend_total_comment_array = array();

foreach($topic_types as $topic_type)
{
	$user_friend_total_comment_array[$topic_type] = array();
	foreach($users as $user_row)
	{
		$user_friend_total_comment_array[$topic_type][$user_row] = array();
		$total_comment = 0;
		foreach($users as $user_col)
		{
			if($follower_matrix[$user_row][$user_col] == 1 && $user_row != $user_col)
			{
				$total_comment = $total_comment + $user_topic_matrix[$user_col][$topic_type];
			}
		}
		$user_friend_total_comment_array[$topic_type][$user_row] = $total_comment;
	}
}

$similarity = array();
foreach($topic_types as $topic_type)
{
	$similarity[$topic_type] = array();
	foreach($users as $user_row)
	{
		$similarity[$topic_type][$user_row] = array();
		foreach($users as $user_col)
		{
			$similarity[$topic_type][$user_row][$user_col] =  1- abs( $normalized_user_topic_matrix[$user_row][$topic_type] - $normalized_user_topic_matrix[$user_col][$topic_type]  ); 
		}

	}
}

$pt = array(); 

foreach($topic_types as $topic_type)
{
	$pt[$topic_type] = array();
	foreach($users as $user_row)
	{
		$pt[$topic_type][$user_row] = array();
		foreach($users as $user_col)
		{
			$pt[$topic_type][$user_row][$user_col] = array();
			// If same user influence 0
			if($user_row == $user_col)
			{
				$pt[$topic_type][$user_row][$user_col] = 0;
			}
			elseif($follower_matrix[$user_row][$user_col] == 1)
			{
				if($user_friend_total_comment_array[$topic_type][$user_row] != 0)
				{
					$left_pt = $user_topic_matrix[$user_col][$topic_type]/$user_friend_total_comment_array[$topic_type][$user_row];

					$right_pt = $similarity[$topic_type][$user_row][$user_col]; 

					$pt[$topic_type][$user_row][$user_col] = $left_pt * $right_pt;
				}
				else
				{
					$pt[$topic_type][$user_row][$user_col] = 0;
				}

			}
			else
			{
				$pt[$topic_type][$user_row][$user_col] = 0;
			}
		}
	}
}

// Rank matrix
$rank = array();
foreach($topic_types as $topic_type)
{
	$rank[$topic_type] = array();
	foreach($users as $user_col)
	{
		//$rank[$topic_type][$user_row] = array();
		$col_sum = 0;
		foreach($users as $user_row)
		{
			$col_sum = $col_sum + $pt[$topic_type][$user_row][$user_col]; 
			$col_sum = round($col_sum,2);
		}
		$rank[$topic_type][$user_col] = $col_sum;
	}
}




// Total Influence Rank Matrix
$total_inf_rank = array();
foreach($users as $user_col)
{
	$col_sum = 0;
	foreach($topic_types as $topic_type)
	{
		$col_sum = $col_sum + $rank[$topic_type][$user_col];
		$col_sum = round($col_sum,2);
	}
	$total_inf_rank[$user_col]=$col_sum;
}

$total_norm_inf_rank = array();
foreach($users as $user)
{
	$total_norm_inf_rank[$user]=($total_inf_rank[$user]/max($total_inf_rank))+1;
}







// Trust Matrix

$trust_matrix = array();


// Filling trust matrix
foreach($users as $user_row)
{
	$trust_matrix[$user_row] = array();

	foreach($users as $user_col)
	{
	    // If not follow the user
		if($follower_matrix[$user_row][$user_col] == 0)
		{
			$trust_matrix[$user_row][$user_col] = 0;
		}
		// If the same user
		elseif($user_col == $user_row)
		{
			$trust_matrix[$user_row][$user_col] = 0;
		}
		else
		{
			$sql = "SELECT * FROM liked_comment WHERE liked_username = '$user_row' AND comment_username = '$user_col' ";
			$result = mysqli_query($connection, $sql);
			$like_count = mysqli_num_rows($result);

			$sql = "SELECT * FROM disliked_comment WHERE disliked_username = '$user_row' AND comment_username = '$user_col' ";
			$result = mysqli_query($connection, $sql);
			$dislike_count = mysqli_num_rows($result);

			
			$var = $like_count - $dislike_count*0.25;
			if($var < 0 )
			{
				$trust_matrix[$user_row][$user_col] = 0;
			}
			else
			{
				$trust_matrix[$user_row][$user_col] = $var;
			}
			
		}
	}
}   


// Trust Normalization
$normalized_trust_matrix = array();
$row_sum_array = array();
foreach($users as $user_row)
{
	$row_sum = 0;
	foreach($users as $user_col)
	{
		$row_sum = $row_sum + $trust_matrix[$user_row][$user_col];
	}
	array_push($row_sum_array, $row_sum);
}


$i = 0;
foreach($users as $user_row)
{
	$normalized_trust_matrix[$user_row] = array();
	foreach($users as $user_col)
	{
		if(!$row_sum_array[$i]==0)
		{
			$normalized_trust_matrix[$user_row][$user_col] = ($trust_matrix[$user_row][$user_col] / $row_sum_array[$i])*$total_norm_inf_rank[$user_row];
		}
		else
		{
			$normalized_trust_matrix[$user_row][$user_col] = 0;
		}	
	}
	$i++;
}


// Total trust
$trust_rank = array();
foreach($users as $user_col)
{
	$col_sum = 0;
	foreach($users as $user_row)
	{
		$col_sum = $col_sum + $normalized_trust_matrix[$user_row][$user_col];
		$col_sum = round($col_sum,2);
	}
	$trust_rank[$user_col]=$col_sum;
}


 ?>

<!-- Show Follower Relationship Matrix -->

<h3>Follower Relationship Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user_row)
 		{?>
 			<tr>
 				<td> <?php echo $user_row ?></td>
 				<?php 

 				 	foreach($users as $user_col)
 					{?> 
 						<td style="text-align:center"><?php echo $follower_matrix[$user_row][$user_col]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>

 <hr>

 <!-- Show User-Topic Type Relationship Matrix -->
 <h3>User-Topic Type Relationship Matrix</h3>
 <table>
 	<tr>
 		<th>User/Topic</th>
 		<?php 

 			foreach($topic_types as $topic_type)
 			{?> 
 				<th><?php echo $topic_type; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user)
 		{?>
 			<tr>
 				<td> <?php echo $user ?></td>
 				<?php 

 				 	foreach($topic_types as $topic_type)
 					{?> 
 						<td style="text-align:center"><?php echo $user_topic_matrix[$user][$topic_type]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>

 <hr>

  <!-- Show Normalized User-Topic Type Relationship Matrix -->
<!--  <table>
 	<tr>
 		<th>User/Topic</th>
 		<?php 

 			foreach($topic_types as $topic_type)
 			{?> 
 				<th><?php echo $topic_type; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user)
 		{?>
 			<tr>
 				<td> <?php echo $user ?></td>
 				<?php 

 				 	foreach($topic_types as $topic_type)
 					{?> 
 						<td style="text-align:center"><?php echo $normalized_user_topic_matrix[$user][$topic_type]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>
 -->
   <!-- Show User Friend Comment for each topic Matrix -->
<!--  <table>
 	<tr>
 		<th>Topic/User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($topic_types as $topic_type)
 		{?>
 			<tr>
 				<td> <?php echo $topic_type ?></td>
 				<?php 

 				 	foreach($users as $user)
 					{?> 
 						<td style="text-align:center"><?php echo $user_friend_total_comment_array[$topic_type][$user]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table> -->

    <!-- Show Similarity Matrix -->
<h3>Similarity Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user_row)
 		{?>
 			<tr>
 				<td> <?php echo $user_row ?></td>
 				<?php 

 				 	foreach($users as $user_col)
 					{?> 
 						<td style="text-align:center"><?php echo $similarity['Economy'][$user_row][$user_col]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>

<hr>

     <!-- Show Pt Matrix -->

<!--  <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user_row)
 		{?>
 			<tr>
 				<td> <?php echo $user_row ?></td>
 				<?php 

 				 	foreach($users as $user_col)
 					{?> 
 						<td style="text-align:center"><?php echo $pt['Economy'][$user_row][$user_col]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>
 -->

   <!-- Show Topic Rank Relationship Matrix -->
   <h3>Rank Matrix</h3>
 <table>
 	<tr>
 		<th>User/Topic</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($topic_types as $topic_type)
 		{?>
 			<tr>
 				<td> <?php echo $topic_type ?></td>
 				<?php 

 				 	foreach($users as $user)
 					{?> 
 						<td style="text-align:center"><?php echo $rank[$topic_type][$user]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>



   <h3>Total Influence Rank Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 			<tr>
 				<td> <?php echo "Total Influence" ?></td>
 				<?php 

 				 	foreach($users as $user)
 					{?> 
 						<td style="text-align:center"><?php echo $total_inf_rank[$user]; ?></td>
 					<?php } ?>
 			</tr>
 </table>

   <h3>Normalized into 1-2 Total Influence Rank Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 			<tr>
 				<td> <?php echo "Total Influence" ?></td>
 				<?php 

 				 	foreach($users as $user)
 					{?> 
 						<td style="text-align:center"><?php echo $total_norm_inf_rank[$user]; ?></td>
 					<?php } ?>
 			</tr>
 </table>



   <!-- Show Trust Matrix Matrix -->
<h3>Trust Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user_row)
 		{?>
 			<tr>
 				<td> <?php echo $user_row ?></td>
 				<?php 

 				 	foreach($users as $user_col)
 					{?> 
 						<td style="text-align:center"><?php echo $trust_matrix[$user_row][$user_col]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>


   <!-- Show Normalized Trust Matrix Matrix -->
<h3>Normalized Trust Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 	<?php 

 		foreach($users as $user_row)
 		{?>
 			<tr>
 				<td> <?php echo $user_row ?></td>
 				<?php 

 				 	foreach($users as $user_col)
 					{?> 
 						<td style="text-align:center"><?php echo $normalized_trust_matrix[$user_row][$user_col]; ?></td>
 					<?php } ?>
 			</tr>
 		<?php } ?>

 </table>


 <hr>

     <!-- Show Total Trust Matrix -->

   <h3>Trust Rank Matrix</h3>
 <table>
 	<tr>
 		<th>User</th>
 		<?php 

 			foreach($users as $user)
 			{?> 
 				<th><?php echo $user; ?></th>	
 			<?php } ?>
 	</tr>

 			<tr>
 				<td> <?php echo "Score" ?></td>
 				<?php 

 				 	foreach($users as $user)
 					{?> 
 						<td style="text-align:center"><?php echo $trust_rank[$user]; ?></td>
 					<?php } ?>
 			</tr>
 </table>

<?php 

  file_put_contents('public_html/matrixes/users.bin', serialize($users));
  file_put_contents('public_html/matrixes/topic_types.bin', serialize($topic_types));
  file_put_contents('public_html/matrixes/follower_matrix.bin', serialize($follower_matrix));
  file_put_contents('public_html/matrixes/rank.bin', serialize($rank));
  file_put_contents('public_html/matrixes/total_inf_rank.bin', serialize($total_inf_rank));
  file_put_contents('public_html/matrixes/trust_rank.bin', serialize($trust_rank));

  
?>

