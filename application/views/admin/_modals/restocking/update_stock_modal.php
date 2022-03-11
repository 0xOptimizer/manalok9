<?php if (!$this->session->userdata('UserRestrictions')['restocking_update_stock']) return; ?>
<div class="modal fade" id="update_stock_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-square" style="font-size: 20px; margin-right: 5px;"></i> Update Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-5">
        <div class="ajx_res_prompt">

        </div>
        <div class="col-12 col-sm-12">
          <input id="up_id" class="form-control standard-input-pad" type="hidden" name="">
          <input id="up_uids" class="form-control standard-input-pad" type="hidden" name="">
          <input id="up_pre_sku" class="form-control standard-input-pad" type="hidden" name="">
          <div class="form-row d-flex flex-wrap">
            <div class="col-12 col-sm-12 col-md-4 text-center p-2">
              <div class="card" style="background-color: #404040; height: 100%  !important;">
                <div class="card-body">
                  <h5 class="card-title">TOTAL STOCK</h5>
                  <p class="card-text text-primary" id="tp_stock"> 100 </p>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 text-center p-2">
              <div class="card" style="background-color: #404040; height: 100%  !important;">
                <div class="card-body">
                  <h6 class="card-title">REMAINING</h6>
                  <p class="card-text text-primary" id="rsp_stock"> 100 </p>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 text-center p-2">
              <div class="card" style="background-color: #404040; height: 100%  !important;">
                <div class="card-body">
                  <h5 class="card-title">RELEASED</h5>
                  <p class="card-text text-primary" id="rp_stock"> 100 </p>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row d-flex flex-wrap mt-5 text-center">
            <div class="form-group col-12 col-sm-12 col-md-6 px- py-1">
              <input class="form-check-input" type="radio" name="radioUp" value="add_stock" id="up_addradio" checked>
              <label class="form-check-label" for="up_addradio">
                ADD STOCK
              </label>
              
            </div>
            <div class="form-group col-12 col-sm-12 col-md-6 px- py-1">
              <input class="form-check-input" type="radio" name="radioUp" value="deduct_stock" id="up_subradio">
              <label class="form-check-label" for="up_subradio">
                DEDUCT STOCK
              </label>
            </div>
            <br>
            <div class="form-group col-12 col-sm-12 col-md-12 px-3 py-1 mx-auto">
              <input id="up_quantity" class="form-control standard-input-pad text-center" type="number" name="">
              <label class="input-label">
                QUANTITY
              </label>
            </div>
            
          </div>
          <div class="form-row d-flex flex-wrap mt-3 text-center">
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="up_r_price" class="form-control standard-input-pad text-center" type="number" name="" step="0.000001">
              <label class="input-label">
                RETAIL PRICE
              </label>
            </div>
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="up_orig_price" class="form-control standard-input-pad text-center" type="number" name="" step="0.000001">
              <label class="input-label">
                ORIGINAL PRICE
              </label>
            </div>
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="up_expire_date" class="form-control standard-input-pad text-center" type="date" name="">
              <label class="input-label">
                EXIPRATION DATE
              </label>
            </div>
            
          </div>
          <div class="form-row d-flex flex-wrap mt-3 text-center">
            <div class="form-group col-12 col-sm-12 col-md-12 px-3 py-1">
              <input id="up_manufacturer" class="form-control standard-input-pad text-center" type="text" name="">
              <label class="input-label">
                MANUFACTURED BY
              </label>
            </div>
            
          </div>
          <div class="form-row d-flex flex-wrap mt-3 text-center">
            <div class="form-group col-12 col-sm-12 col-md-12 px-3 py-1">
              <textarea id="up_prd_descript" rows="4" class="form-control standard-input-pad"></textarea>
              <label class="input-label">
                DESCRIPTION
              </label>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <button id="btn_stockUpdate" type="button" class="btn btn-primary"><i class="bi bi-plus"></i> Update</button>
      </div>
    </div>
  </div>
</div>