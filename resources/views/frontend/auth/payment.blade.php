@include('frontend.header');
<div class="content container">

    <div class="col-xl-12 col-lg-12">
        <div class="checkout-steps">
            <a class="active" href="checkout-payment.html"><span class="angle"></span>2. Payment</a>
            <a  href="{{ url('shipping') }}">1. Address</a></div>
        @if(Session::has('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Error!</strong> {{ Session::get('error') }}
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Well Done !! </strong> {{ Session::get('success') }}
        </div>
        @endif
        <div class="bs-example">

            <!-- panel-group -->

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading1">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                Pay with Credit Card
                            </a>
                        </h4>

                    </div>
                    <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                        <div class="panel-body">
                            <p>We accept following credit cards:&nbsp;<img class="d-inline-block align-middle" src="{{ URL::asset('public/assets/images/credit-cards.png')}}" style="width: 120px;" alt="Cerdit Cards"></p>

                            <div class="card-box">
                                <img src="assets/images/card.png" class="img-responsive" alt="">
                            </div>

                            <form class="credit-card row" method="POST" action="{!! route('addmoney.stripe')!!}">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="card_no" placeholder="Card Number" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" type="text" name="ccExpiryMonth" placeholder="MM" required>
                                </div>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" type="text" name="ccExpiryYear" placeholder="YY" required>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='hidden' name='amount' value="{{ $arrContent['amount'] }}">
                                </div>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" type="text" name="cvvNumber" placeholder="CVC" required>
                                    <input class="form-control" type="hidden" name="currency" placeholder="CVC" value="<?php
                                            if (Session::get('money')) {
                                                $userData = Session::get('money');
                                                $curr = $userData[0]['currency'];
                                                $currency = strtolower($curr);
                                                echo $curr;
                                            } else {
                                                echo 'USD';
                                            }
                                            ?>">
                                    <input class="form-control" type="hidden" name="vat" placeholder="CVC" value="{{ $arrContent['vat'] }}">
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-info btn-outline-primary btn-block margin-top-none" type="submit">Pay</button>
                                </div>
                                <div class="col-sm-6">

                                    <div class="column text-lg">Tax: <span class="text-medium btn btn-success price"><?php
                                            if (Session::get('money')) {
                                                $userData = Session::get('money');
                                                $curr = $userData[0]['currency'];
                                                $currency = strtolower($curr);
                                                echo "<i class='fa fa-$currency'></i>";
                                            } else {
                                                echo '<i class="fa fa-usd"></i>';
                                            }
                                            ?> {{ $arrContent['vat'] }} </span>&nbsp;&nbsp;Total Price including VAT: <span class="text-medium btn btn-success price"><?php
                                            if (Session::get('money')) {
                                                $userData = Session::get('money');
                                                $curr = $userData[0]['currency'];
                                                $currency = strtolower($curr);
                                                echo "<i class='fa fa-$currency'></i>";
                                            } else {
                                                echo '<i class="fa fa-usd"></i>';
                                            }
                                            ?> {{ $arrContent['amount'] }}</span></div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>

        </div>





        <!--        <div class="checkout-footer margin-top-1x">
                    <div class="column"><a class="btn btn-outline-secondary" href="{{ url('shipping') }}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Back</span></a></div>
                    <div class="column"><a class="btn btn-primary" href="checkout-review.html"><span class="hidden-xs-down">Make Payment &nbsp;</span><i class="icon-arrow-right"></i></a></div>
                </div>-->
    </div>

</div>
@include('frontend.footer');