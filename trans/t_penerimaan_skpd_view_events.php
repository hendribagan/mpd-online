<?php
//BindEvents Method @1-3161CB68
function BindEvents()
{
    global $t_penerimaan_skpd_viewGrid;
    global $CCSEvents;
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeShowRow"] = "t_penerimaan_skpd_viewGrid_BeforeShowRow";
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeShow"] = "t_penerimaan_skpd_viewGrid_BeforeShow";
    $t_penerimaan_skpd_viewGrid->CCSEvents["BeforeSelect"] = "t_penerimaan_skpd_viewGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_penerimaan_skpd_viewGrid_BeforeShowRow @2-452F3386
function t_penerimaan_skpd_viewGrid_BeforeShowRow(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeShowRow

//Set Row Style @87-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @251-2A29BDB7
// -------------------------
    // Write your own code here.
	if ($Component->DataSource->p_vat_type_id->GetValue()==8){
		$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pbb/pokok/'.date("d-m-Y"));
		$ws_data = json_decode($ws_data);
		$t_penerimaan_skpd_viewGrid->payment_vat_amount->SetValue(str_replace('.','',$ws_data->nilai));
		//print_r(str_replace('.','',$ws_data->nilai));exit;
	}
	if ($Component->DataSource->p_vat_type_id->GetValue()==9){
		$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/reklame/pokok/'.date("d-m-Y"));
		$ws_data = json_decode($ws_data);
		$t_penerimaan_skpd_viewGrid->payment_vat_amount->SetValue(str_replace('.','',$ws_data->nilai));
		//print_r(str_replace('.','',$ws_data->nilai));exit;
	}
	if ($Component->DataSource->p_vat_type_id->GetValue()==10){
		$ws_data = file_get_contents('http://49.236.219.74/wsrealpbb/realisasi/index/pat/pokok/'.date("d-m-Y"));
		$ws_data = json_decode($ws_data);
		$t_penerimaan_skpd_viewGrid->payment_vat_amount->SetValue(str_replace('.','',$ws_data->nilai));
		//print_r(str_replace('.','',$ws_data->nilai));exit;
	}
// -------------------------
//End Custom Code
	$nilai_penerimaan = $t_penerimaan_skpd_viewGrid->payment_vat_amount->GetValue();

	$sum_penerimaan = $t_penerimaan_skpd_viewGrid->total_penerimaan->GetValue();
	$t_penerimaan_skpd_viewGrid->total_penerimaan->SetValue($sum_penerimaan + $nilai_penerimaan);
//Close t_penerimaan_skpd_viewGrid_BeforeShowRow @2-2BD69E2A
    return $t_penerimaan_skpd_viewGrid_BeforeShowRow;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeShowRow

//t_penerimaan_skpd_viewGrid_BeforeShow @2-2C0E94EA
function t_penerimaan_skpd_viewGrid_BeforeShow(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeShow

//Custom Code @88-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_penerimaan_skpd_viewGrid_BeforeShow @2-D2796E39
    return $t_penerimaan_skpd_viewGrid_BeforeShow;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeShow

//t_penerimaan_skpd_viewGrid_BeforeSelect @2-CD1030F3
function t_penerimaan_skpd_viewGrid_BeforeSelect(& $sender)
{
    $t_penerimaan_skpd_viewGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_viewGrid; //Compatibility
//End t_penerimaan_skpd_viewGrid_BeforeSelect

//Custom Code @183-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_penerimaan_skpd_viewGrid_BeforeSelect @2-0B5A2894
    return $t_penerimaan_skpd_viewGrid_BeforeSelect;
}
//End Close t_penerimaan_skpd_viewGrid_BeforeSelect

//Page_OnInitializeView @1-19B9069A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_penerimaan_skpd_view; //Compatibility
//End Page_OnInitializeView

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>
