<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>


<!-- new design -->
<div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Debts <span> / Loans </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<button class="btn btn-sm btn-primary" id="openModalBtn"><i class="ri-equalizer-fill"></i>  Add New</button> 
					</div> 
				</div>
	 	 
				<table id="datatable" class="table table-striped" style="width:100%">
	        <thead>
	            <tr>  	 
	                <th>Amount</th>   
	                <th>Type</th>   
	                <th>Account</th>   
	                <th>Person</th>   
	                <th>Date</th>      
	                <th>Note</th>      
	                <th>Action</th>
	            </tr>
	        </thead>
        	<tbody>
            <?php foreach ($debtsData as $value): ?>
            <tr>
              <td>USD <?= $value['amount']?></td>
              <td><?= $value['select_type']?></td>
              <td><?= $value['bank']->bank_name?></td> 
              <td><?= $value['person']?></td>
              <td><?= $value['date']?> </td>
              <td><?= $value['note']?></td>
              
              <td> 
              	<div class="d-flex gap-2">
              		<a href="<?php echo base_url('/admin/debts_loans_edit/'. $value['id']); ?>" class="btn btn-sm btn-primary editbtn" > <i class="ri-edit-2-line"></i> </a>
              		<a  class="btn btn-sm btn-danger Deletebtn" data-id="<?php echo $value['id']; ?>"><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            <?php endforeach; ?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add new modal -->
<div class="modal fade right" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="myForm" >
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> Add Debts    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
						  <label for="floatingSelect">Amount</label>
                          <span style="color:red;" id="amountErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="Type" name="Type" aria-label="From Account">
						    <option selected> Select Type:</option>
                            <option value="Lend">Lend</option>
                            <option value="Borrow">Borrow</option> 
						  </select>
						  <label for="floatingstatus"> Select Type:</label>
                          <span style="color:red;" id="TypeErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control"id="BankAccount" name="BankAccount" aria-label="To Account ID">
                          <option value="">--Select a Bank Account--</option>
                          <?php foreach ($data as $value1): 
                                     if(!$value1['bank']->deleted_at){?>
                                    ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                            <?php } endforeach; ?>
						  </select>
						  <label for="floatingstatus"> Select Type </label>
                          <span style="color:red;" id="BankErr"></span>
						</div>
                        
					</div>  
					
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="Person" name="Person" class="form-control" placeholder="Person">
						  <label for="floatingSelect">Person </label>
                          <span style="color:red;" id="PersonErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" id="date" name="date" class="form-control" placeholder="Date">
						  <label for="floatingSelect"> Date  </label>
                          <span style="color:red;" id="dateErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <textarea class="form-control" id="note" name="note" placeholder="Type Note"></textarea>
						  <label for="floatingSelect">Note:</label>
                          <span style="color:red;" id="noteErr"></span>
						</div>
					</div> 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
      </div>
    </div>
  </form>
</div>


<!--end new design -->


<!-- For New Bank Account modal -->



<!-- End Page-content -->

<!-- end main content-->



<script>
$(document).ready(function() {
    $('#debtslist').DataTable({
        searchHighlight: true, 
        columnDefs: [
            { type: 'highlight', targets: '_all' } 
        ]
    });
});
</script>

   <script>
    $(function(){
        $("#date").datepicker();
    });
  </script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
        $(document).ready(function() {

            $('#myForm').validate({

                rules: {
                        
                    amount: {
                            required: true,
                            number: true,
                        },
                        BankAccount: {
                            required: true,
                            
                        },
                        Type: {
                            required: true,
                            
                        },
                        Person: {
                            required: true,
                            
                        },
                        date: {
                            required: true,
                           
                        },
                        note: {
                            required: true,
                           
                        },
                        
                    },

                messages: {
                        
                        amount: {
                            required: "Please enter holder Name.",
                            number:
                                " Please enter only number."
                        },
                        BankAccount: {
                            required: " Please enter Bank Name.",
                            
                        },

                        Type: {
                            required: " Please enter account Number",
                            
                        },
                        Person: {
                            required: " Please enter Person",
                            
                            
                        },
                        date: {
                            required: " Please enter date",
                            
                            
                        },
                        note: {
                            required: " Please enter note",
                            
                            
                        },
                        
                    }

          });



            $("#openModalBtn").click(function() {
                $("#myModal").modal("show");
            });
        $("#submitBtn").click(function() {
                    
                    var amountErr = $('#amountErr');
                    var BankErr = $('#BankErr');
                    var TypeErr = $('#TypeErr');
                    var PersonErr = $('#PersonErr');
                    var dateErr = $('#dateErr');
                    var noteErr = $('#noteErr');

                    // var formData = $("#myForm").serialize();
                    // console.log(formData);
                        $.ajax({
                        url: " <?php echo base_url('/admin/debts_loans_add') ?> ",
                        type: 'POST',
                        data: $("#myForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            amountErr.text(response.amount ? response.amount.message : '');
                            BankErr.text(response.BankAccount ? response.BankAccount.message : '');
                            TypeErr.text(response.Type ? response.Type.message : '');
                            PersonErr.text(response.Person ? response.Person.message : '');
                            dateErr.text(response.date ? response.date.message : '');
                            noteErr.text(response.note ? response.note.message : '');
                            if (response.success) {
                            alert(response.success.message);
                            $('#myForm')[0].reset();
                            window.location.reload();
                            }
                            else if (response.error) {
                                alert(response.error.message);
                            }
                        }
                        });
        
            });
        });
        </script>


<!-- For Delete Bank Account -->





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.Deletebtn').click(function(e) {
            e.preventDefault();
            
            var debtsId = $(this).data('id');
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
                        url: "<?php echo base_url('/admin/debts_loans_delete/') ?>" + debtsId,
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