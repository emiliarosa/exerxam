@include ('master.master')
@section('content')
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
                  @if (isset($succes))
                <div class="alert_succes">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                  <strong>Succes!</strong> {{ $succes }}
                </div>
                  @endif
                  <h2>Tabel Data Siswa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> </li>                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModal">Create New</button>
                    <center><table id="datatable" class="table table-striped table-bordered" border="1">
                      <thead>
                        <tr>
                          <th width="10px"><center>NO</th>
                          <th width="100px"><center>NISN</th>
                          <th width="200px"><center>NAMA</th>
                          <th width="70px"><center>KELAS</th>
                          <th width="50px"><center>USERNAME</th>
                          <th width="70px"><center>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($datasiswa))
                        @php
                        $no=0;
                        @endphp
                        @foreach($datasiswa as $data)
                        @php
                        $no++;
                        $nisn=$data->nisn;
                        $namasiswa=$data->nama_siswa;
                        $kelas=$data->kelas;
                        $username=$data->username;
                        $id_siswa=$data->id_siswa;
                        $id_users=$data->id_users;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $nisn }}</td>
                          <td>{{ $namasiswa }}</td>
                          <td>{{ $kelas }}</td>
                          <td>{{ $username }}</td>
                          <td>
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew2{{ $no }}"><span class=" fa fa-pencil"></span>
                            <form action="hapussiswaPost" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_siswa" value="{{ $id_siswa }}">
                            <input type="hidden" name="id_users" value="{{ $id_users }}">
                            <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash"></span>
                            </form>
                            <button type="button" class="btn btn-round btn-warning" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew3{{ $no }}"><span class=" fa fa-lock"></span></button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!-- /page content -->
                        @if(isset($datasiswa))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($datasiswa as $datamod)
                        @php
                        $nomod++;
                        $nisn=$datamod->nisn;
                        $namasiswa=$datamod->nama_siswa;
                        $kelas=$datamod->kelas;
                        $username=$datamod->username;
                        $id_siswa=$datamod->id_siswa;
                        $id_user=$datamod->id_users;
                        @endphp
<div id="CalenderModalNew2{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" >Update Data Siswa</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editsiswaPost') }}" method="post">
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
        {{ csrf_field() }}
              <input type="hidden" name="id_siswa" value="{{ $id_siswa }}">
              <input type="hidden" name="id_users" value="{{ $id_users }}">
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $namasiswa }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $username }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kelas</label>
                  <div class="col-sm-9">
                    @php
                    $getdata = DB::table('kelas')
                    ->select('nama_kelas')
                    ->get();
                    @endphp
                    <select name="kelas" class="form-control" value="{{ $kelas }}">
                    <option value="" selected >Kelas</option>
                    @foreach($getdata as $data)
                    @php
                    $pilian=$data->nama_kelas;
                    @endphp
                    <option value="{{ $pilian }}" "@if($pilian==$kelas) selected @endif>{{ $pilian }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NISN</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="nisn" value="{{ $nisn }}">
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
<div id="CalenderModalNew3{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editpasswordsiswaPost') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_users" value="{{ $id_users }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="passbaru">
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
<div id="CalenderModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Siswa</h4>
      </div>
      <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/addnisnPost') }}" method="post">
      {{ csrf_field() }}
        <div class="modal-body">
          <div id="testmodal" style="padding: 5px 20px;">
            <div class="form-group">
              <label class="col-sm-3 control-label">NISN</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="title" name="nisn">
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
@include('master.footer')