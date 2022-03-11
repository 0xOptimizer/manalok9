<?php if (!$this->session->userdata('UserRestrictions')['branding_add']) return; ?>
<?php echo form_open(base_url().'admin/Add_BrandCategory','method="post"'); ?>
<div class="modal fade" id="add_brandcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">ADD BRAND</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">Brand Details</h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-5">
                
                <input id="brand_name" type="text" class="form-control standard-input-pad" name="brand_name" placeholder="" autocomplete="off">
                <label for="brand_name">Brand Name<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-4">
                <input id="brand_nameabr" type="text" class="form-control standard-input-pad" name="brand_name_abbr" placeholder="" autocomplete="off">
                <label for="brand_nameabr">Brand Name (ABBR)<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-4">
                
                <input id="brand_char" type="text" class="form-control standard-input-pad" name="brand_char" placeholder="" autocomplete="off">
                <label for="brand_char">Char<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-5">
                <input id="brand_type" type="text" class="form-control standard-input-pad" name="brand_type" placeholder="" autocomplete="off">
                <label for="brand_type">Type<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="brand_typeabr" type="text" class="form-control standard-input-pad" name="brand_type_abbr" placeholder="" autocomplete="off">
                <label for="brand_typeabr">Type (ABBR)<span style="color: red;"> *</span></label>
              </div>
            </div>
          </fieldset>
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">Brand Properties</h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="prod_line" type="text" class="form-control standard-input-pad" name="prod_line" placeholder="" autocomplete="off">
                <label for="prod_line">Product Line<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="prod_lineabr" type="text" class="form-control standard-input-pad" name="prod_line_abbr" placeholder="" autocomplete="off">
                <label for="prod_lineabr">Product Line (ABBR)<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="prod_type" type="text" class="form-control standard-input-pad" name="prod_type" placeholder="" autocomplete="off">
                <label for="prod_type">Product Type<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="prod_typeabr" type="text" class="form-control standard-input-pad" name="prod_type_abbr" placeholder="" autocomplete="off">
                <label for="prod_typeabr">Product Type (ABBR)<span style="color: red;"> *</span></label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="prod-size" type="text" class="form-control standard-input-pad" name="prod_size" placeholder="" autocomplete="off">
                <label for="prod-size">Product Size</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="prod-sizeabr" type="text" class="form-control standard-input-pad" name="prod_size_abbr" placeholder="" autocomplete="off">
                <label for="prod-sizeabr">Product Size (ABBR)</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-9">
                <!-- <input id="vcpd" type="text" class="form-control standard-input-pad" name="vcpd" placeholder="" autocomplete="off"> -->
                <textarea id="vcpd" class="form-control standard-input-pad" name="vcpd" placeholder="" autocomplete="off" rows="3"></textarea>
                <label for="vcpd">VARIANT / COLOR / PRINT / DESCRIPTION</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="vcpdabr" type="text" class="form-control standard-input-pad" name="vcpd_abbr" placeholder="" autocomplete="off">
                <label for="vcpdabr">VARIANT / COLOR / PRINT / DESCRIPTION (ABBR)</label>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> SAVE</button>
        <button id="ModalDismisss" type="button" class="btn btn-secondary">Exit</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>