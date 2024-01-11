@push('js')
    @ckeditor
@endpush

<form action="{!! $edit ? route('admin.departmentsInformation.edit', ['id' => $item->id]) : route('admin.departmentsInformation.store') !!}"
      method="post" enctype="multipart/form-data">
    @csrf
    @method($edit ? 'put' : 'post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <input type="hidden" value="{{$parent_id}}" name="parent_id">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group border-bottom">
                @bylang([
                'id' => 'form_title',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Title')])
                <input type="text"
                       name="title[{!! $iso !!}]"
                       class="form-control form-control-sm form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                       placeholder="{{ __('app.Form.Title') }}"
                       value="{{ old('title.'.$iso, tr($item, 'title', $iso)) }}">
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
            {{--            <div class="form-group border-bottom">--}}
            {{--                @formTitle(['title' => __('app.List.Creation date')])@endformTitle--}}
            {{--                <div class="card-body">--}}
            {{--                    <input type="datetime-local"--}}
            {{--                           name="created_at"--}}
            {{--                           class="form-control"--}}
            {{--                           id="created_at"--}}
            {{--                           placeholder="{{ __('app.List.Creation date') }}"--}}
            {{--                           value="{{ (isset($item) && $item->created_at) ? $item->created_at->format('Y-m-d') .'T'. $item->created_at->format('H:i:s') : date('Y-m-d') .'T'.date('H:i:s') }}">--}}
            {{--                    @if ($errors->has('created_at'))--}}
            {{--                        <span class="invalid-feedback" role="alert">--}}
            {{--                            <strong>{{ $errors->first('created_at') }}</strong>--}}
            {{--                        </span>--}}
            {{--                    @endif--}}
            {{--                </div>--}}
            {{--            </div>--}}
{{--            <div class="form-group border-bottom">--}}
{{--                @formTitle(['title' => __('app.Form.Image') . $imageBigSize])@endformTitle--}}
{{--                <div class="card-body">--}}
{{--                    @file(['name'=>'imageBig'])@endfile--}}

{{--                    @if (!empty($item->imageBig))--}}
{{--                        <div class="border">--}}

{{--                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageBig) }}"--}}
{{--                                 class="img-fluid img-center p-2">--}}
{{--                        </div>--}}
{{--                        <input type="hidden" name="old_imageBig" value="{{ $item->imageBig }}">--}}
{{--                        @imageDestroy([--}}
{{--                        'id' => $item->id,--}}
{{--                        'title' => __('app.Delete image'),--}}
{{--                        'action' => route('admin.departmentsInformation.deleteImage')--}}
{{--                        ])@endimageDestroy--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="col-12 col-lg-6">
{{--            <div class="form-group border-bottom">--}}
{{--                @formTitle(['title' => __('app.Form.Icon') . $imageSmallSize])@endformTitle--}}
{{--                <div class="card-body">--}}
{{--                    @file(['name'=>'imageSmall'])@endfile--}}
{{--                    @if (!empty($item->imageSmall))--}}
{{--                        <div class="border">--}}
{{--                            <img src="{{ $item->getImageUrl('thumbnail', $item->imageSmall) }}"--}}
{{--                                 class="img-fluid img-center p-2">--}}
{{--                        </div>--}}
{{--                        <input type="hidden" name="old_imageSmall" value="{{ $item->imageSmall }}">--}}
{{--                        @imageDestroy([--}}
{{--                        'id' => $item->id,--}}
{{--                        'title' => __('app.Delete image'),--}}
{{--                        'action' => route('admin.departmentsInformation.deleteImage')--}}
{{--                        ])@endimageDestroy--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group border-bottom">
                @checkbox([
                'id' => 'active',
                'label' => __('app.Active'),
                'checked' => oldCheck('active', ($edit && empty($item->active)) ? false : true)
                ])@endcheckbox
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                @bylang([
                'id' => 'form_content',
                'tp_classes' => 'little-p',
                'title' => __('app.Form.Content text')])

                <textarea name="content[{!! $iso !!}]"
                          class="ckeditor form-control form-control-sm form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                          rows="5"
                          placeholder="{{ __('app.Form.Content text') }}">{{ old('content.'.$iso, tr($item, 'content', $iso)) }}</textarea>
                @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                @endif
                @endbylang
            </div>
        </div>
    </div>

    @submit(['title' => null])@endsubmit
</form>

@push('js')
    <script>
        var action = "{!! route('admin.departmentsInformation.deleteImage') !!}";

        var itemId = $('#pdf-item-id'),
            modalTitle = $('#pdm-title'),
            blocked = false,
            modal = $('#itemDeleteModal');
        loader = modal.find('.modal-loader');
        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            toastr.error('{{ t('Admin action notify.error') }}');
            modal.modal('hide');
        }
        {{--modal.on('show.bs.modal', function(e){--}}
        {{--    if (blocked) return false;--}}
        {{--}).on('hide.bs.modal', function(e){--}}
        {{--    if (blocked) return false;--}}
        {{--});--}}

        $('.gallery-second').on('click', function() {

            var $this = $(this),
                gallery_second = $this.data('id');
            //if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
            console.log(gallery_second)
            if (gallery_second) {
                loader.addClass('shown');
                $.ajax({
                    url: action,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        gallery_second: gallery_second,
                    },

                    error: function(e){
                        modalError();
                    },
                    success: function(e){
                        if (e.success) {
                            $this.parents('.item-container').remove()
                        }
                        else console.log(123)
                            // modalError();
                    }
                });
            }
            else modalError();
        });
    </script>
@endpush
