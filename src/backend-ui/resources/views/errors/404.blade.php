@extends('layouts.app')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

@section('content')
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Container -->
        <div class="flex-fill">

            <!-- Error title -->
            <div class="text-center mb-4">
                <img src="{{asset('assets/images/error_bg.svg')}}" class="img-fluid mb-3" height="230" alt="">
                <h1 class="display-3 fw-semibold lh-1 mb-3">404</h1>
                <h6 class="w-md-25 mx-md-auto">Sorry, we couldn't find the page you were looking for.
                </h6>
            </div>
            <!-- /error title -->


            <!-- Error content -->
            <div class="text-center">
                <a href="{{ url()->previous() }}" class="btn btn-primary">
                    <i class="ph-house me-2"></i>
                    Return to back
                </a>
            </div>
            <!-- /error wrapper -->

        </div>
        <!-- /container -->

    </div>
@endsection