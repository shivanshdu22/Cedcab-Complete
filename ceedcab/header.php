<header>
    <?php session_start();
    if(isset($_SESSION['userdata']) && $_SESSION['userdata']['isAdmin']==1){ 
    ?>
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
                <li><a href="account.php">ACCOUNT</a></li>
            </ul>
        </header>
        <?php } else {  header('Location:signout.php'); } ?>
       
              