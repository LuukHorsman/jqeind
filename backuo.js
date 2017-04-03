        $("#kaart1").click(function(){
             
           if(RandomKaart === 1){;
            score = score + plus;
              document.getElementById("score").innerHTML = 'Score: ' + score;
               console.log(score);
               console.log("goed geantwoord");
               
               RandomKaart = Math.round(Math.random()* 3) + 1;
               
               
               start();
               $("#Volgende").show();
           }else{
               console.log("fout geantwoord");
               score = score - minus;
               document.getElementById("score").innerHTML = 'Score: ' + score;
               if(score < 0 ){
                //   return; 
                alert("you lost, bruh");
                location.reload();
                    
                }
            }
        });
        
        
                $("#kaart2").click(function(){
             
           if(RandomKaart === 2){;
               score = score + plus;
              document.getElementById("score").innerHTML = 'Score: ' + score;
               console.log(score);
               console.log("goed geantwoord");
               
               RandomKaart = Math.round(Math.random()* 3) + 1;
               
               
               start();
               $("#Volgende").show();
           }else{
               console.log("fout geantwoord");
               score = score - minus;
               document.getElementById("score").innerHTML = 'Score: ' + score;
               if(score < 0 ){
                //   return; 
                alert("you lost, bruh");
                location.reload();
                    
                }
            }
        });
        
        
                $("#kaart3").click(function(){
             
           if(RandomKaart === 3){;
               score = score + plus;
              document.getElementById("score").innerHTML = 'Score: ' + score;
               console.log(score);
               console.log("goed geantwoord");
               
               RandomKaart = Math.round(Math.random()* 3) + 1;
               
               
               start();
               $("#Volgende").show();
           }else{
               console.log("fout geantwoord");
               score = score - minus;
               document.getElementById("score").innerHTML = 'Score: ' + score;
               if(score < 0 ){
                //   return; 
                alert("you lost, bruh");
                location.reload();
                    
                }
            }
        });
                $("#kaart4").click(function(){
             
           if(RandomKaart === 4){;
               score = score + plus;
              document.getElementById("score").innerHTML = 'Score: ' + score;
               console.log(score);
               console.log("goed geantwoord");
               
               RandomKaart = Math.round(Math.random()* 3) + 1;
               
               
               start();
               $("#Volgende").show();
           }else{
               console.log("fout geantwoord");
               score = score - minus;
               document.getElementById("score").innerHTML = 'Score: ' + score;
               if(score < 0 ){
                //   return; 
                alert("you lost, bruh");
                location.reload();
                    
                }
            }
        });