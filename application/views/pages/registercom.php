<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/ckeditor/plugins/samples/css/samples.css'); ?>">
<style type="text/css">
  table#listData{
    border-collapse: collapse;
    border:solid 1px #DDD;
    width: 100%;
  }
  table#listData tr td{
    border:solid 1px #DDD;
    padding: 4px;
  }
</style>
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
      <input id="kepada" name="kepada" class="easyui-combobox" style="width:62%"  valueField="id" textField="text" data-options="
          required:true,
          valueField: 'id',
          textField: 'text',
          url: '<?php echo site_url('select_list/getcustomer');?>'
        ">
       <button class="easyui-linkbutton" id="AddNewCutomer" name="AddNewCutomer">Add New Customer</button>
      </td>
    </tr>
   <tr style="display: none;">
    <td width="25%">Alamat Subkon (Subcontractor's Address)</td>
    <td>
     <input id="address" name="address" class="easyui-validatebox tb" style="width: 95%" >
    </td>
   </tr>
<tr>
  <td width="25%">Nilai Kontrak (Contract Amount)</td>
  <td>
   <input class="easyui-numberbox" id="nilai_kontrak" name="nilai_kontrak" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="width: 30%"></input>
 </td>
</tr>
<tr>
  <td width="25%">Waktu Pelaksanaan Kerja (Contract Period)</td>
  <td>
   <input id="tgl_awal" name="tgl_awal" class="easyui-datebox" style="width: 15%" data-options="required:true">
   <input id="tgl_akhir" name="tgl_akhir" class="easyui-datebox" style="width: 15%" data-options="required:true">
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
  <td width="25%" style="margin-top: 10px;margin-bottom: 10px;display: none;">Uraian Nilai Pekerjaan (Contract Value Description)</td>
  <td>
    <table id="listData" style="margin-top: 10px;margin-bottom: 10px;display: none;">
      <thead>
        <tr>
          <td>Banyaknya</td>
          <td>Deskripsi</td>
          <td>Spesifikasi Standard</td>
          <td>Harga Satuan</td>
          <td>Jumlah</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" data-name="banyak" class="easyui-numberbox"></td>
          <td><input type="text" data-name="deskripsi" class="easyui-textbox"></td>
          <td><input type="text" data-name="spesifikasi" class="easyui-textbox"></td>
          <td> <input class="easyui-numberbox" data-name="harga" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input></td>
          <td> <input class="easyui-numberbox" data-name="jumlah" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE"></input></td>
        </tr>
        <tr>
          <td><input type="text" data-name="banyak" class="easyui-numberbox"></td>
          <td><input type="text" data-name="deskripsi" class="easyui-textbox"></td>
          <td><input type="text" data-name="spesifikasi" class="easyui-textbox"></td>
          <td> <input class="easyui-numberbox" data-name="harga" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input></td>
          <td> <input class="easyui-numberbox" data-name="jumlah" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE"></input></td>
        </tr>
        <tr>
          <td><input type="text" data-name="banyak" class="easyui-numberbox"></td>
          <td><input type="text" data-name="deskripsi" class="easyui-textbox"></td>
          <td><input type="text" data-name="spesifikasi" class="easyui-textbox"></td>
          <td> <input class="easyui-numberbox" data-name="harga" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input></td>
          <td> <input class="easyui-numberbox" data-name="jumlah" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE"></input></td>
        </tr>
        <tr>
          <td><input type="text" data-name="banyak" class="easyui-numberbox"></td>
          <td><input type="text" data-name="deskripsi" class="easyui-textbox"></td>
          <td><input type="text" data-name="spesifikasi" class="easyui-textbox"></td>
          <td> <input class="easyui-numberbox" data-name="harga" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input></td>
          <td> <input class="easyui-numberbox" data-name="jumlah" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE"></input></td>
        </tr>
        <tr>
          <td><input type="text" data-name="banyak" class="easyui-numberbox"></td>
          <td><input type="text" data-name="deskripsi" class="easyui-textbox"></td>
          <td><input type="text" data-name="spesifikasi" class="easyui-textbox"></td>
          <td> <input class="easyui-numberbox" data-name="harga" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'"></input></td>
          <td> <input class="easyui-numberbox" data-name="jumlah" value="" data-options="precision:2,groupSeparator:',',decimalSeparator:'.',prefix:'Rp'" style="background-color: #EEE"></input></td>
        </tr>
      </tbody>
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
</div>
<div style="margin:20px 0;"><hr></div>
<hr style="width:100%;border: solid 1px #CCC" /> 
<button style="display: none" id="btnAdd" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='ADD'>CLOSE</button>
<button id="btnSave" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVE'>SAVE</button>
<a href="<?php echo site_url('pages/print_bkdn'); ?>" class="easyui-linkbutton full-right" data-options="iconCls:'icon-print'" data-tag='PRINT'>PRINT</a>
<button style="display: none;" id="btnTest" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='TEST'>TEST</button>
</div>
</div>
</div>

<div id="masterEditorCus" class="easyui-window" style="padding: 5px;">                   
  <div style="margin-bottom:20px">
    <label for="code" class="label-top">Code Customer:</label>
    <input id="code" value="" name="code" class="easyui-validatebox tb" data-options="required:true,validType:'length[3,15]'">
  </div>
  <div style="margin-bottom:20px">
    <label for="name" class="label-top">Customer Name:</label>
    <input id="name" name="name" value="" class="easyui-validatebox tb" data-options="required:true,validType:'length[3,50]'">
  </div>
  <div style="margin-bottom:20px">
    <label for="addressCUS" class="label-top">Address:</label>
    <input id="addressCUS" value="addressCUS" name="addressCUS" class="easyui-validatebox tb" data-options="required:true,validType:'length[3,255]'">
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
    <button id="btnCloseCus" class="easyui-linkbutton full-right" data-options="iconCls:'icon-cancel'" data-tag='CLOSECUS'>CLOSE</button>
    <button id="btnSaveCus" class="easyui-linkbutton full-right" data-options="iconCls:'icon-save'" data-tag='SAVECUS'>SAVE</button>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url("public/ckeditor/ckeditor.js") ?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/master/trx_bkdn.js") ?>"></script>
<script type="text/javascript">
   //FUNCTION DATAGRIDS 
   var editIndex = undefined;
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