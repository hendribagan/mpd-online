<?php
//Include Common Files @1-14EBB3A6
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_status_pelaporan_transaksi.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsGridt_status_pelaporan_transaksiGrid { //t_status_pelaporan_transaksiGrid class @2-79A3FB4B

//Variables @2-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @2-22E75F31
    function clsGridt_status_pelaporan_transaksiGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_status_pelaporan_transaksiGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_status_pelaporan_transaksiGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_status_pelaporan_transaksiGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->jml = & new clsControl(ccsLabel, "jml", "jml", ccsText, "", CCGetRequestParam("jml", ccsGet, NULL), $this);
        $this->status_lapor = & new clsControl(ccsLink, "status_lapor", "status_lapor", ccsText, "", CCGetRequestParam("status_lapor", ccsGet, NULL), $this);
        $this->status_lapor->Page = "t_status_pelaporan_transaksi_sudah_lapor.php";
        $this->status = & new clsControl(ccsHidden, "status", "status", ccsText, "", CCGetRequestParam("status", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-E28CB72C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["jml"] = $this->jml->Visible;
            $this->ControlsVisible["status_lapor"] = $this->status_lapor->Visible;
            $this->ControlsVisible["status"] = $this->status->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->jml->SetValue($this->DataSource->jml->GetValue());
                $this->status_lapor->SetValue($this->DataSource->status_lapor->GetValue());
                $this->status_lapor->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->status_lapor->Parameters = CCAddParam($this->status_lapor->Parameters, "p_finance_period_id", CCGetFromGet("p_finance_period_id", NULL));
                $this->status_lapor->Parameters = CCAddParam($this->status_lapor->Parameters, "status_lapor", $this->DataSource->f("status_lapor"));
                $this->status->SetValue($this->DataSource->status->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->jml->Show();
                $this->status_lapor->Show();
                $this->status->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->p_finance_period_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-FC448A41
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->jml->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status_lapor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_status_pelaporan_transaksiGrid Class @2-FCB6E20C

class clst_status_pelaporan_transaksiGridDataSource extends clsDBConnSIKP {  //t_status_pelaporan_transaksiGridDataSource Class @2-1F2FCF3E

//DataSource Variables @2-EC943E37
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $jml;
    var $status_lapor;
    var $status;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BFE31402
    function clst_status_pelaporan_transaksiGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_status_pelaporan_transaksiGrid";
        $this->Initialize();
        $this->jml = new clsField("jml", ccsText, "");
        
        $this->status_lapor = new clsField("status_lapor", ccsText, "");
        
        $this->status = new clsField("status", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-87BF4B13
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $this->Parameters["urlp_finance_period_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-2DBC60AB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select STATUS_LAPOR , JML\n" .
        "from \n" .
        "(\n" .
        "select 'SUDAH LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   ) \n" .
        "  )\n" .
        "UNION ALL\n" .
        "select 'BELUM LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where not exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   )\n" .
        "  )\n" .
        ")\n" .
        ") cnt";
        $this->SQL = "select STATUS_LAPOR , JML\n" .
        "from \n" .
        "(\n" .
        "select 'SUDAH LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   ) \n" .
        "  )\n" .
        "UNION ALL\n" .
        "select 'BELUM LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where not exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   )\n" .
        "  )\n" .
        ")\n" .
        "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-ABFBB5EB
    function SetValues()
    {
        $this->jml->SetDBValue($this->f("jml"));
        $this->status_lapor->SetDBValue($this->f("status_lapor"));
        $this->status->SetDBValue($this->f("status_lapor"));
    }
//End SetValues Method

} //End t_status_pelaporan_transaksiGridDataSource Class @2-FCB6E20C

class clsRecordt_status_pelaporan_transaksiSearch { //t_status_pelaporan_transaksiSearch Class @3-48D332F1

//Variables @3-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @3-6C3AE84F
    function clsRecordt_status_pelaporan_transaksiSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_status_pelaporan_transaksiSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_status_pelaporan_transaksiSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->code_period = & new clsControl(ccsTextBox, "code_period", "code_period", ccsText, "", CCGetRequestParam("code_period", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-2D4957E0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->code_period->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->code_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-B5974DB5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->code_period->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @3-26D616D9
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "t_status_pelaporan_transaksi.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_status_pelaporan_transaksi.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-FD546800
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->code_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->code_period->Show();
        $this->Button_DoSearch->Show();
        $this->p_finance_period_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_status_pelaporan_transaksiSearch Class @3-FCB6E20C

//Initialize Page @1-7333A051
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "t_status_pelaporan_transaksi.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-20CC7042
include_once("./t_status_pelaporan_transaksi_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4AAD5717
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_status_pelaporan_transaksiGrid = & new clsGridt_status_pelaporan_transaksiGrid("", $MainPage);
$transaksi = & new clsFlashChart("transaksi", $MainPage);
$transaksi->CallbackParameter = "t_status_pelaporan_transaksitransaksi";
$transaksi->Title = "Status Pelaporan Transaksi";
$transaksi->Width = 700;
$transaksi->Height = 300;
$t_status_pelaporan_transaksiSearch = & new clsRecordt_status_pelaporan_transaksiSearch("", $MainPage);
$MainPage->t_status_pelaporan_transaksiGrid = & $t_status_pelaporan_transaksiGrid;
$MainPage->transaksi = & $transaksi;
$MainPage->t_status_pelaporan_transaksiSearch = & $t_status_pelaporan_transaksiSearch;
$t_status_pelaporan_transaksiGrid->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-64EFC5C7
$t_status_pelaporan_transaksiSearch->Operation();
//End Execute Components

//Go to destination page @1-F8A04F5F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_status_pelaporan_transaksiGrid);
    unset($t_status_pelaporan_transaksiSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C1D2F3B5
$t_status_pelaporan_transaksiGrid->Show();
$transaksi->Show();
$t_status_pelaporan_transaksiSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-77040310
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_status_pelaporan_transaksiGrid);
unset($t_status_pelaporan_transaksiSearch);
unset($Tpl);
//End Unload Page


?>
