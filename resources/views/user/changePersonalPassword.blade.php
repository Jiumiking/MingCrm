@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">修改密码({{$user->name}})</h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">&ndash;</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="remove">
                            &times;
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal" id="defaultForm" action="{{route('user.storePersonalPassword')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password_old">当前密码：</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_old" id="password_old" placeholder="当前密码"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password">密码：</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password_confirmation">确认密码：</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a class="btn btn-gray" href="{{route('user.index')}}">
                                    <i class="fa-backward"></i>
                                    <span>返回</span>
                                </a>
                                <button type="reset" class="btn btn-gray" id="search_reset" title="重置">
                                    <i class="fa-refresh"></i>
                                </button>
                                <button type="submit" class="btn btn-gray">
                                    <i class="fa-save"></i>
                                    <span>保存</span>
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/jquery-validate/jquery.validate.min.js"></script><!--表达验证插件-->
    <script src="/js/jquery-validate/localization/messages_zh.min.js"></script><!--表达验证插件 中文语言包-->
    <script type="text/javascript">
        $(document).ready(function($) {
            $("#defaultForm").validate({
                rules: {//验证规则
                    password_old: {
                        required: true,
                        minlength: 6,
                        remote: {
                            url: "{{route('user.checkPersonalPassword')}}",     //后台处理程序
                            type: "get",                //数据发送方式
                            dataType: "json",           //接受数据格式
                        }
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {//验证自定义提示
                    password_old: {
                        remote: '密码错误'
                    },
                }
            });
        });
    </script>
@endsection
