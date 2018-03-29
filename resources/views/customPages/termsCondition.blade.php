@include('frontend.header');
<section class="mt-contact-banner style4">
    <div class="container">
        <div class="row">
            <?php  //var_dump($terms[0]->title); ?>
            <div class="col-xs-12 text-center">
                <h1>{{ $terms[0]->title }}</h1>

                <nav class="breadcrumbs">
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}">Home <i class="fa fa-angle-right"></i></a></li>

                        <li>Term and Conditions</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>


<div class="content container">
    <div class="row">

        <div class="col-md-12 text-justify">

            {!! $terms[0]->description  !!}

        </div>



    </div>
</div>
@include('frontend.footer');