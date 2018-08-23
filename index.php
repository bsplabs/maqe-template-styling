<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MAQE Styling</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
      .image_post > img {
        padding: 0;
      }

      .text_post {
        padding: 0;
        margin: 0 !important;
      }

      .text_post > .time_ago {
        font-style: italic;
      }

      .title {
        font-weight: 500;
        font-size: 20px;
      }
      .body {
        font-weight: 400;
      }

      i {
        margin-right: 4px;
      }

      .author {
        margin-top: 10px;
      }
      .author > p {
        margin-bottom: 0;
        margin-top: 4px;
      }
      .name_author {
        color: red;
        font-size: 19;
        font-weight: 500;
      }
      .role_user {
        font-size: 14;
        font-weight: 500;
      }
      .place {
        font-size: 12;
      }

      .time_ago {

      }

    </style>

  </head>

  <body>
    <?php
    function datetime_ago($datetime_string) {
      date_default_timezone_set('Asia/Bangkok');
      $ts = strtotime($datetime_string);
      $now = strtotime('now');
      if(!$ts || $ts > $now) {
        return false;
      }

      $diff = $now - $ts; // คำนวณหาระยะที่ห่างกันว่าอยู่ในช่วง ปี เดือน วัน หรือชั่วโมง

      $second = 1;
      $minute = 60 * $second;
      $hour = 60 * $minute;
      $day = 24 * $hour;
      $yesterday = 48 * $hour;
      $month = 30 * $day;
      $year = 365 * $day;
      $ago = "";

      if($diff >= $year) {
        $ago = round($diff/$year) . " year ago";
      }
      else if($diff >= $month) {
        $ago = round($diff/$month) . " month ago";
      }
      else if($diff > $yesterday) {
        $ago = round($diff/$day) . " day ago";
      }
      else if($diff <= $yesterday && $diff > $day) {
        $ago = " yesterday";
      }
      else if($diff >= $hour) {
        $ago = round($diff/$hour) . " hour ago";
      }
      else if($diff >= $minute) {
        $ago = round($diff/$minute) . " นาที ที่เเล้ว";
      }
      else if($diff >= 5*$second) {
        $ago = round($diff/$year) . " วินาที ที่เเล้ว";
      }
      else {
        $ago = " เมื่อสักครู่";
      }

      return $ago;
      }

      $postDisplay = array();
      $authorJson = file_get_contents("http://maqe.github.io/json/authors.json");
      $postJson = file_get_contents("http://maqe.github.io/json/posts.json");
      $resultAuthor  = json_decode($authorJson);
      $resultPost  = json_decode($postJson);

      // print_r($resultAuthor);
      foreach($resultPost as $objPost) {
        foreach ($resultAuthor as $objAuthor) {
          if ($objPost->author_id == $objAuthor->id)
          {
            $object = (object) [

              'id' => $objPost->author_id,
              'title' => $objPost->title,
              'body' => $objPost->body,
              'image_url' => $objPost->image_url,
              'create_at' => $objPost->created_at,
              'author_id' => $objAuthor->id,
              'name' => $objAuthor->name,
              'role'=> $objAuthor->role,
              'place' => $objAuthor->place,
              'avatar_url' =>  $objAuthor->avatar_url
            ];
            array_push($postDisplay, $object);
            break;
          }
        }
      }
      // print_r($postDisplay);
    ?>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h1>MAQE Forums</h1>
          <h2>Subtitle</h2>
          <h3>Post</h3>
        </div>
      </div>

      <?php foreach ($postDisplay as $obj_post_display) { ?>
      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 image_post">
                    <img src="<?php echo $obj_post_display->image_url; ?>"
                    class="rounded mx-auto d-block" width="200" height="150">
                  </div>
                  <div class="col-md-7 text_post">
                      <p class="title"><?php echo $obj_post_display->title; ?></p>
                      <p class="body"><?php echo $obj_post_display->body; ?></p>
                      <p class="time_ago"><i class="far fa-clock"></i><?php echo datetime_ago($obj_post_display->create_at); ?></p>
                  </div>
                  <div class="col-md-2 text-center">
                    <div class="image_author">
                      <img src="<?php echo $obj_post_display->avatar_url; ?>"
                      class="rounded-circle" width="100" height="100">
                    </div>
                    <div class="author">
                      <p class="name_author"><?php echo $obj_post_display->name; ?></p>
                      <p class="role_user"><?php echo $obj_post_display->role; ?></p>
                      <p class="place"><i class="fas fa-map-marker-alt"></i><?php echo $obj_post_display->place; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <?php } ?>

      <br>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-md-4"></div>
      </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </body>

</html>
