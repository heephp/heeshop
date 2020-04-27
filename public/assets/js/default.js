

//Notify
/*$.notify({
	icon: 'flaticon-alarm-1',
	title: '欢迎',
	message: '欢迎登录使用HeeFramwork',
},{
	type: 'info',
	placement: {
		from: "bottom",
		align: "right"
	},
	time: 1000,
});*/


//confrim
$('.delete').click(function(e) {
	var t=$(this);
	swal({
		title: '温馨提示',
		text: "确定删除吗？",
		type: 'warning',
		buttons:{
			confirm: {
				text : '确定删除!',
				className : 'btn btn-success'
			},
			cancel: {
				visible: true,
				className: 'btn btn-danger'
			}
		}
	}).then((Delete) => {
		if (Delete) {

				location.href=t.attr('url');

		} else {
			swal.close();
		}
	});
});


$('.vcode').on('click',function(e){
	$(e).attr('src','/admin/index/vcode');
})

function uploadfile(url,file,form,success){
	var fileName = $('#'+file).val();　　　　　　　　　　　　　　　　　　//获得文件名称
	var fileType = fileName.substr(fileName.length-4,fileName.length);　　//截取文件类型,如(.xls)
	if(fileType=='.jpg' || fileType=='.gif' || fileType=='.png'){　　　　　//验证文件类型,此处验证也可使用正则
		$.ajax({
			url: url,　　　　　　　　　　//上传地址
			type: 'POST',
			cache: false,
			data: new FormData($('#'+form)[0]),　　　　　　　　　　　　　//表单数据
			processData: false,
			contentType: false,
			success:success
		});
	}else{
		//$("#fileTypeError").html('*上传文件类型错误,支持类型: .xls .doc .pdf');
		msg('头像上传','文件格式错误，支持:jpg,png,gif')
	}
}

function alert(msg) {
	swal(msg, {
		buttons: {
			confirm: {
				className : 'btn btn-success'
			}
		},
	});
}

function msg(title,content,icon) {
	swal(title, content, {
		icon : icon==0?"info":icon==1?'success':icon==2?'error':'warning',
		buttons: {
			confirm: {
				className : 'btn btn-warning'
			}
		},
	});
}
