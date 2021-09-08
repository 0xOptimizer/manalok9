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

class PhpOffice extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('Model_Selects');
	}
	public function ExportFrom_To() {

        
		$ClientID = $this->input->post('id',true);
        $Mode = $this->input->post('Mode',true);
		$f_date = $this->input->post('f_date',true);
		$t_date = $this->input->post('t_date',true);
        $filename = $this->input->post('ExportFileName',true);
        $GetWeeklyDates = $this->Model_Selects->GetWeeklyDates();

        switch ($Mode) {
            case 0:
                $SalaryMode = 'Weekly';
                break;
            case 1:
                $SalaryMode = 'Semi-Monthly';
                break;
            case 2:
                $SalaryMode = 'Monthly';
                break;
        }

    	####### Get Applicant details
		$GetApplicantDetails = $this->Model_Selects->GetWeeklyListEmployee($ClientID);
        ####### Get Client details
        $GetClientDetails = $this->Model_Selects->GetClientID($ClientID);
        $Client = $GetClientDetails->row_array();
		####### Initiate Spreadsheets
        $spreadsheet = new Spreadsheet(); 
        $sheet = $spreadsheet->getActiveSheet();

        ####### Header
        $sheet->mergeCells('A1:B1');
        $styleBold = array(
            'font' => array(
            'bold' => true,
        ));
        $sheet->getStyle('C1')->applyFromArray($styleBold);
        $sheet->getStyle('E1')->applyFromArray($styleBold);
        $sheet->getStyle('A2')->applyFromArray($styleBold);
        $sheet->getStyle('B2')->applyFromArray($styleBold);
        $sheet->getStyle('C2')->applyFromArray($styleBold);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        ##### CELL VALUES
        $sheet->setCellValue('A1', 'Client Information | Wercher Solutions and Resources Labor Service Cooperative');
        $sheet->setCellValue('C1', 'Client Name:');
        $sheet->setCellValue('D1', $Client['Name']);
        $sheet->setCellValue('E1', 'Salary Mode:');
        $sheet->setCellValue('F1', $SalaryMode);
        $sheet->setCellValue('A2', 'ApplicantID');
        $sheet->setCellValue('B2', 'Name');
        $sheet->setCellValue('C2', 'Salary ( ₱ )');
        $sheet->setCellValue('D2', 'Date');

        ####### Fill excel with data
        $i=3;
        $hoursColumn = 'D';
        $hoursRow = '3';
        foreach ($GetApplicantDetails->result_array() as $row) {
            $fullName = '';
            if ($row['LastName']) {
                $fullName = $fullName . $row['LastName'] . ', ';
            } else {
                $fullName = $fullName . '[No Last Name], ';
            }
            if ($row['FirstName']) {
                $fullName = $fullName . $row['FirstName'];
            } else {
                $fullName = $fullName . '[No First Name]';
            }
            if ($row['MiddleName']) {
                $fullName = ' ' . $fullName . ' ' . $row['MiddleName'][0] . '.';
            }
            if ($row['NameExtension']) {
                $fullName = $fullName . ', ' . $row['NameExtension'];
            }
        	$sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->setCellValue('A'.$i, $row['ApplicantID']);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->setCellValue('B'.$i, $fullName);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->setCellValue('C'.$i, $row['SalaryExpected']);

        	$i++;

        	$begin = new DateTime($f_date);
        	$end = new DateTime($t_date.'+ 1day');

        	$interval = DateInterval::createFromDateString('1 day');
        	$period = new DatePeriod($begin, $interval, $end);

        	$sheet->getColumnDimension('A')->setAutoSize(true);

        	$a = 'D';
        	foreach ($period as $dt) {
        		$sheet->getColumnDimension($a)->setAutoSize(true);
        		$sheet->setCellValue($a.'2', $dt->format("Y-m-d"));
                $sheet->getStyle($a.'2')->applyFromArray($styleBold);
        		$a++;
        	}
            $TotalRegHours = 0;
            $TotalOTHours = 0;
            foreach ($GetWeeklyDates->result_array() as $brow):
                if($this->Model_Selects->GetMatchingDates($row['ApplicantID'], $brow['Time'], $Mode)->num_rows() > 0) {
                    foreach ($this->Model_Selects->GetMatchingDates($row['ApplicantID'], $brow['Time'], $Mode)->result_array() as $nrow):
                        $Hours = $nrow['Hours'];
                        $OT = $nrow['Overtime'];
                        $totalh =  $nrow['Hours'] + $nrow['Overtime'];
                        $TotalRegHours = $TotalRegHours + $Hours;
                        $TotalOTHours = $TotalOTHours + $OT;
                        $sheet->getColumnDimension($hoursColumn)->setAutoSize(true);
                        $sheet->setCellValue($hoursColumn.$hoursRow, $totalh);
                        // $sheet->getStyle($hoursCell.'3')->applyFromArray($styleBold);
                    endforeach;
                } else {
                    // echo $nrow['Hours'];
                    // echo '<br>';
                    // echo $nrow['Overtime'];
                    $sheet->getColumnDimension($hoursColumn)->setAutoSize(true);
                    $sheet->setCellValue($hoursColumn.$hoursRow, '0');
                    // $sheet->getStyle($hoursCell.'3')->applyFromArray($styleBold);
                }    
                $hoursColumn++;
            endforeach;
            $hoursRow++;
            $hoursColumn = 'D';
        }
        $totalHoursCol =  $sheet->getHighestColumn();
        $totalHoursCol++;
        $totalOTHoursCol = $totalHoursCol;
        $totalOTHoursCol++;
       
        $sheet->setCellValue($totalHoursCol . '2' , 'Reg Hrs');
        $sheet->setCellValue($totalOTHoursCol . '2' , 'OT Hrs');
        ####### Instantiate Xlsx
        $writer = new Xlsx($spreadsheet);

        ####### Generate file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    public function importExcel_format()
    {
    	# code...
    }
}