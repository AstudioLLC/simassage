@if(!count($category->children))
    <option value="{{$category->id}}" data-level="{{ $level }}" {{ $selected == $category->id ? 'selected' : '' }}> {{ $category->name }} </option>
@else
    <option value="" data-level="{{ $level }}" disabled> {{ $category->name }} </option>
    @foreach($category->children as $child)
        @include('admin.components.smart-select-option', [
            'category' => $child,
            'level' => ++$level,
            'selected' => $selected
        ])
    @endforeach
@endif
