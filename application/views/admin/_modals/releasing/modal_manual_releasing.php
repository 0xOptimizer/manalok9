<?php if (!$this->session->userdata('UserRestrictions')['releasing_manual_add_stock']) return; ?>
<div class="modal fade" id="modal_manual_releasing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-square" style="font-size: 20px; margin-right: 5px;"></i> Release using SKU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ajx_res_prompt">
        </div>
        <div class="form-row">
          <div class="form-group">
            <input id="inp_sku" class="form-control standard-input-pad" type="text" name="">
            <label>Product SKU</label>
          </div>
          <div class="form-group text-end">
            <a id="manualselect_stock" href="#" class="manualselect-btn btn btn-success" style="font-size: 12px;">
              <i class="bi bi-plus-square"></i>
              SELECT PRODUCT
            </a>
          </div>
        </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <button id="btn_restock_manual" type="button" class="btn btn-primary" data-id="" data-uid="" data-sku="" data-quantity=""><i class="bi bi-plus"></i> Submit</button>
      </div>
    </div>
  </div>
</div>