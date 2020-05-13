<?import('/layout/header.php');?>
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">首页</h2>
                    <h5 class="text-white op-7 mb-2">欢迎使用HeeCMS</h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="<?=url('/admin/category/manager')?>" class="btn btn-white btn-border btn-round mr-2">栏目管理</a>
                    <a href="<?=url('/admin/category/managerinfo')?>" class="btn btn-secondary btn-round">信息管理</a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">统计</div>
                        <div class="card-category">系统信息数据统计概览</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-1"></div>
                                <h6 class="fw-bold mt-3 mb-0">用户</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-2"></div>
                                <h6 class="fw-bold mt-3 mb-0">用户组</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-3"></div>
                                <h6 class="fw-bold mt-3 mb-0">资源</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">流量概览</div>
                        <div class="row py-3">
                            <div class="col-md-4 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8">总流量</h6>
                                    <h3 class="fw-bold">9.782</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-danger op-8">日流量</h6>
                                    <h3 class="fw-bold">1,248</h3>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-title">更新日志</div>
                    </div>
                    <div class="card-body">
                        <ol class="activity-feed">
                            <li class="feed-item feed-item-secondary">
                                <time class="date" datetime="9-25">Sep 25</time>
                                <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                            </li>
                            <li class="feed-item feed-item-success">
                                <time class="date" datetime="9-24">Sep 24</time>
                                <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                            </li>
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="9-23">Sep 23</time>
                                <span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
                            </li>
                            <li class="feed-item feed-item-warning">
                                <time class="date" datetime="9-21">Sep 21</time>
                                <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="9-18">Sep 18</time>
                                <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                            </li>
                            <li class="feed-item">
                                <time class="date" datetime="9-17">Sep 17</time>
                                <span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">服务器</div>
                            <div class="card-tools">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tabstag">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#pills-env" role="tabstag" aria-selected="true">环境变量</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="pill" href="#pills-sys" role="tabstag" aria-selected="false">系统配置</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="tab-content row" id="pills-tabContent">
                            <div class="tab-pane fade show active col-md-12" id="pills-env" role="tablist"
                                 aria-labelledby="pills-env-tab">
                                    <table class="table table-sm table-hover">

                                        <tbody>
                                        <tr>
                                            <td>域名：</td>
                                            <td><?=$_SERVER['SERVER_NAME']?></td>
                                        </tr>
                                        <tr>
                                            <td>服务器：</td>
                                            <td><?=$_SERVER['SERVER_ADDR']?></td>
                                        </tr>
                                        <tr>
                                            <td>端口：</td>
                                            <td><?=$_SERVER['SERVER_PORT']?></td>
                                        </tr>
                                        <tr>
                                            <td>运行环境：</td>
                                            <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
                                        </tr>
                                        <tr>
                                            <td>系统目录：</td>
                                            <td><?=$_SERVER['SYSTEMROOT']?></td>
                                        </tr>
                                        <tr>
                                            <td>网站目录：</td>
                                            <td><?=ROOT?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="tab-pane fade col-md-12" id="pills-sys" role="tablist"
                                 aria-labelledby="pills-sys-tab">
                                <table class="table table-sm table-hover">

                                    <tbody>
                                    <tr>
                                        <td>网站名称：</td>
                                        <td><?=conf('website_name')?></td>
                                    </tr>
                                    <tr>
                                        <td>公司名称：</td>
                                        <td><?=conf('company_name')?></td>
                                    </tr>
                                    <tr>
                                        <td>开启验证码：</td>
                                        <td><?=conf('is_vcode')?'是':'否'?></td>
                                    </tr>
                                    <tr>
                                        <td>开启水印：</td>
                                        <td><?=conf('watermark')?'是':'否'?></td>
                                    </tr>
                                    <tr>
                                        <td>网站模板：</td>
                                        <td><?=conf('website_skin')?></td>
                                    </tr>
                                    <tr>
                                        <td>支付宝：</td>
                                        <td><?=conf('pay_ali_account')?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?
import('/layout/bottom.php');
function js(){
?>
    <script>
        Circles.create({
            id:'circles-1',
            radius:45,
            value:60,
            maxValue:100,
            width:7,
            text: 5,
            colors:['#f1f1f1', '#FF9E27'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-2',
            radius:45,
            value:70,
            maxValue:100,
            width:7,
            text: 36,
            colors:['#f1f1f1', '#2BB930'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        Circles.create({
            id:'circles-3',
            radius:45,
            value:40,
            maxValue:100,
            width:7,
            text: 12,
            colors:['#f1f1f1', '#F25961'],
            duration:400,
            wrpClass:'circles-wrp',
            textClass:'circles-text',
            styleWrapper:true,
            styleText:true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                datasets : [{
                    label: "Total Income",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false //this will remove only the label
                        },
                        gridLines : {
                            drawBorder: false,
                            display : false
                        }
                    }],
                    xAxes : [ {
                        gridLines : {
                            drawBorder: false,
                            display : false
                        }
                    }]
                },
            }
        });

        $('#lineChart').sparkline([105,103,123,100,95,105,115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>
<?}?>
