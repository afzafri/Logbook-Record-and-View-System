<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?></title>

	<!-- Favicon -->
	<link href="./templates/images/uitmlogo.png" rel="shortcut icon">

    <!-- Bootstrap Core CSS -->
    <link href="./templates/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="./templates/dist/css/timeline.css" rel="stylesheet">

    <!-- Pikaday CSS -->
    <link href="./templates/css/pikaday.css" rel="stylesheet">

    <!-- Summernote -->
    <link href="./templates/bower_components/summernote/summernote.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./templates/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  	<!-- Custom 2 -->
  	<link rel="stylesheet" type="text/css" href="./templates/css/design.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

		<div class="noprint">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Log Book Record & View System</a>
            </div>
            <!-- /.navbar-header -->

			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

				<li>
					<a href="./index.php"><i class="fa fa-edit fa-fw"></i>Record Logs</a>
				</li>
				 <li>
					<a href="./view.php"><i class="fa fa-table fa-fw"></i>View Logs</a>
				</li>
				<br>
				<li>
					<div class="logo"></div><br>
					<center><b>UiTM - Afif Zafri <br> Copyright &copy; <?php if(date('Y') == '2016'){echo '2016';}else{echo '2016 - ' . date('Y');} ?> </b></center><br>
				</li>

				</ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>


            <!-- /.navbar-static-side -->
        </nav>
		</div>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
			<div id="desktopTest" class="hidden-xs"></div>
