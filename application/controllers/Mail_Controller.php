<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Selects');
		$this->load->model('Model_Security');
		$this->load->model('Model_Inserts');
		$this->load->model('Model_Logbook');
		$this->load->model('Model_Updates');
		
		if (!$this->Model_Security->CheckPrivilegeLevel()) {
			redirect();
		}
	}
	public function mail_attachment_temp()
	{
		$this->load->view('admin/template/mail_attachment');
	}
	public function Email_Configuration()
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'devt5599@gmail.com',
			'smtp_pass' => '', // NEED PASSWORD ---------------------------------------
			'mailtype' => 'html',
			'charset' => 'iso-8859-1', //utf-8 if sending template email
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);
	}
	public function SampleMail()
	{
		if ($this->Model_Security->CheckUserRestriction('mail_add')) {
		
			$this->Email_Configuration();

			$this->email->set_newline("\r\n");
			$this->email->set_header('MIME-Version', '1.0; charset=iso-8859-1'); //utf-8 if sending template email
	      // $this->email->set_header('Content-type', 'text/html');

			$this->email->from('devt5599@gmail.com');
			$this->email->to('cubelobritz@gmail.com');
			$this->email->subject('Purchase Orders with attachment');

	      // $contents = $this->load->view('admin/template/mail_attachment','',true);

			$this->email->message('');
			$this->email->attach('C:\xampp\htdocs\manalok9\assets\images\plus.png');
			if($this->email->send())
			{
				echo 'Email sent.';
			}
			else
			{
				show_error($this->email->print_debugger());
			}
		} else {
			redirect(base_url());
		}
	}

	public function send_email_to()
	{
		if ($this->Model_Security->CheckUserRestriction('mail_add')) {
			$send_to = $this->input->post('send_to');
			$mail_subject = $this->input->post('mail_subject');
			$mail_message = $this->input->post('mail_message');
			$mail_attachment = $this->input->post('mail_attachment');

			if (empty($send_to) || empty($mail_subject) || empty($mail_message)) {

				$prompt_txt =
				'<div class="alert alert-warning position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
				<strong>Warning!</strong> All fields are required. Please try again.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$this->session->set_flashdata('prompt_status',$prompt_txt);
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 587,
					'smtp_user' => 'devt5599@gmail.com',
					'smtp_pass' => '', // NEED PASSWORD ---------------------------------------
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
				$this->load->library('email', $config);

				$this->email->set_newline("\r\n");
				$this->email->set_header('MIME-Version', '1.0; charset=iso-8859-1');
				// $this->email->set_header('Content-type', 'text/html');


				$this->email->from('MANALOK9');
				$this->email->to($send_to);
				$this->email->subject($mail_subject);


				$this->email->message($mail_message);

				if (!empty($_FILES['mail_attachment']['name'])) {
					$config['upload_path']          = 'assets/uploads/';
					$config['allowed_types']        = '*';
					$config['max_size']             = 10000;
					$config['max_width']            = 10000;
					$config['max_height']           = 10000;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('mail_attachment'))
					{
						$path = 'assets/uploads/'.$_FILES['mail_attachment']['name'];
						$this->email->attach($path);
						if($this->email->send())
						{
							$data = array(
								'sent_to' => $send_to,
								'subject' => $mail_subject,
								'message' => $mail_message,
								'attachment' => base_url() .''.$path,
							);
							$EmailInsert = $this->Model_Inserts->EmailInsert($data);
							$prompt_txt =
							'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Success!</strong> Email with attachment sent.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
							redirect($_SERVER['HTTP_REFERER']);
						}
						else
						{
							$prompt_txt =
							'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
							<strong>Error!</strong> Sending error. Please try again.
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>';
							$this->session->set_flashdata('prompt_status',$prompt_txt);
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					else
					{
						$prompt_txt =
						'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Error!</strong> There is a problem uploading the file. Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
						redirect($_SERVER['HTTP_REFERER']);

					}
				}
				else
				{
					if($this->email->send())
					{
						$data = array(
							'sent_to' => $send_to,
							'subject' => $mail_subject,
							'message' => $mail_message,
							'attachment' => 'No attachment',
						);
						$EmailInsert = $this->Model_Inserts->EmailInsert($data);

						$prompt_txt =
						'<div class="alert alert-success position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Success!</strong> Email without attachment sent.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
						redirect($_SERVER['HTTP_REFERER']);
					}
					else
					{
						$prompt_txt =
						'<div class="alert alert-danger position-fixed bottom-0 end-0 alert-dismissible fade show" role="alert">
						<strong>Error!</strong> Please try again.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>';
						$this->session->set_flashdata('prompt_status',$prompt_txt);
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				
			}
		} else {
			redirect(base_url());
		}
	}
}
