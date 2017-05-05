<?=doctype('html5').PHP_EOL?>
<html>
<head> 
    <meta charset="utf-8">
    <?= meta('X-UA-Compatible','IE=edge','equiv')?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Details</title>
    <link href="<?php echo base_url(ASSET.'/theme/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSET.'/theme/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url(ASSET.'/theme/plugins/datepicker/datepicker3.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head> 
<body>
 
    <div class="container">
        <h1 style="font-size:20pt">Employee Details</h1>
        <div class="text-right">
            <button class="btn btn-success pull-right1" onclick="add_employee()"><i class="glyphicon glyphicon-plus"></i> Add Employee</button>
            <button class="btn btn-default pull-right1" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            <a href="<?=site_url(ADMIN.'/logout')?>" class="btn btn-danger" role="button">Logout</a>
        </div>
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    </div>
 
 
<script src="<?=base_url(ASSET.'/theme/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
<script src="<?=base_url(ASSET.'/theme/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url(ASSET.'/theme/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url(ASSET.'/theme/plugins/datatables/dataTables.bootstrap.js')?>"></script>
<script src="<?=base_url(ASSET.'/theme/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<script src="<?=base_url(ASSET.'/theme/dist/js/jquery.cookie.js')?>"></script>
 
 
<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
        lengthMenu: [[5, 10, 100], [5, 10, 100]],
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], // [ [ 0, "asc" ] ] Initial no order.
 
        // Load data for the table's content from an Ajax source        
        ajax: {
            url : "<?php echo site_url('employee/ajax_list')?>",            
            data : function (d) {
                d[$('#csrf').attr('name')] = $('#csrf').val();
            },
            //data : { '<?php echo $this->security->get_csrf_token_name();?>' :'<?php echo $this->security->get_csrf_hash();?>'},   
            type : "POST"
        },
 
        //Set column definition initialisation properties.
        columnDefs : [
            { 
                targets : [ -1 ], //last column
                orderable : false, //set not orderable
            },
        ],
        rowCallback : function(nRow, aData, iDisplayIndex){                          
                      var oSettings = this.fnSettings();
                      $('td:eq(0)', nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                      return nRow;
        },
        drawCallback : function(settings) {
            csrf_update();
        }
 
    });
 
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
 
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
 
});
 
 
 
function add_employee()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Employee'); // Set Title to Bootstrap modal title
}
 
function edit_employee(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('employee/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Employee'); // Set title to Bootstrap modal title            
            csrf_update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
            csrf_update();
        }
    });
}
 
function reload_table()
{
    csrf_update();
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('employee/ajax_add')?>";
    } else {
        url = "<?php echo site_url('employee/ajax_update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize()+"&"+$('#csrf').attr('name')+"="+$('#csrf').val(),
        /*data : function (d) {
                d[$('#csrf').attr('name')] = $('#csrf').val();
                $('#form').serialize();

            },*/
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
            csrf_update();
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            csrf_update();
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_employee(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('employee/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            data: $('#csrf').attr('name')+"="+$('#csrf').val(),
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                csrf_update();
                alert('Error deleting data');
            }
        });
 
    }
}

function csrf_update()
{
    $('#csrf').val($.cookie("<?php echo $this->config->item("csrf_cookie_name");?>"));
}
 
</script>
 
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Employee Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input name="firstName" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input name="lastName" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Gender</label>
                            <div class="col-md-9">
                                <select name="gender" class="form-control">
                                    <option value="">--Select Gender--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" placeholder="Address" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date of Birth</label>
                            <div class="col-md-9">
                                <input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>