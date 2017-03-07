        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/3/dataTables.bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/api/dataTables.fixedColumns.nightly.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/jquery.dataTables.min.css'); ?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/ckeditor/plugins/samples/css/samples.css'); ?>">
        
        <style type="text/css">
            .modal-windows {
               position: fixed;
               left: 50%;
            }
        </style>
            <!-- MODAL EDITOR -->
            <div id="masterEditor" class="easyui-window" style="padding: 5px;"> 
                <table width="500px" border="0" align="center">
                    <tr>
                        <td width="50%" style="padding: 5px">
                            <div style="margin-bottom:2px">
                                <label for="no_kontrak" class="label-top">Kontrak No:</label>
                                <input id="no_kontrak" value="" name="no_kontrak" class="easyui-textbox tb" data-options="required:true">
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="id_pj" class="label-top">Jenis Perjanjian:</label>
                                <input id="id_pj" name="id_pj" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getpj');?>" valueField="id" textField="text" data-options="required:true">
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="id_division" class="label-top">Division Name:</label>
                                <input id="id_division" name="id_division" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getdivision');?>" valueField="id" textField="text" data-options="required:true">
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
                                <label for="id_customer" class="label-top">Customer Name:</label>
                                <input id="id_customer" name="id_customer" class="easyui-combobox" style="width:100%" url="<?php echo site_url('select_list/getcustomer');?>" valueField="id" textField="text" data-options="required:true">
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="amount_kontrak" class="label-top">Nilai Kontrak:</label>
                                <input id="amount_kontrak" name="amount_kontrak" class="easyui-numberbox" data-options="min:0,precision:2,required:true" style="width:100%" url="<?php echo site_url('select_list/getpj');?>" valueField="id" textField="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="id_customer" class="label-top">Jenis Surat:</label>
                                <select id="id_customer" name="id_customer" class="easyui-combobox" style="width:100%" data-options="required:true">
                                    <option value="" selected="selected"></option>
                                    <option value="1">Perjanjian</option>
                                    <option value="2">Jual Beli</option>
                                    <option value="3">Borongan</option>
                                </select> 
                            </div>
                        </td>
                        <td width="50%">
                            <div style="margin-bottom:2px">
                                <label for="begindate" class="label-top">Waktu Pelaksanaan Pekerjaan:</label>
                                <input type="text" id="begindate" name="begindate" class="easyui-datebox" style="width:49%" placeholder="date" data-options="required:true">
                                <input type="text" id="enddate" name="enddate" class="easyui-datebox" style="width:49%" placeholder="date" data-options="required:true">
                            </div>
                        </td>
                    </tr>
                </table> 
                <div align="right" style="margin-top: 20px;">
                <hr style="width:100%;border: solid 1px #CCC" />
                    <button id="btnClose" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSE'>CLOSE</button>
                    <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
                    <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
                </div>
            </div>

            <div style="margin: 10px">
                <div style="padding:5px 0;float: right;">
                    <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'" data-tag="Add">Add</button>
                </div>
                <div id="tb" style="padding:5px;height:auto">
                    <div>
                        Date From: <input class="easyui-datebox" style="width:80px">
                        To: <input class="easyui-datebox" style="width:80px">
                        <button class="easyui-linkbutton" iconCls="icon-search">Search</button>
                    </div>
                </div>
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="masterTable">
                        <tr>
                            <td>Data not accessible, contact the developer!</td>
                        </tr>
                    </table>    
                </div>
            </div>
    <input id="sortpicture" type="file" name="myfiles" />
    <button id="upload">Upload</button>
    <form id="myform" enctype="multipart/form-data" action="<?php echo site_url('welcome/upload_file'); ?>" method="post" >
        <input type="file" name="myfile">
        <input type="submit" value="KIRIM" name="btnUpload">
    </form>
    <button id="getData">GET</button>
    <button id="getDatas">GET</button>
    <div id="editor"></div>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/3/dataTables.bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/api/dataTables.fixedColumns.nightly.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/master/master_reg_bkdn.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js") ?>"></script>
    <script type="text/javascript">
        $(function(){
            CKEDITOR.replace( 'editor', {
                language: 'fr',
                uiColor: '#9AB8F3'
            });

            

            setTimeout(function(){
                $('span.cke_button__about_icon').hide();
            },1000);
            
            $('button#getData').on('click',function(){
                var data = CKEDITOR.instances.editor.getData();
                console.log(data);
            });

            $('button#getDatas').on('click',function(){
                CKEDITOR.instances.editor.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                console.log(data);
            });
            

            $('#upload').on('click', function() {
                // <input id="sortpicture" type="file" name="sortpic" />
                var file_data = $('#sortpicture').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('myfiles', file_data);
                console.log(file_data.name);                            
                $.ajax({
                            url: '<?php echo site_url('welcome/upload'); ?>', // point to server-side PHP script 
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'POST',
                            dataType:'JSON',
                            success: function(r){
                                console.log(r.SUKSES); // display response from the PHP script, if any
                            },
                            error: function(e){
                                console.log(e);
                            }
                 });
            });
            $("#myform").submit(function(evt){
                evt.preventDefault();

                var url = $(this).attr('action');
                var formData = new FormData($(this)[0]);
                console.log(formData);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        console.log(res);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                }); // End: $.ajax()           

            }); // End: submit()
        });
    </script>
    