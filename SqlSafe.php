<?php
/* 雨伤博客 
 *http://rainss.cn
*/
//过滤规则

$FilterRule = "/'|;|insert into|update(.*)set|drop table|select(.*)from|delete from|drop database/i";
function Filter($value_one, $FilterRule)
{
    if (preg_match($FilterRule, $value_one)) {
        return true;
    } else {
        return false;
    }
}
//过滤POST GET请求
foreach ($_REQUEST as $value) {
    if (Filter($value, $FilterRule) == true) {
        echo "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
<title>非法的操作</title>
<style>
.error{
	height:170px;
	width:400px;
	text-align:center;
	margin:0 auto;
	background-color:#DAEBDD;
	font-size:50px;
}
</style>
</head>
<body>
<div class=\"error\"><br />非法请求</div></body></html>";
        exit;
    }
}
//过滤COOKIE
foreach ($_COOKIE as $value) {
    if (Filter($value, $FilterRule) == true) {
         echo "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
<title>非法的操作</title>
<style>
.error{
	height:170px;
	width:400px;
	text-align:center;
	margin:0 auto;
	background-color:#DAEBDD;
	font-size:50px;
}
</style>
</head>
<body>
<div class=\"error\"><br />非法请求</div></body></html>";
        exit;
    }
}
?>