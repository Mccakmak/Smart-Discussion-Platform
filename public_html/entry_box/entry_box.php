<?php $row_num = $_SESSION['row_no'];  ?>
<form id="comment_form_<?php echo htmlspecialchars($row_num)?>" method="POST">

    <div id="entry_box" class="border border-white">
        <div class="box1">
                <p id="comment_text" class="comment">
                    <?php 
                    $string = $info['comment_text'];
                    $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                    $string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $string);
                 echo $string; ?></p> 
        </div>
        <div class="box2">

            <ul>
                <li class="like_button">
                <font size="3"><?php echo htmlspecialchars($info['comment_like_num']); ?></font>
                        <svg type="button" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hand-thumbs-up-fill " viewBox="0 0 16 16">
                            <path style="fill:#08f" d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.964.22.817.533 2.512.062 4.51a9.84 9.84 0 0 1 .443-.05c.713-.065 1.669-.072 2.516.21.518.173.994.68 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.162 3.162 0 0 1-.488.9c.054.153.076.313.076.465 0 .306-.089.626-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.826 4.826 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.616.849-.231 1.574-.786 2.132-1.41.56-.626.914-1.279 1.039-1.638.199-.575.356-1.54.428-2.59z"/>
                        </svg>
                </li>

                <li class="dislike_button">
                <font size="3"><?php echo htmlspecialchars($info['comment_dislike_num']); ?></font>
                        <svg type="button" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-hand-thumbs-down-fill " viewBox="0 0 16 16">
                            <path style="fill:#ee0000" d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/>
                        </svg>
                </li>

                <li class="username">
                    <label for=""><b>Username:</b></label>

                <?php 
                
                    // if the user not login
                    if(!isset($_SESSION['username']))
                    { ?>
                        <span id="comment_user_nologin_link_div">
                            <a class="comment_username" id="<?php echo htmlspecialchars($row_num)?>" style="color: #081aa1; text-decoration: underline; cursor:pointer;"  size="2"> <?php echo htmlspecialchars($info['comment_username']); ?></a>
                        </span>
                        
                    <?php  }
                    else
                    {?>
                        <span id="comment_user_link_div">
                            <a class="comment_username" id="comment_user_link_<?php echo htmlspecialchars($row_num)?>" style="color: #081aa1; text-decoration: underline; cursor:pointer;"  size="2"> <?php echo htmlspecialchars($info['comment_username']); ?></a>
                        </span>
                    <?php  }

                 ?>   
                        
                
                    
                        
                </li>
                    
                <li class="date">
                    <label for="comment_date"><b>Date:</b></label>
                    <font id="comment_date" size="2"><?php echo htmlspecialchars($info['comment_date']); ?></font>
                </li>

            </ul>
        
        </div>

    </div>
        <input type="hidden" name="comment_form">
        <input type="hidden" name="title" id="title" value="">
        <input type="hidden" name="text" id="text" value="">
        <input type="hidden" name="username" id="username" value="">
        <input type="hidden" name="date" id="date" value="">
        <input type="hidden" name="type" id="type" value="">
</form>


<script type="text/javascript">
    $("#comment_user_link_div a").click(function(event) {
    var name = $(this).text();
    name = name.replace(/\s/g, ''); //remove space
    document.profile_link_form.profile_name.value = name;
    document.forms["profile_link_form"].submit();
    });

    $("#comment_user_nologin_link_div a").click(function(event) {            
        Swal.fire({icon: "error",title: "Please login first to see the profiles!",showConfirmButton: false,timer: 1500}); 
    });
</script>