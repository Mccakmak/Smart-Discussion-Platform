<?php  
  header('Content-Type: text/csv; charset=utf-8');  
  header('Content-Disposition: attachment; filename=public_html/matrixes/follower_matrix.csv'); 
  $output = fopen('public_html/matrixes/follower_matrix.csv', 'w'); 
  
  $users = unserialize(file_get_contents('public_html/matrixes/users.bin'));  

  fputcsv($output, $users);  
  
  $follower_matrix = unserialize(file_get_contents('public_html/matrixes/follower_matrix.bin'));  
  foreach($users as $user_row)
  {
  	 fputcsv($output, $follower_matrix[$user_row]);
  }  
    
  fclose($output);
?>