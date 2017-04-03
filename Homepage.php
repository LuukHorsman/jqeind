<?php
session_start();
include("databaseConn.php");

if(!isset($_SESSION['email'])){
    header("location: template.php");
}
     
     
     
    
    if(isset($_POST['Logout'])){
        session_destroy();
        header("location: template.php");
    }
    
    
    
    $email = $_SESSION['email'];
    
    $query = "SELECT * FROM gebruiker WHERE email = '$email'";
    
    $result = mysqli_query($conn, $query);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $ShowNickname = $row['nickname'];
            $_SESSION['nickname'] = $row['nickname'];
            
            $ShowLogoutTime = '<div id="LastLogin"> Last logged in: ' . $row['Logout_time'] . '</div>';
            
        }
    }
    
    
    if(isset($_POST['oefenen'])){
        header("location: oefenen.php");
    }
    if(isset($_POST['wedstrijd'])){
        header("location: wedstrijd.php");
    }
    if(isset($_POST['highscores'])){
        header("location: highscorepage.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                height: 100%;
                background: url(background3.jpg) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover;
            }
          
            #keuzediv{
                border:solid black 2px;
                border-radius:25px;
                margin:auto;
                margin-top:6%;
                background-color:#d9d9d9;
                width:60%;
                height:350px;
            }
            #Obutton{
                border-radius:20px;
                font-size:150%;
                height:150px;
                margin-top:4%;
                margin-left:5%;
                padding:40px;
                width:35%;
                float:left;
                background-color:blue;
            }
            #Wbutton{
                border-radius:20px;
                font-size:150%;
                height:150px;
                margin-top:4%;
                margin-right:5%;
                padding:40px;
                width:35%;
                float:right;
                background-color:red;
            }
            #Hbutton{
                margin-left:1%;
                border-radius:20px;
                font-size:150%;
                height:150px;
                margin-top:1%;
                padding:40px;
                background-color:yellow;
            }
            #Keuze{
                text-align:center;
                font-size:125%;
            }
            #uitleg{
                border:solid black 2px;
                border-radius:25px;
                width:75%;
                background-color:#d9d9d9;
                margin:auto;
                height:500px;
                margin-top:5%;
            }
            #HowTo{
                font-size:200%;
                text-align:center;
            }
            input:focus {
                outline:none;
            }
            #footer{
                width:100%;
                height:150px;
                background-color:#d9d9d9;
                border:solid black 2px;
                /*margin-top:5%;*/
            }
            #LastLogin{
                float:left;
                margin-left:20%;
                border-radius:25px;
                background-color:#d9d9d9;
                width:20%;
                height:40px;
                text-align:center;
                padding-top:15px;
            }
            #HeaderContainer{
                width:100%;
                height:40px;
            }  
            #welkom{
                margin:auto;
                border:solid black 1px;
                border-radius:25px;
                background-color:#d9d9d9;
                font-size:150%;
                width:20%;
                height:40px;
                text-align:center;
                padding-top:20px;
            }
            .middle{
                text-align:center;
            }
            
        </style>
        <title> </title>
    </head>
    <body>
        
        <div id="HeaderContainer">
            <div id="welkom">
            Welkom back, 
            <?php
                echo $ShowNickname;
            ?>
            </div>
            
        </div>
        
        <div id="keuzediv">
            <form method="post">
                <p id="Keuze">What do you want to do?</p>
                <input id="Obutton" value="practice" type="submit" name="oefenen"/>
                <input id="Wbutton" value="Game" type="submit" name="wedstrijd"/><br><br>
                <input id="Hbutton" value="highscores" type="submit" name="highscores"/>
            </form>
        </div>
            
        <div id="uitleg">
            <p id="HowTo">How to play Card Calculations. (CC)</p>
            <p class="middle">If you start the game you'll see 4 cards with random numbers between 1 and 9. You get about 30 seconds to get the highest score you can get.</p>
            <p class="middle">If the card is blue, you will have to sum it up and if the card is red you will have to subtract from the card before it.</p>
            <p class="middle">When you are ready to choose a answer, just click the "Click to choose answer" button. If you do that you will see 4 cards and one of them has the answer. Click on the card with the right answer to get 5 points, if it is the wrong answer you'll lose points depending on how many right answers you already have.</p>
            <p class="middle">If the timer is 0 or you have less then 0 points you get a promt to change your highscore, if your highscore is higher then the last time you should update it by clicking the button "Change highscore to: *your highscore*."</p>
            <p class="middle">If your highscore is lower you shouldn't do that of course and you should click "start game" to try and break your record/highscore.</p>
            <p class="middle">Have fun playing!</p>
        </div>    
            
            
    </body>
</html>



