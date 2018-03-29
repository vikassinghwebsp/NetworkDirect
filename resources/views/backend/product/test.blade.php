<?php
/* Template Name: members  */

get_header();
?>
<style>
    @import url('https://fonts.googleapis.com/css?family=Alegreya+Sans');
    @import url('https://fonts.googleapis.com/css?family=Dancing+Script');


    *{
        margin:0;
        padding:0;
    }

    .container1{


        margin-bottom: 30px;

    }

    .col{

        padding-top:20px;
        background-color:#fff;
        box-sizing: border-box;

    }

    .contact{
        background-color: #e2e8ea;
        width: 82%;
        margin-left: 129px;
        margin-top:10px;

    }
    .contact h3{

        margin-top:10px;
        margin-bottom:10px;
    }
    .contact ul{
        list-style-type: none;
        padding-bottom: 20px;
        letter-spacing: 1px;
        line-height: 30px;

    }

    .contact li {
        font-size:15px;

    }

    .contact li i{
        font-size:24px;
        color:#23527c;
    }
    .box{
        background-color: #fff;
    }

    .box ul{
        list-style-type: none;
        margin-top:-10px;
    }



    .box li i{
        font-size:20px;
        color:#23527c;
    }

    .box h3{
        margin-top:10px;
    }


    .conimg{width:100%;}

    .conimg img{width:327px; height:186px; margin-top:20px; }



    .tab-conatiner

    {
        padding: 20px 0px;
    }

    .tab-conatiner .nav-tabs > li > a {

        color: #fff;
    }

    .tab-conatiner .panel-body

    {
        background-color: #eee;
    }


    .tab-conatiner .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #fff;

        background-color: #f84e46;

    }

    @media screen and (max-width: 699px) and (min-width: 340px){

        .contact {
            background-color: #e2e8ea;
            width: 100%!important;
            margin-left: 0px!important;
            margin-top: 10px;
        }  

    }


    @media only screen and (max-width: 320px) {
        .contact h3{
            margin-left:5%;
            margin-top:10px;

        }
        .contact ul{

            margin-left:5%;
        }
        .contact h3{
            padding-right:5px;
        }
        .box .img-1{
            padding-bottom: 5px;
        }
        .box .img-2{
            padding-bottom: 5px;
        } 
    }

    @media only screen and (max-width: 768px){

        .box .img-1{
            width:200px;
        }
        .box .img-2{
            width:180px;

        }

    }
</style>
<div class="container">

    <div class="tab-conatiner">

        <div class="panel panel-primary">

            <div class="panel-heading" style="padding-left: 170px !important;">
                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#menu1">PHARMACY</a></li>
                    <li><a data-toggle="tab" href="#menu2">VETERINARIAN</a></li>
                    <li><a data-toggle="tab" href="#menu3">MEDICAL SUPPLIES</a></li>
                    <li><a data-toggle="tab" href="#menu4">GROCERY</a></li>
                    <li><a data-toggle="tab" href="#menu5">HEALTH FOOD</a></li>
                    <li><a data-toggle="tab" href="#menu6">PET SUPPLIES</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">


                    <div id="menu1" class="tab-pane fade in active">
                        <h3>PHARMACY</h3>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => $paged, 'orderby' => 'post_title', 'order' =>
                            'ASC', 'meta_query' => array(
                                array(
                                    'key' => 'select_form',
                                    'value' => 'PHARMACY',
                                )
                            ),);

                        $loop = new WP_Query($args);
                        //var_dump(count($loop->the_post()));exit;
                        //
            while ($loop->have_posts()) : $loop->the_post();
                            $form = get_post_meta(get_the_ID(), 'select_form', true);
                            $name = get_post_meta(get_the_ID(), 'name', true);
                            $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
                            $address = get_post_meta(get_the_ID(), 'address', true);
                            $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
                            $city = get_post_meta(get_the_ID(), 'city', true);
                            $country = get_post_meta(get_the_ID(), 'country', true);
                            $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
                            $email = get_post_meta(get_the_ID(), 'email_id', true);
                            $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
                            $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
                            $saturday = get_post_meta(get_the_ID(), 'saturday', true);
                            $sunday = get_post_meta(get_the_ID(), 'sunday', true);
                            $url = get_post_meta(get_the_ID(), 'url', true);

                            $data = array(
                                'select_form' => $form,
                                'name' => $name,
                                'contact_person' => $contact_person,
                                'address' => $address,
                                'postal_code' => $postal_code,
                                'city' => $city,
                                'country' => $country,
                                'phone_number' => $phone_number,
                                'please_check_all_that_applies' => $applies,
                                'hours_of_operation' => $hours,
                                'saturday' => $saturday,
                                'sunday' => $sunday,
                                'email_id' => $email,
                                'url' => $url
                            );
                            ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

    <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile;
?>
                        <div id="pagination">
                        <?php
                        next_posts_link('Next >>', $loop->max_num_pages);
                        previous_posts_link('Previous <<');
                        wp_reset_query();
                        ?>
                        </div>
                    </div><!--end of row-->





                    <div id="menu2" class="tab-pane fade">
                        <h3>VETERINARIAN</h3>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => $paged, 'orderby' => 'post_title', 'order' =>
    'ASC', 'meta_query' => array(
        array(
            'key' => 'select_form',
            'value' => 'VETERINARIAN'
        )
    ),);

$loop1 = new WP_Query($args);
//var_dump($loop);exit;
//
            while ($loop1->have_posts()) : $loop1->the_post();
    $form = get_post_meta(get_the_ID(), 'select_form', true);
    $name = get_post_meta(get_the_ID(), 'name', true);
    $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
    $address = get_post_meta(get_the_ID(), 'address', true);
    $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
    $city = get_post_meta(get_the_ID(), 'city', true);
    $country = get_post_meta(get_the_ID(), 'country', true);
    $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
    $email = get_post_meta(get_the_ID(), 'email_id', true);
    $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
    $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
    $saturday = get_post_meta(get_the_ID(), 'saturday', true);
    $sunday = get_post_meta(get_the_ID(), 'sunday', true);
    $url = get_post_meta(get_the_ID(), 'url', true);

    $data = array(
        'select_form' => $form,
        'name' => $name,
        'contact_person' => $contact_person,
        'address' => $address,
        'postal_code' => $postal_code,
        'city' => $city,
        'country' => $country,
        'phone_number' => $phone_number,
        'please_check_all_that_applies' => $applies,
        'hours_of_operation' => $hours,
        'saturday' => $saturday,
        'sunday' => $sunday,
        'email_id' => $email,
        'url' => $url
    );
    ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

                            <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile; ?>
<?php
echo do_shortcode('[ajax_load_more container_type="div" post_type="post"]');
?>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>MEDICAL SUPPLIES</h3>
                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => $paged, 'orderby' => 'post_title', 'order' =>
                            'ASC', 'meta_query' => array(
                                array(
                                    'key' => 'select_form',
                                    'value' => 'MEDICAL SUPPLIES'
                                )
                            ),);

                        $loop = new WP_Query($args);
                        //var_dump($loop);exit;
                        //
            while ($loop->have_posts()) : $loop->the_post();
                            $form = get_post_meta(get_the_ID(), 'select_form', true);
                            $name = get_post_meta(get_the_ID(), 'name', true);
                            $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
                            $address = get_post_meta(get_the_ID(), 'address', true);
                            $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
                            $city = get_post_meta(get_the_ID(), 'city', true);
                            $country = get_post_meta(get_the_ID(), 'country', true);
                            $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
                            $email = get_post_meta(get_the_ID(), 'email_id', true);
                            $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
                            $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
                            $saturday = get_post_meta(get_the_ID(), 'saturday', true);
                            $sunday = get_post_meta(get_the_ID(), 'sunday', true);
                            $url = get_post_meta(get_the_ID(), 'url', true);

                            $data = array(
                                'select_form' => $form,
                                'name' => $name,
                                'contact_person' => $contact_person,
                                'address' => $address,
                                'postal_code' => $postal_code,
                                'city' => $city,
                                'country' => $country,
                                'phone_number' => $phone_number,
                                'please_check_all_that_applies' => $applies,
                                'hours_of_operation' => $hours,
                                'saturday' => $saturday,
                                'sunday' => $sunday,
                                'email_id' => $email,
                                'url' => $url
                            );
                            ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

                            <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile; ?>
<?php
next_posts_link('Next>>', $loop->max_num_pages);
previous_posts_link('Previous');
?>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h3>GROCERY</h3>
                        <?php
                        $args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => get_query_var('paged'), 'orderby' => 'post_title', 'order' =>
                            'ASC', 'meta_query' => array(
                                array(
                                    'key' => 'select_form',
                                    'value' => 'GROCERY'
                                )
                            ),);

                        $loop = new WP_Query($args);
                        //var_dump($loop);exit;
                        //
            while ($loop->have_posts()) : $loop->the_post();
                            $form = get_post_meta(get_the_ID(), 'select_form', true);
                            $name = get_post_meta(get_the_ID(), 'name', true);
                            $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
                            $address = get_post_meta(get_the_ID(), 'address', true);
                            $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
                            $city = get_post_meta(get_the_ID(), 'city', true);
                            $country = get_post_meta(get_the_ID(), 'country', true);
                            $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
                            $email = get_post_meta(get_the_ID(), 'email_id', true);
                            $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
                            $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
                            $saturday = get_post_meta(get_the_ID(), 'saturday', true);
                            $sunday = get_post_meta(get_the_ID(), 'sunday', true);
                            $url = get_post_meta(get_the_ID(), 'url', true);

                            $data = array(
                                'select_form' => $form,
                                'name' => $name,
                                'contact_person' => $contact_person,
                                'address' => $address,
                                'postal_code' => $postal_code,
                                'city' => $city,
                                'country' => $country,
                                'phone_number' => $phone_number,
                                'please_check_all_that_applies' => $applies,
                                'hours_of_operation' => $hours,
                                'saturday' => $saturday,
                                'sunday' => $sunday,
                                'email_id' => $email,
                                'url' => $url
                            );
                            ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

                            <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile; ?>
<?php
next_posts_link('Next>>', $loop->max_num_pages);
previous_posts_link('Previous');
?>
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <h3>HEALTH FOOD</h3>
                        <?php
                        $args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => get_query_var('paged'), 'orderby' => 'post_title', 'order' =>
                            'ASC', 'meta_query' => array(
                                array(
                                    'key' => 'select_form',
                                    'value' => 'HEALTH FOOD'
                                )
                            ),);

                        $loop = new WP_Query($args);
                        //var_dump($loop);exit;
                        //
            while ($loop->have_posts()) : $loop->the_post();
                            $form = get_post_meta(get_the_ID(), 'select_form', true);
                            $name = get_post_meta(get_the_ID(), 'name', true);
                            $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
                            $address = get_post_meta(get_the_ID(), 'address', true);
                            $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
                            $city = get_post_meta(get_the_ID(), 'city', true);
                            $country = get_post_meta(get_the_ID(), 'country', true);
                            $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
                            $email = get_post_meta(get_the_ID(), 'email_id', true);
                            $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
                            $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
                            $saturday = get_post_meta(get_the_ID(), 'saturday', true);
                            $sunday = get_post_meta(get_the_ID(), 'sunday', true);
                            $url = get_post_meta(get_the_ID(), 'url', true);

                            $data = array(
                                'select_form' => $form,
                                'name' => $name,
                                'contact_person' => $contact_person,
                                'address' => $address,
                                'postal_code' => $postal_code,
                                'city' => $city,
                                'country' => $country,
                                'phone_number' => $phone_number,
                                'please_check_all_that_applies' => $applies,
                                'hours_of_operation' => $hours,
                                'saturday' => $saturday,
                                'sunday' => $sunday,
                                'email_id' => $email,
                                'url' => $url
                            );
                            ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

                            <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile; ?>
<?php
next_posts_link('Next>>', $loop->max_num_pages);
previous_posts_link('Previous');
?>
                    </div>
                    <div id="menu6" class="tab-pane fade">
                        <h3>PET SUPPLIES</h3>
                        <?php
                        $args = array('post_type' => 'custom_froms', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => get_query_var('paged'), 'orderby' => 'post_title', 'order' =>
                            'ASC', 'meta_query' => array(
                                array(
                                    'key' => 'select_form',
                                    'value' => 'PET SUPPLIES'
                                )
                            ),);

                        $loop = new WP_Query($args);
                        //var_dump($loop);exit;
                        //
            while ($loop->have_posts()) : $loop->the_post();
                            $form = get_post_meta(get_the_ID(), 'select_form', true);
                            $name = get_post_meta(get_the_ID(), 'name', true);
                            $contact_person = get_post_meta(get_the_ID(), 'contact_person', true);
                            $address = get_post_meta(get_the_ID(), 'address', true);
                            $postal_code = get_post_meta(get_the_ID(), 'postal_code', true);
                            $city = get_post_meta(get_the_ID(), 'city', true);
                            $country = get_post_meta(get_the_ID(), 'country', true);
                            $phone_number = get_post_meta(get_the_ID(), 'phone_number', true);
                            $email = get_post_meta(get_the_ID(), 'email_id', true);
                            $applies = get_post_meta(get_the_ID(), 'please_check_all_that_applies', true);
                            $hours = get_post_meta(get_the_ID(), 'hours_of_operation', true);
                            $saturday = get_post_meta(get_the_ID(), 'saturday', true);
                            $sunday = get_post_meta(get_the_ID(), 'sunday', true);
                            $url = get_post_meta(get_the_ID(), 'url', true);

                            $data = array(
                                'select_form' => $form,
                                'name' => $name,
                                'contact_person' => $contact_person,
                                'address' => $address,
                                'postal_code' => $postal_code,
                                'city' => $city,
                                'country' => $country,
                                'phone_number' => $phone_number,
                                'please_check_all_that_applies' => $applies,
                                'hours_of_operation' => $hours,
                                'saturday' => $saturday,
                                'sunday' => $sunday,
                                'email_id' => $email,
                                'url' => $url
                            );
                            ?>
                            <div class="row1">
                                <div class="col-sm-4 box"><?php if (has_post_thumbnail()) : ?>
                                        <!-- <img src="<?php the_post_thumbnail(); ?>" title="<?php the_title_attribute(); ?>" width="250px" height="100px" style="margin-left:20px; margin-top:25px;" class="img-1"> -->

                            <?php endif; ?></div>
                                <div class="col-sm-12 contact" >

                                    <div class="col-sm-4"> 
                                        <div class="conimg"><?php the_post_thumbnail(); ?></div>
                                    </div>

                                    <div class="col-sm-8">	    
                                        <h3 style="font-size:35px; font-family:inherit;"><a href="#"><?php echo $data['name']; ?></a></h3>
                                        <ul>
                                            <li><i class="fa fa-stethoscope" aria-hidden="true"></i> <a href="#"><?php echo $data['select_form']; ?></a></li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['address']; ?></a>, <a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['city']; ?></a> (<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $data['country']; ?></a>)</li>
                                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#"><?php echo $data['phone_number']; ?></a></li>
                                            <li><i class="fa fa-print" aria-hidden="true"></i> <a href="#"></i><?php echo $data['please_check_all_that_applies']; ?></a></li>
                                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="#"><?php echo $data['email_id']; ?></a></li>
                                            <li><i class="fa fa-link" aria-hidden="true"></i> <a href="<?php echo $data['url']; ?>"><?php echo $data['url']; ?></a></li>

                                        </ul></div>



                                </div>


                            </div>

<?php endwhile; ?>
<?php
next_posts_link('Next>>', $loop->max_num_pages);
previous_posts_link('Previous');
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<?php get_footer(); ?>