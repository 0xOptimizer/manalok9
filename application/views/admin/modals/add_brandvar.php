<div class="modal fade" id="add_Brandvars" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">ADD VARIANTS</h4>
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
                      <td>VARIANT / COLOR / PRINT / DESCRIPTION</td>
                      <td>ABBR</td>
                    </tr>
                  </thead>
                  <tbody class="variants_sectionsss">

                  </tbody>
                </table>
              </div>
            </div>
          </fieldset>
          <br>
          <br>
          <fieldset>
            <h5 style="color: #a7852d;">
              ADD VARIANT / COLOR / PRINT / DESCRIPTION
            </h5>
            <div class="row">
              <div class="form-group col-12 col-sm-12 col-md-9">
                <input id="add_variud" type="hidden" class="form-control standard-input-pad" name="add_variud" placeholder="" autocomplete="off">
                <input id="add_varid" type="hidden" class="form-control standard-input-pad" name="add_varid" placeholder="" autocomplete="off">
                <textarea id="add_vcpd" class="form-control standard-input-pad" name="vcpd" placeholder="" autocomplete="off" rows="1"></textarea>
                <label for="add_vcpd">VARIANT / COLOR / PRINT / DESCRIPTION</label>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3">
                <input id="add_vcpdabr" type="text" class="form-control standard-input-pad" name="vcpd_abbr" placeholder="" autocomplete="off">
                <label for="add_vcpdabr">ABBREVATION</label>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button id="add_varSubmit" type="button" class="btn btn-success"><i class="bi bi-check-square"></i> SAVE</button>
        <button id="modaladddis" type="button" class="btn btn-secondary">Back</button>
      </div>
    </div>
  </div>
</div>