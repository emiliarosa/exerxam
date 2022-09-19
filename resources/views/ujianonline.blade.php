@include ('master.master')
@section('content')

<script type="text/javascript">
          function showhide(){
        var pilihan = document.getElementById("pilihan").value;
        var ketentuan = document.getElementById("ketentuan");
if (pilihan=="Set Waktu Per Soal"){
  ketentuan.style.display="block";
}
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
            @if (session('gagal'))
                  <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Gagal!</strong> {{ session('gagal') }}
                  </div>
                  @endif
                  @if (session('succes'))
                  <div class="alert_succes">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Succes!</strong> {{ session('succes') }}
                  </div>
                  @endif
                    <h2>Tabel Data Siswa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div id="materi_option">
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew3" title="Set Ketentuan">Ketentuan</button>
                  </div>
                    <center><table id="datatable" class="table table-striped table-bordered" border="1">
                      <thead>
                        <tr>
                          <th width="50px"><center>No</th>
                          <th width="400px"><center>Nama Ujian</th>
                          <th width="400px"><center>Ketentuan Ujian</th>
                          <th width="200px"><center>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($ujianonline))
                        @php
                        $no=0;
                        @endphp
                        @foreach($ujianonline as $data)
                        @php
                        $no++;
                        $nama_ujion=$data->nama_ujion;
                        $tipe_ujion=$data->tipe_ujion;
                        $id=$data->id;
                        @endphp
                        <tr>
                          <td><center>{{ $no }}</td>
                          <td>{{ $nama_ujion }}</td>
                          <td>{{ $tipe_ujion }}</td>
                          <td><center>
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew2{{ $no }}"><span class=" fa fa-pencil" title="Edit Nama Ujian"></span>
                            <form action="hapusPost" method="post">
                              {{ csrf_field() }}
                             <input type="hidden" name="id" value="{{ $id }}">
                              <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash" title="Hapus Ujian"></span>
                            </form>
                            <form action="tambah_materi" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_ujian" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal"><span class=" fa fa-upload" title="Input Materi"></button>
                            </form></center>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!-- /page content -->
        @if(isset($ujianonline))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($ujianonline as $datamod)
                        @php
                        $nomod++;
                        $kode_ujion=$datamod->kode_ujion;
                        $nama_ujion=$datamod->nama_ujion;
                        $materi_ujion=$datamod->materi_ujion;
                        $skor_ujion=$datamod->skor_ujion;
                        $tipe_ujion=$datamod->tipe_ujion;
                        $id=$datamod->id;
                        @endphp    
<script type="text/javascript">
          function showhide{{ $nomod }}(){
        var pilihan{{ $nomod }} = document.getElementById("pilihan{{ $nomod }}").value;
        var ketentuan{{ $nomod }} = document.getElementById("ketentuan{{ $nomod }}");
if (pilihan{{ $nomod }}=="Set Waktu Per Soal"){
  ketentuan{{ $nomod }}.style.display="block";
}
else {
  ketentuan{{ $nomod }}.style.display="none";
}
      }
    </script>
         <div id="CalenderModalNew2{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" >Update Nama Ujian</h4>
          </div>
              <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editPost') }}" method="post">
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Ketentuan</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="pilihan{{ $nomod }}" onchange="showhide{{ $nomod }}()" name="pilihketentuan" >
                            <option value="">Pilihan</option>
                            <option value="Set Waktu Per Soal" @if($tipe_ujion=='Set Waktu Per Soal') selected @endif>Set waktu per soal</option>
                            <option value="Tidak Ada" @if($tipe_ujion=='Tidak Ada') selected @endif>Tidak Ada</option>
                    </select>
                  </div>
                </div>
                <div id="ketentuan{{ $nomod }}" style="display: none;">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Menit</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="nama_ujion" name="menit" placeholder="Menit">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Detik</label>
                          <div class="col-sm-5">
                            <input type="text" class="form-control" id="nama_ujion" name="detik" placeholder="Detik">
                          </div>
                        </div>
                      </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama ujian </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="materi" name="nama_ujion" value="{{ $nama_ujion }}" placeholder="Kelas_Nama Ujian_Tanggal">
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
<div id="CalenderModalNew3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Ketentuan</h4>
          </div>
          <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/addketentuanPost') }}" method="post">
            {{ csrf_field() }}
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Ketentuan</label>
                  <div class="col-sm-7">
                    <select class="form-control" id="pilihan" onchange="showhide()" name="pilihketentuan">
                            <option value="" selected>Pilihan</option>
                            <option value="Set Waktu Per Soal">Set waktu per soal</option>
                            <option value="Tidak Ada">Tidak ada</option>
                    </select>
                  </div>
                </div>
                <div id="ketentuan" style="display: none;">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Menit</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_ujion" name="menit" placeholder="Menit">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Detik</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="nama_ujion" name="detik" placeholder="Detik">
                          </div>
                        </div>
                      </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Ujian</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="nama_ujion" name="nama_ujion" placeholder="Kelas_Nama Ujian_Tapel">
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
      </div>
    </div>
  </div>
@include('master.footer')