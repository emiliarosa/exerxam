@include ('master.master')
@section('content')
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
                      <div class="clearfix"></div>
                        <div class="row">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Pemahaman Siswa Per Materi Dalam Bentuk Prosentase<small>Diagram Lingkaran</small></h2>
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
                            <div class="x_content">
                              <canvas id="guruChart"></canvas>
                            </div>
                            </div>
                          </div>
                        </div>
                        <table>
                                            @php
                                              $i=0;
                                            @endphp
                                            @foreach($materi as $value)
                                          <tr>
                                            @php
                                              $i++;
                                              $a=0;
                                            @endphp
                                            <td> {{ $value }} </td>
                                            @foreach($presentase as $value)
                                            @php
                                              $a++;
                                            @endphp
                                            @if($a==$i)
                                            <td align="center"> {{ $value }} </td>
                                            @endif
                                            @endforeach
                                          </tr>
                                            @endforeach

                                            
                        </table>
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
  $(document).ready(function() {
    // Pie chart
    if ($('#guruChart').length ){  
      var ctx = document.getElementById("guruChart");
      var data = {datasets: [{
          data: [
          <?php 
            foreach($presentase as $value){
              echo "'$value',";
            }
          ?>
      ],
        backgroundColor: [
        "#00FFFF",
        "#7FFF00",
        "#FF1493",
        "#FFD700",
        "#FFDEAD",
        "#FF4500",
        "#4B0082",
        "#FFFFF0",
        "#FF0000",
        "#FFFF00"
        ],
        label: 'My dataset' // for legend
      }],
      labels: [
        <?php 
          foreach($materi as $value){
            echo "'$value',";
          }
        ?>
      ]
      };
      var pieChart = new Chart(ctx, {
      data: data,
      type: 'pie',
      otpions: {
        legend: false
      }
      });
    }
  });
</script>