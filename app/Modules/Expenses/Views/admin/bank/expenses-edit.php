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
          <?php foreach($expData as $allValue): ?>
            <form id="expform" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" value=<?= $allValue['id']; ?> name="expId" id="expId"> 
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

                        <option><?= $allValue['cat']->categoryName?></option>
                                <?php foreach ($Categorytable as $cat): ?>
                                    <option value="<?= $cat['categoryId']?>"><?= $cat['categoryName']?></option>
                                <?php endforeach; ?>
                            </select> 
                        <span style="color:red;" id="catErr"></span>
                    </div>

                    <div class="form-group">
                    <label for="password">Select Bank Account:</label>
                            <select class="select" id="ToAccount" name="ToAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1):
                                     if(!$value1['bank']->deleted_at){ ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php } endforeach; ?>
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
                    var catErr = $('#catErr');
                    var accErr = $('#accErr');
                    var amountErr = $('#amountErr');
                    var ReferenceErr = $('#ReferenceErr');
                    var desErr = $('#desErr');
                    var noteErr = $('#noteErr');
                    var AttachmentErr = $('#AttachmentErr');
                    var dateErr = $('#dateErr');
                 

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
                        catErr.text(response.Category ? response.Category.message : '');
                        accErr.text(response.ToAccount ? response.ToAccount.message : '');
                        amountErr.text(response.Amount ? response.Amount.message : '');
                        ReferenceErr.text(response.Reference ? response.Reference.message : '');
                        desErr.text(response.Description ? response.Description.message : '');
                        noteErr.text(response.note ? response.note.message : '');
                        AttachmentErr.text(response.phone ? response.phone.message : '');
                        dateErr.text(response.date ? response.date.message : '');
           
           

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