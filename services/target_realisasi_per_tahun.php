<?php
//Include Common Files @1-EC63A944
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "target_realisasi_per_tahun.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridselect_from_v_revenue_tar { //select_from_v_revenue_tar class @2-23ACC1D2

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

//Class_Initialize Event @2-D4523F20
    function clsGridselect_from_v_revenue_tar($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "select_from_v_revenue_tar";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid select_from_v_revenue_tar";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsselect_from_v_revenue_tarDataSource($this);
        $this->ds = & $this->DataSource;

        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, "", CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, "", CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->year_code = & new clsControl(ccsLabel, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-0ABCED3F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);

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
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["year_code"] = $this->year_code->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->year_code->SetValue($this->DataSource->year_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_amount->Show();
                $this->realisasi_amt->Show();
                $this->vat_code->Show();
                $this->year_code->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-ECD588E8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->year_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End select_from_v_revenue_tar Class @2-FCB6E20C

class clsselect_from_v_revenue_tarDataSource extends clsDBConnSIKP {  //select_from_v_revenue_tarDataSource Class @2-3A54C8F3

//DataSource Variables @2-954DBDCA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $target_amount;
    var $realisasi_amt;
    var $vat_code;
    var $year_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9AD072C3
    function clsselect_from_v_revenue_tarDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid select_from_v_revenue_tar";
        $this->Initialize();
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->year_code = new clsField("year_code", ccsText, "");
        

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

//Prepare Method @2-52B18169
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", "", $this->Parameters["urlt_revenue_target_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-7AC0A0F5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT target_amount, realisasi_amt, vat_code, year_code\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE t_revenue_target_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ") cnt";
        $this->SQL = "SELECT target_amount, realisasi_amt, vat_code, year_code\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE t_revenue_target_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6E2202A4
    function SetValues()
    {
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->year_code->SetDBValue($this->f("year_code"));
    }
//End SetValues Method

} //End select_from_v_revenue_tarDataSource Class @2-FCB6E20C

//Initialize Page @1-15034ED3
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
$TemplateFileName = "target_realisasi_per_tahun.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-64A1366B
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$select_from_v_revenue_tar = & new clsGridselect_from_v_revenue_tar("", $MainPage);
$MainPage->select_from_v_revenue_tar = & $select_from_v_revenue_tar;
$select_from_v_revenue_tar->Initialize();

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

//Go to destination page @1-7D8BF207
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($select_from_v_revenue_tar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-36B067D2
$select_from_v_revenue_tar->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6C6AB763
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($select_from_v_revenue_tar);
unset($Tpl);
//End Unload Page


?>
