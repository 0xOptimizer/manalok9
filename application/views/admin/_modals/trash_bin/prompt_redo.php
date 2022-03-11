<?php if (!$this->session->userdata('UserRestrictions')['trash_bin_retrieve']) return; ?>
<div class="modal" id="prompt_redo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Retrieve Product ?</h5>
      </div>
      <div class="modal-body">
        <small>This product will be retrieve.</small>
      </div>
      <div class="modal-footer">
        <a id="retrieve_prd" class="btn btn-primary" type="button" href="#"> Retrieve</a>
        <a id="cancel_modalRetrive" class="btn btn-secondary" type="button" href="#"> Cancel</a>
      </div>
    </div>
  </div>
</div>