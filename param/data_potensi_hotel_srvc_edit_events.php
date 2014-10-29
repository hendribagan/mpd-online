<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-4AFA8EA9
function BindEvents()
{
    global $t_vat_reg_dtl_hotel_srvcForm;
    global $CCSEvents;
    $t_vat_reg_dtl_hotel_srvcForm->ds->CCSEvents["AfterExecuteUpdate"] = "t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate";
    $t_vat_reg_dtl_hotel_srvcForm->ds->CCSEvents["AfterExecuteInsert"] = "t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert";
    $t_vat_reg_dtl_hotel_srvcForm->ds->CCSEvents["AfterExecuteDelete"] = "t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate @94-8D200D14
function t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate(& $sender)
{
    $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotel_srvcForm; //Compatibility
//End t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate

//Custom Code @818-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_hotel_srvcForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_hotel_srvcForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_hotel_srvcForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate @94-99A30EBD
    return $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate;
}
//End Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteUpdate

//t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert @94-AC4F7BFB
function t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert(& $sender)
{
    $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotel_srvcForm; //Compatibility
//End t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert

//Custom Code @869-2A29BDB7
// -------------------------
    // Write your own code here.
		$CustAccId = $t_vat_reg_dtl_hotel_srvcForm->t_cust_account_id->GetValue();
		$cusName = $t_vat_reg_dtl_hotel_srvcForm->customer_name->GetValue();
		$CustId = $t_vat_reg_dtl_hotel_srvcForm->t_customer_id->GetValue();
		$redirectloader = "data_potensi_update.php?t_cust_account_id=".$CustAccId."&customer_name=".$cusName."&t_customer_id=".$CustId."";
		echo ("<script language='javascript'>");
        echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
		echo (" window.close(); ");
		echo ("</script>");
		exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert @94-568ACF32
    return $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert;
}
//End Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteInsert

//t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete @94-4AC111CA
function t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete(& $sender)
{
    $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_reg_dtl_hotel_srvcForm; //Compatibility
//End t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete

//Custom Code @883-2A29BDB7
// -------------------------
    // Write your own code here.
	$id_vat = $t_vat_reg_dtl_hotel_srvcForm->t_cust_account_id->GetValue();
	$redirectloader = "data_potensi_update.php?t_cust_account_id=".$id_vat;
	echo ("<script language='javascript'>");
    echo (" parent.window.opener.location.href = '" . $redirectloader . "';");
	echo (" window.close(); ");
	echo ("</script>");
	exit;
// -------------------------
//End Custom Code

//Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete @94-0587A8CC
    return $t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete;
}
//End Close t_vat_reg_dtl_hotel_srvcForm_ds_AfterExecuteDelete

//Page_OnInitializeView @1-D0E4DC6C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $data_potensi_hotel_srvc_edit; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>
