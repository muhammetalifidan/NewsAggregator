@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Dashboard
                </h4>

                <a href="#page_header"
                    class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto"
                    data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Cover area -->
    <div class="profile-cover">
        <div class="profile-cover-img" style="background-image: url({{ asset('assets/images/banner.jpg') }})">
        </div>
        <div
            class="d-flex align-items-center text-center text-lg-start flex-column flex-lg-row position-absolute start-0 end-0 bottom-0 mx-3 mb-3">
            <div class="me-lg-3 mb-2 mb-lg-0">
                <img src="{{ asset('assets/images/portre.jpg') }}" class="img-thumbnail rounded-circle shadow"
                    style="object-fit: cover; width: 100px; height: 100px">
            </div>

            <div class="profile-cover-text text-white">
                <h1 class="mb-0">Muhammet Ali Fidan</h1>
                <span class="d-block">Backend Developer</span>
            </div>
        </div>
    </div>
    <!-- /cover area -->

    <!-- Profile navigation -->
    <div class="navbar navbar-expand-lg border-bottom py-2">
        <div class="container-fluid">
            <ul class="nav navbar-nav flex-row flex-fill">
                <li class="nav-item me-1">
                    <a href="#activity" class="navbar-nav-link navbar-nav-link-icon active rounded" data-bs-toggle="tab">
                        <div class="d-flex align-items-center mx-lg-1">
                            <i class="ph-activity"></i>
                            <span class="d-none d-lg-inline-block ms-2">My Resume</span>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="navbar-collapse collapse" id="profile_nav">
                <ul class="navbar-nav ms-lg-auto mt-2 mt-lg-0">
                    <li class="nav-item ms-lg-1">
                        <a href="/assets/pdf/my_cv.pdf" class="navbar-nav-link rounded" target="_blank">
                            <i class="ph-note me-2"></i>
                            Download CV
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /profile navigation -->

    <!-- Content area -->
    <div class="content">

        <!-- Inner container -->
        <div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

            <!-- Left content -->
            <div class="tab-content flex-fill order-2 order-lg-1">
                <div class="tab-pane fade active show" id="activity">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header d-sm-flex">
                                    <h6 class="mb-0">JPG PNG PDF Converter MoldFile</h6>
                                </div>

                                <div class="card-body">
                                    <div class="card-img-actions mb-3">
                                        <img class="card-img img-fluid" src="{{ asset('assets/images/moldfile.jpg') }}"
                                            alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="https://apps.apple.com/us/app/jpg-png-pdf-converter-moldfile/id6698877309"
                                                class="btn btn-outline-white btn-icon rounded-pill" target="_blank">
                                                <i class="ph-link"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <blockquote class="blockquote border-start border-width-5 py-2 ps-3 mb-0">
                                        <p class="mb-2 fs-base">One platform for every file! Accelerate your workflow with
                                            easy conversion and customization options
                                            <br><br>MoldFile: One Stop for All Your File Conversions!
                                            <br><br>Make your file conversions effortless! Convert between 300+ file formats
                                            instantly with MoldFile.
                                        </p>
                                </div>

                                <div class="card-body d-flex justify-content-between align-items-center pt-0">
                                    <a href="https://www.moldfile.com/" class="d-inline-block" target="_blank">
                                        Go to website</a>

                                    <a href="https://apps.apple.com/us/app/jpg-png-pdf-converter-moldfile/id6698877309"
                                        class="d-inline-block" target="_blank">
                                        App Store Preview</a>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-sm-flex">
                                    <h6 class="mb-0">Youtube Channel | Coderlog</h6>
                                </div>

                                <div class="card-body">
                                    <p class="mb-3">As a computer engineering student, I help students who are studying or
                                        want to study this field by making videos about the fields in which I have developed
                                        myself.</p>

                                    <div class="ratio ratio-16x9">
                                        <iframe width="560" height="315"
                                            src="https://www.youtube.com/embed/xtNJvT6GIjI?si=5XBxDgSt9t1dadfj"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="card-body d-flex justify-content-between align-items-center pt-0">
                                    <a href="https://www.youtube.com/@coder_log" class="d-inline-block" target="_blank">
                                        Go to my channel</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header d-sm-flex">
                                    <h6 class="mb-0">My Portfolio</h6>
                                </div>

                                <div class="card-body">
                                    <div class="card-img-actions mb-3">
                                        <img class="card-img img-fluid" src="{{ asset('assets/images/portfolio.png') }}"
                                            alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="https://www.muhammetalifidan.com.tr"
                                                class="btn btn-outline-white btn-icon rounded-pill" target="_blank">
                                                <i class="ph-link"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <blockquote class="blockquote border-start border-width-5 py-2 ps-3 mb-0">
                                        <p class="mb-2 fs-base">My blog and portfolio page that I created using powerful
                                            tools such as PHP, Laravel, HTML, CSS, Javascript, Bootstrap 5 and MySQL..
                                        </p>
                                </div>

                                <div class="card-body d-flex justify-content-between align-items-center pt-0">
                                    <a href="https://www.muhammetalifidan.com.tr/" class="d-inline-block"
                                        target="_blank">
                                        Go to website</a>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-sm-flex">
                                    <h6 class="mb-0">Jotform Experience</h6>
                                </div>

                                <div class="card-body">
                                    <p class="mb-3">I am happy to successfully complete the task given to me during my
                                        internship. Interning at Jotform was a great experience both technically and
                                        personally.</p>

                                    <div class="card-img-actions mb-3">
                                        <img class="card-img img-fluid" src="{{ asset('assets/images/jotform.jpg') }}"
                                            alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="https://www.linkedin.com/feed/update/urn:li:activity:7225200131975876609/"
                                                class="btn btn-outline-white btn-icon rounded-pill" target="_blank">
                                                <i class="ph-link"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body d-flex justify-content-between align-items-center pt-0">
                                    <a href="https://www.linkedin.com/in/muhammetalifidan/" class="d-inline-block"
                                        target="_blank">
                                        Go to my Linkedin</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /left content -->

        </div>
        <!-- /inner container -->

    </div>
    <!-- /content area -->
@endsection
