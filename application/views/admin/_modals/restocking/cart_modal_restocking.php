<?php if (!$this->session->userdata('UserRestrictions')['restocking_scan_add_stock'] && !$this->session->userdata('UserRestrictions')['restocking_manual_add_stock']) return; ?>
<div class="modal fade" id="restocking_cart_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-cart2" style="font-size: 20px; margin-right: 5px;"></i> Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ajx_res_prompt">

        </div>
        <div id="fill_data_cart" class="container-fluid">

        </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <a class="btn btn-primary" href="<?=base_url()?>admin/restockin_from_cart"><i class="bi bi-plus"></i> Restock</a>
      </div>
    </div>
  </div>
</div>