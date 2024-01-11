@if(isset($item))
    @push('js')
        <script>
            {
                let width = 1;
                let elem = document.getElementsByClassName("myBar");
                let totalValue = document.getElementsByClassName('data-total');
                let reachedValue = document.getElementsByClassName('reached-value');


                for (let i = 0; i < elem.length; i++) {
                    let params = {
                        width: width,
                        elem: elem[i],
                        totalValue: totalValue[i].getAttribute('data-total'),
                        reachedValue: reachedValue[i].getAttribute('data-reached'),
                        interval: null,
                    };

                    params.width = params.reachedValue / params.totalValue * 100;

                    params.interval = setInterval(frame, 50, params);
                }


                function frame(aParams) {
                    clearInterval(aParams.interval);
                    aParams.width++;
                    aParams.elem.style.backgroundColor = '#3B9DE2';
                    aParams.elem.style.width = aParams.width + '%';
                }
            }
        </script>
    @endpush

    <div class="progressbar-component">
        <div class="d-flex justify-content-between align-items-center progressbar-top">
            <div class="reached-value" data-reached="{{ $item->collected }}">
            <span class="reached-value-span">
                {{ __('frontend.Fundraisers.reached') }}
            </span>
                {{ $item->collected }}
            </div>
            <div class="left-value" data-left="{{ $item->cost - $item->collected }}">
                <span>{{ __('frontend.Fundraisers.left') }}</span>
                <span class="left-value-inner">
                {{ $item->cost - $item->collected }}
            </span>
            </div>
        </div>
        <div class="myProgress progressbar-middle">
            <div class="myBar"></div>
        </div>
        <div class="d-flex justify-content-between align-items-center progressbar-bottom">
            <div class="progress-bottom-text">
                {{ __('frontend.Fundraisers.goal') }}
            </div>
            <div class="progress-bottom-text data-total" data-total="{{ $item->cost }}">
                {{ $item->cost }}
            </div>
        </div>
    </div>
@endif
