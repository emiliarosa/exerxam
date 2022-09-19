<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buat Soal | Exarxam</title>
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="tesmathfix/ckeditor4/ckeditor.js"></script>
  </head>

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
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-pencil"></i> Buat Soal </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Pembobotan Soal</span></a>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Bank Soal</a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Ujian Online </a>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Ujian Offline</a>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Riwayat Soal</span></a>
                  </li>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Diagram nilai</span></a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <!-- /menu footer buttons -->
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
                    <img src="images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
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
                    <h2>Buat Soal </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- Smart Wizard -->
                    <p>Tahapan membuat soal</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                Step 1<br />
                                  <small>Input materi dan kategori</small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                Step 2<br />
                                  <small>Input soal</small>
                            </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                Step 3<br />
                                  <small>Step 3 Hasil Input</small>
                            </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                        <form class="form-horizontal form-label-left">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mapel">Mata Pelajaran<span class="required"></span>
                            </label>
                            <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option>Biologi</option>
                            <option>Fisika</option>
                          </select>
                        </div>
                      </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="materi">Materi<span class="required"></span>
                            </label>
                            <div class="form-group">
                        <div class="col-md-5 col-sm-5 col-xs-6">
                          <select class="form-control">
                            <option>Makhluk hidup</option>
                            <option>Bioteknologi</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="materi">
                            </div>
                      </div>
                          </div>
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control">
                            <option>Pilihan ganda 4</option>
                            <option>Pilihan ganda 5</option>
                            <option>Essay</option>
                          </select>
                        </div>
                          </div>
                        </form>
                      </div>
                      <div id="step-2">
                        <h2 class="StepTitle">Step 2 Content</h2>
                        <div id="step-1">
                        <form class="form-horizontal form-label-left">
                            <textarea name="soal" id="editor_question">Soal</textarea>
                            <textarea name="jwb_benar" id="editor_question0">Jawaban Benar</textarea>
                         </div>
                            <script>
              CKEDITOR.config.toolbar_Full =
                  [
                  { name: 'document', items : [ 'Source'] },
                  { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                  { name: 'editing', items : [ 'Find'] },
                  { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
                  { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
                  ];
              CKEDITOR.config.height = '40px';
              CKEDITOR.plugins.addExternal('divarea', '../examples/extraplugins/divarea/', 'plugin.js');
              CKEDITOR.config.removePlugins = 'maximize';
              CKEDITOR.config.removePlugins = 'resize';
              CKEDITOR.replace('editor_question', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
              CKEDITOR.replace('editor_question0', {
                   extraPlugins: 'divarea,ckeditor_wiris',
                   language: 'en'
              });
          </script>
                          <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jawaban">Level<span class="required"></span>
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-6">
                          <select class="form-control">
                            <option>Mudah</option>
                            <option>Sedang </option>
                            <option>Sulit</option>
                          </select>
                        </div>
                          </div>
                          </div>
                      <div id="step-3">
                        
              <br><br><br>
                        <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Soal</th>
                          <th>Pilihan</th>
                          <th>Guru yang belum memberi bobot</th>
                          <th>Jawaban</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>PGBD01</td>
                          <td>Apa rumus persegi panjang</td>
                          <td>a. p x l || b. s x s || c. (a x t)/2 || d. a x l x t</td>
                          <td>Gito, Bambang, Aini</td>
                          <td>a</td>
                        </tr>
                      </tbody>
                    </table>
                      </div>
                    
                    <!-- End SmartWizard Content -->
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
    </script>
    <div class="pull-right">
            Copyright @2019 <a href="">1635010003_SI'16</a>
          </div>
  </body>
</html>