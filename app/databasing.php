<?php

include_once 'db_connect.php';

session_start();

//ALTERING DATABASE
if(isset($_POST['DASH_RETRIEVE_RECENT_LEADS'])){

    $full_array = array();
    $status = 0; //Estimate not yet generated

    $stmt = $db->prepare('SELECT * FROM leads WHERE status=? ORDER by id DESC');
    $stmt->execute([$status]);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $tmp_array = array(

            'id' => $row['id'],
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
            'estimator' => $row['estimator_name'],
            'booking_date' => $row['booking_date'],
            'booking_time' => $row['booking_time'],
            'entered_by' => $row['entered_by'],
            'datetime' => $row['datetime']
        );

        array_push($full_array, $tmp_array);

    }

    $full_array = json_encode($full_array);
    print_r($full_array);
}
if(isset($_POST['DASH_RETRIEVE_ALL_LEADS_BY_STATUS'])){

    $full_array = array();
    $status = $_POST['status'];
    $query = $_POST['query'];

    $stmt = $db->prepare('SELECT * FROM leads WHERE name LIKE ? AND status=? ORDER by id DESC');
    $stmt->execute(['%' . $query . '%', $status]);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $tmp_array = array(

            'id' => $row['id'],
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
            'estimator' => $row['estimator_name'],
            'booking_date' => $row['booking_date'],
            'booking_time' => $row['booking_time'],
            'entered_by' => $row['entered_by'],
            'datetime' => $row['datetime']
        );

        array_push($full_array, $tmp_array);

    }

    $full_array = json_encode($full_array);
    print_r($full_array);
}
if(isset($_POST['DASH_RETRIEVE_ALL_EMPLOYEES'])){

    $full_array = array();
    //$status = $_POST['status'];
    $query = $_POST['query'];

    $stmt = $db->prepare('SELECT * FROM employees WHERE fullname LIKE ? ORDER by id DESC');
    $stmt->execute(['%' . $query . '%']);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $tmp_array = array(

            'id' => $row['id'],
            'fullname' => $row['fullname']
        );

        array_push($full_array, $tmp_array);

    }

    $full_array = json_encode($full_array);
    print_r($full_array);
}
if(isset($_POST['DASH_RETRIEVE_POSTS'])){

    $full_array_posts = array();

    $result_board_pdo = $db->query('SELECT * FROM announcements ORDER by id desc limit 5');
    while($row = $result_board_pdo->fetch(PDO::FETCH_ASSOC)) {

        $post_id = $row['id'];
        $comment_array = array();

        //get comments
        $comments = $db->prepare('SELECT * FROM comments WHERE (postid=:postid) ORDER by id asc');
        $comments->bindValue(':postid', $post_id, PDO::PARAM_INT);
        $comments->execute();

        while($c_row = $comments->fetch(PDO::FETCH_ASSOC)) {

            $c_id = $c_row['id'];
            $c_post_id = $c_row['postid'];
            $c_author = $c_row['author'];
            $c_date = $c_row['date'];
            $c_content = $c_row['content'];
            $c_time = $c_row['time'];

            $tmp_c_array = array(
                "id" => $c_id,
                "postid" => $c_post_id,
                "author" => $c_author,
                "date" => $c_date,
                "content" => $c_content,
                "time" => $c_time,
                "avatar" => 'img/avatars/' . strtolower($c_author) . '.png'
            );

            array_push($comment_array, $tmp_c_array);

        }

        $post_author = $row['author'];
        $post_date = $row['date'];
        $post_time = $row['time'];
        $post_content = $row['content'];
        $post_avatar_img_directory = 'img/avatars/' . strtolower($row['author']) . '.png';
        $post_files = $row['files'];

        if(file_exists($post_avatar_img_directory)){

        }else{
            $post_avatar_img_directory = 'img/headshot_placeholder.png';
        }

        $content_array = array(
            "id" => $post_id,
            "author" => $post_author,
            "date" => $post_date,
            "time" => $post_time,
            "content" => $post_content,
            "avatar" => $post_avatar_img_directory,
            "comments" => $comment_array,
            "files" => $post_files
        );

        array_push($full_array_posts, $content_array);

    }

    $full_array_posts = json_encode($full_array_posts);
    print_r($full_array_posts);

}

//RETRIEVING FROM DATABASE
if(isset($_POST['DASH_ADD_LEAD'])){

    $stmt = $db->prepare('SELECT * FROM employees WHERE fullname=:fname');
    $stmt->bindValue(':fname', $_POST['estimator'], PDO::PARAM_STR);
    $stmt->execute();

    $estimator_id = '';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $estimator_id = $row['id'];
    }

    if($estimator_id == ''){
        print_r("Error 0x. Could not find employee \"" . $_POST['estimator'] . "\"");
        return;
    }

    $stmt = $db->prepare("INSERT INTO leads (name, phone, email, address, estimator_id, estimator_name, booking_date, booking_time, entered_by, datetime) VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7,:field8,:field9,:field10)");
    $stmt->execute(array(
            ':field1' => $_POST['name'],
            ':field2' => $_POST['phone'],
            ':field3' => $_POST['email'],
            ':field4' => $_POST['address'],
            ':field5' => $estimator_id,
            ':field6' => $_POST['estimator'],
            ':field7' => $_POST['date'],
            ':field8' => $_POST['time'],
            ':field9' => $_SESSION['user_fullname'],
            ':field10'=> ReturnCurrentDateTime()
        )
    );

    print_r("Lead successfully added.");
}
if(isset($_POST['DASH_ADD_POST']) && isset($_POST['content'])){

    $username = $_SESSION['username'];
    $content = $_POST['content'];
    //$filearray = $_POST['dash_files'];
    $content = nl2br($content);

    if($_POST['global'] == 'true'){

        $email_array = array();

        $stmt = $db->prepare('SELECT * FROM employees');
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $email = $row['email'];

            array_push($email_array, $email);

        }

        $to = implode(', ', $email_array);
        print_r($to);
        $subject = "Sapphire Roofing Important Announcement from " . $_SESSION['user_fullname'];

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@sapphireroofing.ca>' . "\r\n";

        mail($to,$subject,$content,$headers);

    }

    $stmt = $db->prepare("INSERT INTO announcements(author,content,date,time) VALUES(:field1,:field2,:field3,:field4)");
    $stmt->execute(array(
            ':field1' => $username,
            ':field2' => $content,
            ':field3' => date("F") . " " . date("j") . ", " . date("o"),
            ':field4' => date("h:ia")
            //':field5' => $filearray
        )

    );

    print_r("Post added successfully.");


}
if(isset($_POST['DASH_ADD_COMMENT']) && isset($_POST['postid']) && isset($_POST['content'])){

    //variables for later
    $username = $_SESSION['username'];
    $content = $_POST['content'];
    $post_id = $_POST['postid'];

    $stmt = $db->prepare("INSERT INTO comments(author,content,date,time,postid) VALUES(:field1,:field2,:field3,:field4,:field5)");
    $stmt->execute(array(
            ':field1' => $username,
            ':field2' => $content,
            ':field3' => date("F") . " " . date("j") . ", " . date("o"),
            ':field4' => date("h:ia"),
            ':field5' => $post_id
        )
    );

}

function ReturnCurrentDateTime(){
    return(date("m.d.y"));
}