@include('frontend.header');
<div class="container content profile">
    <div class="row">
        
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
                <!--                <div class="margin-bottom-20">
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
                        <!--                        <li><a href="#">Enduser data</a></li>-->
                        <li><a href="{{ url('myaccount/payment-methods') }}">Payment and delivery methods</a></li>
                        <li><a href="{{ url('myaccount/change-password') }}">Change password</a></li>
                    </ul>
                </div>

                <!--                <div class="margin-bottom-30">
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
                <h2 class="heading-md">{{ (!empty($arrContent['userDetails'][0]->full_name)? $arrContent['userDetails'][0]->full_name:'') }} Profile </h2>
                <ul class="list-inline">
                    <li>Home ></li>  <li>{{ (!empty($arrContent['userDetails'][0]->full_name)? $arrContent['userDetails'][0]->full_name:'') }} Account</li>
                   

                </ul>

                <div class="row">
                    <div class="col-md-8">
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
                        <div class="user-data-tbl">

                            <div class="form-group">
                                <form action="{{ url('updateProfile') }}" method="post">
                                    @if(!empty($arrContent['userDetails']))
                                    
                                    <label for="name">Full Name:</label>
                                    <input class="form-control" type="text" name="full_name" value="{{ (!empty($arrContent['userDetails'][0]->full_name)? $arrContent['userDetails'][0]->full_name:'') }}">
                                    <label for="email">Email address:</label>
                                    <input class="form-control" type="email" name="email" value="{{ (!empty($arrContent['userDetails'][0]->email)? $arrContent['userDetails'][0]->email:'') }}">


                                    <label for="email">Mobile Number:</label>
                                    <input class="form-control" type="number" name="mobile_no" value="{{ (!empty($arrContent['userDetails'][0]->mobile_no)? $arrContent['userDetails'][0]->mobile_no:'') }}">
                                    <label for="email">Street:</label>

                                    <input class="form-control" type="text" name="address1" value="{{ (!empty($arrContent['userDetails'][0]->address1)? $arrContent['userDetails'][0]->address1:'') }}">


                                    <label for="email">Area:</label>
                                    <input class="form-control" type="text" name="address2" value="{{ (!empty($arrContent['userDetails'][0]->address2)? $arrContent['userDetails'][0]->address2:'') }}">

                                    <label for="email">City:</label>
                                    <input class="form-control" type="text" name="city" value="{{ (!empty($arrContent['userDetails'][0]->city)? $arrContent['userDetails'][0]->city:'') }}">


                                    @else
                                    <h3> <span class="label label-default">NO REcord Found</span></h3>
                                    @endif
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>


            </div>


        </div>
    </div>
</div>
@include('frontend.footer');