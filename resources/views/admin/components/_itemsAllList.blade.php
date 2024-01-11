@foreach($items as $aItem)
    <option value="{{ $aItem->id ?? "" }}"
            {{--@isset($item->id)
            @if ($aItem->id == $item->parent_id) selected
            @endif

            @if ($aItem->id == $item->id) disabled
        @endif
        @endisset--}}
        @isset($parentId)
            @if ($aItem->id == $parentId) selected
            @endif
        @endisset
    >
        {!! $delimiter ?? "" !!} {{ $aItem->title ?? "" }} {!! $delimiter ?? "" !!}
    </option>

    @if(isset($childsShow))
        @if (count($aItem->children) > 0)
            @itemsAllList(['items' => $aItem->children, 'delimiter' => ' - ' . $delimiter])@enditemsAllList
        @endif
    @endif
@endforeach
