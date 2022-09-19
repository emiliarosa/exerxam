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
                      <script type="text/javascript">
                        window.onload=function(){
                        var table = document.getElementById('datatable'),
                        download=document.getElementById('download');
                        download.addEventListener('click,function(){
                        windw.open('data:application/vnd.ms-excel,' + encodeURIComponent(table.outerHTML)});
                        }
                      </script>
                        <body>  
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
                    <a type="button" href="exportexcel/{{$id_uji}}" class="btn btn-round btn-primary" target="_blank" >Cetak</a>
                    <table id="datatable" class="table table-striped table-bordered" height="200px" border="1">
                      <thead>
                        <tr>
                          <th width="10px"><center>NO</th>
                          <th width="100px"><center>Nama</th>
                          <th width="100px"><center>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($tabelnilai))
                        @php
                        $no=0;
                        @endphp
                        @foreach($tabelnilai as $data)
                        @php
                        $no++;
                        $nama_siswa=$data->nama_siswa;
                        $skor=$data->skor;
                        $id=$data->id;
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $nama_siswa }}</td>
                          <td>{{ $skor }}</td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </body>
        <!-- /page content -->
        <!-- calendar modal -->
      </div>
    </div>
  </div>
@include('master.footer')