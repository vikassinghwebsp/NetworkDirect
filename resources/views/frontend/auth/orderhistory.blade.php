@include('frontend.header');

<div class="container content profile">
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
            <strong>{{ Session::get('success') }}</strong> 
        </div>
        @endif

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
<!--                    <li><a href="#">Enduser data</a></li>-->
                    <li><a href="{{ url('myaccount/payment-methods') }}">Payment and delivery methods</a></li>
                    <li><a href="{{ url('myaccount/change-password') }}">Change password</a></li>
                </ul>
            </div>

<!--            <div class="margin-bottom-30">
                <h4>RMA Form</h4>
                <ul class="list-unstyled">


                    <li><a href="rma.html"> Send request</a></li>

                </ul>
            </div>-->

        </div>

    </div>
    <!-- tab content -->
    <div class="col-sm-9">
        <div class="panel-content">
            <h2 class="heading-md">Orders – History</h2>
            <ul class="list-inline">
                <li>Home ></li>  <li>Orders  - History</li>

            </ul>

            <div class="table-responsive">
                <table class="table table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Your Name</th>
                            <th>Product Name</th>
                            <th class="hidden-sm">Contact Number</th>
                            <th>Address</th>
                            <th>City</th>

                            <th>Postal Code</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(!empty($orders))
                       @foreach($orders as $item)
                        <tr>
                            <td>{{ (!empty($item->order_id))?$item->order_id:'' }}</td>
                            <td>{{ (!empty($item->full_name))?$item->full_name:'' }}</td>
                            <td>
                                <a href="#">{{ (!empty($item->product_name))?$item->product_name:'' }}</a>
                            </td>
                            <td>{{ (!empty($item->mobile_no))?$item->mobile_no:'' }}</td>
                            <td>{{ (!empty($item->address1))?$item->address1:'' }} {{ (!empty($item->address2))?$item->address2:'' }}</td>
                            <td>
                                {{ (!empty($item->city))?$item->city:'' }}
                            </td>
                            <td>{{ (!empty($item->postal_code))?$item->postal_code:'' }}</td>

                        </tr>
                        @endforeach
                                @else
                    
                    <tr><td colspan="6" style="text-align: center"><h2>No Record Found</h2></td></tr>
                    
                    @endif
                       

                    </tbody>
                </table>
            </div>


        </div>


    </div>


</div>
@include('frontend.footer');