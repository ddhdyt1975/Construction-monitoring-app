<script src="<?= base_url() ?>assets/all/ajaxFileUpload.js"></script> 
<script src="<?= base_url() ?>assets/plugins/pace/pace.min.js"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datepicker/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app.min.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.buttons.js"></script>
<script src="<?= base_url() ?>assets/all/pnotify.nonblock.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script type="text/javascript"> 
 
    $(function(){
        $('#comments ul').slimScroll({
            height:'380px'
        });

        $('#prjtsk').slimScroll({
            height:'400px'
        });

        

        $('#prjdetails').slimScroll({
            height:'350px'
        });
    });
</script>


<script type="text/javascript">
  $(document).ready(function () {
    $('#dataTables-material').dataTable();
    $('#dataTables-equipment').dataTable();
    $('#dataTables-teu').dataTable();
    $('#dataTables-eee').dataTable();
    $('#dataTables-sss').dataTable();
    $('#dataTables-sss2').dataTable();
    $('#dataTables-users').dataTable();
    $('#attendance_worker').dataTable();
    $('#attendance_worker_list').dataTable();
  });
</script>


 
<script >

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
 

    $('#repdate').datepicker({
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

</script>



</body>

</html>
