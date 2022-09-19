@include ('master.master')
@section('content')
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
                      <div class="clearfix"></div>
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Perkembangan Akademik Siswa Dalam Menjawab Soal <small>Diagram Garis</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a></li>
                                        <li><a href="#">Settings 2</a></li>
                                      </ul>
                                  </li>
                                  <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content2">
                                <div id="siswaChart" style="width:100%; height:300px;"></div>
                              </div>
                            </div>
                          </div>
                        </div>
              </div>
        </div>
        </div>
        </div>
        </div>
        </div> 
        <!-- page content -->
        <!-- footer content -->
@include('master.footer')
<script type="text/javascript">
  if ($('#siswaChart').length ){   
    Morris.Line({
    element: 'siswaChart',
    xkey: 'no',
    ykeys: ['value'],
    labels: ['Value'],
    yLabelFormat: function(y) {
      if (y == 0){
        return "Mudah";
      }
      else if (y == 10){
        return "Sedang";
      }
      else if (y == 20){
        return "Sulit";
      }
      else{
        return "";
      }
      },
    hideHover: 'auto',
    parseTime: false,
    lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
    data: [
    @if(isset($grp))
    @php
      $no=0;
    @endphp
    @foreach($grp as $data)
    @php
      $no++;
    @endphp
    @foreach($data as $data1)
    @php
      $nil=$data["nil"];
    @endphp
    @endforeach
     {no: '{{ $no }}', value: {{ $nil }} },
    @endforeach
    @endif
    ],
      resize: true
    });
      $MENU_TOGGLE.on('click', function() {
      $(window).resize();
    });     
    }
</script>