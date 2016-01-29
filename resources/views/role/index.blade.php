@extends('layouts.main')

@section('content')
        <!-- Basic Setup -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">角色列表</h3>

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
                <form id="searchUserForm" action="{{route('role.index')}}" class="form form-inline" method="GET" role="form">
                    <input type="hidden" name="paginate" value="{{app('request')->get('paginate','25')}}">
                    <div class="form-group">
                        <input type="text" name="id" @if (array_key_exists('id', $search_values)) value='{{$search_values['id']}}' @endif class="form-control" placeholder="id"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name"@if (array_key_exists('name', $search_values)) value='{{$search_values['name']}}' @endif  class="form-control" placeholder="角色名"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="description"@if (array_key_exists('description', $search_values)) value='{{$search_values['description']}}' @endif  class="form-control" placeholder="描述"/>
                    </div>
                    <div class="form-group">
                        <select name="status"  id="status" >
                            <option value="" @if (!array_key_exists('status', $search_values)) selected @endif >全部</option>
                            <option value="1" @if (array_key_exists('status', $search_values) && $search_values['status'] == "1") selected @endif>有效</option>
                            <option value="0" @if (array_key_exists('status', $search_values) && $search_values['status'] == "0") selected @endif>无效</option>
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
                            <a class="btn btn-info btn-rounded" href="{{route('role.index')}}">
                                <span>返回</span>
                            </a>
                        @endif
                        <a class="btn btn-gray" href="{{route('role.create')}}">
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
                <th>角色名</th>
                <th>描述</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->description}}</td>
                    <td>
                        @if ($role->status=='1')<div class="label label-table label-success">有效</div>
                        @endif
                        @if ($role->status=='0')  <div class="label label-table label-danger">无效</div>
                        @endif
                    </td>
                    <td>{{$role->created_at}}</td>
                    <td>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{ route('role.show',$role->id) }}" data-original-title="查看" data-container="body"><i class="fa-eye"></i></a>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{ route('role.edit',$role->id) }}" data-original-title="修改" data-container="body"><i class="fa-pencil"></i></a>
                        <a class="btn btn-xs btn-danger add-tooltip" data-toggle="tooltip" href="{{ route('role.editPermission',$role->id) }}" data-original-title="权限" data-container="body"><i class="fa-cogs"></i></a>
                        <button class="btn btn-xs btn-danger add-tooltip deleteBtn" data-toggle="tooltip" href="{{ route('role.destroy',$role->id) }}" data-original-title="删除" data-container="body"><i class="fa-times"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-xs-6">
                <div class="dataTables_info" role="status" aria-live="polite">
                    @include('common.paginateSelect')
                </div>
            </div>
            <div class="col-xs-6">
                <div class="dataTables_paginate paging_simple_numbers">
                    <?php echo $roles->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
    <link rel="stylesheet" href="/js/datatables/dataTables.bootstrap.css">
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
