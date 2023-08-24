
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>

<!-- new design -->
<div class="card">
  <div class="card-body table-responsive">
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
      <h5 class="m-0">Income <span>Report</span>
      </h5>
      <div class="ms-auto d-flex flex-wrap gap-2"></div>
    </div>
    <div class="mb-4 d-block filterbox">
      <form id="reportfilter" action="<?= base_url('admin/insertuser') ?>" method="POST" class="row justify-content-center align-items-center">
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" class="form-control" id="startdate" name="startdate" >
            <label for="floatingSelect">Start Date</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating">
            <input type="date" id="enddate" name="enddate" class="form-control">
            <label for="floatingSelect">End Date</label>
          </div>
        </div>
        <div class="col-md-2">
          <button type="submit" id="filter" class="btn btn-primary w-100 rounded-pill">Search</button>
        </div>
      </form>
    </div>
    <table id="tablemain" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>Income Category</th>
          <th>Income Amount</th>
          <th>Income Date</th>
        </tr>
      </thead>
      <tbody id="filterdata">
      <?php foreach($data as $value):?>
        <tr>
          <td><?= $value['categoryName']?></td>
          <td><?= $value['amount']?></td>
          <td><?= $value['date']?></td>
        </tr>
        <?php endforeach?>
      </tbody>
    </table>
  </div>
</div>


<!-- end new design -->





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
                url: 'filterincome',
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
                    
            //     success: function (data) {
                
            //     console.log(data);
            //     var selectOptions = '<option value="0">Select an income category</option>';

            //     // for (var i = 0; i < data.length; i++) {
            //     //     selectOptions += '<option value="' + data[i].id + '">' + data[i].catname + '</option>';
            //     // }
                
            //     for (var i = 0; i < data.length; i++) {
            //         selectOptions += `<option value="${data[i].categoryId}">${data[i].categoryName}</option>`
            //     }


            //     $('#incomeCategory').html(selectOptions);
            // },
                             
                    // alert(response.message);
                    // window.location.reload();
                },
                
            });

    });




    $('#addnewbtn').click(function ()
    {
        // alert('hi');
        $('#bankmodal').modal('show');
       
        $('#save').click(function (e){
            e.preventDefault();

            var bank = $("#bank").val();
            
            $.ajax({
                type: 'POST',
                url: 'savebank',
                data: {
                    bank: bank,
                },

                dataType: 'json',
                success: function (response) {

                    alert(response.message);
                    window.location.reload();
                },
                
            });

        });
            
    });

    $('.edit').click(function (event)
    {
        event.preventDefault();

        var id = $(this).attr('value');

        // alert(id);
        // console.log(id);

        $.ajax({

                url: "editbank",

                type: 'Post',

                data: {id : id},

                dataType: 'json',

                success: function(response){

                    console.log(response);
                    // $("#id").val(response.id);
                   
                    $("#bankid").val(response[0].bankid);
                    $("#bank").val(response[0].bank);
                    
                    $('#bankmodal').modal('show');
                },
            });
    });


    $('body').delegate("#save", "click" ,function (e){
            e.preventDefault();

            var bankid = $("#bankid").val();
            var bank = $("#bank").val();
            

            $.ajax({
                type: 'POST',
                url: 'updatebank/'+bankid,
                data: {
                    bank: bank,  
                },

                dataType: 'json',
                success: function (response) {

                    alert(response.message);
                    window.location.reload();
                },
                
        });
        
    });


    
            
  






});

</script>

<?php echo $this->endSection('content') ?>

