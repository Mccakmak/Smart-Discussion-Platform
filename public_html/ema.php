<?php 

include 'connect_db/connection.php';


$sql = "SELECT * FROM hot_topics";

$result = mysqli_query($connection, $sql);
$topic_num = mysqli_num_rows($result);

$sql = "SELECT topic_name FROM topic";
$result = mysqli_query($connection, $sql);
$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

// If hot topics database is empty
	
if($topic_num == 0)
{
	// For all topics create EMA query in hot topics database with 0 EMA value
    foreach($topics as $topic)
    {
    	$topic_title = $topic['topic_name'];
    	$sql = "INSERT INTO hot_topics(EMA,topic_title) VALUES(0,'$topic_title')";
		mysqli_query($connection,$sql);
    }
}



// alpha
$alpha = 0.125;

// Pt

$click_weight = 0.2;
$like_weight =  0.3;
$comment_weight = 0.5;


foreach($topics as $topic)
{
	$topic_title = $topic['topic_name'];

	// Get Current Click number for each topic
	$sql = "SELECT * FROM user_click WHERE topic_title = '$topic_title'";
	$result = mysqli_query($connection, $sql);
	$click_num = 0;
	
	if(mysqli_num_rows($result) > 0)
	{
		$click_num = mysqli_num_rows($result);
	}

	// Get Current Like number for each topic
	$sql = "SELECT * FROM interval_like WHERE topic_title = '$topic_title'";
	$result = mysqli_query($connection, $sql);
	$like_num = 0;
	
	if(mysqli_num_rows($result) > 0)
	{
		$like_num = mysqli_num_rows($result);
	}

	// Get Current Dislike number for each topic
	$sql = "SELECT * FROM interval_dislike WHERE topic_title = '$topic_title'";
	$result = mysqli_query($connection, $sql);
	$dislike_num = 0;

	if(mysqli_num_rows($result) > 0)
	{
		$dislike_num = mysqli_num_rows($result);
	}

	// Get Current Comment number for each topic
	$sql = "SELECT * FROM interval_comment WHERE topic_title = '$topic_title'";
	$result = mysqli_query($connection, $sql);
	$comment_num = 0;

	if(mysqli_num_rows($result) > 0)
	{
		$comment_num = mysqli_num_rows($result);
	}

	// Calculate Pt

	$pt = $click_num * $click_weight + ($like_num + $dislike_num) * $like_weight  + $comment_num * $comment_weight;

	// past_EMA

	// Take past_EMA values from hot topics database for all the topics

	$sql = "SELECT * FROM hot_topics WHERE topic_title = '$topic_title'";
	$result = mysqli_query($connection, $sql);
	$hot_topic_ema = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$past_EMA = $hot_topic_ema['EMA'];


	// current_EMA

	$current_EMA = $pt * $alpha + $past_EMA * (1-$alpha);

	$sql = "UPDATE hot_topics SET EMA = '$current_EMA' WHERE topic_title = '$topic_title'";
	mysqli_query($connection, $sql);

	date_default_timezone_set('Europe/Istanbul');
    $curr_date = date("Y.m.d H.i.s");

   	$sql = "INSERT INTO trend(topic_title,ema,trend_date) VALUES('$topic_title', '$current_EMA', '$curr_date')";
	mysqli_query($connection,$sql);
}

// Empty Current Click

$sql = "DELETE FROM user_click";
mysqli_query($connection, $sql);

// Empty Current Like

$sql = "DELETE FROM interval_like";
mysqli_query($connection, $sql);

// Empty Current Disike

$sql = "DELETE FROM interval_dislike";
mysqli_query($connection, $sql);

// Empty Current Comment

$sql = "DELETE FROM interval_comment";
mysqli_query($connection, $sql);

 ?>
 