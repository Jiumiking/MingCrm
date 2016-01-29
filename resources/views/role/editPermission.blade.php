@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑权限({{$role->name}})</h3>
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
                    <form role="form" class="form-horizontal" id="defaultForm" action="{{route('role.storePermission',$role->id)}}" method="post">
                        {!! csrf_field() !!}
                        @foreach($permissions as $key => $value)
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="iswitch iswitch-secondary">
                                        {{trans("permission.".$key)}}
                                    </label>
                                </div>
                                @foreach( $value->chunk(4) as $chunk)
                                    <div class="row">
                                        <div class="pad-btm checkbox">
                                            @foreach($chunk as $v)
                                                <div class="col-xs-3">
                                                    <label>
                                                        <input class="cbr" name="permissions[]" @if ($role->hasPermission($v->id)) checked="" @endif type="checkbox" value="{{$v->id}}">{{ trans("permission.".$v->name) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group-separator"></div>
                        @endforeach
                        <div class="">
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
    <script type="text/javascript">
        $(document).ready(function($) {
            $('.iswitch-secondary').change(function(){
                var checkStatus = $(this).prop('checked');
                var parentDiv = $(this).parent().parent().parent();
                if(!checkStatus){ //取消选中
                    if( $(parentDiv) ){
                        $('.cbr',parentDiv).each(function(){$(this).removeProp('checked');});
                        $('.cbr-replaced',parentDiv).each(function(){$(this).removeClass('cbr-checked');});
                    }
                }else{ //选中
                    if( $(parentDiv) ){
                        $('.cbr',parentDiv).each(function(){$(this).prop('checked','checked');});
                        $('.cbr-replaced',parentDiv).each(function(){$(this).addClass('cbr-checked');});
                    }
                }
            });
        });
    </script>
@endsection
