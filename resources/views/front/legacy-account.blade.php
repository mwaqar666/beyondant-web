<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/legacy-profile.css') }}">
    <title>{{ $record->first_name }}</title>
</head>

<body>
    <section>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img class="w-50 m-auto" src="{{ asset('assets/front/images/logo.png') }}" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0)">
                                <button class="btn text-white">Login</button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-4">
                                <button class="btn btn-light">Sign Up</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <section>
        <div class="main-video">
            <iframe
                width="100%" allowfullscreen
                src="https://www.youtube-nocookie.com/embed/2ljxxQy8zHI" title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            ></iframe>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-banner-img">
                        <img class="w-100" src="{{ asset('assets/front/images/banner-image-setting.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="main-banner-text">
                        <h5>Ronni Roth</h5>
                        <p>Administrator</p>
                    </div>
                </div>
                <div class="col-lg-2 m-auto">
                    <button class="btn btn-danger w-100 mt-3 mb-2">
                        <i class="fa fa-youtube-play mr-2"></i> Subscribe
                    </button>
                    <button class="btn btn-danger w-100">
                        <i class="fa fa-comment-o mr-2"></i> Private Comments
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <div class="location">
                        <h4>Cemetery Location:</h4>
                        <p>3201 N. 72nd Ave</p>
                        <p>Hollywood, FL 33024.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="time-line-img">
                    <div class="col-lg-5">
                        <div class="life-time" style="position: absolute">
                            <h1>LIFE <span>&amp;</span> TIME</h1>
                            <h2>JEFFERY ROTH</h2>
                            <h5>
                                1948 <span>
                                    <img src="{{ asset('assets/front/images/text-img.png') }}" alt="">
                                </span> 2021
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <img class="w-100" src="{{ asset('assets/front/images/time-line.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7"></div>
                <div class="col-lg-5">
                    <div class="roth">
                        <h2>Legacy of Jeffery Roth</h2>
                        <p>
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                            Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <img class="w-100" src="{{ asset('assets/front/images/messages.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5 comment-main rounded">
                    <ul class="p-0">
                        <li>
                            <div class="row comment-box p-1 pt-3 pr-4">
                                <div class="col-lg-2 col-2 user-img text-center">
                                    <img src="{{ asset('assets/front/images/profile.png') }}" class="main-cmt-img" alt="">
                                </div>
                                <div class="col-lg-10 col-10 user-comment bg-light rounded pb-1">
                                    <div class="row">
                                        <div class="col-lg-8 col-6 border-bottom pr-0">
                                            <p class="w-100 p-2 m-0">Lorem ipsum dolor sit amet.</p>
                                        </div>
                                        <div class="col-lg-4 col-6 border-bottom">
                                            <p class="w-100 p-2 m-0">
                                                <span class="float-right">
                                                    <i class="fa fa-clock-o mr-1" aria-hidden="true"></i>01 : 00
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="user-comment-desc p-1 pl-2">
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-up mr-1" aria-hidden="true"></i>
                                            </span> 490
                                        </p>
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-down mr-1" aria-hidden="true"></i>
                                            </span> 450
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row comment-box p-1 pt-3 pr-4">
                                <div class="col-lg-2 col-2 user-img text-center">
                                    <img src="{{ asset('assets/front/images/profile.png') }}" class="main-cmt-img" alt="">
                                </div>
                                <div class="col-lg-10 col-10 user-comment bg-light rounded pb-1">
                                    <div class="row">
                                        <div class="col-lg-8 col-6 border-bottom pr-0">
                                            <p class="w-100 p-2 m-0">Lorem ipsum dolor sit amet.</p>
                                        </div>
                                        <div class="col-lg-4 col-6 border-bottom">
                                            <p class="w-100 p-2 m-0">
                                                <span class="float-right">
                                                    <i class="fa fa-clock-o mr-1" aria-hidden="true"></i>01 : 00
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="user-comment-desc p-1 pl-2">
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-up mr-1" aria-hidden="true"></i>
                                            </span> 490
                                        </p>
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-down mr-1" aria-hidden="true"></i>
                                            </span> 450
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row comment-box p-1 pt-3 pr-4">
                                <div class="col-lg-2 col-2 user-img text-center">
                                    <img src="{{ asset('assets/front/images/profile.png') }}" class="main-cmt-img" alt="">
                                </div>
                                <div class="col-lg-10 col-10 user-comment bg-light rounded pb-1">
                                    <div class="row">
                                        <div class="col-lg-8 col-6 border-bottom pr-0">
                                            <p class="w-100 p-2 m-0">Lorem ipsum dolor sit amet.</p>
                                        </div>
                                        <div class="col-lg-4 col-6 border-bottom">
                                            <p class="w-100 p-2 m-0">
                                                <span class="float-right">
                                                    <i class="fa fa-clock-o mr-1" aria-hidden="true"></i>01 : 00
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="user-comment-desc p-1 pl-2">
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-up mr-1" aria-hidden="true"></i>
                                            </span> 490
                                        </p>
                                        <p class="m-0 mr-2">
                                            <span>
                                                <i class="fa fa-thumbs-down mr-1" aria-hidden="true"></i>
                                            </span> 450
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <hr>
                        </li>

                        <li class="row">
                            <div class="col-lg-11 col-11">
                                <label for="write-comment" class="d-none"></label>
                                <input id="write-comment" type="text" class="form-control" placeholder="write comments ...">
                            </div>
                            <div class="col-lg-1 col-1 send-icon">
                                <a href="javascript:void(0)">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer">
                <div class="row">
                    <div class="col-lg-10">
                        <img class="w-25" src="{{ asset('assets/front/images/logo.png') }}" alt="">
                        <div class="footer-text">
                            <h4>
                                CONTACT US
                            </h4>
                            <p>342 East 53rd Street, Suite #4EF New York, NY 10022</p>
                            <p>
                                <i class="fa fa-phone"></i> 800 970-5877
                            </p>
                            <p>
                                <i class="fa fa-envelope-o"></i> info@beyondant.com
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 m-auto">
                        <img class="w-100" src="{{ asset('assets/front/images/follow-us-footer.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright © 2020 Beyondant | All Rights Reserved - Powered by Beyondant</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
