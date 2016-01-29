@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户详情</h3>
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
                    <form role="form" class="form-horizontal" id="defaultForm" action="" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">姓名:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->name}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->username}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">手机号:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->mobile}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">邮箱:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->email}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">角色:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->role_id}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">状态:</label>
                            <div class="col-sm-10">
                                <span class="form-control">
                                    @if ($user->status == 1)
                                        正常
                                    @elseif ($user->status == 2)
                                        注销
                                    @else
                                        离职
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">添加时间:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->created_at}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">修改时间:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->updated_at}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">最后登录时间:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$user->last_login_at}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a class="btn btn-gray" href="{{route('user.index')}}">
                                    <i class="fa-backward"></i>
                                    <span>返回</span>
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
