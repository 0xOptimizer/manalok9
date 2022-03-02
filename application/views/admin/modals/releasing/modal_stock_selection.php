<?php if (!$this->session->userdata('UserRestrictions')['releasing_scan_add_stock'] && !$this->session->userdata('UserRestrictions')['releasing_manual_add_stock']) return; ?>
<div class="modal fade" id="modal_stock_selection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-box-seam" style="font-size: 20px; margin-right: 5px;"></i> Select Stock [<span id="product_sku"></span>]</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="ajx_res_prompt">
				</div>
				<div class="row">
					<div class="col-sm-12" style="margin-top: -15px;">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" style="font-size: 14px;"><i class="bi bi-search h-100 w-100" style="margin-top: 5px;"></i></span>
							</div>
							<input type="text" id="tableStocksSearch" class="form-control" placeholder="Search" style="font-size: 14px;">
						</div>
					</div>
					<div class="col-sm-12 table-responsive">
						<table id="selectstocksTable" class="standard-table table">
							<thead style="font-size: 12px;">
								<th class="text-center">ID</th>
								<th class="text-center">STOCK</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">DATE ADDED</th>
								<th class="text-center">EXPIRATION DATE</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>