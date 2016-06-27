$(document).ready(function(){
    var url = window.location.search;console.log(url);

    
     var canvas = document.getElementById("canvas");
      if (canvas.getContext) {
        var ctx = canvas.getContext("2d");
        
        //Begin our drawing
        ctx.beginPath();
        ctx.moveTo(75,0);
        ctx.lineTo(150,100);
        ctx.lineTo(75, 200);
        ctx.lineTo(0,100);

        //Define the style of the shape
        ctx.lineWidth = 1;
        ctx.fillStyle = "rgb(51, 153, 255)";
        ctx.strokeStyle = "rgb(0, 50, 200)";

        //Close the path
        ctx.closePath();

        //Fill the path with ourline and color
        ctx.fill();
        ctx.stroke();
        
        //Begin our drawing
        ctx.beginPath();
        ctx.moveTo(375,0);
        ctx.lineTo(450,100);
        ctx.lineTo(375, 200);
        ctx.lineTo(300,100);


        //Close the path
        ctx.closePath();

        //Fill the path with ourline and color
        ctx.fill();
        ctx.stroke();
        
        ctx.setLineDash([5, 15]);

        ctx.beginPath();
        ctx.moveTo(150,100);
        ctx.lineTo(300, 100);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(75,200);
        ctx.lineTo(75, 250);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(375,200);
        ctx.lineTo(375, 250);
        ctx.stroke();
        
        ctx.fillStyle = "rgb(0, 0, 0)";     
        ctx.font = "18px serif";
        ctx.fillText("Created", 45, 80);
        ctx.fillText("01/01/2016", 35, 100);       
        ctx.fillText("Muso Music", 35, 260);
        
        ctx.fillText("Published", 340, 80);
        ctx.fillText("01/01/2016", 335, 100);       
        ctx.fillText("Muso Music", 335, 260);
      }
});


