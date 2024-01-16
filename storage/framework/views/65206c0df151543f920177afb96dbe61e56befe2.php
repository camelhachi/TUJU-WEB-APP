<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/scart.css')); ?>" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Shopping</title>
</head>

<body>
    <div class="container">
        <!-- Navigation Bar -->
        <div class="navbar">
            <img src="<?php echo e(asset('elements/tujulogo.png')); ?>" class="logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Locations</a></li>
                    <li><a href="">About Tuju</a></li>
                    <li><a href="">FAQ</a></li>
                </ul>
            </nav>
            <a href="/signup">
                <button class="signup">Sign Up</button>
            </a>
            <a href="<?php echo e(route('scart', ['cartItems' => session('scart')])); ?>" id="cartLink">
                <img src="<?php echo e(asset('elements/shoppingcart.png')); ?>" class="cart-icon">
            </a>
            <img src="<?php echo e(asset('elements/profile.png')); ?>" class="profile-icon">
        </div>
    </div>

    <div class="top">
        <h1>My Shopping Cart</h1>
    </div>

    <!-- Cart content -->
    <div class="cart-content">
    
        <?php if(session('scart') && count(session('scart')) > 0): ?>
        <!-- Content for each item in the cart -->
        <?php $__currentLoopData = session('scart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col1">
            <div class="contents">
                <form action="<?php echo e(route('deleteCartItem')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="index" value="<?php echo e($index); ?>">
                    <!-- The content of each item in the cart -->
                    <div class="overlap-3">
                        <div class="rectangle-3"></div>
                        <div class="rectangle-4"></div>

                        <div class="text-wrapper-8">Rp. <?php echo e(number_format($item['price'], 2)); ?></div>
                        <img class="img" src="<?php echo e(asset('elements/room.png')); ?>" />
                        <cinput type="checkbox" id="checkbox" class="rectangle-5" />
                        <div class="text-wrapper-9">Check-In:
                            <div class="text-wrapper-91"> <?php echo e($item['checkinDate']); ?></div>
                        </div>
                        <div class="text-wrapper-10">Check-Out:
                            <div class="text-wrapper-101"><?php echo e($item['checkoutDate']); ?></div>
                        </div>


                        <div class="text-wrapper-11">ID : <?php echo e($item['hotelRoomID']); ?> | <?php echo e($item['roomType']); ?> #<?php echo e($reservationID); ?></div>
                        <div class="text-wrapper-12"> <?php echo e($item['quantity']); ?> x <?php echo e($item['roomType']); ?></div>
                        <div class="text-wrapper-13"><?php echo e($item['outletName']); ?></div>
                    </div>
                    <button type="submit" class="del"><i class='bx bxs-trash-alt'></i>Delete Item</button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- The summary section -->
        <div class="col2">
            <div class="summary">
                <div class="summary-box">
                    <div class="sumboxtext">
                        <div class="sumtext">Subtotal :</div>
                        <!-- Use a variable to calculate the subtotal -->
                        <?php
                        $subtotal = 0;
                        foreach(session('scart') as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                        }
                        ?>
                        <div class="subtot">Rp. <?php echo e(number_format($subtotal, 2)); ?></div>
                    </div>
                    <button class="payment" onclick="window.location='/form'">Proceed to Checkout</button>
                </div>
            </div>
        </div>
        <?php else: ?>
        <!-- Message when the cart is empty -->
        <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/scart.blade.php ENDPATH**/ ?>