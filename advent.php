<?php
echo '<section class="sky">';


dayOnePt1();
dayOnePt2();
echo '</section>';
printJs();


function dayTwoPt1(){
    $mapping = [
        'A' => 1,
        'B' => 2,
        'C' => 3,
        // 'X' => 1,
        // 'Y' => 2,
        // 'Z' => 3,
    ];
    printTitle('Day Two PT1');
    $fp = fopen('strategy.csv', 'r');
    while ($row = fgetcsv($fp)) {
        $couple = explode(' ', $row[0]);
    }
}

function isVictory($opponent_choice, $my_choice): bool 
{
    return $opponent_choice === true;
    
}

function dayOnePt2(){
    printTitle('Day One PT2');
    $fp = fopen('calories.csv', 'r');
    $ranking_table = [0, 0, 0,];
    $total_elf_num = 0;
    $current_elf_calories = 0;
    while ($row = fgetcsv($fp)) {
        if (empty($row[0])) {
            $total_elf_num++;
            $temp_ranking = array_merge([$current_elf_calories], $ranking_table);
            rsort($temp_ranking);
            array_pop($temp_ranking);
            $ranking_table = $temp_ranking;
            $current_elf_calories = 0;
            continue;
        }
        $current_elf_calories += intval($row[0]);
    }
    foreach ($ranking_table as $position => $calories) {
        $index = $position+1;
        printRow("Il {$index}° elfo della classifica ha:", "{$ranking_table[$position]} calorie");
    }
    printRow('Il totale delle calorie è:', (array_sum($ranking_table)));
    // echo "<br><font color='#228b22'>Il totale delle calorie è:</font> <font color='red'>" . (array_sum($ranking_table)) ."</font>";
}
function dayOnePt1(){
    printTitle('Day One PT1');
    $fp = fopen('calories.csv', 'r');
    $total_elf_num = 0;
    $saved_elf_num = 0;
    $saved_elf_calories = 0;
    $saved_num_object = 0;
    $current_elf_calories = 0;
    $num_object = 0;
    while ($row = fgetcsv($fp)) {
        if (empty($row[0])) {
            $total_elf_num++;
            if ($saved_elf_calories < $current_elf_calories ) {
                $saved_elf_calories = $current_elf_calories;
                $saved_num_object = $num_object;
                $saved_elf_num = $total_elf_num;
            }
            $current_elf_calories = 0;
            $num_object = 0;
            continue;
        }
        $current_elf_calories += intval($row[0]);
        $num_object++;
    }

    printRow('L\'elfo in questione è il ', "$saved_elf_num/$total_elf_num");
    printRow('Il numero di oggetti massimo è:', $saved_num_object);
    printRow('Il numero di calorie totali di questo elfo è:', $saved_elf_calories);
}

function printTitle(string $title)
{
    echo "<h4>$title </h4>";
}
function printRow(string $prefix, string $subject)
{
    echo "<font color='#228b22'> $prefix </font><font color='#F5624D'>$subject</font><br/>";
}

function printJs(){
    echo "<script>
// Snow from https://codepen.io/radum/pen/xICAB

(function () {
  var count = 300;
  var masthead = document.querySelector('.sky');
  var canvas = document.createElement('canvas');
  var ctx = canvas.getContext('2d');
  var width = masthead.clientWidth;
  var height = document.body.clientHeight;
  var i = 0;
  var active = false;

  function onResize() {
    width = masthead.clientWidth;
    height = document.body.clientHeight-10;
    canvas.width = width;
    canvas.height = document.body.clientHeight;
    ctx.fillStyle = '#FFF';

    var wasActive = active;
    active = width > 600;

    if (!wasActive && active)
      requestAnimFrame(update);
  }

  var Snowflake = function () {
    this.x = 0;
    this.y = 0;
    this.vy = 0;
    this.vx = 0;
    this.r = 0;

    this.reset();
  }

  Snowflake.prototype.reset = function() {
    this.x = Math.random() * width;
    this.y = Math.random() * -height;
    this.vy = 1 + Math.random() * 3;
    this.vx = 0.5 - Math.random();
    this.r = 1 + Math.random() * 2;
    this.o = 0.5 + Math.random() * 0.5;
  }

  canvas.style.position = 'absolute';
  canvas.style.left = canvas.style.top = '0';

  var snowflakes = [], snowflake;
  for (i = 0; i < count; i++) {
    snowflake = new Snowflake();
    snowflake.reset();
    snowflakes.push(snowflake);
  }

  function update() {

    ctx.clearRect(0, 0, width, height);

    if (!active)
      return;

    for (i = 0; i < count; i++) {
      snowflake = snowflakes[i];
      snowflake.y += snowflake.vy;
      snowflake.x += snowflake.vx;

      ctx.globalAlpha = snowflake.o;
      ctx.beginPath();
      ctx.arc(snowflake.x, snowflake.y, snowflake.r, 0, Math.PI * 2, false);
      ctx.closePath();
      ctx.fill();

      if (snowflake.y > height) {
        snowflake.reset();
      }
    }

    requestAnimFrame(update);
  }

  // shim layer with setTimeout fallback
  window.requestAnimFrame = (function(){
    return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function( callback ){
              window.setTimeout(callback, 1000 / 60);
            };
  })();

  onResize();
  window.addEventListener('resize', onResize, false);

  masthead.appendChild(canvas);
})();
</script>";
    echo "<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);

body, html {
  overflow:hidden;
  margin: 0;
  height: 100%;
  font-family: 'Lato';
  font-weight: 700;
  font-size: 20px;
  text-transform: uppercase;
  color: #FFF;
  
}

.sky {
  height: 100%;
  color: #FFF;
  display: block;
  background-color: #34A65F
}
font, h4 {
  position: relative;
  z-index:1231231;
  text-shadow: 1px 1px 3px #fff;
}
</style>";
}