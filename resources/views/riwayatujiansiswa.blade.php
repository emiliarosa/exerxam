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
                    <h2>Riwayat Ujian Siswa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered" height="200px" border="1">
                      <thead>
                        <tr>
                          <th width="10px"><center>NO</th>
                          <th width="100px"><center>MATA PELAJARAN</th>
                          <th width="200px"><center>NAMA UJIAN</th>
                          <th width="100px"><center>KETENTUAN</th>
                          <th width="70px"><center>NILAI</th>
                          <th width="70px"><center>GRAFIK PENGERJAAN</th>
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
                        $matapelajaran=$data->kategori_guru;
                        $namaujian=$data->nama_ujion;
                        $ketentuan=$data->tipe_ujion;
                        $id_ujian=$data->id;
                        $jawaban=$data->jawaban;
                        $skor = $data->skor;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $matapelajaran }}</td>
                          <td>{{ $namaujian }}</td>
                          <td>{{ $ketentuan }}</td>
                          <td>{{ $skor }}</td>
                          <td>
                          <center><form action="grafiksiswa" method="post">    
                              {{ csrf_field() }}
                              <input type="hidden" name="id_uji" value="{{ $id_ujian }}">
                          <button type="submit" class="btn btn-warning btn-sm" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal">Grafik
                        </form></center></td>
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
                  </div>
@include('master.footer')