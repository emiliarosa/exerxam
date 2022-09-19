@include ('master.master')
@section('content')
<!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Media Edukasi "Exerxam" <small>SMA N 1 Sukodadi - Lamongan</small></h3>
        </div>
          <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
         </div>
          <div class="clearfix">
            <div class="row"></div>
              <div class="col-md-12">
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
                      <h2>Riwayat Soal</h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                  </div>
                  <div class="x_content"></div>
                   <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 10%">No</th>
                          <th>Nama Ujian</th>
                          <th>Grafik Perkembangan Akademik</th>
                          <th>Nilai Siswa</th>
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
                        $id_siswa=$data->id_siswa;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $nama_ujion }}</td>
                          <td>
                            <form action="grafik" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_ujian" value="{{ $data->id }}">
                                <button type="submit" class="btn btn btn-success btn-md""id="fc_create" data-toggle="modal" ><span class="fa fa-line-chart" title="Input Materi">Grafik</button>
                            </form>
                          </td>
                          <td>
                            <form action="tabelnilai" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_ujian" value="{{ $data->id }}">
                                <input type="hidden" name="id_siswa" value="{{ $id_siswa }}">
                                <button type="submit" class="btn btn-warning btn-md" id="fc_create" data-toggle="modal"><span class=" fa fa-upload" title="Input Materi">View</button>
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
            </div>
          </div>
                    <!-- end project list -->
        <!-- /page content -->
         @include('master.footer')
       