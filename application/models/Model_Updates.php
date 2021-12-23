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
	public function UpdateUserRestriction($userID, $action, $data)
	{
		$this->db->where(array('UserID'=> $userID, 'Action' => $action));
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
	public function UpdatePurchaseOrder($data)
	{
		extract($data);
		$this->db->where('OrderNo', $OrderNo);
		$this->db->set(array(
			'Status' => $Status,
		));
		$result = $this->db->update('purchase_orders');
		return $result;
	}
	// SALES ORDERS
	public function UpdateSalesOrder($data)
	{
		extract($data);
		$this->db->where('OrderNo', $OrderNo);
		$this->db->set(array(
			'Status' => $Status,
		));
		$result = $this->db->update('sales_orders');
		return $result;
	}
	public function UpdateSalesOrderByOrderNo($orderNo, $data)
	{
		$this->db->where('OrderNo', $orderNo);
		$result = $this->db->update('sales_orders', $data);
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
			'Status' => '0',
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
	// CLIENTS
	public function UpdateClient($data, $clientID)
	{
		$this->db->where('ID', $clientID);
		$result = $this->db->update('clients', $data);
		return $result;
	}
	public function remove_bill($billNo)
	{
		$this->db->where('BillNo', $billNo);
		$result = $this->db->delete('bills');
		return $result;
	}
	public function remove_invoice($invoiceNo)
	{
		$this->db->where('InvoiceNo', $invoiceNo);
		$result = $this->db->delete('invoices');
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
	
}
