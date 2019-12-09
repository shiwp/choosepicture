<style>
    .files > li {
        float: left;
        padding: 5px;
        border: 1px solid #eee;
        margin: 5px;
        position: relative;
    }

    .files>li>.file-select {
        position: absolute;
        top: -4px;
        left: -1px;
    }

    .file-icon {
        text-align: center;
        font-size: 65px;
        color: #666;
        display: block;
        height: 100px;
    }

    .file-info {
        text-align: center;
        padding: 10px;
        background: #f4f4f4;
    }

    .file-name {
        font-weight: bold;
        color: #666;
        display: block;
        overflow: hidden !important;
        white-space: nowrap !important;
        text-overflow: ellipsis !important;
    }

    .file-size {
        color: #999;
        font-size: 12px;
        display: block;
    }

    .files {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .file-icon.has-img {
        padding: 0;
    }

    .file-icon.has-img>img {
        max-width: 100%;
        height: auto;
        max-height: 92px;
    }

    .files  .choosed{
        border: 1px solid #000;
    }

</style>
<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('admin::form.error')

        <div class="controls">
            <a href="#file-browser-{!!$column!!}" class="mailbox-attachment-name" style="word-break:break-all;"
               data-toggle="modal" data-target="#file-browser-{!!$column!!}">
                <button class="btn btn-info" type="button">选择文件</button>
            </a>
        <!-- 模态框（Modal） -->

            <div class="modal fade" id="file-browser-{!!$column!!}" tabindex="-1" role="dialog"
                 aria-labelledby="file-browser-label" aria-hidden="true">
                <div class="modal-dialog" style="width: 60%;height: 100%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="file-browser-label"></h4>
                        </div>
                        <div class="modal-body" style="min-height: 450px;">
                            <ul class="files clearfix">

                                @if (empty($list))
                                    <li style="height: 200px;border: none;"></li>
                                @else
                                    @foreach($list as $item)
                                        <li class="{{$column}}-pic" data_img="{{ $item }}">
                                            <img src="{{ $item }}" width="80" height="80">
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                        </div>

                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal -->
            </div>
        </div>
        <input type="hidden" name="{{$name}}" id="{{$column}}" value="{{ $value }}">
        <div id="preview-{{$column}}"></div>


        @include('admin::form.help-block')
    </div>
</div>

<script>
    (function() {
        window['{{$column}}'] = '';
        if ($('#{{$column}}').val() !== "null") {
            window[`{{$column}}`] = $('#{{$column}}').val();
            console.log(window[`{{$column}}`]);
            if(window[`{{$column}}`]){
                $('#preview-{{$column}}').html(preview(window[`{{$column}}`]));
                $('.{{$column}}-pic').each(function(){
                    if($(this).attr('data_img') == $('#{{$column}}').val()){
                        $(this).addClass('choosed');
                    }
                });
            }
        }
        $('.{{$column}}-pic img').click(function () {
            $('.{{$column}}-pic').removeClass('choosed');
            $(this).parents('li').addClass('choosed');
            var url = $(this).parents('li').attr('data_img');
            $('#preview-{{$column}}').html(preview(url));
            $('#{{$column}}').val(url);
            $('#file-browser-{!!$column!!}').modal('hide');
        });
        $('.modal-dialog').click(function () {
            $('#file-browser-{!!$column!!}').modal('hide');
        });
        $(".modal-content").click(function (event) {
            event.stopPropagation();
        });

        function preview(url) {
            return '<span class="file-icon has-img col-sm-2"><img src="' + url + '" alt="Attachment" data_url="'+url+'"\/><\/span>';
        }
    }())
</script>
