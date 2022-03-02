<?php if (!$this->session->userdata('UserRestrictions')['branding_view']) return; ?>
<div class="modal fade" id="view_brandcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle">BRAND DETAILS</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <fieldset>
            <h5>
              Brand
            </h5>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="bname">
                </label>
                <br>
                <small style="color: #a7852d;">Brand Name</small>
                
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="bchar">
                </label>
                <br>
                <small style="color: #a7852d;">Brand Char</small>
                
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="btype">
                </label>
                <br>
                <small style="color: #a7852d;">Brand Type</small>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <h5>
              Property
            </h5>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="bnameAbbr">
                </label>
                <br>
                <small style="color: #a7852d;">Brand Name (ABBR)</small>
                
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="btAbbr">
                </label>
                <br>
                <small style="color: #a7852d;">Brand Type (ABBR)</small>
                
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="pline">
                </label>
                <br>
                <small style="color: #a7852d;">Product Line</small>
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="plineAbbr">
                </label>
                <br>
                <small style="color: #a7852d;">Product Line (ABBR)</small>
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="ptype">
                </label>
                <br>
                <small style="color: #a7852d;">Product Type</small>
              </div>
              <div class="col-12 col-sm-12 col-md-4 text-center" style="margin-bottom: 6px;">
                <label class="ptypeAbbr">
                </label>
                <br>
                <small style="color: #a7852d;">Product Type (ABBR)</small>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="row" style="margin-top: 9px;">
              <div class="col-12 col-sm-12 col-md-12" style="margin-bottom: 6px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th> VARIANT / COLOR / PRINT / DESCRIPTION </th>
                      <th> ABBR </th>
                    </tr>
                  </thead>
                  <tbody class="variants_section">

                  </tbody>
                </table>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12" style="margin-bottom: 6px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th> Product Size </th>
                      <th> ABBR </th>
                    </tr>
                  </thead>
                  <tbody class="sizes_section">

                  </tbody>
                </table>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        <?php if ($this->session->userdata('UserRestrictions')['branding_add']): ?>
          <button id="add_brandvariants" type="button" class="btn btn-success" data-value="">Add Variants</button>
          <button id="add_brandsizes" type="button" class="btn btn-success" data-value="">Add Sizes</button>
        <?php endif; ?>
        <button id="view_brandcatdismiss" type="button" class="btn btn-secondary">Close</button>
      </div>
    </div>
  </div>
</div>