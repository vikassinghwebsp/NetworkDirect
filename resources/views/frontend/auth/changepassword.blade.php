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
            <h2 class="heading-md">Change password</h2>
            <ul class="list-inline">
                <li>Home ></li>  <li>Change your password</li>
            </ul>

            <div class="row">
                <div class="col-md-8">

                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="email"><small>Current Password:</small></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pwd1" placeholder="*****" name="c_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd"><small>Password:</small></label>
                            <div class="col-sm-8">          
                                <input type="password" class="form-control" id="password" placeholder="*****" name="n_password" onkeyup='check();'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="pwd"><small>Retype Password:</small></label>
                            <div class="col-sm-8">          
                                <input type="password" class="form-control" id="confirm_password" placeholder="*****" name="r_password" onkeyup='check();' >
                            </div>

                        </div>

                        <div class="form-group">    
                            <div class="col-sm-offset-2 col-sm-4">
                                <span id='message'></span>
                            </div>
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-info pull-right">Change Password</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>



    </div>


</div>
@include('frontend.footer');
<script>
    var check = function () {
        if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'Matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not Matching';
        }
    }
</script>