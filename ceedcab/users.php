<?php
    include "dbc.php";
    include "uci.php";
    $user= new User();
    $ud=$user->alluserdetails();
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
                
                $('.approve').click(function(){
                    var userid =$(this).attr('data-id');
                    var action="approveUser";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ user_id:userid , action:action},
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                });	
                $('.disapprove').click(function(){
                    var userid =$(this).attr('data-id');
                    var action="disapproveUser";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ user_id:userid , action:action},
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                });	
                $('.delete').click(function(){
                    var userid =$(this).attr('data-id');
                    var action="deleteUser";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ user_id:userid , action:action},
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
       <?php include "header.php"; ?>
       <div id="content">
            <div id="userdetails">
                <table border="1">
                    <p id="heading" >Pending</p> 
                    <tr>
                        <th>User ID</th>
                        <th>User name</th>
                        <th>Name</th>
                        <th>Date of Sign UP</th>
                        <th>Mobile</th>
                        <th>IS Block</th>
                        <th>Option</th>
                    </tr>
                    <?php
                        foreach($ud as $key=> $udd) {
                            if($udd['is_block']==1){?>
                                   <tr>
                                    <td><?php echo $udd['user_id'];?></td>
                                    <td><?php echo $udd['user_name'];?></td>
                                    <td><?php echo $udd['name'];?></td>
                                    <td><?php echo $udd['Date_of_signup'];?></td>
                                    <td><?php echo $udd['mobile'];?></td>
                                    <td><?php echo $udd['is_block'];?></td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="#" data-id="<?php echo $udd['user_id'];?>" class="approve" title="Allow">Allow</a>
                                       
                                    </td>
                                </tr>
                            <?php } 
                        }?>
                </table>
            </div>
            <div id="total-income">
                <table border="1">
                        <p id="heading">All Users</p> 
                        <tr>
                            <th>User ID</th>
                            <th>User name</th>
                            <th>Name</th>
                            <th>Date of Sign UP</th>
                            <th>Mobile</th> 
                            <th>Is _Blocked</th>
                            <th>Is_Admin</th>
                            <th>Option</th>
                        </tr>
                        <?php
                        foreach($ud as $key=> $udd) {?>
						<tr>
							<td><?php echo $udd['user_id'];?></td>
							<td><?php echo $udd['user_name'];?></td>
                            <td><?php echo $udd['name'];?></td>
                            <td><?php echo $udd['Date_of_signup'];?></td>
                            <td><?php echo $udd['mobile'];?></td>
                            
                            <td><?php if($udd['is_block']==0){echo "Active <img id='resicon' src='tick.png' alt='Logo' >";} else{echo "Blocked <img id='resicon' src='cancel.png' alt='Logo' >";}?></td>
							<td><?php if($udd['isAdmin']==0){echo "User";} else{echo "Admin";}?></td>
							<td>
								<!-- Icons -->
                                <a href="#" data-id="<?php echo $udd['user_id'];?>" id ="disapprove" class="disapprove" title="Dis">Disapprove</a> 
								<a href="#" data-id="<?php echo $udd['user_id'];?>" id="delete" class="delete" title="Delete">Delete</a> 
							</td>
						</tr>
					    <?php }?>
                    </table>
            </div>
        </div>
    </body>
</html>