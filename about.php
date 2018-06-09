<?php
error_reporting(0);
$username = $_COOKIE["yb_realname"]==true?$_COOKIE["yb_realname"]:"";
$classname = $_COOKIE["yb_classname"]==true?$_COOKIE["yb_classname"]:"";
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8"> 
	<title>贵民大在线课表 - 课表轻应用</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
	p{
		text-indent:2em;
	}
	td,th{
		text-align:center;
	}
	th{
		background-color:#fff;
	}
	.select{
		width:100%;
		margin-bottom:10px;
		text-align:center;
		font-weight:bold;
		font-size:1em;
		border: 1px solid #000;
		border-radius:8px;
		background-color:#fff;
		height:32px;
	}
	input[type=submit]{
		text-align:center;
		font-weight:bold;
		font-size:1em;
		border-width:2;
		border-color:#000;
		border-radius:8px;
		width:100%;
		background-color:#fff;
		height:32px;
		}
	.panel-primary>.panel-heading{
		color:#fff;
		background-color: #00a65a;
		border-color:#00a65a;
	}
	.navbar-inverse .navbar-nav >li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		background-color:transparent;
		color: #fff;
	}
	.navbar-inverse{
		background-color:#3c8dbc;
		border-color:#3c8dbc;
		color: #fff;
	}
	.navbar-inverse .navbar-nav>li>a{
		color:#fff;
	}
	.navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover{
		background-color: #3c8dbc;
	}
	.navbar-inverse .navbar-toggle {
    	border-color: #fff;
	}
	   .col-md-8,.col-md-4{
		padding-right:5px;
		padding-left:5px;
	}
	.navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
		color: #fff;
		background-color: rgba(40, 98, 130, 0.32);
	}
	.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover {
		color: #fff;
		background-color: rgba(40, 98, 130, 0.32);
	}
	.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
		color: #c0dcd8;
	}
	</style>
</head>
<body scrollTop="0">
<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a href="" class="navbar-brand">
			<img src="./logo.png" height="100%">
			</a>
			<button class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#mynavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<div id="mynavbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;查看课表</a></li>
				<li class="active"><a href="#"><span class="glyphicon glyphicon-book"></span>&nbsp;关于课表</a></li>
				<!-- <li><a href=""><span class="glyphicon glyphicon-tags"></span>&nbsp;关于易班</a></li> -->
				<li><a href="question.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;问题反馈</a></li>	
			</ul>
			<!-- 导航条中的下拉菜单 -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>  &nbsp;<?php if($username == false):?>请登录<?php else: echo "欢迎:".$username; endif;?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if($username == false):?><li><a href="index.php?act=login">登录</a></li><?php endif?>
						<?php if($username == true):?><li><a href="#"><?php echo $classname;?></a></li>
						<li><a href="index.php?act=logout">注销</a></li><?php endif?>
					</ul>
				</li>
			</ul>
		</div>
</nav>
<div class="container">
	<!--<div class="col-md-8">-->
		<div class="panel panel-primary" id="table">
			<div class="panel-heading">
				<h4 class="panel-title">
					<b><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;关于课程表</b>
				</h4>
			</div>
			<div class="panel-body">
				<div class="alert alert-info">
					<p>课程表，是帮助学生了解课程安排的一种简单表格，简称课表。课程表（简称为课表）分为两种：一是学生使用的；二是教师使用的。学生使用的课表与任课师使用的课表在设计结构上都是一个简单的二维表格，基本上没有什么区别，只是填写的内容有所不同。
					</p>
					<p>
						本课程表设计的目的是方便学生查询自己每一天的课程信息
					</p>
				</div>
			</div>
		</div>
	<!--</div>-->
	<!--<div class="col-md-4">-->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">部分课程简介说明</div>
			</div>
			<div class="panel-body">
				<div class="alert alert-warning"><p>因部分课程名称过长，加入表格中会影响表格整体的显示效果，因此我们将部分名称较长的课程简写以后将全称记录在这里，方便用户对比查看！</p>
				</div>
				<table class="table table-striped">
					<caption>课程简称全称一览表</caption>
					<tr class="info">
						<th>简称</th>
						<th>课程全称</th>
					</tr>
					<tr>
						<td>毛概</td>
						<td>毛泽东思想和中国特色社会主义理论体系概论</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</table>
			</div>
			<div class="panel-footer">
			&nbsp;&copy;2017&nbsp;贵民大易班工作站
			</div>
		</div>
	<!--</div>-->
</div>

</body>
</html>