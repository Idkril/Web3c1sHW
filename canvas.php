<html>
  <canvas id='example' style="border:2px solid #000000;"></canvas>
        <script>
            var example = document.getElementById("example"), ctx = example.getContext('2d');
            example.width  = 600;
            example.height = 400;
            var x=10, y=10, dirX=1, dirY=1, speed=1,circolor="green",size=10,figure=1;
            function drawsmth() {
              ctx.beginPath();
              ctx.fillStyle = "white";
              ctx.fillRect(0,0,example.width,example.height);
              ctx.closePath();

              switch (figure) {
                case 1:
                  ctx.beginPath();
                  ctx.arc(x, y, size, 0, Math.PI*2, true);
                  ctx.closePath();
                  ctx.fillStyle = circolor;
                  ctx.fill();
                  break;
                case 2:
                  ctx.beginPath();
                  ctx.fillStyle = circolor;
                  ctx.fillRect(x-size,y-size,size*2,size*2);
                  ctx.closePath();
              }

              if (x>=example.width) {
                x=0;
              } else if (x<0) {
                x=example.width;
              }
              if (y>=example.height) {
                y=0;
              } else if (y<0) {
                y=example.height;
              }
              x+=dirX*speed;
              y+=dirY*speed;
              window.requestAnimationFrame(drawsmth);

            }
            drawsmth();

            var keycode,event;
            document.onkeydown = function checkKeycode(event)
            {
            	if(!event)
                event = window.event;
            	if (event.keyCode)
              {
                keycode = event.keyCode; // IE
              }
            	else if(event.which)
                keycode = event.which; // all browsers
              switch (keycode) {
                case 37:
                  dirX=-1;
                  dirY=0;
                  break;
                case 39:
                  dirX=1;
                  dirY=0;
                  break;
                case 40:
                  dirY=1;
                  dirX=0;
                  break;
                case 38:
                  dirY=-1;
                  dirX=0;
                  break;
              }
            }

          function clickColor() {
            circolor=document.getElementById("html5colorpicker").value;
            document.getElementById("html5colorpicker").blur();
          }

          function speedchange() {
            speed=document.getElementById("speedd").value;
            speed=document.getElementById("speedd").value;
            document.getElementById("speedd").blur();
          }

          function sizechange() {
            size=document.getElementById("sizechan").value;
            document.getElementById("sizechan").blur();
          }
          function pickfiguree(whocalled) {
          //  document.getElementById("pickfigure")
            switch (whocalled) {
              case 1:
                if (document.getElementById("pickfigure1").checked) {
                  document.getElementById("pickfigure2").checked=false;
                  figure=1;
                } else {
                  document.getElementById("pickfigure2").checked=true;
                  figure=2;
                }
                break;
              case 2:
                if (document.getElementById("pickfigure2").checked) {
                  document.getElementById("pickfigure1").checked=false;
                  figure=2;
                } else {
                  document.getElementById("pickfigure1").checked=true;
                  figure=1;
                }
                break;

            }
          }

      </script>
      <br>
      Color: <br>
      <input type="color" id="html5colorpicker" onchange="clickColor()" value="#ff0000" style="width:50px;"> <br>
      Speed: <br>
      <input type="range" onchange="speedchange()" id="speedd" min="0.1" max="5" value="1" step="0.3" /> <br>
      Size: <br>
      <input type="range" onchange="sizechange()" id="sizechan" min="1" max="50" value="10" step="1" /> <br>
      <br>
      Circle: <input type="checkbox" id="pickfigure1" onchange="pickfiguree(1)" checked /> <br>
      Square: <input type="checkbox" id="pickfigure2" onchange="pickfiguree(2)"/> <br>
</html>
