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
                      <h2>Tabel Data Kelas</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                        </ul>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew">Create New</button>
                    <table id="datatable" class="table table-striped table-bordered" border="1">
                      <thead>
                        <tr>
                          <th width="1px"><center>NO</th>
                          <th width="50px"><center>KODE KELAS</th>
                          <th width="70px"><center>KELAS</th>
                          <th width="50px"><center>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($kelas))
                        @php
                        $no=0;
                        @endphp
                        @foreach($kelas as $data)
                        @php
                        $no++;
                        $nama_kelas=$data->nama_kelas;
                        $kode_kelas=$data->kode_kelas;
                        $id=$data->id;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $kode_kelas }}</td>
                          <td>{{ $nama_kelas }}</td>
                          <td>
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew3{{ $no }}"><span class=" fa fa-pencil"></span>
                            <form action="hapuskelasPost" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash"></span>
                            </form>
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
                        @if(isset($kelas))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($kelas as $datamod)
                        @php
                        $nomod++;
                        $kode_kelas=$datamod->kode_kelas;
                        $nama_kelas=$datamod->nama_kelas;
                        $id=$datamod->id;
                        @endphp
<div id="CalenderModalNew3{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Ubah</h4>
      </div>
        <div class="modal-body">
          <div id="testmodal" style="padding: 5px 20px;">
            <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editkelasPost') }}" method="post">
            {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama kelas</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="nama_kelas" value="{{ $nama_kelas }}">
                  </div>
                </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Kode kelas</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="kode_kelas" value="{{ $kode_kelas }}">
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
            <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
          </div>
          <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/addkelasPost') }}" method="post">
            {{ csrf_field() }}
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">kelas</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="nama_kelas">
                  </div>
                </div>
            </div>
            <div class="form-group">
                  <label class="col-sm-3 control-label">Kode kelas</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="kode_kelas">
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