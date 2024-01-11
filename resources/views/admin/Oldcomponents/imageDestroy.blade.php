<a href="javascript:void(0)" class="btn btn-danger mb-3 itemImageDelButton" data-toggle="modal" data-target="#itemDeleteModal" data-item-id="{{ $id ?? null }}">
    Удалить изображение
</a>

<div class="modal fade" id="itemDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">{{ t('Admin action buttons.delete title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-14">{{ t('Admin action buttons.delete image confirm title') . t('Admin action buttons.delete confirm question mark') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ t('Admin action buttons.cancel') }}
                </button>
                <button type="button" class="btn btn-danger deleteItemImage" data-item-id="{{ $id ?? null }}">
                    {{ t('Admin action buttons.delete') }}
                </button>
            </div>
            <div class="loader modal-loader"></div>
        </div>
    </div>
</div>



@push('js')
    <script>
        var action = "{{ $action ?? null }}";
        console.log(action);

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
        modal.on('show.bs.modal', function(e){
            if (blocked) return false;
        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });

        $('.deleteItemImage').on('click', function(){
            if (blocked) return false;
            blocked = true;
            var $this = $(this),
            thisItemId = $this.data('item-id');
            //if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
            if (thisItemId) {
                loader.addClass('shown');
                $.ajax({
                    url: action,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        item_id: thisItemId,
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
                            $this.fadeOut(function(){
                                $('img.img-responsive').parent().remove();
                                $('.itemImageDelButton').remove();
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
