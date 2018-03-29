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
            <h2 class="heading-md">Orders – History</h2>
            <ul class="list-inline">
                <li>Home ></li>  <li>Customer Address</li>

            </ul>



            <div class="table-responsive">
                <table class="table table-hover  table-striped">
                    <thead>
                        <tr>
                            
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Street</th>
                            <th>Area</th>
                            <th>Person</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           
                            <td>{{ $arrContent['userData'][0]->city }}</td>
                            <td>
                                {{ $arrContent['userData'][0]->postal_code }}
                            </td>
                            <td>
                               {{ $arrContent['userData'][0]->address1 }}
                            </td>
                            <td>
                                {{ $arrContent['userData'][0]->address2 }}
                            </td>
                            <td>{{ $arrContent['userData'][0]->full_name }}</td>

                        </tr>

                        
                    </tbody>
                </table>
            </div>


        </div>

    </div>

</div>
@include('frontend.footer');