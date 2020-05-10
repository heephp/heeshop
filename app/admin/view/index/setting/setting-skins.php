<div class="tab-pane fade" id="pills-skins-icon" role="tabpanel" aria-labelledby="pills-skins-tab-icon">



    <div class="row">
        <div class="col-lg-6">


            <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist3">
                <li class="nav-item submenu">
                    <a class="nav-link active show" id="pills-local-tab" data-toggle="pill"
                       href="#pills-local" role="tab" aria-controls="pills-local" aria-selected="false">本地</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-online-tab" data-toggle="pill" href="#pills-online" role="tab"
                       aria-controls="pills-online" aria-selected="true">线上</a>
                </li>

            </ul>

            <div class="tab-content mt-2 mb-3 row" id="pills-tabContent">
                <div class="tab-pane fade show active col-md-12" id="pills-local" role="tablist3"
                     aria-labelledby="pills-local-tab">

                    <div class="d-flex flex-row flex-wrap">
                        <?foreach ($skins as $s){?>
                        <div class="m-3 p-3 border border-white shadow-sm d-flex flex-column">

                            <label for="website_skin_<?=$s['name']?>">
                                <img src="data:image/jpg;<?=$s['img']?>" width="150" height="150" class="rounded">
                            </label>

                            <label for="website_skin_<?=$s['name']?>">
                                <input type="radio" name="website_skin" id="website_skin_<?=$s['name']?>" value="<?=$s['name']?>">
                                    <?=$s['name']?>
                            </label>
                        </div>
                        <?}?>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-online" role="tablist3"
                     aria-labelledby="pills-online-tab">

                    <div class="d-flex flex-row flex-wrap">
                    <?foreach ($so as $s){?>
                        <div class="m-3 p-3 border border-white shadow-sm d-flex flex-column">

                            <img src="<?=$s['img']?>" width="150" height="150" class="rounded mb-2">

                            <label for="website_skin_<?=$s['name']?>">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm">预览</a>
                                <a href="javascript:void(0);" class="btn btn-outline-secondary btn-sm">安装</a>
                                <?=$s['name']?>
                            </label>
                        </div>
                    <?}?>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>