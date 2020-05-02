<div class="card-header">
    <ul class="nav nav-pills nav-secondary nav-pills-no-bd">
        <li class="nav-item">
            <a class="nav-link <?=METHOD=='manager'?'active':''?>" href="<?=url('manager',$category_id)?>" ><i class="icon-list"></i> 管理</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=(METHOD=='add')?'active':''?>" href="<?=url('add',[$category_id])?>" ><i class="icon-note"></i> 新增</a>
        </li>
    </ul>
</div>