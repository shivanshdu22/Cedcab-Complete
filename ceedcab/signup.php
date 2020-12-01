<?php
    include "dbc.php";
    include "uci.php";
    $error= array();
    $msg="";
    if(isset($_POST["submit"])){
        $username=isset($_POST['username'])?$_POST['username']:'';
        $name=isset($_POST['name'])?$_POST['name']:'';
        $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
		$pass=isset($_POST['password'])?$_POST['password']:'';
        $pass2=isset($_POST['password2'])?$_POST['password2']:'';
        if($pass!=$pass2){
           $msg='Password does not match';
        }
		else{
            $user= new User();
            $msg=$user->register($username,$name,$mobile,$pass);
            unset($_POST["submit"]);
        }
    }    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <link rel="stylesheet" href="signstyle.css">
        <script>
            
            $(document).ready(function(){
                /*$("#sign-up").click(function(e) {
    			    e.preventDefault();
                });
                $("#sign-up").click(function(){		
                    var username = document.getElementById("username").value;
                    var name = document.getElementById("name").value;
                    var mobile= document.getElementById("mobile").value;
                    var password = document.getElementById("password").value;
                    console.log(mobile);
                    if(mobile.length<10 || mobile.length>10 ){
                        $("#val").html("<strong><h6>Mobile Number must be off 10 digits</h6><strong>");
                    }
                    else{
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{username:username , name:name , mobile:mobile , password:password },
                            success: function(result){
                                $("#fare").html(result);
                            },
                            error:function(){
                                alert ('error');
                            }
                        });
                    }	
                });*/
        	}); 
		
        </script>    
    </head>
    <body>
        
        <form action="signup.php" method="POST" class="login-form" >
            <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" >
            <h1><sign-up>SIGN UP</sign-up></h1>
            <div class="form-input-material">
                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off"  required />
            </div>
            <div class="form-input-material">
                <input type="text" name="name" id="name" placeholder="Name" autocomplete="off"  required />
            </div>
            <div class="form-input-material">
                <input type="number" name="mobile" id="mobile" maxlength = "10" minlength = "10" placeholder="Mobile" autocomplete="off"  required />
            </div>
            <div class="form-input-material">
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off"  required />
            </div>
            <div class="form-input-material">
                <input type="password" name="password2" id="password" placeholder="Re-Password" autocomplete="off"  required />
            </div>
            <button type="submit" name="submit" id="sign-up" class="btn btn-primary btn-ghost">Sign Up</button>
            <a>OR</a>
            <a href="login.php" id="login" class="btn btn-primary btn-ghost">Login</a>
            <a>OR<a>
            <a  class="btn btn-primary btn-ghost" href="index.php">Back To Main Page</a>
            <div id="val" class="pt-3 cyan-text"><?php echo "<b>".$msg."</b>" ?></div>
        </form>
        
    </body>
</html>            