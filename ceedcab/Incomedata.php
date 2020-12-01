<?php
    session_start();
    
    if(isset($_SESSION['userdata'])&& $_SESSION['userdata']['isAdmin']==1){
        include "dbc.php";
        include "uci.php";
        include "rideclass.php";
        include "disclass.php";
        $ride= new Ride();
        $rd= $ride->allrides(); 
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
        $ua=$user->alluserdetails();
        $cost=$user->totalspent();
        $loc= new Distance();
        $ld=$loc->alllocation();
        $lf=$ride->locfare();
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            //BAR CHART START
            window.onload = function () {
	
            var chart = new CanvasJS.Chart("barchart", {
                animationEnabled: true,
                
                title:{
                    text:"Income Per Location"
                },
                axisX:{
                    interval: 1
                },
                axisY2:{
                    interlacedColor: "rgba(1,77,101,.2)",
                    gridColor: "rgba(1,77,101,.1)",
                    title: "Total Income"
                },
                data: [{
                    type: "bar",
                    name: "companies",
                    axisYType: "secondary",
                    color: "#014D65",
                    dataPoints: [
                        <?php foreach($lf as $key=>$lff){ echo"{ y:".$lff['sum(total_fare)'].",label:'".$lff['from_loc']."'},";}?>
                    ]
                }]
            });
            chart.render();
            
            }
            //BAR START ENDS
            //PIE CHART START Draw the chart and set the chart values
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['CabType', 'Income'],
            ['Cedmicro', <?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['Cab_type']=="CedMicro" && $rdd['status']==2){$u+=$rdd['total_fare'];}} echo $u;?>],
            ['Cedmini', <?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['Cab_type']=="CedMini"&& $rdd['status']==2){$u+=$rdd['total_fare'];}} echo $u;?>],
            ['CedRoyal',  <?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['Cab_type']=="CedRoyal"&& $rdd['status']==2){$u+=$rdd['total_fare'];}} echo $u;?>],
            ['CedSUV',  <?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['Cab_type']=="CedSUV"&& $rdd['status']==2){$u+=$rdd['total_fare'];}} echo $u;?>],
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title':'Per Cab Type Income', 'width':550, 'height':400};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('userdetails'));
            chart.draw(data, options);
            }
        </script>

    </head>
    <body>
    <header>
            <div class = "logo">
                <img class="mb-2" src="logo2.png"  alt="Logo" >
                <div id="welcome">
                <div class="dropdown">
                        <button class="dropbtn">Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?></button>
                        <div class="dropdown-content">
                            <a href="index.php">Go To Main Page</a>
                            <a href="signout.php">Sign Out</a>
                        </div>
                    </div>
                </div>    
                </div>    
            </div>	
            <ul>
                <li><a href="admin.php">DASHBOARD</a></li>
                <li><a href="rides.php">RIDES</a></li>
                <!--<li><a href="invoice.php">INVOICES</a></li>-->
                <li><a href="users.php">BLOCK/UNBLOCK USER</a></li>
                <li><a href="data.php">ALL DATA</a></li>
                <li><a href="location.php">LOCATIONS</a></li>
                <li><a href="account.php">ACCOUNT</a>
                </li>
            </ul>
        </header>
        <div id="content">
            <h1>Income Figures:</h1>
           <div id="userdetails">  
            </div>
            <div id="barchart" style="height: 300px; width: 80%;"></div>
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>