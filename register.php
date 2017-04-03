<?php
session_start();
include("databaseConn.php");
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
                border:black solid 2px;
                margin-top:200px;
                height:500px;
                width:30%;
                margin-right:auto;
                margin-left:auto;
                background-color:#d9d9d9;
                border-radius:25px;
                opacity:0.95;
            }
            #userName, #wachtWoord ,#wachtwoordHerhalen, #NickName{
                border:solid black 1px;
                font-size:150%;
                padding:10px;
                height:25px;
                border-radius:10px;
                width:40%;
                margin-left:27.5%;
            }
            #loginScherm p, #Button {
                margin-left:30%;
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
                margin-left:28%;
                
            }
        #ButtonI{
                background-color:#b3b3ff;
                padding:20px;
                font-size:100%;
                border-radius:25px;
                border:solid black 1px;
                margin-top:5%;
                float:right;
                margin-right:28%;
        } 
            #foutmelding{
                color:red;
                margin:auto;
            }
            #goedmelding{
                color:#00cc00;
                margin:auto;
            }
        </style>
        <title> </title>
    </head>
    <body>
        <?php
            
            if(isset($_POST['inloggen'])){
                header('location: template.php');
            }
            
            $conn = new mysqli('localhost', 'luukhorsman', '', 'c9');
            $error = "<br><br>";
            $melding = '';
        if(isset($_POST['email'])){
                $Password = md5($_POST['Password']);
                $PasswordRE = md5($_POST['repeatPassword']);
                    if(strlen($_POST['Nickname']) < 4){
                        $error = '<p id="foutmelding">Your nickname is too short(min:4)';
                    }elseif(strlen($_POST['Nickname']) > 20){
                        $error = '<p id="foutmelding">Your nickname is too long (max:20)';
                    }else{
                        $nickName = $_POST['Nickname'];
                            $checkDoubleNick = "SELECT * FROM gebruiker WHERE nickname = '$nickName'";
                            $DoubleNick = mysqli_query($conn, $checkDoubleNick);
                            if(mysqli_num_rows($DoubleNick) != 0){
                                $error = '<p id="foutmelding">This Nickname is used already!';
                            }else{
                   
                        if($Password == $PasswordRE){
                             if(empty($Password)){
                            $error = '<p id="foutmelding">You have not filled in a password!</p>';
                        }else{
                            if(strlen($Password) < 4){
                                $error = '<p id="foutmelding">Your password is too small!(min:4)'; 
                            }else{
                        
                            $Email = $_POST['email'];
                            $Email = filter_var($Email, FILTER_SANITIZE_EMAIL);
                    
                         if(!filter_var($Email, FILTER_VALIDATE_EMAIL) === false){
                                    $checkDouble = "SELECT * FROM gebruiker WHERE email = '".$Email."'";
                                    $result = mysqli_query($conn, $checkDouble);
                                if(mysqli_num_rows($result) !=0){
                                    $error = '<p id="foutmelding">This Email is already in use.';
                                }else{
                                    $sql = "INSERT INTO gebruiker (nickname, email, password) VALUES ('$nickName', '$Email', '$Password')";
                                        mysqli_query($conn, $sql);
                                        $error = '<p id="goedmelding">You have been successfully registered!</p>';
                                    }
                                }else{
                                $error = '<p id="foutmelding">This Email is not valid!</p>';
                            }
                        }    
                    }
                }else{
                     $error = '<p id="foutmelding">The passwords do not match</p>';      
            }
        }    
    }
}    
    
    
    
    
        ?>
        
        <div id="loginScherm">
            
            <form method="post" id="loginForm">
                <br><br>
                <input id="userName" name="email" placeholder="E-mail">
                <br><br><br>
                <input id="NickName" placeholder="Nickname" type="text" name="Nickname"/>
                <br><br><br>
                <input id="wachtWoord" type="password" name="Password" placeholder="Password">
                <br><br><br>
                <input id="wachtwoordHerhalen" type="password" name="repeatPassword"  placeholder="Repeat password" />
                <br><br>
                
                <input id="ButtonI" value="Login" name="inloggen" type="submit"/>
                <input id="ButtonR"  value="Register"  type="submit" name="registreren"/>
                
                <?php echo $error; echo $melding; ?>
            </form>
        </div>
        
        
        
    
        
        
    </body>
</html>