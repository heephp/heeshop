
<!--列表模板-->
<div class="modal" tabindex="-1" role="dialog" id="modal_selectfile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">请选择模板文件：（当前模板目录）</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fileTree"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
<script src="/assets/plugin/fileTree/jquery.easing.js" type="text/javascript"></script>
<script src="/assets/plugin/fileTree/jqueryFileTree.js" type="text/javascript"></script>
<link href="/assets/plugin/fileTree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
<style>
    #fileTree{
        border: 1px solid #f5f5f5;
        padding: 10px;
        font-size: 16px !important;
    }
</style>

<script>

    $(function () {

        $('#select_template,#template').on('click',function () {

            $('#modal_selectfile').modal('show');

            $('#fileTree').fileTree({
                root: '/',
                script: '<?=url('moban/ajax_template_dir')?>'
            }, function (file) {
                $('#template').val(file.substr(0,file.length-4));
                $('#modal_selectfile').modal('hide');
            });

        })

    })



</script>