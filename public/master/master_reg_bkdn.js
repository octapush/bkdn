$(function(){
	var globalVars= {
		tableConfigs:null,
		tableConfigs2:null,
		tableConfigsDetail:null,
		tableIdDetail: $('table#masterTableDetail'),
		tableId: $('table#masterTable'),
		tableId2: $('table#masterTable2'),
		masterEditor: $('div#masterEditor'),
		masterEditorDetail: $('div#masterEditorDetail'),
		servicePath: adam.format('%1/%2',adam.currentHost(),base_url.register_bkdn+'registerbkdn'),
		input: {
			post:[
					$('input#no_kontrak'),
					$('input#code_division'),
					$('input#code_customer'),
					$('input#code_pj'),
					$('input#tgl_pj'),
					$('input#amount_kontrak'),
					$('input#begindate'),
					$('input#enddate')
				]
		},
		filterData:null,
		isDoc:false
	};
	
	var main = {
		register: function(){
			main.UI.register.apply();
			main.EVENTS.register.apply();
			main.ROUTINES.register.apply();
		},
		UI: {
			register: function(){
				main.UI.buildTable.apply();
			},
			buildTable: function(){
				globalVars.tableConfigs = globalVars.tableId.dataTable({
					searching: true,
                    pageLength: 5,
                    bPaginate: true,
                    processing: true,
                    serverSide: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        enable: true,
                        left: 0x0,
                        right: 0x1,
                        scrollX: 200
                    },
                    ajax: {
                        url: globalVars.servicePath+'/getregisterbkdn',
                        type: 'POST',
                        data: { method:'GETALL'},
                        dataType: 'JSON',
                            error: function(e) {
                                console.log(e);
                            }
                    },
                    lengthMenu: [
                        [0x5, 0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32],
                        [0x5, 0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32]
                    ],
                    columns: 
                    [	
                        { title:'ID',data:"id"},
                        { title:'NO KONTRAK',data:"no_kontrak" },
                        { title:'ADD BY',data:"addby",visible:false },
                        { title:'ADD DATE',data:"adddt",visible:false },
                        { title:'MOD BY',data:"modby",visible:false },
                        { title:'MOD DT',data:"moddt",visible:false },
                        { title:'NAMA PERUSAHAAN',data:"customer_name" },
                        { title:'ALAMAT PERUSAHAAN',data:"customer_address",visible:false },
                        { title:'JENIS PERIJINAN',data:"jenis_perijinan",visible:false },
                        { title:'TGL PERJANJIAN',data:"tgl_pj",visible:false },
                        { title:'NILAI KONTRAK',data:"amount_kontrak" },
                        { title:'TGL AWAL PELAKSANAAN',data:"begindate" },
                        { title:'TGL AKHIR PELAKSANAAN',data:"enddate" },
                        { title:'ID DIVISION',data:"code_division", visible:false },
                        { title:'ID CUSTOMER',data:"code_customer", visible:false },
                        { title:'ID PJ',data:"code_pj", visible:false },
                        { title:'PPN',data:"ppn",visible:false },
                        { title:'PPH',data:"pph",visible:false },
                        { title:'TOTAL KONTRAK + (PPH & PPN)',data:"total_amount" },
                        { title:'CODE DIVISION',data:"code_division", visible:false },
                        { title:'PROJECT NAME',data:"project_name", visible:false },
                        { title:'FILE',data:"file" },
                        { title:'DOCUMENT',data:"is_close",width:'100' },
                        { title:'DOCUMENT2',data:"close_2", visible:false },
                        { title:'Action',data:"action",orderable: false,width:'85' }
            		]
				});
			},
			buildTableCloseDocument: function(){
				globalVars.tableConfigs2 = globalVars.tableId2.dataTable({
					searching: true,
                    pageLength: 5,
                    bPaginate: true,
                    processing: true,
                    serverSide: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        enable: true,
                        left: 0x0,
                        right: 0x1,
                        scrollX: 200
                    },
                    ajax: {
                        url: globalVars.servicePath+'/getregisterbkdn',
                        type: 'POST',
                        data: { method:'GETALL'},
                        dataType: 'JSON',
                            error: function(e) {
                                console.log(e);
                            }
                    },
                    lengthMenu: [
                        [0x5, 0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32],
                        [0x5, 0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32]
                    ],
                    columns: 
                    [	
                        { title:'ID',data:"id"},
                        { title:'NO KONTRAK',data:"no_kontrak" },
                        { title:'ADD BY',data:"addby",visible:false },
                        { title:'ADD DATE',data:"adddt",visible:false },
                        { title:'MOD BY',data:"modby",visible:false },
                        { title:'MOD DT',data:"moddt",visible:false },
                        { title:'NAMA PERUSAHAAN',data:"customer_name" },
                        { title:'ALAMAT PERUSAHAAN',data:"customer_address",visible:false },
                        { title:'JENIS PERIJINAN',data:"jenis_perijinan",visible:false },
                        { title:'TGL PERJANJIAN',data:"tgl_pj",visible:false },
                        { title:'NILAI KONTRAK',data:"amount_kontrak" },
                        { title:'TGL AWAL PELAKSANAAN',data:"begindate" },
                        { title:'TGL AKHIR PELAKSANAAN',data:"enddate" },
                        { title:'ID DIVISION',data:"code_division", visible:false },
                        { title:'ID CUSTOMER',data:"code_customer", visible:false },
                        { title:'ID PJ',data:"code_pj", visible:false },
                        { title:'PPN',data:"ppn",visible:false },
                        { title:'PPH',data:"pph",visible:false },
                        { title:'TOTAL KONTRAK + (PPH & PPN)',data:"total_amount" },
                        { title:'CODE DIVISION',data:"code_division", visible:false },
                        { title:'PROJECT NAME',data:"project_name", visible:false },
                        { title:'FILE',data:"file" },
                        { title:'DOCUMENT',data:"is_close",width:'100' },
                        { title:'DOCUMENT2',data:"close_2", visible:false },
                        {
                                	title: "Action",
		                          	orderable: false,
		                          	data: null,
		                          // ReSharper disable once UsingOfReservedWord
		                          	class: "dt-head-center",
		                          	defaultContent: [
		                              	"<center>",
		                              	"<div class=\"btn-group\">",
		                              	"<button title=\"ReOpen Document\" type=\"button\" data-tag=\"open\" class=\"l-btn easyui-linkbutton\">Open</button>",
		                              	"</div>",
		                              	"</center>"
		                          	].join(""),
		                          	width: "50px"
		                }
            		]
				});
			},
			buildDetail: function(no_kontrak){
				globalVars.tableConfigsDetail =$('table#masterTableDetail').dataTable({
                	 		searching: false,
                            pageLength: 0xA,
                            autoWidth: true,
                            scrollCollapse: true,
                            lengthMenu: [
                                [0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32],
                                [0xA, 0xF, 0x19, 0x1E, 0x23, 0x28, 0x2D, 0x32]
                            ],
                            columns: [
                                {
                                    title: 'id', visible:false
                                }, {
                                    title: 'no_kontrak',width:'10'
                                }, {
                                    title: 'qty',width:'10'
                                }, {
                                    title: 'deskripsi',width:'20'
                                }, {
                                    title: 'spesifikasi_standart',width:'20'
                                }, {
                                    title: 'price_per_item',width:'20'
                                }, {
                                    title: 'total_price',width:'20'
                                }, {
                                	title: "Action",
		                          	orderable: false,
		                          	data: null,
		                          // ReSharper disable once UsingOfReservedWord
		                          	class: "dt-head-center",
		                          	defaultContent: [
		                              	"<center>",
		                              	"<div class=\"btn-group\">",
		                              	"<button style='display:none' title=\"View Detail Data\" type=\"button\" data-detail=\"view\" class=\"l-btn easyui-linkbutton\">View</button>",
		                              	"<button type=\"button\" title=\"Edit Data Selection\" data-detail=\"edit\" class=\"l-btn easyui-linkbutton\">Edit</button>&nbsp;&nbsp;",
		                              	"<button style=\"display:none\" type=\"button\" title=\"Delete Data Selection\" data-detail=\"delete\" class=\"l-btn easyui-linkbutton\">Delete</button>",
		                              	"</div>",
		                              	"</center>"
		                          	].join(""),
		                          	width: "50px"
                                }
                            ]
                	 	});

                	 	$.ajax({
                	 		url:globalVars.servicePath+'/detailregister',
							type:'POST',
							dataType:'JSON',
							data:{data:no_kontrak},
                	 		success: function(r){
                	 			if (!r) return;
                                $.each(r, function(key, value) {
                                       globalVars.tableConfigsDetail.fnAddDataAndDisplay([value.id,value.no_kontrak, value.qty, value.deskripsi, value.spesifikasi_standart, value.price_per_item, value.total_price]);
                                });
                	 		},
                	 		error: function(e){
                	 			$.messager.alert('Alert','Error table detail not loaded '+e);
                	 		}
                	 	});
	            	 	
	            	 	main.EVENTS.eventButtonRowDetail.apply();
			},
		},
		EVENTS: {
			register: function(){
				main.EVENTS.eventButtonRow.apply();
				main.EVENTS.eventButtonRow2.apply();
				main.EVENTS.eventButtonRowDetail.apply();
				main.EVENTS.btnShowFormMaster.apply();
				main.EVENTS.btnSave.apply();
				main.EVENTS.btnUpdate.apply();
				main.EVENTS.btnClose.apply();
				main.EVENTS.rebindSearchTextBox.apply();
				main.EVENTS.activateFilterTable.apply();
			},
			eventButtonRow: function(){
				globalVars.tableId
				.on('preXhr.dt', function(e, setting, data) {
                  	if(globalVars.filterData){
                  		data['is_close'] = globalVars.filterData;
                  	}
	              })
	              .on('xhr.dt', function(e, setting, data) {
	                  $.each(data.data,function(index,value){
	                    	 value.is_close = value.is_close=="0"?"<div align='center' class='doc_release'>BELUM DI BUAT</div>":"<div align='center' class='doc_release_yes'>SUDAH DIBUAT</div>";
	                    	 if(value.close_2=="1"){
	                    	 	value.action="";
	                    	 }
	                  });
	              })
	              .on('draw.dt', function() {
	                  main.EVENTS.gridBtnTable.apply();
	              });
			},
			eventButtonRow2: function(){
				globalVars.tableId2
				.on('preXhr.dt', function(e, setting, data) {
                  	if(globalVars.filterData){
                  		data['is_close'] = globalVars.filterData;
                  	}
	              })
	              .on('xhr.dt', function(e, setting, data) {
	                  $.each(data.data,function(index,value){
	                    	 value.is_close = value.is_close=="0"?"<div align='center' class='doc_release'>BELUM DI BUAT</div>":"<div align='center' class='doc_release_yes'>SUDAH DIBUAT</div>";
	                    	 if(value.close_2=="1"){
	                    	 	value.action="";
	                    	 }
	                  });
	              })
	              .on('draw.dt', function() {
	                  //TO DO CODE HERE
	                  main.EVENTS.gridBtnOpen.apply();
	              });
			},
			eventButtonRowDetail: function(){
				globalVars.tableIdDetail
						  .on('preXhr.dt', function(e, setting, data) {
							//TO DO YOUR CODE
							console.log("PRE XHR DT "+data);
			              })
			              .on('xhr.dt', function(e, setting, data) {
			              	//TO DO YOUR CODE
			              })
			              .on('draw.dt', function() {
			              	//YOUR CODE
			              	main.EVENTS.gridBtnTableDetail.apply();
			            });
			},
			gridBtnTable: function(){
				var oDt = globalVars.tableId;
				var oBtnAdd = $('button#btnUpdate');
				var oBtnSave = $('button#btnSave');
                var oBtn = $('button[data-tag]', oDt);
                    oBtn.unbind()
                        .bind('click',function(){
                          var that = $(this);
                          var bType = that.attr('data-tag');
                          	  oBtnAdd.show();
                          	  oBtnSave.hide();
                          var data = main.ROUTINES.getSelectedRow(that);
                            if('delete'==bType){
                                $.messager.confirm('My Title', 'Apakah anda ingin menghapus data ini!?', function(r){
					                if (r){
					                    main.CRUDS.delete({id:data.data.id.toString()},data.index);
					                }
					            });
                            }else if('edit'==bType){
                            		var cVal = data.data
                            		if(globalVars.tableConfigsDetail!=null){
                            			globalVars.tableConfigsDetail.fnDestroy();
                                		globalVars.tableIdDetail.html('');
                            		}
                                	main.UI.buildDetail(cVal.no_kontrak);
                                	console.log(cVal);
                                	$('input#id_detail_header').val(cVal.id);
                                	globalVars.input.post[0].textbox('setValue',cVal.no_kontrak);
                                	globalVars.input.post[0].textbox('readonly',true);
                                	globalVars.input.post[1].combobox('setValue',cVal.code_division);
                                	globalVars.input.post[2].combobox('setValue',cVal.code_customer);
                                	globalVars.input.post[3].combobox('setValue',cVal.code_pj);
                                	globalVars.input.post[4].datebox('setValue',cVal.tgl_pj);
                                	globalVars.input.post[5].numberbox('setValue',cVal.amount_kontrak);
                                	globalVars.input.post[6].datebox('setValue',cVal.begindate);
                                	globalVars.input.post[7].datebox('setValue',cVal.enddate);
                                //});
                                main.ROUTINES.showMasterForm('EDIT',{title:'UPDATE FORM REGISTER KONTRAK',width:600,height:500});

                            }
                    });
			},
			gridBtnTableDetail: function(){
				var oDt = globalVars.tableConfigsDetail;
                var oBtn = $('button[data-detail]', oDt);
                    oBtn.unbind()
                        .bind('click',function(){
                          var that = $(this);
                          var bType = that.attr('data-detail');
                          var tables = that.attr('data-table');
                          	  //oBtnSave.hide();
                          	var data = main.ROUTINES.getSelectedRowDetail(that);
                          	var dt = data.data;
                            if('edit'==bType){
                            	if(dt==null || dt==undefined){
                            		$.messager.alert('ALERT','Silahkan Tutup Tabel Detail Yang Lain!');
                            		return;
                            	}

                            	$('input#id_detail').val(dt[0]);
                            	$('input#qty').numberbox('setValue',dt[2]);
                            	$('input#deskripsi').textbox('setValue',dt[3]);
                            	$('input#spesifikasi').textbox('setValue',dt[4]);
                            	$('input#price_item').numberbox('setValue',dt[5]);
                            	$('input#price_total').numberbox('setValue',dt[6]);
                            	main.ROUTINES.showMasterFormDetail('EDIT',{title:'UPDATE DETAIL REGISTER KONTRAK',width:400,height:340});
                            	//console.log(dt);
                            }
                    });
			},
			btnShowFormMaster: function(){
				var oBtn = $('button#btnAdd');
				var oBtnUpdate = $('button#btnUpdate');
				var oBtnSave = $('button#btnSave');
					oBtn.unbind().bind('click',function(){
						var that = $(this);
						var bType = that.attr('data-tag');
							oBtnSave.show();
							oBtnUpdate.hide();
						if("Add"==bType){
							main.ROUTINES.initInputData.apply();
							main.ROUTINES.showMasterForm('ADD',{title:'FORM REGISTER KONTRAK',width:600,height:500});
						}
					});
				
			},
			btnSave: function(){
				var oBtnSave = $('button#btnSave');
					oBtnSave.unbind()
						.bind('click',function(){
							var that = $(this);
							var bType = that.attr('data-tag');
							if('SAVE'==bType){
								main.CRUDS.create(main.ROUTINES.data.apply());
								globalVars.tableConfigs.api(true).draw();
							}
					});
			},
			btnUpdate: function(){
				var oBtnUpdate = $('button#btnUpdate');
					oBtnUpdate.unbind()
						.bind('click',function(){
							var that = $(this);
							var bType = that.attr('data-tag');
							if('UPDATE'==bType){
								globalVars.input.post[0].removeAttr('disabled');
								var dataHeader = main.ROUTINES.dataHeader.apply();
									main.CRUDS.update(dataHeader);
									globalVars.tableConfigs.api(true).draw();
							}
					});
			},
			btnClose: function(){
				var oBtnClose = $('button[data-tag="CLOSE"]');
					oBtnClose.unbind()
						.bind('click',function(){
							globalVars.masterEditor.window('close');
							main.ROUTINES.initInputData.apply();
					});
				
			},
			rebindSearchTextBox: function() {
                $('div#masterTable_filter input[aria-controls="masterTable"]').unbind();
                $('div#masterTable_filter input[aria-controls="masterTable"]').bind('keyup', function(e) {
                    if (13 == e.keyCode)
                        globalVars.tableConfigs.fnFilter(this.value);
                });
            },
            activateFilterTable: function(){
            	$('div#tabsDoc').tabs({
			            border:false,
			            onSelect: function(title){
			                if(title=='OPEN DOCUMENT'){
			                    globalVars.filterData = '0';
			                    globalVars.tableConfigs.api(true).draw();
			                }else if(title=='CLOSE DOCUMENT'){
			                   globalVars.filterData = '1';
			                   if(globalVars.tableConfigs2!=null){
			                   		globalVars.tableConfigs2.fnDestroy();
			                   }
			                   globalVars.tableId2.html('');
			                   main.UI.buildTableCloseDocument.apply();
			                }
			                
			            }
			        });
            },
            gridBtnOpen: function(){
            	var oBtn = $('button[data-tag="open"]');
            		oBtn.unbind()
            			.bind('click',function(){
            				var that = $(this);
            				var bType = that.attr('data-tag');
            				var data  = main.ROUTINES.getSelectedRowCloseDoc(that);
            				if('open'==bType){
            					$.messager.confirm('My Title', 'Apakah anda ingin membuka kembali data ini!?', function(r){
					                if (r){
					                    var dt = data.data;
		            					var jsonData = {id:dt.id,no_kontrak:dt.no_kontrak};
		            					main.CRUDS.openDocument(jsonData);
					                }
					            });
            				}
            			});
            }
		},
		ROUTINES: {
			register: function(){
				//TO DO HERE CODE
				main.ROUTINES.initMasterForm.apply();
				main.ROUTINES.initMasterFormDetail.apply();
				main.ROUTINES.initWindows.apply();
				//
			},
			initWindows: function(){
				var win = $.messager.progress({
	                title:'Please waiting',
	                msg:'Loading data...'
	            });

	            setTimeout(function(){
	                $.messager.progress('close');
	            },1000)
			},
			getSelectedRow: function(obj){
				return {
	                index : $(obj).closest('tr').index(),
	                data: globalVars.tableId.dataTable().fnGetData($(obj).closest('tr').index())
              	}
			},
			getSelectedRowDetail: function(obj){
				return {
	                index : $(obj).closest('tr').index(),
	                data: globalVars.tableConfigsDetail.dataTable().fnGetData($(obj).closest('tr').index())
              	}
			},
			getSelectedRowCloseDoc: function(obj){
				return {
	                index : $(obj).closest('tr').index(),
	                data: globalVars.tableConfigs2.dataTable().fnGetData($(obj).closest('tr').index())
              	}
			},
			initMasterForm: function(){
				globalVars.masterEditor
				.window('close');
				
			},
			initMasterFormDetail: function(){
				globalVars.masterEditorDetail
				.window('close');
				
			},
			initMasterFormDetail: function(){
				globalVars.masterEditorDetail
				.window('close');
				
			},
			showMasterForm: function(type,options){
				if('ADD'==type || 'EDIT'==type)
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
			showMasterFormDetail: function(type,options){
				if('EDIT'==type)
				var defOptions = globalVars.masterEditorDetail
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
			hideMasterForm: function(){
				globalVars.masterEditor
				.window('close');
			},
			initInputData: function(){
					$('input#id_detail_header').val('');
					globalVars.input.post[0].textbox('readonly',false);
					globalVars.input.post[0].textbox('enable');
					globalVars.input.post[0].textbox('setValue','');
					globalVars.input.post[1].combobox('setValue','');
					globalVars.input.post[2].combobox('setValue','');
					globalVars.input.post[3].combobox('setValue','');
					globalVars.input.post[4].datebox('setValue','');
					globalVars.input.post[5].numberbox('setValue','');
					globalVars.input.post[6].datebox('setValue','');
					globalVars.input.post[7].datebox('setValue','');
			},
			initInputDataById: function(){
					$.noops();
			},
			dataHeader: function(){
				return {
					id				:$.trim($('input#id_detail_header').val()),
					no_kontrak		:$.trim(globalVars.input.post[0].textbox('getValue')),
					code_division	:globalVars.input.post[1].combobox('getValue'),
					code_customer	:globalVars.input.post[2].combobox('getValue'),
					code_pj			:globalVars.input.post[3].combobox('getValue'),
					tgl_pj			:globalVars.input.post[4].datebox('getValue'),
					amount_kontrak	:globalVars.input.post[5].numberbox('getValue'),
					begindate		:globalVars.input.post[6].datebox('getValue'),
					enddate			:globalVars.input.post[7].datebox('getValue')
				}
			}
		},
		CRUDS: {
			register: function(){

			},
			create: function(data){
				console.log(data);
				$.ajax({
					url:globalVars.servicePath+'/create',
					type:'POST',
					dataType:'JSON',
					data:data,
					success:function(r){
						if(!r)return;

						if(r.success=='503'){
							$.messager.alert('Information',r.message.toString());
							return;
						}else{
							if(r.success=='200')
								$.messager.alert('Information',r.message.toString());
						}
						main.ROUTINES.hideMasterForm.apply();
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
					}
				});
			},
			update: function(data){
				$.ajax({
					url:globalVars.servicePath+'/update',
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
						}
						main.ROUTINES.hideMasterForm.apply();
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
					}
				});
			},
			delete: function(data,index){
				$.ajax({
					url:globalVars.servicePath+'/delete',
					type:'POST',
					dataType:'JSON',
					data:data,
					success:function(r){
						if(!r)return;

						if(r.success=='503'){
							$.messager.alert('Information',r.message.toString());
						}else{
							if(r.success=='200'){
								$.messager.alert('Information',r.message.toString());
								globalVars.tableConfigs.fnDeleteRow(index);
							}else{
								$.messager.alert('Information',r.message.toString());
							}
						}
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
					}
				});
			},
			openDocument: function(data){
				$.ajax({
					url:globalVars.servicePath+'/open_doc',
					type:'POST',
					dataType:'JSON',
					data:data,
					success:function(r){
						if(!r)return;

						if(r.success=='503'){
							$.messager.alert('Information',r.message.toString());
						}else{
							if(r.success=='200'){
								$.messager.alert('Information',r.message.toString());
								globalVars.tableId2.dataTable().api('true').draw();
							}else{ 
								$.messager.alert('Information',r.message.toString());
							}
						}
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
					}
				});
			}
		}
	};

	var main_detail = {
		register: function(){
			main_detail.EVENTS.register.apply();
		},
		UI: {
			register: function(){

			}
		},
		ROUTINES: {
			register: function(){

			},
			initDataForm: function(){
				$('input#id_detail').val('');
            	$('input#qty').numberbox('setValue','');
            	$('input#deskripsi').textbox('setValue','');
            	$('input#spesifikasi').textbox('setValue','');
            	$('input#price_item').numberbox('setValue','');
            	$('input#price_total').numberbox('setValue','');
			},
			data: function(){
				return {
					id_detail 		: $('input#id_detail').val(),
	            	qty 			: $('input#qty').numberbox('getValue'),
	            	deskripsi 		: $('input#deskripsi').textbox('getValue'),
	            	spesifikasi 	: $('input#spesifikasi').textbox('getValue'),
	            	price_item 		: $('input#price_item').numberbox('getValue'),
	            	price_total 	: $('input#price_total').numberbox('getValue')
				}
			}
		},
		EVENTS: {
			register: function(){
				main_detail.EVENTS.btnClose.apply();
				main_detail.EVENTS.btnUpdate.apply();
			},
			btnClose: function(){
				var oBtn = $('button#btnCloseDetail');
					oBtn.unbind()
						.bind('click',function(){
						var that = $(this);
						var bType = that.attr('data-tag');
							if('CLOSE_DETAIL'==bType)
							{
								main_detail.ROUTINES.initDataForm.apply();
								globalVars.masterEditorDetail.window('close');
							}
						});
			},
			btnUpdate: function(){
				var oBtn = $('button#btnUpdateDetail');
				var index = $('input#id_detail');
					oBtn.unbind()
						.bind('click',function(){
						var that = $(this);
						var bType = that.attr('data-tag');
							if('UPDATE_DETAIL'==bType && (index.val()!="" || index!=undefined))
							{
								main_detail.CRUDS.update(main_detail.ROUTINES.data.apply(),index.val());
								globalVars.tableConfigsDetail.api('true').draw();
							}
						});
			},
			calculate: function(){
				$('input#qty').on('blur',function(){
					alert('blur');	
				});
			}
		},
		CRUDS: {
			register: function(){

			},
			update: function(data,index){
				$.ajax({
					url:globalVars.servicePath+'/update_detail',
					type:'POST',
					dataType:'JSON',
					data:data,
					success:function(r){
						if(!r)return;

						if(r.success=='503'){
							$.messager.alert('Information',r.message.toString());
						}else{
							if(r.success=='200'){
								$.messager.alert('Information',r.message.toString());
								main_detail.ROUTINES.initDataForm.apply();
								globalVars.masterEditorDetail.window('close');
								globalVars.tableConfigs.fnDeleteRow(index);
							}else{
								$.messager.alert('Information',r.message.toString());
							}
						}
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
						console.log(e);
						main_detail.ROUTINES.initDataForm.apply();
						globalVars.masterEditorDetail.window('close');
					}
				});
			}
		}
	};

	main.register.apply();
	main_detail.register.apply();
})