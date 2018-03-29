<?php

require (dirname(__FILE__) . '../../../wp-load.php');

class UserModel {

    public function getAllPostActivity($request) {
        global $wpdb;
        $user_id = $request['userId'];
        $date = date('Y-m-d H:i:s');
        // var_dump("SELECT content,date_recorded FROM wp_bp_activity WHERE user_id='$userId'");exit;
        // SELECT name, species, birth FROM pet ORDER BY species, birth DESC
        // $query = $wpdb->get_results("SELECT * FROM wp_bp_activity WHERE user_id=$user_id");
        $query = $wpdb->get_results("SELECT CONCAT(
FLOOR(HOUR(TIMEDIFF('$date', date_recorded)) / 24), ' days ',
MOD(HOUR(TIMEDIFF('$date', date_recorded)), 24), ' hours ',
MINUTE(TIMEDIFF('$date',date_recorded)), ' minutes')  as TimeDiff, wp_bp_activity.* FROM wp_bp_activity WHERE user_id=$user_id ORDER BY date_recorded DESC");

        // var_dump($query1);exit;
        foreach ($query as $value) {

            $cover_art = $wpdb->get_results("SELECT cover_art from wp_rt_rtm_media where media_author='$value->user_id' AND  activity_id='$value->id' AND media_type !='video'");
            // var_dump($cover_art);
            //var_dump($cover_art1->cover_art);



            $dom = new DOMDocument();
            libxml_use_internal_errors(true);

            if (@$dom->loadHTML($value->content)) {

                $links = $dom->getElementsByTagName('a');
                $scripts = $dom->getElementsByTagName('video');
                $audio = $dom->getElementsByTagName('audio');
                $image = $dom->getElementsByTagName('img');

                $links = $value->content;
                foreach ($links as $link) {
                    // Extract and show the "href" attribute.
                    // echo $link->nodeValue;
                    $links = $link->getAttribute('href');
                }
                foreach ($scripts as $script) {

                    $links = $script->getAttribute('src');
                }
                foreach ($audio as $script) {

                    $links = $script->getAttribute('src');
                }
                foreach ($image as $script) {

                    $links = $script->getAttribute('src');
                }
            }
            // $links = $value->content;
            // $cover_art = 'http://pump-or-dump.com/wp-content/uploads/rtMedia/videoImage/video_thumb.png';
            $id = $value->user_id;
            $post_activity = $links;
            $action = $value->action;
            $date_recorded = $value->date_recorded;
            $currentDate = $value->TimeDiff;
            $check_type = substr($post_activity, strlen($post_activity) - 3, strlen($post_activity));
            //var_dump($cover_art['cover_art']);exit;.
                    $cover_art = $cover_art['cover_art'];
            if (empty($cover_art) && $check_type != "mp4" && $check_type != "mp3") {
                $cover_art = '';
                //$cover_art = 'http://pump-or-dump.com/wp-content/uploads/rtMedia/videoImage/video_thumb.png';
            } else if ($check_type == "mp4" && empty($cover_art)) {
                $cover_art[0] = 'http://pump-or-dump.com/wp-content/uploads/rtMedia/videoImage/video_thumb.png';
                //  $cover_art[] = array('cover_art'=>' ');
            } else if ($check_type == "mp3" && empty($cover_art)) {
                $cover_art = $cover_art;
            }
            // $check_tittle= substr($post_activity, 70, strlen($post_activity)-50);
            //var_dump($cover_art);exit;
            // $cover = $cover_art;
            $msg = substr($action, 60, strlen($action));
            //var_dump($check_type);
            $date = date('F, Y', strtotime($date_recorded));
            if ($post_activity != null) {
                $data[] = array(
                    'user_id' => $id,
                    'post_activity' => $post_activity,
                    'action' => $msg . " " . $ab,
                    'date' => $currentDate,
                    'cover' => $cover_art[0]
                );
            }
        }

        if ($query) {
            $data = $data;
            $msg = "recieve";
            $status = '1';
        } else {
            $data = '0';
            $msg = "not recieve";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function imageFriendCount($request) {
        global $wpdb;

        $user_id = $request['userId'];

        // $query = $wpdb->get_results("SELECT wp_bp_xprofile_fields.name,wp_bp_xprofile_data.value,wp_bp_xprofile_data.field_id FROM wp_bp_xprofile_fields, wp_bp_xprofile_data WHERE wp_bp_xprofile_fields.ID = wp_bp_xprofile_data.field_id AND wp_bp_xprofile_data.user_id = $user->ID");
        $result = $wpdb->get_results("SELECT * FROM wp_users AS b INNER JOIN  wp_bp_friends AS r ON b.ID = r.initiator_user_id AND r.friend_user_id='$user_id'");

        // $result = $wpdb->get_results("SELECT is_confirmed FROM wp_bp_friends where initiator_user_id='$user_id'");
        foreach ($result as $obj) {
            $getCoins += $obj->is_confirmed;
        }
        // var_dump($getCoins);

        if ($result) {
            $data = $getCoins;
            $msg = "Login successfully.";
            $status = '1';
        } else {
            $data = '0';
            $msg = "username and password incorrect.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function activity_post($userId, $msg) {
        global $wpdb;
        $query = $wpdb->get_results("SELECT display_name FROM wp_users WHERE id='$userId'");

        foreach ($query as $value) {
            $displayName = $value->display_name;
        }
        $primary_link = "https://pump-or-dump.com/members/" . $displayName;
        $date = date('Y-m-d H:i:s');
        // var_dump($date);exit;
        $type = "activity_update";
        $component = "activity";
        $action = "<a href=" . "'https://pump-or-dump.com/members/'" . $displayName . "/>" . $displayName . "</a> posted an update";
        // var_dump("INSERT INTO `wp_bp_activity`(`user_id`, `component`, `type`, `action`, `content`, `primary_link`, `date_recorded`) VALUES ($userId,'$type','$component','$action','$msg','$primary_link','$date')");exit;
        $result = $wpdb->insert('wp_bp_activity', array(
            'user_id' => $userId,
            'component' => $component,
            'type' => $type,
            'action' => $action,
            'content' => $msg,
            'primary_link' => $primary_link,
            'date_recorded' => $date
        ));
        /*
         * $lastid = $wpdb->insert_id;
         * $fetch_content = $wpdb->get_results("SELECT 'content' FROM 'wp_bp_activity WHERE 'id'='$lastid'");
         * var_dump($fetch_content);exit;
         * foreach ($query as $value) {
         * $post_data = $value->content;
         * }
         */

        // $result = $wpdb->query("INSERT INTO `wp_bp_activity`(`user_id`, `component`, `type`, `action`, `content`, `primary_link`, `date_recorded`) VALUES ($userId,'$type','$component','$action','$msg','$primary_link','$date')");
        // var_dump($result);exit;
        if ($result) {
            $data = $msg;
            $msg = "successfully.";
            $status = '1';
        } else {
            $data = 'Data Not Record';
            $msg = "fail.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function friendList($request) {
        /*
         * global $wpdb;
         * $user_id = $request['userId'];
         *
         * $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='photo'");
         *
         * if ($result) {
         * foreach ($result as $images) {
         *
         * $resultLink = $wpdb->get_results("SELECT `guid` FROM `wp_posts` WHERE `ID`='$images->item_id'");
         *
         * $id = $images->id;
         * $title = $images->media_title;
         * $image = $resultLink[0]->guid;
         *
         *
         * $data[] = array(
         * 'id' => $id,
         * 'title' => $title,
         * 'imageLink' => $image
         * );
         * }
         * $data = $data;
         * $msg = "Images List.";
         * $status = '1';
         *
         * } else {
         *
         * $data = '0';
         * $msg = "Image Not Found.";
         * $status = '0';
         * }
         *
         * return array(
         * 'status' => $status,
         * 'msg' => $msg,
         * 'data' => $data
         * );
         */
        global $wpdb;
        $user_id = $request['userId'];

        // $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='photo'");
        $result = $wpdb->get_results("SELECT * FROM wp_users AS b INNER JOIN  wp_bp_friends AS r ON b.ID = r.initiator_user_id AND r.friend_user_id='$user_id'");

        // $result = $wpdb->get_results("SELECT b.* FROM wp_bp_notifications AS b INNER JOIN wp_users AS r ON r.ID = b.item_id WHERE b.component_action='friendship_accepted' AND b.user_id='$user_id'");

        if ($result) {
            foreach ($result as $images) {

                $user_Id = $images->initiator_user_id;
                $user_login = $images->user_login;

                $resultLink = $wpdb->get_results("SELECT * FROM `wp_users` WHERE `ID`='$user_Id'");

                $user = $resultLink[0]->user_email;

                $location = xprofile_get_field_data(44, $images->ID);
                $interest = xprofile_get_field_data(6, $images->ID);

                $djData = $wpdb->get_results("SELECT * FROM `wp_dj_users` WHERE `userId`=$images->ID");

                if ($djData[0]->userId) {
                    $dj = "1";
                } else {
                    $dj = "0";
                }

                $user_dirname = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $user_Id;
                $user_cover = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/buddypress/members/' . $user_Id . '/cover-image';

                if (file_exists($user_dirname)) {
                    $dir_contents = scandir($user_dirname);
                    $upload_dir = wp_upload_dir();
                    $user_dirname = $upload_dir['baseurl'] . '/avatars/' . $user_Id . '/' . $dir_contents[2];
                } else {
                    $user_dirname = $upload_dir['baseurl'] . '/avatars/1/592e60c81c8fa-bpfull.png';
                }

                if (file_exists($user_cover)) {
                    $dir_contents1 = scandir($user_cover);
                    $upload_dir1 = wp_upload_dir();
                    $user_cover = $upload_dir1['baseurl'] . '/buddypress/members/' . $user_Id . '/cover-image/' . $dir_contents1[2];
                } else {
                    $user_cover = '';
                }
                $data[] = array(
                    'friend_user_id' => $user_Id,
                    'user_login' => $user_login,
                    'friend_name' => $resultLink[0]->display_name,
                    'location' => $location,
                    'interes' => $interest,
                    'DJ' => $dj,
                    'img' => $user_dirname
                );
            }
            // var_dump($data);exit;
            $data = $data;
            $msg = "Friend List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Image Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function postLogin($request) {
        global $wpdb;

        $username = $request['username'];
        $password = $request['password'];

        if (is_email($username)) {

            $user = get_user_by('email', $username);
        } else {
            $user = get_user_by('login', $username);
        }

        if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {

            $query = $wpdb->get_results("SELECT wp_bp_xprofile_fields.name,wp_bp_xprofile_data.value,wp_bp_xprofile_data.field_id FROM wp_bp_xprofile_fields, wp_bp_xprofile_data WHERE wp_bp_xprofile_fields.ID = wp_bp_xprofile_data.field_id AND wp_bp_xprofile_data.user_id = $user->ID");

            foreach ($query as $v) {
                $result[$v->name] = $v->value . ',' . $v->field_id;
            }
            $user_dirname = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $user->ID;
            $user_cover = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/buddypress/members/' . $user->ID . '/cover-image';

            if (file_exists($user_dirname)) {
                $dir_contents = scandir($user_dirname);
                $upload_dir = wp_upload_dir();
                $user_dirname = $upload_dir['baseurl'] . '/avatars/' . $user->ID . '/' . $dir_contents[2];
            } else {
                $user_dirname = $upload_dir['baseurl'] . '/avatars/1/592e60c81c8fa-bpfull.png';
            }

            if (file_exists($user_cover)) {
                $dir_contents1 = scandir($user_cover);
                $upload_dir1 = wp_upload_dir();
                $user_cover = $upload_dir1['baseurl'] . '/buddypress/members/' . $user->ID . '/cover-image/' . $dir_contents1[2];
            } else {
                $user_cover = '';
            }
            $newResult = array_merge($result, array(
                "userId" => $user->ID,
                "username" => $user->user_login,
                "email" => $user->user_email,
                "img" => $user_dirname,
                "cover" => $user_cover
            ));

            $data = $newResult;
            $msg = "Login successfully.";
            $status = '1';
        } else {
            $data = '0';
            $msg = "username and password incorrect.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function postsignUp($request) {
        global $wpdb;
        $firstName = $request['firstName'];
        $username = $request['username'];
        $email = $request['email'];
        $password = md5($request['password']);
        if (email_exists($email)) {
            $emailalert = $email;
        }
        if (username_exists($username)) {
            $useralert = $username;
        }

        if ((email_exists($email)) || (username_exists($username))) {
            $data = '0';
            $msg = 'This ' . $useralert . $emailalert . ' already exists please choose a different one';
            $status = '0';
        } else {

            $date = date('Y-m-d h:i:s', time());
            $wpdb->query("INSERT INTO `wp_users` (`user_login`,`user_nicename`, `user_email`,`user_registered`,`display_name`) VALUES 
         ('$username','$firstName','$email','$date','$firstName')");
            $id = $wpdb->insert_id;
            $res = serialize(array(
                'subscriber' => true
            ));
            $wpdb->insert(wp_usermeta, array(
                'user_id' => $id,
                'meta_key' => 'wp_capabilities',
                'meta_value' => $res
            ));
            add_user_meta($id, 'first_name', $firstName);

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $message = "     
      Hello " . $firstName . ",
      <br /><br />
       Welcome to Pump or Dump. Thank you for registering.<br/>
      To complete your registration please click the following link:<br/>
      <br /><br />
      <a href='" . site_url() . "/verify?id=" . $email . "&code=" . base64_encode($password) . "'>Confirm Email Address</a>
      <br /><br />
      The Pump or Dump Team";

            $subject = "Confirm Registration";
            if (mail($email, $subject, $message, $headers)) {

                $data = '1';
                $msg = "Thank you for registering on Pump or Dump. Please check your email for a verification link to establish your account.";
                $status = '1';
            } else {
                $data = '0';
                $msg = "username and password incorrect.";
                $status = '0';
            }
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function updateProfile($request) {
        global $wpdb;

        $firstName = explode(",", $request['firstName']);
        $lastName = explode(",", $request['lastName']);
        $DOB = explode(",", $request['DOB']);
        $location = explode(",", $request['location']);
        $phone = explode(",", $request['phone']);
        $interest = explode(",", $request['interest']);
        $BIO = explode(",", $request['BIO']);
        $lookingFor = explode(",", $request['lookingFor']);
        $hobbies = explode(",", $request['hobbies']);
        $gender = explode(",", $request['gender']);
        $userId = $request['userId'];
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$firstName[0]'  WHERE `field_id`='$firstName[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$lastName[0]'  WHERE `field_id`='$lastName[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$DOB[0]'  WHERE `field_id`='$DOB[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$location[0]'  WHERE `field_id`='$location[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$phone[0]'  WHERE `field_id`='$phone[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$interest[0]'  WHERE `field_id`='$interest[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$BIO[0]'  WHERE `field_id`='$BIO[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$lookingFor[0]'  WHERE `field_id`='$lookingFor[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$hobbies[0]'  WHERE `field_id`='$hobbies[1]' AND `user_id`='$userId'");
        $wpdb->query("UPDATE `wp_bp_xprofile_data` SET `value`='$gender[0]'  WHERE `field_id`='$gender[1]' AND `user_id`='$userId'");

        $result = $wpdb->query("UPDATE `wp_users` SET `user_nicename`='$firstName[0]' ,`display_name`='$firstName[0]' WHERE `ID`='$userId'");
        if ($result) {
            $data = '1';
            $msg = "Update successfully.";
            $status = '1';
        } else {
            $data = '0';
            $msg = "Update error.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function forgotPassword($request) {
        global $wpdb;

        $email = $request['email'];

        if (!email_exists($email)) {
            $data = '0';
            $msg = 'There is no user registered with that email address.';
            $status = '0';
        } else {
            $random_password = wp_generate_password(12, false);
            $user = get_user_by('email', $email);

            $update_user = wp_update_user(array(
                'ID' => $user->ID,
                'user_pass' => $random_password
            ));

            // if update user return true then lets send user an email containing the new password
            if ($update_user) {
                $to = $email;
                $subject = 'Your new password';
                $sender = $user->display_name;

                $message = 'Your new password is: ' . $random_password;

                $headers[] = 'MIME-Version: 1.0' . "\r\n";
                $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers[] = "X-Mailer: PHP \r\n";
                $headers[] = 'From: ' . $sender . ' < ' . $email . '>' . "\r\n";

                $mail = wp_mail($to, $subject, $message, $headers);
                if ($mail) {
                    $data = '1';
                    $msg = "Check your email address for you new password.";
                    $status = '1';
                }
            } else {
                $data = '0';
                $msg = "Oops something went wrong updaing your account.";
                $status = '0';
            }
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function changePassword($request) {
        global $wpdb;

        $oldpassword = $request['oldpassword'];
        $newpassword = md5($request['newpassword']);
        $email = $request['email'];

        $user = get_user_by('email', $email);

        if ($user && wp_check_password($oldpassword, $user->data->user_pass, $user->ID)) {
            $result = $wpdb->query("UPDATE `wp_users` SET `user_pass`='$newpassword'  WHERE `ID`='$user->ID'");
            $data = '1';

            $msg = "Change successfully.";
            $status = '1';
        } else {
            $data = '0';
            $msg = "Username and Old Password incorrect.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function changeProfileImage($request) {
        if ($_REQUEST['userId']) {

            $upload_dir = wp_upload_dir();
            $user_dir = $upload_dir['basedir'] . '/avatars/' . $_REQUEST['userId'];
            if (!file_exists($user_dir)) {
                wp_mkdir_p($user_dir);
            }

            $encode_imagefull = $_REQUEST['imagefull'];
            $encode_imagethumb = $_REQUEST['imagethumb'];

            $namefull = $_REQUEST['namefull'];
            $namethumb = $_REQUEST['namethumb'];

            $decode_imagefull = base64_decode($encode_imagefull);
            $decode_imagethumb = base64_decode($encode_imagethumb);

            $user_dir_path = $user_dir . '/' . $namefull;
            $user_dir_path1 = $user_dir . '/' . $namethumb;

            $dir_contents = scandir($user_dir);

            unlink($user_dir . '/' . $dir_contents[2]);

            $file = fopen($user_dir_path, 'wb');
            $is_fwrite = fwrite($file, $decode_imagefull);
            fclose($file);
            unlink($user_dir . '/' . $dir_contents[3]);
            $file1 = fopen($user_dir_path1, 'wb');
            $is_fwrite = fwrite($file1, $decode_imagethumb);
            fclose($file1);

            $data = '1';
            $msg = "Profile Image Change successfully";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Sorry.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function changeCoverImage($request) {
        if ($_REQUEST['userId']) {

            $upload_dir = wp_upload_dir();
            $user_dir = $upload_dir['basedir'] . '/buddypress/members/' . $_REQUEST['userId'] . '/cover-image';
            $dir_contents = scandir($user_dir);
            unlink($user_dir . '/' . $dir_contents[2]);

            if (!file_exists($user_dir)) {
                wp_mkdir_p($user_dir);
            }
            $encode_coverimage = $_REQUEST['coverimage'];

            $covername = $_REQUEST['covername'];

            $decode_coverimage = base64_decode($encode_coverimage);

            $user_dir_path = $user_dir . '/' . $covername;

            $file = fopen($user_dir_path, 'wb');
            $is_fwrite = fwrite($file, $decode_coverimage);
            fclose($file);

            $data = '1';
            $msg = "Cover Image Change successfully";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Sorry.";
            $status = '0';
        }
        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function imageList($request) {
        global $wpdb;
        $user_id = $request['userId'];

        $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN  wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='photo'");

        if ($result) {
            foreach ($result as $images) {
                $resultLink = $wpdb->get_results("SELECT `guid` FROM `wp_posts` WHERE `ID`='$images->item_id'");
                $id = $images->id;
                $title = $images->media_title;
                $image = $resultLink[0]->guid;

                $data[] = array(
                    'id' => $id,
                    'title' => $title,
                    'imageLink' => $image
                );
            }
            $data = $data;
            $msg = "Images List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Image Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function musicList($request) {
        global $wpdb;
        $user_id = $request['userId'];

        $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN  wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='music'");

        if ($result) {
            foreach ($result as $mugic) {
                $resultLink = $wpdb->get_results("SELECT `guid` FROM `wp_posts` WHERE `ID`='$mugic->item_id'");
                $id = $mugic->id;
                $title = $mugic->media_title;
                $cover_art = $mugic->cover_art;
                $mugic = $resultLink[0]->guid;

                $data[] = array(
                    'id' => $id,
                    'title' => $title,
                    'mugicLink' => $mugic,
                    'cover_art' => $cover_art
                );
            }
            $data = $data;
            $msg = "Mugic List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Mugic Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function videoList($request) {
        global $wpdb;
        $user_id = $request['userId'];

        $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN  wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='video'");
        // $cover_art = $upload_dir['baseurl'] . '/rtMedia/videoImage/video_thumb.png';
        $cover_art = 'http://pump-or-dump.com/wp-content/uploads/rtMedia/videoImage/video_thumb.png';
        //  var_dump($result);
        if ($result) {
            foreach ($result as $video) {
                $resultLink = $wpdb->get_results("SELECT `guid` FROM `wp_posts` WHERE `ID`='$video->item_id'");
                $id = $video->id;
                $title = $video->media_title;
                // $cover_art = $video->cover_art;
                $video = $resultLink[0]->guid;

                $data[] = array(
                    'id' => $id,
                    'title' => $title,
                    'videoLink' => $video,
                    'cover_art' => $cover_art
                );
            }
            $data = $data;
            $msg = "Video List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Video Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function fieldList() {
        global $wpdb;

        $result = $wpdb->get_results("SELECT `id` ,`name`,`field_order` FROM `wp_bp_xprofile_fields` WHERE `type`!= 'option' ORDER BY `field_order`");

        if ($result) {
            foreach ($result as $fields) {

                $id = $fields->id;
                $name = $fields->name;
                $field_order = $fields->field_order;

                $data[] = array(
                    'id' => $id,
                    'name' => $name,
                    'field_order' => $field_order
                );
            }
            $data = $data;
            $msg = "fields List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "fields Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    public function messageList($request) {
        global $wpdb;

        $user_id = $request['userId'];

        $result = $wpdb->get_results("SELECT msg.*,u.user_nicename FROM wp_bp_messages_recipients AS rec_msg INNER JOIN  wp_bp_messages_messages AS msg ON msg.thread_id = rec_msg.thread_id INNER JOIN wp_users as u on u.ID = msg.sender_id where user_id='$user_id' ORDER BY date_sent DESC LIMIT 1");

        // $result = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN wp_rt_rtm_media AS r ON b.user_id = r.media_author AND b.item_id = r.media_id AND r.media_author='$user_id' AND media_type ='photo'");
        // $user_dirname = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $user_id;
        // $user_dirname = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $fields->sender_id;
        // ///////////////
        // ////////////////

        foreach ($result as $fields) {

            $user_dirname = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $fields->sender_id;
            $user_cover = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/buddypress/members/' . $fields->sender_id . '/cover-image';

            if (file_exists($user_dirname)) {
                $dir_contents = scandir($user_dirname);
                $upload_dir = wp_upload_dir();
                $user_dirname = $upload_dir['baseurl'] . '/avatars/' . $fields->sender_id . '/' . $dir_contents[2];
            } else {
                $user_dirname = $upload_dir['baseurl'] . '/avatars/1/592e60c81c8fa-bpfull.png';
            }

            if (file_exists($user_cover)) {
                $dir_contents1 = scandir($user_cover);
                $upload_dir1 = wp_upload_dir();
                $user_cover = $upload_dir1['baseurl'] . '/buddypress/members/' . $fields->sender_id . '/cover-image/' . $dir_contents1[2];
            } else {
                $user_cover = '';
            }
        }

        // var_dump($file);

        if ($result) {
            foreach ($result as $fields) {

                // $id = $fields->id;
                $thread_id = $fields->thread_id;
                $sender_id = $fields->sender_id;
                $subject = $fields->subject;
                $message = $fields->message;
                $name = $fields->user_nicename;
                $date_sent = $fields->date_sent;

                // $result1 = $wpdb->get_results("SELECT * FROM wp_bp_activity AS b INNER JOIN wp_rt_rtm_media AS r ON b.user_id = $sender_id ");
                // var_dump($result1);
                $data[] = array(
                    // 'id' => $id,
                    'name' => $name,
                    'thread_id' => $thread_id,
                    'sender_id' => $sender_id,
                    'subject' => $subject,
                    'message' => $message,
                    'date_sent' => $date_sent,
                    'image' => $user_dirname
                );
            }

            $data = $data;
            $msg = "Message List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Message Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

    /*
     * public function messageList($request){
     * global $wpdb;
     *
     * $user_id = $request['userId'];
     *
     * $result = $wpdb->get_results("SELECT msg.*,u.user_nicename FROM wp_bp_messages_recipients AS rec_msg INNER JOIN wp_bp_messages_messages AS msg ON msg.thread_id = rec_msg.thread_id INNER JOIN wp_users as u on u.ID = msg.sender_id where user_id='$user_id' ORDER BY date_sent DESC LIMIT 1");
     *
     * // var_dump($result);
     * if ($result) {
     * foreach ($result as $fields) {
     *
     * //$id = $fields->id;
     * $thread_id = $fields->thread_id;
     * $sender_id = $fields->sender_id;
     * $subject = $fields->subject;
     * $message = $fields->message;
     * $name = $fields->user_nicename;
     * $date_sent = $fields->date_sent;
     *
     * $data[] = array(
     * // 'id' => $id,
     * 'name' => $name,
     * 'thread_id' => $thread_id,
     * 'sender_id' => $sender_id,
     * 'subject' => $subject,
     * 'message' => $message,
     * 'date_sent' => $date_sent,
     * );
     * }
     * $data = $data;
     * $msg = "Message List.";
     * $status = '1';
     * } else {
     *
     * $data = '0';
     * $msg = "Message Not Found.";
     * $status = '0';
     * }
     *
     * return array(
     * 'status' => $status,
     * 'msg' => $msg,
     * 'data' => $data
     * );
     * }
     */

    public function notificaList($request) {
        global $wpdb;

        $user_id = $request['userId'];

        // $result = $wpdb->get_results("SELECT activity.*,u.user_nicename FROM wp_bp_notifications AS noti INNER JOIN wp_bp_activity AS activity ON activity.user_id = noti.secondary_item_id INNER JOIN wp_users as u on u.ID = noti.secondary_item_id where noti.user_id='$user_id' ORDER BY date_notified DESC");
        $result = $wpdb->get_results("SELECT * FROM wp_bp_notifications AS noti INNER JOIN wp_bp_activity AS activity ON activity.user_id = noti.user_id INNER JOIN wp_users as u on u.ID = noti.secondary_item_id  where noti.user_id='$user_id' GROUP BY noti.item_id ORDER BY date_notified DESC");
        // $result = $wpdb->get_results("SELECT * FROM `wp_bp_notifications` WHERE `user_id`='$user_id'");
        // var_dump($result);exit;
        if ($result) {
            foreach ($result as $fields) {

                $id = $fields->id;
                $content = $fields->content;
                $link = $fields->primary_link;
                $name = $fields->user_nicename;
                $ID = $fields->ID;
                $date_sent = $fields->date_notified;
                $Item_Id = $fields->item_id;
                $component_action = $fields->component_action;
                $image = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/avatars/' . $ID;
                // $user_cover = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/buddypress/members/' . $user_Id . '/cover-image';

                /*
                 * if (file_exists($user_dirname)) {
                 * $dir_contents = scandir($user_dirname);
                 * $upload_dir = wp_upload_dir();
                 * $img_dirname = $upload_dir['baseurl'] . '/avatars/' . $user_id . '/' . $dir_contents[2];
                 * } else {
                 * $img_dirname = $upload_dir['baseurl'] . '/avatars/1/592e60c81c8fa-bpfull.png';
                 * }
                 */
                if (file_exists($image)) {
                    $dir_contents = scandir($image);
                    $upload_dir = wp_upload_dir();
                    $img_dirnam = $upload_dir['baseurl'] . '/avatars/' . $ID . '/' . $dir_contents[2];
                } else {
                    $img_dirnam = $upload_dir['baseurl'] . '/avatars/1/592e60c81c8fa-bpfull.png';
                }

                $data[] = array(
                    // 'id' => $id,
                    'name' => $name,
                    // 'content' => $content,
                    'primary_link' => $link,
                    'date_notified' => $date_sent,
                    'sender_image' => $img_dirnam,
                    // 'img' => $img_dirname,
                    'Item_id' => $Item_Id,
                    'component_action' => $name . "  comments on " . $component_action
                );
            }

            $data = $data;
            $msg = "Message List.";
            $status = '1';
        } else {

            $data = '0';
            $msg = "Message Not Found.";
            $status = '0';
        }

        return array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data
        );
    }

}

?>