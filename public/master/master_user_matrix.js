$(function(){
	var globalVars= {
		tableConfigs:null,
		tableId: $('table#masterTable'),
		masterEditor: $('div#masterEditor'),
		servicePath: adam.format('%1/%2',adam.currentHost(),base_url.user_matrix),
		input: {
			employee_matrix:$('select#employee_matrix'),
			rolename_matrix:$('select#rolename_matrix'),
		}
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
                        url: globalVars.servicePath+'/getusermatrix',
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
                        { title:'ID',data:"id" },
                        { title:'CODE EMPLOYEE',data:"code" },
                        { title:'NAME EMPLOYEE',data:"name" },
                        { title:'ID ROLE NAME',data:"id_role",visible:false },
                        { title:'NAME ACCESS ROLE',data:"role_name" },
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
                              "<button type=\"button\" title=\"Edit Data Selection\" data-tag=\"edit\" class=\"easyui-linkbutton\">Edit</button>&nbsp;&nbsp;",
                              "<button type=\"button\" title=\"Delete Data Selection\" data-tag=\"delete\" class=\"easyui-linkbutton\">Delete</button>",
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
				main.EVENTS.btnSave.apply();
				main.EVENTS.btnUpdate.apply();
				main.EVENTS.btnClose.apply();
				main.EVENTS.rebindSearchTextBox.apply();
				main.EVENTS.autocompleteEmployee.apply();
				main.EVENTS.autocompleteRoleName.apply();
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
                  // console.log(data);
	              })
	              .on('xhr.dt', function(e, setting, data) {
	                  //$.each(data.data,function(index,value){
	                    //TODO CODE value.name
	                  //});
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
                            if('delete'==bType){
                                $.messager.confirm('My Title', 'Apakah anda ingin menghapus data ini!?', function(r){
					                if (r){
					                	console.log(data);
					                   	main.CRUDS.delete({id:data.data.id.toString()},data);
					                }
					            });
                            }else{
                            	var dt = data.data;
	                        	if(dt==null || dt==undefined) return;

	                        	globalVars.input.employee_matrix.html('').trigger('change');
	                        	globalVars.input.rolename_matrix.html('').trigger('change');

	                        	globalVars.input.employee_matrix.select2({
	                        		allowClear: true,
	                        		data:[{id:dt.id,text:dt.name}]
	                        	});

	                        	globalVars.input.rolename_matrix.select2({
	                        		allowClear: true,
	                        		data:[{id:dt.id_role,text:dt.role_name}]
	                        	});

	                        	main.EVENTS.autocompleteEmployee.apply();
								main.EVENTS.autocompleteRoleName.apply();
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
								//console.log(main.ROUTINES.data.apply());
								main.CRUDS.create(main.ROUTINES.data.apply());
								globalVars.tableConfigs.api(true).draw(); //TO DO
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
								var data = main.ROUTINES.data.apply();
								main.CRUDS.update(data);
								globalVars.tableConfigs.api(true).draw();
							}
						});
			},
			btnClose: function(){
				var oBtnClose = $('button[data-tag="CLOSE"]');
				oBtnClose.unbind()
						.bind('click',function(){
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
            autocompleteEmployee: function(){
				var that = $('select#employee_matrix');
				that.select2({
	                placeholder: 'Select...',
	                allowClear: true,
	                minimumInputLength: 1,
	                minimumResultsForSearch: 10,
	                ajax: {
	                    url: adam.format('%1/%2',adam.currentHost(),base_url.select2+'select_list/getemployeename'),
	                    dataType: "json",
	                    type: "POST",
	                    data: function (params) {

	                        var queryParameters = {
	                            nPiece: params.term
	                        }
	                        return queryParameters;
	                    },
	                    processResults: function (res) {
	                        var dt = { data: [] };
	                        var sDt = {};
	                        if(!res)return;

	                        $.each(res,function(key,value){
	                             sDt = {
	                                    id: value.id,
	                                    text: value.text
	                                };
	                                dt.data.push(sDt);
	                        });

	                        return {
	                            results: 
	                            $.each(dt.data, function (items) {
	                                return {
	                                	id: items.id,
	                                    text: items.text
	                                }
	                            })
	                        };
	                    }
	                }
	            });
			},
			autocompleteRoleName: function(){
				var that = $('select#rolename_matrix');
				that.select2({
                    placeholder: 'Select...',
                    allowClear: true,
                    minimumInputLength: 1,
                    minimumResultsForSearch: 10,
                    ajax: {
                        url: adam.format('%1/%2',adam.currentHost(),base_url.select2+'select_list/getrolename'),
                        dataType: "json",
                        type: "POST",
                        data: function (params) {

                            var queryParameters = {
                                nPiece: params.term
                            }
                            return queryParameters;
                        },
                        processResults: function (res) {
                            var dt = { data: [] };
                            var sDt = {};
                            if(!res)return;

                            $.each(res,function(key,value){
                                 sDt = {
                                        id: value.id,
                                        text: value.text
                                    };
                                    dt.data.push(sDt);
                            });

                            return {
                                results: 
                                $.each(dt.data, function (items) {
                                    return {
                                    	id: items.id,
                                        text: items.text
                                    }
                                })
                            };
                        }
                    }
                });
			}
		},
		ROUTINES: {
			register: function(){
				//TO DO HERE CODE
				main.ROUTINES.initMasterForm.apply();
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

				$('button#btnUpdate').hide();
				$('button#btnSave').show();

				globalVars.input.employee_matrix.html('').trigger('change');
				globalVars.input.rolename_matrix.html('').trigger('change');

				globalVars.input.employee_matrix.select2({
            		placeholder: 'Select...',
                    allowClear: true,
                    minimumInputLength: 1,
                    minimumResultsForSearch: 10
            	});

				globalVars.input.rolename_matrix.select2({
            		placeholder: 'Select...',
                    allowClear: true,
                    minimumInputLength: 1,
                    minimumResultsForSearch: 10
            	});

            	main.EVENTS.autocompleteEmployee.apply();
				main.EVENTS.autocompleteRoleName.apply();
			},
			data: function(){
				return {
					idEmployee 		:globalVars.input.employee_matrix.select2('val'),
					idRoleName 		:globalVars.input.rolename_matrix.select2('val') //TO DO
				}
			},
			dataMatrix: function(r){
				if(r.employee=="1")
    				globalVars.input.post[2].prop('checked',true).val('1');
    			else
    				globalVars.input.post[2].prop('checked',false).val('');

    			if(r.customer=="1")
    				globalVars.input.post[3].prop('checked',true).val('1');
    			else
    				globalVars.input.post[3].prop('checked',false).val('');

    			if(r.pj=="1")
    				globalVars.input.post[4].prop('checked',true).val('1');
    			else
    				globalVars.input.post[4].prop('checked',false).val('');

    			if(r.registerbkdn=="1")
    				globalVars.input.post[5].prop('checked',true).val('1');
    			else
    				globalVars.input.post[5].prop('checked',false).val('');

    			if(r.registercom=="1")
    				globalVars.input.post[6].prop('checked',true).val('1');
    			else
    				globalVars.input.post[6].prop('checked',false).val('');

    			if(r.print_bkdn=="1")
    				globalVars.input.post[7].prop('checked',true).val('1');
    			else
    				globalVars.input.post[7].prop('checked',false).val('');

    			if(r.invoice=="1")
    				globalVars.input.post[8].prop('checked',true).val('1');
    			else
    				globalVars.input.post[8].prop('checked',false).val('');

    			if(r.role=="1")
    				globalVars.input.post[9].prop('checked',true).val('1');
    			else
    				globalVars.input.post[9].prop('checked',false).val('');

    			if(r.user_matrix=="1")
    				globalVars.input.post[10].prop('checked',true).val('1');
    			else
    				globalVars.input.post[10].prop('checked',false).val('');
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
								$.messager.alert('Information',r.message.toString());
								main.ROUTINES.initInputData.apply();
								main.ROUTINES.hideMasterForm.apply();
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
			}
		}
	}

	main.register.apply();
})