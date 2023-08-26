
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?> 

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add New Income</h4>
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
                    <?php $validation = \Config\Services::validation(); ?> 
                        <form id="incomeform" action="submitincome" method="Post" > 
                        <div class="form-group">
                            <label class="form-label">Income Category</label>
                            
                            <select class="form-control" name="incomeCategory" id="incomeCategory">
                                <option value="">Select an income category</option>


                            <?php foreach($incomeCategories as $value):?>
                                <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                            <?php endforeach?>
                                
                            </select>
                            <span style="color:red;" id="incomeCategoryErr"></span>

                            <?php if($validation->getError('incomeCategory')) {?>
                                <div style="color:red;">
                                <?= $error = $validation->getError('incomeCategory'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Bank Account</label>
                            
                            <select class="form-control" name="bankAccount" id="bankAccount">
                                <option value="">Select a bank account</option>
                            <?php foreach($bankaccountno as $value):?>
                                <option value="<?= $value['id']?>"><?= $value['account_number']?></option>
                            <?php endforeach?>
                                
                            </select>
                            <span style="color:red;" id="bankAccountErr"></span>
                            <?php if($validation->getError('bankAccount')) {?>
                                <div  style="color:red;">
                                <?= $error = $validation->getError('bankAccount'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label class="form-label"  for="">Amount</label>
                            <input class="form-control" type="number" name="amount" id="">
                            <span style="color:red;" id="amountErr"></span>
                            <?php if($validation->getError('amount')) {?>
                                <div  style="color:red;">
                                <?= $error = $validation->getError('amount'); ?>
                                </div>
                            <?php }?>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="">Reference</label>
                            <input class="form-control" type="text" name="reference" id="">
                            <span style="color:red;" id="referenceErr"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="">Description</label>
                            <input class="form-control" type="text" name="description" id="">
                            <span style="color:red;" id="descriptionErr"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label"for="">Note</label>
                            <input class="form-control" type="text" name="note" id="">
                            <span style="color:red;" id="noteErr"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="">Add Attachment</label>
                            <input class="form-control" type="file" name="attachment" id="">
                            <span style="color:red;" id="attachmentErr"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="">Date</label>
                            <input class="form-control" type="date" name="date" id="">
                            <span style="color:red;" id="dateErr"></span>
                        </div>

                            <button class="btn btn-primary mt-4" type="submit" id="submit" >Add new Income</button>
                        </form>
                                


                        
                        
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    
$(document).ready(function(){
   
    $('#incomeform').validate({

        rules: {
            
            incomeCategory: {
                required: true,
                
            },
            bankAccount: {
                required: true,
                
            },
            amount: {
                required: true,
                
            },
            reference: {
                required: true,
                
            },
            description: {
                required: true,
                
            },
            note: {
                required: true,
                
            },
            attachment: {
                required: true,
                
            },
            date: {
                required: true,
                
            },
            
        },

        messages: {
            
            incomeCategory: {
                required: " Please enter a Category Name",
                
            },
            bankAccount: {
                required: "Please enter a Bank Account Name",
                
            },
            amount: {
                required: " Please enter a amount",
                
            },
            reference: {
                required: " Please enter a reference",
               
            },
            description: {
                required: " Please enter a description",
                
            },
            note: {
                required: " Please enter a note",
                
            },
            attachment: {
                required: " Please enter a attachment",
                
            },
            date: {
                required: " Please enter a date",
               
            },
            
        }

    });
    // for showing income category
    // $.ajax({
    //         url: 'incomeCategory',
    //         type: 'GET', 
           
    //         dataType: 'json',
    //         success: function (data) {
                
    //             console.log(data);
    //             var selectOptions = '<option value="0">Select an income category</option>';

    //             // for (var i = 0; i < data.length; i++) {
    //             //     selectOptions += '<option value="' + data[i].id + '">' + data[i].catname + '</option>';
    //             // }
                
    //             for (var i = 0; i < data.length; i++) {
    //                 selectOptions += `<option value="${data[i].categoryId}">${data[i].categoryName}</option>`
    //             }


    //             $('#incomeCategory').html(selectOptions);
    //         },
            
    //     });

    // for showing bank account

    // alert("hi");
    // $.ajax({
    //         url: 'bankaccount',
    //         type: 'GET', 
           
    //         dataType: 'json',
    //         success: function (data) {
                
    //             console.log(data);
    //             var selectOptions = '<option value="0">Select an bank account</option>';

    //             // for (var i = 0; i < data.length; i++) {
    //             //     selectOptions += '<option value="' + data[i].id + '">' + data[i].catname + '</option>';
    //             // }
                
    //             for (var i = 0; i < data.length; i++) {
    //                 selectOptions += `<option value="${data[i].id}">${data[i].account_number}</option>`
    //             }


    //             $('#bankAccount').html(selectOptions);
    //         },
            
    //     });

    
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


    // $('#incomeCategory').on('click',function(){

    // // alert("hi");

    //     // var id = $(this).val();

    //     // alert("hi");
    //     // console.log(id);

    //     $.ajax({
    //         url: 'incomeCategory',
    //         type: 'GET', 
    //         // data: {languageId: id},
    //         dataType: 'json',
    //         success: function (data) {
                
    //             console.log(data);
    //             var selectOptions = '';

    //             // for (var i = 0; i < data.length; i++) {
    //             //     selectOptions += '<option value="' + data[i].id + '">' + data[i].catname + '</option>';
    //             // }
    //             for (var i = 0; i < data.length; i++) {
    //                 selectOptions += `<option value="${data[i].categoryId}">${data[i].categoryName}</option>`
    //             }


    //             $('#incomeCategory').html(selectOptions);
    //         },
            
    //     });

    // });
   
});

</script>

<?php echo $this->endSection('content') ?>

