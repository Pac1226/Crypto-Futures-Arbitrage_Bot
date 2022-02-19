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
        <img src='assets/analyze.jpg'>
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
    <div class='content-heading'>Market Analysis</div>

    <div class="log-in-form">

        <img src='assets/loadingtwo.gif' class='loadingGif'>


    </div>


    <div class='scroller analyze-scroller' id='scroller<?php echo $ubi?>'>


       <img src='assets/graph_placeholders/bokeh_plot.jpg'><img src='assets/graph_placeholders/bokeh_plot1.jpg'><img src='assets/graph_placeholders/bokeh_plot2.jpg'>
       <img src='assets/graph_placeholders/bokeh_plot3.jpg'>

       <img src='assets/graph_placeholders/summary.jpg'>
       <img src='assets/graph_placeholders/summary2.jpg'>

       
       <img src='assets/graph_placeholders/bokeh_plot4.jpg'><img src='assets/graph_placeholders/bokeh_plot5.jpg'><img src='assets/graph_placeholders/bokeh_plot6.jpg'><img src='assets/graph_placeholders/bokeh_plot7.jpg'>

       <img src='assets/graph_placeholders/summary3.jpg'>
       <img src='assets/graph_placeholders/summary4.jpg'>


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


    
 
 setTimeout(function()
 {

    $(".log-in-form").fadeOut("slow");


 },3000);


   
    
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
.analyze-scroller
{
    width: 100%;
    height: -moz-calc(100% - 50px);
    height: -webkit-calc(100% - 50px);
    height: -o-calc(100% - 50px);
    height: calc(100% - 50px);
    margin-top: 10px;
    overflow-y: auto;
    width: 100%;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}
.analyze-scroller img
{
    width: 50%;
    height: auto;
}
.each-trade
{
    width: 98%;
    margin-left: 1%;
    height: 200px;

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
@media only screen and (max-width: 1024px)
{
    .analyze-scroller img
{
    width: 100%;
    height: auto;
}


}
</style>

