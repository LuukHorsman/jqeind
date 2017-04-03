<?php
include("databaseConn.php");
session_start();
?>



<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background: url(background3.jpg) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover;
            }
            
            #loginScherm{
                background-color:#d9d9d9;
                opacity:0.95;
                border:black solid 2px;
                margin-top:300px;
                height:330px;
                width:25%;
                margin-right:auto;
                margin-left:auto;
                border-radius:25px;
            }
            #userName, #wachtWoord{
                font-size:150%;
                padding:10px;
                height:25px;
                border-radius:10px;
                width:100%;
                margin:auto;
            }
            #loginScherm p, #Button {
                
                margin-top:3%;
            }
            #plaatje{
                z-index:2;
                opacity:0.5;
            }
              input:focus {
                outline:none;
            }
        #ButtonR{
                background-color:#b3b3ff;
                padding:20px;
                font-size:100%;
                border-radius:25px;
                border:solid black 1px;
                margin-top:5%;
            }
        #ButtonI{
                background-color:#b3b3ff;
                padding:20px;
                font-size:100%;
                border-radius:25px;
                border:solid black 1px;
                margin-top:5%;
                float:right;
            }    
        #midden{
            width:50%;
            margin:auto;
        }
        #error{
            text-align:center;
            color:red;
            width:100%;
        }
        
        
        </style>
        <title> </title>
    </head>
    <body>
        <?php
            $Email = $_SESSION['email'];
        if(isset($_SESSION['email'])){
         
         $error = 'session is dood'; 
         
         $Time = getdate();
         
         $AmsterdamTime = $Time["hours"] + 2;
         
         $TimeInsert = $Time["mday"] . "/" . $Time["mon"] . "/" . $Time["year"] . " " . $Time["hours"] . " (Hours) " . $Time["minutes"] . " (Minutes) " . $Time["seconds"] . " (Seconds) ";
         
         $sqlCode = "UPDATE gebruiker SET logout_time = '$TimeInsert' WHERE email= '$Email'";
         
         mysqli_query($conn, $sqlCode);
         
         session_destroy();
        }
            
            
            // $conn = new mysqli('localhost', 'luukhorsman', '', 'c9');
            $error = '';
            $goedmelding = '';
            if(isset($_POST['registreren'])){
                header('location: register.php');
            }
            
            
            
            if(isset($_POST['email']) && isset($_POST['Password'])){
                    
                    $Email = $_POST['email'];
                    $Password = md5($_POST['Password']);
                $checkIfRight = "SELECT * FROM gebruiker WHERE email = '" . $Email . "' AND password = '" . $Password . "' ";
                $login = mysqli_query($conn, $checkIfRight);
                    if(mysqli_num_rows($login) == 0){
                        $error = "Your password does not fit this E-mail adress, please try again.";
                    }else{
                        if(isset($_POST['inloggen'])){
                            $_SESSION['email'] = $_POST['email'];
                            header('location: Homepage.php');
                        }
                    }
                }
                
                
                
            
            
        ?>
        
        <div id="loginScherm">
            <div id="midden">
            <form method="post">
                <br><br>
                <input id="userName" name="email" placeholder="E-mail">
                <br><br><br>
                <input id="wachtWoord" type="password" name="Password" placeholder="Password">
                <br><br>
                <input id="ButtonR"  value="Login"  type="submit" name="inloggen"/>
                <input id="ButtonI" value="Register" name="registreren" type="submit"/>
                
                <br><br>
               
            </form>
            
            </div>
             <p><?php echo '<p id="error">' . $error . '</p>'; ?></p>
        </div>
        
        
        
    
        
        
    </body>
</html>