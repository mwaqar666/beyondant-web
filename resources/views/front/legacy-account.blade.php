<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/legacy-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/timeline.css') }}">
    <title>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</title>
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

                    @guest()
                        <li class="nav-item">
                            <a class="btn text-white nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-light text-dark nav-link ml-4" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-light nav-link ml-4" href="javascript:void(0)" onclick="this.nextElementSibling.submit()">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    @endguest

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
                    <img class="legacy-account-profile-picture" src="{{ asset($user->profile_picture) }}" alt="">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="main-banner-text">
                    <h5>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h5>
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
                    <p>{{ $user->legacy->cemetery_location }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-5">
                    <div class="life-time">
                        <h1>LIFE <span>&amp;</span> TIME</h1>
                        <h2>{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h2>
                        <h5>
                            {{ $user->legacy->from }}
                            <span>
                                    <img src="{{ asset('assets/front/images/text-img.png') }}" alt="">
                                </span>
                            {{ $user->legacy->to }}
                        </h5>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="timeline">

                    @foreach ($user->legacy->legacyTimeline as $legacyTimeline)
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <div>{{ $legacyTimeline->year }}</div>
                            </div>
                            <div class="timeline-content">
                                <h2>{{ $legacyTimeline->heading }}</h2>
                                <p>{{ $legacyTimeline->description }}</p>
                                <br>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content-center">

        <div class="col-lg-5 ">
            <div class="roth">
                <h2>Legacy of {{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</h2>
                <p>{!! $user->legacy->description !!}</p>
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

                    @foreach ($user->legacy->publicComments as $publicComment)
                        <li>
                            <div class="row comment-box p-1 pt-3 pr-4">
                                <div class="col-lg-1 col-1 user-img text-center">
                                    <img src="{{ asset('assets/front/images/profile.png') }}" class="main-cmt-img" alt="">
                                </div>
                                <div class="col-lg-11 col-11 user-comment bg-light rounded pb-1">
                                    <div class="row">
                                        <div class="col-lg-8 col-6 pr-0">
                                            <p class="w-100 p-2 m-0">{{ $publicComment->comment }}</p>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <p class="w-100 p-2 m-0">
                                                <span class="float-right">
                                                    <i class="fa fa-clock-o mr-1" aria-hidden="true"></i>{{ $publicComment->created_at->toTimeString() }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                    <li>
                        <hr>
                    </li>

                    <li class="row">
                        <div class="col-lg-11 col-11">
                            <label for="write-comment" class="d-none"></label>
                            <input id="write-comment" type="text" class="form-control" placeholder="Write your comment...">
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
