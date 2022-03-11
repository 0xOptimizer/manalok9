<?php echo form_open('admin/SubmitNewItemcode','method="post"'); ?>
<div class="modal fade" id="add_itemcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ADD ITEM CODE</h5>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row p-4">
            <div class="col-12 col-md-4">
              <div class="form-row">
                <div class="form-group">
                  <input class="form-control" type="text" name="brand_top">
                  <label class="input-label">BRAND</label>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-row">
                <div class="form-group">
                  <input class="form-control" type="text" name="cat_char">
                  <label class="input-label">CATEGORY ( CHAR )</label>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-row">
                <div class="form-group">
                  <input class="form-control" type="text" name="prod_type">
                  <label class="input-label">PRODUCT TYPE</label>
                </div>
              </div>
            </div>
            <style type="text/css">
            .hrr {
              margin-top: 1.5rem;
              margin-bottom: 1.5rem;
              border: 0;
              border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
          </style>
          <div class="hrr"></div>
          <div class="text-center">
            <h5>
              Properties
            </h5>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="brand_bot">
                <label class="input-label">BRAND</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="prod_line">
                <label class="input-label">PRODUCT LINE</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="new_type">
                <label class="input-label">TYPE</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-8">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="prod_variant">
                <label class="input-label">VARIANT / COLOR / PRINT/DESCRIPTION</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="prod_size">
                <label class="input-label">SIZE</label>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-row">
              <div class="form-group">
                <input class="form-control" type="text" name="prod_itemcode">
                <label class="input-label">ITEM CODE</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer d-flex justify-content-between">
      <button type="submit" class="btn btn-success"><i class="bi bi-check-square"></i> ADD ITEM CODE</button>
      <button id="ModalDismisss" type="button" class="btn btn-secondary">Exit</button>
    </div>
  </div>
</div>
</div>
<?php echo form_close(); ?>