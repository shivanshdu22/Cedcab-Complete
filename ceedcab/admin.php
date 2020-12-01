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
                $("#<?php echo $ud['user_id']?>result").hide();
                $("#<?php echo $ud['user_id']?>").click(function(){	
                    $("#Name").html("<input type='text' id='<?php echo $ud['name']?>'value='<?php echo $ud['name']?>'>");
                    $("#mobile").html("<input type='number' id='<?php echo $ud['mobile']?>'value='<?php echo $ud['mobile']?>'>");
                    $("#password").html("Password : <input type='text' id='cpassword' placeholder='current password' value=''> <input type='text' placeholder='New password' id='newpassword' value=''>");
                    $("#<?php echo $ud['user_id']?>result").show();
                    $("#<?php echo $ud['user_id']?>").hide();
                });
                $("#<?php echo $ud['user_id']?>result").click(function(){	
                    var name=document.getElementById("<?php echo $ud['name']?>").value;
                    var mob= document.getElementById("<?php echo $ud['mobile']?>").value;
                    var password= document.getElementById("cpassword").value;
                    var newpassword= document.getElementById("newpassword").value;
                    var user_id=<?php echo $ud['user_id']?>;
                    
                   if(name==""||mob==""){
                    $("#message").html("<strong>Name or Mobile Number can't be empty</strong>");
                   }
                   else{
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{name:name , mobile:mob , password:password, newpassword:newpassword, action:"update",user_id:user_id },
                        success: function(result){
                            location.reload();
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                   }
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
            <div id="toprow">    
                <a href="Incomedata.php"><div id="left">
                <p id="value"><h1><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_fare'];}} echo "Rs. ".$u;?></h1></p> 
                Total Income till today<br>    
                <img class="incomepie" src="bar.png" alt="Logo" >
                    <strong>View Income Data</strong>
                </div></a>
                <a href="locationtrend.php"><div id="center">
                    <img class="pie" src="taxi.png"  alt="Logo" ><br>
                   <strong> Location Trends</strong>
                </div></a>         
                <a href="location.php"><div href="#" id="right">
                    <p id="value"><h1><?php $u=0; foreach($ld as $key=>$rdd){ if($rdd['is_available']==1){$u+=1;}} echo $u;?></h1></p>    
                    <img class="incomepie" src="loc.png" alt="Logo" ><br>
                    <strong>Total Locations We Offer </strong>
                </div> </a>
            </div>    
            <div id="ceneterrow">  
                <a href="allpending.php"><div id="left">
                    <p id="value"><h1><?php $i=0; foreach($rd as $key=>$rdd){ if($rdd['status']==1){$i+=1;}} echo $i;?></h1></p>
                    <img class="incomepie" src="pending.png" alt="Logo" ><br>
                    <strong>Pending Rides </strong>
                </div></a>
                <a href="pendinguser.php"><div id="center">
                    <p id="value"><h1><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['is_block']==1){$u+=1;}} echo $u;?></h1></p>
                    <img class="incomepie" src="pendinguser.png" alt="Logo" ><br>
                    <strong>Pending Users </strong>
                </div>  </a>       
                <a href="userbase.php"><div id="right">
                    <p id="value"><h1><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['isAdmin']==0&&$rdd['is_block']==0){$u+=1;}} echo $u;?></h1></p>
                    <img class="incomepie" src="userbase.png" alt="Logo" ><br>
                    <strong>User Base </strong>
                </div> </a>
            </div>   
            <div id="bottomrow">    
                <div id="left">
                <p id="value"><h1><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['Date_of_signup']==date("Y/m/d")){$u+=1;}} echo $u;?></h1></p>
                <img class="incomepie" src="sign.png" alt="Logo" ><br>
                <strong>Number of Signup's today  </strong>  
                </div>  
                <div id="center">
                    <p id="value"><h2><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_distance'];}} echo $u." KM";?></h2></p>
                    <img class="incomepie" src="dis.png" alt="Logo" ><br>
                    <strong>Total Distance We've Travel </strong>
                </div>        
                <div id="right">
                    <p id="value"><h1><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=1;}} echo $u;?></h1></p>
                    <img class="incomepie" src="todayride.png" alt="Logo" ><br>
                    <strong>Total Rides Till today </strong>
                </div> 
            </div>     
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>