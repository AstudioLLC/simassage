<div class="row gallery-row grid-sortable mt-5">
    @foreach($items as $item)
        <div class="item-container col-sm-4 col-xs-6 col-md-6 col-lg-3 col-xl-2" data-id="{{ $item->id }}">
            <div class="border shadow--hover my-3">
                <a class="thumbnail fancybox" rel="ligthbox" href="{{ $item->getImageUrl('small') }}">
                    <div class="text-right p-2 border-bottom">
                        <a href="javascript:void(0)" class="gallery-item-action gallery-item-edit text" data-toggle="modal" data-target="#itemEditModal">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="{{ $item->getImageUrl('thumbnail') }}" data-fancybox="gallery" class="gallery-item-show">
                            <i class="fas fa-search-plus"></i>
                        </a>
                        <a href="javascript:void(0)" class="gallery-item-action gallery-item-move text-darker">
                            <i class="fas fa-arrows-alt"></i>
                        </a>
                        <a href="javascript:void(0)" class="gallery-item-action text-danger" data-toggle="modal" data-target="#itemDeleteModal">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    <img class="img-fluid img-center p-2" alt="" src="{{$item->getImageUrl('small')}}">
                </a>
            </div>
        </div>
    @endforeach

    @include('admin.components._modal', [
        'id' => 'itemDeleteModal',
        'centered' => true,
        'loader' => true,
        'saveBtn' => __('app.Delete'),
        'saveBtnClass' => 'btn-danger',
        'closeBtn' => __('app.Close'),
        'slot' => [
            'title' => __('app.Destroy'),
            'input' => '<input type="hidden" id="pdf-item-id">',
            'question' => '<p class="mb-0">' . __('app.Are you sure? The page will be deleted permanently!') . '</p>'],
        'form' => [
            'id'=>'itemDeleteForm',
            'action'=>'javascript:void(0)']
    ])

    @include('admin.components._modal', [
        'id' => 'itemEditModal',
        'centered' => true,
        'loader' => true,
        'saveBtn' => __('app.Save'),
        'saveBtnClass' => 'btn-success',
        'closeBtn' => __('app.Close'),
        'slot' => [
            'title' => __('app.Edit'),
            'input' => '<input type="hidden" id="edit-item-id">',
            'question' => '<div class="modal-changer">1</div>'
        ],
        'form' => [
            'id'=>'itemEditForm',
            'action'=>'javascript:void(0)']
    ])

    <div class="d-none gallery-edit">
        @bylang([
        'id' => 'gallery-bylang',
        'title' => __('app.SEO')])
        <input type="text"
               name="alt[{!! $iso !!}]"
               id="edit-alt-{{ $iso }}"
               class="form-control form-control-sm form-control-alternative mb-4"
               placeholder="{{ __('app.Form.Alt') }}">
        <input type="text"
               name="title[{!! $iso !!}]"
               id="edit-title-{{ $iso }}"
               class="form-control form-control-sm form-control-alternative"
               placeholder="{{ __('app.Form.Title') }}">
        @endbylang
    </div>
</div>
