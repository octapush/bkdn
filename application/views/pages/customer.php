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
                <input type="hidden" id="code" readonly="true" value="" name="code"/>
                <div style="margin-bottom:20px">
                    <label for="name" class="label-top">Customer Name:</label>
                    <input id="name" name="name" value="" class="easyui-validatebox tb" data-options="required:true,validType:'length[3,50]'">
                </div>
                <div style="margin-bottom:20px">
                    <label for="address" class="label-top">Address:</label>
                    <input id="address" value="" name="address" class="easyui-validatebox tb" data-options="required:true,validType:'length[3,255]'">
                </div>
                <div style="margin-bottom:20px">
                    <label for="npwp" class="label-top">NPWP:</label>
                    <input id="npwp" name="npwp" class="easyui-validatebox tb">
                </div>
                <div style="margin-bottom:20px">
                    <label for="phone" class="label-top">Phone:</label>
                    <input id="phone" name="phone" class="easyui-validatebox tb">
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
    <script type="text/javascript" src="<?php echo base_url("public/master/customer.js") ?>"></script>