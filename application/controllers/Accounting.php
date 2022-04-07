<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

	public $globalData = [];
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Model_Security');
		$this->load->model('Model_Selects');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Updates');
		$this->load->model('Model_Deletes');
		$this->load->model('Model_Logbook');
		if ($this->Model_Security->CheckPrivilegeLevel() >= 0) {
			$this->globalData['userID'] = 'N/A';
			if ($this->session->userdata('UserID')) {
				$this->globalData['userID'] = $this->session->userdata('UserID');
			}
			$this->globalData['fullName'] = 'N/A';
			if ($this->session->userdata('FullName')) {
				$this->globalData['fullName'] = $this->session->userdata('FullName');
			}
			$this->globalData['fisrtName'] = 'N/A';
			if ($this->session->userdata('FirstName')) {
				$this->globalData['firstName'] = $this->session->userdata('FirstName');
			}
			$this->globalData['middleName'] = 'N/A';
			if ($this->session->userdata('MiddleName')) {
				$this->globalData['middleName'] = $this->session->userdata('MiddleName');
			}
			$this->globalData['lastName'] = 'N/A';
			if ($this->session->userdata('LastName')) {
				$this->globalData['lastName'] = $this->session->userdata('LastName');
			}
			$this->globalData['nameExtension'] = 'N/A';
			if ($this->session->userdata('NameExtension')) {
				$this->globalData['nameExtension'] = $this->session->userdata('NameExtension');
			}
			$this->globalData['image'] = 'N/A';
			if ($this->session->userdata('Image')) {
				$this->globalData['image'] = $this->session->userdata('Image');
			}
		}
		if (!$this->Model_Security->CheckPrivilegeLevel()) {
			redirect();
		}
	}


// ############################ [ ACCOUNTING ] ############################
	public function accounts() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Accounts';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/accounts', $data);
		} else {
			redirect(base_url());
		}
	}
	public function trial_balance() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'trial_balance';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/trial_balance', $data);
		} else {
			redirect(base_url());
		}
	}
	public function income_statement() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'income_statement';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/income_statement', $data);
		} else {
			redirect(base_url());
		}
	}
	public function balance_sheet() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'balance_sheet';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/balance_sheet', $data);
		} else {
			redirect(base_url());
		}
	}
	public function cash_flow() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'cash_flow';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/cash_flow', $data);
		} else {
			redirect(base_url());
		}
	}

	public function FORM_addAccount()
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_add')) {
			$name = $this->input->post('name');
			$type = $this->input->post('type');
			$description = $this->input->post('description');

			// Insert
			$data = array(
				'Name' => $name,
				'Type' => $type,
				'Description' => $description,
			);
			$getAccountByName = $this->Model_Selects->GetAccountByName($name);
			if ($getAccountByName->num_rows() < 1) {
				$insertAccount = $this->Model_Inserts->InsertAccount($data);
				if ($insertAccount == TRUE) {
					$accountID = $this->db->insert_id();
					$this->session->set_flashdata('highlight-id', $accountID);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added new Account.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new account.', 'added a new account' . ($name ? ' ' . $name : '') . ' [ID: ' . $accountID . '].', base_url('admin/accounts'));
					redirect('admin/accounts');
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/accounts');
				}
			} else {
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Account with the same name already exists. ['. $name .']
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/accounts');
			}
		} else {
			redirect(base_url());
		}
	}
	public function FORM_updateAccount()
	{
		if ($this->Model_Security->CheckUserRestriction('accounts_edit')) {
			$id = $this->input->post('upd-id');
			$name = $this->input->post('upd-name');
			$type = $this->input->post('upd-type');
			$description = $this->input->post('upd-description');

			// Update
			$data = array(
				'Name' => $name,
				'Type' => $type,
				'Description' => $description,
			);
			$getAccountByName = $this->Model_Selects->GetAccountByName($name);
			$getAccountByID = $this->Model_Selects->GetAccountByID($id);
			$accountDetails = $getAccountByID->row_array();
			if (($getAccountByName->num_rows() < 1 || $accountDetails['Name'] == $name) && $getAccountByID->num_rows() > 0) {
				$UpdateAccount = $this->Model_Updates->UpdateAccount($data, $accountDetails['ID']);
				if ($UpdateAccount == TRUE) {
					$this->session->set_flashdata('highlight-id', $id);

					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Updated Account.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('updated account details.', 'updated account details' . ($name ? ' ' . $name : '') . ' [ID: ' . $id . '].', base_url('admin/accounts'));
					redirect('admin/accounts');
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
					redirect('admin/accounts');
				}
			} else {
				// $this->Model_Logbook->SetPrompts('error', 'error', 'Account with the same name already exists. ['. $name .']');
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> Account with the same name already exists. ['. $name .']
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect('admin/accounts');
			}
		} else {
			redirect(base_url());
		}
	}

// ############################ [ JOURNAL TRANSACTIONS ] ############################
	public function journals() // PAGE DISPLAY
	{
		if ($this->Model_Security->CheckUserRestriction('journal_transactions_view')) {
			$data = [];
			$data = array_merge($data, $this->globalData);
			$header['pageTitle'] = 'Journals';
			$data['globalHeader'] = $this->load->view('main/globals/header', $header);
			$this->load->view('admin/accounting/journal_transactions', $data);
		} else {
			redirect(base_url());
		}
	}
	
	public function FORM_addJournal()
	{
		if ($this->Model_Security->CheckUserRestriction('journal_transactions_add') || $this->Model_Security->CheckUserRestriction('purchase_orders_accounting') || $this->Model_Security->CheckUserRestriction('sales_orders_accounting')) {

			$order_no = $this->input->post('order_no');

			if (substr($order_no, 0, 2) == 'PO' && !$this->Model_Security->CheckUserRestriction('purchase_orders_accounting')) redirect(base_url());
			if (substr($order_no, 0, 2) == 'SO' && !$this->Model_Security->CheckUserRestriction('sales_orders_accounting')) redirect(base_url());

			$journalNo = 'JT' . strtoupper(uniqid());
			$description = $this->input->post('description');
			$date = $this->input->post('date');

			$transactionCount = $this->input->post('transactions-count');

			$totalDebit = 0;
			$totalCredit = 0;
			$transactions = array();
			for ($i = 0; $i < $transactionCount; $i++) {
				$accountID = trim($this->input->post('accountIDInput_' . $i));
				$debit = trim($this->input->post('debitInput_' . $i));
				$credit = trim($this->input->post('creditInput_' . $i));

				if ($debit > 0) {
					$credit = 0;
				} elseif ($credit > 0) {
					$debit = 0;
				}
				$totalDebit += $debit;
				$totalCredit += $credit;

				$data = array(
					'AccountID' => $accountID,
					'Debit' => (int)$debit,
					'Credit' => (int)$credit
				);
				array_push($transactions, $data);
			}

			if ($totalCredit == $totalDebit && ($totalDebit > 0 && $totalCredit > 0)) {
				// Insert
				$data = array(
					'JournalNo' => $journalNo,
					'Description' => $description,
					'Date' => $date,
					'Total' => $totalDebit,
					'OrderNo' => $order_no
				);
				$insertJournal = $this->Model_Inserts->InsertJournal($data);
				if ($insertJournal == TRUE) {
					$journalID = $this->db->insert_id();

					// create new journal transactions
					foreach ($transactions as $row) {
						$row['JournalID'] = $journalID;
						$insertJournalTransaction = $this->Model_Inserts->InsertJournalTransaction($row);
					}

					$this->session->set_flashdata('highlight-id', $journalID);
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Added new Journal.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('created a new journal.', 'added a new journal' . ' [ID: ' . $journalID . '].', base_url('admin/journals'));
				} else {
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading journal data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}
			} else {
				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong>'. $totalCredit .'=='. $totalDebit .'
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}
	public function FORM_deleteJournal()
	{
		if ($this->Model_Security->CheckUserRestriction('journal_transactions_delete')) {
			$journalID = $this->input->post('journal-id');

			$getJournalByID = $this->Model_Selects->GetJournalByID($journalID);
			$GetTransactionsByJournalID = $this->Model_Selects->GetTransactionsByJournalID($journalID)->result_array();

			if ($getJournalByID->num_rows() > 0) {
				if ($this->Model_Deletes->Delete_journal($journalID)) {
					foreach ($GetTransactionsByJournalID as $row) {
						$this->Model_Deletes->Delete_journal_transaction($row['ID']);
					}

					$this->session->set_flashdata('highlight-id', $journalID);
					$prompt_txt =
					'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Success!</strong> Deleted Journal.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);

					// LOGBOOK
					$this->Model_Logbook->LogbookEntry('deleted journal.', 'deleted a journal [ID: ' . $journalID . '].', base_url('admin/journals'));
				}
				else
				{
					// $this->Model_Logbook->SetPrompts('error', 'error', 'Error uploading data. Please try again.');
					$prompt_txt =
					'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
					<strong>Warning!</strong> Error uploading data. Please try again.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
					$this->session->set_flashdata('prompt_status',$prompt_txt);
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(base_url());
		}
	}

}
