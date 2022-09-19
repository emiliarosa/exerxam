@include ('master.master')
@section('content')
<body onload="showhidejawaban()"> 
        <!-- page content -->
<style type="text/css">
  .areatext{
  height: 200px;
  width: 1000px;
  position: relative;
  margin-bottom: 200px;
  margin-top: 25px;
  margin-left: 90px;                  
}
</style>

<script type="text/javascript">
  function showhide(){
    var pilihan = document.getElementById("pilihan").value;// id : pilihan adalah name select option
    var materi_input = document.getElementById("materi_input");//id: materi_input : textbox kosong
      if (pilihan=="new"){// value :new -> pas pilihan di select
        materi_input.style.display="block";
      } else{
        materi_input.style.display="none";
      }
  }
  
  function showhidejawaban(){
    var kat_soal = document.getElementById("kat_soal").value;
    var jwb1 = document.getElementById("jwb1");
    var jwb2 = document.getElementById("jwb2");
    var jwb3 = document.getElementById("jwb3");
    var jwb4 = document.getElementById("jwb4");
    var jwb5 = document.getElementById("jwb5");
    var jwb_bnr = document.getElementById("jwb_bnr");
    var jwb_bnrabc = document.getElementById("jwb_bnrabc");
    var jwbbnr = document.getElementById("editor_question0");
    var jwbbnrabc = document.getElementById("jwbbnrabc");
    var bobot = document.getElementById("bobot");
        if (kat_soal == "esai"){
          jwb1.style.display = "none";
          jwb2.style.display = "none";
          jwb3.style.display = "none";
          jwb4.style.display = "none";
          jwb5.style.display = "none";
          bobot.style.display = "none";
          jwb_bnr.style.display = "block";
          jwb_bnrabc.style.display = "none";
          jwbbnr.disabled = false;
          jwbbnrabc.disabled = true;
        }
        else {
          jwb1.style.display = "block";
          jwb2.style.display = "block";
          jwb3.style.display = "block";
          jwb4.style.display = "block";
          jwb5.style.display = "block";
          jwb_bnr.style.display = "none";
          bobot.style.display = "none";
          jwb_bnrabc.style.display = "block";
          jwbbnr.disabled = true;
          jwbbnrabc.disabled = false;
        }
  }
</script>

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                @php
                    $get_id_guru=Session::get('id_guru');
                    $get_kategori_guru=Session::get('kategori');
                @endphp
                <h3>Media Edukasi "Exerxam" <small>SMA N 1 Sukodadi - Lamongan</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                  <style>
                    .alert {
                    padding: 20px;
                    background-color: #f44336;
                    color: white;
                    }
                    .alert_succes{
                     padding: 20px;
                      background-color: #90ee90;
                     color: white;
                    }
                    .closebtn {
                    margin-left: 15px;
                    color: white;
                    font-weight: bold;
                    float: right;
                    font-size: 22px;
                    line-height: 20px;
                   cursor: pointer;
                     transition: 0.3s;
                    }
                    .closebtn:hover {
                    color: black;
                    }
                  </style>
                <div class="alert">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong>Danger!</strong> {{ $error }}
          </div>
          @endforeach
          @endif
          <br>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <center><h1>Edit Soal </h1></center>
                    <h2 class="StepTitle">Step 1 Content</h2>
                    <!-- Smart Wizard -->
                      @if(isset($result))
                        @php
                        $datakategori_soal=$result->kategori_soal;
                        $datasoal=$result->soal;
                        $datajawab=$result->jawab;
                        $datahasil_jawab=$result->hasil_jawab;
                        $datamateri=$result->materi;
                        $databobot=$result->bobot;
                        $id_soal=$result->id;
                        @endphp
                        <body onload="onloadform()">
                      <form class="form-horizontal form-label-left" action="updatesoalPost" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id_guru" value="{{ $get_id_guru }}">
                      <input type="hidden" name="id" value="{{ $id_soal }}">
                      <div id="step-1">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mapel">Mata Pelajaran<span class="required"></span>
                            </label>
                            <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-8">
                          <select class="form-control" name="mapel">
                            <option>@if (session()->has('kategori'))
                            @php
                            $kategori=Session::get('kategori');
                            @endphp
                            {{ $kategori }}
                            @endif
                            </option>
                          </select>
                        </div>
                      </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="materi">Materi<span class="required"></span>
                            </label>
                            <div class="form-group">
                              <div id="materi_option">
                        <div class="col-md-6 col-sm-6 col-xs-8">
                          <select class="form-control" id="pilihan" onchange="showhide()" name="pilihmateri">
                            <option value="">Pilihan materi
                            @php
                              $getmateri=DB::table('banksoals')->select('materi')->where('mapel','=',$get_kategori_guru)->distinct()->get();
                            @endphp
                                  
                            @foreach($getmateri as $data)
                            @php
                              $materi=$data->materi;
                            @endphp
                            <option value="{{ $materi }}" @if($datamateri==$materi) selected="true" @endif>{{ $materi }}</option>
                            @endforeach
                            <option value="new">Buat materi Lain</option>
                          </select>
                        </div>
                        </div><div id="materi_input" style="display: none;">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="materi" placeholder="Input Materi Lain">
                            </div>
                      </div>
                      </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
                            <div class="col-md-6 col-sm-6 col-xs-8">
                          <select class="form-control" name="jenissoal" onchange="showhidejawaban()" id="kat_soal">
                            <option value="abcde" @if($datakategori_soal=='abcde') selected="true" @endif>Pilihan ganda 5</option>
                            <option value="esai" @if($datakategori_soal=='esai') selected="true" @endif>Essay</option>
                          </select>
                        </div>
                          </div>
                      </div>
                      <div id="step-2">
                        <h2 class="StepTitle">Step 2 Content</h2>
                        <div class="areatext">Masukan Soal
                            <textarea name="soal" id="editor_question" style="display: none;">@php echo htmlspecialchars_decode(stripslashes($datasoal)); @endphp</textarea>
                        </div><br>
                        <div class="areatext" id="jwb_bnr" style="display: none;">Jawaban Benar
                            <textarea name="jwb_benar" id="editor_question0">@php echo htmlspecialchars_decode(stripslashes($datahasil_jawab)); @endphp</textarea>
                        </div>
                        <br>
                        <div class="areatext" id="jwb1">Masukkan Jawaban Pilihan Ganda
                            @php
                              $jawaban= htmlspecialchars_decode(stripslashes($datajawab));
                              $getjawaban=explode("&&",$jawaban);
                            @endphp
                          <textarea name="jawaban1" value="empty" id="editor_question1" style="display: none;">{{ $getjawaban[0] }}</textarea>
                        </div>
                        <div class="areatext" id="jwb2">
                          <textarea name="jawaban2" value="empty" id="editor_question2" style="display: none;">{{ $getjawaban[1] }}</textarea>
                        </div>
                        <div class="areatext" id="jwb3">
                          <textarea name="jawaban3" value="empty" id="editor_question3" style="display: none;">{{ $getjawaban[2] }}</textarea>
                        </div>
                        <div class="areatext" id="jwb4">
                          <textarea name="jawaban4" value="empty" id="editor_question4" style="display: none;">{{ $getjawaban[3] }}</textarea>
                        </div>
                        <div class="areatext" id="jwb5">
                          <textarea name="jawaban5" value="empty" id="editor_question5" style="display: none;">{{ $getjawaban[4] }}</textarea>
                        </div>
                      </div>
              <script>
              CKEDITOR.config.toolbar_Full =
                  [
                  { name: 'document', items : [ 'Source'] },
                  { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                  { name: 'editing', items : [ 'Find'] },
                  { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                  { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                  ];
              CKEDITOR.config.height = '40px';
              CKEDITOR.plugins.addExternal('divarea', '../examples/extraplugins/divarea/', 'plugin.js');
              CKEDITOR.config.removePlugins = 'maximize';
              CKEDITOR.config.removePlugins = 'resize';
              CKEDITOR.replace('editor_question', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question0', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question1', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question2', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question3', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question4', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question5', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
          </script>
          <div class="form-group" id="jwb_bnrabc" style="display: none;">
              <br>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jawaban">Jawaban Benar<span class="required"></span>
              </label>
              <div class="col-sm-5">
                @php
                  $getdata = DB::table('banksoals')->select('hasil_jawab')->distinct()->get();
                @endphp
                <select id="jwbbnrabc" name="jwb_benarabc"class="form-control" id="kategoriguru" value="$getdata">
                  <option value="">Pilihan Jawaban</option>
                  <option value="A" @if($getdata=='A') selected @endif>A</option>
                  <option value="B" @if($getdata=='B') selected @endif>B</option>
                  <option value="C" @if($getdata=='C') selected @endif>C</option>
                  <option value="D" @if($getdata=='D') selected @endif>D</option>
                  <option value="E" @if($getdata=='E') selected @endif>E</option>
                </select>
              </div>
          </div>
            <div class="form-group" id="bobot" style="display: none;">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jawaban" type="hidden" >Bobot<span class="required"></span>
              </label>
              <div class="col-md-5 col-sm-5 col-xs-6">=
              <input id="middle-name" class="form-control col-md-5 col-xs-6" type="hidden" name="bobot" value="{{ $databobot }}" >
              </div>
              </div>
              <div class="col-md-5 col-sm-5 col-xs-6">
              <button type="submit" class="buttonNext btn btn-success">Simpan</button>
              </div>
              </div>
</form>
</body>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          @include('master.footer')