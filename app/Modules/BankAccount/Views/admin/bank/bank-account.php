<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!-- new design -->
<div class="alert alert-success mb-3" role="alert" >
		You need to create a bank before add a bank account, if you haven't added a bank yet, <a href="<?php echo base_url() ?>/admin/bank_list">Click Here</a> to create a bank first.
	</div>
	 <div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Bank  <span> Account  </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<button class="btn btn-sm btn-primary" id="openModalBtn" ><i class="ri-equalizer-fill"></i> Add  Bank Account  </button>
				 
					</div> 
				</div>
	 	 
				<table id="datatable" class="table table-striped" style="width:100%">
	        <thead>
	            <tr>  	 
	                <th>User name</th>   
	                <th>Account holder name</th>   
	                <th>Bank name</th>   
	                <th>Account number</th>   
	                <th>Available balance</th>      
	                <th>Action</th>
	            </tr>
	        </thead>
        	<tbody>
            <?php foreach ($data as $value): 
            if(!$value['bank']->deleted_at){
            ?>
            <tr>
              <td><?=$username?></td>
              <td><?= $value['account_holders_name']?></td>
              <td><?= $value['bank']->bank_name?></td>
              <td><?= $value['account_number']?></td>
              <td>BDT <?= $value['initial_balance']?></td>
              
              <td> 
              	<div class="d-flex gap-2">
              		<a href="javascript:;" class="btn btn-sm btn-primary editButton"  data-id="<?php echo $value['id']; ?>" > <i class="ri-edit-2-line"></i> </a>
              		<a href="javascript:;" class="btn btn-sm btn-danger Deletebtn"  data-id="<?php echo $value['id']; ?>"><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            <?php }
             endforeach; ?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add modal new bank account -->
<div class="modal fade right" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="myForm" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank Account    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="holderName" name="holderName" class="form-control" placeholder="Account holders Name">
						  <label for="floatingSelect">Account holders Name</label>
                          <span style="color:red;" id="holderErr"></span>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="BankName" name="BankName" aria-label="Bank Name">
						    <option selected> select Bank Name </option>
                            <?php foreach ($banklist as $value1): ?>
                                <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank_name']; ?></option>
                            <?php endforeach; ?>
						     
						  </select>
                          
						  <label for="floatingstatus">Bank Bank Name </label>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Account Number">
						  <label for="floatingSelect">Account Number</label>
                          <span style="color:red;" id="accErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" id="InitialBalance" name="InitialBalance"  placeholder="Initial Balance">
						  <label for="floatingSelect">Initial Balance</label>
                          <span style="color:red;" id="BalanceErr"></span>
						</div>
					</div> 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitBtn">Save</button>
      </div>
    </div>
  </form>
</div>


<!-- edit modal -->
<div class="modal fade right" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" id="myeditForm" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank Account    </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="holderNameInput" name="holderName" class="form-control" placeholder="Account holders Name">
						  <label for="floatingSelect">Account holders Name</label>
						</div>
					</div> 
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="BankNameInput" name="BankName" aria-label="Bank Name">
						    <option selected> select Bank Name </option>
						    <?php foreach ($banklist as $value1): ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank_name']; ?></option>
                            <?php endforeach; ?> 
						  </select>
						  <label for="floatingstatus">Bank Bank Name </label>
                          <span style="color:red;" id="banknameeErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" id="accountNumberInput" name="accountNumber" placeholder="Account Number">
						  <label for="floatingSelect">Account Number</label>
                          <span style="color:red;" id="acccErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" class="form-control" id="InitialBalanceInput" name="InitialBalance" placeholder="Initial Balance">
						  <label for="floatingSelect">Initial Balance</label>
                          <span style="color:red;" id="BalanceeErr"></span>
						</div>
					</div> 
     		</div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary save" id="abc">Save</button>
      </div>
    </div>
  </form>
</div>
<!-- end new design -->


<script>
$(document).ready(function() {
    $('#accountlist').DataTable({
        searchHighlight: true, 
        columnDefs: [
            { type: 'highlight', targets: '_all' } 
        ]
    });
});
</script>



<script>
        $(document).ready(function() {

            $("#openModalBtn").click(function() {
                $("#myModal").modal("show");
            });
        $("#submitBtn").click(function() {
                    
                    var holderErr = $('#holderErr');
                    var banknameErr = $('#banknameErr');
                    var accErr = $('#accErr');
                    var BalanceErr = $('#BalanceErr');

                    // var formData = $("#myForm").serialize();
                    // console.log(formData);
                        $.ajax({
                        url: " <?php echo base_url('/admin/bank_account_add') ?> ",
                        type: 'POST',
                        data: $("#myForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            holderErr.text(response.holderName ? response.holderName.message : '');
                            banknameErr.text(response.BankName ? response.BankName.message : '');
                            accErr.text(response.accountNumber ? response.accountNumber.message : '');
                            BalanceErr.text(response.InitialBalance ? response.InitialBalance.message : '');

                            if (response.success) {
                            alert(response.success.message);
                            $('#myForm')[0].reset();
                            window.location.reload();
                            }
                        }
                        });
        
            });
        });
        </script>




<!-- For Edit Bank Account -->



<script>
              $(document).ready(function() {
              $('.editButton').click(function() {
                  var editaccid = $(this).data('id');
                //   console.log(editaccid);
                //   alert(editaccid);
                //   $('.save').data('id', editid);

                  $.ajax({
                      url: "<?php echo base_url('/admin/account_list_edit/') ?>" + editaccid,
                      type: "GET",
                      dataType: "json",
                      success: function(response) {
                          $('#holderNameInput').val(response.account_holders_name);
                          $('#accountNumberInput').val(response.account_number);
                          $('#InitialBalanceInput').val(response.initial_balance);
                          $('#BankNameInput').val(response.bank_name_id);
                          $('#idInput').val(response.id);
                          $('#abc').attr("data-id", editaccid);
                          $('#editModal').modal('show');
                      }
                  });
              });

              $('.save').click(function() {
                var edituserid = $(this).attr('data-id');
                  console.log(edituserid);
                    var holderrErr = $('#holderrErr');
                    var banknameeErr = $('#banknameeErr');
                    var acccErr = $('#acccErr');
                    var BalanceeErr = $('#BalanceeErr');

                  $.ajax({
                      url: "<?php echo base_url('/admin/account_list_update/') ?>" + edituserid,
                      type: "POST",
                      data:$("#myeditForm").serialize(),
                      dataType: "json",
                      success: function(response) {
                            holderrErr.text(response.holderName ? response.holderName.message : '');
                            banknameeErr.text(response.BankName ? response.BankName.message : '');
                            acccErr.text(response.accountNumber ? response.accountNumber.message : '');
                            BalanceeErr.text(response.InitialBalance ? response.InitialBalance.message : '');
                          if (response.success) {
                              alert(response.message);
                              $('#editModal').modal('hide');
                              window.location.reload();
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
            
            var baId = $(this).data('id');
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
                        url: "<?php echo base_url('/admin/bank_account_delete/') ?>" + baId,
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