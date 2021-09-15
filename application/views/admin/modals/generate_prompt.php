<div class="modal fade" id="generatePrompt" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row export-prompt-group">
					<div class="col-sm-12 col-md-6" style="height: 150px;">
						<div class="card exportexcel-btn standard-card-btn standard-card-btn-primary">
							<div class="card-body text-center">
								<p class="card-btn-icon"><i class="bi bi-arrow-down-circle-fill"></i></p>
								<p class="card-btn-text">SAVE TO THIS DEVICE</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6" style="height: 150px;">
						<div class="send-email-btn card standard-card-btn standard-card-btn-primary">
							<div class="card-body text-center">
								<p class="card-btn-icon"><i class="bi bi-arrow-up-right-circle-fill"></i></p>
								<p class="card-btn-text">SEND AS EMAIL ATTACHMENT</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 mt-4">
						<span class="text-center success-banner-sm">
							<i class="bi bi-exclamation-circle-fill"></i> A copy will be stored in the server. View all generated exports <b><u>here</u></b>.
						</span>
					</div>
				</div>
				<div class="row export-email-group mt-2" style="display: none;">
					<div class="col-sm-12 col-md-8 form-group">
						<input type="text" class="export-email form-control" placeholder="johndoe55@example.com">
						<label class="input-label">EMAIL ADDRESS <span style="margin-left: 5px;"><i class="export-email-icon spinner-border spinner-border-sm" style="color: #de940c; display: none;"></i></span></label>
					</div>
					<div class="col-sm-12 col-md-3 form-group">
						<button type="button" class="btn btn-sm-primary" style="width: 140px;">USE MY EMAIL ADDRESS</button>
					</div>
					<div class="form-group col-sm-12 mt-2">
						<textarea class="export-text form-control standard-input-pad" name="export-text" rows="1" placeholder="..."></textarea>
						<label class="input-label">ADDITIONAL TEXT</label>
					</div>
				</div>
			</div>
			<div class="modal-footer export-footer-group" style="display: none;">
				<!-- <button type="button" class="exportexcel-btn btn btn-primary"><i class="bi bi-check-square"></i> SAVE TO THIS DEVICE</button> -->
				<button type="button" class="send-export-email-btn btn btn-success"><i class="bi bi-check-square"></i> SEND TO EMAIL</button>
			</div>
		</div>
	</div>
</div>