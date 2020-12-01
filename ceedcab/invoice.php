<?php
    include "dbc.php";
    include "rideclass.php";
    $ride= new Ride();
    $rd= $ride->allrides(); 
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">            
            <div id="total-income">
                <table border="1">
                    <p>Ride History</p> 
                    <tr>
                        <th>Ride_ID</th>
                        <th>Ride_date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer ID</th>
                    </tr>
                    <?php
                        foreach($rd as $key=> $udd){
                            if($udd['status']==0){?>
						<tr>
							<td><?php echo $udd['ride_id'];?></td>
							<td><?php echo $udd['ride_date'];?></td>
                            <td><?php echo $udd['from_loc'];?></td>
                            <td><?php echo $udd['to_loc'];?></td>
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['customer_user_id'];?></td>
						</tr>
                            <?php } 
                        }?>
                </table>
            </div>
        </div>
    </body>
</html>