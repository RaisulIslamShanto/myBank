
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>

<!-- new -->
            <div class="card"> <div class="card-body table-responsive">
                <div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
                    <h5 class="m-0">Income & <span> Expense Categories </span>
                    </h5>
                    <div class="ms-auto d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-primary" id="addnewbtn" data-bs-toggle="modal" data-bs-target="#addCategory">
                        <i class="ri-equalizer-fill"></i> Add Category </button>
                    </div>
                </div>
                <table id="datatable" class="table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Category name </th>
                        <th>Category type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($cattable as $value):?>
                        <tr>
                            <td><?= $value['categoryName']?></td>
                            <td>
                            <span class="badge bg-primary"><?= $value['categoryType']?></span>
                            </td>
                            <td>
                            <div class="d-flex gap-2">
                                <a href="javascript:;" class="btn btn-sm btn-primary edit " value="<?= $value['categoryId']?>"  data-bs-toggle="modal" data-bs-target="#addCategory">
                                <i class="ri-edit-2-line"></i>
                                </a>
                                <a  class="btn btn-sm btn-danger delete" catid="<?= $value['categoryId']?>" href="<?php echo base_url('admin/deletecat/'.$value['categoryId'])?>" >
                                <i class="ri-delete-bin-line"></i>
                                </a>
                            </div>
                            </td>
                        </tr>
                    
                    </tbody>
                    <?php endforeach?>
                </table>
            

            
            
                <!-- add category modal -->
                <div class="modal fade right" id="catmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form id="myform" class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Category   </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">   
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Category Name">
                                        <label for="floatingSelect">Category Name</label>
                                        </div>
                                        <span style="color:red;" id="categoryNameErr"></span>
                                    </div>
                            
                                    
                                    <div class="col-md-12 mb-3">
                                        <div class="form-floating">
                                        <select name="categoryType" id="categoryType" class="form-control"  aria-label="Category Type">
                                            <option selected> select Type </option>
                                            <option value="Income">Income</option>
                                            <option value="Expense">Expense</option> 
                                        </select>
                                        <label for="floatingstatus">Category Type </label>
                                        </div>
                                        <span style="color:red;" id="categoryTypeErr"></span>
                                    </div>  
                            
                            </div>
                    
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="save" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </form>
                </div>
                
                <!-- update category modal -->
                
                <div class="modal fade right"  id="updatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form id="myupdateform" class="modal-dialog">
                    <input type="hidden" id="catid" value=""> 
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Category   </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">   
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" class="form-control" id="updatecategoryName" name="categoryName"  placeholder="Category Name">
                                        <label for="floatingSelect">Category Name</label>
                                        </div>
                                        <span style="color:red;" id="updatecategoryNameErr"></span>
                                    </div>
                            
                                    
                                    <div class="col-md-12 mb-3">
                                        <div class="form-floating">
                                        <select class="form-control" name="categoryType" id="updatecategoryType" aria-label="Category Type">
                                            <option selected> select Type </option>
                                            <option value="Income">Income</option>
                                            <option value="Expense">>Expense</option> 
                                        </select>
                                        <label for="floatingstatus">Category Type </label>
                                        </div>
                                        <span style="color:red;" id="updatecategoryTypeErr"></span>
                                    </div>  
                            
                            </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="update" class="btn btn-primary">Update</button>
                    </div>
                    </div>
                </form>
                </div>
            <!-- endnew -->





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    
$(document).ready(function(){

    $('#myform').validate({

        rules: {
                
            categoryName: {
                    required: true,
                    minlength: 3 
                },
            categoryType: {
                    required: true,
                    minlength: 3 
                },
                  
            },

        messages: {
                
            categoryName: {
                    required: " Please enter a Category Name",
                    minlength:
                    " Your Category name must consist of at least 3 characters"
                },
            categoryType: {
                    required: " Please enter a Category Type",
                    minlength:
                    " Your Category Type must consist of at least 3 characters"
                },
                
                
            }

    });
       
    $('#addnewbtn').click(function ()
    {
        // alert('hi');
        // $('#catmodal').modal('show');
        $('#catmodal').appendTo("body").modal('show');

        $('#save').click(function (e){
            e.preventDefault();

            var categoryNameErr = $('#categoryNameErr');
            var categoryTypeErr = $('#categoryTypeErr');
           

            var categoryName = $("#categoryName").val();
            var categoryType = $("#categoryType").val();

    


            // return;
           
                // setTimeout(function() { 
                    
                //     $('#myform')[0].reset();
                //     window.location.reload();
                   
                // }, 2000);

            $.ajax({
                type: 'POST',
                url: 'savecategory',
                data: {
                categoryName: categoryName,
                categoryType: categoryType
                },

                dataType: 'json',
                success: function (response) {


                    categoryNameErr.text(response.categoryName ? response.categoryName.message : '');
                    categoryTypeErr.text(response.categoryType ? response.categoryType.message : '');

                    if (response.success) {
                            
                            console.log(response.success.message);
                              alert(response.success.message); 
                            //   $('#updatemodal').modal('hide');
                            $('#updatemodal').appendTo("body").modal('hide');
                              $('#myform')[0].reset();
                              window.location.reload();
                          }
                    // alert(response.message);
                    // window.location.reload();
                },
                
            });

        });
            
    });

    $('.edit').click(function(event)
    {
        event.preventDefault();

        var id = $(this).attr('value');

        alert(id);
        console.log(id);

        $.ajax({

                url: "editcat",

                type: 'Post',

                data: {id : id},

                dataType: 'json',

                success: function(response){
                    // alert(response[1]);
                    console.log(response);
                    // $("#id").val(response.id);
                    
                    $("#catid").val(response[0].categoryId);
                    $("#updatecategoryName").val(response[0].categoryName);
                    $("#updatecategoryType").val(response[0].categoryType);
                    
                    // $('#updatemodal').modal('show');
                    $('#updatemodal').appendTo("body").modal('show');
                },
            });
    });


    $('body').delegate("#update", "click" ,function(e){
            e.preventDefault();

            var updatecategoryNameErr = $('#updatecategoryNameErr');
            var updatecategoryTypeErr = $('#updatecategoryTypeErr');
            

            var catId = $("#catid").val();

            var categoryName = $("#updatecategoryName").val();
            var categoryType = $("#updatecategoryType").val();

            // console.log(categoryName);
            // return;
            
            $.ajax({
                type: 'POST',
                url: 'updatecat/'+catId,
                data:  {
                categoryName: categoryName,
                categoryType: categoryType
                },

                dataType: 'json',
                success: function (response) {
                    
                    updatecategoryNameErr.text(response.categoryName ? response.categoryName.message : '');
                    updatecategoryTypeErr.text(response.categoryType ? response.categoryType.message : '');

                    if (response.success) {
                            
                            console.log(response.success.message);
                              alert(response.success.message); 
                            //   $('#catmodal').modal('hide');
                              $('#catmodal').appendTo("body").modal('hide');
                              $('#myupdateform')[0].reset();
                              window.location.reload();
                          }

                    // alert(response.message);
                    // window.location.reload();
                },
                
        });
        
    });

    // for sweet alert after delete
    $('.delete').click(function(e) {
            e.preventDefault();
            
            var BlId = $(this).attr('catid');

            console.log(BlId);
            
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
                        url: "<?php echo base_url('admin/deletecat/')?>"+BlId,
                        type: "GET",
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

<?php echo $this->endSection('content') ?>

