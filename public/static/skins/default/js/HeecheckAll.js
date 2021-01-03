!function($) {
    $.fn.HeecheckAll = function(options,callback) {
        var defaults = {
            checkboxAll: 'thead input[type="checkbox"]',
            checkbox: 'tbody input[type="checkbox"]'
        }
        var options = $.extend(defaults, options);
        this.each(function(){
            var that = $(this);
            var checkboxAll = that.find(options.checkboxAll);
            var checkbox = that.find(options.checkbox);

            checkboxAll.on("click",function(){
                var isChecked = checkboxAll.prop("checked");
                checkbox.prop("checked", isChecked);
                var _Num = 0,checkedArr = [];
                checkbox.each(function(){
                    if($(this).prop("checked")) {
                        checkedArr.push($(this).val());
                        _Num++;
                    }
                });
                var checkedInfo = {
                    Number: _Num,
                    checkedArr: checkedArr
                }
                if(callback){
                    callback(checkedInfo);
                }
            });

            checkbox.on("click",function(){
                var allLength = checkbox.length;
                var checkedLength = checkbox.prop("checked").length;
                allLength == checkedLength ? checkboxAll.prop("checked",true) : checkboxAll.prop("checked",false);
                var _Num = 0,checkedArr = [];
                checkbox.each(function(){
                    if($(this).prop("checked")) {
                        checkedArr.push($(this).val());
                        _Num++;
                    }
                });
                var checkedInfo = {
                    Number: _Num,
                    checkedArr: checkedArr
                }
                if(callback){
                    callback(checkedInfo);
                }
            });
        });
    }
} (window.jQuery);