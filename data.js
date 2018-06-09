$(document).ready(function(e){
  college();
  $('#college').change(function (){
	major();
  });
  $('#major').change(function (){
	year();
  });
  $('#year').change(function (){
	Class();
  });
  $("#submit").click(function (){
	if(document.getElementById("college").value == "-- 请选择 --" || document.getElementById("major").value == "-- 请选择 --" || document.getElementById("year").value == "-- 请选择 --" || document.getElementById("class").value == "-- 请选择 --" || document.getElementById("college").value == "-- 暂无数据 --" || document.getElementById("major").value == "-- 暂无数据 --" || document.getElementById("year").value == "-- 暂无数据 --" || document.getElementById("class").value == "-- 暂无数据 --"){
		alert("请选择全部选项后才能提交");
	}else{
		updateTable();
		$('body,html').animate({ scrollTop: 0 }, 200);
	}
  });
});
//设置学院下拉框
function college(){
    $.ajax({
        async:false,
        url:"college.php",
        dataType:"json",
        success:function(college){
			var info = eval(college);
            var str = "";
			if(info.length > 0){
				str = "<option selected disabled>-- 请选择 --</option>"
			}else{
				str = "<option selected disabled>-- 暂无数据 --</option>"
			}
            $.each(info,function(index){
				str += " <option value='"+info[index].id+"' >"+info[index].name+"</option> ";
			});
            $("#college").html(str);  
        },
		error: function(){
			alert("网络错误！");
		}
    });
}
//设置专业下拉框
function major(){
	var college = $("#college").val();
	$.ajax({
		async:false,
		url:"major.php",
		type: 'POST',
		dataType:"json",
		data:{"college":college},
		success:function(major){
			var info = eval(major);
			var str = "";
			if(info.length > 0){
				str = "<option selected disabled>-- 请选择 --</option>"
			}else{
				str = "<option selected disabled>-- 暂无数据 --</option>"
			}
			$.each(info,function(index){
				str += " <option value='"+info[index].id+"' >"+info[index].name+"</option> ";
			});
            $("#major").html(str);  
		},
		error: function(){
			alert("网络错误！");
		}
	});
}
//设置年下拉框
function year(){
	var major = $("#major").val();
	$.ajax({
		async:false,
		url:"year.php",
		type: 'POST',
		dataType:"json",
		data:{"major":major},
		success:function(year){
			var info = eval(year);
			var str = "";
			if(info.length > 0){
				str = "<option selected disabled>-- 请选择 --</option>"
			}else{
				str = "<option selected disabled>-- 暂无数据 --</option>"
			}
			$.each(info,function(index){
				str += " <option value='"+info[index].year+"' >"+info[index].year+"级</option> ";
			});
            $("#year").html(str);  
		},
		error: function(){
			alert("网络错误！");
		}
	});
}
//设置班级下拉框
function Class(){
	var major = $("#major").val();
	var year = $("#year").val();
	$.ajax({
		async:false,
		url:"class.php",
		type: 'POST',
		dataType:"json",
		data:{"major":major,"year":year},
		success:function(classname){
			var info = eval(classname);
			var str = "";
			if(info.length > 0){
				str = "<option selected disabled>-- 请选择 --</option>"
			}else{
				str = "<option selected disabled>-- 暂无数据 --</option>"
			}
			$.each(info,function(index){
				str += " <option value='"+info[index].id+"' >"+info[index].name+"</option> ";
			});
            $("#class").html(str);  
		},
		error: function(XmlHttpRequest,textStatus, errorThrown){
			alert("网络错误！");
		}
	});
}
//更新表格数据
function updateTable(){
	var classid = $("#class").val();
    $.ajax({
        async:false,
        url:"table.php",
		type: 'POST',
        dataType:"TEXT",
		data:{"classid":classid},
        success:function(college){
		
            $("#table").html(college);  
        },
		error: function(){
			alert("网络错误！");
		}
    });
}