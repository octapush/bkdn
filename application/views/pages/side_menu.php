<?php 
$employee 		= $this->session->userdata('employee');
$pj 			= $this->session->userdata('pj');
$customer 		= $this->session->userdata('customer');
$emailtmpl		= $this->session->userdata('emailtmpl');

$registerbkdn 	= $this->session->userdata('registerbkdn');
$registercom 	= $this->session->userdata('registercom');
$invoice		= $this->session->userdata('invoice');


$master 		= 
				'<div title="MASTER" style="padding:10px">'.
			  	'<ul class="easyui-datalist side-menu">'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/employee').'"><b>&nbsp;Employee</b></a>'.
			  	'</li>'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/pj').'"><b>&nbsp;Jenis Perjanjian</b></a>'.
			  	'</li>'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/customer').'"><b>&nbsp;Customer</b></a>'.
			  	'</li>'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/emailtmpl').'"><b>&nbsp;Email Template</b></a>'.
			  	'</li>'.
			  	'</ul>'.
			  	'</div>';

$transaksi 		= 
				'<div title="TRANSAKSI" style="padding:10px">'.
			  	'<ul class="easyui-datalist side-menu">'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/registercom').'"><b>&nbsp;Add Registrasi</b></a>'.
			  	'</li>'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/registerbkdn').'"><b>&nbsp;Detail Registrasi</b></a>'.
			  	'</li>'.
			  	'<li>'.
			  	'<a class="menu-child" href="'.site_url('pages/invoice').'"><b>&nbsp;Invoice</b></a>'.
			  	'</li>'.
			  	'</ul>'.
			  	'</div>';


$totalMaster 	= intval(empty($employee)?0:$employee)+intval(empty($pj)?0:$pj)+intval(empty($customer)?0:$customer)+intval(empty($emailtmpl)?0:$emailtmpl);
if($totalMaster==0)echo "";else echo $master;

$totalTransaksi = intval(empty($registerbkdn)?0:$registerbkdn)+intval(empty($registercom)?0:$registercom)+intval(empty($invoice)?0:$invoice);
if($totalTransaksi==0)echo "";else echo $transaksi;

?>


<?php if($this->session->userdata('idrole')=="1" || $this->session->userdata('role_name')=="administrator") { ?>
<div title="USER MANAGEMENT" style="padding:10px">
    <ul class="easyui-datalist side-menu">
        <li>
            <a class="menu-child" href="<?php echo site_url('pages/role') ?>"><b>Add Role</b></a>
        </li>
        <li>
        	<a class="menu-child" href="<?php echo site_url('pages/user_matrix') ?>"><b>Add User Matrix</b></a>
        </li>
    </ul>
</div>
<?php } ?>
<div title="SETTING" style="padding:10px">
    <ul class="easyui-datalist side-menu">
        <li>
            <a class="menu-child" href="<?php echo site_url('pages/account') ?>"><b>Change Account</b></a>
        </li>
    </ul>
</div>
<div title="LOGOUT" style="padding:10px">
    <ul class="easyui-datalist side-menu">
        <li>
            <a class="menu-child" href="<?php echo site_url('pages/logout') ?>"><b>Logout</b></a>
        </li>
    </ul>
</div>