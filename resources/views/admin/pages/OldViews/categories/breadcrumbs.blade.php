<nav aria-label="breadcrumb">
    <ol class="breadcrumb custom-breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.categories.index') }}">{{ t('Admin Sidebar.Categories') }}</a>
        </li>
        @if(count($nestedParents) > 0)
            @foreach($nestedParents as $subParent)
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index', ['parentId' => $subParent->id]) }}">{{ $subParent->name }}</a></li>
            @endforeach
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $parent->name }}</li>
    </ol>
</nav>
