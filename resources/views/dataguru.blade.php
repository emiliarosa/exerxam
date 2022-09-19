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
                    <h2>Tabel Data Guru</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                    </ul>
                    <div class="clearfix"></div>
                </div>
                  <div class="x_content">
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew">Create New</button>
                    <table id="datatable" class="table table-striped table-bordered" height="200px" border="1">
                      <thead>
                        <tr>
                          <th width="10px"><center>NO</th>
                          <th width="100px"><center>NIP</th>
                          <th width="200px"><center>NAMA</th>
                          <th width="100px"><center>GURU</th>
                          <th width="50px"><center>USERNAME</th>
                          <th width="70px"><center>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($dataguru))
                        @php
                        $no=0;
                        @endphp
                        @foreach($dataguru as $data)
                        @php
                        $no++;
                        $nip=$data->nip_guru;
                        $namaguru=$data->nama_guru;
                        $kategoriguru=$data->kategori_guru;
                        $username=$data->username;
                        $id_guru=$data->id_guru;
                        $id_users=$data->id_users;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $nip }}</td>
                          <td>{{ $namaguru }}</td>
                          <td>{{ $kategoriguru }}</td>
                          <td>{{ $username }}</td>
                          <td>
                            @if($id_guru != 1)
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew2{{ $no }}"><span class=" fa fa-pencil"></span>
                            <form action="hapusguruPost" method="post">
                            {{ csrf_field() }}
                              <input type="hidden" name="id_guru" value="{{ $id_guru }}">
                              <input type="hidden" name="id_users" value="{{ $id_users }}">
                              <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash"></span>
                            </form>
                            @endif
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
                        @if(isset($dataguru))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($dataguru as $datamod)
                        @php
                        $nomod++;
                        $nip=$datamod->nip_guru;
                        $namaguru=$datamod->nama_guru;
                        $kategoriguru=$datamod->kategori_guru;
                        $username=$datamod->username;
                        $id_guru=$datamod->id_guru;
                        $id_user=$datamod->id_users;
                        @endphp
<div id="CalenderModalNew2{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" >Update Data Guru</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editguruPost') }}" method="post">
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
        {{ csrf_field() }}
              <input type="hidden" name="id_guru" value="{{ $id_guru }}">
              <input type="hidden" name="id_users" value="{{ $id_users }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $namaguru }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $username }}">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Guru</label>
                  <div class="col-sm-9">
                    @php
                    $getdata = DB::table('mapels')
                    ->select('nama_mapel')
                    ->get();
                    @endphp
                    <select name="kategoriguru" class="form-control" id="kategoriguru">
                    <option value="">Kategori Guru</option>
                    @foreach($getdata as $data)
                    @php
                    $pilian=$data->nama_mapel;
                    @endphp
                    <option value="{{ $pilian }}"@if($pilian==$kategoriguru) selected @endif>{{ $pilian }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="nip_guru" value="{{ $nip }}">
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
            <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editpasswordguruPost') }}" method="post">
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
<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Guru</h4>
      </div>
        <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/addnipguruPost') }}" method="post">
        {{ csrf_field() }}
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">NIP</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="nip_guru">
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