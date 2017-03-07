$(function(){
		var globalVars = {
			tableMaster: $('div#masterEditor'),
			input: [$('input#username'),$('input#password'),$('input#cpassword')],
			code:$('input#id[data-tag="CODE"]'),
			button: {
				close: $('button#btnCancel'),
				save: $('button#btnUpdate')
			},
			servicePath: adam.format('%1/%2',adam.currentHost(),base_url.update_account),
		}
		console.log(adam.format('%1%2',globalVars.servicePath,'/update_account'));
		var main = {
			register: function(){
				main.UI.register.apply();
				main.EVENTS.register.apply();
			},
			UI: {
				register: function(){
					main.UI.initWindows.apply();
					main.UI.initInput.apply();
				},
				initWindows: function(){
					globalVars.tableMaster
					.window({
	 			    	title:'RESET PASSWORD',
				        width:500,
				        height:265,
				        modal:false,
				        position: { my: "center", at: "center", of: window },
				        minimizable:false,
				        maximizable: false,
				        draggable:false,
				        resizable:true,
				        collapsible:false
				    });
				    $('a.panel-tool-close').remove();
				},
				initInput: function(){
					//globalVars.input[0].textbox('setValue','');
					globalVars.input[1].textbox('setValue','');
					globalVars.input[2].textbox('setValue','');
				},
				data: function(){
					return {
						id 			:globalVars.code.val(),
						username 	:globalVars.input[0].textbox('getValue'),
						password 	:globalVars.input[1].textbox('getValue')
					}
				}
			},
			EVENTS: {
				register: function(){
					main.EVENTS.btnClose.apply();
					main.EVENTS.btnSave.apply();
				},
				btnClose: function(){
					globalVars.button.close
					.unbind()
					.bind('click',function(){

					});
				},
				btnSave: function(){
					globalVars.button.save
					.unbind()
					.bind('click',function(){
						var that = $(this);
						var bType = that.attr('data-tag');
						if('UPDATE'==bType)
						{
							main.EVENTS.checkingDataAndSend.apply();
						}
					});
				},
				checkingDataAndSend: function(){
					
					if(globalVars.input[0].textbox('getValue')=='')
					{
						$.messager.alert('ALERT','username tidak boleh kosong!');
						return;
					}
					else if(globalVars.input[1].textbox('getValue')=='')
					{
						$.messager.alert('ALERT','Password tidak boleh kosong!');
						return;
					}
					else if(globalVars.input[2].textbox('getValue')=='')
					{
						$.messager.alert('ALERT','Konfirmasi Password tidak boleh kosong!');
						return;
					}
					else if(globalVars.input[0].textbox('getValue').length<5)
					{
						$.messager.alert('ALERT','Username maksimal 5 karakter');
						return;
					}
					else if(globalVars.input[1].textbox('getValue').length<8)
					{
						$.messager.alert('ALERT','Password maksimal 8 karakter');
						return;
					}
					else if(globalVars.input[2].textbox('getValue').length<8)
					{
						$.messager.alert('ALERT','Konfirmasi Password maksimal 8 karakter');
						return;
					}
					else if(globalVars.input[2].textbox('getValue')!=globalVars.input[1].textbox('getValue'))
					{
						$.messager.alert('ALERT','Konfirmasi & Password tidak sama!');
						return;
					}else{
						main.EVENTS.AJAX.update(main.UI.data.apply());
					}
				},
				AJAX: {
					update: function(data){
						$.ajax({
							url:adam.format('%1%2',globalVars.servicePath,'/update'),
							type:'POST',
							dataType:'JSON',
							data:data,
							success: function(r){
								if(!r)return
								if(r.success=='503')
									$.messager.alert('SUCCESS',r.message);
								if(r.success=='200')
								{
									$.messager.alert('SUCCESS',r.message);
									main.UI.initInput.apply();
								}
							},
							error: function(e,h,r){
								$.messager.alert('ALERT','FAILED :'+e,+' '+h+' '+r);
							}
						});
					}
				}
			}
		}
		main.register.apply();
	});