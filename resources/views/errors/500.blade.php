@extends('layout.app')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))

@section('content')
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Container -->
        <div class="flex-fill">

            <!-- Error title -->
            <div class="text-center mb-4">
                <img src="{{asset('assets/images/error_bg.svg')}}" class="img-fluid mb-3" height="230" alt="">
                <h1 class="display-3 fw-semibold lh-1 mb-3">500</h1>
                <h6 class="w-md-25 mx-md-auto">Oops, an error has occurred.
                    The server encountered an internal error and was unable to complete your request.
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