<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!-- new design  -->
<div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Expense    <span> Histories </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<div id="tableActions" class="d-inline-flex gap-3"></div>
						<button class="btn btn-sm btn-primary" id="addexpense" ><i class="ri-equalizer-fill"></i> Add   Expense</button> 
					</div> 
				</div>
	 	 
				<table id="expenseTable" class="table table-striped" style="width:100%">
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
            <?php foreach ($expensedata as $value): ?>
            <tr>
              <td><?=$username?></td>
              <td><?= $value['account_number']?> </td>
              <td><?= $value['categoryName']?></td>
              <td>BDT <?= $value['amount']?>  </td>
              <td> <a href="<?php echo base_url('expensesAttachment/' . $value['add_attachment']); ?>" download="" class="btn btn-success btn-sm"> <i class="ri-download-line"></i> </a> </td>
              <td><?= $value['description']?> </td>
              <td><?= $value['date']?></td>


            
              <td> 
              	<div class="d-flex gap-2">
              		<a href="<?= base_url() ?>/admin/expenses_list_edit/<?= $value['id']; ?>" class="btn btn-warning btn-sm editButton " data-id="<?php echo $value['id']; ?>"> <i class="ri-edit-2-line"></i> </a>
              		<a href="" class="btn btn-danger btn-sm Deletebtn" data-id="<?php echo $value['id']; ?>" ><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            <?php endforeach; ?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add expense -->
<div class="modal fade right" id="addExpenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="expenseform">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New expense </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     		
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="Category" name="Category" aria-label="From Account">
						    <option selected> select Expense Category</option>
						    <?php foreach ($Categorytable as $value): ?>
                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                <?php endforeach; ?> 
						  </select>
						  <label for="floatingstatus"> Expense Category</label>
                 <span style="color:red;" id="catErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control"  id="ToAccount" name="ToAccount" aria-label="To Account ID">
						    <option selected>   Select Bank Account </option>
                            <?php foreach ($data as $value1): 
                                     if(!$value1['bank']->deleted_at){
                                    ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                            <?php }
                            endforeach; ?>
						  </select>
						  <label for="floatingstatus"> Select Bank Account </label>
                          <span style="color:red;" id="accErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="Amount" name="Amount" class="form-control" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
                          <span style="color:red;" id="amountErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="Reference" name="Reference" class="form-control" placeholder="Reference">
						  <label for="floatingSelect">Reference </label>
                          <span style="color:red;" id="ReferenceErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="Description" name="Description" class="form-control" placeholder="Description">
						  <label for="floatingSelect">Description </label>
                          <span style="color:red;" id="desErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea id="note" name="note" class="form-control" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
                          <span style="color:red;" id="noteErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="file" name="Attachment" id="Attachment" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Add Attachment  </label>
                          <span style="color:red;" id="AttachmentErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" id="date" name="date" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
                          <span style="color:red;" id="dateErr"></span>
						</div>
					</div>
					 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
      </div>
    </div>
  </form>
</div>

<!-- update expense modal -->
<div class="modal fade right" id="updateExpenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="updateexpenseform">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New expense </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
             <input type="text" id="updateexpenseId">
					<div class="col-md-12 mb-3">
						<div class="form-floating">
                            
						  <select class="form-control" id="Category" name="Category" aria-label="From Account">
						    <!-- <option selected> select Expense Category</option> -->
						    <?php foreach ($Categorytable as $value): ?>
                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                <?php endforeach; ?> 
						  </select>
						  <label for="floatingstatus"> Expense Category</label>
                          <span style="color:red;" id="catErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control"  id="ToAccount" name="ToAccount" aria-label="To Account ID">
						    <!-- <option selected>   Select Bank Account </option> -->
                            <?php foreach ($data as $value1): 
                                     if(!$value1['bank']->deleted_at){
                                    ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                            <?php }
                            endforeach; ?>
						  </select>
						  <label for="floatingstatus"> Select Bank Account </label>
                          <span style="color:red;" id="accErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="updateAmount" name="Amount" class="form-control" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
                          <span style="color:red;" id="amountErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="updateReference" name="Reference" class="form-control" placeholder="Reference">
						  <label for="floatingSelect">Reference </label>
                          <span style="color:red;" id="ReferenceErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="updateDescription" name="Description" class="form-control" placeholder="Description">
						  <label for="floatingSelect">Description </label>
                          <span style="color:red;" id="desErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea id="updatenote" name="note" class="form-control" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
                          <span style="color:red;" id="noteErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="file" name="updateAttachment" id="Attachment" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Add Attachment  </label>
                          <span style="color:red;" id="AttachmentErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" id="updatedate" name="date" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
                          <span style="color:red;" id="dateErr"></span>
						</div>
					</div>
					 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="update">Save</button>
      </div>
    </div>
  </form>
</div>



<!-- end new design  -->
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

    $('#expenseform').validate({

            rules: {
                
              Category: {
                    required: true,
                    
                },
                ToAccount: {
                    required: true,
                    
                },
                Amount: {
                    required: true,
                    
                },
                Reference: {
                    required: true,
                     
                },
                Description: {
                    required: true,
                    
                },
                note: {
                    required: true,
                    
                },
                Attachment: {
                    required: true,
                    
                },
                date: {
                    required: true,
                    
                },
                
            },

            messages: {
                
              Category: {
                    required: " Please enter a Category Name",
                    
                },
                ToAccount: {
                    required: "Please enter a Bank Account Name",
                    
                },
                Amount: {
                    required: " Please enter a amount",
                    
                },
                Reference: {
                    required: " Please enter a reference",
                
                },
                Description: {
                    required: " Please enter a description",
                    
                },
                note: {
                    required: " Please enter a note",
                    
                },
                Attachment: {
                    required: " Please enter a attachment",
                    
                },
                date: {
                    required: " Please enter a date",
                
                },
                
            }

    });



 $('#addexpense').click(function ()
    {
        // alert('hi');
        // $('#usermodal').modal('show');
        $('#addExpenseModal').appendTo("body").modal('show');

        $('#expenseform').on('submit', function (e)
        {
            e.preventDefault();
            // alert('hi');

                var catErr = $('#catErr');
                var accErr = $('#accErr');
                var amountErr = $('#amountErr');
                var ReferenceErr = $('#ReferenceErr');
                var desErr = $('#desErr');
                var noteErr = $('#noteErr');
                var AttachmentErr = $('#AttachmentErr');
                var dateErr = $('#dateErr');

            // var formData = new FormData(this);
            var formData = new FormData(this);   
                $.ajax({

                    type: 'POST',
                    url: 'expenses_add',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                        success: function (response) {

                            catErr.text(response.incomeCategory ? response.incomeCategory.message : '');
                            accErr.text(response.bankAccount ? response.bankAccount.message : '');
                            amountErr.text(response.amount ? response.amount.message : '');
                            ReferenceErr.text(response.reference ? response.reference.message : '');
                            desErr.text(response.description ? response.description.message : '');
                            noteErr.text(response.note ? response.note.message : '');
                            AttachmentErr.text(response.attachment ? response.attachment.message : '');
                            dateErr.text(response.date ? response.date.message : '');
                            
                                if (response.success) {
                                
                                    console.log(response.success.message);
                                    alert(response.success.message); 
                                
                                    // $('#myform')[0].reset();
                                    // window.location.reload();
                            }
                        
                        // alert(response.message);
                        
                        // window.location.href = "/incomepage";
                    },
                    
                });
        
        });
    });


});

    $('.editButton').click(function (event)
        {
        event.preventDefault();

        var id = $(this).attr('data-id');

        // alert(id);
        // console.log(id);

        $.ajax({

                url: "expenses_list_edit",

                type: 'GET',

                data: {id : id},

                dataType: 'json',

                success: function(response){

                    console.log(response);
                    // $("#id").val(response.id);
                    // console.log(response.incomedata[0].incomeId);
                   
                    $('Category').val(response.expensedata[0].expense_category);
                    $('ToAccount').val(response.expensedata[0].bank_account);

                    $('#updateexpenseId').val(response.expensedata[0].id);
                    $("#updateAmount").val(response.expensedata[0].amount);
                    $("#updateReference").val(response.expensedata[0].reference);
                    $("#updateDescription").val(response.expensedata[0].description);
                    $("#updatenote").val(response.expensedata[0].note);
                    // $("#updateAttachment").val(response.expensedata[0].attachment);
                    $("#updatedate").val(response.expensedata[0].date);

                    // $('#updatemodal').modal('show');
                    $('#updateExpenseModal').appendTo("body").modal('show');
                },
            });
    });

   
    $('body').delegate("#update", "click" ,function (e){
            e.preventDefault();

            var formData = new FormData(document.getElementById("updateexpenseform"));

            // var updateincomeCategoryErr = $("#updateincomeCategoryErr").val();
            // var updatebankAccountErr = $("#updatebankAccountErr").val();
            // var updateamountErr        = $("#updateamountErr").val();
            // var updatereferenceErr = $("#updatereferenceErr").val();
            // var updatedescriptionErr = $("#updatedescriptionErr").val();
            // var updatenoteErr  = $("#updatenoteErr").val();
            // var updateattachmentErr       = $("#updateattachmentErr").val();
            // var updatedateErr      = $("#updatedateErr").val();

            var id  = $("#updateexpenseId").val();
            alert(id);

            $.ajax({

                type: 'POST',
                url: 'expenses_list_update/'+id,
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

    codeListTable = $("#expenseTable").DataTable({ responsive: true, });
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
   

</script>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.Deletebtn').click(function(e) {
            e.preventDefault();
            
            var id = $(this).attr('data-id');
            // console.log(id);
            // alert(id);
            // return;

            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url() ?>admin/expenses_delete/"+id,
                        type: "POST",
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>