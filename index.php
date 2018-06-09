<?php
include('config.php');
require("./classes/yb-globals.inc.php");
require_once 'config.php';
//初始化
$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);
$iapp  = $api->getIApp();
//连接数据库
$mysqli = new mysqli($mysql_host,$mysql_user,$mysql_pwd,$mysql_db);
if($mysqli->connect_errno){
    die('Connect Error:'.$mysqli->connect_error);
}
$mysqli->set_charset("utf8");
//初始化变量
$token = "";
$username = "";
$classname = $_COOKIE["yb_classname"]==true?$_COOKIE["yb_classname"]:"";
$classid = "";
if(@$_GET['act'] == 'logout'){
	$api->request('oauth/revoke_token', array('client_id'=>$api->getConfig('appid')), true);
	setcookie("yb_realname",'', time()-3600*24);
	setcookie("yb_token",'', time()-3600*24);
	setcookie("yb_classname",'', time()-3600*24);
	echo "<script>alert(\"你已退出登录系统将不会为你自动选择班级\");</script>";
}else{
	if($_COOKIE["yb_token"]){
		$token = $_COOKIE["yb_token"];
	}else{
		try {
		   //轻应用获取access_token
		   $info = $iapp->perform(); 
		   $token = $info['visit_oauth']['access_token'];
		   if($token == true){
			   setcookie("yb_token",$token, time()+3600*24);
		   }
		   
		} catch (YBException $ex) {
			//未授权则跳转至授权页面
			if(@$_GET['act'] == 'login'){
				header("Location:https://openapi.yiban.cn/oauth/authorize?client_id=".$config['AppID']."&redirect_uri=".$config['CallBack']."&state=gzmu");
			}
		}
	}
	//设置access_token
	//向服务器请求获取用户信息
	if($_COOKIE["yb_realname"]){
		$username = $_COOKIE["yb_realname"];
	}else{
		$api->bind($token);
		$user = $api->request('user/verify_me');
		$username = $user['info']['yb_realname'];
		$classname = $user['info']['yb_classname'];
		setcookie("yb_realname",$username, time()+3600*24);
		setcookie("yb_classname",$classname, time()+3600*24);
		
	}						
	if($classname){
			$query = $mysqli->query("select id from class where name='{$classname}'");
				if($query == true){
					$info = $query->fetch_assoc();
					if(count($info)>0){
						$classid = $info['id'];
					}else{
						echo "<script>alert(\"抱歉系统找不到你的班级，请选择你的班级！\");</script>";
					}
				}
	}
	$query = $mysqli->query("select * from classtables where class_id='{$classid}'");
	$list = $query->fetch_assoc();
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8"> 
	<title>贵民大在线课表 - 课表轻应用</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="./data.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
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
			<img src="./logo.png" height="80%">
			</a>
			<button class="navbar-toggle collapsed" data-toggle="collapse"  data-target="#mynavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<div id="mynavbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#"><span class="glyphicon glyphicon-calendar"></span>&nbsp;查看课表</a></li>
				<li><a href="about.php"><span class="glyphicon glyphicon-book"></span>&nbsp;关于课表</a></li>
				<!-- <li><a href=""><span class="glyphicon glyphicon-tags"></span>&nbsp;关于易班</a></li> -->
				<li><a href="question.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp;问题反馈</a></li>	
			</ul>
			<!-- 导航条中的下拉菜单 -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>  &nbsp;<?php if($username == false):?>请登录<?php else: echo "欢迎:".$username; endif;?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if($username == false):?><li><a href="?act=login">登录</a></li><?php endif?>
						<?php if($username == true):?><li><a href="#"><?php echo $classname;?></a></li>
						<li><a href="?act=logout">注销</a></li><?php endif?>
					</ul>
				</li>
			</ul>
		</div>
</nav>
<div class="container">
	<div class="col-md-8">
		<div class="panel panel-primary" id="table">
			<div class="panel-heading">
				<h4 class="panel-title">
					<b><?php echo $classname;?> 课程表</b>
				</h4>
			</div>
			<table class="table table-bordered table-hover">
				<tr>
					<th>&nbsp;</th>
					<th>Mon</th>
					<th>Tues</th>
					<th>Wed</th>
					<th>Thur</th>
					<th>Fir</th>
				</tr>
				<!-- 第一节课 -->
				<tr>
					<th>1</th>
					<td><?php echo $list['Mon_1']==true?$list['Mon_1']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_1']==true?$list['Tues_1']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_1']==true?$list['Wed_1']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_1']==true?$list['Thur_1']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_1']==true?$list['Fir_1']:'&nbsp;';?></td>
				</tr>
			   <!-- 第二节课 -->
				<tr>
					<th>2</th>
					<td><?php echo $list['Mon_2']==true?$list['Mon_2']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_2']==true?$list['Tues_2']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_2']==true?$list['Wed_2']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_2']==true?$list['Thur_2']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_2']==true?$list['Fir_2']:'&nbsp;';?></td>
				</tr>
				<!-- 第三节课 -->
				<tr>
					<th>3</th>
					<td><?php echo $list['Mon_3']==true?$list['Mon_3']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_3']==true?$list['Tues_3']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_3']==true?$list['Wed_3']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_3']==true?$list['Thur_3']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_3']==true?$list['Fir_3']:'&nbsp;';?></td>
				</tr>
				<!-- 第四节课 -->
				<tr>
					<th>4</th>
					<td><?php echo $list['Mon_4']==true?$list['Mon_4']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_4']==true?$list['Tues_4']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_4']==true?$list['Wed_4']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_4']==true?$list['Thur_4']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_4']==true?$list['Fir_4']:'&nbsp;';?></td>
				</tr>
				<tr>
					<th colspan="6">AFTERNOON</th>
				</tr>
				<!-- 第五节课 -->
				<tr>
					<th>5</th>
					<td><?php echo $list['Mon_5']==true?$list['Mon_5']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_5']==true?$list['Tues_5']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_5']==true?$list['Wed_5']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_5']==true?$list['Thur_5']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_5']==true?$list['Fir_5']:'&nbsp;';?></td>
				</tr>
				<!-- 第六节课 -->
				<tr>
					<th>6</th>
					<td><?php echo $list['Mon_6']==true?$list['Mon_6']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_6']==true?$list['Tues_6']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_6']==true?$list['Wed_6']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_6']==true?$list['Thur_6']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_6']==true?$list['Fir_6']:'&nbsp;';?></td>
				</tr>
				<!-- 第七节课 -->
				<tr>
					<th>7</th>
					<td><?php echo $list['Mon_7']==true?$list['Mon_7']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_7']==true?$list['Tues_7']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_7']==true?$list['Wed_7']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_7']==true?$list['Thur_7']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_7']==true?$list['Fir_7']:'&nbsp;';?></td>
				</tr>
				<!-- 第八节课 -->
				<tr>
					<th>8</th>
					<td><?php echo $list['Mon_8']==true?$list['Mon_8']:'&nbsp;';?></td>
					<td><?php echo $list['Tues_8']==true?$list['Tues_8']:'&nbsp;';?></td>
					<td><?php echo $list['Wed_8']==true?$list['Wed_8']:'&nbsp;';?></td>
					<td><?php echo $list['Thur_8']==true?$list['Thur_8']:'&nbsp;';?></td>
					<td><?php echo $list['Fir_8']==true?$list['Fir_8']:'&nbsp;';?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">选择我的班级</div>
			</div>
			<div class="panel-body">
				<div class="alert alert-warning">如果你发现系统为你选择或者你选错班级请在下面进行更换,自动选择班级只在登录后有效!
				</div>
				<!--<form>-->
				<label>选择学院：</label>
				<select class="select" id="college" name="college">
				</select>
				<br />
				<label>选择专业：</label>
				<select class="select" id="major" name="major">
				</select>
				<br />
				<label>选择年级：</label>
				<select class="select" id="year" name="year">
				</select>
				<br />
				<label>选择班级：</label>
				<select class="select" id="class" name="class">
				</select>
				<br />
				<label>提交信息：</label>
				<input type="submit" id="submit" value="确认选择我的班级"/>
				<!--</form>-->
			</div>
			<div class="panel-footer"><small>
			Copyright &copy; 2017 by 贵民大易班工作站.雨落凋殇. All rights reserved.</small>
			</div>
		</div>
	</div>
</div>

</body>
</html>