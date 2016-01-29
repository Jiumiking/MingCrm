@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新增角色</h3>
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
                    <form role="form" class="form-horizontal" id="defaultForm" action="{{route('role.store')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name">角色名:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="角色名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="description">描述:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" id="description" placeholder="描述">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="status">状态:</label>
                            <div class="col-sm-10">
                                <select name="status"  id="status" >
                                    <option value="1" selected>有效</option>
                                    <option value="0">无效</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a class="btn btn-gray" href="{{route('role.index')}}">
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
    <script src="/js/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            $("#status").select2({
                placeholder: '状态',
                allowClear: true
            });
            $("#defaultForm").validate({
                rules: {
                    name: "required",
                    description: "required"
                },
                messages: {
                    name: "请输入角色名",
                    description: "请输入描述"
                }
            });
        });
    </script>
@endsection
