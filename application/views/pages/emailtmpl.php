        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/dataTables.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/buttons.jqueryui.min.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.jqueryui.min.js'); ?>"></script>
        <style type="text/css">
            .modal-windows {
               position: fixed;
               left: 50%;
            }
            div.wLeft{
                width: 450px
            }

        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;"> 
                <div class="wLeft">
                    <input type="hidden" name="code" id="code">
                    <div style="margin-bottom:20px">
                        <label for="name" class="label-top">Judul Email:</label>
                        <input id="name" name="name" class="easyui-textbox tb" data-options="required:true,validType:'length[5,50]'" style="width: 100%">
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="bodymsg" class="label-top">Isi Email:</label>
                        <input id="bodymsg" class="easyui-textbox tb" data-options="required:true, multiline:true" style="width: 100%; height:100px">
                    </div>
                </div>
                <div align="left" style="margin-top: 20px;">
                    <button id="btnClose" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE'>CLOSE</button>
                    <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
                    <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
                </div>
            </div>

            <div style="margin: 10px">
                <!-- <div style="padding:5px 0;float: right;">
                    <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'" data-tag="Add">Add</button>
                </div> -->
                <table id="tEmployee" class="display" style="width:100%">
                </table>
            </div>
    <style scoped="scoped">
        
    </style>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/master_emailtmpl.js") ?>"></script>