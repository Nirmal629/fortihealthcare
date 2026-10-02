<?php
include('header.php');
include('sidebar.php');
?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dashboard</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="dashboard.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dashboard</span></li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">E-commerce KPI Overview</h2>
				</header>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<div class="kpi-box bg-primary text-center p-md">
								<h4>Total Orders</h4>
								<p class="h2">1,245</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="kpi-box bg-success text-center p-md">
								<h4>Revenue</h4>
								<p class="h2">$32,580</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="kpi-box bg-warning text-center p-md">
								<h4>Visitors</h4>
								<p class="h2">9,376</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="kpi-box bg-danger text-center p-md">
								<h4>Refunds</h4>
								<p class="h2">18</p>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-8">
							<h4 class="mb-md">Sales Trend</h4>
							<canvas id="salesChart" height="150"></canvas>
						</div>
						<div class="col-md-4">
							<h4 class="mb-md">Sales by Category</h4>
							<canvas id="categoryPieChart" height="150"></canvas>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Recent Orders</h2>
				</header>
				<div class="panel-body">
					<table class="table table-bordered table-striped mb-none">
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Customer</th>
								<th>Date</th>
								<th>Status</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>#1001</td>
								<td>John Doe</td>
								<td>2025-06-24</td>
								<td><span class="label label-success">Completed</span></td>
								<td>$150.00</td>
							</tr>
							<tr>
								<td>#1002</td>
								<td>Jane Smith</td>
								<td>2025-06-23</td>
								<td><span class="label label-warning">Pending</span></td>
								<td>$200.00</td>
							</tr>
							<tr>
								<td>#1003</td>
								<td>Sam Wilson</td>
								<td>2025-06-22</td>
								<td><span class="label label-danger">Cancelled</span></td>
								<td>$75.00</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
		</div>
	</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	const salesChart = new Chart(document.getElementById('salesChart'), {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
			datasets: [{
				label: 'Sales',
				data: [1200, 1900, 3000, 5000, 2300, 3900],
				borderColor: '#0088cc',
				fill: false
			}]
		}
	});

	const categoryPieChart = new Chart(document.getElementById('categoryPieChart'), {
		type: 'pie',
		data: {
			labels: ['Electronics', 'Clothing', 'Home'],
			datasets: [{
				data: [40, 30, 30],
				backgroundColor: ['#734ba9', '#2baab1', '#e36159']
			}]
		}
	});
</script>

<?php
include('footer.php');
?>
