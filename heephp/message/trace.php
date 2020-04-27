<style>
    .trace_bottom_btn{
        bottom: 0;
        right: 50px;
        position: fixed;
        border: lightskyblue 1px solid;
        background: aliceblue;
        font-size: 14px;
        color: darkblue;
        width: 80px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
        z-index: 999999999999999999999;
    }
    .trace_bottom_show{
        bottom: 0;
        width: 100%;
        height: 160px;
        border-top: lightskyblue 1px solid;
        background: aliceblue;
        font-size: 12px;
        position: fixed;
        display: none;
        z-index: 999999999999999999999;
        overflow-y: scroll;
        padding: 10px;
    }
    .trace_bottom_show .close{
        right: 10px;
        top: 10px;
        position:absolute;
        font-size: 14px;
    }
    .trace_bottom_show ul{
        list-style: none;
    }
    .trace_bottom_show ul>li{
        line-height: 30px;
    }
    .trace_bottom_show .title{
        color: darkblue;
        font-size: 14px;
    }
</style>
<div class="trace_bottom_btn" onclick="__trace_show()">
    调试
</div>
<div class="trace_bottom_show">
    <span class="close" onclick="__trace_hidden()">✖</span>
    <small>页面耗时：<?=\heephp\trace::sum_run_end_time()?></small><br>
    <b class="title">调试</b><br>
    <ul>
        <?for($i=1;$i<count($traces);$i++){ ?>
        <li><span onclick="__trace_show_desc('__trace__desc_<?=$i?>')" style="cursor: pointer;"><font color="gray"> ▼ </font>文件:<?=$traces[$i]['file']?> 行:<?=$traces[$i]['line']?>函数:<?=$traces[$i]['function']?> </span> <br><font color="#333"><small style="display: none;border-bottom: #0a5a97 1px solid;background: #f7f8fa;color: #999999" id="__trace__desc_<?=$i?>">调用对象:<?=htmlencode(var_export($traces[$i]['object'],true))?></small></font></li>
        <?}?>
    </ul>
    <b class="title">SQL</b><br>
    <ul>
        <?if(count($sqls)<1){echo"<li>无记录</li>";}?>
        <?for($i=1;$i<count($sqls);$i++){ ?>
            <li><font color="gray"> ></font><?=$sqls[$i]?></li>
        <?}?>
    </ul>
</div>
<script>

    window.onload=function () {
        if(sessionStorage.traceshow==1)
            __trace_show();
        else
            __trace_hidden();
    }

    function __trace_show() {
        sessionStorage.traceshow=1;
        document.getElementsByClassName('trace_bottom_btn')[0].style.display='none';
        document.getElementsByClassName('trace_bottom_show')[0].style.display='block';
    }
    function __trace_hidden() {
        sessionStorage.traceshow=0;
        document.getElementsByClassName('trace_bottom_btn')[0].style.display='block';
        document.getElementsByClassName('trace_bottom_show')[0].style.display='none';
    }
    function __trace_show_desc(id) {
        $('#'+id).toggle();
        for(i=0;i<<?=count($traces)?>;i++){
            cid='#__trace__desc_'+i;
            if('#'+id==cid){continue;}
            $(cid).hide();
        }

    }
</script>