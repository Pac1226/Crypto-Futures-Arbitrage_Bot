<?php
if(!isset($_POST['lf']))
{
 exit();
}

$date_time = time();
$ubi = uniqid();

?>

<div class='slide-in-background'>
    <img src='assets/dummy_photos/background.jpg'>
</div>

<div class='log-in-form'>

    <span class='log-in-form-head'>New User</span><br>
    <span class='log-in-form-subhead'>Create account to continue</span><br>
    <div class='login-inputs login-inputs-div'>
        <input type='text' placeholder= 'Your first name' class='newFirstName' id='new-name<?php echo $ubi?>'><br>
        <input type='text' placeholder= 'Your last name' class='newLastName' id='new-name<?php echo $ubi?>'><br>
        <input type='e-mail' placeholder= 'E-mail' class='new-email' id='new-email<?php echo $ubi?>'><br>
        <input type='password' placeholder='Password' class='new-pass' id='new-pass<?php echo $ubi?>'>
    </div>
    <div class='login-inputs signin-inputs-div'>
        <input type='e-mail' placeholder= 'E-mail' id='existing-email'><br>
        <input type='password' placeholder='Password' id='existing-pass'>
    </div>
    <div class='login-form-resp'></div>
    <div class='login-buttons login-buttons-div'><button class='login-button submit-create-account' id='submit-create-account<?php echo $ubi?>'>Create Account</button><br><br><button class='existing-user-button' id='show-existing-user-button<?php echo $ubi?>'>I already have an account</button></div>
    <div class='login-buttons signin-buttons-div'><button class='login-button' id='submit-login'>Sign In</button><br><br><button class='existing-user-button' id='show-new-user-button<?php echo $ubi?>'>I want to create an account</button></div>

    

</div>








<!-- STYLE-->
<style>
    .log-in-form
    {     
        width: 100%;
        min-height: 50px;
        position: absolute;
        top: 0px;
        z-index: 1;
        top: 25%;
        text-align: center;
    }
    .log-in-form input
    {
        width: 350px;
        height: 40px;
        margin: 5px;
        padding: 5px;
        font-size: 17px;
    }
    .log-in-form-head
    {
        font-size: 25px;
        font-weight: bold;
    }
    .log-in-form-subhead
    {
        font-size: 18px;
        font-weight: bold;
    }
    .existing-user-button
    {
        background-color: transparent; 
        border: none;
        font-size: 17px;
        margin: 5px;
    }
    .login-button
    {
        font-size: 20px;
        border-radius: 2px solid;
        border: .5px solid grey;
        height: 45px;
        background-color: #e5f0fb;
    }
    .login-buttons button
    {
        min-width: 200px;
    }
    .signin-inputs-div
    {
        display: none;
    }
    .signin-buttons-div
    {
        display: none;
    }
    .login-form-resp
    {
        color: red;
        font-weight: bold;
        font-size: 17px;
    }
</style>




<!-- JS-->
<script>

    
    
    //TOGGLE FORMS
    $("#show-existing-user-button<?php echo $ubi?>").on("click", function()
    {
        $(".login-form-resp").html("");
        $(".login-buttons-div").css("display", "none");
        $(".signin-buttons-div").slideDown();
        $(".login-inputs-div").css("display", "none");
        $(".signin-inputs-div").slideDown();
        $(".log-in-form-head").html("Welcome Back!");
        $(".log-in-form-subhead").html("Login to continue");
    });
    $("#show-new-user-button<?php echo $ubi?>").on("click", function()
    {
        $(".login-form-resp").html("");
        $(".log-in-form-head").html("New User");
        $(".log-in-form-subhead").html("Create account to continue");
        $(".signin-buttons-div").css("display", "none");
        $(".login-inputs-div").slideDown();
        $(".signin-inputs-div").css("display", "none");
        $(".login-buttons-div").slideDown();
    });



   





    //FUNCTIONS
    



</script>