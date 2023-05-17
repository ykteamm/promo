@extends('layouts.app')
@section('content')

<div class="container h-100 pl-0 pr-0">
        <div class="swiper-container introduction active2 text-white">
            <div class="swiper-wrapper">

                @include('w-component.profile')

                @include('w-component.main')

            </div>
        </div>
</div>
@include('modal.reyting')
@include('modal.bonus')

@endsection
@section('scripts')
<script>
    function changeDay(number)
        {
            if(number == 0)
            {
                $('.first_one').addClass('d-none');
                $('.first_two').removeClass('d-none');
            }else{
                $('.first_two').addClass('d-none');
                $('.first_one').removeClass('d-none');
            }
        }
</script>
@endsection
