<?php
include("databaseConn.php");
session_start();
include("highscore.php");
?>



<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!--<script src="jqCode.js"></script>-->
        <style>
        body{
            background: url(background3.jpg) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover;
        }  
        
        #header{
            margin-top:2%;
            width:100%;
            height:120px;
        }
        #SpelersNaam{
            border:solid black 1px;
            height:120px;
            width:25%;
            background-color:#d9d9d9;
            margin-left:2%;
            border-radius:25px;
            float:left;
        }
        #Speler{
            margin-left:30px;
            
            font-size:230%;
        }
        #Timer{
            width:30%;
            margin-left:10%;
            height:120px;
            
            background-color:#d9d9d9;
            float:left;
            border:solid black 2px;
        }
        
        
        #middenContainer{
            width:100%;
            margin-top:3%;
        }
        
        #HetSpel{
            margin:auto;
            width:85%;
            height:700px;
            background-color:#d9d9d9;
            border:solid black 2px;
        }
        #secondes{
            text-align:center;
            font-size:220%;
        }
        .Kaarten{
            border-radius:25px;
            border:solid 2px black;
            margin-top:2%;
            width:20%;
            float:left;
            margin-left:4%;
            height:220px;
            background-color:lightblue;
        }
        .KaartenRood{
            border-radius:25px;
            border:solid black 2px;
            margin-top:2%;
            width:20%;
            float:left;
            margin-left:4%;
            height:220px;
            background-color:#ff8080;
        }
        
        #cijfer1, #cijfer2, #cijfer3, #cijfer4{
            margin:auto;
            width:4%;
            margin-top:25%;
            font-size:220%;
        }
        #Volgende{
            border-radius:15px;
            width:25%;
            margin-left:auto;
            margin-right:auto;
            margin-top:25%;
            background-color:#ff4d4d;
            height:60px;
        }
        #text{
            border-radius:15px;
            border:solid black 2px;
            text-align:center; 
            padding:10px;
            font-size:200%;
        }
        #startGame{
            padding-top:6.5%;
            text-align:center;
            font-size:220%;
            text-align:center; 
            width:100%;
            height:100%;
        }
        #ScoreDiv{
            float:right;
            margin-right:7.5%;
            height:120px;
            width:15%;
            background-color:#d9d9d9;
            border:solid black 2px;
        }
        #score{
            
        padding-top:5px;
            padding-left:85px;
            font-size:200%;
        }
        
         #SubmitScore{
            border-radius:15px;
            width:25%;
            margin-left:auto;
            margin-right:auto;
            margin-top:25%;
            background-color:#ff4d4d;
            height:200px;
        }
        #scoreinput{
            margin-top:5%;
            width:40%;
            margin-left:auto;
            margin-right:auto;
            
        }
        #scoreButton{
            padding:5%;
            margin-left:109px;
        }
        #inputscore{
            margin:auto;
            width:100%;
            font-size:200%;
            margin-top:40%;
        }
        #highscoreP{
            font-size:200%;
            text-align:center;
        }
            
        </style>
        <title> </title>
    </head>
    <body>
        
        <?php
            if(!isset($_SESSION['nickname'])){
                header('location: template.php');   
            }
                
            
             
            
            $input = "<tr><p id='scoreinput'><input id='inputscore' disabled type='text' name='score'/></p></tr><br>";
            
        ?>
        
    <div id="maindiv">    
       <div id="header">
           <div id="SpelersNaam">
               <?php echo '<p id="Speler">Player: ' . $_SESSION['nickname'] . '</p>' ?>
           </div>
           <div id="Timer">
               <div id="startGame">Start game!</div>
               <p id="secondes"></p>
           </div>
           <div id="ScoreDiv">
               <p id="score"></p>
           </div>
       </div>
        <div id="middenContainer">
            
            <div id="HetSpel">
                <div id="kaart1" class="Kaarten">
                    <p id="cijfer1"></p>
                </div>
                <div id="kaart2" class="Kaarten">
                    <p id="cijfer2"></p>
                </div>
                <div id="kaart3" class="Kaarten">
                    <p id="cijfer3"></p>
                </div>
                <div id="kaart4" class="Kaarten">
                    <p id="cijfer4"></p>
                </div>
                
                <div id="SubmitScore">
                    <table>
                        <p id="highscoreP">Your current highscore is: <?php echo $DatabaseHighscore;?>.</p>
                         <form>
                             
                             <tr><p><input id="scoreButton" type="button" value="" name="submitbutton"/></p></tr>
                         </form>
                    </table>     
                </div>
                
                <div id="Volgende">
                    <p id="text">click to choose answer</p>
                </div>
                
                
            </div>
        </div>
    </div>    
        
        <script>
            $(document).ready(function(){
                
                
        var verderkclick = false;        
        var Answer = "";
        var i = 30;
        var BlauwOfRood1 = 0;         
        var BlauwOfRood2 = 0;        
        var score = 0; 
        var plus = 5;
        var minus = 1;
        var checker = false;        
        var timechecker = false;        
                
            document.getElementById("scoreButton").value = "Change highscore to: " + score;
                $("#SubmitScore").hide(); 
                
                
                
              
                $("#scoreButton").click(function() {
                    
                    
                    
                    var postscore = score;
                    
                
                    $.post('highscore.php', {highscorepost:postscore}, function(data){
                        $("#highscoreP").html("Your current highscore: " + data + '.');
                    });
                });
                
                
                
         function stop(){
             document.getElementById("scoreButton").value = "Change highscore to: " + score;
             if(BlauwOfRood1 == 1){
                $("#kaart2").removeClass("KaartenRood").addClass("Kaarten");
                    
               }else if(BlauwOfRood2 == 1){
                    $("#kaart3").removeClass("KaartenRood").addClass("Kaarten");    
               }
             
            
            
            checker = false;
            timechecker = true;
            
            i=0;                
            $("#Volgende").hide();     
            $("#SubmitScore").show();
                            var cijfer1 = document.getElementById("cijfer1").value = '';
                            var cijfer2 = document.getElementById("cijfer2").value = '';
                            var cijfer3 = document.getElementById("cijfer3").value = '';
                            var cijfer4 = document.getElementById("cijfer4").value = '';
        
                            document.getElementById("cijfer1").innerHTML = '';
                            document.getElementById("cijfer2").innerHTML = '';
                            document.getElementById("cijfer3").innerHTML = '';
                            document.getElementById("cijfer4").innerHTML = '';
        
                            verderkclick = false;
                    
                    
                    
                    $("#secondes").hide();
                    $("#startGame").show();
                    
        }
               
                
                function reset(){
                    if(BlauwOfRood1 == 1){
                        $("#kaart2").removeClass("KaartenRood").addClass("Kaarten");
                    
                    }else if(BlauwOfRood2 == 1){
                        $("#kaart3").removeClass("KaartenRood").addClass("Kaarten");    
                    }
                     
        var cijfer1 = document.getElementById("cijfer1").value = '';
        var cijfer2 = document.getElementById("cijfer2").value = '';
        var cijfer3 = document.getElementById("cijfer3").value = '';
        var cijfer4 = document.getElementById("cijfer4").value = '';
        
        document.getElementById("cijfer1").innerHTML = '';
        document.getElementById("cijfer2").innerHTML = '';
        document.getElementById("cijfer3").innerHTML = '';
        document.getElementById("cijfer4").innerHTML = '';
        
            
         verderkclick = false;    
        plus = 5;
        minus = minus + 1;
        timechecker = true;
        start();
                }
                
        
                
                
                
                
        var cijfer1 = document.getElementById("cijfer1").value;
        var cijfer2 = document.getElementById("cijfer2").value;
        var cijfer3 = document.getElementById("cijfer3").value;
        var cijfer4 = document.getElementById("cijfer4").value;
                
                
        
            $("#Volgende").hide();
            document.getElementById("score").innerHTML = 'Score: ' + score;
             
        function start(){        
                
                $("#Volgende").show();
                
            var RandomCijfer1 = Math.round(Math.random()* 8) + 1;    
            var RandomCijfer2 = Math.round(Math.random()* 8) + 1;
            var RandomCijfer3 = Math.round(Math.random()* 8) + 1;
            var RandomCijfer4 = Math.round(Math.random()* 8) + 1;
            
    
             BlauwOfRood1 = Math.round(Math.random()* 2) + 1;
             BlauwOfRood2 = Math.round(Math.random()* 2) + 1;
                
                
                
                
            if(BlauwOfRood1 == 1){
                Answer = RandomCijfer1 - RandomCijfer2 + RandomCijfer3 + RandomCijfer4;
                $("#kaart2").removeClass("Kaarten").addClass("KaartenRood");
            }else if(BlauwOfRood2 == 1){
                Answer = RandomCijfer1 + RandomCijfer2 - RandomCijfer3 + RandomCijfer4;
                $("#kaart3").removeClass("Kaarten").addClass("KaartenRood");
            }else if(BlauwOfRood2 == 1 && BlauwOfRood1 == 1){
                Answer = RandomCijfer1 - RandomCijfer2 - RandomCijfer3 + RandomCijfer4;
            }else{
                Answer = RandomCijfer1 + RandomCijfer2 + RandomCijfer3 + RandomCijfer4;
            }
                
            
                
                
                document.getElementById("cijfer1").innerHTML = RandomCijfer1;
                document.getElementById("cijfer2").innerHTML = RandomCijfer2;
                document.getElementById("cijfer3").innerHTML = RandomCijfer3;
                document.getElementById("cijfer4").innerHTML = RandomCijfer4;
            }     
             
                
        $("#startGame").click(function(){
            
            $("#SubmitScore").hide();
            
            score=0;
            document.getElementById("score").innerHTML = "Score: " + score;
            
            
            document.getElementById("secondes").innerHTML = "Time left: " + i;
            verderkclick = false;
        
        if(timechecker){
            minus = 1;
            i=30;
            var counter = setInterval(timer,1000);
            start();
        }else{
            minus = 1;
            clearInterval(counter);
            i=30;
            checker = true;
            start();
        }    
            
            
            timechecker = false;
            $("#Volgende").show();
               
               $("#secondes").show();
            $("#Volgende").show();
            $("#startGame").hide();
            
            
            
         if(checker){
            
            
             document.getElementById("secondes").innerHTML = "Time left: " + i;
           var counter = setInterval(timer,1000); 
           
         }    
           
            function timer(){
                        document.getElementById("secondes").innerHTML = "Time left: " +  i;
                       
           
                        
                        
                    if (i <= 0){
                        
                    clearInterval(counter);
                    
                    stop();
                        } else{
                    
                    i=i-1;
                    document.getElementById("secondes").innerHTML="Time left: " + i;    

                }

}
        }); 
        
        $("#Volgende").click(function(){
            
            if(BlauwOfRood1 == 1){
                    $("#kaart2").removeClass("KaartenRood").addClass("Kaarten");        
            }else if(BlauwOfRood2 == 1){
                    $("#kaart3").removeClass("KaartenRood").addClass("Kaarten");    
            }else if(BlauwOfRood2 == 1 && BlauwOfRood1 == 1){
                    $("#kaart2").removeClass("KaartenRood").addClass("Kaarten"); 
                    $("#kaart3").removeClass("KaartenRood").addClass("Kaarten");
                }
            
            
            
            $("#Volgende").hide();

            var RandomKaart = Math.round(Math.random()* 3) + 1;
            
            var Random1 = Math.round(Math.random()* 30) + 4;
            var Random2 = Math.round(Math.random()* 30) + 4;
            var Random3 = Math.round(Math.random()* 30) + 4;
            var RandomOverig = Math.round(Math.random()* 30) + 4;
            
        function Case1 (){
            document.getElementById("cijfer1").innerHTML = Answer;
            document.getElementById("cijfer2").innerHTML = Random1;
            document.getElementById("cijfer3").innerHTML = Random2;
            document.getElementById("cijfer4").innerHTML = Random3;
            
            document.getElementById("cijfer1").value = Answer;
            document.getElementById("cijfer2").value = Random1;
            document.getElementById("cijfer3").value = Random2;
            document.getElementById("cijfer4").value = Random3;
            
            if(Random1 === Answer){
                document.getElementById("cijfer2").innerHTML = RandomOverig;
            }else if(Random2 === Answer){
                document.getElementById("cijfer3").innerHTML = RandomOverig;
            }else if(Random3 === Answer ){
                document.getElementById("cijfer4").innerHTML = RandomOverig;
            }
         cijfer1 = document.getElementById("cijfer1").value;
         cijfer2 = document.getElementById("cijfer2").value;
         cijfer3 = document.getElementById("cijfer3").value;
         cijfer4 = document.getElementById("cijfer4").value;
         
         verderkclick = true;
        }
        function Case2(){
            document.getElementById("cijfer2").innerHTML = Answer;
            document.getElementById("cijfer1").innerHTML = Random1;
            document.getElementById("cijfer3").innerHTML = Random2;
            document.getElementById("cijfer4").innerHTML = Random3;
            
            document.getElementById("cijfer2").value = Answer;
            document.getElementById("cijfer1").value = Random1;
            document.getElementById("cijfer3").value = Random2;
            document.getElementById("cijfer4").value = Random3;
            
            if(Random1 === Answer){
                document.getElementById("cijfer1").innerHTML = RandomOverig;
            }else if(Random2 === Answer){
                document.getElementById("cijfer3").innerHTML = RandomOverig;
            }else if(Random3 === Answer ){
                document.getElementById("cijfer4").innerHTML = RandomOverig;
            }
         cijfer1 = document.getElementById("cijfer1").value;
         cijfer2 = document.getElementById("cijfer2").value;
         cijfer3 = document.getElementById("cijfer3").value;
         cijfer4 = document.getElementById("cijfer4").value;
         
         verderkclick = true;
        }
        function Case3(){
            document.getElementById("cijfer3").innerHTML = Answer;
            document.getElementById("cijfer2").innerHTML = Random1;
            document.getElementById("cijfer1").innerHTML = Random2;
            document.getElementById("cijfer4").innerHTML = Random3;
            
            document.getElementById("cijfer3").value = Answer;
            document.getElementById("cijfer2").value = Random1;
            document.getElementById("cijfer1").value = Random2;
            document.getElementById("cijfer4").value = Random3;
            
            if(Random1 === Answer){
                document.getElementById("cijfer2").innerHTML = RandomOverig;
            }else if(Random2 === Answer){
                document.getElementById("cijfer1").innerHTML = RandomOverig;
            }else if(Random3 === Answer ){
                document.getElementById("cijfer4").innerHTML = RandomOverig;
            }
         cijfer1 = document.getElementById("cijfer1").value;
         cijfer2 = document.getElementById("cijfer2").value;
         cijfer3 = document.getElementById("cijfer3").value;
         cijfer4 = document.getElementById("cijfer4").value;
         
         verderkclick = true;
        }
        function Case4(){
            document.getElementById("cijfer4").innerHTML = Answer;
            document.getElementById("cijfer2").innerHTML = Random1;
            document.getElementById("cijfer1").innerHTML = Random2;
            document.getElementById("cijfer3").innerHTML = Random3;
            
            
            document.getElementById("cijfer4").value = Answer;
            document.getElementById("cijfer2").value = Random1;
            document.getElementById("cijfer1").value = Random2;
            document.getElementById("cijfer3").value = Random3;
            
            if(Random1 === Answer){
                document.getElementById("cijfer2").innerHTML = RandomOverig;
            }else if(Random2 === Answer){
                document.getElementById("cijfer3").innerHTML = RandomOverig;
            }else if(Random3 === Answer ){
                document.getElementById("cijfer1").innerHTML = RandomOverig;
            }
         cijfer1 = document.getElementById("cijfer1").value;
         cijfer2 = document.getElementById("cijfer2").value;
         cijfer3 = document.getElementById("cijfer3").value;
         cijfer4 = document.getElementById("cijfer4").value;
         
         verderkclick = true;
        }
        
        switch(RandomKaart){
            case 1 : Case1();
            break;
            case 2 : Case2();
            break;
            case 3 : Case3();
            break;
            case 4 : Case4();
        }
        
        
       
        
        
       
       
      
       
       
    });        
     
     
       
     
      $("#kaart1").click(function(){
          
          
        if(verderkclick){   
            if(Answer == cijfer1){
                score += plus;
                document.getElementById("score").innerHTML = "Score: " + score;
                
                verderkclick = false;
                reset();
            }else{
                score -= minus;
                document.getElementById("score").innerHTML = "Score: " + score;
                 if(score < 0){
           
           
           stop();
                 }
            }
        }  
           
            
        });

         $("#kaart2").click(function(){
        
        if(verderkclick){   
           if(Answer == cijfer2){
               score += plus;
               document.getElementById("score").innerHTML = "Score: " + score;
               
               verderkclick = false;
               reset();
           }else{
               score -= minus;
               document.getElementById("score").innerHTML = "Score: " + score;
                if(score < 0){
           
           stop();
           
       }
           }
        }   
            
        });
        
        $("#kaart3").click(function(){
        if(verderkclick){   
           if(Answer == cijfer3){
               score += plus;
               document.getElementById("score").innerHTML = "Score: " + score;
               verderkclick = false;
               
               reset();
           }else{
               score -= minus;
               
               document.getElementById("score").innerHTML = "Score: " + score;
                if(score < 0){
           
           stop();
           
       }
           }
        }   
            
        });
       
        $("#kaart4").click(function(){
        if(verderkclick){   
           if(Answer == cijfer4){
               score += plus;
               document.getElementById("score").innerHTML = "Score: " + score;
               verderkclick = false;
              
               reset();
           }else{
              
               document.getElementById("score").innerHTML = "Score: " + score;
               score -= minus;
                if(score < 0){
           
           stop();
           
              }
           }
        }   
            
        });
     
     
     
        
         
        
      
    });  
            
        </script>
        
    </body>
</html>