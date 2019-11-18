<?php

require_once 'classes/CreateDocx.php';
$docx = new CreateDocx();

//CONVERT ROMAN
function integerToRoman($integer)
{
 $integer = intval($integer);
 $result = '';
 $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 
                 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9,
                 'V' => 5, 'IV' => 4, 'I' => 1
 );
 foreach($lookup as $roman => $value){
     $matches = intval($integer/$value);
     $result .= str_repeat($roman,$matches);
     $integer = $integer % $value;
 }
 return $result;
}
function numToMonth($integer){
    if($integer == 1) return 'January';
    if($integer == 2) return 'February';
    if($integer == 3) return 'March';
    if($integer == 4) return 'April';
    if($integer == 5) return 'May';
    if($integer == 6) return 'Juny';
    if($integer == 7) return 'July';
    if($integer == 8) return 'August';
    if($integer == 9) return 'September';
    if($integer == 10) return 'Otober';
    if($integer == 11) return 'November';
    if($integer == 12) return 'Desember';
}
//

//STYLE
$coverTitle = array(
    'textAlign' => 'left',
    'fontSize' => 26,
    'bold' => true,
    'spacingBottom' => 0
);
$coverReportNumber = array(
    'color' => '0000ff',
    'textAlign' => 'left',
    'fontSize' => 16,
    'bold' => true
);
$coverSubject = array(
    'textAlign' => 'left',
    'fontSize' => 16,
    'spacingBottom' => 0
);
$coverPeriod = array(
    'textAlign' => 'right',
    'fontSize' => 20,
    'bold' => true,
    'position'=> -350 
);
$coverFooter = array(
    'textAlign' => 'center',
    'fontSize' => 12,
    'spacingBottom' => 0
);
$headingBAB = array(
    'bold' => true,
    'fontSize' => 16,
    'textAlign' => 'center',
    'font' => 'Cambira'
);
$headingSub1BAB = array(
    'textAlign' => 'left',
    'fontSize' => 14
);
$headingSub2BAB = array(
    'textAlign' => 'left',
    'fontSize' => 12,
    'font' => 'Cambira',
    'bold' => true,
);
$commonText = array(
    'textAlign' => 'left',
    'fontSize' => 12,
    'spacingBottom' => 0
);
$break = new WordFragment($docx);
$break->addBreak();
$space_5='     ';
//END STYLE

$month           = date("F",strtotime($report_period));
$monthnum         = date("m",strtotime($report_period));
$year            = date("Y",strtotime($report_period));
$customername       = str_replace(" ", "", $cust->data[0]->customer_name);
//COVER
$imgLogo = array(
    // 'src' => base_url().'assets/img/logo2-color.png',
    'src' => 'C:\xampp\htdocs\proyek\ereport_aldi\assets\img\logo2-color.png',
    'imageAlign' => 'left',
    'scaling' => 30,
    'textWrap' => 0,
    'spacingTop' => 0,
    'spacingBottom' => 0
);
$docx->addImage($imgLogo);
$docx->addText($report_title, $coverTitle);
$docx->addText('No. : '.$report_number, $coverReportNumber);
$options = array(
    'from' => '0,0',
    'to' => '550,0',
    'strokecolor' => '#000000',
    'strokeweight' => '4',
    'position' => 'relative',
    'margin-top' => 0,
    'margin-bottom' => 0
);
$docx->addShape('line', $options);
$docx->addText('Agreement Number : '.$agreement_number, $coverSubject);
$docx->addText('Subject : '.$subject, $coverSubject);
$docx->addText('Period : '.date('F, Y', strtotime($report_period)), $coverPeriod);
$imgCover = array(
    // 'src' => base_url().'assets/img/logo2-color.png',
    'src' => 'D:\logoss.png',
    'imageAlign' => 'right',
    'scaling' => 20,
    'textWrap' => 0,
    'spacingTop' => 0,
    'spacingBottom' => 0
);
$docx->addImage($imgCover);
$docx->addBreak(array('type' => 'page'));
//END COVER


//HEADER
$textHeader = array(
    'fontSize' => 14,
    'bold' => true,
    'textAlign' => 'right'
);
$imageHeader = array (
    'src' => 'D:\logoss.png',
    'scaling' => 15
);
$headerText = new WordFragment($docx, 'defaultHeader');
$headerImage = new WordFragment($docx, 'defaultHeader');
$headerImage->addImage($imageHeader);
$forHeader = array();
$forHeader[] = array('text' => "Monthly Performance Report");
$forHeader[] = $break;
$forHeader[] = array('text' => date('F, Y', strtotime($report_period)));
$headerText->addText($forHeader, $textHeader);
$valuesTable = array(
    array(
        $headerImage,
        $headerText
    )
);
$paramsTable = array(
    'border' => 'nil',
    'columnWidths' => array(1000,2500),
    'vAlign' => center
);
$headerTable = new WordFragment($docx, 'defaultHeader');
$headerTable->addTable($valuesTable, $paramsTable);
$headerTable->addBreak(array('type' => 'line'));
$firstHead = new WordFragment($docx, 'firstHeader');
$docx->addHeader(array('first' => $firstHead, 'default' => $headerTable));
//END HEADER


//PAGING
$numbering = new WordFragment($docx, 'defaultFooter');
$textPaging = array(
    'textAlign' => 'right',
    'bold' => true,
    'fontSize' => 12
);
$numbering->addPageNumber('numerical', $textPaging);
$firstPage = new WordFragment($docx, 'firstFooter');
$firstPage->addText("© 2019 PT Sigma Cipta Caraka.", $coverFooter);
$firstPage->addText("This document is classified as confidential, could be copied for internal purpose only.", $coverFooter);
$docx->addFooter(array('first' => $firstPage, 'default' => $numbering));
//END PAGING


//TABLE OF CONTENT
$docx->addText('Daftar Isi', $headingBAB);
$legend = array(
    'text' => 'Click here to update the TOC', 
    'bold' => true, 
    'fontSize' => 12
);
$docx->addTableContents(array('autoUpdate' => true, 'displayLevels' => '1-6'), $legend);
// $docx->addBreak(array('type' => 'page'));
//END TABLE OF CONTENT

$idBAB = 1;
//// try for each
foreach ($menu->data as $themenu) {
    foreach ($themenu->menu as $menu1) {
        $docx->addBreak(array('type' => 'page'));
        $romanIdBAB = integerToRoman($idBAB++);
        $docx->addHeading($romanIdBAB.'.   '.$menu1->menu_name, 1, $headingBAB);
        //eSummary
        if ($menu1->id_menu == 1) {
            if ($esummary->code == '200') {
                $environmentSummary[] = array();
                $environmentSummary[] = array('text'=>'Environment:');
                $ES_standard[] = array();
                $ES_standard[] = array('text'=>'');
                $ES_thisMonth[] = array();
                $ES_thisMonth[] = array('text'=>'');
                foreach($esummary->Environment as $content){
                    $environmentSummary[] = $break;
                    $environmentSummary[] = array('text'=>$space_5.$content->Menu);
                    $ES_standard[] = $break;
                    $ES_standard[] = array('text'=>$content->Data_Standard);
                    $ES_thisMonth[] = $break;
                    $ES_thisMonth[] = array('text'=>$content->Performance);
                }
                $securitySummary[] = array();
                $securitySummary[] = array('text'=>'Security Device Availability:');
                $SS_standard[] = array();
                $SS_standard[] = array('text'=>'');
                $SS_thisMonth[] = array();
                $SS_thisMonth[] = array('text'=>'');
                foreach($esummary->Security_Device_Availability as $content){
                    $securitySummary[] = $break;
                    $securitySummary[] = array('text'=>$space_5.$content->Menu);
                    $SS_standard[] = $break;
                    $SS_standard[] = array('text'=>$content->Data_Standard);
                    $SS_thisMonth[] = $break;
                    $SS_thisMonth[] = array('text'=>$content->Performance);
                }
                $table11 = new WordFragment($docx); $table11->addText($environmentSummary);
                $table12 = new WordFragment($docx); $table12->addText($ES_standard);
                $table13 = new WordFragment($docx); $table13->addText($ES_thisMonth);
                $table21 = new WordFragment($docx); $table21->addText($securitySummary);
                $table22 = new WordFragment($docx); $table22->addText($SS_standard);
                $table23 = new WordFragment($docx); $table23->addText($SS_thisMonth);
                $headerTableExSum = array('No.', 'Service Item', 'Standard', 'This Month Performance');
                $valueRow1ExSum = array('1' , $table11, $table12, $table13);
                $valueRow2ExSum = array('2' , $table21, $table22, $table23);
                $valuesTable = array($headerTableExSum, $valueRow1ExSum, $valueRow2ExSum);
                $tableExecutiveSummary = array(
                    'textAlign' => 'center',
                    'border' => 'single',
                    'borderWidth' => 10,
                    'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
                    'tableLayout' => 'autofit', // this is the default value
                    'tableWidth' => array('type' =>'pct', 'value' => 0),
                    'bold' => true,
                    'fontSize' => 12
                );
                $docx->addTable($valuesTable, $tableExecutiveSummary);
            }
        }
        //machine movement
        if ($menu1->id_menu == 5) {
            if ($data['movement']->data != NULL) {

            }
            else{
                $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada machine movement.';
                $docx->addText($text, $commonText);
            }
        }
        //change management
        if ($menu1->id_menu == 7) {
            if ($data['cm']->data != NULL) {

            }
            else{
                $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada change management.';
                $docx->addText($text, $commonText);
            }
        }
        //incident
        if ($menu1->id_menu == 8) {
            if ($data['incident']->data != NULL) {

            }
        }
        //MENU CHILD
        if ($menu1->menu_child != NULL) {
            $idSub1BAB=1;
            foreach ($menu1->menu_child as $menu2) {
                if ($menu2->id_menu == 41) $docx->addBreak(array('type' => 'page'));
                $docx->addHeading($idSub1BAB.'.   '.$menu2->menu_name, 3, $headingSub1BAB);
                $idSub1BAB++;
                //tempperatur & humidity
                if ($menu2->id_menu == 40) {
                    if ($temperatur->data  != NULL) {
                        $data_val = array();
                        $thedata = array();
                        foreach($temperatur->data as $index => $row)
                        {
                            $date = date('d', strtotime($row->data_date));
                            $data_val[] = array(
                                                'name' => $date,
                                                'values' => array($row->data_value, ($row->min_value-$row->max_value), ($row->min_value+$row->max_value))
                                            );
                            array_push($thedata, $data_val[$index]);
                        }
                        $data = array(
                                    'legend' => array('Temp','Min_Temp','Max_Temp'),
                                    'data' => $thedata
                        );
                        $paramsChart = array(
                            'data' => $data,
                            'type' => 'lineChart',
                            'color' => 2,
                            'sizeX' => 15,
                            'sizeY' => 10,
                            'chartAlign' => 'center',
                            'legendPos' => 'none',
                            'legendOverlay' => '1',
                            'border' => '1',
                            'hgrid' => '1',
                            'vgrid' => '0',
                            'showTable' => '1'
                        );
                        $docx->addChart($paramsChart);
                        //
                        $data_val = array();
                        $data_val[] = array('Period', 'Min', 'Max', 'Remarks');
                        foreach($temperatur->table as $index => $row)
                        {
                            $data_val[] = array($row->Periode, $row->min, $row->max, $row->data_remark);
                        }
                        $tableTemp = array(
                            'textAlign' => 'center',
                            'border' => 'single',
                            'borderWidth' => 10,
                            'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
                            'tableLayout' => 'autofit', // this is the default value
                            'tableWidth' => array('type' =>'pct', 'value' => 0),
                            'bold' => true,
                            'fontSize' => 12
                        );
                        $docx->addTable($data_val, $tableTemp);
                    }
                    if ($humidity->data  != NULL) {
                        $data_val = array();
                        $thedata = array();
                        foreach($humidity->data as $index => $row)
                        {
                            $date = date('d', strtotime($row->data_date));
                            $data_val[] = array(
                                                'name' => $date,
                                                'values' => array($row->data_value, ($row->min_value-$row->max_value), ($row->min_value+$row->max_value))
                                            );
                            array_push($thedata, $data_val[$index]);
                        }
                        $data = array(
                                    'legend' => array('Temp','Min_Temp','Max_Temp'),
                                    'data' => $thedata
                        );
                        $paramsChart = array(
                            'data' => $data,
                            'type' => 'lineChart',
                            'color' => 2,
                            'sizeX' => 15,
                            'sizeY' => 10,
                            'chartAlign' => 'center',
                            'legendPos' => 'none',
                            'legendOverlay' => '1',
                            'border' => '1',
                            'hgrid' => '1',
                            'vgrid' => '0',
                            'showTable' => '1'
                        );
                        $docx->addChart($paramsChart);
                        //
                        $data_val = array();
                        $data_val[] = array('Period', 'Min', 'Max', 'Remarks');
                        foreach($humidity->table as $index => $row)
                        {
                            $data_val[] = array($row->Periode, $row->min, $row->max, $row->data_remark);
                        }
                        $tableHum = array(
                            'textAlign' => 'center',
                            'border' => 'single',
                            'borderWidth' => 10,
                            'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
                            'tableLayout' => 'autofit', // this is the default value
                            'tableWidth' => array('type' =>'pct', 'value' => 0),
                            'bold' => true,
                            'fontSize' => 12
                        );
                        $docx->addTable($data_val, $tableHum);
                    }
                }
                //main sch of DC facilities & 
                if ($menu2->id_menu == 41) {
                    if ($maintenance->data != NULL) {
                        $data_val = array();
                        $month1 = numToMonth($monthnum-1);
                        $month2 = numToMonth($monthnum);
                        $month3 = numToMonth($monthnum+1);
                        $data_val[] = array('No', 'Vendor', 'Perangkat', $month1, $month2, $month3);
                        $indexNo = 1;
                        foreach($maintenance->data as $index => $row)
                        {
                            $data_val[] = array($indexNo++, $row->maintenance_vendor, $row->maintenance_device, $row->monthsprev, $row->months, $row->monthsnext);
                        }
                        $tableMaintenance = array(
                            'textAlign' => 'center',
                            'border' => 'single',
                            'borderWidth' => 10,
                            'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
                            'tableLayout' => 'autofit', // this is the default value
                            'tableWidth' => array('type' =>'pct', 'value' => 0),
                            'bold' => true,
                            'fontSize' => 12
                        );
                        $docx->addTable($data_val, $tableMaintenance);
                    }
                }
                //Security Device Avaibility
                if ($menu2->id_menu == 42) {
                    if ($data['security']->data != NULL) {

                    }
                    else{
                        $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada security device avaibility.';
                        $docx->addText($text, $commonText);
                    }
                }
                //visitor log
                if ($menu2->id_menu == 43) {
                    if ($data['visitL']->data != NULL) {

                    }
                    else{
                        $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada visitor log.';
                        $docx->addText($text, $commonText);
                    }
                }
                //log access
                if ($menu2->id_menu == 44) {
                    if ($data['visitD']->data != NULL) {

                    }
                    else{
                        $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada log access.';
                        $docx->addText($text, $commonText);
                    }
                }
                //MENU CHILD 2
                if ($menu2->menu_child != NULL) {
                    $idSub2BAB=65;
                    foreach ($menu2->menu_child as $menu3) {
                        $charIdSub2BAB = chr($idSub2BAB);
                        $docx->addHeading($charIdSub2BAB.'.   '.$menu3->menu_name, 5, $headingSub2BAB);
                        $idSub2BAB++;
                        //power availability
                        if ($menu3->id_menu == 61) {
                            if ($PowerA->data != NULL) {
                                $data = array(
                                    'legend' => array('SLA', 'Achievements'),
                                    'data' => array(
                                        array(
                                            'name' => '2 Period Before',
                                            'values' => array($PowerA->data[8]->sla, $PowerA->data[8]->data_value),
                                        ),
                                        array(
                                            'name' => '1 Period Before',
                                            'values' => array($PowerA->data[7]->sla, $PowerA->data[7]->data_value),
                                        ),
                                        array(
                                            'name' => 'This Period',
                                            'values' => array($PowerA->data[6]->sla, $PowerA->data[6]->data_value),
                                        )
                                    )
                                );
                                $paramsChart = array(
                                    'data' => $data,
                                    'type' => 'lineChart',
                                    'color' => 2,
                                    'sizeX' => 15,
                                    'sizeY' => 10,
                                    'chartAlign' => 'center',
                                    'legendPos' => 'none',
                                    'legendOverlay' => '0',
                                    'border' => '1',
                                    'hgrid' => '1',
                                    'vgrid' => '0',
                                    'showTable' => '1'
                                );
                                $docx->addChart($paramsChart);
                                $valuesTable = array(
                                    array(
                                        $PowerA->data[0]->data_name, $PowerA->data[1]->data_name, $PowerA->data[2]->data_name, $PowerA->data[3]->data_name, $PowerA->data[4]->data_name
                                    ),
                                    array(
                                        $PowerA->data[0]->data_value, $PowerA->data[1]->data_value, $PowerA->data[2]->data_value, $PowerA->data[5]->data_value.'%', $PowerA->data[4]->data_remark
                                    )
                                );
                                $tablePowerAvailability = array(
                                    'textAlign' => 'center',
                                    'border' => 'single',
                                    'borderWidth' => 10,
                                    'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
                                    'tableLayout' => 'autofit', // this is the default value
                                    'tableWidth' => array('type' =>'pct', 'value' => 0),
                                    'bold' => true,
                                    'fontSize' => 12
                                );
                                $docx->addTable($valuesTable, $tablePowerAvailability);
                            }
                        }
                        //Power Cons
                        if ($menu3->id_menu == 62) {
                            if ($PowerCon->data != NULL) {
                                $data = array(
                                    'legend' => array('Max Power Consumption', 'Power Consumption'),
                                    'data' => array(
                                        array(
                                            'name' => date('F', strtotime($PowerCon->data[0]->data_date)),
                                            'values' => array($PowerCon->data[0]->data_value, $PowerCon->data[1]->data_value) 
                                        ),
                                        array(
                                            'name' => date('F', strtotime($PowerCon->data[0]->data_date)),
                                            'values' => array($PowerCon->data[2]->data_value, $PowerCon->data[3]->data_value) 
                                        ),
                                        array(
                                            'name' => date('F', strtotime($PowerCon->data[0]->data_date)),
                                            'values' => array($PowerCon->data[4]->data_value, $PowerCon->data[5]->data_value) 
                                        )
                                    )
                                );
                                $paramsChart = array(
                                    'data' => $data,
                                    'type' => 'lineChart',
                                    'color' => 2,
                                    'sizeX' => 15,
                                    'sizeY' => 10,
                                    'chartAlign' => 'center',
                                    'legendPos' => 'none',
                                    'legendOverlay' => '0',
                                    'border' => '1',
                                    'hgrid' => '1',
                                    'vgrid' => '0',
                                    'showTable' => '1'
                                );
                                $docx->addChart($paramsChart);
                            }
                        }
                        //UPS Load
                        if ($menu3->id_menu == 63) {
                            if ($UPSLoad->code == '200') {
                                $data_val = array();
                                $thedata = array();
                                foreach($UPSLoad->ups as $index => $row)
                                {
                                    $date = date('d', strtotime($row->data_date));
                                    $sysUPS = $row->data_value;
                                    $data_val[] = array(
                                                        'name' => $date,
                                                        'values' => array($sysUPS, $UPSLoad->kva[$index]->data_value)
                                                    );
                                    array_push($thedata, $data_val[$index]);
                                }
                                $data = array(
                                            'legend' => array('System UPS','kVA % Max'),
                                            'data' => $thedata
                                );
                                $paramsChart = array(
                                    'data' => $data,
                                    'type' => 'lineChart',
                                    'color' => 2,
                                    'sizeX' => 15,
                                    'sizeY' => 10,
                                    'chartAlign' => 'center',
                                    'legendPos' => 'none',
                                    'legendOverlay' => '1',
                                    'border' => '1',
                                    'hgrid' => '1',
                                    'vgrid' => '0',
                                    'showTable' => '1'
                                );
                                $docx->addChart($paramsChart);
                            }
                        }
                        //UPS Backup Time
                        if ($menu3->id_menu == 64) {
                            if ($UPSTime->data != NULL) {
                                $data_val = array();
                                $thedata = array();
                                foreach($UPSTime->data as $index => $row)
                                {
                                    $month = date('F', strtotime($row->data_date));
                                    $duration = date("H.i", strtotime($row->data_value));
                                    $data_val[] = array(
                                                        'name' => $month,
                                                        'values' => array($duration)
                                                    );
                                    array_push($thedata, $data_val[$index]);
                                }
                                $data = array(
                                            'legend' => array('duration in hour'),
                                            'data' => $thedata
                                );
                                $paramsChart = array(
                                    'data' => $data,
                                    'type' => 'lineChart',
                                    'color' => 2,
                                    'sizeX' => 15,
                                    'sizeY' => 10,
                                    'chartAlign' => 'center',
                                    'legendPos' => 'none',
                                    'legendOverlay' => '1',
                                    'border' => '1',
                                    'hgrid' => '1',
                                    'vgrid' => '0',
                                    'showTable' => '1'
                                );
                                $docx->addChart($paramsChart);
                            }
                        }
                        $docx->addBreak();
                    }
                }
                $docx->addBreak();
            }
        }
    }
}
//// end try for each
// $docx->addBreak(array('type' => 'page'));



// //EXECUTIVE SUMMMARY
// $docx->addHeading('Executive Summary', 1, $headingBAB);
// $environmentSummary[] = array();
// $environmentSummary[] = array('text'=>'Environment:');
// $environmentSummary[] = $break;
// $environmentSummary[] = array('text'=>'    Temperature');
// $environmentSummary[] = $break;
// $environmentSummary[] = array('text'=>'    Humidity');
// $environmentSummary[] = $break;
// $environmentSummary[] = array('text'=>'    Power Availability');
// $table11 = new WordFragment($docx);
// $table11->addText($environmentSummary);
// $ES_standard[] = array();
// $ES_standard[] = array('text'=>'');
// $ES_standard[] = $break;
// $ES_standard[] = array('text'=>$esummary->Environment[0]->Data_Standard);
// $ES_standard[] = $break;
// $ES_standard[] = array('text'=>$esummary->Environment[1]->Data_Standard);
// $ES_standard[] = $break;
// $ES_standard[] = array('text'=>$esummary->Environment[2]->Data_Standard);
// $table12 = new WordFragment($docx);
// $table12->addText($ES_standard);
// $ES_thisMonth[] = array();
// $ES_thisMonth[] = array('text'=>'');
// $ES_thisMonth[] = $break;
// $ES_thisMonth[] = array('text'=>$esummary->Environment[0]->Performance);
// $ES_thisMonth[] = $break;
// $ES_thisMonth[] = array('text'=>$esummary->Environment[1]->Performance);
// $ES_thisMonth[] = $break;
// $ES_thisMonth[] = array('text'=>$esummary->Environment[2]->Performance);
// $table13 = new WordFragment($docx);
// $table13->addText($ES_thisMonth);
// //
// $securitySummary[] = array();
// $securitySummary[] = array('text'=>'Security Device Availability:');
// $securitySummary[] = $break;
// $securitySummary[] = array('text'=>'    CCTV');
// $securitySummary[] = $break;
// $securitySummary[] = array('text'=>'    Access Door');
// $securitySummary[] = $break;
// $securitySummary[] = array('text'=>'    Fire System');
// $table21 = new WordFragment($docx);
// $table21->addText($securitySummary);
// $SS_standard[] = array();
// $SS_standard[] = array('text'=>'');
// $SS_standard[] = $break;
// $SS_standard[] = array('text'=>($esummary['Security Device Availability']->Data_Standard*100).'%');
// $SS_standard[] = $break;
// $SS_standard[] = array('text'=>($esummary->data[6]->Data_Standard*100).'%');
// $SS_standard[] = $break;
// $SS_standard[] = array('text'=>($esummary->data[7]->Data_Standard*100).'%');
// $table22 = new WordFragment($docx);
// $table22->addText($SS_standard);
// $SS_thisMonth[] = array();
// $SS_thisMonth[] = array('text'=>'');
// $SS_thisMonth[] = $break;
// $SS_thisMonth[] = array('text'=>($esummary->data[5]->Performance*100).'%');
// $SS_thisMonth[] = $break;
// $SS_thisMonth[] = array('text'=>($esummary->data[6]->Performance*100).'%');
// $SS_thisMonth[] = $break;
// $SS_thisMonth[] = array('text'=>($esummary->data[7]->Performance*100).'%');
// $table23 = new WordFragment($docx);
// $table23->addText($SS_thisMonth);
// //
// $valuesTable = array(
//     array(
//         'No.', 'Service Item', 'Standard', 'This Month Performance'
//     ),
//     array(
//         '1' , $table11, $table12, $table13
//     ),
//     array(
//         '2' , $table21, $table22, $table23
//     ),
// );
// $tableExecutiveSummary = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tableExecutiveSummary);
// $docx->addBreak(array('type' => 'page'));
// //END EXECUTIVE SUMMARY


// $idBAB= 1;
// $idSub1BAB=1;
// $idSub2BAB=65;
// $space_4='    ';
// $space_3='   ';
// //BAB ENVIRONMENT PERFORMANCE
// $romanIdBAB = integerToRoman($idBAB++); 
// $docx->addHeading("$romanIdBAB.$space_4 Environment Performance", 1, $headingBAB);
// //SUB BAB ELECTRICAL SUPPLY
// $docx->addHeading("$idSub1BAB.$space_4 Electrical Supply", 3, $headingSub1BAB);
// $idSub1BAB++;
// //Power Availability
// $charIdSub2BAB = chr($idSub2BAB++);
// $docx->addHeading("$space_4$charIdSub2BAB.$space_4 Power Availability", 3, $headingSub2BAB);
// $data = array(
//     'legend' => array('SLA', 'Achievements'),
//     'data' => array(
//         array(
//             'name' => '2 Period Before',
//             'values' => array(($esummary->data[4]->Data_Standard), (float)$data_PowerAvl->data[8]->data_value),
//         ),
//         array(
//             'name' => '1 Period Before',
//             'values' => array(($esummary->data[4]->Data_Standard), (float)$data_PowerAvl->data[7]->data_value),
//         ),
//         array(
//             'name' => 'This Period',
//             'values' => array(($esummary->data[4]->Data_Standard), (float)$data_PowerAvl->data[6]->data_value),
//         )
//     )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '0',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addChart($paramsChart);
// //
// $valuesTable = array(
//     array(
//         $data_PowerAvl->data[0]->data_name, $data_PowerAvl->data[1]->data_name, $data_PowerAvl->data[2]->data_name, $data_PowerAvl->data[3]->data_name, $data_PowerAvl->data[4]->data_name
//     ),
//     array(
//         $data_PowerAvl->data[0]->data_value, $data_PowerAvl->data[1]->data_value, $data_PowerAvl->data[2]->data_value, $data_PowerAvl->data[5]->data_value.'%', $data_PowerAvl->data[4]->data_value
//     )
// );
// $tablePowerAvailability = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tablePowerAvailability);
// //Power Consumption
// $charIdSub2BAB = chr($idSub2BAB++);
// $docx->addHeading("$space_4$charIdSub2BAB.$space_4 Power Consumption", 3, $headingSub2BAB);
// $data = array(
//     'legend' => array('Power Consumption'),
//     'data' => array(
//         array(
//             'name' => date('F', strtotime($data_PowerCons->data[5]->data_date)),
//             'values' => array($data_PowerCons->data[5]->data_value),
//         )
//     )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '0',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addChart($paramsChart);
// //UPS Load
// $charIdSub2BAB = chr($idSub2BAB++);
// $docx->addHeading("$space_4$charIdSub2BAB.$space_4 UPS Load", 3, $headingSub2BAB);
// $data_val = array();
// $thedata = array();
// foreach($data_UPSLoad->data as $index => $row)
// {
//     $month = $row->data_date;
//     $temp = new DateTime($month);
//     $month = $temp->format('d');
//     $sysUPS = $row->data_value;
//     $data_val[] = array(
//                         'name' => $month,
//                         'values' => array($sysUPS, $data_kVA->data[$index]->data_value)
//                     );
//     array_push($thedata, $data_val[$index]);
// }
// $data = array(
//             'legend' => array('System UPS','kVA % Max'),
//             'data' => $thedata
//             // array(
//             //                 $data_val[0],
//             //                 $data_val[1],
//             //                 $data_val[2],
//             //                 $data_val[3],
//             //                 $data_val[4],
//             //                 $data_val[5],
//             //                 $data_val[6],
//             //                 $data_val[7],
//             //                 $data_val[8],
//             //                 $data_val[9],
//             //                 $data_val[10],
//             //                 $data_val[11],
//             //                 $data_val[12],
//             //                 $data_val[13],
//             //                 $data_val[14],
//             //                 $data_val[15],
//             //                 $data_val[16],
//             //                 $data_val[17],
//             //                 $data_val[18],
//             //                 $data_val[19],
//             //                 $data_val[20],
//             //                 $data_val[21],
//             //                 $data_val[22],
//             //                 $data_val[23],
//             //                 $data_val[24],
//             //                 $data_val[25],
//             //                 $data_val[26],
//             //                 $data_val[27],
//             //                 $data_val[28],
//             //                 $data_val[29],
//             //                 $data_val[30]
//             //             )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '1',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addChart($paramsChart);
// //UPS Back Up Time
// $charIdSub2BAB = chr($idSub2BAB++);
// $docx->addHeading("$space_4$charIdSub2BAB.$space_4 UPS Backup Time", 3, $headingSub2BAB);
// $data_val = array();
// foreach($data_UPSBackTime->data as $row)
// {
//     $month = date('F', strtotime($row->data_date));
//     $duration = date("H.i", strtotime($row->data_value));
//     $data_val[] = array(
//                         'name' => $month,
//                         'values' => array($duration)
//                     );
// }
// $data = array(
//             'legend' => array('duration in hour'),
//             'data' => array(
//                             $data_val[2],
//                             $data_val[3],
//                             $data_val[4]
//                         )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '1',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addChart($paramsChart);
// $docx->addBreak(array('type' => 'page'));
// //END ELECTICAL SUPPLY

// //SUB BAB TEMPERATURE HUMIDITY
// $options1 = array(
//     'color' => '000000',
//     'textAlign' => 'left',
//     'fontSize' => 12
// );
// $docx->addHeading("$idSub1BAB.$space_4 Room Temperature (°C) & Humidity (%)", 3, $headingSub1BAB);
// $idSub1BAB++;
// //Temperature
// $data_val = array();
// foreach($data_temp->data as $row)
// {
//     $month = $row->data_date;
//     $temp = new DateTime($month);
//     $month = $temp->format('d');
//     $my_value = $row->data_value;
//     $data_val[] = array(
//                         'name' => $month,
//                         'values' => array($my_value, $data_temp_sla->data[0]->min_value, $data_temp_sla->data[0]->max_value)
//                     );
// }
// $data = array(
//             'legend' => array('Temp','Min_Temp','Max_Temp'),
//             'data' => array(
//                             $data_val[0],
//                             $data_val[1],
//                             $data_val[2],
//                             $data_val[3],
//                             $data_val[4],
//                             $data_val[5],
//                             $data_val[6],
//                             $data_val[7],
//                             $data_val[8],
//                             $data_val[9],
//                             $data_val[10],
//                             $data_val[11],
//                             $data_val[12],
//                             $data_val[13],
//                             $data_val[14],
//                             $data_val[15],
//                             $data_val[16],
//                             $data_val[17],
//                             $data_val[18],
//                             $data_val[19],
//                             $data_val[20],
//                             $data_val[21],
//                             $data_val[22],
//                             $data_val[23],
//                             $data_val[24],
//                             $data_val[25],
//                             $data_val[26],
//                             $data_val[27],
//                             $data_val[28],
//                             $data_val[29],
//                             $data_val[30]
//                         )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '1',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addText('> Temperature of This Month', $headingSub2BAB);
// $docx->addChart($paramsChart);
// $docx->addBreak(array('type' => 'line'));
// //
// $valuesTable = array(
//     array(
//         'Period', 'Min', 'Max', 'Remarks'
//     ),
//     array(
//         'This Period', 20.00, 22.50, '-'
//     ),
//     array(
//         '1 Period Before', 20.40, 23.00, '-'
//     ),
//     array(
//         '2 Period Before', 20.85, 23.50, '-'
//     )
// );
// $tableTemp = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tableTemp);
// $docx->addBreak(array('type' => 'page'));
// //Humidity
// $data_val = array();
// foreach($data_hum->data as $row)
// {
//     $month = $row->data_date;
//     $temp = new DateTime($month);
//     $month = $temp->format('d');
//     $my_value = $row->data_value;
//     $data_val[] = array(
//                         'name' => $month,
//                         'values' => array($my_value, $data_hum_sla->data[0]->min_value, $data_hum_sla->data[0]->max_value)
//                     );
// }
// $data = array(
//             'legend' => array('Hum','Min_Hum','Max_Hum'),
//             'data' => array($data_val[0],
//                             $data_val[1],
//                             $data_val[2],
//                             $data_val[3],
//                             $data_val[4],
//                             $data_val[5],
//                             $data_val[6],
//                             $data_val[7],
//                             $data_val[8],
//                             $data_val[9],
//                             $data_val[10],
//                             $data_val[11],
//                             $data_val[12],
//                             $data_val[13],
//                             $data_val[14],
//                             $data_val[15],
//                             $data_val[16],
//                             $data_val[17],
//                             $data_val[18],
//                             $data_val[19],
//                             $data_val[20],
//                             $data_val[21],
//                             $data_val[22],
//                             $data_val[23],
//                             $data_val[24],
//                             $data_val[25],
//                             $data_val[26],
//                             $data_val[27],
//                             $data_val[28],
//                             $data_val[29],
//                             $data_val[30]
//                         )
// );
// $paramsChart = array(
//     'data' => $data,
//     'type' => 'lineChart',
//     'color' => 2,
//     'sizeX' => 15,
//     'sizeY' => 10,
//     'chartAlign' => 'center',
//     'legendPos' => 'none',
//     'legendOverlay' => '1',
//     'border' => '1',
//     'hgrid' => '1',
//     'vgrid' => '0',
//     'showTable' => '1'
// );
// $docx->addText('> Humidity of This Month', $headingSub2BAB);
// $docx->addChart($paramsChart);
// $docx->addBreak(array('type' => 'line'));
// //
// $valuesTable = array(
//     array(
//         'Period', 'Min', 'Max', 'Remarks'
//     ),
//     array(
//         'This Period', 43.67, 50.00, '-'
//     ),
//     array(
//         '1 Period Before', 45.00, 50.50, '-'
//     ),
//     array(
//         '2 Period Before', 45.00, 52.50, '-'
//     )
// );
// $tableHum = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tableHum);
// $docx->addBreak(array('type' => 'page'));
// //END SUB BAB TEMPERATURE & HUMIDITY

// //SUB BAB Maintenance Schedule of Data Center Facilities & Infrastructures
// $docx->addHeading("$idSub1BAB.$space_4 Maintenance Schedule of Data Center Facilities & Infrastructures", 3, $headingSub1BAB);
// $idSub1BAB++;
// $valuesTable = array(
//     array(
//         'No', 'Vendor', 'Perangkat', $data_maintenance->data[3]->bulan, $data_maintenance->data[4]->bulan, $data_maintenance->data[5]->bulan
//     ),
//     array(
//         1, $data_maintenance->data[3]->vendor, $data_maintenance->data[3]->perangkat, $data_maintenance->data[3]->remark, $data_maintenance->data[4]->remark, $data_maintenance->data[5]->remark
//     ),
//     array(
//         2, $data_maintenance->data[15]->vendor, $data_maintenance->data[15]->perangkat, $data_maintenance->data[15]->remark, $data_maintenance->data[16]->remark, $data_maintenance->data[17]->remark
//     ),
//     array(
//         3, $data_maintenance->data[27]->vendor, $data_maintenance->data[27]->perangkat, $data_maintenance->data[27]->remark, $data_maintenance->data[28]->remark, $data_maintenance->data[29]->remark
//     ),
//     array(
//         4, $data_maintenance->data[39]->vendor, $data_maintenance->data[39]->perangkat, $data_maintenance->data[39]->remark, $data_maintenance->data[40]->remark, $data_maintenance->data[41]->remark
//     ),
//     array(
//         5, $data_maintenance->data[51]->vendor, $data_maintenance->data[51]->perangkat, $data_maintenance->data[51]->remark, $data_maintenance->data[52]->remark, $data_maintenance->data[53]->remark
//     ),
//     array(
//         6, $data_maintenance->data[63]->vendor, $data_maintenance->data[63]->perangkat, $data_maintenance->data[63]->remark, $data_maintenance->data[64]->remark, $data_maintenance->data[65]->remark
//     ),
//     array(
//         7, $data_maintenance->data[75]->vendor, $data_maintenance->data[75]->perangkat, $data_maintenance->data[75]->remark, $data_maintenance->data[76]->remark, $data_maintenance->data[77]->remark
//     ),
//     array(
//         8, $data_maintenance->data[87]->vendor, $data_maintenance->data[87]->perangkat, $data_maintenance->data[87]->remark, $data_maintenance->data[88]->remark, $data_maintenance->data[89]->remark
//     ),
//     array(
//         9, $data_maintenance->data[99]->vendor, $data_maintenance->data[99]->perangkat, $data_maintenance->data[99]->remark, $data_maintenance->data[100]->remark, $data_maintenance->data[101]->remark
//     )
// );
// $tableMaintenance = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tableMaintenance);
// //END SUB BAB Mintenance Schedule of Data Center Facilities & Infrastructures
// $docx->addBreak(array('type' => 'page'));
// //END BAB ENVIRONMENT PERFORMANCE


// //BAB HARDWARE MOVEMENT
// $romanIdBAB = integerToRoman($idBAB++); 
// $docx->addHeading("$romanIdBAB.$space_4 Hardware Movement", 1, $headingBAB);
// if($data_HMovement->code == '404'){
//     $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada hardware movement.';
//     $docx->addText($text, $commonText);
// }
// else{

// }
// $docx->addBreak(array('type' => 'page'));
// //END BAB HARDWARE MOVEMENT


// $idSub1BAB=1;
// //BAB SECURITY
// $romanIdBAB = integerToRoman($idBAB++); 
// $docx->addHeading("$romanIdBAB.$space_4 Security", 1, $headingBAB);
// //SUB BAB Security Device Availability
// $docx->addHeading("$idSub1BAB.$space_4 Security Device Availability", 3, $headingSub1BAB);
// $idSub1BAB++;
// $valuesTable = array(
//     array(
//         'Device', 'Availability', 'Remarks'
//     ), 
//     array(
//         'CCTV', '100%', '-'
//     ),
//     array(
//         'Access Door', '100%', '-'
//     ),
//     array(
//         'Fire System', '100%', '-'
//     )
// );
// $tableDeviceAvail = array(
//     'textAlign' => 'center',
//     'border' => 'single',
//     'borderWidth' => 10,
//     'textProperties' => array('bold' => true, 'font' => 'Cambira', 'fontSize' => 12),
//     'tableLayout' => 'autofit', // this is the default value
//     'tableWidth' => array('type' =>'pct', 'value' => 0),
//     'bold' => true,
//     'fontSize' => 12
// );
// $docx->addTable($valuesTable, $tableDeviceAvail);
// //END SUB BAB Security Device Availability
// $docx->addBreak(array('type' => 'line'));
// //SUB BAB Visitor Log
// $docx->addHeading("$idSub1BAB.$space_4 Visitor Log", 3, $headingSub1BAB);
// $idSub1BAB++;
// if($data_VisLogLobby->code == '404'){
//     $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada visitor log.';
//     $docx->addText($text, $commonText);
// }
// else{

// }
// //END SUB BAB Security Device Availability
// $docx->addBreak(array('type' => 'page'));
// //END BAB SECURITY


// //BAB CHANGE MANAGEMENT
// $romanIdBAB = integerToRoman($idBAB++); 
// $docx->addHeading("$romanIdBAB.$space_4 Change Management", 1, $headingBAB);
// if($data_CManagement->code == '404'){
//     $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada change management.';
//     $docx->addText($text, $commonText);
// }
// else{

// }
// $docx->addBreak(array('type' => 'page'));
// //END BAB CHANGE MANAGEMENT


// $idSub1BAB=1;
// //BAB INCIDENT LOG AND REQUEST
// $romanIdBAB = integerToRoman($idBAB++); 
// $docx->addHeading("$romanIdBAB.$space_4 Incident Log and Request", 1, $headingBAB);
// //SUB BAB Incident Log
// $docx->addHeading("$idSub1BAB.$space_4 Incident Log", 3, $headingSub1BAB);
// $idSub1BAB++;
// if($data_IncidentLog->code == '404'){
//     $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada incident log.';
//     $docx->addText($text, $commonText);
// }
// else{

// }
// //END SUB BAB Incident Log
// $docx->addBreak(array('type' => 'line'));
// //SUB BAB Request Log
// $docx->addHeading("$idSub1BAB.$space_4 Request Log", 3, $headingSub1BAB);
// $idSub1BAB++;
// if($data_RequestLog->code == '404'){
//     $text = 'Selama Bulan '.date('F Y', strtotime($report_period)).', tidak ada request log.';
//     $docx->addText($text, $commonText);
// }
// else{

// }
//END SUB BAB Request Log
// $docx->addBreak(array('type' => 'page'));
//END BAB INCIDENT LOG AND REQUEST


$docx->createDocx('output');
?>