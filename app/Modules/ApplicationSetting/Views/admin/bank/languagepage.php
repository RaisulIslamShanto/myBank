
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>

        <div class="card">
			<div class="card-body table-responsive">
				<div class="d-flex flex-wrap gap-2 align-items-center mb-4 header_title">
					<h5 class="m-0">Language        <span> of users    </span>  </h5>
					<div class="ms-auto d-flex flex-wrap gap-2"> 
						<!-- <button class="btn btn-sm btn-primary" id="addnewbtn" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="ri-equalizer-fill"></i> Add  user  </button> -->
				 
					</div> 
				</div>
	 	 
				<table id="datatable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>  				
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <?php 
                              echo ($first ?? '').'<br>';
                              echo ($second ?? '').'<br>';
                              echo ($third ?? '').'<br>';
                              
                              
                              ?>
                            </tr>
                        </tbody>
                </table>
        </div>

                       
                        
                    <!-- end card-body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

<script>

$(document).ready(function(){

    $('#myform').validate({

        rules: {
                    
                    name: {
                        required: true,
                        minlength: 2 
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    
                },
        
        messages: {
                    
                    name: {
                        required: " Please enter a username",
                        minlength:
                      " Your username must consist of at least 2 characters"
                    },
                    email: {
                        required: " Please enter your email",
                       
                    },

                    password: {
                        required: " Please enter a password",
                        minlength:
                      " Your password must be consist of at least 5 characters"
                    },
                    confirm_password: {
                        required: " Please enter a password",
                        minlength:
                      " Your password must be consist of at least 5 characters",
                        equalTo: " Please enter the same password as above"
                    },
                    
                }

    });

    $('#addnewbtn').click(function ()
    {
        // alert('hi');
        // $('#usermodal').modal('show');
        $('#usermodal').appendTo("body").modal('show');
        $('#save').click(function (e){
            e.preventDefault();

            // var formData = new FormData(document.getElementById("myform"));
            var nameErr = $('#nameErr');
            var emailErr = $('#emailErr');
            var passwordErr = $('#passwordErr');
            var cpasswordErr = $('#cpasswordErr');


            // for value entry
            var name = $("#username").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirm_password = $("#confirm_password").val();

            // setTimeout(function() { 
                    
                //     $('#myform')[0].reset();
                //     window.location.reload();
                   
                // }, 2000);

            $.ajax({
                type: 'POST',
                url: 'saveuser',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    confirm_password: confirm_password,
                },

                dataType: 'json',
                success: function (response) {
                            console.log(response);
                            nameErr.text(response.name ? response.name.message : '');
                            emailErr.text(response.email ? response.email.message : '');
                            passwordErr.text(response.password ? response.password.message : '');
                            cpasswordErr.text(response.confirm_password ? response.confirm_password.message : '');
                         
                            if (response.success) {
                            
                            console.log(response.success.message);
                            //   alert(response.success.message); 
                              $.toast({ text :' New User has been created',
                                        hideAfter : 12000,
                                        position: 'top-right',
                                        bgColor: '#FF1356',
                                        textColor: 'white' });
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

    $('.deleteuser').click(function(event) { 

        event.preventDefault();
        var id = $(this).attr('value');
        // alert(id);
        

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

           

        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            ).then(() => {
                window.location.href = "<?php echo base_url('/admin/deleteuser/')?>"+id;
            });
        }
        })

    });
    
    $('.edit').click(function (event)
    {
        event.preventDefault();

        var id = $(this).attr('value');

        // alert(id);
        // console.log(id);

        $.ajax({

                url: "edituser",

                type: 'GET',

                data: {id : id},

                dataType: 'json',

                success: function(response){

                    console.log(response);
                    // $("#id").val(response.id);
                    // console.log(response[0].userId)
                   
                    
                    $('#updateuserid').val(response[0].userId);
                    $("#updateusername").val(response[0].name);
                    $("#updateemail").val(response[0].email);
                    $("#updatepassword").val(response[0].password);
                    $("#updateconfirm_password").val(response[0].confirm_password);

                    // $('#updatemodal').modal('show');
                    $('#updatemodal').appendTo("body").modal('show');
                },
            });
    });


    $('body').delegate("#update", "click" ,function (e){
            e.preventDefault();

            var userId = $("#updateuserid").val();
            var name = $("#updateusername").val();
            var email = $("#updateemail").val();
            var password = $("#updatepassword").val();
            var confirm_password = $("#updateconfirm_password").val();


            var updatenameErr = $('#updatenameErr');
            var updateemailErr = $('#updateemailErr');
            var updatepasswordErr = $('#updatepasswordErr');
            var updatecpasswordErr = $('#updatecpasswordErr');
            // console.log(name);
            // console.log(email);
            // console.log(password);
            // console.log(password);

            // return;

            $.ajax({
                type: 'POST',
                url: 'updateuser/'+userId,
                data: {
                    name: name,
                    email: email,
                    password: password, 
                    confirm_password: confirm_password,
                },

                dataType: 'json',
                success: function (response) {

                            updatenameErr.text(response.name ? response.name.message : '');
                            updateemailErr.text(response.email ? response.email.message : '');
                            updatepasswordErr.text(response.password ? response.password.message : '');
                            updatecpasswordErr.text(response.confirm_password ? response.confirm_password.message : '');
                          if (response.success) {
                            
                            console.log(response.success.message);
                              alert(response.success.message); 
                            //   $('#usermodal').modal('hide');
                              $('#usermodal').appendTo("body").modal('hide');
                              $('#myform')[0].reset();
                              window.location.reload();
                          }
                    // alert(response.message);
                    // window.location.reload();
                    },
                
         });


    });

});



    


</script>

<?php echo $this->endSection('content') ?>


