@include('frontend.header');
<div class="container content profile">


    <div class="col-sm-3">
        <div class="user-panel">
            <div class="margin-bottom-20">
                <h3>Customer panel</h3>
            </div>
            <div class="margin-bottom-20">
                <h4>Orders</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ url('myaccount/order-history') }}">History </a></li>
                </ul>
            </div>
<!--            <div class="margin-bottom-20">
                <h4>Inquiries</h4>
                <ul class="list-unstyled">
                    <li><a href="offer-history.html">History</a></li>
                </ul>
            </div>-->

            <div class="margin-bottom-20">
                <h4>Manage your account</h4>
                <ul class="list-unstyled mng-acc">


                    <li><a href="{{ url('myaccount/my-details') }}">My Details</a></li>
                        <li><a href="{{ url('myaccount/shipping-address') }}">Shipping Address</a></li>
                        
                        <li><a href="{{ url('myaccount/payment-methods') }}">Payment and delivery methods</a></li>
                        <li><a href="{{ url('myaccount/change-password') }}">Change password</a></li>
                </ul>
            </div>

          



        </div>





    </div>
    <!-- tab content -->
    <div class="col-sm-9">
        <div class="panel-content">
            <h2 class="heading-md">Payment and delivery methods</h2>
            <ul class="list-inline">
                <li>Home ></li>  <li>Payment and delivery methods</li>

            </ul>

            <div class="row">
                <div class="payment-method">
                    <div class="col-md-6">
                        <div class="table-responsive">

                            <table class="table">
                                <h4>Hardware</h4>
                                <thead>
                                    <tr>
                                        <th>Payment method</th>
                                        <th>Delivery method</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bank transfer</td>
                                        <td> 
                                            Courier service                        </td>



                                    </tr>
                                    <tr>
                                        <td colspan="2">Cash on Delivery:</td>


                                    </tr>
                                    <tr>
                                        <td colspan="2">Credit Card (supported by Six Payments) <br> <img src="{{ URL::asset('public/assets/images/visa.png')}}" alt="Visa"> <img src="{{ URL::asset('public/assets/images/mastercard.png')}}" alt="Visa"> </td>

                                    </tr>



                                    <tr>
                                        <td>Paypal: <br><img src="{{ URL::asset('public/assets/images/paypal.jpg')}}" alt="Visa"></td>


                                    </tr>



                                </tbody>
                            </table>


                            <table class="table">
                                <h4>Software</h4>
                                <thead>
                                    <tr>
                                        <th>Payment method</th>
                                        <th>Delivery method</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bank transfer</td>
                                        <td> 
                                            Electronic licence                        </td>



                                    </tr>

                                    <tr>
                                        <td colspan="2">Credit Card (supported by Six Payments) <br> <img src="{{ URL::asset('public/assets/images/visa.png')}}" alt="Visa"> <img src="{{ URL::asset('public/assets/images/mastercard.png')}}" alt="Visa"> </td>

                                    </tr>



                                    <tr>
                                        <td>Paypal: <br><img src="{{ URL::asset('public/assets/images/paypal.jpg')}}" alt="Visa"></td>


                                    </tr>



                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>


</div>
@include('frontend.footer');