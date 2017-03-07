<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<meta charset="UTF-8">
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/bootstrap/easyui.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/style_login.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/jquery.easyui.min.js'); ?>"></script>
       
</head>
<style type="text/css">
	.message{
		color:red;
	}
</style>
<body>

<div id="bodyarea" style="padding: 1ex 0px 2ex 0px;margin-top: 10%">
		<form action="<?php echo site_url('Authentifikasi/login') ?>" method="post" accept-charset="UTF-8" name="frmLogin" id="frmLogin" style="margin-top: 4ex;">
			<table border="0" width="400" cellspacing="0" cellpadding="4" class="tborder" align="center">
				<tr class="titlebg">
					<td colspan="2">
						<img src="<?php echo base_url('public/img/'); ?>login_sm.gif" alt="" align="top" /> Login
					</td>
				</tr>
				<tr class="windowbg">
					<td colspan="2">
						<?php if($this->session->flashdata('msg')){ echo "<div class='message' align='center'>".$this->session->flashdata('msg')."</div>";} ?>
					</td>
				</tr>
				<tr class="windowbg">
					<td></td>
					<td></td>
				</tr>
				<tr class="windowbg" style="margin-top: 50px">
					<td width="50%" align="right"><b>Username:</b></td>
					<td><input class="easyui-textbox tb" type="text" onload="this.focus()" name="username" size="20" value="" /></td>
				</tr>
				<tr class="windowbg">
					<td align="right"><b>Password:</b></td>
					<td><input class="easyui-textbox tb" type="password" name="password" value="" size="20" /></td>
				</tr>
				<tr class="windowbg">
					<td colspan="2" align="right" style="padding-right: 35px"><input class="easyui-linkbutton full-right" type="submit" value="LOGIN" style="margin-top: 2ex;padding: 5px;" /></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>