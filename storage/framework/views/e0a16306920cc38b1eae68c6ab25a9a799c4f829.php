<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/form.css')); ?>" />
    <title>Form</title>
</head>

<body>
    <!-- Logo -->
    <div class="tujulogo">
        <img class="logo" src="elements/tujulogo.png" />
    </div>
    <div class="formcontent">
        <!-- kiri -->
        <div class="column1">
            <!-- Contact details -->
            <div class="contactdetails">
                <div class="details">
                    <div class="text-wrapper">Contact details</div>
                    <div class="row1">
                        <label for="name" class="text-wrapper-2">Name</label><br>
                        <!-- Pre-fill the 'Name' input field with customer data -->
                        <input type="text" id="name" class="rectangle" value="<?php echo e(Session::get('customerName')); ?>" />
                    </div>
                    <div class="row2">
                        <div class="col1">
                            <label for="phone" class="text-wrapper-3">Phone Number</label><br>
                            <!-- Pre-fill the 'Phone Number' input field with customer data -->
                            <input type="tel" id="phone" class="rectangle-2" value="<?php echo e(Session::get('customerPhoneNumber')); ?>" />
                        </div>
                        <div class="col2">
                            <label for="email" class="text-wrapper-4">Email</label><br>
                            <!-- Pre-fill the 'Email' input field with customer data -->
                            <input type="email" id="email" class="rectangle-3" value="<?php echo e(Session::get('customerEmail')); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="title">
                Guest Information
            </div>
            <form action="<?php echo e(route('processPayment')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <?php
                // Calculate the subtotal
                $subtotal = 0;
                foreach(session('scart') as $item) {
                $subtotal += $item['price'];
                }

                // Set session data for total price and reservation ID
                session(['total_price' => $subtotal, 'reservation_id' => Session::get('reservationID')]);
                ?>
                <input type="hidden" name="hotelRoomID" value="<?php echo e($item['hotelRoomID']); ?>">
                <input type="hidden" name="total_price" value="<?php echo e($subtotal); ?>">
                <input type="hidden" name="reservation_id" value="<?php echo e(Session::get('reservationID')); ?>">
                <!-- Guest info -->
                <?php $__currentLoopData = session('scart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php for($i = 0; $i < $item['quantity']; $i++): ?>
                <div class="guest">
                    <div class="guestbox">
                        <div class="guestcontent">

                            <!-- Generate HTML structure based on cart item -->
                            <div class="col3">
                                <div class="num"><?php echo e($index + 1); ?></div>
                            </div>
                            <div class="col1">
                                <div class="rname"><?php echo e($item['roomType']); ?><?php echo e($item['hotelRoomID']); ?></div>
                                <div class="outlet"><?php echo e($item['outletName']); ?></div>
                                <img class="img" src="<?php echo e(asset('elements/tuju.jpg')); ?>" />
                            </div>
                            <div class="col4">
                                <div class="text-wrapper-9">Check-In:
                                    <div class="text-wrapper-91"><?php echo e($item['checkinDate']); ?></div>
                                </div>
                                <div class="text-wrapper-10">Check-Out:
                                    <div class="text-wrapper-101"><?php echo e($item['checkoutDate']); ?></div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="text-wrapper-6">Guest Information "<?php echo e(Session::get('reservationID')); ?>" </div>
                                <label for="guestName[]" class="text-wrapper-7">Name</label>
                                <input type="text" name="guestName[]" class="rectangle-4" required />
                                <label for="phoneNumber[]" class="text-wrapper-8">Phone Number</label>
                                <input type="text" name="phoneNumber[]" class="rectangle-5" required />
                            </div>
                            <!-- Close the form tag for each guest -->

                        </div>
                    </div>
                </div>
                <?php endfor; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Kanan -->
    <div class="column2">
        <div class="col-2">
            <div class="summary">
                <div class="summary-box">
                    <div class="sumboxtext">
                        <div class="sumtext">Reservation Summary :</div>
                        <!-- Calculate the subtotal dynamically -->
                        <?php
                        $subtotal = 0;
                        foreach(session('scart') as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                        }
                        ?>
                        <div class="subtot">Rp.<?php echo e(number_format($subtotal, 2)); ?></div>
                    </div>
                    <button class="payment">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>
    </form>

</body>

</html><?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/form.blade.php ENDPATH**/ ?>