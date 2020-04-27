
function markallread(url) {
    //alert(url)
    $.get(url,function(data) {
        if(data.state=='ok'){
            $('.notif-center').html('');
            swal({
                title: "消息",
                text: "您已成功标记为已读",
                icon: "success",
                buttons: {
                    confirm: {
                        text: "确定",
                        value: true,
                        visible: true,
                        className: "btn btn-success",
                        closeModal: true
                    }
                }
            });
        }
    })
}