<div class="modal fade" id="release_cart_modals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> Cart</h4>
        <a id="Release_modalclose" href="#">
          <i class="bi bi-x" style="font-size: 24px;"></i>
        </a>
      </div>
      <div class="modal-body">
        <?php if ($cart_releasing->num_rows() > 0) { ?>
          <?php foreach ($cart_releasing->result_array() as $row) { ?>
            <div class="row mt-2 mb-4 ml-2 mr-2">
              <div class="col-12">

                <h6><?php echo $row['item_code']; ?></h6>
              </div>
              <div class="col-5">
                Quantity : <?php echo $row['quantity']; ?>
              </div>
              <div class="col-7">
                Total Price : <?php echo $row['total_price']; ?>
              </div>
              <div class="col-12">
                <?php echo $row['time_stamp']; ?>
              </div>
              <div class="col-12 mb-2">
                <a href="<?=base_url()?>removeFCartrelease?c_id=<?php echo $row['cart_id']; ?>"> Cancel </a>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col-12 text-center m-2">
            <h6>Cart is empty.</h6>
          </div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <a href="<?=base_url();?>admin/release_fromcart" class="btn btn-primary">Release</a>
      </div>
    </div>
  </div>
</div>