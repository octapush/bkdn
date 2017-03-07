<!DOCTYPE html>
<html>
<head>
	<title>BKDN</title>
		<meta charset="UTF-8">
        <title>BKDN</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/bootstrap/easyui.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/themes/icon.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/demo/demo.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('public/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/jquery.easyui.min.js'); ?>"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/plugins/datatables/css/themes_smoothness_jquery-ui.css'); ?>">
        
        <script type="text/javascript" src="<?php echo base_url('public/js/core.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('public/js/globalurl.js'); ?>"></script>
        <style type="text/css">
        	body{
        		font-family: 'arial' !important;
        		margin: 0;
        		padding: 0;
        	}
            .dataTables_wrapper .ui-toolbar {
                padding: 2px !important;
            }
            .tb{
                width:100%;
                margin:0;
                padding:5px 4px;
                border:1px solid #ccc;
                box-sizing:border-box;
            }
            .side-menu{
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .side-menu li{
                list-style: none;
            }
            .side-menu li a,.side-menu li a:link,.side-menu li a:hover{
                color: #777;
                text-decoration: none;
                font-size: 14px;
                padding: 5px;
            }
            .side-menu li a:hover{
                color: #aaa;
                text-decoration: underline;
            }
            table.dataTable{
                font-size: 10px !important;
            }
            .ui-widget-header{
                color: #444;
                background: #f5f5f5;
                background-repeat: repeat-x;
                border: 1px solid #bbb;
                background: -webkit-linear-gradient(top,#ffffff 0,#e6e6e6 100%);
                background: -moz-linear-gradient(top,#ffffff 0,#e6e6e6 100%);
                background: -o-linear-gradient(top,#ffffff 0,#e6e6e6 100%);
                background: linear-gradient(to bottom,#ffffff 0,#e6e6e6 100%);
                background-repeat: repeat-x;
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffffff,endColorstr=#e6e6e6,GradientType=0);
                text-decoration: none;
                display: inline-block;
                overflow: hidden;
                margin: 0;
                padding: 0;
                outline: none;
                text-align: center;
                vertical-align: middle;
                width: 100%;
            }
            table>thead>tr>th.table:hover{
                cursor: pointer;
            }
            .table.dataTable.no-footer{
                border-bottom: none !important;
            }
            table.table tr td{
                border-collapse: collapse;
                border:solid 1px #eee;
                width: 100%;
            }
            .menu-child,.menu-child:link,.menu-child:hover{
                text-decoration: none;
                color: #302C2C !important;
            }
            .menu-child:hover{
                color:#242121;
            }
        </style>
</head>
<body>
<div id="mainwindow" class="easyui-layout" fit="true">
    <div data-options="region:'south',split:true" style="padding:10px 0 20px 10px">
        <?php echo "<div data-tag='welcome'>Selamat datang : <b>".$this->session->userdata('name')."</b></div>"; ?>
    </div>
	    <div data-options="region:'west',split:true" title="BKDN" style="width:250px;">
	    	<div class="easyui-accordion" style="width:100%;">
                <?php $this->load->view('pages/side_menu'); ?>
		    </div>
	    </div>
        <?php
            $page = $this->uri->segment(2);
            if(!empty($page)){
                if($page=="pj"){
                    $page = 'Home > Jenis Perjanjian';
                }else{
                    $page = 'Home > '.$page;
                }
            }
        ?>
	    <div data-options="region:'center',title:'<?php echo $page; ?>',iconCls:'icon-ok'">

