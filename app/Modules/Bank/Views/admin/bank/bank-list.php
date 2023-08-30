<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>


<!-- new design -->
    <div class="card">
		<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">List Of  <span> Banks  </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<button class="btn btn-sm btn-primary" id="openModalBtn" ><i class="ri-equalizer-fill"></i> Add  Bank  </button>
				 
					</div> 
				</div>
	 	 
				<table id="datatable" class="table table-striped" style="width:100%">
	        <thead>
	            <tr>  	 
	                <th>Bank name </th>   
	                <th>Action</th>
	            </tr>
	        </thead>
        	<tbody>
            <?php foreach ($banklist as $value): ?>
            <tr>
              <td><?= $value['bank_name']?></td>
              
              <td> 
              	<div class="d-flex gap-2">
              		<a href="javascript:;" class="btn btn-sm btn-primary editButton"  data-id="<?php echo $value['id']; ?>"> <i class="ri-edit-2-line"></i> </a>
              		<a href="javascript:;" class="btn btn-sm btn-danger Deletebtn"  data-id="<?php echo $value['id']; ?>"><i class="ri-delete-bin-line"></i></a>
              	</div>
              </td>
            </tr> 
            
            <?php endforeach; ?>
          </tbody>
        </table>
			</div>
		</div>
	 
	</div> 
 

<!-- add bank insert modal -->
<div class="modal fade right" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="myForm" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank     </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
						  <input type="text" id="BankName" name="BankName" class="form-control" placeholder="Bank Name">
						  <label for="floatingSelect">Bank Name</label>
						</div>
                        <span style="color:red;" id="bankErr"></span>
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

<!-- update bank modal -->
<div class="modal fade right" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="myeditForm" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank     </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">   
     		<div class="row">
     			<div class="col-md-12 mb-3">
						<div class="form-floating">
                        <input type="hidden" name="id" id="idInput" value="">
						  <input type="text" class="form-control" id="BankNameEdit" name="BankName" placeholder="Bank Name">
						  <label for="floatingSelect">Bank Name</label>
						</div>
                        <span style="color:red;" id="bankkErr"></span>
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



<!-- For New Bank Account modal -->

<!-- <div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm">
                    <div class="form-group">
                        <label for="BankName">Bank Name:</label>
                        <input type="text" class="form-control" id="BankName" name="BankName" placeholder="Bank Name..">
                        <span style="color:red;" id="bankErr"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div> -->

<!-- Modal End -->

<!-- For Edit Modal -->

<!-- <div class="modal" id="myeditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="myFormm">
                    <div class="form-group">
                        <label for="BankName">Bank Name:</label>
                        <input type="text" class="form-control" id="BankName" name="BankName" placeholder="Bank Name..">
                        <span style="color:red;" id="bankErr"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal Label" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" id="myeditForm" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="BankName">Bank Name:</label>
                        <input type="text" class="form-control" id="BankNameEdit" name="BankName" value="">
                        <span style="color:red;" id="bankkErr"></span>
                    </div>
                      <input type="hidden" name="id" id="idInput" value="">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save" id="abc" >Save Changes</button>
                  </div>
                </div>
              </div>
            </div> -->
          

<!--Edit Modal End -->


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
       
        
        <!-- end page title -->

        <!-- <div class="row">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body ">
                    <div class="sidebar-header">
                        <button type="button" class="btn btn-primary" id="openModalBtn">Add new bank</button>
                        </div>
                        <br>
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="banklist" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Bank NAME</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody> -->
                            <?//php foreach ($banklist as $value): ?>
                                <tr>
                                    <td><?//= $value['bank_name']?></td>
                                    <td>
                                    <a href="#" class="btn btn-warning btn-sm editButton" data-id="<?//php echo $value['id']; ?>">
                                    <i class="fa fa-pencil"></i> Edit 
                                    </a>
                                        <!-- <button class="btn btn-primary btn-sm">Edit</button> -->
                                        
                                    <a href="#" class="btn btn-danger btn-sm Deletebtn" data-id="<?//php echo $value['id']; ?>">
                                    <i class="fa fa-trash"></i> Delete
                                    </a>
                                        <!-- <button class="btn btn-danger btn-sm">Delete</button> -->
                                    </td>
                                    
                                </tr>
                            <?//php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
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


<!-- End Page-content -->

<!-- end main content-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
$(document).ready(function() {
    $('#banklist').DataTable({
        searchHighlight: true, 
        columnDefs: [
            { type: 'highlight', targets: '_all' } 
        ]
    });
});
</script>


<script>
    $(document).ready(function() {

        $('#myForm').validate({

        rules: {
            
            BankName: {
                required: true,
                minlength: 5
            },
            
            
        },

        messages: {
            
            BankName: {
                required: " Please enter a Bank Name",
                min_length: " Bank Name must be at least 5 characters "
            },
            
            
        }

});

                $("#openModalBtn").click(function() {
                    $("#myModal").modal("show");
                });
                $("#submitBtn").click(function() {
                        
                        var bankErr = $('#bankErr');
                        var formData = $("#myForm").serialize();

                            // setTimeout(function() { 
                                
                            //     $('#myform')[0].reset();
                            //     window.location.reload();
                            
                            // }, 2000);
                        // console.log(formData);
                            $.ajax({
                            url: "<?php echo base_url('/admin/bank_list_add'); ?>",
                            type: 'POST',
                            data: formData,
                            dataType: "json",
                            success: function(response) {
                                bankErr.text(response.BankName ? response.BankName.message : '');

                                if (response.success) {
                                // alert(response.success.message);
                                $.toast({ text :' New Bank has been created',
                                        hideAfter : 12000,
                                        position: 'top-right',
                                        bgColor: '#FF1356',
                                        textColor: 'white' });
                                $('#myForm')[0].reset();
                                window.location.reload();
                                }
                            }
                            });
            
                });
            });
 </script>







         <script>
              $(document).ready(function() {
              $('.editButton').click(function() {
                // alert('abc');
                // return false;
                  var editbankid = $(this).data('id');
                  console.log(editbankid);
                //   $('.save').data('id', editbankid);

                  $.ajax({
                      url: "<?php echo base_url('/admin/bank_list_edit/') ?>" + editbankid,
                      type: "GET",
                      dataType: "json",
                      success: function(response) {
                          $('#BankNameEdit').val(response.bank_name);
                          $('#idInput').val(response.id);
                          $('#abc').attr("data-id", editbankid);
                          $('#editModal').modal('show');
                      }
                  });
              });

              $('.save').click(function() {
                // alert('abc');
                var updatebankid = $(this).attr('data-id');
                  console.log(updatebankid);
                //   var name = $('#BankNameEdit').val();
                  var bankkErr = $('#bankkErr');

                  $.ajax({
                      url: "<?php echo base_url('/admin/bank_list_update/') ?>" + updatebankid,
                      type: "POST",
                      data:$("#myeditForm").serialize(),
                      dataType: "json",
                      success: function(response) {
                        bankkErr.text(response.BankName ? response.BankName.message : '');
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





<script>
    $(document).ready(function() {
        $('.Deletebtn').click(function(e) {
            e.preventDefault();
            if (!confirm("Do you want to delete")){
                return false;
                }
            var BlId = $(this).data('id');
            console.log (BlId);
            $.ajax({
                url: "<?php echo base_url('/admin/bank_list_delete/') ?>" + BlId,
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