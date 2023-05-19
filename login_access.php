<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css" />

  <style>
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 15%;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="text-center">
    <img src="Image\Chmsu.png" alt="chmsu_logo" class="center">
    <br>
    <h2>Carlos Hilado State University Internship Management Support System Access Panel</h2>
  </div>

  <div class="row justify-content-center mt-5">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Student Access</h5>
          <p class="card-text">This links to the Student IMS Module, for CHMSU students only</p>
          <a href="student_login.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Industry Access</h5>
          <p class="card-text">This links to the Industry IMS Module, for CHMSU Industry Partners only</p>
          <a href="industry_login.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Staff Access</h5>
          <p class="card-text">This links to the Staff IMS Module, for CHMSU staff only</p>
          <a href="staff_login.php" class="btn btn-primary">Access</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
