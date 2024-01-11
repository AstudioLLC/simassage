<form action="{{ route('admin.gallery.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if($gallery)
        <input type="hidden" name="gallery" value="{{ $gallery }}">
    @endif
    @if($key)
        <input type="hidden" name="key" value="{{ $key }}">
    @endif
    <div class="row">
        <div class="col-12">
            <div class="form-group border-bottom">
                @formTitle(['title' => __('app.Gallery form.Add images') . $imageSize])@endformTitle
                <div class="card-body">
                    @file(['name' => 'images[]', 'multiple' => true])@endfile
                </div>
            </div>
        </div>
    </div>
    @submit(['title' => null])@endsubmit
</form>
