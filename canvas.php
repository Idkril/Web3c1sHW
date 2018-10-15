<html>
  <canvas id='example' style="border:2px solid #000000;"></canvas>
        <script>
            var example = document.getElementById("example"), ctx = example.getContext('2d');
            example.width  = 600;
            example.height = 400;
            var x=10, y=10, dirX=1, dirY=1;
            function drawsmth() {
              ctx.beginPath();
              ctx.fillStyle = "white";
              ctx.fillRect(0,0,example.width,example.height);
              ctx.closePath();

              ctx.beginPath();
              ctx.arc(x, y, 10, 0, Math.PI*2, true);
              ctx.closePath();
              ctx.fillStyle = "green";
              ctx.fill();
              if (x<example.width && y<example.height) {
                x=x+dirX;
                y=y+dirY;
              } else if (x>=example.width) {
                x=0;
              } else {
                y=0;
              }
              window.requestAnimationFrame(drawsmth);
            }
            drawsmth();

      </script>
</html>
