<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>优选在沃-AP后台</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="frameset/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="frameset/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="plugins/html5shiv/html5shiv.js"></script>
        <script src="plugins/html5shiv/respond.min.js"></script>
    <![endif]-->
	<link href="frameset/css/frameset.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-blue" style="overflow: hidden;">

<div class="wrapper">
	<div id="headerBox">
		<%include file='main_header.tpl'%>
	</div>
	<div id="sidebarBox">
		<%include file='main_sidebar.tpl'%>
	</div>
	<div id="contentBox">
		<%block name="main_content"%><%/block%>
	</div>
</div>

<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="frameset/js/frameset.js" type="text/javascript"></script>

</body>
</html>