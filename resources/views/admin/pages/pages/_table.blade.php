<table class="table align-items-center table-flush" id="datatable-basic">
    <thead class="thead-light">
    <tr>
        <th>{{ __('app.List.Name') }}</th>
        <th>{{ __('app.Subcategories') }}</th>
        <th>{{ __('app.Active') }}</th>
{{--        <th>{{ __('app.Queing Section') }}</th>--}}
        <th class="text-right">{{ __('app.Action') }}</th>
    </tr>
    </thead>
    <tbody class="list table-sortable" data-action="{{ route('admin.pages.sort') }}">
        @forelse($items as $item)
            <tr data-id="{{ $item->id }}" class="item-row">
                <td class="item-title">{{ $item->title }}</td>
                @if($item->static == 'doctors')
                <td>
                    <a href="{{ route('admin.doctors.index') }}" target="_blank" class="text-muted text-decoration-none">
                        {{ __('app.Subcategories') . ' (' .  $doctorCount  . ')' }}
                    </a>
                </td>
                @elseif($item->static == 'question')
                <td>
                    <a href="{{ route('admin.question.index') }}" target="_blank" class="text-muted text-decoration-none">
                        {{ __('app.Subcategories') . ' (' .  $questionCount  . ')' }}
                    </a>
                </td>
                @elseif($item->static == 'job')
                <td>
                    <a href="{{ route('admin.job.index') }}" target="_blank" class="text-muted text-decoration-none">
                        {{ __('app.Subcategories') . ' (' .  $jobCount  . ')' }}
                    </a>
                </td>
                @else
                    <td>
                        <a href="{{ route('admin.pages.index', ['parentId' => $item->id]) }}" target="_blank" class="text-muted text-decoration-none">
                            {{ __('app.Subcategories') . ' (' . $item->children_count . ')' }}
                        </a>
                    </td>
                @endif
                <td>
                    <label class="custom-toggle page-active">
                        <input type="checkbox" value="{{ $item->active }}" {{ $item->active ? ' checked' : '' }}>
                        <span class="custom-toggle-slider rounded-circle"></span>
                    </label>

                </td>
{{--                <td>--}}
{{--                    @if($item->static == 'departments'  || $item->static == 'home')--}}
{{--                    <label class="custom-toggle form-active">--}}
{{--                        <input type="checkbox" value="{{ $item->active_form }}" {{ $item->active_form ? ' checked' : '' }}>--}}
{{--                        <span class="custom-toggle-slider rounded-circle"></span>--}}
{{--                    </label>--}}
{{--                    @endif--}}
{{--                    @if($item->static == 'doctors')--}}
{{--                    <label class="custom-toggle form-active-doctor">--}}
{{--                        <input type="checkbox" value="{{ $item->active_form }}" {{ $item->active_form ? ' checked' : '' }}>--}}
{{--                        <span class="custom-toggle-slider rounded-circle"></span>--}}
{{--                    </label>--}}
{{--                    @endif--}}
{{--                </td>--}}
                <td class="text-right">
{{--                    <a class="btn btn-sm btn-icon-only btn-outline-info"--}}
{{--                       href="{{ route('admin.pages.show', ['id' => $item->id]) }}"--}}
{{--                       title="{{ __('app.View') }}">--}}
{{--                        <i class="fas fa-eye"></i>--}}
{{--                    </a>--}}
                    @if($item->menu_into)
                    <a class="btn btn-sm btn-icon-only btn-outline-default"
                       href="{{ route('admin.'. $item->static .'.index') }}"
                       title="{{ __('app.Page into') }} ({{ $item->gallery_count }})">
                        <i class="fas fa-plus"></i>
                    </a>
                    @elseif($item->parent_id == 67 )
                        <a class="btn btn-sm btn-icon-only btn-outline-default"
                           href="{{ route('admin.departments.index', ['parentId' => $item->id]) }}"
                           title="{{ __('app.Page into') }} ({{ $item->gallery_count }})">
                            <i class="fas fa-plus"></i>
                        </a>
                        @elseif($item->static == 'directorate')
                        <a class="btn btn-sm btn-icon-only btn-outline-default"
                           href="{{ route('admin.directorate.index') }}"
                           title="{{ __('app.Page into') }} ({{ $item->gallery_count }})">
                            <i class="fas fa-plus"></i>
                        </a>
                    @elseif($item->static == 'administration')
                        <a class="btn btn-sm btn-icon-only btn-outline-default"
                           href="{{ route('admin.directorate2.index') }}"
                           title="{{ __('app.Page into') }} ({{ $item->gallery_count }})">
                            <i class="fas fa-plus"></i>
                        </a>
                    @endif


                    @if($item->static == 'information' || $item->static == 'patient' || $item->static == null && $item->parent_id != 67)
                        <a class="btn btn-sm btn-icon-only btn-outline-default"
                           href="{{ route('admin.file.index', ['file' => 'pages', 'key' => $item->id]) }}"
                           title="{{ __('app.Files') }} ({{ $item->files_count }})">
                            <i class="far fa-copy"></i>
                        </a>

                    @endif
                    @if($item->static == 'queuing')
                        <a href="{{ route('admin.videos.index', ['video'=>'pages', 'key'=>$item->id]) }}"
                           {{--                          {!! tooltip(t('Admin action buttons.videogallery')) !!}--}}
                           class="btn btn-sm btn-icon-only btn-outline-default" title="{{ __('app.Video gallery') }} ({{$item->videos_count}})">
                            <i class="far fa-file-video"></i>
                        </a>
                    @endif
                    <a class="btn btn-sm btn-icon-only btn-outline-default"
                       href="{{ route('admin.gallery.index', ['gallery' => 'pages', 'key' => $item->id]) }}"
                       title="{{ __('app.Gallery') }} ({{ $item->gallery_count }})">
                        <i class="far fa-images"></i>
                    </a>
{{--                   @if(isset($video_gallery_pages) && array_key_exists($item->static, $video_gallery_pages))--}}
{{--                        <a class="btn btn-sm btn-icon-only text-light"--}}
{{--                           href="{{ $file_pages[$item->static] }}"--}}
{{--                           title="{{ __('app.Video gallery') }}">--}}
{{--                            <i class="far fa-file-video"></i>--}}
{{--                        </a>--}}
{{--                    @endif--}}
                    <a href="{{ route('admin.videos.index', ['video'=>'pages', 'key'=>$item->id]) }}"
{{--                          {!! tooltip(t('Admin action buttons.videogallery')) !!}--}}
                          class="btn btn-sm btn-icon-only btn-outline-default" title="{{ __('app.Video gallery') }} ({{$item->videos_count}})">
                        <i class="far fa-file-video"></i>
                    </a>

                    <a class="btn btn-sm btn-icon-only btn-outline-primary"
                       href="{{ route('admin.pages.edit', ['id' => $item->id]) }}"
                       title="{{ __('app.Edit') }}">
                        <i class="far fa-edit"></i>
                    </a>

                    @if(!$item->static && $item->children_count == 0 && $item->children_with_trashed_count == 0 && auth()->user()->type == 0)
                        <a class="btn btn-sm btn-icon-only btn-outline-danger delete"
                           href="javascript:void(0)"
                           title="{{ __('app.Destroy') }}"
                           data-toggle="modal"
                           data-target="#itemDeleteModal">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            @include('admin.components._empty')
        @endforelse
    </tbody>
</table>
