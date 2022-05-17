<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Exporting extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
	}
	public function xlsSalesOrder() {
		$filename = $this->input->post('filename');
		$orderNo = $this->input->post('order_no');
		$preparedBy = $this->input->post('prepared_by');

		$getSalesOrderByOrderNo = $this->Model_Selects->GetSalesOrderByNo($orderNo);
		$salesOrder = $getSalesOrderByOrderNo->row_array();
		$getTransactionsByOrderNo = $this->Model_Selects->GetTransactionsByOrderNo($orderNo);
		$clientBTDetails = $this->Model_Selects->GetClientByNo($salesOrder['BillToClientNo'])->row_array();
		$clientSTDetails = $this->Model_Selects->GetClientByNo($salesOrder['ShipToClientNo'])->row_array();

		// $transactions = $this->input->post('transactions');

		$regularTransactions = $this->input->post('regularTransaction');
		$adtlTransactions = $this->input->post('adtlTransaction');

		$spreadsheet = new Spreadsheet(); 
		$sheet = $spreadsheet->getActiveSheet();

		// IMAGE
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setPath('./assets/images/manalok9_logo.png');
		$drawing->setCoordinates('A1');
		$drawing->setWorksheet($sheet);

		// TITLE
		$sheet->setCellValue('D1', 'Sales Order Form');
		$sheet->setCellValue('D2', 'Customer SO#:');
		$sheet->setCellValue('E2', $salesOrder['OrderNo']);
		$sheet->setCellValue('D3', 'Order Date:');
		$sheet->setCellValue('E3', date('Y-m-d', strtotime($salesOrder['DateCreation'])));

		// SHIP TO / BILL TO
		$sheet->setCellValue('A4', 'BILL TO:');
		$sheet->setCellValue('A5', $clientBTDetails['Name']);
		$sheet->setCellValue('A6', $clientBTDetails['Address']);
		$sheet->setCellValue('A7', $clientBTDetails['CityStateProvinceZip']);
		$sheet->setCellValue('A8', $clientBTDetails['Country']);
		$sheet->setCellValue('A9', $clientBTDetails['ContactNum']);

		$sheet->setCellValue('D4', 'SHIP TO:');
		$sheet->setCellValue('D5', $clientSTDetails['Name']);
		$sheet->setCellValue('D6', $clientSTDetails['Address']);
		$sheet->setCellValue('D7', $clientSTDetails['CityStateProvinceZip']);
		$sheet->setCellValue('D8', $clientSTDetails['Country']);
		$sheet->setCellValue('D9', $clientSTDetails['ContactNum']);

		// PRODUCTS
		$sheet->setCellValue('A4', 'Bill To:');
		$sheet->setCellValue('D4', 'Ship To:');
		$sheet->setCellValue('A11', 'QTY');
		$sheet->setCellValue('B11', 'DESCRIPTION');
		$sheet->setCellValue('D11', 'UNIT PRICE');
		$sheet->setCellValue('E11', 'TOTAL');

		// $sr = $sheet->getHighestRow();
		// $amountTotal = 0;
		// if ($transactions != NULL && sizeof($transactions) > 0) {
		// 	foreach ($transactions as $id) {

		// 		$transaction = $this->Model_Selects->GetProductTransactionByID($id);
		// 		if ($transaction->num_rows() > 0) {
		// 			$t = $transaction->row_array();
		// 			$product = $this->Model_Selects->GetProductByCode($t['Code']);
		// 			$pDescription = '';
		// 			if ($product->num_rows() > 0) {
		// 				$pDescription = $product->row_array()['Description'];
		// 			}
		// 			$amount = $t['Amount'] * $t['PriceUnit'];
		// 			$amountTotal += $amount;

		// 			$sr += 1;
		// 			$sheet->insertNewRowBefore($sr);
		// 			$sheet->mergeCells('B'. $sr .':C'. $sr);
		// 			$sheet->mergeCells('E'. $sr .':F'. $sr);
		// 			$sheet->getStyle('D'. $sr .':E'. $sr)->getNumberFormat()->setFormatCode('#,##0.00');

		// 			$sheet->setCellValue('A'. $sr, $t['Amount']);
		// 			$sheet->setCellValue('B'. $sr, $pDescription);
		// 			$sheet->setCellValue('D'. $sr, $t['PriceUnit']);
		// 			$sheet->setCellValue('E'. $sr, $amount);
		// 		}
		// 	}
		// }

		// $sr += 1;

		$allTransactions = array();
		if ($regularTransactions != NULL && sizeof($regularTransactions) > 0) {
			foreach ($regularTransactions as $val) {
				$tID = $val;

				$transaction = $this->Model_Selects->GetProductTransactionByID($tID);
				if ($transaction->num_rows() > 0) {
					$t = $transaction->row_array();
					$product = $this->Model_Selects->GetProductByCode($t['Code']);
					$pDescription = '';
					if ($product->num_rows() > 0) {
						$pDescription = $product->row_array()['Product_Name'];
					}

					if ($t['Freebie'] == 1) {
						$priceDiscounted = 0;
					} else {
						$priceDiscount = $t['PriceUnit'] * ($t['UnitDiscount'] / 100);
						$priceDiscounted = $t['PriceUnit'] - $priceDiscount;
					}

					$row = array(
						'Qty' => $t['Amount'],
						'Description' => $pDescription,
						'UnitPrice' => $priceDiscounted,
						'Total' => $t['Amount'] * $priceDiscounted
					);
					array_push($allTransactions, $row);
				}
			}
		}
		if ($adtlTransactions != NULL && sizeof($adtlTransactions) > 0) {
			foreach ($adtlTransactions as $val) {
				$tID = $val;

				$transaction = $this->Model_Selects->GetAdtlFeesByID($tID);
				if ($transaction->num_rows() > 0) {
					$t = $transaction->row_array();

					$priceDiscount = $t['UnitPrice'] * ($t['UnitDiscount'] / 100);
					$priceDiscounted = $t['UnitPrice'] - $priceDiscount;

					$row = array(
						'Qty' => $t['Qty'],
						'Description' => $t['Description'],
						'UnitPrice' => $priceDiscounted,
						'Total' => $t['Qty'] * $priceDiscounted
					);
					array_push($allTransactions, $row);
				}
			}
		}

		$sr = $sheet->getHighestRow();
		$amountTotal = 0;
		if (sizeof($allTransactions) > 0) {
			foreach ($allTransactions as $row) {
				$amountTotal += $row['Total'];

				$sr += 1;
				$sheet->insertNewRowBefore($sr);
				$sheet->mergeCells('B'. $sr .':C'. $sr);
				$sheet->mergeCells('E'. $sr .':F'. $sr);
				$sheet->getStyle('D'. $sr .':E'. $sr)->getNumberFormat()->setFormatCode('#,##0.00');

				$sheet->setCellValue('A'. $sr, $row['Qty']);
				$sheet->setCellValue('B'. $sr, $row['Description']);
				$sheet->setCellValue('D'. $sr, $row['UnitPrice']);
				$sheet->setCellValue('E'. $sr, $row['Total']);
			}
		} else {
			exit();
		}

		$sr += 1;

		$accountCategories = array('CONFIRMED DISTRIBUTOR', 'DISTRIBUTOR ON PROBATION', 'DIRECT DEALER', 'DIRECT END USER');
		$discountOutright = $amountTotal * ($salesOrder['discountOutright'] * 0.01);
		$discountVolume = $amountTotal * ($salesOrder['discountVolume'] * 0.01);
		$discountPBD = $amountTotal * ($salesOrder['discountPBD'] * 0.01);
		$discountManpower = $amountTotal * ($salesOrder['discountManpower'] * 0.01);

		$total = $amountTotal - ($discountOutright + $discountVolume + $discountPBD + $discountManpower);

		// BELOW PRODUCTS
		$sheet->setCellValue('A'. $sr, 'CATEGORY OF ACCOUNT:');
		$sheet->setCellValue('A'. ($sr + 2), $accountCategories[$clientBTDetails['Category']]);
		$sheet->setCellValue('C'. $sr, 'SUB-TOTAL PHP');
		$sheet->setCellValue('E'. $sr, $amountTotal);

		$sheet->setCellValue('C'. ($sr + 1), 'Outright Discount ('. $salesOrder['discountOutright'] .'%)');
		$sheet->setCellValue('E'. ($sr + 1), number_format($discountOutright, 2));
		$sheet->setCellValue('C'. ($sr + 2), 'Volume Discount ('. $salesOrder['discountVolume'] .'%)');
		$sheet->setCellValue('E'. ($sr + 2), number_format($discountVolume, 2));
		$sheet->setCellValue('C'. ($sr + 3), 'PBD Discount ('. $salesOrder['discountPBD'] .'%)');
		$sheet->setCellValue('E'. ($sr + 3), number_format($discountPBD, 2));

		$sheet->setCellValue('A'. ($sr + 4), 'REMARKS');
		$sheet->setCellValue('B'. ($sr + 4), $salesOrder['Remarks']);
		$sheet->setCellValue('C'. ($sr + 4), 'Manpower Discount ('. $salesOrder['discountManpower'] .'%)');
		$sheet->setCellValue('E'. ($sr + 4), number_format($discountManpower, 2));

		$sheet->setCellValue('A'. ($sr + 5), 'PREPARED BY');
		$sheet->setCellValue('B'. ($sr + 5), $preparedBy);
		$sheet->setCellValue('D'. ($sr + 5), 'TOTAL');
		$sheet->setCellValue('E'. ($sr + 5), $total);

		// CELL MERGE
		$sheet->mergeCells('A1:C3');
		$sheet->mergeCells('D1:F1');
		$sheet->mergeCells('E2:F2');
		$sheet->mergeCells('E3:F3');

		$sheet->mergeCells('A4:C4');
		$sheet->mergeCells('A5:C5');
		$sheet->mergeCells('A6:C6');
		$sheet->mergeCells('A7:C7');
		$sheet->mergeCells('A8:C8');
		$sheet->mergeCells('A9:C9');

		$sheet->mergeCells('D4:F4');
		$sheet->mergeCells('D5:F5');
		$sheet->mergeCells('D6:F6');
		$sheet->mergeCells('D7:F7');
		$sheet->mergeCells('D8:F8');
		$sheet->mergeCells('D9:F9');
		$sheet->mergeCells('A10:F10');

		$sheet->mergeCells('B11:C11');
		$sheet->mergeCells('E11:F11');
		$sheet->mergeCells('A'. $sr .':B'. ($sr + 1));
		$sheet->mergeCells('A'. ($sr + 2) .':B'. ($sr + 3));

		$sheet->mergeCells('C'. $sr .':D'. $sr);
		$sheet->mergeCells('C'. ($sr + 1) .':D'. ($sr + 1));
		$sheet->mergeCells('C'. ($sr + 2) .':D'. ($sr + 2));
		$sheet->mergeCells('C'. ($sr + 3) .':D'. ($sr + 3));
		$sheet->mergeCells('C'. ($sr + 4) .':D'. ($sr + 4));

		$sheet->mergeCells('E'. $sr .':F'. $sr);
		$sheet->mergeCells('E'. ($sr + 1) .':F'. ($sr + 1));
		$sheet->mergeCells('E'. ($sr + 2) .':F'. ($sr + 2));
		$sheet->mergeCells('E'. ($sr + 3) .':F'. ($sr + 3));
		$sheet->mergeCells('E'. ($sr + 4) .':F'. ($sr + 4));
		$sheet->mergeCells('B'. ($sr + 5) .':C'. ($sr + 5));
		$sheet->mergeCells('E'. ($sr + 5) .':F'. ($sr + 5));

		// NUMBER FORMAT
		$sheet->getStyle('E'. ($sr) .':E'. ($sr + 5))->getNumberFormat()->setFormatCode('#,##0.00');
		
		// STYLING
		$styleBold = array(
			'font' => array(
				'bold' => true,
			)
		);
		$sheet->getStyle('D1:D3')->applyFromArray($styleBold);
		$sheet->getStyle('A4:F4')->applyFromArray($styleBold);
		$sheet->getStyle('A11:F11')->applyFromArray($styleBold);
		$sheet->getStyle('C'. $sr .':C'. ($sr + 4))->applyFromArray($styleBold);
		$sheet->getStyle('D'. ($sr + 5))->applyFromArray($styleBold);
		$sheet->getStyle('A'. $sr)->applyFromArray($styleBold);
		$sheet->getStyle('A'. ($sr + 4))->applyFromArray($styleBold);
		$sheet->getStyle('A'. ($sr + 5))->applyFromArray($styleBold);

		$sheet->getStyle('A1:F'. ($sheet->getHighestRow()))
			->getBorders()
			->getAllBorders()
			->setBorderStyle(Border::BORDER_THIN)
			->setColor(new Color('00000000'));

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);

		$sheet->getRowDimension('1')->setRowHeight(40);
		$sheet->getRowDimension($sr + 5)->setRowHeight(30);

		if ($sheet->getColumnDimension('B')->getWidth() < 12) {
			$sheet->getColumnDimension('B')->setAutoSize(false);
			$sheet->getColumnDimension('B')->setWidth(12);
		}
		if ($sheet->getColumnDimension('C')->getWidth() < 12) {
			$sheet->getColumnDimension('C')->setWidth(12);
			$sheet->getColumnDimension('C')->setAutoSize(false);
		}

		$sheet->getStyle('A1:F'. ($sheet->getHighestRow()))
			->getAlignment()
			->setWrapText(true);

		####### Instantiate Xlsx
		$writer = new Xlsx($spreadsheet);

		####### Generate file
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	public function xlsPurchaseOrder() {
		$filename = $this->input->post('filename');
		$orderNo = $this->input->post('order_no');
		$deliverto = $this->input->post('deliverto');
		$page = $this->input->post('page');
		$attn = $this->input->post('attn');
		$supplierinvoiceno = $this->input->post('supplierinvoiceno');
		$terms = $this->input->post('terms');
		$memo = $this->input->post('memo');
		$freight = $this->input->post('freight');
		$salestax = $this->input->post('salestax');
		$lessdeposit = $this->input->post('lessdeposit');
		$balancedue = $this->input->post('balancedue');
		$preparedby = $this->input->post('preparedby');
		$orderedby = $this->input->post('orderedby');
		$approvedby = $this->input->post('approvedby');

		$regularTransactions = $this->input->post('regularTransaction');
		$manualTransactions = $this->input->post('manualTransaction');


		$getPurchaseOrderByOrderNo = $this->Model_Selects->GetPurchaseOrderByNo($orderNo);
		$purchaseOrder = $getPurchaseOrderByOrderNo->row_array();
		$vendorDetails = $this->Model_Selects->GetVendorByNo($purchaseOrder['VendorNo'])->row_array();


		$spreadsheet = new Spreadsheet(); 
		$sheet = $spreadsheet->getActiveSheet();

		// IMAGE
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setPath('./assets/images/manalok9_logo.png');
		$drawing->setCoordinates('A1');
		$drawing->setWorksheet($sheet);

		// TITLE
		$sheet->setCellValue('D1', 'Purchase Order Form');
		$sheet->setCellValue('D2', 'Customer PO#:');
		$sheet->setCellValue('E2', $purchaseOrder['OrderNo']);
		$sheet->setCellValue('D3', 'Order Date:');
		$sheet->setCellValue('E3', date('Y-m-d', strtotime($purchaseOrder['DateCreation'])));
		$sheet->setCellValue('D4', 'Page:');
		$sheet->setCellValue('E4', $page);

		// ORDER DETAILS
		$sheet->setCellValue('A2', 'ORDER FROM:');
		$sheet->setCellValue('A3', $vendorDetails['VendorNo']);
		$sheet->setCellValue('A4', $vendorDetails['Name']);
		$sheet->setCellValue('A5', $vendorDetails['TIN']);
		$sheet->setCellValue('A6', $vendorDetails['Address']);
		$sheet->setCellValue('A7', $vendorDetails['ContactNum']);

		$sheet->setCellValue('C2', 'DELIVER TO:');
		$sheet->setCellValue('C3', $deliverto);

		$sheet->setCellValue('A8', 'ATTN:');
		$sheet->setCellValue('B8', $attn);

		$sheet->setCellValue('A9', 'SHIP VIA:');
		$sheet->setCellValue('A10', $purchaseOrder['ShipVia']);
		$sheet->setCellValue('C9', 'DELIVERY DATE:');
		$sheet->setCellValue('C10', $purchaseOrder['DateDelivery']);
		$sheet->setCellValue('D9', 'SUPPLIER INVOICE NO.:');
		$sheet->setCellValue('D10', $supplierinvoiceno);
		$sheet->setCellValue('F9', 'TERMS:');
		$sheet->setCellValue('F10', $terms);

		// PRODUCTS
		$sheet->setCellValue('A12', 'QTY');
		$sheet->setCellValue('B12', 'ITEM NO.');
		$sheet->setCellValue('C12', 'DESCRIPTION');
		$sheet->setCellValue('D12', 'UNIT COST');
		$sheet->setCellValue('E12', 'UNIT');
		$sheet->setCellValue('F12', 'AMOUNT');


		$allTransactions = array();
		if ($regularTransactions != NULL && sizeof($regularTransactions) > 0) {
			foreach ($regularTransactions as $val) {
				$tID = substr($val, 0, (strpos($val, '_')));
				$tUnit = substr($val, (strpos($val, '_') + 1));

				$transaction = $this->Model_Selects->GetProductTransactionByID($tID);
				if ($transaction->num_rows() > 0) {
					$t = $transaction->row_array();
					$product = $this->Model_Selects->GetProductByCode($t['Code']);
					$pDescription = '';
					if ($product->num_rows() > 0) {
						$pDescription = $product->row_array()['Product_Name'];
					}

					$row = array(
						'Qty' => $t['Amount'],
						'ItemNo' => $t['Code'],
						'Description' => $pDescription,
						'UnitCost' => $t['PriceUnit'],
						'Unit' => $tUnit,
						'Total' => $t['Amount'] * $t['PriceUnit']
					);
					array_push($allTransactions, $row);
				}
			}
		}
		if ($manualTransactions != NULL && sizeof($manualTransactions) > 0) {
			foreach ($manualTransactions as $val) {
				$tID = substr($val, 0, (strpos($val, '_')));
				$tUnit = substr($val, (strpos($val, '_') + 1));

				$transaction = $this->Model_Selects->GetManualTransactionByID($tID);
				if ($transaction->num_rows() > 0) {
					$t = $transaction->row_array();

					$row = array(
						'Qty' => $t['Qty'],
						'ItemNo' => $t['ItemNo'],
						'Description' => $t['Description'],
						'UnitCost' => $t['UnitCost'],
						'Unit' => $tUnit,
						'Total' => $t['Qty'] * $t['UnitCost']
					);
					array_push($allTransactions, $row);
				}
			}
		}

		$sr = $sheet->getHighestRow();
		$amountTotal = 0;
		if (sizeof($allTransactions) > 0) {
			foreach ($allTransactions as $row) {
				$amountTotal += $row['Total'];

				$sr += 1;
				$sheet->insertNewRowBefore($sr);
				$sheet->getStyle('D'. $sr)->getNumberFormat()->setFormatCode('#,##0.00');
				$sheet->getStyle('F'. $sr)->getNumberFormat()->setFormatCode('#,##0.00');

				$sheet->setCellValue('A'. $sr, $row['Qty']);
				$sheet->setCellValue('B'. $sr, $row['ItemNo']);
				$sheet->setCellValue('C'. $sr, $row['Description']);
				$sheet->setCellValue('D'. $sr, $row['UnitCost']);
				$sheet->setCellValue('E'. $sr, $row['Unit']);
				$sheet->setCellValue('F'. $sr, $row['Total']);
			}
		} else {
			exit();
		}

		$sr += 1;

		// BELOW PRODUCTS
		$sheet->setCellValue('A'. $sr, 'MEMO:');
		$sheet->setCellValue('B'. $sr, $memo);
		$sheet->setCellValue('D'. $sr, 'TOTAL AMOUNT');
		$sheet->setCellValue('F'. $sr, $amountTotal);
		$sheet->setCellValue('D'. ($sr + 1), 'FREIGHT');
		$sheet->setCellValue('F'. ($sr + 1), $freight);
		$sheet->setCellValue('D'. ($sr + 2), 'SALES TAX');
		$sheet->setCellValue('F'. ($sr + 2), $salestax);
		$sheet->setCellValue('D'. ($sr + 3), 'LESS DEPOSIT');
		$sheet->setCellValue('F'. ($sr + 3), $lessdeposit);
		$sheet->setCellValue('D'. ($sr + 4), 'BALANCE DUE');
		$sheet->setCellValue('F'. ($sr + 4), $balancedue);

		$sheet->setCellValue('A'. ($sr + 5), 'REMARKS');
		$sheet->setCellValue('C'. ($sr + 5), $purchaseOrder['Remarks']);

		$sheet->setCellValue('A'. ($sr + 6), 'PREPARED BY');
		$sheet->setCellValue('A'. ($sr + 7), $preparedby);
		$sheet->setCellValue('C'. ($sr + 6), 'ORDERED BY');
		$sheet->setCellValue('C'. ($sr + 7), $orderedby);
		$sheet->setCellValue('E'. ($sr + 6), 'APPROVED BY');
		$sheet->setCellValue('E'. ($sr + 7), $approvedby);

		// CELL MERGE
		$sheet->mergeCells('A1:C1');
		$sheet->mergeCells('D1:F1');
		$sheet->mergeCells('A2:B2');
		$sheet->mergeCells('A3:B3');
		$sheet->mergeCells('A4:B4');
		$sheet->mergeCells('A5:B5');
		$sheet->mergeCells('A6:B6');
		$sheet->mergeCells('A7:B7');

		$sheet->mergeCells('C3:C7');
		$sheet->mergeCells('E2:F2');
		$sheet->mergeCells('E3:F3');
		$sheet->mergeCells('E4:F4');
		$sheet->mergeCells('D5:F7');
		$sheet->mergeCells('B8:F8');

		$sheet->mergeCells('A9:B9');
		$sheet->mergeCells('D9:E9');
		$sheet->mergeCells('A10:B10');
		$sheet->mergeCells('D10:E10');
		$sheet->mergeCells('A11:F11');

		$sheet->mergeCells('A'. $sr .':A'. ($sr + 4));
		$sheet->mergeCells('B'. $sr .':C'. ($sr + 4));
		$sheet->mergeCells('D'. ($sr) .':E'. ($sr));
		$sheet->mergeCells('D'. ($sr + 1) .':E'. ($sr + 1));
		$sheet->mergeCells('D'. ($sr + 2) .':E'. ($sr + 2));
		$sheet->mergeCells('D'. ($sr + 3) .':E'. ($sr + 3));
		$sheet->mergeCells('D'. ($sr + 4) .':E'. ($sr + 4));

		$sheet->mergeCells('A'. ($sr + 5) .':B'. ($sr + 5));
		$sheet->mergeCells('C'. ($sr + 5) .':F'. ($sr + 5));

		$sheet->mergeCells('A'. ($sr + 6) .':B'. ($sr + 6));
		$sheet->mergeCells('A'. ($sr + 7) .':B'. ($sr + 7));
		$sheet->mergeCells('C'. ($sr + 6) .':D'. ($sr + 6));
		$sheet->mergeCells('C'. ($sr + 7) .':D'. ($sr + 7));
		$sheet->mergeCells('E'. ($sr + 6) .':F'. ($sr + 6));
		$sheet->mergeCells('E'. ($sr + 7) .':F'. ($sr + 7));

		// NUMBER FORMAT
		$sheet->getStyle('F'. ($sr) .':F'. ($sr + 4))->getNumberFormat()->setFormatCode('#,##0.00');
		
		// STYLING
		$styleBold = array(
			'font' => array(
				'bold' => true,
			)
		);
		$sheet->getStyle('D1:D4')->applyFromArray($styleBold);
		$sheet->getStyle('A2:C2')->applyFromArray($styleBold);
		$sheet->getStyle('A8')->applyFromArray($styleBold);
		$sheet->getStyle('A9:F9')->applyFromArray($styleBold);
		$sheet->getStyle('A12:F12')->applyFromArray($styleBold);
		$sheet->getStyle('A2:C2')->applyFromArray($styleBold);
		$sheet->getStyle('A2:C2')->applyFromArray($styleBold);
		$sheet->getStyle('A'. $sr)->applyFromArray($styleBold);
		$sheet->getStyle('D'. ($sr) .':D'. ($sr + 4))->applyFromArray($styleBold);
		$sheet->getStyle('A'. ($sr + 5) .':B'. ($sr + 5))->applyFromArray($styleBold);
		$sheet->getStyle('A'. ($sr + 6) .':F'. ($sr + 6))->applyFromArray($styleBold);

		$sheet->getStyle('A1:F'. ($sheet->getHighestRow()))
			->getBorders()
			->getAllBorders()
			->setBorderStyle(Border::BORDER_THIN)
			->setColor(new Color('00000000'));

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);

		$sheet->getRowDimension('1')->setRowHeight(70);
		$sheet->getRowDimension('9')->setRowHeight(30);

		$sheet->getStyle('A1:F'. ($sheet->getHighestRow()))
			->getAlignment()
			->setWrapText(true);

	
		####### Instantiate Xlsx
		$writer = new Xlsx($spreadsheet);

		####### Generate file
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
}