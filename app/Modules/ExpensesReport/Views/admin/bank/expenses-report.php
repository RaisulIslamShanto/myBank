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
      <form id="reportfilter" method="POST" action="" class="row justify-content-center align-items-center">
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" class="form-control" id="startdate" name="startdate" >
            <label for="floatingSelect">Start Date</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" id="enddate" name="enddate"  class="form-control">
            <label for="floatingSelect">End Date</label>
          </div>
        
        </div>
        <div class="col-md-2">
          <button type="submit" name="submit" id="filter"  class="btn btn-primary w-100 rounded-pill">Search</button>
        </div>
      </form>
    </div>
    <table id="expenseslist" class="table table-striped display responsive nowrap table-bordered" cellspacing="0" style="width:100%">
      <thead>
        <tr>
          <th>Expense Category</th>
          <th>Expense Amount</th>
          <th>Expense Date</th>
        </tr>
      </thead>
      <tbody id="filterdata">
      <?php foreach ($data as $value): ?>
        <tr>
          <td><?= $value['categoryName']?></td>
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



    <script>
      $(document).ready(function(){

        $('#reportfilter').on("submit",function(e)
    {
        // alert('hi');
        e.preventDefault();

            var startdate = $("#startdate").val();
            var enddate = $("#enddate").val();
            
            $.ajax({
                type: 'POST',
                url: 'filterexpense',
                data: {
                    startdate: startdate,
                    enddate: enddate,
                },

                dataType: 'json',

                success: function (data) {

                    console.log(data);

                    var tabledata = '';

                    for (var i = 0; i < data.length; i++) {

                         tabledata += `
                                        
                                            <tr>
                                                
                                                <td>${data[i].categoryName}</td>
                                                <td>${data[i].amount}</td>
                                                <td>${data[i].date}</td>
                                                
                                            </tr>
                                       
                                    `;

                    }

                    $('#filterdata').html(tabledata);
                    
            
                },
                
            });

    });


      });

    </script>



       <script>
          // $(function() {
          //     var dateFormat = "yy/mm/dd",
          //         from = $("#from").datepicker({
          //             defaultDate: "+1w",
          //             changeMonth: true,
          //             numberOfMonths: 1,
          //         }),
          //         to = $("#to").datepicker({
          //             defaultDate: "+1w",
          //             changeMonth: true,
          //             numberOfMonths: 1,
          //         });

          //     function getDate(element) {
          //         var date;
          //         try {
          //             date = $.datepicker.parseDate(dateFormat, element.value);
          //         } catch (error) {
          //             date = null;
          //         }
          //         return date;
          //     }

          //     function filterTableRows() {
          //         var startDate = getDate(from[0]);
          //         var endDate = getDate(to[0]);

          //         $("#expenseslist tr").each(function() {
          //             var rowDate = new Date($(this).find("td:nth-child(3)").text());
          //             if ((isNaN(startDate) && isNaN(endDate)) || (isNaN(startDate) && rowDate <= endDate) || (startDate <= rowDate && isNaN(endDate)) || (startDate <= rowDate && rowDate <= endDate)) {
          //                 $(this).show();
          //             } else {
          //                 $(this).hide();
          //             }
          //         });
          //     }

          //     $("#filterBtn").click(function(event) { 
          //         event.preventDefault(); 
          //         filterTableRows();
          //     });

          //     $("#expensesTableBody tr").show(); 
          // });
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