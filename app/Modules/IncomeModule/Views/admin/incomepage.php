
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>

<div class="page-content">
    <div class="container-fluid"> 

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Income Histories</h4>
                    <!-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active"><?//php echo lang('admin/owner.o_e_f'); ?></li>
                        </ol>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="card mb-4">
                                <div class="card-body text-end">

                                    <a href="<?php echo base_url() ?>/admin/addnewincomepage" class="btn btn-primary">Add new income</a>
                                    <div id="download" class="d-inline-block"></div>
                                    <!-- <button type="button" id="addnewbtn" class="btn btn-primary">Add new income</button>
                                    <button type="button" id="addnewbtn" class="btn btn-primary">Export Income Data</button> -->

                                </div>
                            </div>
                                <!-- <form id="userform" action="<?//= base_url('admin/insertuser') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <label>Search</label>
                                            <input type="text" class="form-control" id="name" name="name" >       
                                        </div>   
                                    </div>
                                </form> -->
                                <!-- id="tablemain" -->

                                <table class="table table-striped example" id="datatable2">
                                    <thead class="thead-dark">
                                        <tr>
                                       
                                        <th scope="col">User Name</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Attachment</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date</th>
                                        
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php foreach($data as $value):?>
                                        <tr>
                                            
                                            <td><?=$username?></td>
                                            
                                            <td><?=$value['account_number']?></td>
                                            <td><?= $value['categoryName']?></td>
                                            <td><?= $value['amount']?></td>
                                            <td>
                                            <a href="<?php echo base_url('Modules/IncomeModule/incomeuploads/'. $value['attachment']); ?>" download class="btn btn-success btn-sm">
                                            <i class="fa fa-download"></i>
                                            </a>
                                            </td>
                                            <td><?= $value['description']?></td>
                                            <td><?= $value['date']?></td>
                                            
                                                <td><a class="btn btn-danger btn-sm delete"  value="<?= $value['incomeId']?>" href="<?php echo base_url('admin/deleteincome/'.$value['incomeId'])?>">delete</a>

                                                <a class="btn btn-danger btn-sm edit"   value="<?= $value['incomeId']?>" href="<?php echo base_url('admin/editincome/'.$value['incomeId'])?>">edit</a></td>
                                                
                                        </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>

                        
                        
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    
    <script src="<?php echo base_url() ?>/admin/assets/js/pages/form-validation.init.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function(){
        var table = $('#datatable2').DataTable(  );
   

    var exportBtn = new $.fn.dataTable.Buttons(table, {
       buttons: [{
           extend: 'pdf',
           text: 'Export Income data',
          
           
       }]
   });
 
   exportBtn.container().appendTo('#download');
  });    
</script>











<script>
    
$(document).ready(function(){
   
    $('#addnewbtn').click(function ()
    {
        // alert('hi');
        $('#bankmodal').modal('show');
       
        $('#save').click(function (e){
            e.preventDefault();

            var bank = $("#bank").val();
            
            $.ajax({
                type: 'POST',
                url: 'savebank',
                data: {
                    bank: bank,
                },

                dataType: 'json',
                success: function (response) {

                    alert(response.message);
                    window.location.reload();
                },
                
            });

        });
            
    });

    $('edit').click(function (event)
    {
        event.preventDefault();

        var id = $(this).attr('value');

        // alert(id);
        // console.log(id);

        $.ajax({

                url: "editbank",

                type: 'Post',

                data: {id : id}, 

                dataType: 'json',

                success: function(response){

                    console.log(response);
                    // $("#id").val(response.id);
                   
                    $("#bankid").val(response[0].bankid);
                    $("#bank").val(response[0].bank);
                    
                    $('#bankmodal').modal('show');
                },
            });
    });


    $('body').delegate("#save", "click" ,function (e){
            e.preventDefault();

            var bankid = $("#bankid").val();
            var bank = $("#bank").val();
            

            $.ajax({
                type: 'POST',
                url: 'updatebank/'+bankid,
                data: {
                    bank: bank,  
                },

                dataType: 'json',
                success: function (response) {

                    alert(response.message);
                    window.location.reload();
                },
                
        });
        
    });

    // download datatable

  
});

</script>

<?php echo $this->endSection('content') ?>

