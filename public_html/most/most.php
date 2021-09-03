<div id="most" class="DivToScroll DivWithScroll">

      <form id= "most_link_form" name="most_link_form" method="POST">
        <input type="hidden" name="profile_name" value="">
      </form>

    <?php 

    $topic = $_SESSION["topic_title"];

    $sql = "SELECT * FROM comment WHERE topic_name = '$topic' AND comment_like_num = ( SELECT MAX(comment_like_num) FROM comment WHERE topic_name = '$topic' ) HAVING comment_like_num > 0 ORDER BY comment_date DESC ";


    $result = mysqli_query($connection, $sql);
    $comments_like = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(!empty($comments_like))
    {
        $comment_like = $comments_like[0]  // take most recent comment
        ?>
        <h4 id="most_like_header">Most Liked Comment</h4>
        <hr class="hr-primary">  
        <div id="most_like">
            <div class="row"><p><?php echo(htmlspecialchars('Topic: '.$comment_like['topic_name'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Like count: '.$comment_like['comment_like_num'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Date: '.$comment_like['comment_date'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Comment: '.$comment_like['comment_text'])) ?></p> </div>
            
            <?php 

                if(isset($_SESSION['username']))
                {?>
                    <div id="most_user_link">
                        <div class="row">
                            <label for="most_user_text">User:&nbsp</label>
                            <p id="most_user_text"><?php echo(htmlspecialchars('@'.$comment_like['comment_username'])) ?></p>
                        </div>
                    </div>
               <?php } 
                else
                {?>
            <div id="most_user_link_nologin">
                <div class="row">
                    <label for="most_user_text">User:&nbsp</label>
                    <p id="most_user_text"><?php echo(htmlspecialchars('@'.$comment_like['comment_username'])) ?></p> 
                </div>
            </div>
                <?php } ?>


            
        </div>
        <hr class="hr-primary">  
    <?php } 
    else
    {?>
        <h4 id="most_like_header">Most Liked Comment</h4>
        <hr class="hr-primary">  
        <div id="most_like">
            <div class="row"><p><?php echo(htmlspecialchars('No one liked a comment so far!')) ?></p> </div>
        </div>
        <hr class="hr-primary">  
    <?php } ?>


    <?php 

        $sql = "SELECT * FROM comment WHERE topic_name = '$topic' AND comment_dislike_num = ( SELECT MAX(comment_dislike_num) FROM comment WHERE topic_name = '$topic' ) HAVING comment_dislike_num > 0 ORDER BY comment_date DESC ";


        $result = mysqli_query($connection, $sql);
        $comments_dislike = mysqli_fetch_all($result, MYSQLI_ASSOC);


    if(!empty($comments_dislike))
    {
        $comment_dislike = $comments_dislike[0]  // take most recent comment
        ?>
        <h4 id="most_dislike_header">Most Disliked Comment</h4>
        <hr class="hr-danger">  
        <div id="most_like">
            <div class="row"><p><?php echo(htmlspecialchars('Topic: '.$comment_dislike['topic_name'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Dislike count: '.$comment_dislike['comment_dislike_num'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Date: '.$comment_dislike['comment_date'])) ?></p> </div>
            <div class="row"><p><?php echo(htmlspecialchars('Comment: '.$comment_dislike['comment_text'])) ?></p> </div>
            
            <?php 

                if(isset($_SESSION['username']))
                {?>
                    <div id="most_user_link">
                        <div class="row">
                            <label for="most_user_text">User:&nbsp</label>
                            <p id="most_user_text"><?php echo(htmlspecialchars('@'.$comment_dislike['comment_username'])) ?></p>
                        </div>
                    </div>
               <?php } 
                else
                {?>
            <div id="most_user_link_nologin">
                <div class="row">
                    <label for="most_user_text">User:&nbsp</label>
                    <p id="most_user_text"><?php echo(htmlspecialchars('@'.$comment_dislike['comment_username'])) ?></p> 
                </div>
            </div>
                <?php } ?>
            
        </div>
        <hr class="hr-danger">  
    <?php } 
    else
    {?>
        <h4 id="most_dislike_header">Most Disliked Comment</h4>
        <hr class="hr-danger">  
        <div id="most_like">
            <div class="row"><p><?php echo(htmlspecialchars('No one disliked a comment so far!')) ?></p> </div>
        </div>
        <hr class="hr-danger">  
    <?php } ?>


</div>

<script type="text/javascript">
    $("#most_user_link p").click(function(event) {
    var profile_username = $(event.target).text();
    //search_name = search_name.replace(/\s/g, ''); //remove space
    profile_username = profile_username.trim();               // remove space not between only beginning and end
    profile_username = profile_username.substring(1);
    document.most_link_form.profile_name.value = profile_username;
    

    $("#most_link_form").attr("action","main_profile.php");
    document.forms["most_link_form"].submit();
  });

    $("#most_user_link_nologin p").click(function(event) {
        Swal.fire({icon: "error",title: "Please login first to see the profiles!",showConfirmButton: false,timer: 1500});
    });

</script>