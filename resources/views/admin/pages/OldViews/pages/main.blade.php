@extends('admin.layouts.app')
@section('titleSuffix')
    |
    <a href="{!! route('admin.pages.add') !!}" class="text-cyan">
        <i class="mdi mdi-plus-box"></i> {{ t('Admin action buttons.add') }}
    </a>
@endsection
@section('content')
    @if(count($pages))
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped m-b-0 columns-middle">
                    <thead>
                        <tr>
                            <th>{{ t('Admin pages list.name') }}</th>
                            <th>{{ t('Admin pages list.satus') }}</th>
                            <th>{{ t('Admin pages list.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-sortable" data-action="{{ route('admin.pages.sort') }}">
                        @foreach($pages as $page)
                            <tr class="page-row" data-id="{!! $page->id !!}">
                                <td class="page-title">{{ $page->title }}</td>
                                @if($page->active)
                                    <td class="text-success">{{ t('Admin pages list.active') }}</td>
                                @else
                                    <td class="text-danger">{{ t('Admin pages list.inactive') }}</td>
                                @endif

                                <td>
                                    <a href="{{ route('admin.pages.edit', ['id' => $page->id]) }}"
                                       {!! tooltip(t('Admin action buttons.edit')) !!}
                                       class="icon-btn edit">

                                    </a>
                                    @if (!$page->static)
                                        <a href="{{ route('admin.gallery.show', ['gallery'=>'pages', 'id'=>$page->id]) }}"
                                           {!! tooltip(t('Admin action buttons.gallery')) !!}
                                           class="icon-btn gallery">

                                        </a>
                                        {{--<a href="{{ route('admin.video_gallery', ['gallery'=>'pages', 'id'=>$page->id]) }}"
                                           {!! tooltip(t('Admin action buttons.videogallery')) !!}
                                           class="icon-btn video-gallery">

                                        </a>--}}
                                        <span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#pageDeleteModal">
                                            <a href="javascript:void(0)" class="icon-btn delete" {!! tooltip(t('Admin action buttons.delete')) !!}></a>
                                        </span>

                                    @else
                                        @if(array_key_exists($page->static, $content_pages))
                                            <a href="{{ $content_pages[$page->static] }}"
                                               {!! tooltip(t('Admin action buttons.content')) !!}
                                               class="icon-btn content">

                                            </a>
                                        @endif
                                        @if(array_key_exists($page->static, $home_big_image_banners))
                                            <a href="{{ $home_big_image_banners[$page->static] }}"
                                               {!! tooltip(t('Admin Sidebar.HomeBanner')) !!}
                                               class="icon-btn homeBanner">

                                            </a>
                                        @endif
                                        @if(array_key_exists($page->static, $gallery_pages))
                                            <a href="{{ $gallery_pages[$page->static] }}"
                                               {!! tooltip(t('Admin action buttons.gallery')) !!}
                                               class="icon-btn gallery">

                                            </a>
                                        @endif
                                        @if(array_key_exists($page->static, $video_gallery_pages))
                                            <a href="{{ $video_gallery_pages[$page->static] }}"
                                               {!! tooltip(t('Admin action buttons.videogallery')) !!}
                                               class="icon-btn video-gallery">

                                            </a>
                                        @endif
                                        @if(array_key_exists($page->static, $file_pages))
                                            <a href="{{ $file_pages[$page->static] }}"
                                               {!! tooltip(t('Admin action buttons.file')) !!}
                                               class="icon-btn file">

                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
    @endif
    @modal(['id'=>'pageDeleteModal', 'centered'=>true, 'loader'=>true,
        'saveBtn' => t('Admin action buttons.delete'),
        'saveBtnClass' => 'btn-danger',
        'closeBtn' => t('Admin action buttons.cancel'),
        'form' => ['id'=>'pageDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title'){{ t('Admin action buttons.delete title') }}@endslot
    <input type="hidden" id="pdf-page-id">
    <p class="font-14">{{ t('Admin action buttons.delete confirm title') }} &Lt;<span id="pdm-title"></span>&Gt;{{ t('Admin action buttons.delete confirm question mark') }}</p>
    @endmodal
@endsection
@push('css')
@endpush
@push('js')
    <script>
        var pageId = $('#pdf-page-id'),
            modalTitle = $('#pdm-title'),
            blocked = false,
            modal = $('#pageDeleteModal');
            loader = modal.find('.modal-loader');
        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            toastr.error('{{ t('Admin action notify.error') }}');
            modal.modal('hide');
        }
        modal.on('show.bs.modal', function(e){
            if (blocked) return false;
            var $this = $(this),
                button = $(e.relatedTarget),
                thisPageRow = button.parents('.page-row');
            pageId.val(thisPageRow.data('id'));
            modalTitle.html(thisPageRow.find('.page-title').html());

        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });
        $('#pageDeleteForm').on('submit', function(){
            if (blocked) return false;
            blocked = true;
            var thisPageId = pageId.val();
            if (thisPageId && thisPageId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: '{!! route('admin.pages.delete') !!}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        page_id: thisPageId,
                    },
                    error: function(e){
                        modalError();
                    },
                    success: function(e){
                        if (e.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            toastr.success('{{ t('Admin action notify.success') }}');
                            modal.modal('hide');
                            $('.page-row[data-id="'+thisPageId+'"]').fadeOut(function(){
                                $(this).remove();
                            });
                        }
                        else modalError();
                    }
                });
            }
            else modalError();
        });
    </script>
@endpush
