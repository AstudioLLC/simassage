<div class="modal fade" id="{!! $id !!}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog {!! !empty($centered) ? 'modal-dialog-centered' : null !!}" role="document">
        <div class="modal-content position-relative">
            @if(!empty($form))
                <form action="@safe($form['action'], url()->current())" {!! exists('id="', $form['id'], '"') !!} method="{{ $form['method'] ?? 'post' }}" @if(!empty($form['multipart']))enctype="multipart/form-data"@endif>
            @endif

                    <div class="modal-header">
                        <h5 class="modal-title">@safe($slot['title'], __('app.Destroy'))</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @safe($slot['input'], '<input type="hidden" id="pdf-item-id">')
                        @safe($slot['question'], '<p class="mb-0 text-center">' . __('app.Are you sure? The page will be deleted permanently!') . '</p>')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn {{ $cancelBtnClass ?? 'btn-secondary' }}" data-dismiss="modal">
                            @safe($closeBtn, __('app.Close'))
                        </button>
                        <button type="{!! (!empty($form) && empty($form['no-submit'])) ? 'submit' : 'button' !!}" class="btn @safe($saveBtnClass, 'btn-success')">
                            @safe($saveBtn, __('app.Save'))
                        </button>
                    </div>
            @if(!empty($form))
                </form>
            @endif
            @if (!empty($loader))
                <div class="loader modal-loader"></div>
            @endif
        </div>
    </div>
</div>
