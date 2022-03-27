<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>iCoder - Coding Forum</title>
</head>
<style>
    .card{
        box-shadow: 10px 10px 40px #80808096;
    }
</style>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <!-- slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/python.jpg" class="d-block w-100" style="height: 60vh;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/javascript.jpg" class="d-block w-100" style="height: 60vh;" alt="...">
            </div>
            <div class="carousel-item">
                <img src="image/sql.jpg" class="d-block w-100" style="height: 60vh;" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- category container -->
    <div class="container">
        <h2 class="text-center">Welcome to iCoder - Coding Forum</h2>
        <div class="row ques">
            <!-- fetching categories   -->
            <?php $sql = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
// fetching data from category database
while ($row = mysqli_fetch_assoc($result)) {
    $cat_name = $row['category_name'];
    $id = $row['category_id'];
    $desc = substr($row['category_description'], 0, 25);
    echo '<div class="d-flex flex-row justify-content-center col-md-4 my-2">
    <div class="card" style="width: 18rem;">
      <img src="image/' . $cat_name . '.jpg" class="card-img-top" style="height: 170px" alt="image for category ' . $cat_name . '">
      <div class="card-body">
        <h5 class="card-title"><a class="text-decoration-none" href="threadlist.php?catid=' . $id . '">' . $row['category_name'] . '</a></h5>
        <p class="card-text">' . $desc . '....</p>
        <a href="threadlist.php?catid=' . $id . '" class="btn btn-outline-info">View Threads</a>
      </div>
    </div>
  </div>';
}

?>

        </div>

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