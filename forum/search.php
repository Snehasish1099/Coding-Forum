<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>iCoder - coding Forum</title>
    <style>
        .ques {
            min-height: 531px;
        }
    </style>
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>


    <!-- search results -->
    <div class="container ques my-3">
        <h1>Search results for <em>"
                <?php echo $_GET['search']; ?>"
            </em></h1>
        <?php
    $noResult=true;
    $search=$_GET['search'];
    $sql="SELECT * FROM threads WHERE MATCH(thread_title,thread_desc) AGAINST('$search')"; 
    $result = mysqli_query($conn,$sql);
    // fetching data from category database
    while($row = mysqli_fetch_assoc($result)){
      $thread_title= $row['thread_title'];
      $thread_desc= $row['thread_desc'];
      $thread_id=$row['thread_id'];
      $url="thread.php?threadid=".$thread_id;
          echo '<div class="result">
          <h3><a href="'.$url.'" class="text-dark text-decoration-none">'.$thread_title.'</a></h3>
          <p>'.$thread_desc.'</p>
          </div>';
          $noResult=false;
    }
    if($noResult){
        echo '<div class="container my-4">
        <div class="card p-4 bg-primary bg-opacity-10">
            <h1>No Result Found</h1>
            <p>
                Suggestions:
                <ul>
                    <li> Make sure that all words are spelled correctly.</li>
                    <li> Try different keywords.</li>
                   <li> Try more general keywords.</li>
                </ul>
            </p>
        </div>
    </div>';
    }
    ?>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
        </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>