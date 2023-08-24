<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!-- new design -->
<div class="card">
  <div class="card-body table-responsive">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
      <h5 class="m-0">Transfer Histories <span> Make a transfer </span>
      </h5>
      <div class="ms-auto d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-sm btn-primary"id="openModalBtn">
          <i class="ri-equalizer-fill"></i> Make a transfer </button>
      </div>
    </div>
    <table id="datatable" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>From Account</th>
          <th>To account</th>
          <th>Transferred amount</th>
          <th>Transfer date</th>
          <th>Note</th>
          
        </tr>
      </thead>
      <tbody>
        <?php foreach ($balanceData as $value): ?>
        <tr>
          <td><?= $value['bank']['account_number'].'-'. $value['bank']['bank']->bank_name?></td>
          <td><?= $value['to_bank']['account_number'].'-'. $value['to_bank']['bank']->bank_name?></td>
          <td>BDT <?= $value['amount']?></td>
          <td><?= $value['transfer_date']?></td>
          <td><?= $value['note']?></td>
        <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

<!-- add transfer modal -->
<div class="modal fade right" id="addTransfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"> New Bank Account </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="form-floating">
              <select class="form-control" id="floatingstatus" aria-label="From Account">
                <option selected> select From Account </option>
                <option value="1">UBC</option>
                <option value="2">Abc</option>
              </select>
              <label for="floatingstatus"> From Account</label>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-floating">
              <select class="form-control" id="floatingstatus" aria-label="To Account ID">
                <option selected> select To Account ID </option>
                <option value="1">UBC</option>
                <option value="2">Abc</option>
              </select>
              <label for="floatingstatus"> To Account ID </label>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-floating">
              <input type="text" class="form-control" placeholder="Amount">
              <label for="floatingSelect">Amount</label>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-floating">
              <input type="date" class="form-control" placeholder="Transfer Date:">
              <label for="floatingSelect">Transfer Date:</label>
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Type Note"></textarea>
              <label for="floatingSelect">Note:</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Transfer Amount</button>
      </div>
    </div>
  </form>
</div>

<!--end new design -->

<!-- For New Bank Account modal -->

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Balance Transfer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="myForm">
                    <div class="form-group">
                      <label for="FromAccount">From Account:</label>
                            <select class="select" id="FromAccount" name="FromAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1): 
                                 if(!$value1['bank']->deleted_at){
                                    ?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php } endforeach; ?>
                            </select> 
                        <span style="color:red;" id="fromErr"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="ToAccount">To Account ID:</label>
                            <select class="select" id="ToAccount" name="ToAccount">
                                <option value="">--Select a Bank Account--</option>
                                <?php foreach ($data as $value1): 
                                     if(!$value1['bank']->deleted_at){?>
                                 <option value="<?php echo $value1['id']; ?>"><?php echo $value1['bank']->bank_name.'-'. $value1['account_number'].'-Balance-'.$value1['initial_balance']; ?></option>
                                <?php } endforeach; ?>
                            </select> 
                        <span style="color:red;" id="toErr"></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount..">
                        <span style="color:red;" id="amountErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="date">Transfer Date:</label>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Transfer Date..">
                        <span style="color:red;" id="dateErr"></span>
                    </div>
                    <div class="form-group">
                        <label for="InitialBalance">Note:</label>
                        <input type="text" class="form-control" id="note" name="note" placeholder="note..">
                        <span style="color:red;" id="noteErr"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal End -->



<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
       
        
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body ">
                    <div class="sidebar-header">
                        <button type="button" class="btn btn-primary" id="openModalBtn">Make a Transfer</button>
                        <br>
                        <br>
                        </div>
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="transferlist" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>From Account</th>
                                <th>To Account</th>
                                <th>Transferred Amount</th>
                                <th>Transfer Date</th>
                                <th>Note</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($balanceData as $value): ?>
                                <tr>
                                    <td><?= $value['bank']['account_number'].'-'. $value['bank']['bank']->bank_name?></td>
                                    <td><?= $value['to_bank']['account_number'].'-'. $value['to_bank']['bank']->bank_name?></td>
                                    <td>BDT <?= $value['amount']?></td>
                                    <td><?= $value['transfer_date']?></td>
                                    <td><?= $value['note']?></td>
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
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>


<!-- End Page-content -->

<!-- end main content-->


<script>
$(document).ready(function() {
    $('#transferlist').DataTable({
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


<script>
        $(document).ready(function() {

            $("#openModalBtn").click(function() {
                $("#myModal").modal("show");
            });
        $("#submitBtn").click(function() {
                    
                    var fromErr = $('#fromErr');
                    var toErr = $('#toErr');
                    var amountErr = $('#amountErr');
                    var dateErr = $('#dateErr');
                    var noteErr = $('#noteErr');

                    // var formData = $("#myForm").serialize();
                    // console.log(formData);
                        $.ajax({
                        url: " <?php echo base_url('/admin/balance_transfer_add') ?> ",
                        type: 'POST',
                        data: $("#myForm").serialize(),
                        dataType: "json",
                        success: function(response) {
                            fromErr.text(response.FromAccount ? response.FromAccount.message : '');
                            toErr.text(response.ToAccount ? response.ToAccount.message : '');
                            amountErr.text(response.amount ? response.amount.message : '');
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

<!-- <script>
$(document).ready(function() {
    $('.Deletebtn').click(function(e) {
        e.preventDefault();
        var baId = $(this).data('id');
        console.log (baId);
        $.ajax({
            url: "<?php //echo base_url('bank_account_delete/') ?>" + baId,
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
</script> -->



<?= $this->endSection() ?>