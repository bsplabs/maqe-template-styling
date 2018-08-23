<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MAQE Styling</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>

  <body>
    <?php
      $postDisplay = array();

      $authorJson = file_get_contents("http://maqe.github.io/json/authors.json");
      $postJson = file_get_contents("http://maqe.github.io/json/posts.json");
      $resultAuthor  = json_decode($authorJson);
      $resultPost  = json_decode($postJson);

      print_r($resultAuthor);
      foreach($resultPost as $objPost) {
        ///////// Post ///////////
        echo $objPost->id."<br>";
        echo $objPost->author_id."<br>";
        echo $objPost->title."<br>";
        echo $objPost->body."<br>";
        echo $objPost->image_url."<br>";
        echo $objPost->created_at."<br><br>";

        foreach ($resultAuthor as $objAuthor) {
          if ($objPost->author_id == $objAuthor->id)
          {
            $object = (object) [
              'id' => $objPost->author_id,
              'author_id' => $objAuthor->id
            ];
            array_push($postDisplay, $object);
            break;
          }
        }
        ///////// Athor ///////////
        // echo $obj->role."<br>";
        // echo $obj->place."<br>";
        // echo $obj->avatar_url."<br>";
        // echo "<br>";
        // $author = array();
        // array_push($author, $obj->id,$obj->role,$obj->place,$obj->avatar_url);
        // print_r(json_decode($author));
        // array_push($postDisplay, $author);
      }

      print_r($postDisplay);
    ?>

    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h1>MAQE Forums</h1>
          <h2>Subtitle</h2>
          <h3>Post</h3>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">Basic card</div>
            </div>
          </div>
      </div>

      <div class="row">
        Pagination
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
