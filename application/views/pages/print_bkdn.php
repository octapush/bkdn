<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/bootstrap/easyui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/icon.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/demo/demo.css'); ?>">
    <script type="text/javascript" src="<?php echo base_url('public/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/jquery.easyui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/core.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/js/globalurl.js'); ?>"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/themes_smoothness_jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('misc/global/plugins/select2-4.0.3/css/select2.css'); ?>">
</head>
<style type="text/css">
	body{
		font-family: 'arial' !important;
	}
	.text-underline{
		text-decoration: underline;
	}
	.text-wrap{

	}
	.logo{
		position: absolute;
		top: 120px;
		left: 50px;
		width: 185px;
		height: 121px;
		background-image: url("../../public/logo/logo_bkdn.png");
		background-repeat: no-repeat;
		z-index: 999;
	}
	table#tbldetail{
		border-collapse: collapse;
		border:solid 1px #EEE;
		width: 100%;
	}
	table#tbldetail>tr>td{
		border:solid 1px #EEE;
	}
</style>
<body>
<img class="logo"></img>
<fieldset id="frmFieldSet">
	<legend>PRINT FORM REGISTER</legend>
	 <div style="margin-bottom:20px">
		<label>Cari Nomor Kontrak : </label><select name="search" id="search" class="select2" style="width:300px"></select>
		<button id="btnSearch" class="easyui-linkbutton">Search</button>
    </div>
</fieldset>
<table style="width: 100%">
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td align="center" colspan="10"><h3>PT. PEMBANGUNAN PERUMAHAN (PERSERO)</h3></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>DIVISI (DIVISION)</td>
		<td>: EPC</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PROYEK (PROJECT)</td>
		<td>: PLTG (peaker) 100 MW Gorontalo</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>ALAMAT (ADDRESS)</td>
		<td>: Desa Maleo, Kecamatan Paguat, Kab Pohuwatu, Provinsi Gorontalo</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="10" align="center" valign="top"><h3><b style="text-decoration: underline;">SURAT PERJANJIAN PENGANGKUTAN</b><br>(TRANSPORTATION AGREEMENT)</h3></td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td colspan="10" align="center" style="height: 10px;" id="no_kontrak"></div></td>
	</tr>
	<tr>
		<td></td>
		<td>1.</td>
		<td>Kepada (to)</td>
		<td colspan="3" id="customer_name"></div></td>
		<td colspan="3" id="begindate"></td>
	</tr>
	<tr>
		<td></td>
		<td>3.</td>
		<td>Alamat Subkon (Subcontractor's Address)</td>
		<td colspan="7"><label id="customer_address"></label></td>
	</tr>
	<tr>
		<td></td>
		<td>4.</td>
		<td>Nilai Kontrak (Contract Amount)</td>
		<td colspan="7" id="total_amount"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="8">&nbsp;&nbsp; Harga bersifat lumpsum fix price</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="8">&nbsp;&nbsp; Harga sudah termasuk PPn 10%</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td colspan="8">&nbsp;&nbsp; Harga sudah termasuk PPh 2%</td>
	</tr>
	<tr>
		<td colspan="10"></td>
	</tr>
	<tr>
		<td></td>
		<td>5.</td>
		<td>Waktu Pelaksanaan Pekerjaan (Contract Period)</td>
		<td colspan="7" id="begdaEnda"></td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">6.</td>
		<td valign="top">Lingkup Pekerjaan (Scope Of Work)</td>
		<td colspan="7" valign="top" id="lingkup_pekerjaan"></td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">7.</td>
		<td valign="top">Dasar Pelaksanaan Pekerjaan (Basic of Work Execution)</td>
		<td colspan="7" valign="top" id="dasar_pelaksanaan_pekerjaan"></td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">8.</td>
		<td valign="top">Cara Pembayaran (Payment Method)</td>
		<td colspan="7" valign="top">: Reguler / TT
			<div id="cara_pembayaran"></div>
		</td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">9.</td>
		<td valign="top">Pelaksanaan Pekerjaan</td>
		<td colspan="7" valign="top" id="pelaksanaan_pekerjaan"></td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">10.</td>
		<td valign="top">Asuransi & Jaminan Pelaksanaan</td>
		<td colspan="7" valign="top" id="asuransi_dan_jaminan"></td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">11.</td>
		<td valign="top">Uraian Nilai Pekerjaan (Contract Value Description)</td>
		<td colspan="7" valign="top"></td>
	</tr>
	<tr>
		<td colspan="10">
			<table border="1" id="tbldetail">
				<thead>
					<tr style="padding: 10px;font-weight: bold">
						<td valign="top">No (No)</td>
						<td valign="top">8. Banyaknya (Quantity)</td>
						<td valign="top">9. Deskripsi (Description)</td>
						<td valign="top">10. Spesifikasi Standard (Specification & Standard)</td>
						<td valign="top">11. Harga Satuan (Unit Price)</td>
						<td valign="top">12. Jumlah (Amount)</td>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td valign="top">12.</td>
		<td valign="top">Lain-Lain (Miscellanous)</td>
		<td colspan="7" valign="top" id="lain_lain"></td>
	</tr>
	<tr><td colspan="10"><hr/></td></tr>
	<tr>
		<td colspan="4" align="center" valign="top">Yang Menerima Order</td>
		<td></td>
		<td></td>
		<td colspan="4" align="center" valign="top">Yang Memberi Order</td>
	</tr>
	<tr>
		<td colspan="4" align="center" id="nama_perusahaan" valign="top"></td>
		<td></td>
		<td></td>
		<td colspan="4" align="center" valign="top">PT. PEMBANGUNAN PERUMAHAN (PERSERO)</td>
	</tr>

	<tr><td colspan="10" style="height: 10px"></td></tr>
	<tr><td colspan="10" style="height: 10px"></td></tr>
	<tr><td colspan="10" style="height: 10px"></td></tr>
	<tr><td colspan="10" style="height: 10px"></td></tr>
	<tr><td colspan="10" style="height: 10px"></td></tr>
	<tr>
		<td colspan="4" align="center"><i style="text-decoration: underline;"><b>Direktur</b></i></td>
		<td></td>
		<td colspan="2" align="center" valign="top"><i style="text-decoration: underline;"><b>Ir. Abdul Haris Tatang</b></i><br>Kepala Divisi EPC </td>
		<td colspan="4" align="center" valign="top"><i style="text-decoration: underline;"><b>Mochamad Ichsan</b></i><br>Project Manager</td>
	</tr>
</table>
</body>
<script type="text/javascript" src="<?php echo base_url('misc/global/plugins/select2-4.0.3/js/select2.full.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/master/print_bkdn.js"); ?>"></script>
</html>