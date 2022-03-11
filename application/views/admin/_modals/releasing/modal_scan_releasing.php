<?php if (!$this->session->userdata('UserRestrictions')['releasing_scan_add_stock']) return; ?>
<style type="text/css">
  .scanner-area video, canvas {
    width: 100% !important;
    height: auto;
  }

  .scanner-area video.drawingBuffer, canvas.drawingBuffer {
    display: none;
  }
  .img-product
  {
    max-width: 90%;
  }
</style>
<div class="modal fade" id="modal_scan_releasing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-upc-scan" style="font-size: 20px; margin-right: 5px;"></i> Scan Barcode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ajx_res_prompt">

        </div>
        <div class="col-12 col-sm-12 col-md-7 col-lg-7 m-auto scanner-area" id="scanner_area">
        </div>
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
        <!-- <button id="" type="button" class="btn btn-primary"><i class="bi bi-plus"></i> Add to cart</button> -->
      </div>
    </div>
  </div>
</div>