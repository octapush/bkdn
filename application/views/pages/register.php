        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/dataTables.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/buttons.jqueryui.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/style_base.css'); ?>">
        <style type="text/css">
            .doc_release{
                border:solid 1px #EEE;
                background-color: #F8510F;
                padding: 2px;
                color: #FFF;
                font-size: 10px;
            }
            .doc_release_yes{
                border:solid 1px #EEE;
                background-color: #0F74F8;
                padding: 2px;
                color: #FFF;
                font-size: 10px;
            }
        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;top:20px !important"> 
                <table width="550px" border="0" align="center">
                    <tr>
                        <td width="50%" style="padding: 5px">
                            <input type="hidden" name="id_detail_header" id="id_detail_header" readonly="true">
                            <div style="margin-bottom:2px">
                                <label for="no_kontrak" class="label-top">Kontrak No:</label>
                                <input id="no_kontrak" value="" name="no_kontrak" class="easyui-textbox tb" style="width:100%" data-options="required:true">
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="code_pj" class="label-top">Jenis Perjanjian:</label>
                                <input id="code_pj" name="code_pj" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getpj');?>" valueField="id" textField="text" data-options="required:true">
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="code_division" class="label-top">Division Name:</label>
                                <input id="code_division" name="code_division" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getdivision');?>" valueField="id" textField="text" data-options="required:true">
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="tgl_pj" class="label-top">Tanggal Perjanjian:</label>
                                <input type="text" id="tgl_pj" name="tgl_pj" class="easyui-datebox" style="width:100%" data-options="required:true">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="code_customer" class="label-top">Customer Name:</label>
                                <input id="code_customer" name="code_customer" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getcustomer');?>" valueField="id" textField="text" data-options="required:true">
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="amount_kontrak" class="label-top">Nilai Kontrak:</label>
                                <input id="amount_kontrak" name="amount_kontrak" class="easyui-numberbox" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp',required:'true'" style="width:100%" url="<?php echo site_url('select_list/getpj');?>" valueField="id" textField="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="begindate" class="label-top">Waktu Pelaksanaan Pekerjaan:</label>
                                <input type="text" id="begindate" name="begindate" class="easyui-datebox" style="width:49%" placeholder="date" data-options="required:true">
                                <input type="text" id="enddate" name="enddate" class="easyui-datebox" style="width:49%" placeholder="date" data-options="required:true">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div align="right" style="margin-top: 20px;">
                            <hr style="width:100%;border: solid 1px #CCC" />
                                <button id="btnClose" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE'>CLOSE</button>
                                <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
                                <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table id="masterTableDetail" style="width: 100.9% !important"></table>
                        </td>
                    </tr>
                </table> 
            </div>
            <div id="masterEditorDetail" class="easyui-window" style="padding: 5px;">
                <div style="margin-bottom:2px">
                    <input type="hidden" readonly="true" name="id_detail" id="id_detail">
                    <label for="qty" class="label-top">Qty:</label>
                    <input id="qty" name="qty" class="easyui-numberbox" data-options="required:true" style="width: 375px">
                </div>
                <div style="margin-bottom:2px">
                    <label for="deskripsi" class="label-top">Deskripsi:</label>
                    <input id="deskripsi" name="deskripsi" class="easyui-textbox" data-options="required:true" style="width: 375px">
                </div>
                <div style="margin-bottom:2px">
                    <label for="spesifikasi" class="label-top">Spesifikasi Standart:</label>
                    <input id="spesifikasi" name="spesifikasi" class="easyui-textbox" data-options="required:true" style="width: 375px">
                </div>
                <div style="margin-bottom:2px">
                    <label for="price_item" class="label-top">Price Per Item:</label>
                    <input class="easyui-numberbox" name="price_item" id="price_item" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="width: 375px"></input>
                </div>
                <div style="display: none;">
                    <label for="price_total" class="label-top">Price Total:</label>
                    <input type="hidden" class="easyui-numberbox" name="price_total" id="price_total" value="" readonly="true" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE;width: 375px"></input>
                </div>
                <div align="right" style="margin-top: 20px;">
                    <hr style="width:100%;border: solid 1px #CCC" />
                    <button id="btnCloseDetail" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE_DETAIL'>CLOSE</button>
                    <button id="btnUpdateDetail" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE_DETAIL'>UPDATE</button>
                </div>
            </div>

            <div style="margin: 10px">
                <div id="tabsDoc" class="easyui-tabs" style="width: 100%">
                    <div id="tabs1" title="OPEN DOCUMENT" style="padding: 20px;display: none;">
                        <div id="contentTable1">
                            <div style="padding:5px 0;float: right;">
                                <!-- <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'" data-tag="Add">Add</button> -->
                            </div>
                            <div id="tb" style="padding:5px;height:auto;display: none;">
                                <div>
                                    Date From: <input class="easyui-datebox" style="width:80px">
                                    To: <input class="easyui-datebox" style="width:80px">
                                    <button id="btnCreateDoc" class="easyui-linkbutton" iconCls="icon-search">Search</button>
                                </div>
                            </div>
                            <div style="width: 100%">
                                <table class="table table-striped table-bordered table-hover" id="masterTable" style="width: 100.6% !important">
                                    <tr>
                                        <td>Data not accessible, contact the developer!</td>
                                    </tr>
                                </table>    
                            </div>
                        </div>
                    </div>
                    <div id="tabs2" title="CLOSE DOCUMENT" style="padding: 20px;display: none;">
                        <div id="contentTable2">
                            <table class="table table-striped table-bordered table-hover" id="masterTable2" style="width: 100.6% !important">
                                <tr>
                                    <td>Data not accessible, contact the developer!</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/dataTables.jqueryui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/api/dataTables.fixedColumns.nightly.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/master_reg_bkdn.js") ?>"></script>