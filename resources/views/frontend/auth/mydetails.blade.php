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
                <h2 class="heading-md">{{ (!empty($arrContent['userData'][0]->full_name)? $arrContent['userData'][0]->full_name:'') }} Profile </h2>
                <ul class="list-inline">
                    <li>Home ></li>  <li>{{ (!empty($arrContent['userData'][0]->full_name)? $arrContent['userData'][0]->full_name:'') }} Account</li>
                    <a href="{{ url('/editProfile/'.$arrContent['userData'][0]->email) }}" class="btn btn-info btn-md">
          <span class="glyphicon glyphicon-pencil"></span> Edit Profile 
        </a>

                </ul>

                <div class="row">
                    <div class="col-md-8">
                        <div class="user-data-tbl">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Name :</th>
<?php //var_dump($arrContent['userData'][0][0]->id);exit;  ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($arrContent['userData']))
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->full_name)? $arrContent['userData'][0]->full_name:'') }}</td>



                                        </tr>
<!--                                        <tr>
                                            <td>Surname:</td>
                                            <td>Korani</td>

                                        </tr>-->
                                        <tr>
                                            <td colspan="2"><strong> Contact us</strong>  </td>

                                        </tr>



                                        <tr>
                                            <td>Email:</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->email)? $arrContent['userData'][0]->email:'') }}</td>

                                        </tr>

                                        <tr>
                                            <td>Contact number:</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->mobile_no)? $arrContent['userData'][0]->mobile_no:'') }}</td>

                                        </tr>

                                        <tr>
                                            <td colspan="2"><strong> Address: </strong> </td>

                                        </tr>



                                        <tr>
                                            <td>Street:</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->address1)? $arrContent['userData'][0]->address1:'') }}</td>

                                        </tr>

                                        <tr>
                                            <td>Area:</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->address2)? $arrContent['userData'][0]->address2:'') }}</td>

                                        </tr>

                                        <tr>
                                            <td>City:</td>
                                            <td>{{ (!empty($arrContent['userData'][0]->city)? $arrContent['userData'][0]->city:'') }}</td>

                                        </tr>


                                    </tbody>
                                   
                                    @else
                                <tr><td colspan="5" style="text-align: center"><h2>No Record Found</h2></td></tr>
                                @endif
                                </table>

                            </div>

                        </div>
                    </div>


                </div>


            </div>


        </div>
    </div>
</div>
@include('frontend.footer');