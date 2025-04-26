<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./public/css/Home.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=file_export" />
  <script src="./public/js/jquery-3.2.1.min.js"></script>
</head>

<body class="h-100">
  <header class="border-bottom  border-3 border-warning">
    <nav class="navbar navbar-expand-lg ">
      <div class="container-fluid">
        <a class="navbar-brand">
          <img src="./public/img/logo.svg" width="100%" height="100%" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end  " id="navbarNav" data-bs-theme="warning">
          <ul class="navbar-nav nav   ">
            <li class="nav-item">
              <a class="nav-link fs-5 text-dark" href="/Tax_Management/Home">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5 text-dark" href="/Tax_Management/Support">Hỗ trợ</a>
            </li>
            <li class="nav-item ms-2">

              <div class="dropdown">

                <i class="bi bi-person" style="font-size: 30px;" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false"></i>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                  <li><a class="dropdown-item" href="/Tax_Management/Settings">Cài đặt</a></li>
                  <li><a class="dropdown-item" href="./mvc/Controllers/Logout.php">Đăng xuất</a></li>

                </ul>
              </div>
            </li>
            <li class="nav-item">

            </li>
          </ul>
        </div>

      </div>
    </nav>
    </header>
    <?php  
        if(isset($data["Page"])) {
            require($data["Page"].".php");
        }
            
    ?>

    </body>

</html>