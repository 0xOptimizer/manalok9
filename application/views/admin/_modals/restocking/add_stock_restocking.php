<?php if (!$this->session->userdata('UserRestrictions')['restocking_manual_add_stock']) return; ?>
<div class="modal fade" id="add_stock_restocking_manual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-square" style="font-size: 20px; margin-right: 5px;"></i> Restock using SKU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ajx_res_prompt">
          
        </div>
        <div class="col-12 col-sm-12 pt-3">
          <div class="form-row d-flex flex-wrap">
            <div class="form-group col-12 col-sm-12 col-md-7 px-3 py-1">
              <input id="m_uids" class="form-control standard-input-pad" type="hidden" name="">
              <input id="m_pre_sku" class="form-control standard-input-pad" type="text" name="">
              <div class="d-flex justify-content-between">
                <label class="input-label">
                  SKU
                </label>
                <span class="sku_prompt"></span>
              </div>
            </div>
          </div>
          <div class="form-row d-flex flex-wrap">
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="m_quant" class="form-control standard-input-pad" type="number" name="">
              <label class="input-label">
                QUANTITY
              </label>
            </div>
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="m_r_price" class="form-control standard-input-pad" type="number" name="" step="0.000001">
              <label class="input-label">
                RETAIL PRICE
              </label>
            </div>
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="m_orig_price" class="form-control standard-input-pad" type="number" name="" step="0.000001">
              <label class="input-label">
                ORIGINAL PRICE
              </label>
            </div>
          </div>
          <div class="form-row d-flex flex-wrap">
            <div class="form-group col-12 col-sm-12 col-md-8 px-3 py-1">
              <input id="m_manufacturer" class="form-control standard-input-pad" type="text" name="">
              <label class="input-label">
                MANUFACTURED BY
              </label>
            </div>
            <div class="form-group col-12 col-sm-12 col-md-4 px-3 py-1">
              <input id="m_expire_date" class="form-control standard-input-pad" type="date" name="">
              <label class="input-label">
                EXIPRATION DATE
              </label>
            </div>
          </div>
          <div class="form-row d-flex flex-wrap">
            <div class="form-group col-12 col-sm-12 col-md-12 px-3 py-1">
              <textarea id="m_prd_descript" rows="4" class="form-control standard-input-pad"></textarea>
              <label class="input-label">
                DESCRIPTION
              </label>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <button id="btn_addstocks_manual" type="button" class="btn btn-primary"><i class="bi bi-plus"></i> Add to cart</button>
      </div>
    </div>
  </div>
</div>