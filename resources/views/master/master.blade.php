@include('master.head')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-joomla"></i> <span>EXERXAM</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <header class="main_menu_area">
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="gentelella/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                @if (session ()->has('nama'))
                @php
                $nama=Session::get('nama');
                $get_id_guru=Session::get('id_guru');
                @endphp
                <h2>{{ $nama }}</h2>
                @endif
              </div>
            </div>
          </header>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>MENU</h3>
                <ul class="nav side-menu">
                  @if(session()->has('kategori'))
                  @php
                  $kategori=Session::get('kategori');
                  @endphp
                  @if($kategori=='admin')
                  <li><a href="dataguru"><i class="fa fa-users"></i> Data Guru </a>
                  </li>
                  <li><a href="datasiswa"><i class="fa fa-user"></i> Data Siswa </a>
                  </li>
                  <li><a href="mapel"><i class="fa fa-users"></i> Pelajaran </a>
                  </li>
                  <li><a href="kelas"><i class="fa fa-user"></i> Kelas </a>
                  </li>
                  @elseif($kategori=='siswa')
                  <li><a href="ujionsiswa"><i class="fa fa-table"></i> Ujian Online </a>
                  </li>
                  <li><a href="riwayatujiansiswa"><i class="fa fa-bar-chart-o"></i> Riwayat Ujian</a>
                  </li>
                  @else
                  <li><a href="buatsoal"><i class="fa fa-pencil"></i> Buat Soal </a>
                  </li>
                  <li><a href="bobotsoal"><i class="fa fa-edit"></i> Pembobotan Soal</span></a>
                  </li>
                  <li><a href="banksoal"><i class="fa fa-desktop"></i> Bank Soal</a>
                  </li>
                  <li><a href="ujianonline"><i class="fa fa-table"></i> Ujian Online </a>
                  </li>
                  <li><a href="ujianoffline"><i class="fa fa-bar-chart-o"></i> Ujian Offline</a>
                  </li>
                  <li><a href="riwayatsoal"><i class="fa fa-clone"></i>Riwayat Soal</span></a>
                  </li>
                  </li>
                  @endif
                  @endif
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="gentelella/production/images/img.jpg" alt="">
                @if (session()->has('nama'))
                @php
                $nama=Session::get('nama');
                @endphp
                {{ $nama }}
                @endif
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
@yield('content')