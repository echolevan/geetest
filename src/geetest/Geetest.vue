<template>
    <div>
        <div id="geetest-captcha"></div>
        <p id="wait" class="show">正在加载验证码...</p>
        <button class="error" type="button" @click="error" style="width: 0;padding: 0;border: none"></button>
        <button class="success" type="button" @click="success" style="width: 0;padding: 0;border: none"></button>
    </div>
</template>

<script>
    export default {
        data (){
            return {

            }
        },
        props:['btn_name'],
        created(){
            let btn_name = this.btn_name;
            let geetest = function(url) {
                let handlerEmbed = function(captchaObj) {
                    $("."+btn_name).click(function (e) {
                        let validate = captchaObj.getValidate();
                        if (!validate) {
                            $(".error").click();
                            e.preventDefault();
                        }else{
                            $(".success").click();
                        }
                    });
                    captchaObj.appendTo("#geetest-captcha");
                    captchaObj.onReady(function() {
                        $("#wait")[0].className = "hide";
                    });
                };
                $.ajax({
                    url: url + "?t=" + (new Date()).getTime(),
                    type: "get",
                    dataType: "json",
                    success: function(data) {
                        initGeetest({
                            gt: data.gt,
                            challenge: data.challenge,
                            product: "levan",
                            offline: !data.success,
                            lang: 'zh-cn'
                        }, handlerEmbed);
                    }
                });
            };
            (function() {
                geetest('levan/geetest');
            })();
        },
        methods :{
            error(){
                // 提交表未验证的方法
                this.$emit(error);
            },
            success(){
                // 提交表单验证执行的方法
                this.$emit(success);
            }
        }
    }
</script>

<style lang="sass" rel="stylesheet/sass">
    .hide
        display: none
        .geetest_holder.geetest_wind
            left: 100px
</style>