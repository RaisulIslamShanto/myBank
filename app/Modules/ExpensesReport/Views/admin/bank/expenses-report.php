<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>

<!-- new design -->

<div class="card">
  <div class="card-body table-responsive">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
      <h5 class="m-0">Expense <span>Report</span>
      </h5>
      <div class="ms-auto d-flex flex-wrap gap-2"></div>
    </div>
    <div class="mb-4 d-block filterbox">
      <form method="POST" action="<?php echo base_url() ?>/admin/expenses_report_filter" class="row justify-content-center align-items-center">
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" class="form-control" id="from" name="from" required>
            <label for="floatingSelect">Start Date</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" id="to" name="to"  class="form-control">
            <label for="floatingSelect">End Date</label>
          </div>
        <input type="hidden" id="start_date_hidden" name="start_date_hidden">
        <input type="hidden" id="end_date_hidden" name="end_date_hidden">
        </div>
        <div class="col-md-2">
          <button type="submit" name="submit" id="filterBtn"  class="btn btn-primary w-100 rounded-pill">Search</button>
        </div>
      </form>
    </div>
    <table class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>Expense Category</th>
          <th>Expense Amount</th>
          <th>Expense Date</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($expenseslist as $value): ?>
        <tr>
          <td><?= $value['expense_category']?></td>
          <td>BDT<?= $value['amount']?></td>
          <td><?= $value['date']?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>



<!--end new design -->

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        
        <!-- end page title -->
        <div>
            <form method="POST" action="<?php echo base_url() ?>/admin/expenses_report_filter"> 
                <label for="from">Start Date</label>
                <input type="text" id="from" name="from" required>
                <label for="to">End Date</label>
                <input type="text" id="to" name="to" required>
                <input type="hidden" id="start_date_hidden" name="start_date_hidden">
                <input type="hidden" id="end_date_hidden" name="end_date_hidden">
                <input type="submit" name="submit" id="filterBtn" value="Filter">
            </form>
        </div>
        <br> </br>
        <!-- <div class="form-group">
            <label for="Startdate">Start Date:</label>
            <input type="text" class="form-control" id="Startdate" name="Startdate" placeholder="Start Date..">
        </div>
        <div class="form-group">
            <label for="Enddate">End Date:</label>
            <input type="text" class="form-control" id="Enddate" name="Enddate" placeholder="End Date..">
        </div>

        <button type="button" class="btn btn-primary" id="openModalBtn">Filter</button> -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-body ">
                            <div class="sidebar-header">
                            <div class="col-md-12">
                        </div>
                        </div>
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="expenseslist" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody id="expensesTableBody"> 

                            <?php foreach ($expenseslist as $value): ?>
                                <tr>
                                    <td><?= $value['expense_category']?></td>
                                    <td>BDT <?= $value['amount']?></td>
                                    <td><?= $value['date']?></td>
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
          $(function() {
              var dateFormat = "yy/mm/dd",
                  from = $("#from").datepicker({
                      defaultDate: "+1w",
                      changeMonth: true,
                      numberOfMonths: 1,
                  }),
                  to = $("#to").datepicker({
                      defaultDate: "+1w",
                      changeMonth: true,
                      numberOfMonths: 1,
                  });

              function getDate(element) {
                  var date;
                  try {
                      date = $.datepicker.parseDate(dateFormat, element.value);
                  } catch (error) {
                      date = null;
                  }
                  return date;
              }

              function filterTableRows() {
                  var startDate = getDate(from[0]);
                  var endDate = getDate(to[0]);

                  $("#expenseslist tr").each(function() {
                      var rowDate = new Date($(this).find("td:nth-child(3)").text());
                      if ((isNaN(startDate) && isNaN(endDate)) || (isNaN(startDate) && rowDate <= endDate) || (startDate <= rowDate && isNaN(endDate)) || (startDate <= rowDate && rowDate <= endDate)) {
                          $(this).show();
                      } else {
                          $(this).hide();
                      }
                  });
              }

              $("#filterBtn").click(function(event) { 
                  event.preventDefault(); 
                  filterTableRows();
              });

              $("#expensesTableBody tr").show(); 
          });
        </script>


       <!-- <script>
            $(function(){
                $("#Startdate").datepicker();
            });
        </script>

        <script>
            $(function(){
                $("#Enddate").datepicker();
            });
        </script> -->


<?= $this->endSection() ?>