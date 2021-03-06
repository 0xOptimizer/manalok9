<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Deletes extends CI_Model {

	public function RemoveVariantBrand($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('brand_vcpd');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function remove_size_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('brand_size');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_product($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('products');
		return $result;
	}
	public function deletePrd_details($skuCode)
	{
		$this->db->where('item_code', $skuCode);
		$result = $this->db->delete('product_details');
		return $result;
	}
	public function deletePrd_trans($skuCode)
	{
		$this->db->where('Code', $skuCode);
		$result = $this->db->delete('products_transactions');
		return $result;
	}

	public function remove_brands($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_category');
		return $result;
	}
	public function remove_brandsprop($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_properties');
		return $result;
	}
	public function remove_brandssize($UniqueID)
	{
		$this->db->where('UniqueID', $UniqueID);
		$result = $this->db->delete('brand_size');
		return $result;
	}
	public function RemoveCart_rel($cart_id)
	{
		$this->db->where('cart_id', $cart_id);
		$result = $this->db->delete('cart_release');
	}
	
	public function Delete_user_restriction($userID)
	{
		$this->db->where('UserID', $userID);
		$result = $this->db->delete('user_restrictions');
		return $result;
	}

	public function Delete_journal($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('journals');
		return $result;
	}
	public function Delete_journal_transaction($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('journal_transactions');
		return $result;
	}
	public function Delete_replacement($ID)
	{
		$this->db->where('ID', $ID);
		$result = $this->db->delete('replacements');
		return $result;
	}
	public function Delete_cartRestock_item($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('cart_restocking');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_Stock($id)
	{
		$this->db->where('ID', $id);
		$data = array(
			'Status' => '0'
		);
		$result = $this->db->update('product_stocks', $data);
		// $this->db->delete('product_stocks');
		// if ($this->db->affected_rows() > 0) {
		// 	return true;
		// }
		// else
		// {
		// 	return false;
		// }
	}
	public function Delete_StockHistory($transactionid)
	{
		$this->db->where('transactionid', $transactionid);
		$this->db->delete('sales_history');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_StockHistoryID($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('sales_history');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function Delete_Stock_Code($code)
	{
		$this->db->where('Product_SKU', $code);
		$this->db->delete('product_stocks');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function Delete_ReturnProduct($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('product_returned');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function Delete_AdtlFee($adtlFeeNo)
	{
		$this->db->where('AdtlFeeNo', $adtlFeeNo);
		$this->db->delete('adtl_fees');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_ManualTransaction($manualTransactionNo)
	{
		$this->db->where('ManualTransactionNo', $manualTransactionNo);
		$this->db->delete('manual_transactions');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}



	public function Delete_Transaction($transactionID)
	{
		$this->db->where('TransactionID', $transactionID);
		$this->db->delete('products_transactions');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_ReturnProductTID($transactionID)
	{
		$this->db->where('transactionid', $transactionID);
		$this->db->delete('product_returned');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}

	public function Delete_InvoiceON($orderNo)
	{
		$this->db->where('OrderNo', $orderNo);
		$this->db->delete('invoices');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_AdtlFeesON($orderNo)
	{
		$this->db->where('OrderNo', $orderNo);
		$this->db->delete('adtl_fees');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_ReplacementON($orderNo)
	{
		$this->db->where('OrderNo', $orderNo);
		$this->db->delete('replacements');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_ReturnON($orderNo)
	{
		$this->db->where('SalesOrderNo', $orderNo);
		$this->db->delete('returns');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	public function Delete_SalesOrderON($orderNo)
	{
		$this->db->where('OrderNo', $orderNo);
		$this->db->delete('sales_orders');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
	// RELEASES TABLE
	public function Delete_ReleaseID($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete('releases');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else
		{
			return false;
		}
	}
}
