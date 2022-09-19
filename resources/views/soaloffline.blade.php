<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div id="source-html">
    
@php
use App\Models\banksoal;
use App\Models\ujianoffline;
@endphp

@foreach($ujioffline as $dataoff)
@php
$datasoal=$dataoff->soal;
$iduji=$dataoff->id_ujian;
$ambilujian = ujianoffline::where('id',$iduji)->first();
$ujian=$ambilujian->nama_ujioff;
$soal = explode(',',$datasoal);
$no=0;
@endphp
<h1>
        <center>{{ $ujian }}</center>
    </h1>
@foreach($soal as $soal1=>$soalfix)
@php
$no++;
$ambilsoal = banksoal::where('id',$soalfix)->first();
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
<br>
@php echo htmlspecialchars_decode(stripslashes($ambilsoal->soal)); @endphp
<br>
@endforeach
___________________________________________________________________________
@endforeach
</div>
<div class="content-footer">
    <button id="btn-export" onclick="exportHTML();">Export to
        word doc</button>
</div>
<script>
    function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'document.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
</script>
</body>
</html>