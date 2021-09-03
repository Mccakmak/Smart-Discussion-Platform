<!-- Start Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    

    <form id="check_title_form" method="POST" action="index.php">
      <a id="back_to_main_navbar" class="navbar-brand" style="cursor:pointer;" >Smart Discussion Platform</a>
      <input type="hidden" name="check_title" id="check_title" value="">
    </form>
    
    <!-- Sandwich button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    
    <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Sandwich button -->

    <!-- Start Container div -->
    <div class="collapse navbar-collapse" id="navbarColor01">

      <!-- Start navbar auto from left side -->
      <form name="topic_type_form" id="topic_type_form" method="POST">
        <ul class="navbar-nav mr-auto" id="topic_types">
        <!-- <li class="nav-item active"> </li> -->

          <input type="hidden" name="topic_type" id="topic_type" value="">

<!--           <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Sports</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Health</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Politics</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  style="cursor:pointer;">Economy</a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Education</a>    
          </li>

          <li class="nav-item">
            <a class="nav-link" style="cursor:pointer;">Other</a>    
          </li> -->
      

        <!-- Start Dropdown -->

    <li class="nav-item dropdown">
          <a id="main_topic_drop" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Topics</a>
          <div id="topic_dropdown" class="dropdown-menu" >
            <a class="dropdown-item" href="#">Sports</a>
            <a class="dropdown-item" href="#">Health</a>
            <a class="dropdown-item" href="#">Politics</a>
            <a class="dropdown-item" href="#">Economy</a>
            <a class="dropdown-item" href="#">Education</a>
            <a class="dropdown-item" href="#">Tech/Science</a>
            <a class="dropdown-item" href="#">Art</a>
            <a class="dropdown-item" href="#">History</a>
            <a class="dropdown-item" href="#">Entertainment</a>


            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Other</a>
          </div>
        </li> 
</form>

        <!-- End Dropdown -->

      
      <!-- End navbar auto from left side -->

      <!-- Start navbar right side -->
      <form id="search_name_form" name="search_name_form" method="POST">
        <input type="hidden" name="search_name" value="">
      </form>
        <li class="nav-item">    
            <div id="myDropdown" class="dropdown-content">
              <input type="text" autocomplete="off" class="form-control mr-sm-2 border border-white "  placeholder="Search.." id="myInput">
              <div id="search_jquery"></div>
              
               <?php

                include("search/search.php");

                ?>
            </div>
        </li>
      
      
      </ul>

    <ul class='navbar-nav ml-auto' id='right_nav'>



        <li class='nav-item'>
          <button onclick="location.href='login/login.php'" type="button" class="btn btn-primary border border-white rounded-pill" id="login_button">
            <!-- Start Login icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" bi bi-box-arrow-in-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z">
              </path>
              <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z">
              </path>
            </svg>
            <!-- End Login icon --> 
          Login</button>
        </li>


        <li class='nav-item'>
          <button onclick="location.href='register/register.php'" type="button" class="btn btn-primary border border-white rounded-pill" id="sign_up_button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class=" bi bi-person-plus" viewBox="0 0 16 16">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
              </path>
              <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z">
              </path>
            </svg>
          Sign Up</button>
        </li>

    </ul>
    <!-- End navbar right side -->
  </div>
  <!-- End Container div -->
</nav>
<!-- End Navbar -->

<script type="text/javascript">
    $("#back_to_main_navbar").click(function(event) {
    $('#check_title').val("hot");
    $("#check_title_form").submit();  
  });

  $(document).ready(function(){
  $("#myInput").keyup(function(){
     var input = $(this).val();
     $.post("search/search.php", {search: input}, 
      function(data,status)
      {
        $("#search_jquery").html(data);
      });
  });
});


  $(document).mouseup(function (e) {
      if ($(e.target).closest(".search_res").length === 0) {
          $(".search_res").hide();
      }
  });


  $(".search_res").hide();
</script>