<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">数据表</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">表字段显示管理</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span>不选择则全部显示，并允许删除</span>
<form action="<?=url('field_show_save')?>" method="post">
    <input type="hidden" name="model_id" value="<?=$m['model_table_id']?>">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th><input type="checkbox" onclick="$(':checkbox').prop('checked',$(this).prop('checked'))">字段</th>
                        <th><input type="checkbox" id="allow_manger" onclick="check('allow_manger')">管理表格(后台)</th>
                        <th><input type="checkbox" id="allow_edit" onclick="check('allow_edit')">编辑表单(后台)</th>
                        <th><input type="checkbox" id="allow_user_manager" onclick="check('allow_user_manager')">管理表格(前台)</th>
                        <th><input type="checkbox" id="allow_user_edit" onclick="check('allow_user_edit')">编辑表单(前台)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?foreach ($fields as $f){?>
                            <tr>
                                <th><input type="checkbox" id="row_<?=$f['name']?>"  onclick="checkrow('<?=$f['name']?>',this)"><label for="row_<?=$f['name']?>"><?=$f['name']?>#<small><?=$f['title']?></small></label></th>
                            <td><input type="checkbox" name="allow_manger[]" value="<?=$f['name']?>"> </td>
                            <td><input type="checkbox" name="allow_edit[]" value="<?=$f['name']?>"> </td>
                            <td><input type="checkbox" name="allow_user_manager[]" value="<?=$f['name']?>"> </td>
                            <td><input type="checkbox" name="allow_user_edit[]" value="<?=$f['name']?>"> </td>
                            </tr>
                        <?}?>
                    </tbody>
                </table>

    <label><input type="checkbox" name="allow_delete">是否允许后台删除</label><br>
    <label><input type="checkbox" name="allow_user_delete">是否允许前台用户删除</label><br><br>

                    <input type="submit" value="保存" class="btn  btn-primary">
                    <input type="reset" value="重置" class="btn  btn-info">
</form>
                </div>
            </div>
        </div>
    </div>

</div>
<?import('/layout/bottom.php');?>
<?function js(){?>

<script>
    function check(name) {
        $("input[name='"+name+"[]']").prop("checked", $('#'+name).prop("checked"));
    }
    function checkrow(val,e) {
        $("input[value='"+val+"']").prop("checked", $(e).prop("checked"));
    }
</script>
<?}?>