@extends('site.layouts.app')

@section('content')
    <section class="work-page-section">
        <div class="container">
            <div class="section-title">
                <img src="{{asset('image/flower-2.png')}}" alt="">
                <h2 class="section-title-text">{{ $job->title }} </h2>
            </div>
            <div class="work-block work-ditail-page">
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
                    <div class="editor">{!! $job->content !!}</div>

                </div>
                <div class="work-page-contact">
                    <form action="{{ route('job.apply_job') }}" method="post" class="contacts__form form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_position" id="job_position" value="{{$job->title}}">
                        <div class="form__body">
                            <div class="form__input group">
                                <input class="group__field" name="name" type="text" required>
                                <label class="group__label" for="name">Ф. И. О<span>*</span></label>
                                @if ($errors->has('name'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                   </span>
                                @endif
                            </div>
                            <div class="form__input group">
                                <input class="group__field" name="phone" type="phone" required>
                                <label class="group__label" for="phone">Тел<span>*</span></label>
                                @if ($errors->has('phone'))
                                    <span class="text-danger">
                                       <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form__input group">
                                <input class="group__field" name="email" type="email" required>
                                <label class="group__label" for="email">Эл. почта <span>*</span></label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form__textarea group">
                                <textarea class="group__field" name="message" rows="1"></textarea>
                                <label class="group__label" for="message">Сообщение</label>
                                @if ($errors->has('message'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form__footer">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_Key') }}"></div>
                            <button class="form__submit">
                                <p>{{t('Page home.Send')}}</p>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        // File name show in modal
        document.getElementById("file").addEventListener("change", function (event) {
            var file = event.target.files[0];
            var filename = file.name;
            $('.filename').text(filename.substring(0, 20) + '...')
            $('.chosefile').hide()
        });
        // File name show in modal
        $('#file').on('change', function () {
            var inputElement = document.getElementById("file")
            inputElement.addEventListener('change', function () {
                var fileLimit = 2024; // could be whatever you want
                var files = inputElement.files; //this is an array
                var fileSize = files[0].size;
                var fileSizeInKB = (fileSize / 1024); // this would be in kilobytes defaults to bytes
                if (fileSizeInKB < fileLimit) {
                    document.getElementById("error").innerHTML = "File go for launch"
                } else {
                    document.getElementById("error").innerHTML = "Your file is over 2024 KB "
                }
            })
        });
    </script>
@endpush
