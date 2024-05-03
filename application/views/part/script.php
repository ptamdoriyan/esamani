<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/js/detect.js"></script>
<script src="<?= base_url()?>assets/js/fastclick.js"></script>
<script src="<?= base_url()?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url()?>assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url()?>assets/js/waves.js"></script>
<script src="<?= base_url()?>assets/js/wow.min.js"></script>
<script src="<?= base_url()?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url()?>assets/js/jquery.scrollTo.min.js"></script>



<!-- datatable -->
<script src="<?= base_url()?>assets/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<!-- <script src="<?= base_url()?>assets/pages/jquery.bs-table.js"></script> -->


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
    } );

    // $(document).ready(function() {
    //     $('#timetable').dataTable({
    //         searching:      false,
    //         ordering:       false,
    //         paging:         false,
    //         info:           false
    //     });
    // } );

    $(document).ready(function() {
        var table = $('#all').DataTable( {
            scrollY:        "350px",
            scrollX:        true,
            scrollCollapse: true,
            ordering:       false,
            paging:         false,
            fixedColumns:   {
                leftColumns: 2,
            }
            // ,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });

    $(document).ready(function() {
        var table = $('#all2').DataTable( {
            scrollY:        "350px",
            scrollX:        true,
            scrollCollapse: true,
            ordering:       false,
            paging:         false,
            fixedColumns:   {
                leftColumns: 2,
                rightColumns: 3
            }
            // ,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });

    $(document).ready(function() {
        var table = $('#all3').DataTable( {
            scrollY:        "350px",
            scrollX:        true,
            scrollCollapse: true,
            ordering:       false,
            paging:         false,
            fixedColumns:   {
                leftColumns: 2,
                rightColumns: 2
            }
            // ,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ]
        });
    });
</script>

<script src="<?= base_url()?>assets/plugins/moment/moment.js"></script>
<script src="<?= base_url()?>assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="<?= base_url()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?= base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        })
	});
</script>
<script src="<?= base_url()?>assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="<?= base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- notify -->
<script src="<?= base_url()?>assets/plugins/notifyjs/js/notify.js"></script>
<script src="<?= base_url()?>assets/plugins/notifications/notify-metro.js"></script>

<!-- form validation -->
<script type="text/javascript" src="<?= base_url()?>assets/plugins/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('form').parsley();
	});
</script>
        
        


<script src="<?= base_url()?>assets/js/jquery.core.js"></script>
<script src="<?= base_url()?>assets/js/jquery.app.js"></script>

<!-- Chart JS -->
<script src="<?= base_url()?>assets/plugins/chart.js/chart.min.js"></script>
<!-- <script src="<?= base_url()?>assets/pages/jquery.chartjs.init.js"></script> -->

<script src="<?= base_url()?>assets/pages/jquery.form-pickers.init.js"></script>
        
        
<script src="<?= base_url()?>assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(function($) {
	  $('.autonumber').autoNumeric('init', {mDec: '0'}); 
  });
</script>
        	  