<!DOCTYPE html>
<!-- Midtrans html-->
<html>

<head>
  <link rel="stylesheet" href="globals.css" />
  <link rel="stylesheet" href="<?php echo e(asset('css/midtrans.css')); ?>" />
</head>

<body>
  <form method="POST" action="<?php echo e(route('confirmPayment')); ?>">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="hotelRoomID" value="<?php echo e(session('scart')[0]['hotelRoomID']); ?>">
    <input type="hidden" name="totalPaid" value="<?php echo e(session('total_price')); ?>">

    <div class="macbook-pro">
      <div class="div">
        <div class="overlap-group">
          <div class="overlap">
            <img class="card" src="elements/Card.png" />
            <div class="text-wrapper">Total:</div>
            <!-- Display the dynamically retrieved total price from session -->
            <div class="text-wrapper-2">Rp.<?php echo e(number_format(session('total_price'), 2)); ?></div>
            <div class="includes-taxes-fees">includes taxes &amp; fees</div>
          </div>

          <div class="text-wrapper-3">Payment Methods</div>
          <div class="overlap-2">
            <!-- Display the dynamically retrieved reservation ID from session -->
            <div class="text-wrapper-5">
              <?php if(session('scart') && count(session('scart')) > 0): ?>
              Hotel Room ID: <?php echo e(session('scart')[0]['hotelRoomID']); ?> ReservationID #<?php echo e(session('reservation_id')); ?>

              <?php else: ?>
              No items in the cart
              <?php endif; ?>
            </div>
            <div class="div-wrapper">
              <button type="submit" class="text-wrapper-4">Confirm Payment</button>
            </div>
  </form>

  <img class="logo-TUJU-lock" src="elements/Logo-TUJU_Lock-02 3.png" />
  </div>

  <!-- Add back the missing images -->
  <div class="text-wrapper-6">Credit/Debit Card</div>
  <div class="text-wrapper-7">E-Wallet</div>
  <div class="text-wrapper-8">Virtual Account</div>
  <div class="credit-debit-logos">
    <img class="visa" src="elements/Visa.jpg" />
    <img class="master-card" src="elements/MasterCard.jpg" />
    <img class="bca" src="elements/bca 1.png" />
    <img class="mandiri" src="elements/mandiri 1.png" />
  </div>
  <div class="ewallet-logos">
    <img class="qris" src="elements/qris 1.png" />
    <img class="gopay" src="elements/gopay 1.png" />
    <img class="ovologo" src="elements/ovologo 1.png" />
  </div>
  <div class="virtual-account">
    <img class="bank-bri" src="elements/bank bri 1.png" />
    <img class="bni-logo" src="elements/bni logo 1.png" />
    <img class="img" src="elements/bca 1.jpg" />
  </div>
  <!-- Rest of your HTML code -->
  </div>

  <div class="text-wrapper-9" id="countdown">00:30</div>
  </div>
  </div>
  <?php if(session('message')): ?>
    <script>
        alert("<?php echo e(session('message')); ?>");
    </script>
<?php endif; ?>
  <script src="<?php echo e(asset('js/countdown.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/midtrans.blade.php ENDPATH**/ ?>