<?php
if(!isset($_POST['op']))
{
 exit();
}

$date_time = time();
$time = $_POST['time'];
$ubi = uniqid();

?>

<div class='page-wrap'>
<div class='welcome-background'>
    <img src='assets/dummy_photos/background.jpg'>
</div>


<div class='page-wrap-absolute'>
    <div class='slide-in-menu'>
    <button class='close_slider' id='close_slider<?php echo $time?>'>X</button>
    <div class='slide-in-menu-icons'>

    <img src='assets/performance.png' class='' data-page = 'performance'>
    <img src='assets/chart.png' class='' data-page='chart'> 
    <img src='assets/dash.png' class='' data-page='dashboard'>

    </div>
    
    </div>

    <div class='slide-in-content opportunity-content'>




    <div class="log-in-form">

      
        <div class='match-result'>
            <span id = 'match-result-resp'></span>
            <div class='match-result-buttons'>
                <button class='find-more-money-button' id='find-more-money-button<?php echo $ubi?>'>Find more money!</button><button class='imGood' id='imGood<?php echo $ubi?>'>Im good</button>
            </div>
        </div>
        
        <div class="login-inputs login-inputs-div">
        <span class="log-in-form-subhead">How much are you looking for?</span><br>
        <input type="text" placeholder="Loan amount" class="amount-requested" id="amount-requested"><br>
        </div>

        <div class="login-form-resp"></div>
    <div class="login-buttons login-buttons-div"><button class="submit-amount-request-button" id="submit-amount-request-button<?php echo $ubi?>">Submit</button></div>
    <img src='assets/loadingtwo.gif' class='loadingGif'>



</div>











</div>

</div>

</div>


<script>
    //CLICKS


    $("#imGood<?php echo $ubi?>").on("click", function()
    {
        $(".close_slider").trigger("click");
    });


    $("#find-more-money-button<?php echo $ubi?>").on("click", function()
    {
        $("#imGood<?php echo $ubi?>").css("display", "none");
        $(this).css("display", "none");
        $("#match-result-resp").html("");
        $(".login-inputs").slideDown();
        $(".submit-amount-request-button").slideDown();
    });
    
    $("#submit-amount-request-button<?php echo $ubi?>").on("click", function()
    {   
        $("#match-result-resp").html("");
        $("#match-result-resp").html("Finding money");
        $(".login-inputs").css("display", "none");
        $(this).css("display", "none");
        $("#login-form-resp").html("Please Wait..");
        $(".loadingGif").css("display", "initial");
        let userID = localStorage.getItem("simple_trader_user_id");
        let amount_requested = $("#amount-requested").val();
        match_investor(amount_requested, userID).then(function(r)
        {
            alert(r);
            setTimeout(function()
            {

                $("#match-result-resp").html(r);
                $(".loadingGif").css("display", "none");
                $(".find-more-money-button").css("display", "initial");
                $(".imGood").css("display", "initial");

            }, 1500)
        });

    });




    //FUNCTIONS
    function match_investor(amount_requested, userID)
    {

        let string = amount_requested+","+userID;

        return new Promise(function (resolve,reject) 
        { 
        $.ajax({
        url: "userLoanApproval.py?string=test",
        method: "POST",
        data: 
        {

            
            string: string,
            op: 1
            
            

            

        },
        success: function(response)
        {
            resolve(response);
        }
        });
        });
    }
</script>


<style>

.page-wrap
{
    width: 100%;
    height: 100%;
    position: relative;
}
.page-wrap-absolute
{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    z-index: 1;
}
.slide-in-menu
{
    width: 100%;
    height: 40px;
}
.slide-in-menu-icons
{
    width: 300px;
    height: 100%;
   
    text-align: center;
}
.slide-in-menu-icons img
{
    width: 30px;
    height: auto;
    margin: 10px;
    border: .5px solid grey;
    border-radius: 50%;
}
.slide-in-menu-icons img:hover
{
    transform: scale(1.1);
    cursor: pointer;
}
.opportunity-content
{
    position: relative;
}
.log-in-form-subhead
{
    font-size: 20px;
    font-weight: bold;
}
.loadingGif
{
    width: 200px;
    height: auto;
    display: none;
}
#match-result-resp
{
    font-size: 25px;
}
.find-more-money-button
{
    display: none;
    height: 30px;
    font-weight: bold;
}
.imGood
{
    display: none;
    height: 30px;
    color: red;
}
.match-result-buttons button
{
    margin: 10px;
    min-width: 120px;
}

</style>

