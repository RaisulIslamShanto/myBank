<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>


<div class="page-content">
    
    <div class="container-fluid">

        <!-- start page title -->
       
        <h1>Add New expense</h1>
        <!-- end page title -->
       

        <div class="row">
            <div class="col-lg-12">
                
            <div class="modal-body">
          <?php foreach($expenseslist as $allValue): ?>
            <form id="expform" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="text" value=<?= $allValue['id']; ?> name="expId" id="expId"> 
                    <!-- <div class="form-group">
                        <label for="Category">Expense Category:</label>
                        <select class="select" id="Category" name="Category">
                                <option value="">--Select a Bank Account--</option>
                                <option value="abc">abc</option>
                                <option value="def">def</option>
                            </select> 
                        <span style="color:red;" id="catErr"></span>
                    </div> -->

                    
                    <div class="form-group">
                        <label for="Category">Expense Category:</label>
                        <select class="select" id="Category" name="Category">

                        <option><?= $allValue['expense_category']?></option>
                                <?php foreach ($Categorytable as $value): ?>
                                    <option value="<?= $value['categoryId']?>"><?= $value['categoryName']?></option>
                                <?php endforeach; ?>
                            </select> 
                        <span style="color:red;" id="catErr"></span>
                    </div>

                    <div class="form-group">
                    <label for="password">Select Bank Account:</label>
                            <select class="select" id="ToAccount" name="ToAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1): ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        <span style="color:red;" id="accErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="Amount">Amount:</label>
                        <input type="text" class="form-control" id="Amount" name="Amount" value="<?= $allValue['amount']?>" required>
                        <span style="color:red;" id="amountErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="Reference">Reference:</label>
                        <input type="text" class="form-control" id="Reference" name="Reference" value="<?= $allValue['reference']?>">
                        <span style="color:red;" id="ReferenceErr"></span>
                    <div class="form-group">
                        <label for="note">Description:</label>
                        <textarea type="text" class="form-control" id="Description" name="Description"><?= $allValue['description']?></textarea>
                        <span style="color:red;" id="desErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="note">Note:</label>
                        <textarea type="text" class="form-control" id="note" name="note"><?= $allValue['note']?></textarea>
                        <span style="color:red;" id="noteErr"></span>
                    </div>
                    <div class="form-group">
                          <label for="Attachment">Add Attachment:</label>
                          <input type="file" name="Attachment" class="form-control" id="Attachment">
                          <span style="color:red;" id="AttachmentErr"></span>
                     </div>
                     <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="text" class="form-control" id="date" name="date" value="<?= $allValue['date']?>">
                        <span style="color:red;" id="dateErr"></span>
                     </div>
                     <div class="modal-footer">
                     <!-- <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button> -->
                     <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                     </div>
                </form>
                <?php endforeach?>
            </div>
         
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>





                <script>
                    $(document).ready(function() {
                    $('#expform').submit(function(e) {e.preventDefault();
                        var id = $('#expId').attr('value');
                        console.log(id);
                        // alert(id);
                    // var emailErr = $('#emailErr');
                    // var passwordErr = $('#passwordErr');
                    // var nameErr = $('#nameErr');
                    // var lastnameErr = $('#lastnameErr');
                    // var phoneErr = $('#phoneErr');
                 

                    var formData = new FormData(this);  
                  $.ajax({
                     url: "<?php echo base_url('/admin/expenses_list_update/')?>" + id,
                     type: "POST",
                     data: formData,
                     contentType: false,
                      processData: false,
                     dataType: "json",
                     success: function(response)
                      {
                        // emailErr.text(response.email ? response.email.message : '');
                        // passwordErr.text(response.password ? response.password.message : '');
                        // nameErr.text(response.firstname ? response.firstname.message : '');
                        // lastnameErr.text(response.lastname ? response.lastname.message : '');
                        // phoneErr.text(response.phone ? response.phone.message : '');
                        // streetErr.text(response.street ? response.street.message : '');
           

                     if (response.success) {
                     alert(response.message);
                    //  window.location.href = "<?//php echo base_url() ?>/admin/expenses-list/";
                     window.location.reload();
                     
                               }
                      }
                    });
                 });
             });
            </script>



<script>
    $(function(){
        $("#date").datepicker();
    });
  </script>


<?= $this->endSection() ?>