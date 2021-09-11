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
		$this->db->where('ID', $OrderID);
		$this->db->set(array(
			'Status' => $Status,
		));
		$result = $this->db->update('purchase_orders');
		return $result;
	}
	public function UpdateTransaction($data)
	{
		extract($data);
		$this->db->where('ID', $transactionID);
		$this->db->set(array(
			'PurchaseOrderID' => $OrderID,
		));
		$result = $this->db->update('products_transactions');
		return $result;
	}
	public function RemoveOrderTransaction($data)
	{
		extract($data);
		$this->db->set(array(
			'PurchaseOrderID' => NULL,
			'Status' => '0',
			'Date_Approval' => NULL,
		));
		$this->db->where('TransactionID', $TransactionID);
		$result = $this->db->update('products_transactions');
		return $result;
	}
}
