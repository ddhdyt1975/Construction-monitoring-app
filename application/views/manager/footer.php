

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
<script src="<?= base_url() ?>assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/all/custom.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
 
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script> 
<script src="<?= base_url() ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-buttons/js/dataTables.buttons.min.js"></script> 
<script src="<?= base_url() ?>assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?= base_url() ?>assets/datatables.net-scroller/js/datatables.scroller.min.js"></script> 

   
<!-- AdminLTE App --> 
<script src="<?= base_url() ?>assets/plugins/knob/jquery.knob.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTables-material').dataTable();
    $('#dataTables-equipment').dataTable();
    $('#dataTables-teu').dataTable();
    $('#dataTables-tmu').dataTable();
    $('#dataTables-eee').dataTable();
    $('#dataTables-sss').dataTable();
    $('#dataTables-sss2').dataTable();
    $('#dataTables-users').dataTable();
    $('#attendance_worker').dataTable();
    $('#attendance_worker_list').dataTable();
  });
</script>



<script >
     
    $(function(){
        $('#body').slimScroll({
            height:'auto'
        });
    });
    
    $(function(){
        $('#achv_box').slimScroll({
            height:'500px'
        });
    });

    $(function(){
        $('#c1').slimScroll({
            height:'500px'
        });
    });

    $(function(){
        $('#cc').slimScroll({
            height:'500px'
        });
    });

</script>

 


<script >
d = new Date();
$('#repdate').datepicker('setDate', new Date(d.getFullYear(),d.getMonth(),d.getDate()));
    $('#prjstrt').datepicker({
     })
  

    $('#prjend').datepicker({
     })
 

  $('#tskdate').datepicker({
        todayHighlight: true
    })
 
    $('#tskdate2').datepicker({
        todayHighlight: true
    })
 

    // $('#repdate').datepicker({
    //     todayHighlight: true
    // })
 
 
    $('#calendar').datepicker({
        todayHighlight: true
    })

</script>

<script>
  
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    } 

    //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });

   /* The todo list plugin */
  

</script>

</body>
</html>
