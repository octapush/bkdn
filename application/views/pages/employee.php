        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/dataTables.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/buttons.jqueryui.min.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.jqueryui.min.js'); ?>"></script>
        <style type="text/css">
            .modal-windows {
               position: fixed;
               left: 50%;
            }
            div.wLeft,div.wRight{
                float: left;
                overflow:hidden;
                width: 230px
            }
            div.wLeft{
                margin-right: 10px;
            }

        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;"> 
                <div class="wLeft">
                    <input type="hidden" name="code" id="code">
                    <div style="margin-bottom:20px">
                        <label for="name" class="label-top">Employee Name:</label>
                        <input id="name" name="name" class="easyui-textbox tb" data-options="required:true,validType:'length[5,50]'" style="width: 100%">
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="placeofbirth" class="label-top">Tempat Lahir:</label>
                        <input id="placeofbirth" class="easyui-textbox tb" data-options="required:true" style="width: 100%">
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="birthday" class="label-top">Tanggal Lahir:</label>
                        <input id="birthday" class="easyui-datebox tb" data-options="required:true" style="width: 100%">
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="gender" class="label-top">Jenis Kelamin:</label>
                        <select class="easyui-combobox" data-options="required:true" id="gender" name="gender" style="width: 100%"/>
                            <option selected="selected"></option>
                            <option value="male">Laki-Laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="wRight">
                    <div style="margin-bottom:20px">
                        <label for="address" class="label-top">Address:</label>
                        <textarea id="address" name="address" class="easyui-textbox" data-options="required:true" style="width: 100%"></textarea>
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="phone" class="label-top">Phone:</label>
                        <input id="phone" name="phone" class="easyui-textbox tb" style="width: 100%"> 
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="username" class="label-top">Username:</label>
                        <input id="username" name="username" class="easyui-textbox tb" data-options="required:true" style="width: 100%"> 
                    </div>
                    <div style="margin-bottom:20px">
                        <label for="password" class="label-top">Password:</label>
                        <input type="password" id="password" name="password" class="easyui-textbox tb" data-options="required:true" style="width: 100%"> 
                    </div>
                </div>
                <br>
                <div align="right" style="margin-top: 20px;">
                    <button id="btnClose" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE'>CLOSE</button>
                    <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
                    <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
                </div>
            </div>

            <div style="margin: 10px">
                <div style="padding:5px 0;float: right;">
                    <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'" data-tag="Add">Add</button>
                </div>
            	<table id="tEmployee" class="display" style="width:100%">
                </table>
            </div>
    <style scoped="scoped">
        
    </style>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/employee.js") ?>"></script>