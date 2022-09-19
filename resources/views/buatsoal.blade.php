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
    var label_jwb_benar_esai = document.getElementById("label_jwb_benar_esai");
    var label_jawaban_benar_pg = document.getElementById("label_jawaban_benar_pg");
    var jwb5 = document.getElementById("jwb5");
    var jwb5 = document.getElementById("jwb5");
        if (kat_soal == "esai"){
          jwb1.style.display = "none";
          jwb2.style.display = "none";
          jwb3.style.display = "none";
          jwb4.style.display = "none";
          jwb5.style.display = "none";
          label_jwb_benar_esai.style.display = "block";
          label_jawaban_benar_pg.style.display = "none";
          bobot.style.display = "block";
        }
        else {
          jwb1.style.display = "block";
          jwb2.style.display = "block";
          jwb3.style.display = "block";
          jwb4.style.display = "block";
          jwb5.style.display = "block";
          label_jwb_benar_esai.style.display = "none";
          label_jawaban_benar_pg.style.display = "block";
          bobot.style.display = "block";
        }
  }
</script>

<div class="right_col" role="main" style="">
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
        </div>
            <div class="x_content">
            <!-- Smart Wizard -->
              <center><h1>Buat Soal </h1></center>
              <h2 class="StepTitle">Step 1 Content</h2>
                <form class="form-horizontal form-label-left" action="tambahmateriPost" method="post">
                {{ csrf_field() }}
                   <input type="hidden" name="id_guru" value="{{ $get_id_guru }}">
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
                                <option value="">Pilihan materi</option>
                                  @php
                                  $getmateri=DB::table('banksoals')->select('materi')->where('mapel','=',$get_kategori_guru)->distinct()->get();
                                  @endphp
                                  @foreach($getmateri as $data)
                                  @php
                                  $materi=$data->materi;
                                  @endphp
                                <option value="{{ $materi }}">{{ $materi }}</option>
                                  @endforeach
                                <option value="new">Buat materi Lain</option>
                              </select>
                            </div>
                            </div>
                            <div id="materi_input" style="display: none;">
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
                                <option value="abcde" >Pilihan ganda 5</option>
                                <option value="esai">Essay</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div id="step-2">
                        <h2 class="StepTitle">Step 2 Content</h2>
                          <div class="areatext">Masukan Soal
                            <textarea name="soal" id="editor_question"></textarea>
                          </div>
                          <br>
                          <div class="areatext" id="label_jwb_benar_esai" style="display: none;">Jawaban Benar
                            <textarea name="jwb_benar" value="empty" id="editor_question0" ></textarea>
                          </div>
                          <br>
                          <div class="areatext" id="jwb1">Masukkan Jawaban Pilihan Ganda
                            <textarea name="jawaban1" value="empty" id="editor_question1" style="display: none;">A. </textarea>
                          </div>
                          <div class="areatext" id="jwb2">
                            <textarea name="jawaban2" value="empty" id="editor_question2" style="display: none;">B. </textarea>
                          </div>
                          <div class="areatext" id="jwb3">
                            <textarea name="jawaban3" value="empty" id="editor_question3" style="display: none;">C. </textarea>
                          </div>
                          <div class="areatext" id="jwb4">
                            <textarea name="jawaban4" value="empty" id="editor_question4" style="display: none;">D. </textarea>
                          </div>
                          <div class="areatext" id="jwb5">
                            <textarea name="jawaban5" value="empty" id="editor_question5" style="display: none;">E. </textarea>
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
          <div class="form-group" id="label_jawaban_benar_pg" style="display: none;">
            <br>
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jawaban">Jawaban Benar<span class="required"></span>
            </label>
              <div class="col-md-6 col-sm-6 col-xs-8">
                <select class="form-control" id="jawaban_benar_pg" name="jwb_benarabc">
                  <option value="">Jawaban Benar</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                  <option value="D">E</option>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="display: none;" id="bobot" for="jawaban">Bobot<span class="required"></span>
            </label>
              <div class="col-md-6 col-sm-6 col-xs-8">
                <select class="form-control" name="bobot">
                  <option value="">Bobot (Level)</option>
                  <option value="1">1 (Mudah)</option>
                  <option value="2">2 (Mudah)</option>
                  <option value="3">3 (Mudah)</option>
                  <option value="4">4 (Medium)</option>
                  <option value="5">5 (Medium)</option>
                  <option value="6">6 (Medium)</option>
                  <option value="7">7 (Medium)</option>
                  <option value="8">8 (Sulit)</option>
                  <option value="9">9 (Sulit)</option>
                  <option value="10">10 (Sulit)</option>
                </select>
              </div>        
          </div>
            <div class="col-md-5 col-sm-5 col-xs-6">
              <button type="submit" class="buttonNext btn btn-success">Simpan</button>
            </div>
            </div>
            </form>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
@include('master.footer')