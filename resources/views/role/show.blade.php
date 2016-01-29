@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">角色详情</h3>
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
                            <label class="col-sm-2 control-label">角色名:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$role->name}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">描述:</label>
                            <div class="col-sm-10">
                                <span class="form-control">{{$role->description}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">状态:</label>
                            <div class="col-sm-10">
                                <span class="form-control">
                                    @if ($role->status == 1)
                                        有效
                                    @else
                                        无效
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a class="btn btn-gray" href="{{route('role.index')}}">
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
