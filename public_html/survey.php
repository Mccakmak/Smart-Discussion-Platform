<!DOCTYPE html>
<html>
<head>

    <title></title>
</head>
<body>
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.0.7/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

     
    <script src="libraries/star-rating.js" type="text/javascript"></script>

</body>
</html>


<div class="modal fade" id="feedback_modal" role="dialog">
    <div class="modal-dialog" style="padding-top: 7.5%;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Feedback</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="main.php">
                <div class="modal-body">
                    <div id="message" style="text-align: center; color: green;"></div>
                    <div class="form-group">
                        <span id="updatecapacitymodalerrortext" style="color:red"></span>
                    </div>
                    
                        <div class="form-group">
                            </br>
                            &nbsp;<label for="capacity_txt_modal" class="col-form-label">Your Comment: </label>
                            </br><textarea class="form-control" name="comment" rows="3" maxlength="250" id="capacity_txt_modal"></textarea>
                            <br/>


                            <div class="feedback">
                                <label for="star" class="control-label">Rate Us</label>
                                <input id="feed_value" name="star" data-show-clear="false" data-show-caption="true"  class="rating rating-loading" data-min="0" data-max="5"
                                       data-step="1" data-star-captions='["Not Rated", "Poor", "Fair","Good","Very Good","Excellent"]' required="">
                            </div>

                         </div>
                    

                </div>
                <div class="modal-footer">
                        <button type="submit" name="send_feed" id="send_feed" class="btn btn-info ">Send</button>
                        <button type="button" id="capacityModalClose" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php include 'connect_db/connection.php' ?>

<?php 

    if(isset($_POST['send_feed']))
    {
        $comment = mysqli_real_escape_string($connection, $_POST['comment']);
        $star = mysqli_real_escape_string($connection, $_POST['star']);        
        $username = $_SESSION['username'];


        $sql = "INSERT INTO feedback(username,comment,star) VALUES('$username', '$comment', '$star')";
        mysqli_query($connection,$sql);

        $_POST['topic_title'] = $_SESSION["topic_title"];
        $_POST["page"] = $_SESSION['final_page'];
    }

 ?>




  <script type="text/javascript">
     $(document).ready(function($) {
        if($('#show_survey').val() == 'true')
        {
            $('#feedback_modal').modal('show');
        }
    
});


 </script>