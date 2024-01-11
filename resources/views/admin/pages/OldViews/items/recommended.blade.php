@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    @include('admin.components.errors')
    @if(count($allItems))
        <form method="post" action="{{ route('admin.items.recommended.sync',['id'=> $item->id]) }}" class="d-flex flex-column">
            @csrf
            <div class="col-12">
                <div class="card p-3">
                    <label for="color_filters">{{ t('Admin items.recommended') }}</label>
                    <select class="js-example-basic-multiple" name="recommended[]" id="recommended" multiple="multiple">
                        @foreach($allItems as $items)
                            <option value="{{ $items->id }}" {{ (in_array($items->id, $selectedRecommendedItems)) ? 'selected' : 'null' }}>
                                {{ $items->code .' - '. $items->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-actionbar mt-3">
                <button type="submit" class="btn ink-reaction btn-raised btn-primary">{{ t('Admin action buttons.save') }}</button>
            </div>
        </form>
    @else
        <h4 class="text-danger">{{ t('Admin pages list.empty') }}</h4>
    @endif
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush

@css(aApp('select2/select2.css'))
