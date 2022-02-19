$(document).ready(function()
{

//CLICKS





//SUMBIT USER PRELIM
$(document).on("click", ".submit-user-prelim", function()
{

   

    let monthly_income = $("#user-monthly-income").val();
    let monthly_debt = $("#user-monthly-debt").val();
    let credit_score = $("#user-credit-score").val();



 

    insert_user_prelimary(monthly_income, monthly_debt, credit_score).then(function(r)
    {


       if(r == "success")
       {

            remove_slide_in(".slide-in-prelimary");

       }


    });



    
});




//CLOSE
$(document).on("click", ".close-container", function()
{
    let time = $(this).attr("data-time");
    $("#container"+time).fadeOut("fast");
    setTimeout(function()
    {
        $("#container"+time).remove();
    }, 1000);
});


//NAVIGATE
$(document).on("click", ".nav-item", function()
{
    let time = Date.now();
    let page = $(this).attr("data-page");

    if($(".slide-in-"+page).length > 0)
    {
        $(".slide-in-"+page).remove();
    }

    new_slider(time, page);
    load_page(page, time).then(function(r)
    {
        
        $(".slide-in-rel"+time).append(r)
    
    
        $("#close_slider"+time).on("click", function()
        {
            $("#slide-in"+time).remove();
        });



    });




    

});





//CREATE USER
$(document).on("click", ".submit-create-account", function()
{
 

    let button = document.querySelector('button');
    button.disabled = true;

    $(".login-form-resp").html("");

    let first = $(".newFirstName").val();
    let last = $(".newLastName").val();
    let email = $(".new-email").val();
    let pass = $(".new-pass").val();

    console.log(first+last+email+pass);

    if(email == "" || pass == "" || first == "" || last == "")
    {

        $(".login-form-resp").html("<br>Enter all fields<br><br>");
        button.disabled = false;
        return;
    }
     
    create_user(first, last, email, pass).then(function(r)
    {
        
      
        button.disabled = false;

        if(r == "error")
        {

            $(".login-form-resp").html("An error occured, please try again later");
            return;
        }
        if(r =="Uae")
        {
            $(".login-form-resp").html("E-mail already in use. <br> Try logging in if this is you.")
            return;
        }

       

        let response = JSON.parse(r);
        set_user(response);
        remove_slide_in(".slide-in-login");





    })
     
     
     
});



//SUBMIT LOGIN
$(document).on("click", "#submit-login", function()
{
 

    let email = $("#existing-email").val();
    let pass = $("#existing-pass").val();

    logUserIn(email, pass).then(function(r)
    {

        if(r == "error")
        {
            $(".login-form-resp").append("An error occured<br>Please try again later");
            return;
        }
        if(r == "Incorrect E-mail or password")
        {
            $(".login-form-resp").append(r);
            return;
        }
       
        let response = JSON.parse(r);
        set_user(response);
        $(".slide-in-login").animate({"left":"100%"}, "fast");
        setTimeout(function()
        {
            $(".slide-in-login").remove();
        },1500);
        

    });


});
























//FUNCTIONS

function logUserIn(email, pass)
{

    return new Promise(function (resolve,reject) 
    { 
        $.ajax({
        url: "form_handlers/loginUserIn.php",
        method: "POST",
        data: 
        {
            li: 1,
            email: email,
            pass: pass

        },
        success: function(response)
        {
            resolve(response);
        }
        });
    });

}


function signOut()
{
    localStorage.removeItem("simple_trader_user_id");
    location.reload(true);
    alert("now");
}

//LOAD PAGE
function load_page(page, time)
{

    return new Promise(function (resolve,reject) 
    { 
        $.ajax({
        url: ""+page+".php",
        method: "POST",
        data: 
        {
            op: 1,
            time: time

        },
        success: function(response)
        {
            resolve(response);
        }
        });
    });



}


function insert_user_prelimary(monthly_income, monthly_debt, credit_score)
{

    let userID = localStorage.getItem("simple_trader_user_id");

    
    return new Promise(function (resolve,reject) 
    { 
        $.ajax({
        url: "form_handlers/insert_user_prelimary.php",
        method: "POST",
        data: 
        {

            monthly_income: monthly_income,
            monthly_debt: monthly_debt,
            credit_score: credit_score,
            simple_trader_user_id: userID,
            simple_trader_session_id: localStorage.getItem("simple_trader_session_id"),
            iup: 1
            

            

        },
        success: function(response)
        {
            resolve(response);
        }
        });
    });

}





//REMOVE SLIDEIN
function remove_slide_in(slide)
{
    $(slide).animate({"left":"10000px"}, "slow");
    setTimeout(function()
    {
        $(slide).remove();
    }, 1500);
}


//SET CUSTOMER
function set_user(response)
{
    
    localStorage.setItem("simple_trader_user_id", response.simple_trader_user_id);
    localStorage.setItem("simple_trader_session_id", response.simple_trader_session_id);



}
//DESTROY USER
function destroy_user()
{
    
    localStorage.removeItem("simple_trader_user_id");
    localStorage.removeItem("simple_trader_session_id");


}


//NEW SLIDER
function new_slider(time, page)
{
    $(".wrap").append("<div class='slide-in slide-in-radius slide-in-after slide-in-"+page+"' id='slide-in"+time+"'><div class='slide-in-rel slide-in-rel"+time+"' id='login_page'> </div></div>");
    $("#slide-in"+time).animate({"left":"0px"}, "fast");

    



    if(page == "x")
    {
        $("#close_slider"+time).remove();
    }


    $("#close_slider"+time).on("click", function()
    {


        $("#slide-in"+time).animate({"left":"10000px"}, "slow");
        
        setTimeout(function()
        {

            $("#slide-in"+time).remove();

        },1500);



    });
}




//ASK USER PRELIMINARY QUESTIONS
function ask_user_prel_questions()
{
    let time = Date.now();
    let page = "prelimary";
    new_slider(time, page); 

    get_user_preliminary_screen().then(function(r)
    {

        $(".slide-in-rel"+time).append(r);

    });

}

//GET USER PRELIMINARY SCREEN
function get_user_preliminary_screen()
{
    return new Promise(function (resolve,reject) 
    { 
        $.ajax({
        url: "user_preliminary.php",
        method: "POST",
        data: {
            up: 1
        },
        success: function(response)
        {
            resolve(response);
        }
        });
    });

} 


//LOAD LOGIN SCREEN
function get_login_screen()
{
    return new Promise(function (resolve,reject) 
    { 
        $.ajax({
        url: "login.php",
        method: "POST",
        data: {
            lf: 1
        },
        success: function(response)
        {
            resolve(response);
        }
        });
    });
}
function load_login_screen()
{
    let time = Date.now();
    let page = "login";
    new_slider(time, page);    


    get_login_screen().then(function(r)
    {

        $(".slide-in-rel"+time).append(r);

    });


}


//CHECK USER LOGGED IN 
function check_user_logged_in()
{

    let user = localStorage.getItem("simple_trader_user_id");
    let session = localStorage.getItem("simple_trader_session_id");
  


    if(user == "null" || user == "undefined" || user == null || session == "null" || session == "undefined" || session == null)
    {
        destroy_user();
        load_login_screen();
        return;
    }

}
check_user_logged_in();







//CREATE NEW USER
function create_user(first, last, email, pass)
{
    return new Promise(function (resolve,reject) 
    { 
        $.ajax(
        {
            url: "form_handlers/create_user.php",
            method: "POST",
            data: 
            {
                first: first,
                last: last,
                email: email,
                pass: pass,
                cu: 1
            },
            success: function(response)
            {
                resolve(response);
            }
        });
    });
}









$("#slidein-0").animate({"left":"0px"}, "slow");
});