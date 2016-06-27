$(document).ready(function(){
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf("/") + 1);
    var api = url.substring(xIndexOf('/', url, 3), xIndexOf('/', url, 6)+1) + 'getNodes';

     $.ajax({

        type: "POST",
        contentType: "application/json; charset=utf-8",
        url: api + '?id=' + id,
        dataType: "json",
        success: function (json) {    console.log(json.data);
            var canvas = document.getElementById("canvas");
            if (canvas.getContext) {
              var ctx = canvas.getContext("2d");

              //Created
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

              //Published
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

              //Nodes connection
              ctx.beginPath();
              ctx.moveTo(150,100);
              ctx.lineTo(300, 100);
              ctx.stroke();

              //Creator connection
              ctx.beginPath();
              ctx.moveTo(75,200);
              ctx.lineTo(75, 250);
              ctx.stroke();

              //Publisher connection
              ctx.beginPath();
              ctx.moveTo(375,200);
              ctx.lineTo(375, 250);
              ctx.stroke();

              ctx.fillStyle = "rgb(0, 0, 0)";     
              ctx.font = "18px serif";
              
              //Created node text
              ctx.fillText("Created", 45, 80);
              ctx.fillText("01/01/2016", 35, 100);       
              ctx.fillText("Muso Music", 35, 260);

              //Published node text
              ctx.fillText("Published", 340, 80);
              ctx.fillText("01/01/2016", 335, 100);       
              ctx.fillText("Muso Music", 335, 260);
            }

        },

        error: function (response) {

            alert("Error"+response.responseText);

        }

    });   
      
    function xIndexOf(Val, Str, x)  
    {  
      if (x <= (Str.split(Val).length - 1)) {  
        Ot = Str.indexOf(Val);  
        if (x > 1) { for (var i = 1; i < x; i++) { var Ot = Str.indexOf(Val, Ot + 1) } }  
        return Ot;  
      } else { alert(Val + " Occurs less than " + x + " times"); return 0 }  
    } 
});


