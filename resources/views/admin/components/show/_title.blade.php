<div class="form-group border-bottom">
    @bylang([
    'id' => $id ?? null,
    'tp_classes' => 'little-p',
    'title' => $formTitle ?? null])
    <div class="card-body">{!! tr($item, $title, $iso) !!}</div>
    @endbylang
</div>
