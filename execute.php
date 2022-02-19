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
    <div class='content-heading'>My Trades</div>

    <div class="log-in-form">

        <img src='assets/loadingtwo.gif' class='loadingGif'>


    </div>


    <div class='scroller oportunity-scroller' id='scroller<?php echo $ubi?>'>







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


    


    //FUNCTIONS

    //SECONLY GET THE TRADES FOR USER LOGGED IN
    function getUsersTrades(userID, sessionID)
    {
        return new Promise(function (resolve,reject) 
        { 
        $.ajax({
        url: "getUserTrades.php",
        method: "POST",
        data: 
        {

            userID: userID,
            sessionID: sessionID,
            op: 1
            

            

        },
        success: function(response)
        {
            resolve(response);
        }
        });
        });
    }
    

    //EXECUTE THE ARBS FIRST
    function execute_arbs()
    {

        return new Promise(function (resolve,reject) 
        { 
        $.ajax({
        url: "arbOpportunities.py",
        method: "POST",
        data: 
        {

            
            op: 1
            

            

        },
        success: function(response)
        {
            resolve(response);
        }
        });
        });


    }
 
    execute_arbs().then(function(r)
    {

        let userID = localStorage.getItem("simple_trader_user_id");
        let sessionID = localStorage.getItem("simple_trader_session_id");
        
        $(".log-in-form").fadeOut("slow");
        getUsersTrades(userID, sessionID).then(function(r)
        {
            if(r == "no trades yet")
            {
                $("#scroller<?php echo $ubi?>").append("<div style='padding: 20px; font-size: 40px; color: white;'>No arbs yet found.  Don't Worry, were still lookin!</div>");
                return;
            }

            let response = JSON.parse(r);
            let fadeInDelay = 1000;
            for(var i = 0; i <response.length; i++)
            {
                let thisTrade = response[i];
                appendTrade(thisTrade, fadeInDelay);
                fadeInDelay = fadeInDelay + 700;
            }


        });
       
    });


    //APPEND EACH TRADE
    function appendTrade(thisTrade, fadeInDelay)
    {
        let id = thisTrade.id
        let rand = Math.random().toString();
        rand = rand.replace('.', '');
        console.log(thisTrade);

        $("#scroller<?php echo $ubi?>").append("<div class='each-trade' id='each-trade"+rand+"'><div class='each-trade-rel'><div class='each-trade-background'></div><div class='each-trade-content-absolute'><div class='each-trade-content-rel'><span style='font-size: 40px;'>"+thisTrade.symbol+" - "+thisTrade.buySellFlag+"</span><br><span style='font-size: 35px;'>Lots: "+thisTrade.lots+"</span><br><span style='font-size: 35px;'>price: $"+thisTrade.price+"</span><br><span style='font-size: 30px;'>On: "+thisTrade.txDate+"</span><br></div></div></div></div>");
        

        setTimeout(function()
        {

            $("#each-trade"+rand).fadeIn(1500);

        }, fadeInDelay);
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
.oportunity-scroller
{
    width: 100%;
    height: -moz-calc(100% - 50px);
    height: -webkit-calc(100% - 50px);
    height: -o-calc(100% - 50px);
    height: calc(100% - 50px);
    margin-top: 10px;
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
..each-trade-content-rel span
{
    font-size: 19px;
}

</style>

