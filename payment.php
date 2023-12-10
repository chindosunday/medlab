<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Medilab Bootstrap Template - Index</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />

  <!-- =======================================================
  * Template Name: Medilab
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Make a Payment</h3>

              <form id="paymentForm">
                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" id="email-address" required />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="tel" id="amount" required />
                </div>
                <div class="form-group">
                  <label for="first-name">First Name</label>
                  <input type="text" id="first-name" />
                </div>
                <div class="form-group">
                  <label for="last-name">Last Name</label>
                  <input type="text" id="last-name" />
                </div>
                <div class="form-submit">
                  <button type="submit" onclick="payWithPaystack()"> Pay </button>
                </div>
              </form>

              <!-- <form id="paymentForm">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="first_name" class="form-control" id="first-name" placeholder="First Name" />
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="text" class="form-control" name="last_name" id="last-name" placeholder="Last Name" />
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="email" class="form-control" name="email" id="email-address" placeholder="Email Adress" />
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="password" id="amount" placeholder="Amount" />
                </div>

                <div class="my-3">
                  <button type="submit" name="pay" onclick="payWithPaystack()">Pay</button>
                  <span>Existing User?
                    <a href="index.php" style="color: red">
                      Sign in here</a></span>
                </div> 
              </form>-->
            </div>
          </div>
        </div>
    </section>
    <!-- End Why Us Section -->
  </main>

  <!-- End #main -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://js.paystack.co/v1/inline.js"></script>


  <script>
    var paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener('submit', payWithPaystack, false);

    function payWithPaystack(e) {
      e.preventDefault();
      var handler = PaystackPop.setup({
        key: 'pk_test_73bdc14d9dbc2675722cc2ad4590a8a7cf430cfe', // Replace with your public key
        email: document.getElementById('email-address').value,
        amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
        currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
        ref: Math.floor((Math.random() * 10000000) + 1), // Replace with a reference you generated
        callback: function(response) {
          //this happens after the payment is completed successfully
          var reference = response.reference
          alert('Payment complete! Reference: ' + reference);
          // Make an AJAX call to your server with the reference to verify the transaction
          window.location.href = 'http://localhost/medilab/verifytransaction.php?ref=' + response.reference;
        },
        onClose: function() {
          alert('Transaction was not completed, window closed.');
        },
      });
      handler.openIframe();
    }
  </script>

</body>

</html>