<?php
     $logged_in = $this->session->userdata['logged_in']['user_id']; 
     $position = $this->session->userdata['logged_in']['position'];

    if(empty($logged_in))    {
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('auth');
    } 
    if($position == 'ut1') {
        redirect('Admin');
    }else if($position == 'ut2') {
        redirect('ManagerSM');
    }else if($position == 'ut3') {
        redirect('ManagerM');
    }else if($position == 'utv') {
        redirect('Public_prof');
    }else if($position == 'super') {
        redirect('SuperAdmin');
    }
    
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Attendance
        </h1>
        <ol class="breadcrumb">
            <li  class="active"><a href="HumanR"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active"><a href="HumanA"><i class="fa fa-edit"></i> Attendance</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-5 col-sm-6 col-xs-12">
                <div class="box box-defualt">
                    <div class="box-header">
                        <h3 class="box-title">  Upload DAT (.dat) File</h3>
                    </div>
                    <div class="box-body">
                        <form   id="upload_file">
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-lg-12">
                                        <label>Select File</label>
                                        <input type="file" name="userfile" id="userfile" >
                                    </div>
                                     
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-success btn-sm btn-block" onclick="uploadAtt();">UPLOAD</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7 col-sm-6 col-xs-12">
                <div class="box box-defualt">
                    <div class="box-header">
                        <h3 class="box-title"> List of Uploaded Attendance List</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div> 
                    </div>
                    <div class="box-body">
                        <table id="datatable-hr-att" class="table table-striped table-hover table-bordered dt-responsive wrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>File Upload Date</th>
                                    <th>Uploaded By:</th> 
                                    <th><center>Actions</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_form4" role="dialog">
            <div class="modal-dialog modal-lg" style ="width:auto; margin:20px 20px 20px 20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="dataTable_wrapper">
                                    <table width="100%" class="table table-striped table-bordered table-hover dt-responsive wrap" id="table_raw">
                                        <thead>
                                            <tr><th>Emp Id</th><th>Date</th><th>Time</th></tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><th>Emp Id</th><th>Date</th><th>Time</th></tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
    var table, table4;
    
    $(document).ready(function() {
        $('#hatt').attr("class","active");
        table4 = $('#table4').DataTable();

        var handleDataTableButtons = function() {
            if ($("#datatable-hr-att").length) {
                table = $("#datatable-hr-att").DataTable({
                    ajax: {
                        "url": "<?php echo site_url('HumanA/ajax_list')?>",
                        "type": "POST"
                    },
                    keys: true,
                    order: [[1, 'asc']],
                    dom: "Bfrtip",
                    buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        },{
                            extend: "csv",
                            className: "btn-sm"
                        },{
                            extend: "excel",
                            className: "btn-sm"
                        },{
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },{
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons();
                }
            };
        }();
        TableManageButtons.init();
    });

    function reload_table(){
        table.ajax.reload(null,false); 
    }



    function uploadAtt(){
        $.ajaxFileUpload({
            url             :"<?php echo site_url('HumanA/do_upload/')?>", 
            secureuri       :false,
            fileElementId   :'userfile',
            dataType: 'JSON',
            success : function (data){
                //alert(data);
                reload_table();
                if(data=="error1"){
                    new PNotify({
                        title: 'Error!',
                        text: 'Error uploading data. Please contact the administrator.',
                        type: 'error',
                        styling: 'bootstrap3'
                      });      
                }
                else if (data.length<41){
                    new PNotify({
                        title: 'Info!',
                        text: 'Please select file to upload.',
                        type: 'info',
                        styling: 'bootstrap3'
                      });      
                }
                else{
                    new PNotify({
                        title: 'Update Status',
                        text: 'File uploaded succesfully. Data saved to Database.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                } 
            },
            error: function (jqXHR, textStatus, errorThrown){
               
            }
        });
        return false;
    } 

    function viewraw(id){
        table4.destroy();
        $('#modal_form4').modal('show'); 
        $('.modal-title').text('Raw list from file ('+id+')'); 
        table4 = $('#table_raw').DataTable({ 
            "ajax": {
            "url": "<?php echo site_url('HumanA/load_file_raw')?>/"+id,
            "type": "POST"
            },
            order: [[1, 'asc'],[2, 'asc']],
            keys: true,
            dom: "Bfrtip",
            buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                },{
                    extend: "csv",
                    className: "btn-sm"
                },{
                    extend: "excel",
                    className: "btn-sm"
                },{
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },{
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });
    }

    function deletefile(id){
        if(confirm('Are you sure delete this data?')){
             $.ajax({
                url : "<?php echo site_url('HumanA/de')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    
                    reload_table();
                    if (data=="ok"){
                        new PNotify({
                            title: 'Status',
                            text: 'Deleted successfully.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    }
                    else{
                        new PNotify({
                            title: 'Error!',
                            text: 'A process cannot get through. Please consult your admin.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });    
                    }
                },
                error: function (jqXHR, textStatus, errorThrown){
                    new PNotify({
                        title: 'Error!',
                        text: 'A process cannot get through. Please consult your admin.',
                        type: 'error',
                        styling: 'bootstrap3'
                    }); 
                }
            });

        }
    }
</script>
