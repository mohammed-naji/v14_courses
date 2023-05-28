@extends('site.master')

@section('title', 'Our courses')


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
            <div class="row justify-content-center g-4">

                <div class="col-lg-6 col-md-12 wow fadeInUp text-center" data-wow-delay="0.5s">

                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <h1>{{ $course->title }}</h1>

                    <h4 class="text-primary">${{ $course->price }}</h4>

                    <div id="paypal-button-container"></div>
                    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>



                    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $id }}"></script>
                    <form action="{{ route('site.payment', $course->slug) }}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>




                </div>


            </div>
        </div>
    </div>
    <!-- Contact End -->


@stop


@section('scripts')

{{-- <script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        // Call your server to set up the transaction
        createOrder: function(data, actions) {
            return fetch('/demo/checkout/api/paypal/order/create/', {
                method: 'post'
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },

        // Call your server to finalize the transaction
        onApprove: function(data, actions) {
            return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                method: 'post'
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                // Three cases to handle:
                //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                //   (2) Other non-recoverable errors -> Show a failure message
                //   (3) Successful transaction -> Show confirmation or thank you

                // This example reads a v2/checkout/orders capture response, propagated from the server
                // You could use a different API or structure for your 'orderData'
                var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                    return actions.restart(); // Recoverable state, per:
                    // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                }

                if (errorDetail) {
                    var msg = 'Sorry, your transaction could not be processed.';
                    if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                    if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                    return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                }

                // Successful capture! For demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                // Replace the above to show a success message within this page, e.g.
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        }

    }).render('#paypal-button-container');
</script> --}}

@stop
