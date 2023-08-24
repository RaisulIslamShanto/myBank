<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>




<div class="page-content">
    
    <div class="container-fluid">

        <!-- start page title -->
       
        <h2>Manage lend</h2>
        <!-- end page title -->


<!-- For Lend modal -->

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lend More</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm">
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount..">
                        <span style="color:red;" id="amountErr"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BankAccount">Select Bank Account:</label>
                            <select class="select" id="BankAccount" name="BankAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1): ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        <span style="color:red;" id="BankErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Transfer Date..">
                        <span style="color:red;" id="dateErr"></span>
                    </div>
                    <input type="hidden" name="mainid" value="">
                    <input type="text" name="lend" value="lend" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-id="<?php echo $data2['id']; ?>" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal End -->


<!-- For Lend modal -->

<div class="modal" id="Modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Debts Collection</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="mydebtForm">
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount..">
                        <span style="color:red;" id="amountErrr"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="BankAccount">Select Bank Account:</label>
                            <select class="select" id="BankAccount" name="BankAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1): ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php endforeach; ?>
                            </select> 
                        <span style="color:red;" id="BankErrr"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="text" class="form-control" id="date2" name="date" placeholder="Transfer Date..">
                        <span style="color:red;" id="dateErrr"></span>
                    </div>
                    <input type="hidden" name="id" value="">
                    <input type="text" name="depts" value="depts" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-id="<?php echo $data2['id']; ?>" id="submit">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal End -->




        <div class="row">
            <div class="col-lg-12">
                <!-- <input type="text" class="form" name="id" id="id" /> -->
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="staffdetails" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>AMOUNT</th>
                                <th>PERSON</th>
                                <th>DATE</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td><?= $data2['amount']?></td>
                                <td><?= $data2['person']?></td>
                                <td><?= $data2['date']?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="sidebar-header d-flex justify-content-between">
            <button type="button" class="btn btn-danger fa fa-plus" data-id="<?php echo $data2['id']; ?>" id="openModalBtn">Lend More</button>
            <button type="button" class="btn btn-warning fa fa-plus" data-id="<?php echo $data2['id']; ?>" id="ModalBtn">Debts Collection</button>
        </div>
       
            <!-- end col -->
        </div>
        <br></br>
        <div class="row">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body ">
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="staffdetails" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>AMOUNT</th>
                                <th>Bank Name</th>
                                <th>Account Holder</th>
                                <th>Account Number</th>
                                <th>Date</th>
                                <th>Type</th>
 
                                <!-- <th>Actions</th> -->
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($balanceData as $value): ?>
                                <tr>
                                    <td><?= $value['amount']?></td>
                                    <td><?= $value['bank']['bank']->bank_name?></td>
                                    <td><?=$username?></td>
                                    <td><?= $value['bank']['account_number']?></td>
                                    <td><?= $value['date']?></td>
                                    <td><?= $value['type']?></td>
                                </tr>
                                <?php endforeach; ?>
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
        </div>
        
    <!-- container-fluid -->
</div>



<script>
    $(function(){
        $("#date").datepicker();
    });
  </script>

<script>
    $(function(){
        $("#date2").datepicker();
    });
  </script>



<script>
        $(document).ready(function() {

            $("#openModalBtn").click(function() {
                $("#myModal").modal("show");
            });
        $("#submitBtn").click(function() {
                    
                    var amountErr = $('#amountErr');
                    var BankErr = $('#BankErr');
                    var dateErr = $('#dateErr');
                //  $('#idput').val(response.id);
                    var debtId = $(this).data('id');
                    console.log(debtId);
                    // return false;

                        $.ajax({
                        url: "<?php echo base_url('/admin/add_lend/') ?>" + debtId,
                        type: 'POST',
                        data: $("#myForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            amountErr.text(response.amount ? response.amount.message : '');
                            BankErr.text(response.BankAccount ? response.BankAccount.message : '');
                            dateErr.text(response.date ? response.date.message : '');

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




<script>
        $(document).ready(function() {

            $("#ModalBtn").click(function() {
                $("#Modal").modal("show");
            });
        $("#submit").click(function() {
                    
                    var amountErrr = $('#amountErrr');
                    var BankErrr = $('#BankErrr');
                    var dateErrr = $('#dateErrr');
                    var Id = $(this).data('id');
                    console.log(Id);

                        $.ajax({
                        url: " <?php echo base_url('/admin/debts_collection/') ?> "+ Id,
                        type: 'POST',
                        data: $("#mydebtForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            amountErrr.text(response.amount ? response.amount.message : '');
                            BankErrr.text(response.BankAccount ? response.BankAccount.message : '');
                            dateErrr.text(response.date ? response.date.message : '');

                            if (response.success) {
                            alert(response.success.message);
                            $('#mydebtForm')[0].reset();
                            window.location.reload();
                            }
                        }
                        });
        
            });
        });
        </script>


<?= $this->endSection() ?>