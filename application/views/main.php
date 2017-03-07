    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Basic Layout - jQuery EasyUI Demo</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/bootstrap/easyui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('public/plugins/bootstrap/bootstrap.min.css') ?>" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/icon.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/icon.css'); ?>">
        <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('public/demo.css'); ?>"> -->
        <script type="text/javascript" src="<?php echo base_url('public/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/jquery.easyui.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.min.css">

        
        <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.jqueryui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public/js/core.js'); ?>"></script>
        <style type="text/css">
        	body{
        		font-family: 'arial' !important;
        		margin: 0;
        		padding: 0;
        	}
            .dataTables_wrapper .ui-toolbar {
                padding: 2px !important;
            }
        </style>
    </head>
    <body>

        <div id="mainwindow" class="easyui-layout" fit="true">
            <div data-options="region:'south',split:true" style="height:50px;"></div>
            <div data-options="region:'west',split:true" title="West" style="width:300px;">
            	<div class="easyui-accordion" style="width:100%;" fit="true">
			        <div title="Top Panel" data-options="iconCls:'icon-search',collapsed:false,collapsible:false" style="padding:10px;">
			            <input class="easyui-searchbox" prompt="Enter something here" style="width:100%;height:25px;">
			        </div>
			        <div title="MASTER" style="padding:10px">
			            <p>Master</p>
			        </div>
			        <div title="TRANSAKSI" style="padding:10px">
			            <p>Transaksi</p>
			        </div>
			        <div title="REPORT" style="padding:10px">
			            <p>Transaksi</p>
			        </div>
			        <div title="USER MANAGEMENT" style="padding:10px">
			            <p>Transaksi</p>
			        </div>
			    </div>
            </div>

            <div data-options="region:'center',title:'Main Title',iconCls:'icon-ok'">
                
                <div style="margin: 10px">
                	    <div style="padding:5px 0;">
					        <button id="btnAdd" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Add</button>
					        <button id="btnRemove" class="easyui-linkbutton" data-options="iconCls:'icon-remove'">Remove</button>
					        <button class="easyui-linkbutton" data-options="iconCls:'icon-save'">Save</button>
					        <button class="easyui-linkbutton" data-options="iconCls:'icon-cut',disabled:true">Cut</button>
					        <button id="btnSearch" class="easyui-linkbutton">Search</button>
					        <label>Search By Name : </label><input type="text" name="search" id="search" class="easyui-textbox" data-options="iconCls:'icon-search'" style="width:300px">
					    </div>
				        <div id="tb" style="padding:5px;height:auto">
                            <div style="margin-bottom:5px">
                                <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true"></a>
                                <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true"></a>
                                <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true"></a>
                                <a href="#" class="easyui-linkbutton" iconCls="icon-cut" plain="true"></a>
                                <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true"></a>
                            </div>
                            <div>
                                Date From: <input class="easyui-datebox" style="width:80px">
                                To: <input class="easyui-datebox" style="width:80px">
                                Language: 
                                <input class="easyui-combobox" style="width:100px"
                                        url="<?php echo base_url(); ?>public/data/data.json"
                                        valueField="id" textField="text">
                                <a href="#" class="easyui-linkbutton" iconCls="icon-search">Search</a>
                            </div>
                        </div>
                	<table id="example" class="display" style="width:100%">
				       
				    </table>
                </div>
                
            </div>
        </div>
        <div id="masterEditor" style="padding: 5px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name  :</label>
                    </div>
                    <div class="col-md-6">
                        <input class="easyui-validatebox" type="text" name="name" data-options="required:true" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="email">Email:</label>
                    </div>
                    <div class="col-md-6">
                        <input class="easyui-validatebox" type="text" name="email" data-options="validType:'email'" />
                    </div>
                </div>
            </div>
        </div>
     
     <script type="text/javascript">
     	$(function(){
            var dtTable = null;
            function getdatatable(){
                var tableOptions = $('#example').dataTable( {
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
                        url: "<?php echo site_url('user/getdatatable'); ?>",
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
                    columns: [
                                { title:'ID',data:"id" },
                                { title:'CODE',data:"code" },
                                { title:'ADD DATE',data:"adddt" },
                                { title:'ADD BY',data:"addby" },
                                { title:'MOD DT',data:"moddt" },
                                { title:'MOD BY',data:"modby" },
                                { title:'NAME',data:"name" },
                                { title:'PLACE OF BIRTH',data:"placeofbirth" },
                                { title:"BIRTH DAY", data:"birthday" },
                                { title:"GENDER", data:"gender" },
                                { title:"ADDRESS", data:"address" },
                                { title:"PHONE", data:"phone" },
                                { title:"AVATAR", data:"avatar" },
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
                                      "<button type=\"button\" title=\"Delete Data Selection\" data-tag=\"delete\" class=\"btn btn-sm btn-danger btn-circle\">Delete</button>",
                                      "</div>",
                                      "</center>"
                                  ].join(""),
                                  width: "150px"
                              }
                    ]
                });

                //dtTable = $("table#example").dataTable(tableOptions);
            }

            function eventButtonRow(){
              $("table#example")
              .on('preXhr.dt', function(e, setting, data) {
                  // data.sorder = octapush
                  //     .format(
                  //         '%1 %2',
                  //         main.routines.getColumnData(resources.dtTable, data.order[0x0].column),
                  //         data.order[0x0].dir
                  //     );
                  console.log(data);
              })
              .on('xhr.dt', function(e, setting, data) {
                  //data.data = globalVars.datatableDataFormatter(data.data);
                  // $.each(data.data,function(index,value){
                  //   if(value.name=="ADAM"){
                  //     value.name="<font color='red'>ADAM</font>";
                  //   }
                  // });
              })
              .on('draw.dt', function() {
                  gridButtons();
              });
            }

            function gridButtons(){
                var oDt = $("table#example");
                var oBtn = $('button[data-tag]', oDt);
                    oBtn.unbind()
                        .bind('click',function(){
                          var that = $(this);
                          var bType = that.attr('data-tag');
                          var data = getSelectedRow(that);
                            if('delete'==bType){
                                console.log(data.index);
                            }else{
                                console.log(data.data);
                            }
                        });

            }

            function getSelectedRow(obj){
              return {
                index : $(obj).closest('tr').index(),
                data: $("table#example").dataTable().fnGetData($(obj).closest('tr').index())
              }
            }

            getdatatable();
            eventButtonRow();
            //RefreshData();

         		function initEditor(){
             			    $('#masterEditor').window({
             			    	title:'FORM EDITOR',
        				        width:600,
        				        height:400,
        				        modal:true,
        				        minimizable:false,
        				        maximizable: false,
        				        draggable:true,
        				        resizable:false,
        				        collapsible:false
        				    });
         		     }
            })
     		function RefreshData(){
          var btnAdd = $('button#btnAdd');
              btnAdd.unbind().bind('click',function(){
                //adam.alert('warning','test aja!');
                //initEditor();
                dtTable.api(true).draw();
              });
        }
     	// 	var btnRemove = $('button#btnRemove');
     	// 		btnRemove.unbind().bind('click',function(){
     	// 			adam.msgBox('confirmasi','test aja!',function(r){
     	// 				if(r){
     	// 					alert('ok');
     	// 				}else{
     	// 					return;
     	// 				}
     	// 			});
     	// 		});

     	// 	var btnSearch = $('button#btnSearch');
     	// 		btnSearch.unbind().bind('click',function(){
     	// 			$("#dg").datagrid('load',{
     	// 				search:$('#search').val()
     	// 			});
     	// 		});
      //   var i = 0;
     	// function loadData(){
     	// 	console.log($('#search').val());
     	// 	$("#dg").datagrid({
     	// 		url:'<?php //echo site_url('user/get') ?>',
     	// 		queryParams:{
     	// 			search:$('#search').val()
     	// 		},
     	// 		method:'POST',
     	// 		mode:'remote',
     	// 		pagination:'true',
     	// 		singleSelect:'true',
     	// 		striped:'true',
     		
     	// 		column:[[
     	// 			{field:'id',title:'ID',width:'100'},
     	// 			{field:'adddt',title:'ADD DATE',width:'100'},
     	// 			{field:'addby',title:'ADD BY',width:'100'},
     	// 			{field:'moddt',title:'MODIFIKASI DATE',width:'100'},
     	// 			{field:'modby',title:'MODIFIKASI BY',width:'100'},
     	// 			{field:'name',title:'NAME',width:'100'},
     	// 			{field:'placeofbirth',title:'PLACE OF BIRTH',width:'100'},
     	// 			{field:'birthday',title:'BIRTH DAY',width:'100'},
     	// 			{field:'gender',title:'GENDER',width:'100'},
     	// 			{field:'phone',title:'PHONE',width:'100'},
     	// 			{field:'avatar',title:'AVATAR',width:'100'},
     	// 			//{field:'action',title:'ACTION',width:'100'},
      //               {template: "{{if i++%2 != 0 }}<input type='button' value='My Button with id ${ProductID}' data-id='${ProductID}' onClick ='buttonClickHandler(${ProductID});' />{{/if}} "}
     	// 			// {field:'action',title:'Action',width:150,align:'center',
		    //    //          formatter:function(value,row,index){
		    //    //              if (row.editing){
		    //    //                  var s = '<a href="javascript:void(0)" onclick="saverow(this)">Save</a> ';
		    //    //                  var c = '<a href="javascript:void(0)" onclick="cancelrow(this)">Cancel</a>';
		    //    //                  return s+c;
		    //    //              } else {
		    //    //                  var e = '<a href="javascript:void(0)" onclick="editrow(this)">Edit</a> ';
		    //    //                  var d = '<a href="javascript:void(0)" onclick="deleterow(this)">Delete</a>';
		    //    //                  return e+d;
		    //    //              }
		    //    //          }
		    //    //      }
     	// 		]],
     	// 		frozenColumns:[[
			   //      {field:'action',title:'Action',width:'150'}
			   //  ]],
      //           onLoadSuccess:function(){

      //               // Get this datagrid's panel object
      //               $(this).datagrid('getPanel')

      //                   // for all easyui-linkbutton <a>'s make them a linkbutton
      //                   .find('button.easyui-linkbutton').linkbutton();
                        

      //           }

     	// 	});

     	// 	function buttonClickHandler(buttonId) {
      //           alert("Button with id " + buttonId + " was clicked");
      //       }
                    
     		/*
     		$('#dg').datagrid({
				onLoadSuccess:function(){
					$(this).datagrid('getPanel').find('a.easyui-linkbutton').linkbutton();
					var btnView = $("button[data-action='view']","#dg");
     				var btnEdit = $("button[data-action='edit']","#dg");

     				btnView.unbind().bind('click',function(){
     					console.log($(this).val());
     				});

     				btnEdit.unbind().bind('click',function(){
     					console.log($(this).val());
     				});
				}
			});
			*/
     		// $("#dg").datagrid({
     		// 	onClickRow: function(index,row){
     		// 		var row = $(this).datagrid('getSelections');
     		// 		var rows = $(this).datagrid('getRows');
     				
     		// 		console.log(rows[index]);
     		// 	}
     		// });
     //	}

  //    	function editRows(elemen){
		// 	alert(elemen);
		// }

		// function viewRows(elemen){
		// 	alert(elemen);
		// }

     	//loadData();

   //   		var btnView = $("button#view");
			// var btnEdit = $("button#edit");

			// btnView.unbind().bind('click',function(){
			// 	console.log($(this));
			// });

			// btnEdit.unbind().bind('click',function(){
			// 	console.log($(this));
			// });

      //   var btnView = $("button[data-action='view']");
      //   var btnEdit = $("button[data-action='edit']");
      //   btnView.linkbutton({
      //       onClick: function(){
      //           alert('test');
      //       }
      //   });
        

      //   btnEdit.bind('click',function(){
      //       alert($(this).val());
      //   });

     	// window_size = $(window).height();
     	// console.log(window_size);

   //   	setTimeout(function(){
   //   		$('#dg').datagrid('resize');
			// $('#toolbar').panel('resize');
   //   		// $("div#mainwindow").removeAttr("style");
   //   		// $("div#mainwindow").attr("style","width:100%;height:"+window_size+"px;overflow: hidden;margin: 0 !important;padding: 0 !important");
   //   		//alert(window_size);
   //   	},1000);
  //   function getRowIndex(target){
  //       var tr = $(target).closest('tr.datagrid-row');
  //       return parseInt(tr.attr('datagrid-row-index'));
  //   }
  //   function editrow(target){
  //       $('#tt').datagrid('beginEdit', getRowIndex(target));
  //   }
  //   function deleterow(target){
  //       $.messager.confirm('Confirm','Are you sure?',function(r){
  //           if (r){
  //               $('#tt').datagrid('deleteRow', getRowIndex(target));
  //           }
  //       });
  //   }
  //   function saverow(target){
  //       $('#tt').datagrid('endEdit', getRowIndex(target));
  //   }
  //   function cancelrow(target){
  //       $('#tt').datagrid('cancelEdit', getRowIndex(target));
  //   }


  //   function roundUp(num, precision) {
  //       var ret = 0.0;
  //       ret =  (Math.ceil(num * precision) / precision).toFixed(2);
  //       return ret;
  //   }
 	// //alert(roundUp(57294024.900,6));
     	
  //   })
  //   var a = 81848607.000*0.7
  //   var b = 311901599.000*0.2
  //   console.log(Math.ceil(a*5)/5);
  //   console.log(Math.ceil(b*2)/2);
    msg="";
    var string = msg.toLowerCase();
    var substring = "script error";
    console.log(string.indexOf(substring));
      window.onerror = function (msg, url, lineNo, columnNo, error) {
    var string = msg.toLowerCase();
    var substring = "script error";
    console.log(string.indexOf(substring));
    if (string.indexOf(substring) > -1){
        alert('Script Error: See Browser Console for Detail');
    } else {
        var message = [
            'Message: ' + msg,
            'URL: ' + url,
            'Line: ' + lineNo,
            'Column: ' + columnNo,
            'Error object: ' + JSON.stringify(error)
        ].join(' - ');

        alert(message);
    }

    return false;
};
     </script>
     <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/extensions/FixedColumns/dataTables.fixedColumns.js');?>"></script>
     <script type="text/javascript" src="<?php echo base_url('public/plugins/datatables/js/fnAddDataAndDisplay.js'); ?>"></script>
    </body>
    </html>