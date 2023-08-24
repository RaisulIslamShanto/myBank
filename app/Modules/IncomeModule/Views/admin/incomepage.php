
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>


<!-- new design -->
<div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Income  <span> Histories </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<div id="tableActions" class="d-inline-flex gap-3"></div>
						<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addIncome"><i class="ri-equalizer-fill"></i> Add   Income</button> 
					</div> 
				</div>
	 	 
				<table id="IncomeTable" class="table table-striped" style="width:100%">
	        <thead>
	            <tr>  	 
	                <th>User name</th>   
	                <th>Account number</th>   
	                <th>Category</th>   
	                <th>Amount</th>   
	                <th>Attachment</th>      
	                <th>Description</th>      
	                <th>Date</th>      
	                <th>Action</th>
	            </tr>
	        </thead>
        	<tbody>
            <?php foreach($data as $value):?>
            <tr>
              <td><?=$username?></td>
              <td><?=$value['account_number']?></td>
              <td><?= $value['categoryName']?></td>
              <td><?= $value['amount']?></td>
              <td> <a href="<?php echo base_url('Modules/IncomeModule/incomeuploads/'. $value['attachment']); ?>" download class="btn btn-success btn-sm"> <i class="ri-download-line"></i> </a> </td>
              <td><?= $value['description']?></td>
              <td><?= $value['date']?> </td>
              
              <td> 
              	<div class="d-flex gap-2">
              		<a href="<?php echo base_url('admin/editincome/'.$value['incomeId'])?>" class="btn btn-sm btn-primary edit" value="<?= $value['incomeId']?>"> <i class="ri-edit-2-line"></i> </a>
              		<a href="<?php echo base_url('admin/deleteincome/'.$value['incomeId'])?>" class="btn btn-sm btn-danger delete" value="<?= $value['incomeId']?>"><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            <?php endforeach?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add students -->
<div class="modal fade right" id="addIncome" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank Account    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     		
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="floatingstatus" aria-label="From Account">
						    <option selected> select  Income Category</option>
						    <option value="1">UBC</option>
						    <option value="2">Abc</option> 
						  </select>
						  <label for="floatingstatus"> Income Category</label>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="floatingstatus" aria-label="To Account ID">
						    <option selected>     Select Bank Account </option>
						    <option value="1">UBC</option>
						    <option value="2">Abc</option> 
						  </select>
						  <label for="floatingstatus"> Select Bank Account </label>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" placeholder="Reference">
						  <label for="floatingSelect">Reference </label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" placeholder="Description">
						  <label for="floatingSelect">Description </label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea class="form-control" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="file" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Add Attachment  </label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
						</div>
					</div>
					 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form>
</div>
<!-- end new design -->





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

