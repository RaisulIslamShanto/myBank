<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | My Smart Property</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.ico">
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    
    <!-- dropify -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" ></script>
    <!-- custom style Css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/admin/assets/css/style.css">
    <script src="<?php echo base_url() ?>/admin/assets/js/custom.js"></script>
</head>

<body>

    <?php     echo $this->include('\Modules\Master\Views\sidebar'); ?>  
    <div class="main_content p-3">

        <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand d-md-none" href="dashboard.php"><img src="assets/img/logo.png" height="16" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <select class="form-control w-auto ms-2"> 
                <option value="1">English</option>
                <option value="2">Arabic</option>
                <option value="3">German</option>
                <option value="4">Italian</option>
                <option value="5">Russian</option>
                <option value="6">Spanish</option>
            </select>
            <ul class="navbar-nav flex-row gap-2 ms-auto align-items-center">
                
                <li class=" d-sm-inline-block">
                    <a href="javascript:;" class="nav-link chooseTheme" id="dark-mode" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Dark Theme" data-bs-original-title="Dark Theme">
                        <i class="ri-moon-line fs-5"></i>
                    </a>
                    <div class="nav-link chooseTheme" id="light-mode" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Light Theme" data-bs-original-title="Light Theme">
                    <i class="ri-sun-fill"></i>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle avatar-md" src="assets/img/profile.jpg" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end pt-0 overflow-hidden">
                    <div class="p-3 text-center bg-body-tertiary">
                        <img class="rounded-circle avatar-md" src="assets/img/profile.jpg" alt="">
                        <h6>Super Admin</h6>
                        <p class="m-0">superadmin@gmail.com</p>
                    </div> 
                    <li><a class="dropdown-item" href="<?=base_url('admin/profile');?>">My Profile</a></li>
                    <li><a class="dropdown-item" href="profile.php">Update Password</a></li> 
                    <li><a class="dropdown-item" href="<?php echo base_url() ?>/admin/logout">Logout</a></li>
                    </ul>
                </li>
                
                </ul>
            
            </div>
        </nav>

        </header>