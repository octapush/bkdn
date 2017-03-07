<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/ckeditor/plugins/samples/css/samples.css'); ?>">
<div class="easyui-panel" title="FORM REGISTER KONTRAK" style="width:auto;">
   <div id="masterEditor" style="padding: 5px;"> 
       <table width="100%" border="0">
           <tr>
              <td width="25%">Kontrak No</td>
              <td>
                 <input id="kontrak_no" name="kontrak_no" class="easyui-textbox" style="width:30%" data-options="required:true">
                 jenis Perjanjian <input id="jenis_perjanjian" name="jenis_perjanjian" class="easyui-combobox" style="width:20%" url="<?php echo site_url('select_list/getpj');?>" valueField="id" textField="text" data-options="required:true">
                 <input type="file" id="file_doc" name="file_doc" style="width:20%" data-options="required:true">
              </td>
           </tr>
           <tr>
              <td width="25%">Kepada</td>
              <td>
                 <input id="kepada" name="kepada" class="easyui-combobox" style="width:95%" url="<?php echo site_url('select_list/getcustomer');?>" valueField="id" textField="text" data-options="required:true">
              </td>
           </tr>
           <tr>
              <td width="25%">Alamat Subkon (Subcontractor's Address)</td>
              <td>
                 <input id="address" name="address" class="easyui-textbox" style="width: 95%" data-options="required:true">
              </td>
           </tr>
           <tr>
              <td width="25%">Nilai Kontrak (Contract Amount)</td>
              <td>
                 <input class="easyui-numberbox" id="nilai_kontrak" name="nilai_kontrak" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input>
              </td>
           </tr>
           <tr>
              <td width="25%">Waktu Pelaksanaan Kerja (Contract Period)</td>
              <td>
                 <input id="tgl_awal" name="tgl_awal" class="easyui-datebox" style="width: 48.9%" data-options="required:true">
                 <input id="tgl_akhir" name="tgl_akhir" class="easyui-datebox" style="width: 48.9%" data-options="required:true">
              </td>
           </tr>
           <tr>
              <td width="25%">Lingkup Pekerjaan</td>
              <td>
                 <div id="editor1"></div>
              </td>
           </tr>
           <tr>
              <td width="25%">Dasar Pelaksanaan Pekerjaan (Basic of Work Execution)</td>
              <td>
                 <div id="editor2"></div>
              </td>
           </tr>
           <tr>
              <td width="25%">Cara Pembayaran (Payment Method)</td>
              <td>
                 <div id="editor3"></div>
              </td>
           </tr>
           <tr>
              <td width="25%">Pelaksanaan Pekerjaan</td>
              <td>
                 <div id="editor4"></div>
              </td>
           </tr>
           <tr>
              <td width="25%">Asuransi & Jaminan Pelaksanaan</td>
              <td>
                 <div id="editor5"></div>
              </td>
           </tr>
           <tr>
              <td width="25%">Uraian Nilai Pekerjaan (Contract Value Description)</td>
              <td>
                 <table id="dg" class="easyui-datagrid" title="Uraian Nilai Pekerjaan" style="width:auto;height:auto;"
                     data-options="
                     singleSelect: true,
                     toolbar: '#tb',
                     url: '<?=base_url("public/data/datagrid_data1.json")?>',
                     method: 'get',
                     onClickCell: onClickCell,
                     onEndEdit: onEndEdit,
                     onBeginEdit: onBeginEdit
                     ">
                     <thead>
                        <tr>
                           <th data-options="field:'qty',width:190,editor:'numberbox'">Banyaknya</th>
                           <th data-options="field:'deskripsi',width:250,editor:'textbox'">Deskripsi</th>
                           <th data-options="field:'spesifikasi_standart',width:150,align:'right',editor:'textbox'">Spesifikasi Standard</th>
                           <th data-options="field:'price_per_item',width:150,align:'right',editor:{type:'numberbox',options:{precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'}}">Harga Satuan</th>
                           <th data-options="field:'total_price',width:150,editor:{type:'numberbox',options:{precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'}}">Jumlah</th>
                           <!-- <th data-options="field:'attr1',width:150,editor:'numberbox'">Jumlah</th> -->
                        </tr>
                     </thead>
                  </table>
              </td>
           </tr>
           <tr>
              <td width="25%">Lain-Lain (Miscellanous)</td>
              <td>
                 <div id="editor6"></div>
              </td>
           </tr>
       </table> 
       <div style="margin:20px 0;"></div>
         <div id="tb" style="height:auto">
            <a href="javascript:void(0);" id="tbAppend" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="append();">Add New</a>
            <a href="javascript:void(0);" id="tbRemoveIt" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" onclick="removeit()">Delete</a>
            <a href="javascript:void(0);" id="tbAccept" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" onclick="accept()">Save</a>
            <!-- <a href="javascript:void(0);" id="tbReject" class="easyui-linkbutton" data-options="iconCls:'icon-undo',plain:true" onclick="reject()">Reject</a> -->
         </div>
      <div style="margin:20px 0;"><hr></div>
       <hr style="width:100%;border: solid 1px #CCC" />
           <button id="btnAdd" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='ADD'>CLOSE</button>
           <button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
           <button id="btnUpdate" class="easyui-linkbutton full-right" data-options="iconCls:'icon-edit'" data-tag='UPDATE' style="display: none">UPDATE</button>
       </div>
   </div>
</div>

<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js") ?>"></script>
<script type="text/javascript">
   var editIndex = undefined;

   $(function(){

      var globalVars = {
          tableId: $('table#dg'),
          dataGridButton:{
            Append     : $('a#tbAppend'),
            RemoveIt   : $('a#tbRemoveIt'),
            Accept     : $('a#tbAccept'),
            Reject     : $('a#tbReject')
          },
          post: {
            input:[]
          },
          button: {
            Add:$('button#btnAdd[data-tag="ADD"]'),
            Save:$('button#btnSave[data-tag="SAVE"]')
          },
          dataForm:{
            kontrak_no                  : $('input#kontrak_no'),
            jenis_perjanjian            : $('input#jenis_perjanjian'),
            file_doc                    : $('input#file_doc'),
            Kepada                      : $('input#kepada'),
            address                     : $('input#address'),        
            nilai_kontrak               : $('input#nilai_kontrak'),
            tgl_awal                    : $('input#tgl_awal'),
            tgl_akhir                   : $('input#tgl_akhir'),
            lingkup_pekerjaan           : CKEDITOR.instances.editor1,
            dasar_pelaksanaan_pekerjaan : CKEDITOR.instances.editor2,
            cara_pembayaran             : CKEDITOR.instances.editor3,
            pelaksanaan_pekerjaan       : CKEDITOR.instances.editor4,
            asuransi_dan_jaminan        : CKEDITOR.instances.editor5,
            lain_lain                   : CKEDITOR.instances.editor6
          },
          detailData: {
            data:[] || null
          },
          file_name:null,
          servicePath: adam.format('%1/%2',adam.currentHost(),base_url.register_bkdn+'registerbkdn')
      };

      var main = {
            register: function(){
              main.UI.register.apply();
              main.EVENT.register.apply();
              main.ROUTINES.register.apply();
            },
            UI:{
               register: function(){
                  main.UI.CKEDITOR.apply();
               },
               CKEDITOR: function(){
                  CKEDITOR.replace( 'editor1', {
                         language: 'fr',
                         uiColor: '#D4D4D4'
                  });

                  CKEDITOR.replace( 'editor2', {
                            language: 'fr',
                            uiColor: '#D4D4D4'
                  });

                  CKEDITOR.replace( 'editor3', {
                            language: 'fr',
                            uiColor: '#D4D4D4'
                  });

                  CKEDITOR.replace( 'editor4', {
                            language: 'fr',
                            uiColor: '#D4D4D4'
                  });

                  CKEDITOR.replace( 'editor5', {
                            language: 'fr',
                            uiColor: '#D4D4D4'
                  });

                  CKEDITOR.replace( 'editor6', {
                            language: 'fr',
                            uiColor: '#D4D4D4'
                  });
                  // CKEDITOR.instances.editor1.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                  // CKEDITOR.instances.editor2.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                  // CKEDITOR.instances.editor3.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                  // CKEDITOR.instances.editor4.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                  // CKEDITOR.instances.editor5.setData('<ol><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ol>');
                  //END
               }
            },
            ROUTINES: {
               register: function(){
                  main.ROUTINES.initFormData.apply();
               },
               initFormData: function(){
                globalVars.dataForm.kontrak_no.textbox('setValue','');
                globalVars.dataForm.jenis_perjanjian.combobox('setValue','');
                globalVars.dataForm.Kepada.textbox('setValue','')
                globalVars.dataForm.address.textbox('setValue','')
                globalVars.dataForm.nilai_kontrak.numberbox('setValue','')
                globalVars.dataForm.tgl_awal.datebox('setValue','');
                globalVars.dataForm.tgl_akhir.datebox('setValue','');
                CKEDITOR.instances.editor1.setData('');
                CKEDITOR.instances.editor2.setData('');
                CKEDITOR.instances.editor3.setData('');
                CKEDITOR.instances.editor4.setData('');
                CKEDITOR.instances.editor5.setData('');
                CKEDITOR.instances.editor6.setData('');
               },
               uploadFileJson: function(){
                  var file_data = $('#file_doc').prop('files')[0];  
                  var dataFile = new FormData();
                  var isValid = false;

                  globalVars.detailData.data =globalVars.tableId.datagrid('getData').rows;
                  if(globalVars.detailData.data.length==0){
                    $.messager.alert("Alert","Detail harap di isi!");
                    return;
                  }

                      dataFile.append('file_doc', file_data);
                      console.log(file_data);
                      if(file_data.name==null || file_data.name==""){
                        $.messager.confirm('My Title', 'Apakah anda ingin melanjutkan transaksi ini tanpa file!?', function(r){
                          if (r){
                              isValid =true;
                          }else{
                            main.ROUTINES.savefile(dataFile);
                          }
                        });
                      }else{
                        main.ROUTINES.savefile(dataFile);
                      }

                      //return isValid;
               },
               savefile: function(dataFile){
                var file_name = "";
                  $.ajax({
                      url: globalVars.servicePath+'/uploadwithdata',
                      cache: false,
                      contentType: false,
                      processData: false,
                      data: dataFile,                         
                      type: 'POST',
                      dataType:'JSON',
                      success: function(r){
                        if(!r) $.messager.alert("Alert","Terjadi Kesalahan data!");
                        if(r.SUCCESS=="FALSE"){
                          $.messager.alert("Alert","FAILED "+r.MSG);
                          file_name="";
                        }else{
                          r.file_name.toString();
                          file_name = r.file_name.toString();
                          globalVars.file_name = file_name;

                            $.ajax({
                                url: globalVars.servicePath+'/createdetail',
                                cache: false,
                                data: {
                                  file_name:globalVars.file_name,
                                  dataheader: [main.ROUTINES.headerJson()],
                                  datadetail:globalVars.detailData.data
                                },                         
                                type: 'POST',
                                dataType:'JSON',
                                success: function(r){
                                  if(!r) $.messager.alert("Alert","Terjadi Kesalahan data!");
                                  if(r.success=="TRUE"){
                                    $.messager.alert("Alert","Data baru berhasil ditambahkan!");
                                  }else if(r.success=="503"){
                                    $.messager.alert("Alert",r.message);
                                  }else{
                                    $.messager.alert("Alert",r.message);
                                    return;
                                  }
                                },
                                error: function(e,x,h){
                                    $.messager.alert("Alert","FAILED "+e +" "+x+" "+h);
                                    console.log(e)
                                }
                           });
                        }
                      },
                      error: function(e){
                          $.messager.alert("Alert","FAILED "+e);
                          file_name="";
                      }
                 });
                  
               },
               headerJson: function(){
                  return  {
                    kontrak_no                  : globalVars.dataForm.kontrak_no.val(),
                    //ID DIV
                    id_customer                 : globalVars.dataForm.Kepada.val(),
                    id_pj                       : globalVars.dataForm.jenis_perjanjian.val(),
                    address                     : globalVars.dataForm.address.val(),
                    nilai_kontrak               : globalVars.dataForm.nilai_kontrak.val(),
                    tgl_awal                    : globalVars.dataForm.tgl_awal.val(),
                    tgl_akhir                   : globalVars.dataForm.tgl_akhir.val(),
                    lingkup_pekerjaan           : CKEDITOR.instances.editor1.getData(),
                    dasar_pelaksanaan_pekerjaan : CKEDITOR.instances.editor2.getData(),
                    cara_pembayaran             : CKEDITOR.instances.editor3.getData(),
                    pelaksanaan_pekerjaan       : CKEDITOR.instances.editor4.getData(),
                    asuransi_dan_jaminan        : CKEDITOR.instances.editor5.getData(),
                    lain_lain                   : CKEDITOR.instances.editor6.getData(),
                  }
               },
               detailJson: function(){
                  return globalVars.tableId.datagrid('getData');
               }
            },
            EVENT: {
              register: function(){
                main.EVENT.Add.apply();
                main.EVENT.Save.apply();
              },
              Add: function(){
                globalVars.button.Add
                .unbind()
                .bind('click',function(e){
                  e.preventDefault();
                  main.ROUTINES.uploadFileJson.apply();
                });
              },
              Save: function(){
                globalVars.button.Save
                .unbind()
                .bind('click',function(e){
                  e.preventDefault();
                  //globalVars.detailData.data =globalVars.tableId.datagrid('getData').rows;
                  // if(globalVars.detailData.data.length==0){
                  //   $.messager.alert("Alert","Detail harap di isi!");
                  //   return;
                  //   return;
                  // }

                  // console.log({dataheader:[main.ROUTINES.headerJson()]});
                  // console.log({datadetail:globalVars.detailData.data});
                  // console.log(globalVars.detailData.data.length);

                        main.ROUTINES.uploadFileJson();
                       //  $.ajax({
                       //      url: globalVars.servicePath+'/createdetail',
                       //      cache: false,
                       //      data: {
                       //        file_name:globalVars.file_name,
                       //        dataheader: [main.ROUTINES.headerJson()],
                       //        datadetail:globalVars.detailData.data
                       //      },                         
                       //      type: 'POST',
                       //      dataType:'JSON',
                       //      success: function(r){
                       //        if(!r) $.messager.alert("Alert","Terjadi Kesalahan data!");
                       //        if(r.success=="TRUE"){
                       //          $.messager.alert("Alert","Data baru berhasil ditambahkan!");
                       //        }else if(r.success=="503"){
                       //          $.messager.alert("Alert",r.message);
                       //        }else{
                       //          $.messager.alert("Alert",r.message);
                       //          return;
                       //        }
                       //      },
                       //      error: function(e,x,h){
                       //          $.messager.alert("Alert","FAILED "+e +" "+x+" "+h);
                       //          console.log(e)
                       //      }
                       // });
                    
                  //main.ROUTINES.initFormData.apply();
                });
              }
            }
      };
      main.register.apply();
   });
   
   
   function endEditing(){
      if (editIndex == undefined){return true}
      if ($('#dg').datagrid('validateRow', editIndex)){
         $('#dg').datagrid('endEdit', editIndex);
         editIndex = undefined;
         return true;
      } else {
         return false;
      }
   }
   function onClickCell(index, field){ //disableCellEditing
      if (editIndex != index){
         if (endEditing()){
            $('#dg').datagrid('selectRow', index)
                  .datagrid('beginEdit', index);
            var ed = $('#dg').datagrid('getEditor', {index:index,field:field});
            if (ed){
               ($(ed.target).data('textbox') ? $(ed.target).textbox('textbox') : $(ed.target)).focus();
            }
            editIndex = index;
         } else {
            setTimeout(function(){
               $('#dg').datagrid('selectRow', editIndex);
            },0);
         }
      }
   }
   function onEndEdit(index, row){
      var ed = $(this).datagrid('getEditor', {
         index: index,
         field: 'deskripsi'
      });
      row.deskripsi = $(ed.target).combobox('getText');
   }
   function append(){
      if (endEditing()){
         $('#dg').datagrid('appendRow',{status:'P'});
         editIndex = $('#dg').datagrid('getRows').length-1;
         $('#dg').datagrid('selectRow', editIndex)
               .datagrid('beginEdit', editIndex);
      }
   }
   function removeit(){
      if (editIndex == undefined){return}
      $('#dg').datagrid('cancelEdit', editIndex)
            .datagrid('deleteRow', editIndex);
      editIndex = undefined;
   }
   function accept(){
      if (endEditing()){
         $('#dg').datagrid('acceptChanges');
      }
   }
   function reject(){
      $('#dg').datagrid('rejectChanges');
      editIndex = undefined;
   }

   function onBeginEdit(rowIndex){
        var editors = $('#dg').datagrid('getEditors', rowIndex);
        var n1 = $(editors[0].target);
        var n3 = $(editors[3].target);
        var n4 = $(editors[4].target);
        n1.add(n3).numberbox({
            onChange:function(){
                var total = n1.numberbox('getValue')*n3.numberbox('getValue');
                n4.numberbox('setValue',total);
            }
        })
    }
</script>