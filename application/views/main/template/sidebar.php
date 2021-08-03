<div id="sidebar" class="active">
	<div class="sidebar-wrapper active">
		<div class="sidebar-header">
			<div class="d-flex justify-content-between">
				<div class="logo">
					<a href="index.html"><img src="<?=base_url() . 'assets/images/manalok9_logo.png'?>" width="250" height="70"></a>
				</div>
				<div class="toggler">
					<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
				</div>
			</div>
		</div>
		<div class="sidebar-menu">
			<ul class="menu">
				<li class="sidebar-title">ORWELL</li>

				<li class="sidebar-item sidebar-admin-dashboard">
					<a href="<?=base_url().'admin'?>" class='sidebar-link'>
						<i class="bi bi-calendar-check-fill"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="sidebar-item sidebar-admin-employees">
					<a href="<?=base_url().'admin/users'?>" class='sidebar-link'>
						<i class="bi bi-person-lines-fill"></i>
						<span>Users</span>
					</a>
				</li>
				<li class="sidebar-item sidebar-admin-products">
					<a href="<?=base_url().'admin/products'?>" class='sidebar-link'>
						<i class="bi bi-bag-fill"></i>
						<span>Products</span>
					</a>
				</li>
				<li class="sidebar-item sidebar-admin-inventory">
					<a href="<?=base_url().'admin/inventory'?>" class='sidebar-link'>
						<i class="bi bi-cart-fill"></i>
						<span>Inventory</span>
					</a>
				</li>

				<li class="sidebar-title">YOUR CORNER</li>

				<li class="sidebar-item sidebar-employee-attendance">
					<a href="<?=base_url().'user'?>" class='sidebar-link'>
						<i class="bi bi-person-badge-fill"></i>
						<span>My Activities</span>
					</a>
				</li>

				<!-- <li class="sidebar-title">DEMO</li> -->

				<!-- <li class="sidebar-item sidebar-admin-viewproduct">
					<a href="<?=base_url().'admin/viewproduct'?>" class='sidebar-link'>
						<i class="bi bi-cart"></i>
						<span>Product View</span>
					</a>
				</li> -->
				<!-- <li class="sidebar-item sidebar-demo-inventory">
					<a href="<?=base_url().'demo/inventory'?>" class='sidebar-link'>
						<i class="bi bi-cart"></i>
						<span>Inventory System</span>
					</a>
				</li> -->

				<li class="sidebar-title">ACCOUNT</li>

				<li class="sidebar-item sidebar-profile">
					<a href="<?=base_url().'profile'?>" class='sidebar-link'>
						<img class="rounded-circle" src="<?=base_url() . $image;?>" width="24" height="24">
						<span><?=$fullName;?></span>
					</a>
				</li>
				<li class="sidebar-item">
					<a href="<?=base_url().'logout'?>" class='sidebar-link'>
						<i class="bi bi-door-open-fill"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		</div>
	<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
	</div>
</div>