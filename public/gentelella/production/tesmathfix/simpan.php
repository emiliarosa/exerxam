<?php
include('koneksi.php');
$soal = $_POST['soal'];
$jwb_benar = $_POST['jwb_benar'];
$jawaban1 = $_POST['jawaban1'];
$jawaban2 = $_POST['jawaban2'];
$jawaban3 = $_POST['jawaban3'];
$jawaban4 = $_POST['jawaban4'];
$jawaban5 = $_POST['jawaban5'];
$jawaban="$jawaban1<-:->$jawaban2<-:->$jawaban3<-:->$jawaban4<-:->$jawaban5";

$kueri = "insert into soal (soal, jwb_benar, jawaban) values ('$soal','$jwb_benar','$jawaban')";
$result = $conn->query($kueri);
echo '<script>alert("Soal berhasil disimpan!")</script>';
echo '<script>window.location= "index.php"</script>';
?>
