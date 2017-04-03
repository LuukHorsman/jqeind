<?php
session_start();
include("databaseConn.php");

$highscore = $_POST['highscorepost'];
$gebruiker = $_SESSION['nickname'];

$query = "UPDATE gebruiker SET Highscore = $highscore WHERE nickname = '$gebruiker'";


mysqli_query($conn, $query);


 $nickname = $_SESSION['nickname'];
                            
                            $sql="SELECT * FROM gebruiker WHERE nickname = '$nickname'";
                            
                            
                            
                $result=mysqli_query($conn,$sql);
                
                $row = mysqli_fetch_assoc($result);
                
        echo $DatabaseHighscore = $row['Highscore'];


?>