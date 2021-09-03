<?php  
  $connection = mysqli_connect('localhost', 'admin', 'h3l8Ig1jUZTA', 'website');
  header('Content-Type: text/csv; charset=utf-8');  
  header('Content-Disposition: attachment; filename=public_html/matrixes/comments.csv'); 
  $output = fopen('public_html/matrixes/comments.csv', 'w'); 
  fputcsv($output, array('topic_name', 'comment_text', 'comment_like_num', 'comment_dislike_num', 'comment_date', 'comment_username'));  
  $query = "SELECT * FROM comment ORDER BY comment_date DESC ";  
  $result = mysqli_query($connection, $query);  
  while($row = mysqli_fetch_assoc($result))  
  {  
       fputcsv($output, $row);  
  }  
  fclose($output);  
?>  