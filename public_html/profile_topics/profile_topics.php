<?php 
    $sql2 = "SELECT * FROM topic WHERE topic_creator_username = '$profil_username' ";

    $result = mysqli_query($connection, $sql2);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="DivToScroll DivWithScroll" id="profile_topics_style">
    <div class="limiter">
      <div class="container-table100">
        <div class="wrap-table100">
            <div class="table">

              <div class="row header">
                <div class="cell">
                  Topic Name
                </div>
                <div class="cell">
                  Topic Category
                </div>
                <div class="cell">
                  Created Time
                </div>
              </div>
              
              <?php  
              
              $row = 0;
              foreach ($topics as $topic) {
              ?>
              <div class="row">
                <div id="profile_topic_div_<?php echo htmlspecialchars($row); ?>" class="profile_topic_div cell" data-title="Topic Name">
                  <p>
                  <?php 
                    echo htmlspecialchars($topic['topic_name']);
                    $row = $row + 1;
                  ?>
                  </p>
                </div>
                <div class="cell" data-title="Topic Category">
                  <?php echo htmlspecialchars($topic['topic_type']);?>
                </div>
                <div class="cell" data-title="Created Time">
                  <?php echo htmlspecialchars($topic['created_time']);?>
                </div>
              </div>
              <?php  } ?>
            </div>
        </div>
      </div>
  </div>
</div>





<script type="text/javascript">
  $('.profile_topic_div p').click(function(event)
  { 
    var form_title_id = $(this).closest('.profile_topic_div').attr('id');
    form_title_id = '#' + form_title_id;

    var title = $(form_title_id + ' p').text();
    title = title.trim();
    document.profile_title_form.topic_title.value = title
    document.profile_title_form.submit();
  });
</script>


