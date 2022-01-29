<div class="modal fade" id="view_stock_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-card-checklist" style="font-size: 20px; margin-right: 5px;"></i> Stock Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <dl class="row mt-4">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              UID
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <label id="uid_lbl">
            </label>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              PRODUCT SKU
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <label id="prd_sku_lbl">
            </label>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              STOCKS
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                ORIGINAL
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="org_stock">
                </label>
              </dd>
            </dl>
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                REMAINING
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="rem_stock">
                </label>
              </dd>
            </dl>
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                RELEASED
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="rel_stock">
                </label>
              </dd>
            </dl>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              PRICE PER ITEM
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                RETAIL
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="ret_price">
                  &#8369 
                </label>
              </dd>
            </dl>
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                ORIGINAL
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="original_price">
                  &#8369 
                </label>
              </dd>
            </dl>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              MANUFACTURER
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <label id="manufact_lbl">
            </label>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              DATE
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                EXPIRATION
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="exp_lbl">
                  
                </label>
              </dd>
            </dl>
            <dl class="row">
              <dt class="col-12 col-sm-12 col-md-3">
                ADDED AT
              </dt>
              <dd class="col-12 col-sm-12 col-md-9">
                <label id="addat_lbl">
                  
                </label>
              </dd>
            </dl>
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-12 col-sm-12 col-md-3">
            <label>
              DESCRIPTION
            </label>
          </dt>
          <dd class="col-12 col-sm-12 col-md-9">
            <label id="descript_lbl">
            </label>
          </dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
      </div>
    </div>
  </div>
</div>