<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Updates extends CI_Model {

	public function UpdateUser($data, $userID)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->update('users', $data);
		return $result;
	}
	public function UpdateUserLogin($data, $userID)
	{
		$checkIfUserIDExists = $this->Model_Selects->GetUserID($userID, 'users_login');
		if ($checkIfUserIDExists->num_rows() > 0) {
			$this->db->where('UserID', $userID);
			$result = $this->db->update('users_login', $data);
			return $result;
		} else {
			$data['UserID'] = $userID;
			$result = $this->db->insert('users_login', $data);
			return $result;
		}
	}
	public function UpdateUserRestrictions($userID, $data)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->update('user_restrictions', $data);
		return $result;
	}

	public function UpdateStocksCount($code, $inStock)
	{
		$this->db->where('Code', $code);
		$this->db->set('InStock', $inStock);
		$result = $this->db->update('products');
		return $result;
	}
	public function UpdateStock_product($data)
	{
		extract($data);
		$this->db->where('Code', $Code);
		$this->db->set(array(
			'InStock' => $InStock,
			'Released' => $Released,
		));
		$result = $this->db->update('products');
		return $result;
	}
	
	public function ApproveTransaction($data)
	{
		extract($data);
		$this->db->set(array(
			'Status' => $Status,
			'Date_Approval' => $Date_Approval,
		));
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->update('products_transactions');
		return $result;
	}

	// PURCHASE ORDERS
	public function UpdatePurchaseOrderByOrderNo($orderNo, $data)
	{
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->update('purchase_orders', $data);
		return $result;
	}
	// SALES ORDERS
	public function UpdateSalesOrderByOrderNo($orderNo, $data)
	{
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->update('sales_orders', $data);
		return $result;
	}
	// RETURNS
	public function UpdateReturnProduct($data)
	{
		extract($data);
		$this->db->where('transactionid', $transactionID);
		$this->db->set(array(
			'remarks' => $remarks,
		));
		$result = $this->db->update('product_returned');
		return $result;
	}
	// public function ReturnProductInventory($data)
	// {
	// 	extract($data);
	// 	$this->db->set(array(
	// 		'quantity' => $newQty,
	// 		'quantity_total' => $newTotal,
	// 		'returned' => $returned,
	// 	));
	// 	$this->db->where('TransactionID', $transactionID);
	// 	$result = $this->db->update('product_returned');
	// 	return $result;
	// }
	public function UpdateAdtlFee($data, $adtlFeeNo)
	{
		$this->db->where('AdtlFeeNo', $adtlFeeNo);
		$result = $this->db->update('adtl_fees', $data);
		return $result;
	}
	// REPLACEMENTS
	public function UpdateReplacement($data, $replacementID)
	{
		$this->db->where('ID', $replacementID);
		$result = $this->db->update('replacements', $data);
		return $result;
	}
	public function UpdateReplacementByNo($data, $replacementNo)
	{
		$this->db->where('ReplacementNo', $replacementNo);
		$result = $this->db->update('replacements', $data);
		return $result;
	}
	// ORDER / TRANSACTIONS
	public function UpdateTransaction($data)
	{
		extract($data);
		$this->db->where('ID', $transactionID);
		$this->db->set(array(
			'OrderNo' => $OrderNo,
		));
		$result = $this->db->update('products_transactions');
		return $result;
	}
	public function RemoveOrderTransaction($data)
	{
		extract($data);
		$this->db->set(array(
			'OrderNo' => NULL,
			'Status' => '0',
			'Date_Approval' => NULL,
		));
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->update('products_transactions');
		return $result;
	}
	public function RejectOrderTransaction($data)
	{
		extract($data);
		$this->db->set(array(
			'Status' => '2',
			'Date_Approval' => NULL,
		));
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->update('products_transactions');
		return $result;
	}

	// VENDORS
	public function UpdateVendor($data, $vendorID)
	{
		$this->db->where('ID', $vendorID);
		$result = $this->db->update('vendors', $data);
		return $result;
	}
	public function UpdateVendorByNo($data, $vendorNo)
	{
		$this->db->where('VendorNo', $vendorNo);
		$result = $this->db->update('vendors', $data);
		return $result;
	}
	public function Remove_vendor($ID)
	{
		$this->db->where('ID', $ID);
		$data = array(
			'Status' => '0'
		);
		$result = $this->db->update('vendors', $data);
		return $result;
	}
	// CLIENTS
	public function UpdateClient($data, $clientID)
	{
		$this->db->where('ID', $clientID);
		$result = $this->db->update('clients', $data);
		return $result;
	}
	public function UpdateClientByNo($data, $clientNo)
	{
		$this->db->where('ClientNo', $clientNo);
		$result = $this->db->update('clients', $data);
		return $result;
	}
	public function Remove_client($ID)
	{
		$this->db->where('ID', $ID);
		$data = array(
			'Status' => '0'
		);
		$result = $this->db->update('clients', $data);
		return $result;
	}

	public function UpdateBill($id,$data)
	{
		$this->db->where('ID', $id);
		$result = $this->db->update('bills', $data);
		return $result;
	}
	public function remove_bill($billNo)
	{
		$this->db->where('BillNo', $billNo);
		$data = array(
			'Status' => '0'
		);
		$result = $this->db->update('bills', $data);
		return $result;
	}
	public function remove_invoice($invoiceNo)
	{
		$this->db->where('InvoiceNo', $invoiceNo);
		$data = array(
			'Status' => '0'
		);
		$result = $this->db->update('invoices', $data);
		return $result;
	}
	public function UpdateAccount($data, $accountID)
	{
		$this->db->where('ID', $accountID);
		$result = $this->db->update('accounts', $data);
		return $result;
	}

	public function remove_itemCode($uniqueID)
	{
		$this->db->where('uniqueID', $uniqueID);
		$result = $this->db->delete('tb_itemcode');
		return $result;
	}
	public function UpdateStock_fromCart($nCode,$newStock)
	{

		$this->db->set('InStock', $newStock);
		$this->db->where('Code', $nCode);
		$result = $this->db->update('products');
		return $result;
	}
	public function Update_releasedata($updata)
	{
		extract($updata);
		$this->db->where('Code', $Code);
	   $this->db->update('products', array('InStock' => $InStock));
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateReleasedata($Code,$Released)
	{
		$this->db->where('Code', $Code);
	   $this->db->update('products', array('Released' => $Released));
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Update_CartRelease($cart_id)
	{
		$this->db->where('cart_id', $cart_id);
	   $this->db->update('cart_release', array('status' => 1));
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function MoveProd_toarchive($Code)
	{
		$this->db->where('Code', $Code);
	   $this->db->update('products', array('Status' => 2));
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Update_BrandCat($UniqueID,$data)
	{
		$this->db->where('UniqueID', $UniqueID);
	   $this->db->update('brand_category', $data);
	   return true;
	}
	public function Update_BrandProperty($UniqueID,$data)
	{
		$this->db->where('UniqueID', $UniqueID);
	   $this->db->update('brand_properties', $data);
	   return true;
	}
	public function UpdateStatus_Retrived($ID)
	{
		$this->db->where('ID', $ID);
	   $this->db->update('products',array('Status' => 1, ));
	   return true;
	}
	public function UpdatePriceProduct($ID,$data)
	{
		$this->db->where('ID', $ID);
	   $this->db->update('products',$data);
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function prd_update_stocks($U_ID,$Code,$data)
	{
		$this->db->where('U_ID', $U_ID);
		$this->db->where('Code', $Code);
	   $this->db->update('products',$data);
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function cart_update_status($Cart_ID,$status)
	{
		$this->db->where('id', $Cart_ID);
	   $this->db->update('cart_restocking',array('status' => $status, ));
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateProduct_stock($id,$data)
	{
		$this->db->where('ID', $id);
	   $this->db->update('product_stocks',$data);
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateTotalStocks($ID,$New_stock,$New_Released)
	{
		$data = array(
			'InStock' => $New_stock,
			'Released' => $New_Released,
		);
		$this->db->where('ID', $ID);
	   $this->db->update('products',$data);
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Update_Stock_In_Product($data)
	{
		extract($data);
		$data = array(
			'InStock' => $InStock,
		);
		$this->db->where('U_ID', $U_ID);
		$this->db->where('Code', $Code);
	   $this->db->update('products',$data);
	}
	public function Update_Stock_Details($data_where,$data)
	{
		extract($data_where);

		$this->db->where('ID', $ID);
	   $this->db->update('product_stocks',$data);
	   if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	// stock history
	public function UpdateStockHistory($id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update('sales_history',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateStockHistoryReleasedTransactionID($tid,$data)
	{
		$this->db->where('transactionid', $tid);
		$this->db->where('status', 'released');
		$this->db->update('sales_history',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateStockHistoryDiscountTransactionID($tid,$data)
	{
		$this->db->where('transactionid', $tid);
		$this->db->where('status', 'discount');
		$this->db->update('sales_history',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function UpdateStockHistoryCostPriceByStockID($stockid)
	{
		$this->db->where('stockid', $stockid);
		$sql = 'UPDATE
				    sales_history SH,
				    product_stocks PS
				SET
				    SH.cost = PS.Price_PerItem,
				    SH.total_cost = PS.Price_PerItem * SH.quantity,
				    SH.price = PS.Retail_Price,
				    SH.total_price = PS.Retail_Price * SH.quantity
				WHERE
				    SH.stockid = PS.ID;';
		$this->db->query($sql);
	}


	public function UpdateStockReleaseRevert($stockid,$amount)
	{
		$sql = "UPDATE `product_stocks` 
				SET `Current_Stocks` = (CAST((SELECT Current_Stocks FROM product_stocks WHERE ID = '$stockid') AS int) + CAST('$amount' AS int)), 
					`Released_Stocks` = (CAST((SELECT Released_Stocks FROM product_stocks WHERE ID = '$stockid') AS int) - CAST('$amount' AS int)) 
				WHERE `ID` = '$stockid';";
		$this->db->query($sql);
	}
	public function UpdateProductReleaseRevert($code,$amount)
	{
		$sql = "UPDATE `products` 
				SET `InStock` = (CAST((SELECT InStock FROM products WHERE Code = '$code') AS int) + CAST('$amount' AS int)), 
					`Released` = (CAST((SELECT Released FROM products WHERE Code = '$code') AS int) + CAST('$amount' AS int)) 
				WHERE `Code`='$code';";
		$this->db->query($sql);
	}

	// RELEASES TABLES
	public function Update_Release_Details($id,$data)
	{
		$this->db->where('ID', $id);
		$this->db->update('releases',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}



	// UPDATE SO TRANSACTION QTY
	public function UpdateProductTransaction($id,$data)
	{
		$this->db->where('ID', $id);
		$this->db->update('products_transactions',$data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
