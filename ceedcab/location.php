<?php
    include "dbc.php";
    include "disclass.php";
    $msg="";
    $user= new Distance();
    $ud=$user->alllocation();
    if(isset($_POST["submit"])){
        $location=isset($_POST['location'])?$_POST['location']:'';
        $dis=isset($_POST['distance'])?$_POST['distance']:'';
        $active=isset($_POST['active'])?$_POST['active']:'';
        $msg=$user->addloc($location,$dis,$active);   
    }  
    if(isset($_POST["update"])){
        
        $id=isset($_POST['id'])?$_POST['id']:'';
        $location=isset($_POST['location'])?$_POST['location']:'';
        $dis=isset($_POST['distance'])?$_POST['distance']:'';
        $active=isset($_POST['active'])?$_POST['active']:'';
        $msg=$user->updateloc($id,$location,$dis,$active);   
        echo $msg;
    }             
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
                $('#update').hide();
                $(".edit").click(function(){
                    var hash="#";
                    var currentRow = $(this).closest('tr');
					var id = currentRow.find('id').text();
                    var location =currentRow.find('name').text();
                    var distance =currentRow.find('distance').text();
                    var av =currentRow.find('avail').text(); 
                    $('#id').val(id); 
                    $('#location').val(location);
                    $('#distance').val(distance);
                    $('[name=active]').val(av);
                    $('#add').hide();
                    $('#update').show();
                    $(this).closest('tr').remove();
                });
                $('.delete').click(function(){
                        var locationid =$(this).attr('data-id');
                        var action="deletelocation";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ loc_id:locationid , action:action},
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
            <div id="total-income">
            
                <table border="1">
                        <p id="heading">All Locations</p> 
                        <tr>
                            <th>Location ID</th>
                            <th>Name</th>
                            <th>Distance</th>
                            <th>Available</th>
                            <th>Option</th>
                        </tr>
                        <?php
                        foreach($ud as $key=> $udd) {?>
						<tr>
							<td><id><?php echo $udd['id'];?></id></td>
                            <td><name><?php echo $udd['name'];?></name></td>
                            <td><distance><?php echo $udd['distance'];?></distance></td>
                            <td><avail><?php  if($udd['is_available']==0){echo "Unavailable";} else{echo "Available";}?></avail></td>
							<td>
								<!-- Icons -->
								<a href="#" data-id="<?php echo $udd['id'];?>" class="edit"  title="Edit">Edit</a>
								<a href="#" data-id="<?php echo $udd['id'];?>" class="delete"  title="Delete">Delete</a> 
							</td>
						</tr>
					    <?php }?>
                    </table>
            </div>
            <div id="total-income">
            
            <table border="1">
                    <p id="heading">Pending Locations</p> 
                    <tr>
                        <th>Location ID</th>
                        <th>Name</th>
                        <th>Distance</th>
                        <th>Available</th>
                        <th>Option</th>
                    </tr>
                    <?php
                    foreach($ud as $key=> $udd) {
                        if($udd['is_available']==0){?>
                    <tr>
                        <td><id><?php echo $udd['id'];?></id></td>
                        <td><name><?php echo $udd['name'];?></name></td>
                        <td><distance><?php echo $udd['distance'];?></distance></td>
                        <td><avail><?php  if($udd['is_available']==0){echo "Unavailable";} else{echo "Available";}?></avail></td>
                        <td>
                            <!-- Icons -->
                            <a href="#" data-id="<?php echo $udd['id'];?>" class="edit"  title="Edit">Edit</a>
                            <a href="#" data-id="<?php echo $udd['id'];?>" class="delete"  title="Delete">Delete</a> 
                        </td>
                    </tr>
                    <?php }}?>
                </table>
        </div>
            <div id="total-income">
                <h3 id="heading">Add Locations</h3>
                <form action="location.php" method="POST">
                    <input type="text" name="id" id="id" value="" hidden>
                    <input type="text" id ="location" name="location" placeholder="Location Name" required>
                    <input type="text" id ="distance" name="distance" placeholder="Distance" required>
                    <select id="car"  name="active"   required>
						<option class="place" value="" disabled selected>Available</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <button href="location.php" id="add" type="submit" name="submit">Add</button>
                    <button name="update" id="update" value="Update Location">Update Location</button>
                </form>  
                <div><?php echo "<b>".$msg."</b>" ?></div>   
            </div>
        </div>
    </body>
</html>