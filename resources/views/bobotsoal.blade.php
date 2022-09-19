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
                    <p class="text-muted font-13 m-b-30">
                      Jika ada salah satu guru belum memberi bobot soal, maka soal TIDAK bisa digunakan untuk ujian online dan offline.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Soal</th>
                          <th>Soal</th>
                          <th>Pilihan</th>
                          <th>Jawab</th>
                          <th>Materi</th>
                          <th>Guru yang belum memberi bobot</th>
                          <th>Bobot</th>
                          <th>Level</th>
                          <th>Pemberian bobot</th>
                          <th>Action</th>
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
                        $getdataguru=guru::where('kategori_guru',$get_kategori)->get();
                        
                        foreach($getdataguru as $dataguru){
                        $getidgurus=$dataguru->id;
                        $cek = bobot::where('id_soal', '=', $id)->where('id_guru', '=', $getidgurus)->get()->count();
                          if($cek==0){
                            $getnamaguru=$dataguru->nama_guru;
                              if($setgurubobot==""){
                                $setgurubobot="$getnamaguru";
                              }
                              else{
                                $setgurubobot="$setgurubobot, $getnamaguru";
                              }
                          }
                        }
                        @endphp
                        <tr>
                          <td>{{ $no }}</td>
                          <td>{{ $kodesoal }}</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($soal)); @endphp</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($jawab)); @endphp</td>
                          <td>@php echo htmlspecialchars_decode(stripslashes($hasil_jawab)); @endphp</td>
                          <td>{{ $materi }}</td>
                          <td>{{ $setgurubobot }}</td>
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
                          <td><input type="hidden" name="id" value="{{ $id }}">
                            <a type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew7{{ $no }}"><i class="fa fa-folder" ></i> Bobot </a></td>
                          <td>
                            @if($id_guru == $get_id_guru)
                            <form action="hapussoalPost" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash"></span></button>
                            </form>
                            <form action="editsoal" method="post">
                              <input type="hidden" name="id" value="{{ $id }}">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-round btn-success" id="fc_create" name="edit"><span class=" fa fa-pencil"></span></button>
                            </form>
                            @endif
                        </tr> 
                        @endforeach
                        @endif 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                        @if(isset($result))
                        @php
                        $nomod=0;
                        @endphp
                        @foreach($result as $datamod)
                        @php
                        $nomod++;
                        $kodesoal=$datamod->kodesoal;
                        $kategori_soal=$datamod->kategori_soal;
                        $soal=$datamod->soal;
                        $jawab=$datamod->jawab;
                        $hasil_jawab=$datamod->hasil_jawab;
                        $materi=$datamod->materi;
                        $mapel=$datamod->mapel;
                        $bobot=$datamod->bobot;
                        $level=$datamod->level;
                        $id_soal=$datamod->id;
                        @endphp
  <!-- /footer content -->
    <div id="CalenderModalNew7{{ $nomod }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tentukan Bobot</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form" action="{{ url('/bobotPost') }}" method="post">
              <input type="hidden" name="id_guru" value="{{ $get_id_guru }}">
              <input type="hidden" name="id_soal" value="{{ $id_soal }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="col-sm-3 control-label">Bobot</label>
                  <div class="col-sm-7">
                  <select class="form-control" name="bobot">
                  <option value="1">1 (Mudah)</option>
                  <option value="2">2 (Mudah)</option>
                  <option value="3">3 (Mudah)</option>
                  <option value="4">4 (Medium)</option>
                  <option value="5">5 (Medium)</option>
                  <option value="6">6 (Medium)</option>
                  <option value="7">7 (Medium)</option>
                  <option value="8">8 (Sulit)</option>
                  <option value="9">9 (Sulit)</option>
                  <option value="10">10 (Sulit)</option>
                </select>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary antosubmit">Add</button>
          </div>
              </form>
        </div>
      </div>
    </div>
                    @endforeach
                    @endif
        	          @include('master.footer')