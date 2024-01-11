@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    @include('admin.components.errors')
    <form method="post" action="{{ route('admin.items.filters.sync',['id'=> $item->id]) }}" class="d-flex flex-column">
        @csrf
        @if(count($filters))
            <div class="col-12">
                <div class="card p-3">
                    <label for="item_criterions">{{ t('Admin items.associate with criterion') }}</label>
                    <select class="js-example-basic-multiple" name="criteria[]" id="item_criterions" multiple="multiple">
                        @foreach($filters as $filter)
                            <optgroup label="{{ $filter->name }}">
                                @foreach($filter->criteria as $criterion)
                                    <option value="{{ $criterion->id }}" {{ $item->criteria->contains($criterion) ? 'selected' : 'null' }}>
                                        {{ $criterion->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card p-3">
                <label for="color_filters">{{ t('Admin items.associate with color filter') }}</label>
                <select class="js-example-basic-multiple" name="color_filters[]" id="color_filters"
                        multiple="multiple">
                    @foreach($colorFilters as $colorFilter)
                        <option value="{{ $colorFilter->id }}" {{ (in_array($colorFilter->id, $selectedColorFilters)) ? 'selected' : 'null'}}>
                            {{ $colorFilter->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-3">
                <label for="country_filters">{{ t('Admin items.associate with countries') }}</label>
                <select class="js-example-basic-multiple" name="country_filters[]" id="country_filters"
                        multiple="multiple">
                    @foreach($countryFilters as $countryFilter)
                        <option value="{{ $countryFilter->id }}" {{ (in_array($countryFilter->id, $selectedCountryFilters)) ? 'selected' : 'null' }}>
                            {{ $countryFilter->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-actionbar mt-3">
            <button type="submit" class="btn ink-reaction btn-raised btn-primary">{{ t('Admin action buttons.save') }}</button>
        </div>
    </form>
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
