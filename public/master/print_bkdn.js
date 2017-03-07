$(function(){
		var globalVars = {
			servicePath: adam.format('%1/%2',adam.currentHost(),base_url.register_bkdn+'registerbkdn'),
			FORM: {
				input: null
			}
		}

		var main = {
			register: function(){
				main.EVENT.register.apply();
			},
			EVENT: {
				register: function(){
					main.EVENT.header.apply();
					main.EVENT.autocomplete.apply();
				},
				header: function(){
					var oBtn = $('button#btnSearch');
					oBtn.unbind()
						.bind('click',function(){
							var cSearch = $('select#search').select2('val');
							if(cSearch==null || cSearch==""){
								$.messager.alert('Alert','Silahkan isi field pencarian!');
								cSearch.focus();
							}
							//console.log(cSearch.val());
							main.Http.header(cSearch);
						});
				},
				autocomplete: function(){
					var that = $('select#search');
					that.select2({
                        placeholder: 'Select...',
                        allowClear: true,
                        minimumInputLength: 3,
                        minimumResultsForSearch: 10,
                        ajax: {
                            url: adam.format('%1/%2',adam.currentHost(),base_url.select2+'select_list/getno_kontrak'),
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
			Http: {
				register: function(){
					$.noops();
				},
				header: function(data){
					$.ajax({
						url: globalVars.servicePath+'/print_bkdn',
                      	data: {findNo:data},                         
                      	type: 'POST',
                      	dataType:'JSON',
                      	success: function(r){
                      		if(!r)return;

                      		if(r.header=="FALSE"){
                      			$.messager.alert("Alert",r.MSG);
                      			return;
                      		}else{
                      			var header = r.header;
                      			var detail = r.detail;

                      			var tbldetail = $('table#tbldetail>tbody').html('');

                      			$('td#customer_name').text(': '+header[0x0].customer_name);
                      			$('label#customer_address').text(': '+header[0].customer_address);
                      			$('td#no_kontrak').text('Kontrak No. '+header[0].no_kontrak);
                      			$('td#begindate').text('2. Tanggal (Date) '+header[0].begindate);
                      			$('td#total_amount').text(': Rp. '+header[0].total_amount);
                      			$('td#begdaEnda').text(': '+header[0].begindate+' - '+header[0].enddate);
                      			$('td#lingkup_pekerjaan').html(': '+header[0].lingkup_pekerjaan);
                      			$('td#dasar_pelaksanaan_kerja').html(': '+header[0].dasar_pelaksanaan_pekerjaan);
                      			$('div#cara_pembayaran').html(header[0].cara_pembayaran);
                      			$('td#pelaksanaan_pekerjaan').html(': '+header[0].pelaksanaan_pekerjaan);
                      			$('td#asuransi_dan_jaminan').html(': '+header[0].asuransi_dan_jaminan);
                      			$('td#lain_lain').html(': '+header[0].lain_lain);
                      			$('td#nama_perusahaan').text(header[0].customer_name);
                      		}

                      		var i = 0;
                      		var dataDetail="";
                      		$.each(detail,function(key,values){
                      			i+=1;
                      			dataDetail+=
                      					'<tr>'+
                      					'<td>'+ i +'</td>'+
                      					'<td>'+ values.qty+'</td>'+
                      					'<td>'+ values.deskripsi+'</td>'+
                      					'<td>'+ values.spesifikasi_standart+'</td>'+
                      					'<td>'+ values.price_per_item+'</td>'+
                      					'<td>'+ values.total_price+'</td>'+
                      					'</tr>';
                      		});
                      		tbldetail.html(dataDetail);
                      		$('#frmFieldSet').hide();
                      		$('img.logo').css({"top":"50px"});
                      		var a = $('select#search').val('').trigger('change');
                      		
                      		var w = window.print();
                      		if(!w){
                      			$('#frmFieldSet').show();
                      			$('img.logo').css({"top":"120px"});
                      		}
                      		
                      	},
                      	error: function(e){
                      		$.messager.alert("Alert","Error : "+ e);
                      	}
					});
				}
			}

		}
		main.register.apply();
	});