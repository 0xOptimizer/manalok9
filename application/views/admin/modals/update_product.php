<?php echo form_open(base_url().'UpdatePricesss','method="post"'); ?>
<div class="modal fade" id="update_prdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">UPDATE PRODUCT</h4>
        <h4 class="modal-title" id="txt_code" style="color: #D7A837;"></h4>
      </div>
      <div class="modal-body p-5">
        <input id="txt_id" class="form-control standard-input-pad" type="hidden" name="unit_id" placeholder="###">
        <div class="form-row d-flex flex-wrap">
          <div class="form-group col-12 col-sm-12 p-2">
            <label>PRODUCT NAME</label>
            <input id="prd_n" class="form-control standard-input-pad" type="text" name="Product_Name">
          </div>
          <div class="form-group col-12 col-sm-12 col-md-6 p-2">
            <label>UNIT PRICE</label>
            <input id="unit_price_uid" class="form-control standard-input-pad" type="text" name="unit_price" placeholder="###">
          </div>
          <div class="form-group col-12 col-sm-12 col-md-6 p-2">
            <label>UNIT COST</label>
            <input id="unit_cost_uid" class="form-control standard-input-pad" type="text" name="unit_cost" placeholder="###">
          </div>
          <div class="form-group col-12 col-sm-12 p-2">
            <label>DESCRIPTION</label>
            <textarea id="prd_des" class="form-control standard-input-pad" name="description" rows="4"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button id="" type="submit" class="btn btn-success">Update</button>
        <button id="modal_dis" type="button" class="btn btn-secondary">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>