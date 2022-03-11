<?php if (!$this->session->userdata('UserRestrictions')['branding_edit']) return; ?>
<?php echo form_open(base_url().'admin/Update_BrandCategory','method="post"'); ?>
<div class="modal fade" id="update_brandcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">UPDATE BRAND</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">Brand Details</h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-5">
                <input type="hidden" class="form-control standard-input-pad up_uid" name="uid" placeholder="" autocomplete="off">
                <input id="brand_name" type="text" class="form-control standard-input-pad up_brand_name" name="brand_name" placeholder="" autocomplete="off">
                <label for="brand_name">Brand Name</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-4">
                <input id="brand_nameabr" type="text" class="form-control standard-input-pad up_brand_name_abbr" name="brand_name_abbr" placeholder="" autocomplete="off">
                <label for="brand_nameabr">Brand Name (ABBR)</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-4">

                <input id="brand_char" type="text" class="form-control standard-input-pad up_brand_char" name="brand_char" placeholder="" autocomplete="off">
                <label for="brand_char">Char</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-5">
                <input id="brand_type" type="text" class="form-control standard-input-pad up_brand_type" name="brand_type" placeholder="" autocomplete="off">
                <label for="brand_type">Type</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="brand_typeabr" type="text" class="form-control standard-input-pad up_brand_type_abbr" name="brand_type_abbr" placeholder="" autocomplete="off">
                <label for="brand_typeabr">Type (ABBR)</label>
              </div>
            </div>
          </fieldset>
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">Brand Properties</h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="prod_line" type="text" class="form-control standard-input-pad up_prod_line" name="prod_line" placeholder="" autocomplete="off">
                <label for="prod_line">Product Line</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="prod_lineabr" type="text" class="form-control standard-input-pad up_prod_line_abbr" name="prod_line_abbr" placeholder="" autocomplete="off">
                <label for="prod_lineabr">Product Line (ABBR)</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="prod_type" type="text" class="form-control standard-input-pad up_prod_type" name="prod_type" placeholder="" autocomplete="off">
                <label for="prod_type">Product Type</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="prod_typeabr" type="text" class="form-control standard-input-pad up_prod_type_abbr" name="prod_type_abbr" placeholder="" autocomplete="off">
                <label for="prod_typeabr">Product Type (ABBR)</label>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button id="update_brand" type="submit" class="btn btn-success">Update Brand</button>
        <button id="update_brandcatdismiss" type="button" class="btn btn-secondary">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>