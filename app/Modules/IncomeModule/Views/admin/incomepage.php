
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>


<!-- new design -->
<div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Income  <span> Histories </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<div id="tableActions" class="d-inline-flex gap-3"></div>
						<button class="btn btn-sm btn-primary" id="addnewbtn" ><i class="ri-equalizer-fill"></i> Add   Income</button> 
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
              		<button type="button"  class="btn btn-sm btn-danger deleteincome" value="<?= $value['incomeId']?>"><i class="ri-delete-bin-line"></i></button>
                  <!-- <a href="<?//php echo base_url('admin/deleteincome/'.$value['incomeId'])?>" class="btn btn-sm btn-danger delete" value="<?//= $value['incomeId']?>"><i class="ri-delete-bin-line"></i></a> -->
              	</div>
              </td>
            </tr> 
            <?php endforeach?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add income modal -->
<div class="modal fade right" id="addIncomemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="incomeform" >
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Income    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
             <div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" name="incomeCategory" id="incomeCategory" aria-label="From Account">
						    <option selected> select  Income Category</option>
						    <?php foreach($incomeCategories as $value):?>
                                <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                            <?php endforeach?> 
						  </select>
						  <label for="floatingstatus"> Income Category</label>
                          <span style="color:red;" id="incomeCategoryErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control"  name="bankAccount" id="bankAccount"  aria-label="To Account ID">
						    <option selected>     Select Bank Account </option>
						    <?php foreach($bankaccountno as $value):?>
                                <option value="<?= $value['id']?>"><?= $value['account_number']?></option>
                            <?php endforeach?>
						  </select>
						  <label for="floatingstatus"> Select Bank Account </label>
                          <span style="color:red;" id="bankAccountErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="number" class="form-control" name="amount" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
                          <span style="color:red;" id="amountErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" name="reference" class="form-control" placeholder="Reference">
						  <label for="floatingSelect">Reference </label>
                          <span style="color:red;" id="referenceErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" name="description" class="form-control" placeholder="Description">
						  <label for="floatingSelect">Description </label>
                          <span style="color:red;" id="descriptionErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea name="note" class="form-control" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
                          <span style="color:red;" id="noteErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="file" name="attachment" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Add Attachment  </label>
                          <span style="color:red;" id="attachmentErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" name="date" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
                          <span style="color:red;" id="dateErr"></span>
						</div>
					</div>
					 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" id="submit" class="btn btn-primary">Save</button>
      </div>
					
        </div>
  </form>
</div>

<!-- update modal -->
<div class="modal fade right" id="updateincomemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <form class="modal-dialog" id="updateincomeform" encType="multipart/form-data" >
  <input type="text"  name="incomeId" id="updateincomeId" name="incomeId"  >
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Income    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
             <div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control"  id="updateincomeCategory" name="updateincomeCategory" aria-label="From Account">
						    <!-- <option selected> select  Income Category</option> -->
                           
                <?php foreach($incomeCategories as $value):?>
                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                <?php endforeach?>
						  </select>
						  <label for="floatingstatus"> Income Category</label>
                          <span style="color:red;" id="updateincomeCategoryErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="updatebankAccount" name="updatebankAccount" aria-label="To Account ID">
						    <!-- <option selected> Select Bank Account </option> -->
                  
						    <?php foreach($bankaccountno as $value):?>
                    <option value="<?= $value['id']?>"><?= $value['account_number']?></option>
                <?php endforeach?>
						  </select>
						  <label for="floatingstatus"> Select Bank Account </label>
                          <span style="color:red;" id="updatebankAccountErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="number" class="form-control" name="amount" id="updateamount" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
                          <span style="color:red;" id="updateamountErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" name="reference" id="updatereference" class="form-control" placeholder="Reference">
						  <label for="floatingSelect">Reference </label>
                          <span style="color:red;" id="updatereferenceErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" name="description" id="updatedescription" class="form-control" placeholder="Description">
						  <label for="floatingSelect">Description </label>
                          <span style="color:red;" id="updatedescriptionErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea name="note" class="form-control" id="updatenote" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
                          <span style="color:red;" id="updatenoteErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="file" name="attachment" id="updateattachment" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Add Attachment  </label>
                          <span style="color:red;" id="updateattachmentErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" name="date" id="updatedate" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
                          <span style="color:red;" id="updatedateErr"></span>
						</div>
					</div>
					 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" id="update"  value="save" class="btn btn-primary">Save</button>
      </div>
					
        </div>
  </form>
</div>
<!-- end new design -->






<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    
    <!-- <script src="<?php echo base_url() ?>/admin/assets/js/pages/form-validation.init.js"></script> -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function(){

        // $('#incomeform').validate({

        //     rules: {
                
        //         incomeCategory: {
        //             required: true,
                    
        //         },
        //         bankAccount: {
        //             required: true,
                    
        //         },
        //         amount: {
        //             required: true,
                    
        //         },
        //         reference: {
        //             required: true,
                    
        //         },
        //         description: {
        //             required: true,
                    
        //         },
        //         note: {
        //             required: true,
                    
        //         },
        //         attachment: {
        //             required: true,
                    
        //         },
        //         date: {
        //             required: true,
                    
        //         },
                
        //     },

        //     messages: {
                
        //         incomeCategory: {
        //             required: " Please enter a Category Name",
                    
        //         },
        //         bankAccount: {
        //             required: "Please enter a Bank Account Name",
                    
        //         },
        //         amount: {
        //             required: " Please enter a amount",
                    
        //         },
        //         reference: {
        //             required: " Please enter a reference",
                
        //         },
        //         description: {
        //             required: " Please enter a description",
                    
        //         },
        //         note: {
        //             required: " Please enter a note",
                    
        //         },
        //         attachment: {
        //             required: " Please enter a attachment",
                    
        //         },
        //         date: {
        //             required: " Please enter a date",
                
        //         },
                
        //     }

        // });

    $('#addnewbtn').click(function ()
    {
        // alert('hi');
        // $('#usermodal').modal('show');
        $('#addIncomemodal').appendTo("body").modal('show');

        $('#incomeform').on('submit', function (e)
        {
            e.preventDefault();
            // alert('hi');

                var incomeCategoryErr = $('#incomeCategoryErr');
                var bankAccountErr = $('#bankAccountErr');
                var amountErr = $('#amountErr');
                var referenceErr = $('#referenceErr');
                var descriptionErr = $('#descriptionErr');
                var noteErr = $('#noteErr');
                var attachmentErr = $('#attachmentErr');
                var dateErr = $('#dateErr');

            // var formData = new FormData(this);
            var formData = new FormData(this);   
                $.ajax({

                    type: 'POST',
                    url: 'submitincome',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                        success: function (response) {

                            incomeCategoryErr.text(response.incomeCategory ? response.incomeCategory.message : '');
                            bankAccountErr.text(response.bankAccount ? response.bankAccount.message : '');
                            amountErr.text(response.amount ? response.amount.message : '');
                            referenceErr.text(response.reference ? response.reference.message : '');
                            descriptionErr.text(response.description ? response.description.message : '');
                            noteErr.text(response.note ? response.note.message : '');
                            attachmentErr.text(response.attachment ? response.attachment.message : '');
                            dateErr.text(response.date ? response.date.message : '');
                            
                                if (response.success) {
                                
                                    console.log(response.success.message);
                                    alert(response.success.message); 
                                
                                    $('#myform')[0].reset();
                                    window.location.reload();
                            }
                        
                        // alert(response.message);
                        
                        // window.location.href = "/incomepage";
                    },
                    
                });
        
        });
    });

    $('.deleteincome').click(function(event) { 

          event.preventDefault();

          var id = $(this).attr('value');
          // alert(id);


          Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire(
                
              'Deleted!',
              'Your file has been deleted.',
              'success'
              ).then(() => {
                window.location.href = "<?php echo base_url('admin/deleteincome/')?>"+id;
            });
          }
          })

    });

    $('.edit').click(function (event)
    {
        event.preventDefault();

        var id = $(this).attr('value');

        // alert(id);
        // console.log(id);

        $.ajax({

                url: "editincomeajax",

                type: 'GET',

                data: {id : id},

                dataType: 'json',

                success: function(response){

                    console.log(response);
                    // $("#id").val(response.id);
                    
                    // var option = `<option value="">${response.incomedata[0].categoryName}</option>`;

                    // $('#updateincomeCategory').html(option);
                   var catID = response.incomedata[0].incomeCategory;
                   console.log(catID);
                  //  alert(catID);


                    // $('#updateincomeCategory').val(response.incomedata[0].categoryName);
                    $('#updateincomeCategory').val(response.incomedata[0].incomeCategory);
                    // console.log(response.incomedata[0].categoryName);
                    $('#updatebankAccount').val(response.incomedata[0].bankAccount);
                    
                    $('#updateincomeId').val(response.incomedata[0].incomeId);
                    $("#updateamount").val(response.incomedata[0].amount);
                    $("#updatereference").val(response.incomedata[0].reference);
                    $("#updatedescription").val(response.incomedata[0].description);
                    $("#updatenote").val(response.incomedata[0].note);
                    // $("#updateattachment").val(response.incomedata[0].attachment);
                    $("#updatedate").val(response.incomedata[0].date);

                    // $('#updatemodal').modal('show');
                    $('#updateincomemodal').appendTo("body").modal('show');
                },
            });
    });

   
    $('body').delegate("#update", "click" ,function (e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("updateincomeform"));

            var updateincomeCategoryErr = $("#updateincomeCategoryErr").val();
            var updatebankAccountErr = $("#updatebankAccountErr").val();
            var updateamountErr        = $("#updateamountErr").val();
            var updatereferenceErr = $("#updatereferenceErr").val();
            var updatedescriptionErr = $("#updatedescriptionErr").val();
            var updatenoteErr  = $("#updatenoteErr").val();
            var updateattachmentErr       = $("#updateattachmentErr").val();
            var updatedateErr      = $("#updatedateErr").val();

            var id  = $("#updateincomeId").val();

                // var id = $('#updateincomeId').attr('value');

            // const form = document.getElementById("updateincomeform");
            // const submitter = document.querySelector("button[value=save]");
               
           
           
            // var updateincomeCategory = $("#updateincomeCategory").val();
            // var updatebankAccount = $("#updatebankAccount").val();
            // var updateamount        = $("#updateamount").val();
            // var updatereference = $("#updatereference").val();
            // var updatedescription = $("#updatedescription").val();
            // var updateattachment  = $("#updateattachment").val();
            // var updatenote       = $("#updatenote").val();
            // var updatedate      = $("#updatedate").val();

            

            $.ajax({

                type: 'POST',
                url: 'updateincome/'+id,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function (response) {

                    // updateincomeCategoryErr.text(response.incomeCategory ? response.incomeCategory.message : '');
                    // updatebankAccountErr.text(response.bankAccount ? response.bankAccount.message : '');
                    // updateamountErr.text(response.amount ? response.amount.message : '');
                    // updatereferenceErr.text(response.reference ? response.reference.message : '');
                    // updatedescriptionErr.text(response.description ? response.description.message : '');
                    // updatenoteErr.text(response.note ? response.note.message : '');
                    // updateattachmentErr.text(response.attachment ? response.attachment.message : '');
                    // updatedateErr.text(response.date ? response.date.message : '');
                          if (response.success) {
                            
                            alert(response.message);

                            // console.log(response.success.message);
                            //   alert(response.success.message); 
                            //   $('#usermodal').modal('hide');
                            //   $('#usermodal').appendTo("body").modal('hide');
                            //   $('#myform')[0].reset();
                            //   window.location.reload();
                          }
                    // alert(response.message);
                    // window.location.reload();
                    },
                
         });


    });



    codeListTable = $("#IncomeTable").DataTable({ responsive: true, });
        new $.fn.dataTable.Buttons( codeListTable, { 
            buttons: [
          
                {
                extend:    'excelHtml5',
                text:      'Download Excel',
                titleAttr: 'Excel',
                className: 'btn btn-warning btn-sm',
                exportOptions: {
                    columns: ':visible'
                	}
                },
                                
                
            ]
        } );
        codeListTable.buttons().container().appendTo('#tableActions');
			   
			
 
    





            // var table = $('#datatable2').DataTable(  );
    

            // var exportBtn = new $.fn.dataTable.Buttons(table, {
            // buttons: [{
            //     extend: 'pdf',
            //     text: 'Export Income data',
                
                
            // }]
            // });
        
            // exportBtn.container().appendTo('#download');


  });    
</script>












<?php echo $this->endSection('content') ?>

