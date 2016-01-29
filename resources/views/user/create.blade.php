@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新增用户</h3>
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
                    <form role="form" class="form-horizontal" id="defaultForm" action="{{route('user.store')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="username">用户名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password">密码:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="password_confirmation">确认密码:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="确认密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mobile">手机号:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="手机号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">邮箱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" placeholder="邮箱">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name">姓名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="role_id">角色:</label>
                            <div class="col-sm-10">
                                <select name="role_id"  id="role_id" >
                                    <option value="">请选择</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="status">状态:</label>
                            <div class="col-sm-10">
                                <select name="status"  id="status" >
                                    <option value="1" selected>正常</option>
                                    <option value="2">禁用</option>
                                    <option value="0">离职</option>
                                </select>
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
@section('styles')
    <link rel="stylesheet" href="/js/select2/select2.css">
@endsection
@section('scripts')
    <script src="/js/jquery-validate/jquery.validate.min.js"></script><!--表达验证插件-->
    <script src="/js/jquery-validate/localization/messages_zh.min.js"></script><!--表达验证插件 中文语言包-->
    <script src="/js/jquery-validate/customer.js"></script><!--表达验证插件 自定义验证规则-->
    <script src="/js/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $("#role_id").select2({
                placeholder: '角色',
                allowClear: true
            });
            $("#status").select2({
                placeholder: '状态',
                allowClear: true
            });
            $("#defaultForm").validate({
                rules: {//验证规则
                    username: {
                        required: true,
                        remote: {
                            url: "{{route('user.uniqueUsername')}}",     //后台处理程序
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
                    },
                    mobile: {
                        required: true,
                        isMobile: true,
                        remote: {
                            url: "{{route('user.uniqueMobile')}}",     //后台处理程序
                            type: "get",                //数据发送方式
                            dataType: "json",           //接受数据格式
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{route('user.uniqueEmail')}}",     //后台处理程序
                            type: "get",                //数据发送方式
                            dataType: "json",           //接受数据格式
                        }
                    },
                    name: "required",
                    role_id: {
                        required: true
                    }
                },
                messages: {//验证自定义提示
                    username: {
                        remote: '此用户名已存在'
                    },
                    mobile: {
                        remote: '此手机号码已存在'
                    },
                    email: {
                        remote: '此邮箱已存在'
                    },
                    role_id: {
                        required: '必须填写'
                    }
                }
            });
        });
    </script>
@endsection
