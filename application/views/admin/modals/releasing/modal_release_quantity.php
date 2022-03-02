<?php if (!$this->session->userdata('UserRestrictions')['releasing_scan_add_stock'] && !$this->session->userdata('UserRestrictions')['releasing_manual_add_stock']) return; ?>
<div class="modal fade" id="modal_releasing_quantity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-square" style="font-size: 20px; margin-right: 5px;"></i> Releasing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ajx_res_prompt">
        </div>
        <div class="mt-4">
          <label id="c_stockstext" class="ml-auto">
            Current stock 100
          </label>
        </div>
        <div class="form-row">
          <div class="form-group">
            <input id="inp_quantity" class="form-control standard-input-pad" type="text" name="" max="">
            <label>Enter Quantity

            </label>

          </div>
        </div>

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <button id="submit_releasesend" type="button" class="btn btn-primary"><i class="bi bi-plus"></i> Submit</button>
      </div>
    </div>
  </div>
</div>