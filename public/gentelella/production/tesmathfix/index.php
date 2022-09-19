<?php
include('koneksi.php');
$kueri = "select * from soal";
$result = $conn->query($kueri);
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <form action="input.php" method="post">
       <button type="submit" name="button">Tambah Soal</button>
     </form>
     <?php
     $no=0;
     while ($data=mysqli_fetch_array($result)){
       $no=$no+1;
       $soal=$data['soal'];
       $jwb_benar=$data['jwb_benar'];
       $jawaban=$data['jawaban'];
       $getjawaban = explode( "<-:->", $jawaban );
       echo "$no . $soal";
       if ( $getjawaban[2]!="" && $getjawaban[3]=="" ) { //Pil.Ganda abc
         echo "a.$getjawaban[0]";
         echo "b.$getjawaban[1]";
         echo "c.$getjawaban[2]";
         echo "";
         echo "Jawaban : $jwb_benar";
       }
       else if ( $getjawaban[3]!="" && $getjawaban[4]=="" ) { //Pil.Ganda abcd
         echo "a.$getjawaban[0]";
         echo "b.$getjawaban[1]";
         echo "c.$getjawaban[2]";
         echo "d.$getjawaban[3]";
         echo "";
         echo "Jawaban : $jwb_benar";
       }
       else if ($getjawaban[4]!="") { //Pil.Ganda abcde
         echo "a.$getjawaban[0]";
         echo "b.$getjawaban[1]";
         echo "c.$getjawaban[2]";
         echo "d.$getjawaban[3]";
         echo "e.$getjawaban[4]";
         echo "";
         echo "Jawaban : $jwb_benar";
       }
     }
      ?>
   </body>
 </html>
