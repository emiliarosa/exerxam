@php
use Illuminate\Http\Request;
use App\Models\banksoal;
@endphp
<html>
<head lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<meta charset="UTF-8">
<title> Quiz by Nikhil </title>
<style type="text/css">
  body {
    background-color: #eeeeee;
  }
    .grid {
    width: 800px;
    height: 700px;
    margin: 0 auto;
    background-color: #fff;
    padding: 10px 50px 50px 50px;
    border-radius: 50px;
    border: 2px solid #cbcbcb;
    box-shadow: 10px 15px 5px #cbcbcb;
    }
    .grid h1 {
    font-family: "sans-serif";
    background-color: #2c0747;
    font-size: 50px;
    text-align: center;
    color: #ffffff;
    padding: 2px 0px;
    border-radius: 50px;
    }
    #score {
    color: #5A6772;
    text-align: center;
    font-size: 30px;
    }
    .grid #question {
    font-family: "monospace";
    font-size: 20px;
    color: #5A6772;
    }
    .buttons {
    margin-top: 0px;
    }
    .left{
    float: left;
    display: block;
    }
    .right{
    float: right;
    display: block;
    }
    #bt0, #bt1, #bt2, #bt3, #bt4 {
    text-align: left;
    background-color: #510b84;
    width: 100%;
    height: 50px;
    font-size: 14px;
    color: #fff;
    border: 1px solid #1D3C6A;
    border-radius: 20px;
    padding: 5px;
    margin-bottom: 5px;
    }
    #bt0:hover, #bt1:hover, #bt2:hover, #bt3:hover, #bt4:hover {
    cursor: pointer;
    background-color: #2c0747;
    }
    #bt0: focus, #bt1: focus, #bt2: focus, #bt3: focus, #bt4: focus {
    outline: 0;
    }
    #btnext {
    background-color: #00cc00;
    width: 50px;
    height: 50px;
    font-size: 14px;
    color: #fff;
    border: 1px solid #1D3C6A;
    border-radius: 0px;
    margin: 10px 40px 10px 0px;
    padding: 5px;
    }
    #btnext:hover{
    cursor: pointer;
    background-color: #008000;
    }
    #btnext: focus {
    outline: 0;
    }
    #progress {
    color: #2b2b2b;
    font-size: 18px;
    }
</style>
</head>
<body>
  @if($soal!=null)
  @php
    $getsoalmudah = $soal->soal_mudah;
    $getsoalsedang = $soal->soal_sedang;
    $getsoalsulit = $soal->soal_sulit;
    $getsoaldapat = $soal->soal_dapat;
    $getlength = explode(',',$getsoalmudah);
    $length = count($getlength);

    if($getsoaldapat!='' && $getsoaldapat!=null){
      $lengthsoaldapat = count(explode('&&',$getsoaldapat));
  @endphp
      <script type="text/javascript">
        var quizscore = 0;
        var idUji = {{ \Request::get('id_ujian') }};
        var siswa = {{ \Request::get('id_siswa') }};
     
        $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            url:"{{ url('sendscr') }}?id_siswa="+siswa+"&id_ujian="+idUji+"&scr="+quizscore,
            success:function(data){
                 // console.log(data.result);
            }
        });
      </script>
    @php
      }else{
        $lengthsoaldapat = 0;
      }
    @endphp
    @endif
      @php
        $waktu = $soal->waktu;
        $time = explode(',',$waktu);
        $menit = $time[0];
        $detik = $time[1];
      @endphp
<div class="grid" >
<div id="quiz">
  @if($soal!=null && $lengthsoaldapat<$length)
  @php echo "<script>alert('UJIAN ONLINE Dikerjakan Secara TERURUT, JANGAN Melakukan BACK/PREVIOUS SEBELUM SOAL SELESAI. Hal Tersebut Akan Membuat NILAI AKHIR 0')</script>"@endphp
<h1> EXERCISE </h1>
  @if($detik!=null)
<center><h2 id="time">Waktu</h2></center>
  @endif
<p id="progress"> Question x of y</p>
<hr style="margin-bottom: 0px">
<div id="question"> </div>
<div class="button">
<button id="bt0"> <span id="choice0" > </span> </button><br>
<button id="bt1"> <span id="choice1" > </span> </button><br>
<button id="bt2"> <span id="choice2" > </span> </button><br>
<button id="bt3"> <span id="choice3" > </span> </button><br>
<button id="bt4"> <span id="choice4" > </span> </button><br>
<div class="buttonnext">
  <ul class="right">
<button id="btnext"> <span id="next" > </span>  NEXT </button>
</div>
</div>
  @else
<h1> EXERCISE SELESAI </h1>
  @endif
<hr style="margin-top: 130px">
<footer>
</footer>
</div>
</div>
<script type="text/javascript">
  @if($soal!=null)
    var xtimeout=0;
    var adaptive = <?= ($length-$lengthsoaldapat) ?>;
    var play = adaptive;
    var lvl = "";
    var quizscore = 0;
    var jwbn = -1;
  @if($detik!=null)
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      var cek = 0;
      var ceksoal = 0;
      var xtime = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;

        console.log(adaptive);
        if (--timer < 0) {
          if (adaptive != ceksoal) {
            if (cek==0) {
              guess("bt9", "null");
              xtimeout=0;
              ceksoal++;
              console.log(ceksoal);
                //clearInterval(xtime);
                timer = duration;
            }
          }
        }
        else if (xtimeout==1) {
          //clearInterval(xtime);
          timer = duration;
          ceksoal++;
            console.log(ceksoal);
        }
        xtimeout=0;
      }, 1000);
}

function runtime() {
  var waktungerjakan = (60 * {{ $menit }})+{{ $detik }},
      display = document.querySelector('#time');
  startTimer(waktungerjakan, display);
};
  runtime();
  @endif

Question.prototype.isCorrectAnswer = function(choice) {
    return this.answer === choice;
}

function Quiz(questions) {
  this.score = 0;
  this.questions = questions;
  this.questionIndex = <?=($lengthsoaldapat)?>;//iki gawe
  this.questionIndexAdap = adaptive;//deklarasi id soal yg dikerjakan
}

Quiz.prototype.getQuestionIndex = function() {
    return this.questions[this.questionIndexAdap];
}

Quiz.prototype.guess = function(answer) {
if (xtimeout==0) {
  var pilihjawab = true;
}
  @if($detik==null)
else if (answer!=null && answer!="") {
  var pilihjawab =  true;
}
  @endif
else{
  var pilihjawab = true;
}

if (pilihjawab==true){
  var jwb=answer;
  var soal=quiz.getQuestionIndex().id;
  var idUji = {{ \Request::get('id_ujian') }};
  var siswa = {{ \Request::get('id_siswa') }};
  
  if(this.getQuestionIndex().isCorrectAnswer(answer)) {
    if(play==adaptive){
      this.score=this.score+100;//awal
    }
    else if(play<adaptive){
      this.score=this.score+85;//mudah
    }
    else if(play>adaptive && play<=adaptive*2){
      this.score=this.score+90;//sedang
    }
    else{
           this.score=this.score+100;//sulit
    }
        if(play<=adaptive*2){//play = 7 <= kodisi 12
            play=play+adaptive+1; // play 14 naik level
        }else{
            play=play+1; // level tetap
        }
        //this.score++;
    }else{
        if(play>=adaptive){
            play=play-adaptive+1;// play 14(play)-6(total soal kerjakan)+1(soal lanjut) 9 turun level 4 turun level
        }else{
            play=play+1; // play 5
        }
    }

    this.questionIndexAdap=play; //14 , 9, 4, 5
    this.questionIndex++;

    $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
       $.ajax({
          url:"{{ url('sendjwb') }}?ikisoal='"+soal+"'&id_siswa="+siswa+"&id_ujian="+idUji+"&jwb='"+jwb+"'",
          //data:"soal=arr",
          success:function(data){
                  // console.log(data.result);
          }
       });
         //
         // console.log(this.score);
    }
}

Quiz.prototype.isEnded = function() {
    return this.questionIndex == {{ $length }}; //this.questions.length
}

function Question(text, choices, answer, id) {
    this.text = text;
    this.choices = choices;
    this.answer = answer;
    this.id = id;
}

Question.prototype.isCorrectAnswer = function(choice) {
    return this.answer === choice;
}

 function populate() {
    if(quiz.isEnded()) {
        showScores();
    }
    else {
        // show question
        var element = document.getElementById("question");
        element.innerHTML = quiz.getQuestionIndex().text;
        // console.log(quiz.getQuestionIndex());

        // show options
        var buttonnext = document.getElementById("btnext");
        var choices = quiz.getQuestionIndex().choices;
        for(var i = 0; i < choices.length; i++) {
            var element = document.getElementById("choice" + i);
            element.innerHTML = choices[i];
            buttonnext.onclick = function() {
              var button0 = document.getElementById("bt0");
              var button1 = document.getElementById("bt1");
              var button2 = document.getElementById("bt2");
              var button3 = document.getElementById("bt3");
              var button4 = document.getElementById("bt4");
              button0.style.background='#510b84';
              button1.style.background='#510b84';
              button2.style.background='#510b84';
              button3.style.background='#510b84';
              button4.style.background='#510b84';
            guess("bt" + jwbn, choices[jwbn]);
            xtimeout=1;
            }
        }
        showProgress();
    }
};

var button0 = document.getElementById("bt0");
var button1 = document.getElementById("bt1");
var button2 = document.getElementById("bt2");
var button3 = document.getElementById("bt3");
var button4 = document.getElementById("bt4");
            button0.onclick = function() {
              jwbn=0;
              button0.style.background='#0000cc';
              button1.style.background='#510b84';
              button2.style.background='#510b84';
              button3.style.background='#510b84';
              button4.style.background='#510b84';
            }
            button1.onclick = function() {
              jwbn=1;
              button0.style.background='#510b84';
              button1.style.background='#0000cc';
              button2.style.background='#510b84';
              button3.style.background='#510b84';
              button4.style.background='#510b84';
            }
            button2.onclick = function() {
              jwbn=2;
              button0.style.background='#510b84';
              button1.style.background='#510b84';
              button2.style.background='#0000cc';
              button3.style.background='#510b84';
              button4.style.background='#510b84';
            }
            button3.onclick = function() {
              jwbn=3;
              button0.style.background='#510b84';
              button1.style.background='#510b84';
              button2.style.background='#510b84';
              button3.style.background='#0000cc';
              button4.style.background='#510b84';
            }
            button4.onclick = function() {
              jwbn=4;
              button0.style.background='#510b84';
              button1.style.background='#510b84';
              button2.style.background='#510b84';
              button3.style.background='#510b84';
              button4.style.background='#0000cc';
            }
function guess(id, guess) {
    // var button = document.getElementById(id);
    // button.onclick = function() {


        quiz.guess(guess);
        populate();
    // }
};


function showProgress() {
  if(play<adaptive){
          lvl="mudah";
          }
          else if(play<adaptive*2){
            lvl="sedang";
            }
            else{
             lvl="sulit";
            }
    var currentQuestionNumber = quiz.questionIndex + 1;
    var element = document.getElementById("progress");
    element.innerHTML = "Question " + lvl +" : " + currentQuestionNumber + " of " + "{{ $length }}";
};

function showScores() {
  // console.log(quiz.score);
  @if($getsoaldapat=='' && $getsoaldapat==null)
  quizscore=quiz.score/adaptive;
  var idUji = {{ \Request::get('id_ujian') }};
      var siswa = {{ \Request::get('id_siswa') }};
     $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
         url:"{{ url('sendscr') }}?id_siswa="+siswa+"&id_ujian="+idUji+"&scr="+quizscore,

         success:function(data){
                 // console.log(data.result);
         }
      });
      @else
      quizscore=0;
      @endif
      var myscore="";
      if(quizscore==100){
        myscore="Kemampuan sangat bagus, pertahankan ya";
      }
      else if(quizscore>=85 && quizscore<100){
        myscore="Kemampuan dalam rentang baik, tingkatkan ya";
      }
      else if(quizscore>=70 && quizscore<85){
        myscore="Kemampuan sudah dalam rentang cukup, tingkatkan ya";
      }
      else{
        myscore="Kemampuan masih dalam rentang kurang, Belajar Lagi ya";        
      }
    var gameOverHTML = "<h1>Result</h1>";
    gameOverHTML += "<h2 id='score'> Your scores: " + quizscore + "</h2><br>"+ myscore +"<br><a href='ujionsiswa'>Kembali</a>";

    var element = document.getElementById("quiz");
    element.innerHTML = gameOverHTML;
  };
  @endif

//tampilan website
@if($soal!=null)
// create questions
var questions = [
@php
$getsoalmudah = $soal->soal_mudah;
$getsoalsedang = $soal->soal_sedang;
$getsoalsulit = $soal->soal_sulit;

$soalmudah = explode(',',$getsoalmudah);
$soalsedang = explode(',',$getsoalsedang);
$soalsulit = explode(',',$getsoalsulit);
// if ($lengthsoaldapat>0) {
//   $soalmudah = array_slice($soalmudah,($lengthsoaldapat-1));
//   $soalsedang =array_slice($soalsedang,($lengthsoaldapat-1));
//   $soalsulit = array_slice($soalsulit,($lengthsoaldapat-1));
// }
@endphp

@foreach($soalmudah as $soalmudah1=>$mudah)
@php
$ambilsoal = banksoal::where('id',$mudah)->first();
$setjawab= explode("&&",$ambilsoal->jawab);
$hasiljawab= substr($ambilsoal->hasil_jawab,3,1);
$cekhjawab = strtolower($hasiljawab);
$cekjawab="";
$a=$setjawab[0];
$b=$setjawab[1];
$c=$setjawab[2];
$d=$setjawab[3];
$e=$setjawab[4];
if($cekhjawab == "a"){
$cekjawab=$a;
}
else if($cekhjawab == "b"){
$cekjawab=$b;
}
else if($cekhjawab == "c"){
$cekjawab=$c;
}
else if($cekhjawab == "d"){
$cekjawab=$d;
}
else if($cekhjawab == "e"){
$cekjawab=$e;
}
else{
$cekjawab=$cekhjawab;
}
@endphp
@php echo "new Question('"; $tmp=htmlspecialchars_decode(stripslashes($ambilsoal->soal)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "', ['"; $tmp=htmlspecialchars_decode(stripslashes($a)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($b)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($c)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($d)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($e)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "'],'"; $tmp=htmlspecialchars_decode(stripslashes($cekjawab)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "',' $mudah '),"; @endphp
@endforeach

@foreach($soalsedang as $soalsedang1=>$sedang)
@php
$ambilsoal = banksoal::where('id',$sedang)->first();
$setjawab= explode("&&",$ambilsoal->jawab);
$hasiljawab= substr($ambilsoal->hasil_jawab,3,1);
$cekhjawab = strtolower($hasiljawab);
$cekjawab="";
$a=$setjawab[0];
$b=$setjawab[1];
$c=$setjawab[2];
$d=$setjawab[3];
$e=$setjawab[4];
if($cekhjawab == "a"){
$cekjawab=$a;
}
else if($cekhjawab == "b"){
$cekjawab=$b;
}
else if($cekhjawab == "c"){
$cekjawab=$c;
}
else if($cekhjawab == "d"){
$cekjawab=$d;
}
else if($cekhjawab == "e"){
$cekjawab=$e;
}
else{
$cekjawab=$cekhjawab;
}

@endphp
@php echo "new Question('"; $tmp=htmlspecialchars_decode(stripslashes($ambilsoal->soal)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "', ['"; $tmp=htmlspecialchars_decode(stripslashes($a)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($b)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($c)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($d)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($e)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "'],'"; $tmp=htmlspecialchars_decode(stripslashes($cekjawab)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "',' $sedang '),"; @endphp
@endforeach

@foreach($soalsulit as $soalsulit1=>$sulit)
@php
$ambilsoal = banksoal::where('id',$sulit)->first();
$setjawab= explode("&&",$ambilsoal->jawab);
$hasiljawab= substr($ambilsoal->hasil_jawab,3,1);
$cekhjawab = strtolower($hasiljawab);
$cekjawab="";
$a=$setjawab[0];
$b=$setjawab[1];
$c=$setjawab[2];
$d=$setjawab[3];
$e=$setjawab[4];
if($cekhjawab == "a"){
$cekjawab=$a;
}
else if($cekhjawab == "b"){
$cekjawab=$b;
}
else if($cekhjawab == "c"){
$cekjawab=$c;
}
else if($cekhjawab == "d"){
$cekjawab=$d;
}
else if($cekhjawab == "e"){
$cekjawab=$e;
}
else{
$cekjawab=$cekhjawab;
}

@endphp
@php echo "new Question('"; $tmp=htmlspecialchars_decode(stripslashes($ambilsoal->soal)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "', ['"; $tmp=htmlspecialchars_decode(stripslashes($a)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($b)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($c)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($d)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "','"; $tmp=htmlspecialchars_decode(stripslashes($e)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "'],'"; $tmp=htmlspecialchars_decode(stripslashes($cekjawab)); $tmpf=trim(preg_replace('/\s\s+/', ' ', $tmp)); echo $tmpf; echo "',' $sulit '),"; @endphp
@endforeach
];

// console.log(questions);
var quiz = new Quiz(questions);
populate();
@endif
</script>
</body>
</html>
