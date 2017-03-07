        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/dataTables.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/buttons.jqueryui.min.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.jqueryui.min.js'); ?>"></script>
        <style type="text/css">
            .modal-windows {
               position: fixed;
               left: 50%;
            }
        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;"> 
                <div style="margin-bottom:20px">
                    <input id="id" value="" type="hidden"/> 
                    <label for="master" class="label-top"><b>Role Name:</b></label>
                    <input id="role_name" name="role_name" value="" class="easyui-textbox tb" data-options="required:true" style="width:477px">
                </div>
                <div style="margin-bottom:20px">
                    <label for="role_name" class="label-top"><b>Master Name:</b></label>
                    <input id="employee" name="employee" value="" type="checkbox"> Employee
                    <input id="customer" name="customer" value="" type="checkbox"> Customer
                    <input id="pj" name="pj" value="" type="checkbox"> Jenis Perjanjian
                </div>
                <div style="margin-bottom:20px">
                    <label for="transaksi" class="label-top"><b>Transaksi Name:</b></label>
                    <input id="registerbkdn" name="registerbkdn" value="" type="checkbox"> Add Register
                    <input id="registercom" name="registercom" value="" type="checkbox"> Detail Register
                    <input id="print_bkdn" name="print_bkdn" value="" type="checkbox"> Print BKDN
                    <input id="invoice" name="invoice" value="" type="checkbox"> Invoice
                </div>
                <div style="margin-bottom:20px">
                    <label for="role_name" class="label-top"><b>User Management:</b></label>
                    <input id="add_role" name="add_role" value="" type="checkbox"> Add Role
                    <input id="user_matrix" name="user_matrix" value="" type="checkbox"> User Matrix
                </div>
                <div align="right">
                    <button id="btnClose" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE'>CLOSE</button>
                    <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
                    <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
                </div>
            </div>

            <div style="margin: 10px">
                <div style="padding:5px 0;float: right;">
                    <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'" data-tag="Add">Add</button>
                </div>
            	<table id="masterTable" class="display" style="width:100%">
                   
                </table>
            </div>
    <style scoped="scoped">
        
    </style>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/master_role.js") ?>"></script>