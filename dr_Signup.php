<?php
include("upload.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Doctor signup page</title>
    <link rel="stylesheet" href="assets/css/dr_Signup.css">


</head>

<body>
    <style>body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}</style>
    <header class="header-area header-in-login">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top">Medlance your journey start here</h1>
    <hr class="w3-border-grey" style="margin:auto;width:40%">
    <p class="w3-large w3-center">Join us or sign in if you already have an account</p>
    <div class="joinus"><a>Join us now</a></div>
    <div class="signin"><a>Sign in</a></div>
  </div>
  
</div>



    <button class="pos_btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
    <button class="btn_1" style="width:auto;" onclick="location.href='dr_Login.php'">Sign In</button>

    <div id="id01" class="modal">
        <span class="close" title="Close Modal" onclick="document.getElementById('id01').style.display='none'">&times;</span>
        <form method="POST" action="dr_Signup.php" enctype="multipart/form-data" class="modal-content">
            <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <div>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Valid email is required: ex@abc.xyz">
                    <?php if (isset($email_error)): ?>
                    <script type='text/javascript'>alert('Email is already taken');</script>
                    <span style="color: red;"><?php echo $email_error; ?></span><br><br>
                    <?php endif ?>
                </div>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" id="password" required>



                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" id="confirm_password" required>


                <label for="email"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                <?php if (isset($name_error)): ?>
                <script type='text/javascript'>alert('Username is already taken');</script>
	  	        <span style="color: red;"><?php echo $name_error; ?></span> <br><br>
	            <?php endif ?>
                <label for="email"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                <label for="email"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>

                <label for="Gender"><b>Gender</b></label>
                <br><br>
                <input type="radio" name="gender" value="male" required> Male<br>
                <input type="radio" name="gender" value="female" required> Female<br>
                <input type="radio" name="gender" value="other" required> Other<br>
                <br>
                
                <label for="Specialty"><b>Specialty: </b></label>
                <input name="specialty" placeholder="Specialty" type="search" list="Select_Specialty"/>
                <datalist id="Select_Specialty">
                    <option value="Specialty#1"/>
                    <option value="Specialty#2"/>
                    <option value="Specialty#3"/>
                    <option value="Specialty#4"/>
                    <option value="Specialty#5"/>
                    <option value="Specialty#6"/>
                    <option value="Specialty#7"/>
                    <option value="Specialty#8"/>


                </datalist>
                <br><br>

                                              
                
                

                <label for="email"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phonenumber" pattern="^(\d{9}|\d{10})$" required title="Please provide a valid phone number">
                <br><br>
                <label for="email"><b>Location Link</b></label>
                <input type="text" placeholder="Enter Location Link" name="locationlink" >
                <img style="max-width: 800px; max-height: 800px;" src="assets/images/help.jpg" alt="guidance">
                <label for="Location">Location:</label>
                <select name="location" id="loca" class="dropbox" required>
                <option value=""></option>
                <option value="Amman">Amman</option>
                <option value="Zarqa">Zarqa</option>
                <option value="Irbid">Irbid</option>
                <option value="Russeifa">Russeifa</option>
                <option value="Aqaba">Aqaba</option>
                <option value="Madaba">Madaba</option>
                <option value="As-Salt">As-Salt</option>
                <option value="Karak">Karak</option>
                </select>

                <label for="File">Please upload the file with all info needed.</label>
                <input type="file" id="file" name="file" required>
                <br><br>
                <label for="Photo">Please upload a photo</label>
                <input type="file" id="photo" name="photo" required>




                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" name="submit"  class="signupbtn">Sign Up</button>
                </div>
                
            </div>
        </form>
    </div>
        
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        

        var password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        
    
    </script>
    
    <script>
function submited() {
  alert("Request has been submited");
}
</script>


</body>

</html>