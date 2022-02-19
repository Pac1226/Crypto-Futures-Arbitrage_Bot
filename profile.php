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
        <img src='assets/trade-bg.jpg'>
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
    <div class='content-heading'>Profile & Info</div>

    <div class="log-in-form">

        <img src='assets/loadingtwo.gif' class='loadingGif'>


    </div>


    <div class='scroller settings-scroller' id='scroller<?php echo $ubi?>'>


        <!-- PROFILE PIC-->
        <div class='eachSettingBox profile-info-pp'>
            <div class='setting-head'>Profile Picture</div>
            <div class='settings-profilepic-img'>
                <img src='assets/defaultpic.png'>
            </div>
            <div class='settings-box-bottom-button'>
                <button id='updatePP'>Update Profile Picture</button>
            </div>


        </div>



        <!-- TWO FORMS ID-->
        <div class='eachSettingBox'>
        <div class='setting-head'>Two Forms ID</div>

        <div class='settings-profilepic-img photo-id-img'>
            <img id='photo-id-1' src='assets/defaultid.png'>
            <img id='photo-id-2' src='assets/defaultid.png'>
        </div>
        <div class='settings-box-bottom-button'>
            <button id='updatePP'>+ Add ID </button>
        </div>



        </div>








        <div class='eachSettingBox'>
            <div class='setting-head'>Financial Information</div>
            <br>
            <span class='financial-heading'>Credit Score</span><br>
            <input type='text' id='myCreditScore<?php echo $ubi?>' placeholder='Credit Score'><br>
            <span class='financial-heading'>Income / month.</span><br>
            <input type='text' id='myMontlyIncome<?php echo $ubi?>' placeholder='Monthly Income'><br>
            <span class='financial-heading'>Debt Oblgations / month.</span><br>
            <input type='text' id='myDebtObg<?php echo $ubi?>' placeholder='Monthly Income'><br><br>

            <span id='updateFinancialsResp<?php echo $ubi?>'></span>
            <div class='settings-box-bottom-button'>
            <button id='updateFinancials<?php echo $ubi?>'>Update Financials</button>
            </div>

        </div>



        <div class='eachSettingBox'>
            <button class='signout' id='signout<?php echo $ubi?>'>Log-out</button>
            <button class='signout' id='testscript<?php echo $ubi?>'>Test A Script</button>

        </div>
        


    </div>
    

    </div>
    </div>
   
</div>

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
.content-heading
{
    width: 95%;
    margin-left: 2.5%;
    height: 40px;
    font-size: 35px;
    color: white;
    font-weight: bold;
}
.settings-scroller
{
    width: 100%;
    height: -moz-calc(100% - 50px);
    height: -webkit-calc(100% - 50px);
    height: -o-calc(100% - 50px);
    height: calc(100% - 50px);
    margin-top: 10px;
    text-align: center;
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
.eachSettingBox
{
    width: 50%;
    min-height: 200px;
    max-height:auto;
    border: .5px solid white;
}
.eachSettingBox input
{
    height: 30px;
    padding: 10px;
    width: 180px;
    font-size: 20px;
}
.each-trade
{
    width: 98%;
    margin-left: 1%;
    height: 210px;

    display: none;
    border-radius: 2px;
    margin-bottom: 7px;

   /* background: linear-gradient(rgb(255 255 255 / 80%), rgb(47 47 47 / 80%));*/
}
.each-trade-rel
{
    width: 100%;
    height: 100%;
    position: relative;
}
.each-trade-background
{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    z-index: 0;
    background-color: white;
    opacity: .09;
}
.each-trade-content-absolute
{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    z-index: 1;
}
.each-trade-content-rel
{
    width: 100%;
    height: 100%;
    position: relative;
    padding: 10px;
    color: white;
    
}
.each-trade-content-rel span
{
    font-size: 19px;
}
.setting-head
{
    width: 100%;
    text-align: center;
    color: white;
    height: 40px;
    font-size: 30px;
}
.settings-profilepic-img
{
    width: 100%;
    height: auto;
    padding: 10px;
}
.settings-profilepic-img img
{
    height: 180px;
    width: auto;
    border: .5px solid white;
    border-radius: 50%;
}
.settings-box-bottom-button
{
    width: 100%;
    height: 40px;
    background-color: green;
    overflow: hidden;
}
.settings-box-bottom-button button
{
    width: 100%;
    height: 100%;
    font-weight: bold;
}
.photo-id-img img
{
    margin-right: 10px;
}
.financial-heading
{
    font-size: 25px;
    color: white;
}
@media only screen and (max-width: 1024px)
{
    .eachSettingBox
{
    width: 100%;
    min-height: 200px;
    max-height:auto;
    border: .5px solid white;
}
    

}






</style>


<script>
$(document).ready(function()
{


    //CLICKS
    //TEST SCRIPT
    function testScript()
    {
        return new Promise(function (resolve,reject) 
        { 
            $.ajax({
            url: "getposttest.php",
            method: "POST",
            data: 
            {
                test: 1
               

            },
            success: function(response)
            {
                resolve(response);
            }
            });
        });
    }
    $("#testscript<?php echo $ubi?>").on("click", function()
    {
        testScript().then(function(r)
        {
            alert(r);
        });
    });


    //SIGNOUT
    $("#signout<?php echo $ubi?>").on("click", function()
    {
        localStorage.removeItem("simple_trader_user_id");
        location.reload(true);
    });





    $("#updateFinancials<?php echo $ubi?>").on("click", function()
    {

        let creditScore = $("#myCreditScore<?php echo $ubi?>").val();
        let monthlyIncome = $("#myMontlyIncome<?php echo $ubi?>").val();
        let monthlyDebt = $("#myDebtObg<?php echo $ubi?>").val();
        


        updateUserFinancials(creditScore, monthlyIncome, monthlyDebt).then(function(r)
        {
           
            if(r == "success")
            {
                $("#updateFinancialsResp<?php echo $ubi?>").html("Financial successfully updated!<br><br>");
                $("#updateFinancialsResp<?php echo $ubi?>").css("font-weight", "bold");
                $("#updateFinancialsResp<?php echo $ubi?>").css("font-weight", "green");

            }
           
        });

    });



    //FUNCTIONS
    //GET PROFILE


    function updateUserFinancials(creditScore, monthlyIncome, monthlyDebt)
    {
        return new Promise(function (resolve,reject) 
        { 
            $.ajax({
            url: "form_handlers/updateUserFinancials.php",
            method: "POST",
            data: 
            {
                userID: localStorage.getItem("simple_trader_user_id"),
                sessionID: localStorage.getItem("simple_trader_session_id"),
                creditScore: creditScore,
                monthlyIncome: monthlyIncome,
                monthlyDebt: monthlyDebt

               

            },
            success: function(response)
            {
                resolve(response);
            }
            });
        });
    }


    function getUserProfilePage()
    {
        return new Promise(function (resolve,reject) 
        { 
            $.ajax({
            url: "getUsersProfilePageDetails.php",
            method: "POST",
            data: 
            {
                userID: localStorage.getItem("simple_trader_user_id"),
                sessionID: localStorage.getItem("simple_trader_session_id")
               

            },
            success: function(response)
            {
                resolve(response);
            }
            });
        });
    }
    getUserProfilePage().then(function(r)
    {
        if(r == "")
        {
            return;
        }
        let response = JSON.parse(r);
        
        $("#myCreditScore<?php echo $ubi?>").val(response.creditScore);
        $("#myMontlyIncome<?php echo $ubi?>").val(response.monthlyIncome);
        $("#myDebtObg<?php echo $ubi?>").val(response.monthlyDebt);
       
      
    });




















    //FADE LOADING GIF OUT
    $(".log-in-form").fadeOut("slow");
});
</script>