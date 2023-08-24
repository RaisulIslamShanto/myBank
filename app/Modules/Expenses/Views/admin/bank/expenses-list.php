<?= $this->extend('\Modules\Master\Views\master') ?>
<?= $this->section('content') ?>




<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
       
        
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                
                <div class="card">
                    <div class="card-body">
                    <div class="sidebar-header">
                    <div class="col-md-12">
                    <a href="<?php echo base_url() ?>/admin/expenses_add" class="btn btn-info"><i class="fa fa-plus"></i> Add new</a>
                    <!-- <a href="<?php// echo base_url() ?>/admin/" class="btn btn-primary">Export Income Data</a> -->
                    <br>
                    <br>
                </div>
                        <!-- <button type="button" class="btn btn-primary" id="openModalBtn">Add New</button> -->
                        </div>
                        <div class="table-responsive ser_staffpayment_append">   
                        <table id="expenseslist" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Bank Account Number</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Attached</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($myexpData as $value): ?>
                                <tr>

                                    <td><?=$username?></td>
                                    <td><?= $value['exp']->account_number?></td>
                                    <td><?= $value['expense_category']?></td>
                                    <td>BDT <?= $value['amount']?></td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('expensesAttachment/' . $value['add_attachment']); ?>" download class="btn btn-success btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>
                                    <td><?= $value['description']?></td>
                                    <td><?= $value['date']?></td>
                                    <td>
                                    <a href="<?= base_url() ?>/admin/expenses_list_edit/<?= $value['id']; ?>" class="btn btn-warning btn-sm editButton" data-id="<?php echo $value['id']; ?>">
                                    <i class="fa fa-pencil"></i> Edit
                                    </a>
                                        <!-- <button class="btn btn-primary btn-sm">Edit</button> -->
                                        
                                    <a href="<?= base_url() ?>/admin/expenses_delete/<?= $value['id']; ?>" class="btn btn-danger btn-sm Deletebtn" data-id="<?php echo $value['id']; ?>">
                                    <i class="fa fa-trash"></i> Delete
                                    </a>
                                    </td>
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
    $('#expenseslist').DataTable({
        searchHighlight: true, 
        columnDefs: [
            { type: 'highlight', targets: '_all' } 
        ]
    });
});
</script>

<!-- <script>
        $(document).ready(function() {
            $('#expenseslist').DataTable( {
            searching: true,
            info : true,
            paging: true,
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf'
            ]
        });
        });
        </script> -->




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.Deletebtn').click(function(e) {
            e.preventDefault();
            
            // var debtsId = $(this).data('id');
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
                        url: "<?php echo base_url('/admin/expenses_delete/').$value['id'] ?>",
                        type: "POST",
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

<?= $this->endSection() ?>