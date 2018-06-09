<?php
error_reporting(0);
include('config.php');
header("Content-type: text/html; charset=utf-8"); 
$mysqli = new mysqli($mysql_host,$mysql_user,$mysql_pwd,$mysql_db);
if($mysqli->connect_errno){
    die('Connect Error:'.$mysqli->connect_error);
}
$mysqli->set_charset("utf8");
if($_POST['classid']==true){
	$query = $mysqli->query("select * from classtables where class_id='{$_POST['classid']}'");
	$list = $query->fetch_assoc();
	$namequery = $mysqli->query("select name from class where id='{$_POST['classid']}'");
	$classname = $namequery->fetch_assoc();?>

	<div class="panel-heading">
				<h4 class="panel-title">
					<b><?php echo $classname['name'];?> 课程表</b>
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
<?php } ?>