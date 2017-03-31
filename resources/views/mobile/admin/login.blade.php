@extends("mobile/nav")
@section("title","动画电影网")
@section("css")
    @parent
    <style>
        body{position:absolute;width:100%;height:100%;display:flex;flex-direction:column;}
        .page{flex-grow:1;display: flex;justify-content:center;align-items:center;}
        .content{width:500px;padding:50px 100px;background: white;border:1px solid #cfcfcf;border-radius:3px;}
    </style>
@stop
@section("main")
    <div class="page">
        <div class="content">
            <form role="form" method="POST" action="/admin/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass"/>
                </div>
                @if(session("msg"))
                    <div class="form-group">
                        <label style="color:red;">{!! session("msg") !!}</label>
                    </div>
                @endif
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@stop
