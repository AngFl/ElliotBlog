<div class="form-group">
    <!--  Geetest 验证码加载插件 -->
    <label for="password_confirmation" class="col-md-4 control-label">
    </label>
    <div class="col-md-6">
        <div class="box" id="div_geetest_lib">
            <script src="/js/jquery.min.js"></script>
            <script src="http://api.geetest.com/get.php"></script>
            <div id="captcha"></div>

            <script src="http://static.geetest.com/static/tools/gt.js"></script>
            <script type="text/javascript">
                $.ajax({
                    // 获取id，challenge，success（是否启用failback）
                    url: "/user/captcha?rand="+Math.round(Math.random()*100),
                    type: "get",
                    dataType: "json", // 使用jsonp格式
                    success: function (data) {
                        // 使用initGeetest接口
                        // 参数1：配置参数，与创建Geetest实例时接受的参数一致
                        // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                        initGeetest({
                            gt: data.gt,
                            challenge: data.challenge,
                            product: "float", // 产品形式
                            offline: !data.success
                        }, function(captchaObj){
                            // 将验证码加到id为captcha的元素里
                            captchaObj.appendTo("#captcha");
                        });
                    }
                });
            </script>
        </div>
    </div>
</div>