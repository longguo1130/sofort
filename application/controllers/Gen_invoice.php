<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once(APPPATH."third_party/dompdf/autoload.inc.php");
require_once(APPPATH."third_party/tcpdf/examples/tcpdf_include.php");

class Gen_invoice extends CI_Controller {

   protected function ci()
   {
       return get_instance();
   }

  /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function index()
   {

       $current_user = $this->session->userdata('curr_user');

       $array = $this->Invoice_model->getRepairIdArray($current_user);
       $repair_array = $this->Invoice_model->getRepairLst($current_user[0]['telephone_no'],$array);

       $invoice_item = $this->Invoice_model->getInvoiceItem();

       $data['title'] = 'Invoice Document';
       // $data['main']  = 'public/invoice';
       $data['invoice_created'] = 'success';
       $data['invoice_item'] = $invoice_item;
       $data['repair_infos'] = $repair_array;

       // create new PDF document
       $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

       // set document information
       $pdf->SetCreator(PDF_CREATOR);
       // $pdf->SetAuthor('Nicola Asuni');
       // $pdf->SetTitle('TCPDF Example 048');
       // $pdf->SetSubject('TCPDF Tutorial');
       // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

       // set default header data
       $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');

       // set header and footer fonts
       $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
       $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

       // set default monospaced font
       $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

       // set margins
       $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

       // set auto page breaks
       $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

       // set image scale factor
       $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

       // set some language-dependent strings (optional)
       if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
       }

       // ---------------------------------------------------------

       // set font
       $pdf->SetFont('helvetica', 'B', 20);

       // add a page
       $pdf->AddPage();

       // $pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

       $pdf->SetFont('helvetica', '', 10);

       // -----------------------------------------------------------------------------
       // print a message
       $txt = "Sevenit GmbH – Hauptstraße 40 – 77653 Offenburg\n\nMustermann KG\nMusterstr. 1\n22222 Musterstadt";
       $pdf->MultiCell(100, 50, $txt, 0, 'L', false, 1, 14, 30, true, 0, false, true, 0, 'T', false);
       $pdf->SetY(30);

       $txt = "Rechnung Nr.\nRechnungsdatum\nLieferdatum\nIhre Kundennummer\nIhr Ansprechpartner";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 1, 120, 30, true, 0, false, true, 0, 'T', false);
       $pdf->SetY(30);       

       $start_date = date('m/d/Y', $invoice_item[0]['start_timestamp']);
       $end_date = date('m/d/Y', $invoice_item[0]['end_timestamp']);
       $txt = $invoice_item[0]['invoice_id']."\n".$start_date."\n".$end_date."\n".$invoice_item[0]['customer_id']."\n"."Fabian Silberer";

       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 1, 170, 30, true, 0, false, true, 0, 'T', false);
       $pdf->SetY(30);
       // $pdf->ln();

       $pdf->Cell(0, 0, '', 0, 2);      
       $pdf->SetFont('helvetica', '', 11);
       $pdf->Write(50, $end_date, '', 0, 'R', false, 0, false, false, 0); 
       
       $txt = "Rechnung Nr. ".$invoice_item[0]['invoice_id'];
       $pdf->Cell(0, 0, '', 0, 1);  
       $pdf->SetFont('helvetica', '', 12);
       $pdf->Write(70, $txt, '', 0, 'L', false, 0, false, false, 0);

       $pdf->Cell(0, 0, '', 0, 1);  
       $pdf->SetFont('helvetica', '', 10);
       $pdf->Write(90, 'Vielen Dank für Ihr Vertrauen in die Mustermann KG. Wir stellen Ihnen hiermit folgende Leistungen in Rechnung:', '', 0, 'L', false, 0, false, false, 0);
       // $pdf->ln();
       
       $pdf->SetFillColor(255, 255, 200);
       $txt = "Pos.";
       $pdf->MultiCell(20, 0, $txt, 0, 'L', true, 1, 14, 100, true, 0, false, true, 0, 'T', false);
      
       $txt = "Repair Title";
       $pdf->MultiCell(140, 0, $txt, 0, 'L', true, 1, 30, 100, true, 0, false, true, 0, 'T', false);
       
       $txt = "Repair Price";
       $pdf->MultiCell(25, 0, $txt, 0, 'L', true, 1, 170, 100, true, 0, false, true, 0, 'T', false);
       

       $pdf->SetFillColor(255, 255, 200);

       $sub_total = 0;
       $float_y = 0;
       for ($i=0; $i < count($repair_array); $i++) { 
         
         $txt = ($i + 1).".";
         $float_y = 100 + 7 * ($i + 1);
         $pdf->MultiCell(20, 0, $txt, 0, 'L', false, 1, 14, $float_y, true, 0, false, true, 0, 'T', false);
         
         $txt = $repair_array[$i]['repair_title'];
         $pdf->MultiCell(150, 0, $txt, 0, 'L', false, 1, 30, $float_y, true, 0, false, true, 0, 'T', false);
         
         $txt = $repair_array[$i]['repair_price']." €";
         $pdf->MultiCell(40, 0, $txt, 0, 'L', false, 1, 170, $float_y, true, 0, false, true, 0, 'T', false);

         $sub_total += $repair_array[$i]['repair_price'];
       }


       $html = '<br /><hr /><br />';
       $pdf->writeHTML($html, true, 0, true, 1);
       
       $float_y += 11;
       $txt = "Summe Positionen";
       $pdf->MultiCell(150, 50, $txt, 0, 'L', false, 1, 30, $float_y, true, 0, false, true, 0, 'T', false);
       
       $txt = $sub_total." €";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 1, 170, $float_y, true, 0, false, true, 0, 'T', false);

       $float_y += 9;
       $pdf->SetFont('helvetica', '', 12);
       $txt = "Erstattung der Einsendekosten:";
       $pdf->MultiCell(150, 50, $txt, 0, 'L', false, 1, 30, $float_y, true, 0, false, true, 0, 'T', false);
       
       
       $txt = "-5 €";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 1, 170, $float_y, true, 0, false, true, 0, 'T', false);
       
       $float_y += 9;
       $pdf->SetFont('helvetica', '', 13);
       $txt = "Rechnungsbetrag";
       $pdf->MultiCell(150, 50, $txt, 0, 'L', false, 1, 30, $float_y, true, 0, false, true, 0, 'T', false);
       
       $txt = ($sub_total - 5)." €";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 1, 170, $float_y, true, 0, false, true, 0, 'T', false);


       $pdf->SetY($float_y);
       // $pdf->ln();

       $pdf->Cell(0, 0, '', 0, 2);      
       $pdf->SetFont('helvetica', '', 8);
       $pdf->Write(15, 'Zahlungsbedingungen: Zahlung innerhalb von 14 Tagen ab Rechnungseingang ohne Abzüge', '', 0, 'L', false, 0, false, false, 0); 
  

       $pdf->SetY(175);
       // $pdf->ln();

       $pdf->Cell(0, 0, '', 0, 2);      
       $pdf->SetFont('helvetica', '', 10);
       $pdf->Write(15, 'Mit freundlichen Grüßen', '', 0, 'L', false, 0, false, false, 0);


       $pdf->SetY(190);
       // $pdf->ln();

       $pdf->Cell(0, 0, '', 0, 2);      
       $pdf->SetFont('helvetica', '', 10);
       $pdf->Write(15, 'Said Khagani', '', 0, 'L', false, 0, false, false, 0);
       
       $pdf->SetY(220);
       // $pdf->ln();

       $pdf->Cell(0, 0, '', 0, 2);      
       $pdf->SetFont('helvetica', '', 10);
       $pdf->Write(15, 'Said Khagani', '', 0, 'L', false, 0, false, false, 0);
       $pdf->SetY(235);
       $pdf->ln();

       $txt = "Sevenit GmbH\nHauptstraße 40\n77653 Offenburg\nDeutschland\nTel.: (+49) 7821 – 549370 – 0\nE-Mail: info@sevenit.de";
       $pdf->MultiCell(100, 50, $txt, 0, 'L', false, 0, 14, 245, true, 0, false, true, 0, 'T', false);
       $pdf->SetY(245);               

       $txt = "Musterbank\nIBAN DE 85 12345678 0123456789\nBIC PBNKDEFF";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 0, 120, 245, true, 0, false, true, 0, 'T', false);
       

       $txt = "USt.-ID: 0815\nGeschäftsführer:\nMax Mustermann";
       $pdf->MultiCell(40, 50, $txt, 0, 'L', false, 0, 170, 245, true, 0, false, true, 0, 'T', false);
       
       $pdf->AddPage();
       
       //Close and output PDF document
       $pdf->Output('example_048.pdf', 'I');

       //============================================================+
       // END OF FILE
       //============================================================+

   }

}