<link rel="stylesheet" href="/static/css/personal.css">
<div class="main">
    <div class="bg"></div>
    <div class="personal_content">
        <div class="logo">
            <img src={!! \Illuminate\Support\Facades\URL::asset('storage/images/logo.jpg') !!} alt=""/>
        </div>
        <ul class="list">
            <li>
                <span>服务器地址</span>
                <span>{!! env('APP_URL') !!}</span>
            </li>
            <li>
                <span>系统</span>
                <span>{!! php_uname('s') !!}</span>
            </li>
            <li>
                <span>运行环境</span>
                <span>{!! php_uname('s') . php_uname('r')  !!}</span>
            </li>
            <li>
                <span>数据库</span>
                <span>{!! env('DB_CONNECTION') !!}</span>
            </li>
            <li>
                <span>PHP版本</span>
                <span>{!! PHP_VERSION !!}</span>
            </li>
            <li>
                <span>PHP运行方式</span>
                <span>{!! php_sapi_name()  !!}</span>
            </li>
            <li>
                <span>Laravel</span>
                <span>{!! app()::VERSION  !!}</span>
            </li>
        </ul>
    </div>
</div>
