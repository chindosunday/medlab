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
        key: 'pk_test_da94e27ff3fa3950bddde2d50d77ddf9740c88b6', // Replace with your public key
        email: document.getElementById('email-address').value,
        first_name: document.getElementById('first-name').value,
        last_name: document.getElementById('last-name').value,
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