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
                          <th width="200px"><center>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($ujianoffline))
                        @php
                        $no=0;
                        @endphp
                        @foreach($ujianoffline as $data)
                        @php
                        $no++;
                        $nama_ujioff=$data->nama_ujioff;
                        $id=$data->id;
                        @endphp
                        <tr>
                          <td><center>{{ $no }}</td>
                          <td>{{ $nama_ujioff }}</td>
                          <td><center>
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew2{{ $no }}"><span class=" fa fa-pencil" title="Edit Nama Ujian"></span>
                            <form action="hapusoffPost" method="post">
                              {{ csrf_field() }}
                             <input type="hidden" name="id" value="{{ $id }}">
                              <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash" title="Hapus Ujian"></span>
                            </form>
                            <form action="tambahmaterioffline" method="post">
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
        @if(isset($ujianoffline))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($ujianoffline as $datamod)
                        @php
                        $nomod++;
                        $nama_ujioff=$datamod->nama_ujioff;
                        $materi_ujioff=$datamod->materi_ujioff;
                        $id=$datamod->id;
                        @endphp

         <div id="CalenderModalNew2{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" >Update Nama Ujian</h4>
          </div>
              <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/editujioffline') }}" method="post">
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama ujian </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="materi" name="nama_ujioff" value="{{ $nama_ujioff }}">
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
          <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/namaujioff') }}" method="post">
            {{ csrf_field() }}
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Ujian</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="nama_ujioff" name="nama_ujioff" placeholder="Nama Ujian_Kelas_Tapel">
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