<!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright @2019 <a href="">1635010003_SI'16</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        <!-- jQuery -->
    <script src="gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="gentelella/vendors/iCheck/icheck.min.js"></script>
    <!-- ChartJS -->
    <script src="gentelella/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- Datatables -->
    <script src="gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="gentelella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="gentelella/build/js/custom.min.js"></script>
    <!-- morris.js -->
    <script src="gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="gentelella/vendors/morris.js/morris.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
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
  </body>
</html>