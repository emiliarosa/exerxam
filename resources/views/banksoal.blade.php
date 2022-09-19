@include ('master.master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        @php
          use App\Models\bobot;
          use App\Models\guru;
          $get_id_guru=Session::get('id_guru');
          $get_kategori=Session::get('kategori');
        @endphp
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
                  <h2>Tabel Bank Soal</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                          <th>No</th>
                          <th>Kode Soal</th>
                          <th>Soal</th>
                          <th>Pilihan</th>
                          <th>Jawab</th>
                          <th>Materi</th>
                          <th>Bobot</th>
                          <th>Level</th>
                          <th class="bulk-actions" colspan="7">
                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                          </th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($result))
                        @php
                        $no=0;
                        @endphp
                        @foreach($result as $data)
                        @php
                        $no++;
                        $kodesoal=$data->kodesoal;
                        $soal=$data->soal;
                        $jawab=$data->jawab;
                        $hasil_jawab=$data->hasil_jawab;
                        $materi=$data->materi;
                        $bobot=$data->bobot;
                        $level=$data->level;
                        $id_guru=$data->id_guru;
                        $id=$data->id;
                        $setgurubobot="";
                        $getdataguru=guru::where('kategori_guru',$get_kategori)->get()->count();
                        $cek = bobot::where('id_soal', '=', $id)->get()->count();
                        @endphp
                        @if($cek==$getdataguru)
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $kodesoal }}</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($soal)); @endphp</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($jawab)); @endphp</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($hasil_jawab)); @endphp</td>
                          <td>{{ $materi }}</td>
                          <td>{{ $bobot }}</td>
                          <td>
                            @if($bobot>=1 && $bobot<=3)
                            Mudah
                            @elseif($bobot>3 && $bobot<=6)
                            Sedang
                            @elseif($bobot>6 && $bobot<=10)
                            Sulit
                            @endif
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                        </tbody>
                      </table>
                      </div>
                      </div>
@include('master.footer')