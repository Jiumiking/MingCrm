@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑用户</h3>
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
                    <form role="form" class="form-horizontal" id="defaultForm" action="{{route('user.update',$user->id)}}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="username">用户名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="mobile">手机号:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mobile" id="mobile" value="{{$user->mobile}}" placeholder="手机号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="email">邮箱:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="邮箱">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name">姓名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="role_id">角色:</label>
                            <div class="col-sm-10">
                                <select name="role_id"  id="role_id" >
                                    <option value="">请选择</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if ($user->role_id==$role->id) selected="selected" @endif >{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="status">状态:</label>
                            <div class="col-sm-10">
                                <select name="status"  id="status" >
                                    <option value="1" @if ($user->status==1) selected="selected" @endif >正常</option>
                                    <option value="2" @if ($user->status==2) selected="selected" @endif >禁用</option>
                                    <option value="0" @if ($user->status==0) selected="selected" @endif >离职</option>
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
    <script src="/js/jquery-validate/jquery.validate.min.js"></script>
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
                            data: {                     //要传递的数据
                                username: function() {
                                    return $("#username").val();
                                },
                                id: '{{$user->id}}'
                            }
                        }
                    },
                    mobile: {
                        required: true,
                        isMobile: true,
                        remote: {
                            url: "{{route('user.uniqueMobile')}}",     //后台处理程序
                            type: "get",                //数据发送方式
                            dataType: "json",           //接受数据格式
                            data: {                     //要传递的数据
                                mobile: function() {
                                    return $("#mobile").val();
                                },
                                id: '{{$user->id}}'
                            }
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{route('user.uniqueEmail')}}",     //后台处理程序
                            type: "get",                //数据发送方式
                            dataType: "json",           //接受数据格式
                            data: {                     //要传递的数据
                                email: function() {
                                    return $("#email").val();
                                },
                                id: '{{$user->id}}'
                            }
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
