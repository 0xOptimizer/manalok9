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
				<li class="sidebar-title">INVENTORY</li>

				<li class="sidebar-item sidebar-admin-dashboard">
					<a href="<?=base_url().'admin'?>" class='sidebar-link'>
						<i class="bi bi-calendar-check-fill"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<?php if ($this->session->userdata('UserRestrictions')['products_view']): ?>
					<li class="sidebar-item sidebar-admin-products">
						<a href="<?=base_url().'admin/products'?>" class='sidebar-link'>
							<i class="bi bi-bag-fill"></i>
							<span>Products</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['releasing_view']): ?>
					<li class="sidebar-item sidebar-admin-releasing_productv2">
						<a href="<?=base_url()?>admin/product_releasingv2" class='sidebar-link'>
							<i class="bi bi-card-checklist"></i>
							<span>Releasing </span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['restocking_view']): ?>
					<li class="sidebar-item sidebar-admin-restock_productv2">
						<a href="<?=base_url()?>admin/product_restockingv2" class='sidebar-link'>
							<i class="bi bi-card-list"></i>
							<span>Restocking </span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['inventory_view']): ?>
					<li class="sidebar-item sidebar-admin-inventory">
						<a href="<?=base_url().'admin/inventory'?>" class='sidebar-link'>
							<i class="bi bi-cart-fill"></i>
							<span>Inventory</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['users_view']): ?>
					<li class="sidebar-item sidebar-admin-employees">
						<a href="<?=base_url().'admin/users'?>" class='sidebar-link'>
							<i class="bi bi-person-lines-fill"></i>
							<span>Users</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['vendors_view']): ?>
					<li class="sidebar-item sidebar-admin-vendors pt-3">
						<a href="<?=base_url().'admin/vendors'?>" class='sidebar-link'>
							<i class="bi bi-shop-window"></i>
							<span>Vendors</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['purchase_orders_view']): ?>
					<li class="sidebar-item sidebar-admin-purchase-orders">
						<a href="<?=base_url().'admin/purchase_orders'?>" class='sidebar-link'>
							<i class="bi bi-receipt"></i>
							<span>Purchase Orders</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['bills_view']): ?>
					<li class="sidebar-item sidebar-admin-bills">
						<a href="<?=base_url().'admin/bills'?>" class='sidebar-link'>
							<i class="bi bi-cash"></i>
							<span>Bills</span>
						</a>
					</li>
				<?php endif; ?>
				<?php if ($this->session->userdata('UserRestrictions')['manual_purchases_view']): ?>
					<li class="sidebar-item sidebar-admin-manual-purchases">
						<a href="<?=base_url().'admin/manual_purchases'?>" class='sidebar-link'>
							<i class="bi bi-pencil"></i>
							<span>Manual Purchases</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['clients_view']): ?>
					<li class="sidebar-item sidebar-admin-clients pt-3">
						<a href="<?=base_url().'admin/clients'?>" class='sidebar-link'>
							<i class="bi bi-people-fill"></i>
							<span>Clients</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['sales_orders_view']): ?>
					<li class="sidebar-item sidebar-admin-sales-orders">
						<a href="<?=base_url().'admin/sales_orders'?>" class='sidebar-link'>
							<i class="bi bi-receipt"></i>
							<span>Sales Orders</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['invoice_view']): ?>
					<li class="sidebar-item sidebar-admin-invoices">
						<a href="<?=base_url().'admin/invoices'?>" class='sidebar-link'>
							<i class="bi bi-cash"></i>
							<span>Invoices</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['returns_view']): ?>
					<li class="sidebar-item sidebar-admin-returns">
						<a href="<?=base_url().'admin/returns'?>" class='sidebar-link'>
							<i class="bi bi-reply-fill"></i>
							<span>Returns</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['replacements_view']): ?>
					<li class="sidebar-item sidebar-admin-replacements">
						<a href="<?=base_url().'admin/replacements'?>" class='sidebar-link'>
							<i class="bi bi-arrow-left-right"></i>
							<span>Replacements</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['accounts_view'] || $this->session->userdata('UserRestrictions')['journal_transactions_view']): ?>
					<li class="sidebar-title">ACCOUNTING</li>
				<?php endif; ?>
				<?php if ($this->session->userdata('UserRestrictions')['accounts_view']): ?>
					<li class="sidebar-item sidebar-admin-accounting-accounts">
						<a href="<?=base_url().'admin/accounts'?>" class='sidebar-link'>
							<i class="bi bi-list-ul"></i>
							<span>Accounts</span>
						</a>
					</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['journal_transactions_view']): ?>
					<li class="sidebar-item sidebar-admin-accounting-journal-transactions">
						<a href="<?=base_url().'admin/journals'?>" class='sidebar-link'>
							<i class="bi bi-pen"></i>
							<span>Journal Transactions</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['branding_view'] || $this->session->userdata('UserRestrictions')['trash_bin_view']): ?>
					<li class="sidebar-title">SETTINGS</li>
				<?php endif; ?>
				<!-- <li class="sidebar-item sidebar-admin-settings-itemcode">
					<a href="<?=base_url().'admin/settings_itemcodepage'?>" class='sidebar-link'>
						<i class="bi bi-list-ol"></i>
						<span>Item Code </span>
					</a>
				</li> -->
				
				<?php if ($this->session->userdata('UserRestrictions')['branding_view']): ?>
					<li class="sidebar-item sidebar-admin-settings-bcat">
						<a href="<?=base_url().'admin/view_settings_bcat'?>" class='sidebar-link'>
							<i class="bi bi-list-ol"></i>
							<span>Branding</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['trash_bin_view']): ?>
					<li class="sidebar-item sidebar-employee-trash">
						<a href="<?=base_url()?>admin/trash_bin" class='sidebar-link'>
							<i class="bi bi-trash-fill"></i>
							<span>Trash Bin</span>
						</a>
					</li>
				<?php endif; ?>
				<!-- <li class="sidebar-item sidebar-admin-transactions">
					<a href="<?=base_url().'admin/view_transactions'?>" class='sidebar-link'>
						<i class="bi bi-journal"></i>
						<span>Transactions</span>
					</a>
				</li> -->

				<?php if ($this->session->userdata('UserRestrictions')['mail_view'] || $this->session->userdata('UserRestrictions')['my_activities_view']): ?>
					<li class="sidebar-title">YOUR CORNER</li>
				<?php endif; ?>
				
				<?php if ($this->session->userdata('UserRestrictions')['mail_view']): ?>
					<li class="sidebar-item sidebar-employee-mail">
						<a href="<?=base_url()?>admin/page_mail" class='sidebar-link'>
							<i class="bi bi-envelope"></i>
							<span>Mail</span>
						</a>
					</li>
				<?php endif; ?>

				<?php if ($this->session->userdata('UserRestrictions')['my_activities_view']): ?>
					<li class="sidebar-item sidebar-employee-attendance">
						<a href="<?=base_url().'user'?>" class='sidebar-link'>
							<i class="bi bi-person-badge-fill"></i>
							<span>My Activities</span>
						</a>
					</li>
				<?php endif; ?>
				
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