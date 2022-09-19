<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Media Edukasi "Exerxam"</title>
  <!-- Favicon -->
  <link href="argon/assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="argon/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="argon/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="argon/assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
  @if(session('succes'))
  <script>alert(" {{ session('succes') }} " );</script>
  @endif
  @if(session('failed'))
  <script>alert(" {{ session('failed') }} " );</script>
  @endif
  @if ($errors->any())
  @foreach ($errors->all() as $error)
  @php
  echo "<script>alert(' $error ' );</script>";
  @endphp
  @endforeach
  @endif
  @if(isset($result))
  @php
  echo "<script>alert(' $result ' );</script>";
  @endphp
  @endif
    <!-- Header -->
    <div class="header bg-gradient-primary py-2 py-lg-3">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">EXERXAM Welcome!</h1>
              <br><br>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" action="{{ url('/registerguruPost') }}" method="post">
              {{ csrf_field() }}
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend"></div>
                    <input class="form-control" placeholder="Nama" type="text" name="namaguru">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend" >
                    </div>
                    @php
                    $getdata = DB::table('mapels')
                    ->select('nama_mapel')
                    ->get();
                    @endphp
                    <select name="kategoriguru" class="form-control">
                    <option value="">Kategori Guru</option>
                    @foreach($getdata as $data)
                    @php
                    $pilian=$data->nama_mapel;
                    @endphp
                    <option value="{{ $pilian }}">{{ $pilian }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                    </div>
                    <input class="form-control" placeholder="NIP" type="text" name="nip">
                  </div>
                </div>
                  <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                    </div>
                    <input class="form-control" placeholder="Username" type="text" name="username">
                  </div>
                </div>
                    <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                    </div>
                    <input class="form-control" placeholder=" Konfirm Password" type="password" name="konfirmpassword">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-2">Create account</button>
                </div>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-1">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  </div>
  <!--   Core   -->
  <script src="argon/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="argon/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="argon/assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>