
<?php echo $this->extend('\Modules\Master\Views\master') ?>
<?php echo $this->section('content') ?>

<!-- new design -->
<div class="row">
		<div class="col-md-7">
			<div class="card mb-4">
				<div class="card-body">   
					<div class="row pt-4 mt-4 user_items">
						<div class="col-md-6 mb-4">  
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/icon_income.png" height="40">
										</div>
										<div class="icon_card_content">
											<h6>Income this Month </h6>
											<h3><?=$currency?><?=$income?></h3>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/icon-expense.png" height="40">
										</div>
											<div class="icon_card_content">
											<h6>Expense this month</h6>
											<h3><?=$currency?><?=$expense?></h3>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/total_balance.png" height="40">
										</div>
										<div class="icon_card_content">
											<h6>Total   balance</h6>
											<h3><?=$currency?><?= $totalAmountBalance?></h3>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/icon_lend.png" height="40">
										</div>
										<div class="icon_card_content">
											<h6>Total lend amount</h6>
											<h3><?=$currency?><?=$totallend?></h3>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/icon_borrow.png" height="40">
										</div>
										<div class="icon_card_content">
											<h6>Total borrow amount</h6>
											<h3><?=$currency?><?=$totalborrow?></h3>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
										<div class="icon_card_item">
											<img src="assets/img/total_account.png" height="40">
										</div>
										<div class="icon_card_content">
											<h6>Total bank account</h6>
											<h3><?=$bankaccount?></h3>
										</div>
								</div>
							</div>
						</div>
					</div>
				 
				</div>
			</div>
		</div>
		<div class="col-md-5"> 
			<div class="card mb-4">
				<div class="card-body">
					<h5>This week  <span> Status </span></h5>
					<canvas id="mydoughnut"></canvas> 
				</div>
			</div>
		</div> 
 
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5>Active Budget  <span> Information </span></h5>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Budget Name</th>
									<th>Proposed Amount</th>
									<th>Available Amount</th>
								</tr>
							</thead>
							<tbody>
                                <?php foreach($budgetlist as $val):?>
                                    <tr>
                                        
                                        <td><?= $val['budget_name']?></td>
                                        <td><?=$currency?><?= $val['budget_amount']?></td>
                                        <td><?=$currency?><?= $val['budget_amount']?></td>

                                    </tr>
                                <?php endforeach?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> 
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<h5>Number of account   <span> transfer in this month </span></h5>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>From Account</th>
									<th>To Account</th>
									<th>Transferred Amount</th>
									<th>Transfer Date</th>
								</tr>
							</thead>
							<tbody>
                                <?php foreach($balanceData as $value):?>
                                    <tr>
                                        <!-- $value->from_account -->
                                        <td><?= $value['from_bank']['account_number'].'-'. $value['from_bank']['banktable']->bank_name?></td>
                                        <td><?= $value['to_bank']['account_number'].'-'. $value['to_bank']['banktable']->bank_name?></td>
                                        <td><?=$currency?><?= $value['amount']?></td>
                                        <td><?= $value['transfer_date']?></td>
                                    </tr>
                                <?php endforeach?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> 
	</div>

<!--end new design -->



<!-- new design -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 
  const schoolInfo = document.getElementById('mydoughnut');
  
  <?php
           
            $labels = [];
            $data = [];

            foreach ($chartvalue as $value) {
                $labels[] = $value['categoryName'];
                $data[] = $value['amount'];
            }

            
    ?>

        const expenseLabels = <?php echo json_encode($labels); ?>;
        const expenseData = <?php echo json_encode($data); ?>;

  new Chart(schoolInfo, {
    type: 'doughnut',
    data: {
        labels: expenseLabels,
    //   labels: ['This Month Incame', 'This Month Expance', 'This Month Loan', 'This Month borrow'],
      datasets: [{ 
            data:expenseData,
	    // data: [300, 50, 100 ,20 ],
	    backgroundColor: [
	      'rgb(116, 198, 119)',
	      'rgb(135, 207, 138)',
	      'rgb(162, 224, 165)',
	      'rgb(199, 243, 201)'
	    ],
	    borderWidth: 0,
	    hoverOffset: 4
	  }]
    },
    options: {
    	aspectRatio: 1.10,
      responsive: true, 
	    plugins: {
	      legend: {
	        position: 'top',
	      },
	    
	    }
    }
  });
	 

</script>


<!--end new design -->




<?php echo $this->endSection('content') ?>

