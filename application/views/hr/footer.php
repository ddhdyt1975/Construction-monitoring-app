</body>

<script src="<?= base_url() ?>assets/all/ajaxFileUpload.js"></script> 
<script src="<?= base_url() ?>assets/plugins/pace/pace.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datepicker/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app.min.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.buttons.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.nonblock.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?= base_url() ?>assets/all/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/all/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/all/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/all/custom.min.js"></script>
<script src="<?= base_url() ?>assets/select2.full.min.js"></script> 
<script src="<?= base_url() ?>assets/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<script type="text/javascript">
   $(".select2").select2();

	$('#calendar').datepicker({
    	todayHighlight: true  
	})
 
  	$('#viewers').slimScroll({
    	height: '400px'

  	}); 
    
  $(".timepicker").timepicker({
              showInputs: false,
              use24hours:true
            });


  	$('#prjstrt').datepicker({
    	todayHighlight: true,
    	autoclose: true
    })

	$('#prjend').datepicker({
     	autoclose: true
	});

  $('#reservation').daterangepicker();
  $('#reservation2').daterangepicker();
  $('#reservation3').daterangepicker();

</script>

</html>