
                            
<div class="sidebar_logo">
	<a class="navbar-brand" href="<?php echo base_url() ?>/admin/dashboard"><img src="assets/img/logo.png" height="40" class="logo"></a>
</div>
<div class="sidebar"> 
	<nav class="navbar navbar-expand-lg p-0">
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav d-block w-100 mb-2 mb-lg-0"> 
	        <li class="nav-item">
	          <a class="nav-link active" href="<?php echo base_url() ?>/admin/dashboard"><i class="ri-dashboard-3-line"></i> <?php echo ($dashboard ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/manage_user"> <i class="ri-user-3-line"></i><?php echo ($Manage_Users  ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/categorypage"> <i class="ri-list-check"></i><?php echo ($Categories ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/bank_list"> <i class="ri-bank-line"></i><?php echo ($Banks ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/account_list"> <i class="ri-account-box-line"></i><?php echo ($Bank_Accounts ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/balance_transfer_list"> <i class="ri-arrow-left-right-line"></i><?php echo ($Balance_Transfer ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/debts_loans_list"> <i class="ri-hand-coin-line"></i><?php echo ($Debts_Loans ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/incomepage"> <i class="ri-refund-2-line"></i><?php echo ($Incomes ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/expenses_list"> <i class="ri-refund-line"></i><?php echo ($Expenses ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/budgets_list"> <i class="ri-wallet-3-line"></i><?php echo ($Budgets ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/incomereportpage"> <i class="ri-line-chart-line"></i><?php echo ($Income_Report ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/expenses_report"> <i class="ri-bar-chart-box-line"></i><?php echo ($Expense_Report ?? '');?></a>
	        </li> 
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/calendar"> <i class="ri-calendar-2-fill"></i><?php echo ($Calendar ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="goals.php"> <i class="ri-trophy-line"></i><?php echo ($Set_Goals ?? '');?> </a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="myassets.php"> <i class="ri-community-line"></i><?php echo ($My_Assets ?? '');?></a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="<?php echo base_url() ?>/admin/application_setting"> <i class="ri-settings-3-line"></i><?php echo ($Application_settings ?? '');?> </a>
	        </li>
	      </ul> 
	    </div>
	</nav> 
</div>