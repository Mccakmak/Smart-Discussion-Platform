<div id="profile_info_styles" class="info_forms DivToScroll DivWithScroll">
    <form method="POST">
        <div class="page-wrapper bg-gra-02 p-t-20 p-b-20 font-poppins">
                <div class="wrapper wrapper--w680">
                    <div class="card card-4">
                        <div class="card-body">
                            <h2 class="title">Update Profile</h2>
                            <form method="POST">
                                <div class="row row-space">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <label class="label">first name</label>
                                            <input type="text" class="input--style-4" id="name" name="name" placeholder="<?php if(!empty($user_realname)){echo htmlspecialchars($user_realname);} ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="input-group">
                                            <label class="label">last name</label>
                                            <input type="text" class="input--style-4" id="surname" name="surname" placeholder="<?php if(!empty($user_realsurname)){echo htmlspecialchars($user_realsurname);} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <!-- <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">Birthday</label>
                                            <div class="input-group-icon">
                                                <input class="input--style-4 js-datepicker" type="text" name="birthday">
                                                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Email</label>                                   
                                            <input type="email" class="input--style-4" id="mail" name="mail" placeholder="<?php echo htmlspecialchars($user_mail); ?>" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <label class="label">Password</label>
                                            <input type="password" class="input--style-4" id="password" name="password" placeholder='<?php for($i=0; $i<$password_length;$i++){echo "&#9679";}  ?>'>
                                        </div>
                                    </div>                            
                                </div>
                                
                                <div class="row row-space">
                                    <div class="col-5">
                                        <div class="input-group">
                                            <label class="label">Age</label>                                   
                                            <input type="text" class="input--style-4" id="age" name="age" placeholder="<?php if(!empty($user_age)){echo htmlspecialchars($user_age);} ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                            <label class="label">Gender</label>
                                            <div class="p-t-10">
                                                 <?php 

                                                    if(!empty($user_gender) && $user_gender == 'Male')
                                                    {?>
                                                            <label class="radio-container m-r-45">Male
                                                                <input type="radio" checked="checked" name="gender" value="Male">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <label class="radio-container">Female
                                                                <input type="radio" name="gender" value="Female">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                     <?php } 

                                                    elseif(!empty($user_gender) && $user_gender == 'Female')
                                                    {?>
                                                            <label class="radio-container m-r-45">Male
                                                                <input type="radio" name="gender" value="Male">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <label class="radio-container">Female
                                                                <input type="radio" checked="checked" name="gender" value="Female">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                    <?php } 
                                                    else 
                                                    {?>

                                                            <label class="radio-container m-r-45">Male
                                                                <input type="radio" name="gender" value="Male">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                            <label class="radio-container">Female
                                                                <input type="radio" name="gender" value="Female">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                    
                                                 <?php } ?>
                                            </div>
                                    </div>


                                </div>
                                
                                <div class="p-t-15">
                                    <button type="submit" value="true" name="update_profile" class="btn btn--radius-2 btn--blue">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
