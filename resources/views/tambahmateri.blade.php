@include ('master.master')
@section('content')

@php
$get_id_ujian=$ujionline->id;
$get_kategori=Session::get('kategori');
@endphp
<script type="text/javascript">
  function showhide(){
    var pilihan = document.getElementById("pilihan").value;
    var ketentuan = document.getElementById("ketentuan");
      if (pilihan=="setwaktupersoal"){
        ketentuan.style.display="block";
      }else if (pilihan=="setwaktusemuasoal"){
        ketentuan.style.display="block";}
      else {
        ketentuan.style.display="none";
      }
      }
</script>
       <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Media Edukasi "Exerxam" <small>SMA N 1 Sukodadi - Lamongan</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
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
                  @if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Danger!</strong> {{ $error }}
                  </div>
                  @endforeach
                  @endif
                  @if (isset($gagal))
                  <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Gagal!</strong> {{ $gagal }}
                  </div>
                  @endif
                  @if (isset($succes))
                  <div class="alert_succes">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Succes!</strong> {{ $succes }}
                  </div>
                  @endif
                    <h2>Tabel Data Siswa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew" title="Set Materi">Set Materi
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew1" title="Bagikan Soal">Bagikan soal</button>
                    <center><table id="datatable" class="table table-striped table-bordered" border="1">
                      <thead>
                        <tr>
                          <th width="100px"><center>No</th>
                          <th width="800px"><center>Materi Ujian</th>
                          <th width="800px"><center>Nomor soal</th>
                          <th width="200px"><center>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($viewmateri))
                        @php
                        $no=0;
                        $set_no=1;
                        $noawal=0;
                        @endphp
                        @foreach($viewmateri as $data)
                        @php
                        $no++;
                        $materi_ujion=$data->materi_ujion;
                        $id_ujion=$data->id_ujion;
                        $banyak=$data->banyak;
                        $id=$data->id; 

                        if($banyak>1){
                          if($no>1){
                            $set_no=$no_akhir+$noawal;
                            $no_akhir=$set_no+$banyak-1;
                          }else{
                            $no_akhir=$banyak;
                            $noawal=1;
                          }
                            $no_soal="$set_no-$no_akhir";
                        }else{
                          if($no>1){
                            $set_no=$no_akhir+$noawal;
                            $no_akhir=$set_no;
                          }else{
                            $no_akhir=$banyak;
                            $noawal=1;
                          }
                            $no_soal="$set_no";
                        }
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $materi_ujion }}</td>
                          <td>{{ $no_soal }}</td>
                          <td>
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew7{{ $no }}"><span class="fa fa-pencil" title="Edit Materi"></span>
                            <form action="hapusmateriPost" method="post">
                              {{ csrf_field() }}
                             <input type="hidden" name="id_ujion" value="{{ $id_ujion }}">
                             <input type="hidden" name="id" value="{{ $id }}">
                              <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash" title="Hapus Materi"></span>
                            </form>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
  </div>  
        <!-- /page content -->
                        @if(isset($viewmateri))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($viewmateri as $datamod)
                        @php
                        $nomod++;
                        $materi_ujion=$datamod->materi_ujion;
                        $id_ujion=$datamod->id_ujion;
                        $banyak=$datamod->banyak;
                        $id_ujion=$datamod->id_ujion;
                        $id=$datamod->id;
                        @endphp
<div id="CalenderModalNew7{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel" >Update Materi</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/updtmateri') }}" method="post">
          {{ csrf_field() }}
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <input type="hidden" name="id" value="{{ $id }}">
              <input type="hidden" name="get_id_ujian" value="{{ $get_id_ujian }}">
              <input type="hidden" name="get_kategori" value="{{ $get_kategori }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Materi</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="pilihan" onchange="showhide()" name="pilihmateri">
                      <option value="">Pilihan materi</option>
                        @php
                        $getmateri=DB::table('banksoals')->select('materi')->where('mapel',$get_kategori)->distinct()->get();
                        @endphp
                        @foreach($getmateri as $data)
                        @php
                        $materi=$data->materi;
                        @endphp
                      <option value="{{ $materi }}" @if($materi=='$materi_ujion') selected @endif>{{ $materi }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Set Nomor</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="banyak" name="banyak" value="{{ $banyak }}">
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary antosubmit">Update</button>
          </div>
        </form>
    </div>
  </div>
</div>
                        @endforeach
                        @endif
        <!-- calendar modal -->
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Set Materi">×</button>
          <h4 class="modal-title" id="myModalLabel">Set Materi</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/setmateriPost') }}" method="post">
        {{ csrf_field() }}
          <input type="hidden" name="id_ujion" value="{{ $get_id_ujian }}">
          <input type="hidden" name="get_kategori" value="{{ $get_kategori }}">
            <div class="modal-body">
              <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Materi</label>
                    <div class="col-sm-7">
                      <select class="form-control" id="pilihan" onchange="showhide()" name="pilihmateri">
                        <option value="">Pilihan materi</option>
                          @php
                          $getmateri=DB::table('banksoals')->select('materi')->where('mapel',$get_kategori)->distinct()->get();
                          @endphp
                          @foreach($getmateri as $data)
                          @php
                          $materi=$data->materi;
                          @endphp
                        <option value="{{ $materi }}">{{ $materi }}</option>
                          @endforeach
                      </select>
                      </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Set Nomor</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="nama_ujion" name="banyak_soal" placeholder="Banyak soal">
                    </div>
                </div>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary antosubmit">Tambah</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div id="CalenderModalNew1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Bagikan</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/bagikan') }}" method="post">
        {{ csrf_field() }}
          <input type="hidden" name="id_ujion" value="{{ $get_id_ujian }}">
          <input type="hidden" name="get_kategori" value="{{ $get_kategori }}">
            <div class="modal-body">
              <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kelas</label>
                  <div class="col-sm-7">
                      <select class="form-control" name="kelas">
                        <option value="">Kelas</option>
                        @php
                        $getdata = DB::table('kelas')
                        ->select('nama_kelas')
                        ->get();
                        $katgur = explode('-',$get_kategori);
                        $katguru=$katgur[0];
                        @endphp
                        @foreach($getdata as $data)
                        @php
                        $pilian=$data->nama_kelas;
                        $katkel = explode(' ',$pilian);
                        $katkelas= $katkel[1];
                        @endphp
                        @if($katguru==$katkelas)
                        <option value="{{ $pilian }}">{{ $pilian }}</option>
                        @elseif($katguru=='UMUM')
                        <option value="{{ $pilian }}">{{ $pilian }}</option>
                        @endif
                        @endforeach
                        </select>
                  </div>
                </div>
                <div class="form-group"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary antosubmit">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>


@include('master.footer')