        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/dataTables.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/buttons.jqueryui.min.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.jqueryui.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('misc/global/plugins/select2-4.0.3/css/select2.css'); ?>">
        <style type="text/css">
            .modal-windows {
               position: fixed;
               left: 50%;
            }
        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;"> 
                
            </div>

            <div style="margin: 10px">
                <div style="margin-bottom:20px">
                    <input id="id" value="" type="hidden"/> 
                    <label for="employee_matrix" class="label-left"><b>Employee Name&nbsp;&nbsp;&nbsp; :</b></label>
                    <select id="employee_matrix" name="employee_matrix" class="select2" style="width:470px"></select>
                </div>
                <div style="margin-bottom:5px">
                    <label for="rolename_matrix" class="label-left"><b>Acces Role Name :</b></label>
                    <select id="rolename_matrix" name="rolename_matrix" class="select2" style="width:470px"></select>
                </div>

                <div style="padding:5px 5px 5px 110px;float: left;margin-bottom: 20px;">
                    <button id="btnClose" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" data-tag="CLOSE">CANCEL</button>
                    <button id="btnSave" class="easyui-linkbutton" data-options="iconCls:'icon-save'" data-tag="SAVE">SAVE</button>
                    <button id="btnUpdate" style="display: none;" class="easyui-linkbutton" data-options="iconCls:'icon-save'" data-tag="UPDATE">UPDATE</button>
                </div>
            	<table id="masterTable" class="display" style="width:100%">
                   
                </table>
            </div>
    <style scoped="scoped">
        
    </style>
    <script type="text/javascript" src="<?php echo base_url('misc/global/plugins/select2-4.0.3/js/select2.full.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/master_user_matrix.js") ?>"></script>