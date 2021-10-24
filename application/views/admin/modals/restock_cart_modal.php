<div class="modal fade" id="restock_cart_modals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="margin: 0 auto;"><i class="bi bi-cart-fill" style="font-size: 24px;"></i> Cart</h4>
        <a id="Restockcart_modalclose" href="#">
          <i class="bi bi-x" style="font-size: 24px;"></i>
        </a>
      </div>
      <div class="modal-body">
        <div class="col-12">
            <table class="w-100">
              <thead>
                <tr>
                  <td>
                    Item Code
                  </td>
                  <td>
                    Qty
                  </td>
                </tr>
              </thead>
              <tbody id="carT_shop">
                <tr>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="clearcarts">
          
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?=base_url()?>admin/Restock_from_cart" class="btn btn-primary">Restock</a>
      </div>
    </div>
  </div>
</div>