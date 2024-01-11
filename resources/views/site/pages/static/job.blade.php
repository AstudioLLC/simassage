@extends('site.layouts.app')
@section('content')
<section class="work-page-section">
    <div class="container">
        <div class="section-title">
            <img src="{{asset('image/flower-2.png')}}" alt="">
            <h1 class="section-title-text">{{$page->title}}</h1>
        </div>
        <div class="work-block">
            @foreach($jobs as $job)
            <div class="work-item">
                <h3 class="work-item-title">{{$job->title}}</h3>
                <div class="mobile-work-btn">
                    <div class="work-new-page-btn-mob">
                        <a href="{{ route('job.detail', ['id' => $job->id]) }}">
                            <button class="work-more-btn">{{__('app.more')}}</button>
                        </a>
                    </div>
                </div>
                <div class="work-info">
                    <div class="sale-date-div">
                        <div class="work-time">
                            <p class="work-title">{{t('Page home.Working hours')}}</p>
                            <p class="work-number">{{$job->working_hours}}</p>
                        </div>
                        <div class="work-sale">
                            <p class="work-title">{{__('app.salary')}}</p>
                            <p class="work-number">{{$job->salary}}</p>
                        </div>
                    </div>
                    <div class="work-new-page-btn">
                        <a href="{{ route('job.detail', ['id' => $job->id]) }}">
                            <button class="work-more-btn">{{__('app.more')}}</button>
                        </a>
                    </div>
                </div>
                <div class="work-info-more">{!! \Illuminate\Support\Str::limit($job->content, 330) !!} </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('js')
    <script type="text/javascript">
        // File name show in modal
        document.getElementById("file").addEventListener("change", function(event) {
            var file = event.target.files[0];
            var filename = file.name;
            $('.filename').text(filename.substring(0,20) + '...')
            $('.chosefile').hide()
        });
        // File name show in modal
        $('#file').on('change', function() {
            var inputElement = document.getElementById("file")
            inputElement.addEventListener('change', function(){
                var fileLimit = 2024; // could be whatever you want
                var files = inputElement.files; //this is an array
                var fileSize = files[0].size;
                var fileSizeInKB = (fileSize/1024); // this would be in kilobytes defaults to bytes
                if(fileSizeInKB < fileLimit){
                    document.getElementById("error").innerHTML = "File go for launch"
                } else {
                    document.getElementById("error").innerHTML = "Your file is over 2024 KB "
                }
            })
        });
    </script>
@endpush
