$(function(){
	var globalVars= {
		tableConfigs:null,
		tableId: $('table#tEmployee'),
		masterEditor: $('div#masterEditor'),
		servicePath: adam.format('%1/%2',adam.currentHost(),base_url.emailtmpl+'emailtmpl'),
		input:{
			post:[
				$('input#code'),
				$('input#name'),
				$('input#bodymsg')
			]
		}
	};
	//console.log(globalVars.servicePath);
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
                        url: globalVars.servicePath+'/getemployee',
                        type: 'POST',
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
                        { title:'ID',data:"id" },
                        { title:'CODE',data:"code" },
                        { title:'ADD DATE',data:"adddt" },
                        { title:'ADD BY',data:"addby" },
                        { title:'MOD DT',data:"moddt",visible:false },
                        { title:'MOD BY',data:"modby",visible:false },
                        { title:'Judul Email',data:"name" },
                        { title:'Isi Email',data:"bodymsg" },
                        {
                          title: "Action",
                          orderable: false,
                          data: null,
                          // ReSharper disable once UsingOfReservedWord
                          class: "dt-head-center",
                          defaultContent: [
                              "<center>",
                              "<div class=\"btn-group\">",
                              "<button style='display:none' title=\"View Detail Data\" type=\"button\" data-tag=\"view\" class=\"easyui-linkbutton\">View</button>",
                              "<button type=\"button\" title=\"Edit Data Selection\" data-tag=\"edit\" class=\"btn btn-sm btn-default\">Edit</button>&nbsp;&nbsp;",
                              // "<button type=\"button\" title=\"Delete Data Selection\" data-tag=\"delete\" class=\"btn btn-sm btn-danger btn-circle\">Delete</button>",
                              "</div>",
                              "</center>"
                          ].join(""),
                          width: "150px"
                      }
            		]
				});
			}
		},
		EVENTS: {
			register: function(){
				main.EVENTS.eventButtonRow.apply();
				main.EVENTS.btnShowFormMaster.apply();
				main.EVENTS.btnSave.apply();
				main.EVENTS.btnUpdate.apply();
				main.EVENTS.btnClose.apply();
				main.EVENTS.rebindSearchTextBox.apply();
			},
			eventButtonRow: function(){
				globalVars.tableId
				.on('preXhr.dt', function(e, setting, data) {
                  // data.sorder = octapush
                  //     .format(
                  //         '%1 %2',
                  //         main.routines.getColumnData(resources.dtTable, data.order[0x0].column),
                  //         data.order[0x0].dir
                  //     );
                  //console.log(data);
	              })
	              .on('xhr.dt', function(e, setting, data) {
	                  // $.each(data.data,function(index,value){
	                  //   if(value.birthday!="" || value.birthday!=null){
	                  //     value.birthday =value.birthday.slice(0,10).split('-');
	                  //     value.birthday = value.birthday[1]+'/'+value.birthday[2]+'/'+value.birthday[0];
	                  //   }
	                  // });
	              })
	              .on('draw.dt', function() {
	                  main.EVENTS.gridBtnTable.apply();
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
                          	  //console.log(data);
                            if('delete'==bType){
                                $.messager.confirm('My Title', 'Apakah anda ingin menghapus data ini!?', function(r){
					                if (r){
					                	//console.log(data.index);
					                    main.CRUDS.delete(data.data.code.toString(),data.index);
					                }
					            });
                            }else{
                            	var dt = data.data;
                            	var newDate = "";
                            	var dates = new Date();
                            	dates = dates.getDate()+'/'+(dates.getMonth()+1)+'/'+dates.getFullYear();
                            	if(dt!=null || !dt!=undefined){
                            		globalVars.input.post[0].val(dt.code);
                                	globalVars.input.post[1].textbox('setValue',dt.name);
                                	globalVars.input.post[2].textbox('setValue',dt.bodymsg);
                            	}
                               main.ROUTINES.showMasterForm('EDIT',{title:'UPDATE DATA',width:500,height:350});
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
						main.ROUTINES.showMasterForm('ADD',{title:'NEW EMAILTMPL',width:500,height:350});
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
								console.log(main.ROUTINES.data.apply());
								main.CRUDS.create(main.ROUTINES.data.apply());
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
								var data = main.ROUTINES.data.apply();
								main.CRUDS.update(data);
							}
						});
			},
			btnClose: function(){
				var oBtn = $('button#btnClose');
				oBtn.unbind().bind('click',function(){
					var that = $(this);
					var bType = that.attr('data-tag');
					if('CLOSE'==bType)
						main.ROUTINES.initMasterForm.apply();
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
		},
		ROUTINES: {
			register: function(){
				//TO DO HERE CODE
				main.ROUTINES.initMasterForm.apply();
				main.ROUTINES.initWindows.apply();
			},
			initWindows: function(){
				var win = $.messager.progress({
                title:'Please waiting',
                msg:'Loading data...'
	            });
	            setTimeout(function(){
	                $.messager.progress('close');
	            },3000)
			},
			getSelectedRow: function(obj){
				return {
	                index : $(obj).closest('tr').index(),
	                data: globalVars.tableId.dataTable().fnGetData($(obj).closest('tr').index())
              	}
			},
			initMasterForm: function(){
				globalVars.masterEditor
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
			hideMasterForm: function(){
				globalVars.masterEditor
				.window('close');
			},
			initInputData: function(){
				globalVars.input.post[0].val('');
            	globalVars.input.post[1].textbox('setValue','');
            	globalVars.input.post[2].textbox('setValue','');
            	globalVars.input.post[3].datebox('setValue','');
            	globalVars.input.post[4].combobox('setValue','');
            	globalVars.input.post[5].textbox('setValue','');
            	globalVars.input.post[6].textbox('setValue','');
            	globalVars.input.post[7].textbox('setValue','');
            	globalVars.input.post[8].textbox('setValue','');
			},
			data: function(){
				return {
					code 			:globalVars.input.post[0].val(),
					name 			:globalVars.input.post[1].val(),
					bodymsg 		:globalVars.input.post[2].val()
				}
			}
		},
		CRUDS: {
			register: function(){

			},
			create: function(data){
				$.ajax({
					url:globalVars.servicePath+'/create',
					type:'POST',
					dataType:'JSON',
					data:data,
					success:function(r){
						if(!r)return;

						if(r.success=='503'){
							$.messager.alert('Information',r.message.toString());
						}else{
							if(r.success=='200')
							{
								$.messager.alert('Information',r.message.toString());
								main.ROUTINES.hideMasterForm.apply();
								globalVars.tableConfigs.api(true).draw();
							}

						}
						
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
								main.ROUTINES.hideMasterForm.apply();
								globalVars.tableConfigs.api(true).draw();
						}
					},
					error: function(e,x,s){
						$.messager.alert('Alert','Failed : '+ e +' '+ x +' '+ s);
					}
				});
			},
			delete: function(id,index){
				$.ajax({
					url:globalVars.servicePath+'/delete',
					type:'POST',
					dataType:'JSON',
					data:{code:id},
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
			}
		}
	}

	main.register.apply();
})