@extends('site.master')

@section('title', 'Our courses')

@section('styles')

    <style>
        .rating {
            border: none;
            float: left;
        }

        .rating>label {
            color: #90A0A3;
            float: right;
        }

        .rating>label:before {
            margin: 5px;
            font-size: 1.4em;
            font-family: FontAwesome;
            content: "\f005";
            display: inline-block;
        }

        .rating>input {
            display: none;
        }

        .rating>input:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #06BBCC;
        }

        .rating>input:checked+label:hover,
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        .rating>input:checked~label:hover~label {
            color: #06BBCC;
        }
    </style>

@stop

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">{{ $course->title }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('site.courses') }}">Courses</a>
                            </li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{ $course->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Course Details</h6>
            </div>
            <div class="row g-4">
                <div class="col-lg-5 px-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid" src="{{ asset('uploads/' . $course->image) }}" alt="">


                </div>

                <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">

                    <h1>{{ $course->title }}</h1>

                    <h4 class="text-primary">${{ $course->price }}</h4>

                    <a class="btn btn-primary" href="#">Enroll Now</a>

                    <hr>

                    <h6 class="mt-4">Course Duration:</h6>
                    <p>{{ $course->duration }}</p>

                    <h6 class="mt-4">Course Instructor:</h6>
                    <p>{{ $course->instructor->name }}</p>

                </div>

                <div class="col-md-12 wow fadeInUp">
                    <h5 class="mt-4">Course Description:</h5>
                    {!! $course->content !!}
                </div>

                <div class="mt-5 col-md-12 wow fadeInUp">
                    <hr>
                    <h5 class="mt-4">Course Reviews:</h5>
                    @foreach ($course->reviews as $review)
                        <div>
                            <div class="d-flex algin-items-center">
                                <h6>{{ $review->user->name }}</h6>
                                <small class="mx-3"><i class="fas fa-star text-primary"></i> {{ $review->star }}</small>
                            </div>
                            <p>{{ $review->content }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- @if (Auth::check()) --}}
                <div class="mt-5 col-md-12 wow fadeInUp">
                    <h5>Add New Review</h5>
                    <form action="{{ route('site.review', $course->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                        </div>

                        <textarea placeholder="Review" name="content" class="form-control mb-3" rows="4"></textarea>

                        <button class="btn btn-primary">Post Review</button>
                    </form>
                </div>

                {{-- @endif --}}


            </div>
        </div>
    </div>
    <!-- Contact End -->

@stop


@section('scripts')

    <script src="https://use.fontawesome.com/7ad89d9866.js"></script>

@stop
