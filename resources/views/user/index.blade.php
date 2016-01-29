@extends('layouts.main')

@section('content')
<!-- Basic Setup -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">用户列表</h3>

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form id="searchUserForm" action="{{route('user.index')}}" class="form form-inline" method="GET" role="form">
                    <input type="hidden" name="paginate" value="{{app('request')->get('paginate','25')}}">
                    <div class="form-group">
                        <input type="text" name="id" @if (array_key_exists('id', $search_values)) value='{{$search_values['id']}}' @endif class="form-control" placeholder="用户id"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username"@if (array_key_exists('username', $search_values)) value='{{$search_values['username']}}' @endif  class="form-control" placeholder="用户名"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile"@if (array_key_exists('mobile', $search_values)) value='{{$search_values['mobile']}}' @endif  class="form-control" placeholder="手机号"/>
                    </div>
                    <div class="form-group">
                        <select name="status"  id="status" >
                            <option value="" @if (!array_key_exists('status', $search_values)) selected @endif >全部</option>
                            <option value="active" @if (array_key_exists('status', $search_values) && $search_values['status'] == "1") selected @endif>正常</option>
                            <option value="left" @if (array_key_exists('status', $search_values) && $search_values['status'] == "0") selected @endif>离职</option>
                            <option value="frozen" @if (array_key_exists('status', $search_values) && $search_values['status'] == "2") selected @endif>禁用</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-gray" id="search_reset" title="重置">
                            <i class="fa-refresh"></i>
                        </button>
                        <button type="submit" class="btn btn-gray">
                            <i class="fa-search"></i>
                            <span>搜索</span>
                        </button>
                        @if ($search_values!=[])
                            <a class="btn btn-info btn-rounded" href="{{route('user.index')}}">
                                <span>返回</span>
                            </a>
                        @endif
                        <a class="btn btn-gray" href="{{route('user.create')}}">
                            <i class="fa-plus"></i>
                            <span>新增</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="panel-body">

        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#id</th>
                <th>用户名</th>
                <th>姓名</th>
                <th>邮箱</th>
                <th>手机</th>
                <th>角色</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>
                        @if ($user->status=='1')<div class="label label-table label-success">正常</div>
                        @endif
                        @if ($user->status=='2')  <div class="label label-table label-danger">禁用</div>
                        @endif
                        @if ($user->status=='0')  <div class="label label-table label-warning">离职</div>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{ route('user.show',$user->id) }}" data-original-title="查看" data-container="body"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{ route('user.edit',$user->id) }}" data-original-title="修改" data-container="body"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{route('user.changePassword', $user->id)}}" data-original-title="修改密码" data-container="body"><i class="fa fa-lock"></i></a>
                        <button class="btn btn-xs btn-danger add-tooltip deleteBtn" data-toggle="tooltip" href="{{ route('user.destroy',$user->id) }}" data-original-title="删除" data-container="body"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="/js/select2/select2.css">
@endsection
@section('scripts')
    @include('common.indexJs')
    <script src="/js/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($)
        {
            $("#status").select2({
                placeholder: '状态',
                allowClear: true
            })
        });
    </script>
@endsection
