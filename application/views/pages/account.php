<div align="center">
	<div id="masterEditor" class="easyui-window" style="top:100px; left: 40%; padding: 5px;width: 500px;height: 300px;"> 
	    <div style="margin-bottom:20px">
	        <input id="id" data-tag='CODE' value="<?php echo $this->session->userdata('id'); ?>" type="hidden" readonly='true' name="id" /> 
	        <label for="username" class="label-left"><b>Username :</b></label>
	        <input id="username" value="<?php echo $this->session->userdata('username'); ?>" name="username" class="easyui-textbox" data-options="required:true" style="width:470px">
	    </div>
	    <div style="margin-bottom:20px">
	        <input id="id" value="" type="hidden"/> 
	        <label for="password" class="label-left"><b>New Password :</b></label>
	        <input type="password" id="password" name="password" class="easyui-textbox" data-options="required:true" style="width:470px">
	    </div>
	    <div style="margin-bottom:20px">
	        <input id="id" value="" type="hidden"/> 
	        <label for="cpassword" class="label-left"><b>Konfirmasi Password :</b></label>
	        <input type="password" id="cpassword" name="cpassword" class="easyui-textbox" data-options="required:true" style="width:470px">
	    </div>
	    <div style="margin-bottom:5px;">
	        <button id="btnCancel" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" data-tag="CANCEL">CANCEL</button>
	        <button id="btnUpdate" class="easyui-linkbutton" data-options="iconCls:'icon-save'" data-tag="UPDATE">UPDATE</button>
	    </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url("public/master/account.js"); ?>"></script>