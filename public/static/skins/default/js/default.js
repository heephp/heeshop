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

$(function (){
    $('#vcode').on('click',function (){
        $(this).attr('src','/home/user/vcode');
    })
})