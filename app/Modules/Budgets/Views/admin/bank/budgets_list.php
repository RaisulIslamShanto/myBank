<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!-- new design -->
<div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Budgets     </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
					 
						<button class="btn btn-sm btn-primary" id="openModalBtn" ><i class="ri-equalizer-fill"></i> Add Budgets</button> 
					</div> 
				</div>
	 	 
				<table id="datatable" class="table table-striped" style="width:100%">
	        <thead>
	            <tr>  	 
	                <th>Budget name</th>   
	                <th>Proposed amount</th>   
	                <th>Updated budget amount</th>   
	                <th>Budget start date</th>   
	                <th>Budget end date</th> 
	                <th>Action</th>
	            </tr>
	        </thead>
        	<tbody>
            <?php foreach ($budgetslist as $value): ?>    
            <tr>
              <td><?= $value['budget_name']?></td>
              <td><?= ($value['update_amount'] != '')?$value['update_amount']:$value['budget_amount']?></td>
              <td><?= $value['budget_amount']?> </td>
              <td><?= $value['start_date']?>  </td> 
              <td><?= $value['end_date']?></td>
              
              <td> 
              	<div class="d-flex gap-2">
              		<a href="javascript:;" class="btn btn-sm btn-primary editButton" data-id="<?php echo $value['id']; ?>"> <i class="ri-edit-2-line"></i> </a>
              		<a href="javascript:;" class="btn btn-sm btn-danger Deletebtn" data-id="<?php echo $value['id']; ?>"><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            <?php endforeach; ?>
          </tbody>
        </table>
			</div>
		</div>
	 
</div> 
 

<!-- add budgets modal -->
<div class="modal fade right" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="myForm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Budgets </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="budgetName" name="budgetName" class="form-control" placeholder="Budget Name">
						  <label for="floatingSelect">Budget Name</label>
                          <span style="color:red;" id="budErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="Amount" name="Amount" class="form-control" placeholder="Budget Amount">
						  <label for="floatingSelect">Budget Amount</label>
                          <span style="color:red;" id="amoErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="Category" name="Category" aria-label="From Account">
						    <option selected> select Expense Categories</option>
						    <?php foreach ($Categorytable as $value): ?>
                                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                                <?php endforeach; ?>
						  </select>
						  <label for="floatingstatus"> Expense Categories</label>
                          <span style="color:red;" id="catErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" class="form-control" id="Startdate" name="Startdate"  placeholder="Start Date">
						  <label for="floatingSelect"> Start Date  </label>
                          <span style="color:red;" id="StartdateErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" class="form-control" id="Enddate" name="Enddate"  placeholder="End Date">
						  <label for="floatingSelect"> End Date  </label>
                          <span style="color:red;" id="EnddateErr"></span>
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

<!-- update modal -->
<div class="modal fade right" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog" id="myeditForm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Budgets </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="budgetNameInput" name="budgetName" class="form-control" placeholder="Budget Name">
						  <label for="floatingSelect">Budget Name</label>
                          <span style="color:red;" id="budErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="AmountInput" name="Amount" class="form-control" placeholder="Budget Amount">
						  <label for="floatingSelect">Budget Amount</label>
                          <span style="color:red;" id="amoErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <select class="form-control" id="BudgetCategory" name="Category" aria-label="From Account">
						    <option selected> select Expense Categories</option>
						    <?php foreach ($Categorytable as $value): ?>
                                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                                <?php endforeach; ?> 
						  </select>
						  <label for="floatingstatus"> Expense Categories</label>
                          <span style="color:red;" id="catErr"></span>
						</div>
					</div>  
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" id="StartdateInput" name="Startdate" class="form-control" placeholder="Start Date">
						  <label for="floatingSelect"> Start Date  </label>
                          <span style="color:red;" id="StartdateErr"></span>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="date" id="EnddateInput" name="Enddate" class="form-control" placeholder="End Date">
						  <label for="floatingSelect"> End Date  </label>
                          <span style="color:red;" id="EnddateErr"></span>
						</div>
					</div>
					 
     		</div>  
      </div>
      <input type="hidden" name="id" id="idInput" value="">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary save"  id="abc">Save</button>
      </div>
    </div>
  </form>
</div> 
<!--end new design -->



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
            $(function(){
                $("#Startdate").datepicker();
            });
        </script>

        <script>
            $(function(){
                $("#Enddate").datepicker();
            });
        </script>


<script>
        $(document).ready(function() {

            $("#openModalBtn").click(function() {
                $("#myModal").modal("show");
            });
        $("#submitBtn").click(function() {
                    
                    var budErr = $('#budErr');
                    var amoErr = $('#amoErr');
                    var catErr = $('#catErr');
                    var StartdateErr = $('#StartdateErr');
                    var EnddateErr = $('#EnddateErr');

                    // var formData = $("#myForm").serialize();
                    // console.log(formData);
                        $.ajax({
                        url: " <?php echo base_url('/admin/budgets_list_add') ?> ",
                        type: 'POST',
                        data: $("#myForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            budErr.text(response.budgetName ? response.budgetName.message : '');
                            amoErr.text(response.Amount ? response.Amount.message : '');
                            catErr.text(response.Category ? response.Category.message : '');
                            StartdateErr.text(response.Startdate ? response.Startdate.message : '');
                            EnddateErr.text(response.Enddate ? response.Enddate.message : '');

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
                  var editbudid = $(this).data('id');
                //   console.log(editaccid);
                //   alert(editaccid);
                //   $('.save').data('id', editid);

                  $.ajax({
                      url: "<?php echo base_url('/admin/budgets_list_edit/') ?>" + editbudid,
                      type: "GET",
                      dataType: "json",
                      success: function(response) {
                          $('#budgetNameInput').val(response.budget_name);
                          $('#AmountInput').val(response.update_amount);
                        //   $('#AmountInput').val(response.update_amount != '') ? response.update_amount : response.budget_amount;
                          $('#BudgetCategory').val(response.expense_categories);
                          $('#StartdateInput').val(response.start_date);
                          $('#EnddateInput').val(response.end_date);
                          $('#idInput').val(response.id);
                          $('#abc').attr("data-id", editbudid);
                          $('#editModal').modal('show');
                      }
                  });
              });

              $('.save').click(function() {
                var editid = $(this).attr('data-id');
                  console.log(editid);
                //   alert(edituserid);
                    var budErr = $('#budErr');
                    var amoErr = $('#amoErr');
                    var catErr = $('#catErr');
                    var StartdateErr = $('#StartdateErr');
                    var EnddateErr = $('#EnddateErr');
                  $.ajax({
                      url: "<?php echo base_url('/admin/budgets_list_update/') ?>" + editid,
                      type: "POST",
                      data:$("#myeditForm").serialize(),
                      dataType: "json",
                      success: function(response) {
                            budErr.text(response.budgetName ? response.budgetName.message : '');
                            amoErr.text(response.Amount ? response.Amount.message : '');
                            catErr.text(response.Category ? response.Category.message : '');
                            StartdateErr.text(response.Startdate ? response.Startdate.message : '');
                            EnddateErr.text(response.Enddate ? response.Enddate.message : '');
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

<script>
$(document).ready(function() {
    $('.Deletebtn').click(function(e) {
        e.preventDefault();
        if (!confirm("Do you want to delete")){
                return false;
                }
        var baId = $(this).data('id');
        console.log (baId);
        $.ajax({
            url: "<?php echo base_url('/admin/budgets_list_delete/') ?>" + baId,
            type: "POST",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.reload();
                } else {
                    alert(response.message);
                }
            },
           
        });
    });
});
</script>



<?= $this->endSection() ?>