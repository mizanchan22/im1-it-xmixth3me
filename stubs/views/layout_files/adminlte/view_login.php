<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?= link_tag(base_url("assets/img/favicon.png")); ?>
  <?= link_tag(base_url("assets/img/apple-touch-icon.png")); ?>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <?= link_tag(base_url("assets/vendor/bootstrap/css/bootstrap.min.css")); ?>
  <?= link_tag(base_url("assets/vendor/bootstrap-icons/bootstrap-icons.css")); ?>
  <?= link_tag(base_url("assets/vendor/boxicons/css/boxicons.min.css")); ?>
  <?= link_tag(base_url("assets/vendor/quill/quill.snow.css")); ?>
  <?= link_tag(base_url("assets/vendor/quill/quill.bubble.css")); ?>
  <?= link_tag(base_url("assets/vendor/remixicon/remixicon.css")); ?>
  <?= link_tag(base_url("assets/vendor/simple-datatables/style.css")); ?>

  <!-- Template Main CSS File -->
  <?= link_tag(base_url("assets/css/style.css")); ?>

  <style>
  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    z-index: -1;
  }
  </style>

  <style>
  .glass-card {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
    color: #fff;
  }

  .glass-card .form-label,
  .glass-card .form-control,
  .glass-card .card-title,
  .glass-card p {
    color: #fff;
  }

  .glass-card .form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #fff;
  }

  .glass-card .form-control::placeholder {
    color: rgba(255,255,255,0.7);
  }

  .glass-card .alert {
    background-color: rgba(255, 0, 0, 0.4);
    border: none;
    color: #fff;
  }

  .glass-card .btn-primary {
    background: rgba(0, 123, 255, 0.6);
    border: none;
    backdrop-filter: blur(5px);
  }

  .glass-card .btn-primary:hover {
    background: rgba(0, 123, 255, 0.8);
  }

  .credits-footer {
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(5px);
    color: #fff;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
  }

  .credits-footer a {
    color: #ffc107;
    text-decoration: none;
  }

  .credits-footer a:hover {
    text-decoration: underline;
  }
</style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo_mardi.png" alt="">
                  <span class="d-none d-lg-block">Project</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3 glass-card">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Log Masuk Akaun</h5>
                    <p class="text-center small">Masukkan ID Pengenalan & Kata Laluan anda untuk log masuk</p>
                  </div>

                  <?php  
                    $this->request = \Config\Services::request();
                    if($this->request->getPost('btn_submit')):?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                    <?php endif ?>

                    <?php if(!empty($_SESSION['Mesej'])):?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['Mesej'];?>
                    </div>
                    <?php endif ?>

                  <?php echo form_open('login/auth',array('id'=>'','class'=>'row g-3','csrf_id' => 'my-id'))?>
                    
                    <div class="col-12">
                      <label for="txt_username" class="form-label">Pengenalan</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="txt_username" class="form-control" id="txt_username">
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="txt_password" class="form-label">Katalaluan</label>
                      <input type="password" name="txt_password" class="form-control" id="txt_password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <input class="w-100 btn btn-lg btn-primary" type="submit" name="btn_submit" value="Masuk">
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Belum ada akaun? <a href="pages-register.html">Daftar Pengguna</a></p>
                    </div>

                  <?php echo form_close();?>

                </div>
              </div>

              <footer class="credits-footer text-center py-3">
                <div class="container">
                  <small class="d-block">
                    © <?= date('Y') ?> Institut Penyelidikan Dan Kemajuan Pertanian Malaysia
                  </small>
                </div>
              </footer>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?= script_tag(base_url("assets/vendor/apexcharts/apexcharts.min.js")); ?>
  <?= script_tag(base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")); ?>
  <?= script_tag(base_url("assets/vendor/chart.js/chart.umd.js")); ?>
  <?= script_tag(base_url("assets/vendor/echarts/echarts.min.js")); ?>
  <?= script_tag(base_url("assets/vendor/quill/quill.js")); ?>
  <?= script_tag(base_url("assets/vendor/simple-datatables/simple-datatables.js")); ?>
  <?= script_tag(base_url("assets/vendor/tinymce/tinymce.min.js")); ?>
  <?= script_tag(base_url("assets/vendor/php-email-form/validate.js")); ?>

  <!-- Template Main JS File -->
  <?= script_tag(base_url("assets/js/main.js")); ?>

</body>

</html>