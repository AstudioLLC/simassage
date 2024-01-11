<a href="javascript:void(0)" class="btn btn-danger btn-sm mt-3 itemImageDelButton" data-toggle="modal" data-target="#itemDeleteModal" data-item-id="{{ $id ?? null }}">
    {{ $title ?? __('app.Delete image') }}
</a>

<div class="modal fade" id="itemDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? __('app.Delete image') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-center">{{ __('app.Are you sure? The page will be deleted permanently!') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('app.Close') }}
                </button>
                <button type="button" class="btn btn-success deleteItemImage" aria-label="Close" data-item-id="{{ $id ?? null }}" onclick="deleteImage(this)">
                    {{ __('app.Delete') }}
                </button>
            </div>
            <div class="loader modal-loader"></div>
        </div>
    </div>
</div>



@push('js')
    <script>
      function deleteImage(button) {
     var itemId = $(button).data('item-id');
        $.ajax({
            data: { itemId: itemId },
            success: function(response) {
                // Handle the success response

                // Close the modal manually
                var modal = button.closest('.modal');
                if (modal) {
                    $(modal).modal('hide');
                }

                // Refresh the page
                setTimeout(function(){
                location.reload(true);
                }, 1000); // 1 seconds
            },
            error: function(xhr, status, error) {
                // Handle the error response
            }
        });
}

        var action = "{{ $action ?? null }}";

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

        $('.deleteItemImage').on('click', function() {
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
