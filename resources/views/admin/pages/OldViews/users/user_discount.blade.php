@extends('admin.layouts.app')
@section('title', $title)
@section('content')
    <div class="col-12">
        <div class="card p-3">
            <form method="post" action="{{ route('admin.users.add.discount', ['id'=>$user_id] )}}" class="d-flex flex-column">
                @csrf
                <label for="discount">{{ t('Admin users discount.tie discount') }}</label>
                <select class="js-example-basic-multiple" name="discount"  id="discount">
                    @foreach($discounts as $discount)
                        <option value="">{{ t('Admin users discount.no discount') }}</option>
                        @if(!empty($user_discount) && !empty($user_discount->individual_discount) && $loop->first)
                            <option value="{{ $user_discount->individual_discount }}" selected="selected">
                                {{ t('Admin users discount.personal discount') }} {{ $user_discount->individual_discount.'%' }}
                            </option>
                         @else
                            <option value="{{ json_encode(['discount_id' => $discount->id, 'discount' => (int) $discount->discount]) }}"
                                {{ (!empty($user_discount) && $discount->id == $user_discount->discount_id) ? 'selected' : 'null' }}>
                                {{ $discount->title }}
                            </option>
                        @endif
                    @endforeach
                </select>
                <div class="card-actionbar mt-3">
                    <button type="submit" class="btn ink-reaction btn-raised btn-primary">
                        {{ t('Admin action buttons.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                tags:true
            });
        });
    </script>
@endpush

@css(aApp('select2/select2.css'))
