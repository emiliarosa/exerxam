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
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <button type="button" class="btn btn-round btn-primary" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew">Create New</button>
                    <table id="datatable" class="table table-striped table-bordered" height="200px" border="1">
                      <thead>
                        <tr>
                          <th width="10px"><center>NO</th>
                          <th width="200px"><center>Soal</th>
                          <th width="100px"><center>Materi</th>
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
                            <button type="button" class="btn btn-round btn-success" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew2{{ $no }}"><span class=" fa fa-pencil"></span>
                            <form action="hapusguruPost" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="id_guru" value="{{ $id_guru }}">
                             <input type="hidden" name="id_users" value="{{ $id_users }}">
                              <button type="submit" class="btn btn-round btn-danger" onclick="return confirm('Are you sure?');"><span class=" fa fa-trash"></span>
                            </form>
                            <button type="button" class="btn btn-round btn-warning" id="fc_create" data-toggle="modal" data-target="#CalenderModalNew3{{ $no }}"><span class=" fa fa-lock"></span></button></td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!-- /page content -->
      </div>
    </div>
  </div>
@include('master.footer')