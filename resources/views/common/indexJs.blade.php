<script type="text/javascript">
    $(document).ready(function(){
        var delHref = '';
        var delLine = '';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //删除
        $('button.deleteBtn').click(function(){
            delHref =$(this).attr('href');
            delLine = $(this).parent().parent();
            $('#defaultModal').modal('show', {backdrop: 'static'});
            $('#defaultModalContent').html('确认删除该条记录？');
            return false;
        });
        $('#defaultModalBtn').click(function(){
            $.post(
                    delHref,
                    {'_method':'DELETE'},
                    function(data){
                        if (data == 'ok') {
                            delLine.remove();
                        } else {
                        }
                    });
            $('#defaultModal').modal('hide');
        });

        $("select[name='paginate']").change(function() {
            var urlSearch = window.location.search;
            var theRequest = new Object();
            if (urlSearch.indexOf("?") != -1) {
                var str = urlSearch.substr(1);
                strs = str.split("&");
                for (var i = 0; i < strs.length; i++) {
                    var tmp = strs[i].split("=");
                    if (tmp[0] != 'paginate' && tmp[0] != 'page') {
                        theRequest[tmp[0]] = decodeURIComponent(tmp[1]);
                    }
                }
            }
            theRequest['paginate'] = $(this).val();
            window.location.href = window.location.pathname+"?"+ $.param(theRequest);
        });

        //menu auto expand
        var active_menu = $('a[href|="'+window.location.href+'"]',$('#main-menu')).parent();
        if(active_menu.parent().parent().hasClass('has-sub')) {
            active_menu.parent().parent().addClass('active opened');
        }
        active_menu.addClass('active');
        //end menu auto expand

    });
</script>