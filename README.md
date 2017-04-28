### Geetest For Laravel5 And Vue
```
采用了Germeyd的package，在此基础上增加了SDK3.0 跟 vue组件
```
#### 安装
```
composer require levan/geetest
```
#### 配置
##### 在config目录的app文件下增加如下
```
'providers' => [
	Levan\Geetest\GeetestServiceProvider::class,
];
'aliases'=>[
	'Geetest' => Levan\Geetest\Geetest::class,
]
```
##### 去  [``geetest``](http://www.geetest.com/)  注册帐号  ， 在env文件里面增加如下
```
GEETEST_ID=****
GEETEST_KEY=****
```
#### 生成配置文件
会在config目录下生成geetest配置文件，同时在resources目录下生成视图文件，在components生成vue文件

```
php artisan vendor:publish --tag=levan-geetest
```

#### 用法
``Blade模版``
直接在form表单中加入 ``{!! Geetest::render() !!}``

```
<form action="/" method="post">
	<div class="form-group">
	<label for="name" class="control-label">User:</label>
	<input id="name" name="name" type="text" class="form-control">
	</div>
	{!! Geetest::render() !!}
	<br>
	<button type="submit" class="btn btn-success form-control">提交</button>
</form>
```

``Vue``

##### Example.vue
```
<template>
    <div class="container">
        <form action="/" method="post">
            <div class="form-group">
                <label for="name" class="control-label">User:</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>
			//这里的 login_btn 是你提交按钮的class
            <Geetest :btn_name="'login_btn'" v-on:error="error" v-on:success="success"></Geetest>
            <br>
            <button type="button" class="btn btn-success form-control login_btn">提交</button>
        </form>
    </div>
</template>

<script>
    import Geetest from '../components/geetest/Geetest.vue'

    export default {
      
        components: {
            Geetest
        },
        methods:{
            error(){
                //点击btn 之后表单 未验证
                console.log('error');
            },
            success(){
                //点击btn 验证成功
                console.log('success');
            }
        }
    }
</script>

```
###### 
[``Han's blog``](http://vue.echohany.com)