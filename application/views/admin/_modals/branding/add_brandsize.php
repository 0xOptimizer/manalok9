<?php if (!$this->session->userdata('UserRestrictions')['branding_add']) return; ?>
<div class="modal fade" id="add_brandsize" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">ADD SIZES</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">Brand Variant</h5>
            <div class="row">
              <div class="col-12">
                <table class="table">
                  <thead>
                    <tr>
                      <td>SIZES</td>
                      <td>ABBR</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody class="sizes_sectionsss">

                  </tbody>
                </table>
              </div>
            </div>
          </fieldset>
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">
              ADD NEW SIZE
            </h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="add_sizeiud" type="hidden" class="form-control standard-input-pad" name="add_sizeiud" placeholder="" autocomplete="off">
                <input id="add_sizeid" type="hidden" class="form-control standard-input-pad" name="add_sizeid" placeholder="" autocomplete="off">
                <textarea id="Add_prd_size" class="form-control standard-input-pad" name="vcpd" placeholder="" autocomplete="off" rows="1"></textarea>
                <label for="Add_prd_size">SIZE</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="add_prd_sizeabbr" type="text" class="form-control standard-input-pad" name="vcpd_abbr" placeholder="" autocomplete="off">
                <label for="add_prd_sizeabbr">ABBREVATION</label>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button id="add_sizeSubmit" type="button" class="btn btn-success"><i class="bi bi-check-square"></i> SAVE</button>
        <button id="modaldis_addsize" type="button" class="btn btn-secondary">Back</button>
      </div>
    </div>
  </div>
</div>