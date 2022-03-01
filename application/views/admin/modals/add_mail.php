<?php echo form_open_multipart(base_url().'send_email_to','id="form_emailsend" method="post"'); ?>
<div class="modal fade" id="add_mailtosend" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-content-custom">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Send Mail</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="form-row d-flex flex-row">
                <div class="form-group col-5 p-3">
                  <label>
                    <i class="bi bi-forward"></i> TO
                  </label>
                  <input type="text" class="form-control standard-input-pad send_to" name="send_to">
                  
                </div>
                <div class="form-group col-7 p-3">
                  <label>
                    <i class="bi bi-card-text"></i> SUBJECT
                  </label>
                  <input type="text" class="form-control standard-input-pad mail_subject" name="mail_subject">
                  
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12">
              <div class="form-row">
                <div class="form-group p-3">
                  <label>
                    <i class="bi bi-chat-left"></i> MESSAGE
                  </label>
                  <textarea class="form-control standard-input-pad mail_message" rows="4" name="mail_message"></textarea>
                  
                </div>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="form-row">
                <div class="form-group p-3">
                  <label>
                    <i class="bi bi-paperclip"></i> ATTACHMENT
                  </label>
                  <input type="file" class="form-control standard-input-pad mail_attachment" name="mail_attachment">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <button id="submit_formsend" type="button" class="btn btn-success"><i class="bi bi-check-square"></i> Send</button>
        <button type="button" class="btn btn-secondary">Back</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>