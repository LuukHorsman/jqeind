<?php
    include("databaseConn.php");
    
    
?>


<!DOCTYPE html>
<html>
    <head>
        <style>
            #contentdiv{
                width:80%;
                margin:auto;
                height:auto;
                background-color:#d9d9d9;
            }
            #header{
                /*float:left;*/
                text-align:center;
                font-size:300%;
            }
            #scoretable{
                
                margin:auto;
                border-collapse: collapse;
            }
            th{
                padding-left:100px;
                padding-right:100px;
                font-size:150%;
                padding-top:30px;
                padding-bottom:30px;
                border:solid black 2px;
                margin-left:30px;
            }
            td{
                padding-top:10px;
                padding-bottom:10px;
                text-align:center;
                font-size:125%;
                border:solid black 2px;
            }
            #height{
                height:150px;
                background-color:#d9d9d9;
                width:80%;
                margin:auto;
            }
            #goback{
                background-color:#c0d8d8;
                border:solid black 1px;
                padding:10px;
                float:left;
            }
            
        </style>
        <title> </title>
        
        <?php
            if(isset($_POST['goback'])){
                header("location: Homepage.php");
            }
            
            
        ?>
    </head>
    <body>
        
        <div id="contentdiv">        
        <form method="post">
                <input id="goback" value="Homepage" type="submit" name="goback"/>
        </form>
            <p id="header">Highscores</p>
            
            <div id="highscoretable">
                <table id="scoretable">
                    <tr>
                        <th>Rank</th>
                        <th>Nickname</th>
                        <th>Score</th>
                    </tr>
                    <?php
                        
                        $query = "SELECT * FROM gebruiker ORDER BY Highscore DESC";
                        
                        mysqli_query($conn, $query);
                        
                    if ($result = $conn->query($query)) {
                        $i=0;
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                                echo "<tr><td>" . $i . "</td><td>" . $row['nickname'] . "</td><td>" . $row['Highscore'] . "</td></tr>"; 
                        }
                    }   
                    
                        
                        
                        
                        
                    ?>
                </table>
                <div id="height">
            
                </div>
            </div>
            
        </div>
        
        
        
        
    </body>
</html>