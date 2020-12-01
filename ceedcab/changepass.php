<?php
    session_start();
    include "dbc.php";
    include "uci.php";
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
?>
<!DOCTYPE html>
<html lang="zxx">
	<head>
        <title>OSLO Template</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="style.css">
		<script>
            $(document).ready(function(){
                
                $("#<?php echo $ud['user_id']?>result").click(function(){	
                    var name="<?php echo $ud['name']?>";
                    var mob= "<?php echo $ud['mobile']?>";
                    var password= document.getElementById("cpassword").value;
                    var newpassword= document.getElementById("newpassword").value;
                    var renewpassword= document.getElementById("renewpassword").value;
                    var user_id=<?php echo $ud['user_id']?>;
                    if(newpassword==renewpassword){
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{name:name , mobile:mob , password:password, newpassword:newpassword, action:"update",user_id:user_id },
                        success: function(result){
                            $("#message").html("Password Changed");
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                    }
                    else{
                        $("#message").html("Entered password not same");
                    }
                });
            });
        </script>
    </head>
    <body>
       <?php include "indexheader.php";?>
		<!-- Fare Calculator-->
		<div class="jumbotron">
		<div id="userdetails">
            <p>Change Password:</p>  
            <input type='text' id='cpassword' placeholder='Current password' value=''> <br>
            <input type='text' placeholder='New password' id='newpassword' value=''><br>
            <input type='text' placeholder='Re Enter New password' id='renewpassword' value=''><br>
            <a class="btn cyan " id="<?php echo $ud['user_id']?>result" href="#">Update</a>    
                <div id="message"></div>
					
                </div>
        </div>
		<!-- Footer -->
		<footer class="page-footer font-small cyan darken-3 fixed-bottom">

			
			<div class="container">

			
			<div class="row">

				
				<div class="col-md-12 py-4">
				<div class="mb-5 flex-center">
					<a class="fb-ic">
					<i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!-- Twitter -->
					<a class="tw-ic">
					<i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!-- Google +-->
					<a class="gplus-ic">
					<i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Linkedin -->
					<a class="li-ic">
					<i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Instagram-->
					<a class="ins-ic">
					<i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Pinterest-->
					<a class="pin-ic">
					<i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
					</a>
				</div>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row-->

			</div>
			<!-- Footer Elements -->

			<!-- Copyright -->
			<div class="footer-copyright text-center ">© 2020 Copyright:
			<a href="#"> CEDCAB PVT.LTD.</a>
			</div>
			<!-- Copyright -->

		</footer>
	</body>
	</html>    