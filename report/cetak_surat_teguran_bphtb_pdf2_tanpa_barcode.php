<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_surat_teguran_bphtb_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_bphtb_registration_id = CCGetFromGet("t_bphtb_registration_id", "");
$date_start = CCGetFromGet("date_start", "");
$date_end = CCGetFromGet("date_end", "");

$param_arr = array();
$param_arr['date_start'] = $date_start;
$param_arr['date_end'] = $date_end;

$dbConn	= new clsDBConnSIKP();

$dbConn2	= new clsDBConnSIKP();

$query2 = "SELECT value from sikp.p_global_param where code ='NOMOR_SURAT_KONFIRMASI'";

$dbConn2->query($query2);
$nomor_surat = "";

while ($dbConn2->next_record()) {
	$nomor_surat = $dbConn2->f("value");
}

$dbConn2->close();
//*/
						
$whereClause='';
if(!empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
	$whereClause.= " AND (trunc(reg_bphtb.creation_date) BETWEEN '".$param_arr['date_start']."'";
	$whereClause.= " AND '".$param_arr['date_end']."')";
}else if(!empty($param_arr['date_start'])&&empty($param_arr['date_end'])){
	$whereClause.= " AND trunc(reg_bphtb.creation_date) >= '".$param_arr['date_start']."'";
}else if(empty($param_arr['date_start'])&&!empty($param_arr['date_end'])){
	$whereClause.= " AND trunc(reg_bphtb.creation_date) <= '".$param_arr['date_end']."'";
}

$whereClause.= " AND NOT EXISTS (SELECT 1 FROM t_payment_receipt_bphtb as x WHERE x.t_bphtb_registration_id = reg_bphtb.t_bphtb_registration_id) ";

$query = "SELECT
	reg_bphtb.t_bphtb_registration_id,
	reg_bphtb.npwp,
	reg_bphtb.wp_address_name,
	to_char(reg_bphtb.creation_date, 'YYYY-MM-DD') as creation_date,
	registration_no,
	wp_name,
	reg_bphtb.p_bphtb_legal_doc_type_id,
	bphtb_doc.description,
	njop_pbb,
	land_area,
	land_total_price,
	building_area,
	building_total_price,
	market_price,
	bphtb_amt_final,
	object_address_name,
	region.region_name,
	kec.region_name as kec,
	kel.region_name as kel,
	reg_bphtb.wp_rt,
	reg_bphtb.wp_rw
FROM
	sikp.t_bphtb_registration reg_bphtb
LEFT JOIN p_bphtb_legal_doc_type bphtb_doc on bphtb_doc.p_bphtb_legal_doc_type_id = reg_bphtb.p_bphtb_legal_doc_type_id
LEFT JOIN t_customer_order cust_order ON cust_order.t_customer_order_id = reg_bphtb.t_customer_order_id 
LEFT JOIN t_payment_receipt_bphtb payment ON reg_bphtb.t_bphtb_registration_id = payment.t_bphtb_registration_id 
LEFT JOIN p_region region ON region.p_region_id = reg_bphtb.wp_p_region_id 
LEFT JOIN p_region kec ON kec.p_region_id = reg_bphtb.wp_p_region_id_kec
LEFT JOIN p_region kel ON kec.p_region_id = reg_bphtb.wp_p_region_id_kel
WHERE cust_order.p_order_status_id <> 1";
$query.= $whereClause;

if(!empty($t_bphtb_registration_id)) {
	$query.= " AND reg_bphtb.t_bphtb_registration_id = ".$t_bphtb_registration_id;
}

$query.= " order by trunc(reg_bphtb.creation_date) ASC,upper(wp_name) ASC";

$dbConn->query($query);

$data = array();
while ($dbConn->next_record()) {
	$data[] = array (
	    'creation_date' => $dbConn->f("creation_date"), 	
		'npwp' => $dbConn->f("npwp"), 	
		'wp_address_name' => $dbConn->f("wp_address_name"), 	
		'registration_no' => $dbConn->f("registration_no"),
		'wp_name' => $dbConn->f("wp_name"),
		'p_bphtb_legal_doc_type_id' => $dbConn->f("p_bphtb_legal_doc_type_id"),
		'description' => $dbConn->f("description"),
		'njop_pbb' => $dbConn->f("njop_pbb"),
		'land_area' => $dbConn->f("land_area"),
		'land_total_price' => $dbConn->f("land_total_price"),
		'building_area' => $dbConn->f("building_area"),
		'building_total_price' => $dbConn->f("building_total_price"),
		'market_price' => $dbConn->f("market_price"),
		'bphtb_amt_final' => $dbConn->f("bphtb_amt_final"),
		'object_address_name' => $dbConn->f("object_address_name"),
		'region_name' => $dbConn->f("region_name"),
		'kec' => $dbConn->f("kec"),
		'kel' => $dbConn->f("kel"),
		'wp_rt' => $dbConn->f("wp_rt"),
		'wp_rw' => $dbConn->f("wp_rw"),
		'nomor_surat' => $nomor_surat 
	);
}

$dbConn->close();


class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'BKANT';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 241.3;
	var $paperHSize = 279.4;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
		$this->lMargin = 30;
	}
	
	function __construct() {
		$this->FormCetak();
		$this->startY = $this->GetY();
		$this->startX = $this->paperWSize-42;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data,$no_urut) {
		$this->AliasNbPages();
		$this->SetLeftMargin(10);
		$this->AddPage("P");
		$this->AddFont('BKANT');
		
		$this->SetFont('BKANT', '', 12);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->SetFont('BKANT', '', 12);

		$this->Image('../images/logo_pemda.png',17,13,25,25);

		$this->SetFont('TIMES', 'B', 14);
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(181, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
		
		$this->Ln();
		$this->SetFont('TIMES', 'B', 20);
		$this->Cell(40, $this->height+10, "", "", 0, 'L');
		$this->Cell(181, $this->height+10, "D I N A S  P E L A Y A N A N  P A J A K", "", 0, 'C');
		
		$this->Ln();
		$this->SetFont('BKANT', '', 12);
		$this->Cell(40, $this->height, "", "", 0, 'L');
		$this->Cell(181, $this->height, "Jalan Wastukancana No 2 Telp. 022 4235052 - Bandung", "", 0, 'C');

		$this->Ln(5);
		$this->Ln();
		
		$this->SetFont('BKANT', '', 12);
		$this->Cell($this->lengthCell, $this->height, "", "T", 100, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;

		$this->SetWidths(array(21,2,38,49));
		$this->SetAligns(array("L","L","L","L"));
		$posy = $this->getY();
		$data["letter_no"] = trim($data["letter_no"]);
		if(!empty($data["letter_no"])){
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					/*$data["letter_no"]."-".$no_urut*/"",
					"-Disyanjak"
				),
				array("",
					"",
					"",
					""
				),
				2
			);
		}else{
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					"",
					"-Disyanjak"
				),
				array("",
					"",
					"",
					""
				),
				2
			);
		}

		$this->SetWidths(array(21,2,$this->lengthCell-22));
		$this->SetAligns(array("L","L","L"));
		$posy = $this->getY();

		$this->RowMultiBorderWithHeight(
			array("Sifat",
				":",
				"  Biasa"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->RowMultiBorderWithHeight(
			array("Lampiran",
				":",
				"  -"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->RowMultiBorderWithHeight(
			array("Perihal",
				":",
				"  Konfirmasi Pembayaran BPHTB"
			),
			array("",
				"",
				""
			),
			2
		);

		$this->setY($posy-12);
		$today = getdate();
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3+20;
		
		$this->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2-60, $this->height, "Bandung,", "", 0, 'L');
		$this->Cell(30, $this->height, dateToday(), "", 0, 'R');
		$this->Ln();

		$this->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth.", "", 0, 'L');
		$this->Ln();

		$this->SetAligns(array("L","L"));
		$this->SetWidths(array($lkepada3 - 20,"85"));
		$this->RowMultiBorderWithHeight(
			array("",
				substr($data['wp_name'],0, 23)
			),
			array("",
				""
			),
			$this->height
		);
		
		$this->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "", 0, 'L');
		$this->Ln();

		$this->SetAligns(array("L","L"));
		$this->SetWidths(array($lkepada3 - 20,"85"));
		$this->RowMultiBorderWithHeight(
			array("",
				$data['wp_address_name'].", RT ".$data['wp_rt']."/ RW ".$data['wp_rw']
			),
			array("",
				""
			),
			$this->height
		);

		$this->SetAligns(array("L","L"));
		$this->SetWidths(array($lkepada3 - 20,"85"));
		$this->RowMultiBorderWithHeight(
			array("",
				"KEC. ".$data['kec']
			),
			array("",
				""
			),
			$this->height
		);

		$this->Cell($lkepada3-20, $this->height, "", "", 0, 'L');
		$pieces = explode("KABUPATEN ", $data['region_name']);
		$result = join("",$pieces);
		$pieces = explode("KOTA ", $result);
		$result = join("",$pieces);
		$pieces = explode(" KOTA", $result);
		$result = join("",$pieces);
		
				
		$this->Cell(85, $this->height, $result, "", 0, 'L');
		$this->Ln();$this->Ln();
		
		
		$this->SetFont('BKANT', '', 12);
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("25",200));
		$this->RowMultiBorderWithHeight(
			array("","Disampaikan dengan hormat, berdasarkan data pembukuan Dinas Pelayanan Pajak Kota Bandung hingga saat ini tercatat, bahwa objek pajak :"
			),
			array("",""
			),
			5
		);

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("35","55","5",""));
		$this->RowMultiBorderWithHeight(
			array("",
				"Alamat\n".
				"NOP",
				":\n".":",
				$data['object_address_name']."\n".$data['njop_pbb']
			),
			array("",
				"",
				"",
				""
			),
			5
		);
		
		$this->SetWidths(array(25,170));
		$this->RowMultiBorderWithHeight(
			array("","Belum melakukan pembayaran pajak BPHTB Tahun ".date("Y")." dengan Nilai sebesar"
			),
			array("",""
			),
			5
		);

		$this->SetWidths(array(25,170));
		$this->RowMultiBorderWithHeight(
			array("","Rp. ".number_format($data['bphtb_amt_final'],2,",",".")." sesuai dengan : "
			),
			array("",""
			),
			5
		);
		
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("35","55","5",""));
		$this->RowMultiBorderWithHeight(
			array("","Nota Verifikasi BPHTB\n".
				"No Registrasi\n".
				"Tanggal",
				"\n:"."\n:",
				"\n".$data['registration_no']	.
				"\n".dateToString($data['creation_date'])
			),
			array("",
			"","",""
			),
			5
		);

		$this->SetWidths(array(25,180));
		$this->RowMultiBorderWithHeight(
			array("","Berkenaan dengan hal tersebut di atas, dimohon untuk hadir memberikan penjelasan tentang realisasi pembayaran pajak BPHTB dimaksud selambat-lambatnya 2 (dua) hari setelah diterimanya surat ini, pada :"
			),
			array("",""
			),
			5
		);		
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array("35","55","5","163"));
		$this->RowMultiBorderWithHeight(
			array("",
				"Tempat",
				":",
				"Seksi Penyelesaian Piutang Pajak Bidang Pajak Pendaftaran\n".
				"DINAS PELAYANAN PAJAK Kota Bandung\n".
				"Jl. Wastukencana No. 2 Bandung."
			),
			array("",
				"",
				"",
				""
			),
			5
		);
		$this->RowMultiBorderWithHeight(
			array("",
				"Jam",
				":",
				"08.00 s.d 16.00 WIB" 
			),
			array("",
				"",
				"",
				""
			),
			5
		);
		
		$this->SetWidths(array(25,180));
		$this->RowMultiBorderWithHeight(
			array("","Apabila saudara/i tidak menyampaikan konfirmasi dilakukan lebih dari 2 (dua) hari setelah diterimanya surat ini atau tidak dilakukan sama sekali konfirmasi. Maka Nota Verifikasi tersebut dinyatakan tidak berlaku dan harus diperbaharui kembali."
			),
			array("",""
			),
			5
		);
		$this->RowMultiBorderWithHeight(
			array("","Demikian agar menjadi maklum, atas perhatian dan kerjasamanya diucapkan terima kasih."
			),
			array("",""
			),
			5
		);
		$ltable = ($this->lengthCell - 15) / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;

		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');

		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		//$this->Image('../images/ttd_pa_soni.jpg',$lbody2+$lbody4+$lbody4-20,203,$lbody4+48,20);
		
		/*$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.
		$data['njop_pbb']."_".
		$data['registration_no']."_".
		str_replace(" ","-",dateToString($data['creation_date']))
		,160,195,25,25,'PNG');*/
		$this->SetFont('Times', 'B', 12);
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "an. KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Times', 'B', 12);
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();

		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Times', 'B', 12);
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4+10, $this->height, "H. SONI BAKHTIYAR, S.Sos, M.Si", "B", 0, 'C');
		$this->Cell($lbody4+10, $this->height, "Drs. H. GUN GUN SUMARYANA", "B", 0, 'C');
		$this->Cell($lbody2-5, $this->height, "", "", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Times', 'B', 12);
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		//$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
		$this->Cell($lbody4 - 2, $this->height, "NIP. 19700806 199101 1 001", "", 0, 'C'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "", 0, 'C');
		$this->Ln();

		

		$this->SetFont('Times', 'BU', 12);
		$this->Ln();
		$this->Cell(3, $this->height, "", "", 0, 'L');
		$this->Cell("21", $this->height, "Tembusan,", "", 0, 'L');
		$this->SetFont('BKANT', '', 12);
		$this->Cell("", $this->height, "disampaikan kepada Yth. :", "", 0, 'L');
		$this->Ln();
		$this->SetFont('BKANT', '', 12);
		$this->Cell(3, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "1. Bapak Kepala Dinas Pelayanan Pajak (sebagai laporan);", "", 0, 'L');
		$this->Ln();
		$this->Cell(3, $this->height, "", "", 0, 'L');
		$this->Cell("", $this->height, "2. Bapak Kepala Badan Pertanahan Kota Bandung.", "", 0, 'L');
	}

	function CellFJ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='')
	{
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
		{
			$x=$this->x;
			$ws=$this->ws;
			if($ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			if($ws>0)
			{
				$this->ws=$ws;
				$this->_out(sprintf('%.3f Tw', $ws*$k));
			}
		}
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$s='';
		if($fill==1 or $border==1)
		{
			if($fill==1)
				$op=($border==1) ? 'B' : 'f';
			else
				$op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
		}
		if(is_string($border))
		{
			$x=$this->x;
			$y=$this->y;
			if(is_int(strpos($border, 'L')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'T')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
			if(is_int(strpos($border, 'R')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'B')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
		}
		if($txt!='')
		{
			if($align=='R')
				$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C')
				$dx=($w-$this->GetStringWidth($txt))/2;
			elseif($align=='FJ')
			{
				//Set word spacing
				$wmax=($w-2*$this->cMargin);
				$this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt, ' ');
				$this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
				$dx=$this->cMargin;
			}
			else
				$dx=$this->cMargin;
			$txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
			if($this->ColorFlag)
				$s.='q '.$this->TextColor.' ';
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt);
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
			if($this->ColorFlag)
				$s.=' Q';
			if($link)
			{
				if($align=='FJ')
					$wlink=$wmax;
				else
					$wlink=$this->GetStringWidth($txt);
				$this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $wlink, $this->FontSize, $link);
			}
		}
		if($s)
			$this->_out($s);
		if($align=='FJ')
		{
			//Remove word spacing
			$this->_out('0 Tw');
			$this->ws=0;
		}
		$this->lasth=$h;
		if($ln>0)
		{
			$this->y+=$h;
			if($ln==1)
				$this->x=$this->lMargin;
		}
		else
			$this->x+=$w;
	}

	function tulis($text, $align){
		$this->Cell(25, $this->height, "", "", 0, 'C');
		$this->CellFJ(189, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Ln();
	}

	function tulis2($text, $align){
		$this->Cell(34, $this->height, "", "", 0, 'C');
		$this->CellFJ(175, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "", 0, 'C');
		$this->Ln();
	}
	
	function newLine(){
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
	}
	
	function kotakKosong($pembilang, $penyebut, $jumlahKotak){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, "", "LR", 0, 'L');
		}
	}
	
	function kotak($pembilang, $penyebut, $jumlahKotak, $isi){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, $isi, "TBLR", 0, 'C');
		}
	}
	
	function getNumberFormat($number, $dec) {
			if (!empty($number)) {
				return number_format($number, $dec);
			} else {
				return "";
			}
	}
	
	function SetWidths($w)
	{
	    //Set the array of column widths
	    $this->widths=$w;
	}

	function SetAligns($a)
	{
	    //Set the array of column alignments
	    $this->aligns=$a;
	}

	function Row($data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x, $y, $w, $h);
	        //Print the text
	        $this->MultiCell($w, 5, $data[$i], 0, $a);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w, $y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}

	function CheckPageBreak($h)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}
	
	function RowMultiBorderWithHeight($data, $border = array(),$height)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$height*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$this->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$this->SetXY($x,$y);
			//Print the text
			$this->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function NbLines($w, $txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r", '', $txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	
	function Footer() {
		
	}
	
	function __destruct() {
		return null;
	}
}
function dateToString($tanggal){
	if(empty($tanggal)) return "";
	
	$monthname = array(0  => '-',
	                   1  => 'Januari',
	                   2  => 'Februari',
	                   3  => 'Maret',
	                   4  => 'April',
	                   5  => 'Mei',
	                   6  => 'Juni',
	                   7  => 'Juli',
	                   8  => 'Agustus',
	                   9  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode('-', $tanggal);
	
	return $pieces[2].' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}

function dateToday(){
	$tanggal=date("m Y");
	if(empty($tanggal)) return "";
	
	$monthname = array(0  => '-',
	                   01  => 'Januari',
	                   02  => 'Februari',
	                   03  => 'Maret',
	                   04  => 'April',
	                   05  => 'Mei',
	                   06  => 'Juni',
	                   07  => 'Juli',
	                   08  => 'Agustus',
	                   09  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode(' ', $tanggal);
	
	return $monthname[(int)$pieces[0]].' '.$pieces[1];
}

$formulir = new FormCetak();
$no_urut=0;
foreach($data as $item){
	$formulir->PageCetak($item,$no_urut);
	$no_urut++;
}
$formulir->Output();

?>
