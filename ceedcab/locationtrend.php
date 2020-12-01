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
        $lf=$ride->locride();
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script type="text/javascript">
         $(document).ready(function(){
          var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: [<?php foreach($lf as $key=>$rdd){echo"'".$rdd['from_loc']."',";}?>],
                    datasets: [{
                        label: 'Rides per Location',
                        backgroundColor: 'transparent',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [<?php foreach($lf as $key=>$rdd){echo $rdd['count(ride_id)'].",";}?>]
                    }]
                },

                // Configuration options go here
                options: {}
            }); 
            
         });           
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
            <h1>Location Trends:</h1>
            <canvas id="myChart"></canvas>
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>