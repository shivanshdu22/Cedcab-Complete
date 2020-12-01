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
        <script>
            $(document).ready(function(){
                $('#approve').click(function(){
                    var rideid =$(this).attr('data-id');
                    var action="approveRide";
                    console.log(rideid);
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ rideid:rideid , action:action},
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                });	
                $('#cancel').click(function(){
                    var rideid =$(this).attr('data-id');
                    var action="cancelRide";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ rideid:rideid , action:action},
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                });	
                $('#delete').click(function(){
                    var rideid =$(this).attr('data-id');
                    var action="deleteRide";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ rideid:rideid , action:action},
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                });	
            });
        </script>
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">         
            <div id="userdetails">
                <table border="1">
                    <p id="heading">Pending</p> 
                    <tr>
                    <th>Ride ID</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Cab Type</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer ID</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    <?php
                        foreach($rd as $key=> $udd){
                            if($udd['status']==1){?>
						<tr>
							<td><?php echo $udd['ride_id'];?></td>
							<td><?php echo $udd['ride_date'];?></td>
                            <td><?php echo $udd['from_loc'];?></td>
                            <td><?php echo $udd['to_loc'];?></td>
                            <td><?php echo $udd['Cab_type'];?></td>
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['customer_user_id'];?></td>
                            <td><?php if($udd['status']==1){ echo "Pending <img id= 'resicon' src='pendingride.png' alt='Logo' >";} elseif($udd['status']==2){echo "Canceled <img id= 'resicon' src='cancel.png' alt='Logo' >";}  else{echo "Completed <img id= 'resicon' src='tick.png' alt='Logo' > ";}?></td>
							<td>
								<!-- Icons -->
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="edit"id="approve" title="Approve">Approve</a>
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="delete"id="cancel"title="Cancel">Cancel</a> 
							</td>
						</tr>
                            <?php } 
                        }?>
                </table>
            </div>
            <div id="total-income">
                <table >
                    <p id="heading">Ride History</p> 
                    <tr>
                        <th>Ride ID</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Cab Type</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer ID</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    <?php
                        foreach($rd as $key=> $udd){?>
						<tr>
							<td><?php echo $udd['ride_id'];?></td>
							<td><?php echo $udd['ride_date'];?></td>
                            <td><?php echo $udd['from_loc'];?></td>
                            <td><?php echo $udd['to_loc'];?></td>
                            <td><?php echo $udd['Cab_type'];?></td>
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['customer_user_id'];?></td>
                            <td><?php if($udd['status']==1){ echo "Pending <img id= 'resicon' src='pendingride.png' alt='Logo' >";} elseif($udd['status']==0){echo "Canceled <img id= 'resicon' src='cancel.png' alt='Logo' >";}  else{echo "Completed <img id= 'resicon' src='tick.png' alt='Logo' > ";}?></td>
							<td>
								<!-- Icons -->
								<a href="#" data-id="<?php echo $udd['ride_id'];?>"id="delete" title="Delete">Delete</a> 
							</td>
						</tr>
					<?php }?>
                </table>
            </div>
        </div>
    </body>
</html>