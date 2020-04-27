
<style>
    .demo-icon{text-align: center;line-height: 38px;cursor: pointer;}
    .demo-icon i{font-size: 32px;}
</style>
<script>
    $(function () {
        $('.demo-icon').on('click',function () {
            $('#icon').val($(this).find('.icon-class').text());
            $('#modal-icon_select').modal('hide');
        })
    })
</script>
<div id="modal-icon_select" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <div class="modal-title">这是一个标题</div>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-font_awesome-tab" data-toggle="pill" href="#pills-font_awesome" role="tab" aria-controls="pills-font_awesome" aria-selected="true">Font-Awesome Icons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-simple_line-tab" data-toggle="pill" href="#pills-simple_line" role="tab" aria-controls="pills-simple_line" aria-selected="false">Simple-Line Icons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-flaticons-tab" data-toggle="pill" href="#pills-flaticons" role="tab" aria-controls="pills-flaticons" aria-selected="false">Flations Icons</a>
                    </li>
                </ul>

                <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-font_awesome" role="tabpanel" aria-labelledby="pills-font_awesome-tab">
                        <?import('font_awesome.php')?>
                    </div>
                    <div class="tab-pane fade" id="pills-simple_line" role="tabpanel" aria-labelledby="pills-simple_line-tab">
                        <?import('simple_line.php')?>
                    </div>
                    <div class="tab-pane fade" id="pills-flaticons" role="tabpanel" aria-labelledby="pills-flaticons-tab">
                        <?import('flaticons.php')?>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>