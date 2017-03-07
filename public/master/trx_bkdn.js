  $(function(){
      var globalVars = {
          tableId: $('table#dg'),
          masterEditor: $('div#masterEditorCus'),
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
          input: {
            post:[$('input#code'),$('input#name'),$('input#addressCUS'),$('input#npwp'),$('input#phone')]
          },
          detailData: {
            data:[] || null
          },
          file_name:null,
          servicePath: adam.format('%1/%2',adam.currentHost(),base_url.register_bkdn+'registerbkdn')
      };

      var CUSTOMER = {
            register: function(){
                CUSTOMER.EVENT.register.apply();
            },
            FORM: {
                register: function(){
                  $.noops();
                },
                initInputData: function(){
                    $.each(globalVars.input.post,function(key,data){
                      var that = $(this);
                        data.val('');
                    });
                },
                data: function(){
                  return {
                    code:globalVars.input.post[0].val(),
                    name:globalVars.input.post[1].val(),
                    address:globalVars.input.post[2].val(),
                    npwp:globalVars.input.post[3].val(),
                    phone:globalVars.input.post[4].val(),
                  }
                }
            },
            EVENT:{
                register: function(){
                    CUSTOMER.EVENT.btnCloseCustomer.apply();
                    CUSTOMER.EVENT.btnSaveCustomer.apply();
                },
                btnCloseCustomer: function(){
                   var oBtn = $('button#btnCloseCus');
                      oBtn.unbind()
                          .bind('click',function(){
                            var bType = $(this).attr('data-tag');
                            if('CLOSECUS'==bType){
                              globalVars.masterEditor.window('close');
                              CUSTOMER.FORM.initInputData.apply();
                            }
                          });
                },
                btnSaveCustomer: function(){
                  var oBtn = $('button#btnSaveCus');
                      oBtn.unbind()
                          .bind('click',function(){
                            var bType = $(this).attr('data-tag');
                            if('SAVECUS'==bType){
                              CUSTOMER.EVENT.create(CUSTOMER.FORM.data.apply());
                              console.log(CUSTOMER.FORM.data.apply());
                            }
                          });
                },
                create: function(data){
                    $.ajax({
                        url:globalVars.servicePath+'/create_cus',
                        type:'POST',
                        dataType:'JSON',
                        data:data,
                        success:function(r){
                          if(!r)return;

                          if(r.success=='503'){
                            $.messager.alert('Information',r.message.toString());
                          }else{
                            if(r.success=='200')
                              $.messager.alert('Information',r.message.toString());
                              CUSTOMER.FORM.initInputData.apply();
                              globalVars.masterEditor.window('close');
                          }
                        },
                        error: function(e,x,s){
                          $.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
                          CUSTOMER.FORM.initInputData.apply();
                          globalVars.masterEditor.window('close');
                        }
                    });
                }
            }
        };

      CUSTOMER.register.apply();

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
               }
            },
            ROUTINES: {
               register: function(){
                  main.ROUTINES.loading.apply();
                  main.ROUTINES.initMasterForm.apply();
                  main.ROUTINES.initFormData.apply();
                  main.ROUTINES.addNewCustomer.apply();
               },
               loading: function(){
                  var win = $.messager.progress({
                          title:'Please waiting',
                          msg:'Loading data...',
                          percentage: false
                        });
                  //var len = $('div.progressbar-text').text();
                    //console.log(win);
                        setTimeout(function(){
                            $.messager.progress('close');
                        },3000)
                        
                },
               addNewCustomer: function(){
                  var oBtn = $('button#AddNewCutomer').unbind()
                      .bind('click',function(){
                         main.ROUTINES.showMasterForm('ADD',{title:'ADD FORM NEW CUSTOMER',width:550,height:430});
                      });
               },
               initMasterForm: function(){
                      globalVars.masterEditor.window('close');
                
              },
               showMasterForm: function(type,options){
                  var defOptions = globalVars.masterEditor
                  .window({
                     title:options.title,
                       width:options.width,
                       height:options.height,
                       modal:true,
                       position: { my: "center", at: "center", of: window },
                       minimizable:false,
                       maximizable: false,
                       draggable:true,
                       resizable:false,
                       collapsible:false
                   });
                   $.extend(defOptions,options)
               },
               initFormData: function(){
                globalVars.dataForm.file_doc.val('');
                globalVars.dataForm.kontrak_no.textbox('setValue','');
                globalVars.dataForm.jenis_perjanjian.combobox('setValue','');
                globalVars.dataForm.Kepada.combobox('setValue','');
                globalVars.dataForm.address.val('');
                globalVars.dataForm.nilai_kontrak.numberbox('setValue','');
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
                      if(file_data==undefined || file_data.name==null || file_data.name==""){
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
                          console.log(globalVars.detailData.data);
                          console.log(globalVars.dataForm.tgl_awal.datebox('getValue'));
                          console.log(globalVars.dataForm.tgl_akhir.datebox('getValue'));

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
                                    main.ROUTINES.initFormData.apply();
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
                    code_customer               : globalVars.dataForm.Kepada.val(),
                    code_pj                     : globalVars.dataForm.jenis_perjanjian.val(),
                    address                     : globalVars.dataForm.address.val(),
                    nilai_kontrak               : globalVars.dataForm.nilai_kontrak.val(),
                    tgl_awal                    : globalVars.dataForm.tgl_awal.datebox('getValue'),
                    tgl_akhir                   : globalVars.dataForm.tgl_akhir.datebox('getValue'),
                    lingkup_pekerjaan           : CKEDITOR.instances.editor1.getData(),
                    dasar_pelaksanaan_pekerjaan : CKEDITOR.instances.editor2.getData(),
                    cara_pembayaran             : CKEDITOR.instances.editor3.getData(),
                    pelaksanaan_pekerjaan       : CKEDITOR.instances.editor4.getData(),
                    asuransi_dan_jaminan        : CKEDITOR.instances.editor5.getData(),
                    lain_lain                   : CKEDITOR.instances.editor6.getData()
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
                     main.ROUTINES.uploadFileJson();
                });
              }
            }
      };
      main.register.apply();
});
   