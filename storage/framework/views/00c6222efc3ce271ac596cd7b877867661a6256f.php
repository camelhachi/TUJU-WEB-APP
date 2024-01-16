<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/options.css')); ?>" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <title>Options</title>
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
    <!-- Cover -->
    <div class="cover">
        <img src="<?php echo e(asset('elements/optionbg.png')); ?>" alt="" class="bgcover">
    </div>
    <!-- filter -->
    <div class="filter">
        <div class="filter-box">
            <!-- room type -->

            <!-- location -->
            <div class="room-type-box">
                <div class="room-type">
                    <form action="<?php echo e(route('findRooms')); ?>" method="get">
                        <?php echo csrf_field(); ?> <!-- Add CSRF token for form submission -->
                        <select class="textwrapmark4" name="roomType">
                            <option value="option1">Room Type..</option>
                            <option value="hotelRooms" <?php echo e(request()->input('roomType') == 'hotelRooms' ? 'selected' : ''); ?>>
                                Hotel Room
                            </option>
                            <option value="multipurposeRooms" <?php echo e(request()->input('roomType') == 'multipurposeRooms' ? 'selected' : ''); ?>>
                                Multipurpose Room
                            </option>
                        </select>
                        <select class="textwrapmark4" name="outlet">
                            <option value="option1">Search Locations..</option>
                            <?php $__currentLoopData = $outlets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleOutlet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($singleOutlet); ?>" <?php echo e(request()->input('selectedOutlet') == $singleOutlet ? 'selected' : ''); ?>>
                                <?php echo e($singleOutlet); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <button type="submit" class="search1">
                            <img src="<?php echo e(asset('elements/search.png')); ?>" class="search">
                        </button>
                        <input type="hidden" name="checkinDate" value="<?php echo e(request()->input('checkinDate')); ?>">
                        <input type="hidden" name="checkoutDate" value="<?php echo e(request()->input('checkoutDate')); ?>">
                    </form>
                </div>
            </div>
            <!-- checkin -->
            <form action="<?php echo e(route('addToCart')); ?>" method="post" id="addToCartForm">
                <?php echo csrf_field(); ?>
                <div class="framemark">
                    <div class="container">
                        <label for="checkinDate">Check in: &nbsp;</label>
                        <input type="date" id="checkinDate" name="checkinDate" value="<?php echo e(request()->input('checkinDate')); ?>">
                    </div>

                    <div class="container">
                        <label for="checkoutDate">Check Out: &nbsp;</label>
                        <input type="date" id="checkoutDate" name="checkoutDate" value="<?php echo e(request()->input('checkoutDate')); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="main">
        <div class="row">
            <?php if($rooms->isEmpty()): ?>
            <p>No rooms available.</p>
            <?php else: ?>
            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="room-card">
                <?php if($selectedRoomType == 'hotelRooms'): ?>
                <img src="<?php echo e(asset('elements/room.png')); ?>" alt="Hotel Room Image">
                <?php elseif($selectedRoomType == 'multipurposeRooms'): ?>
                <img src="<?php echo e(asset('elements/special.png')); ?>" alt="Special Room Image">
                <?php endif; ?>
                <div class="details">
                    <div class="details-name">
                        <input type="hidden" name="roomType" value="<?php echo e($selectedRoomType == 'hotelRooms' ? 'hotelRooms' : 'multipurposeRooms'); ?>">
                        <input type="hidden" name="outletName" value="<?php echo e($room->outletName); ?>">
                        <input type="hidden" name="roomPrice" value="<?php echo e($room->roomPrice); ?>">
                        <input type="hidden" name="quantity" value="<?php echo e($room->quantity); ?>">
                        <input type="hidden" name="hotelRoomID" value="<?php echo e($selectedRoomType == 'hotelRooms' ? $room->hotelRoomID : $room->specialRoomID); ?>">
                        <input type="hidden" name="checkinDate" value="<?php echo e(request()->input('checkinDate')); ?>">
                        <input type="hidden" name="checkoutDate" value="<?php echo e(request()->input('checkoutDate')); ?>">

                        <div class="pname">
                            <?php if($selectedRoomType == 'hotelRooms'): ?>
                            <?php echo e($room->roomType . ' - ID: ' . $room->hotelRoomID); ?>

                            <?php elseif($selectedRoomType == 'multipurposeRooms'): ?>
                            <?php echo e($room->roomType . ' - ID: ' . $room->specialRoomID); ?>

                            <?php endif; ?>
                        </div>

                        <div class="outlet">
                            <?php echo e($selectedRoomType == 'hotelRooms' ?  $room->outletName : $room->outletName); ?>

                        </div>
                    </div>

                    <div class="avl"> Room Availability: 1</div>
                    <div class="fac">
                        <div class="fac1">
                            <i class='bx bx-baguette'></i>
                            <span class="wifi">
                                <?php echo e($selectedRoomType == 'hotelRooms' ? 'Breakfast Included' : ''); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="details2">
                    <div class="details2">
                      
                        <div class="price">Rp <?php echo e($room->roomPrice); ?></div>
                    
                    </div>
                    <form action="<?php echo e(route('addToCart')); ?>" method="post" class="addToCartForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="roomPrice" value="<?php echo e($selectedRoomType == 'hotelRooms' ? $room->roomPrice : $room->roomPrice); ?>">
                        <input type="hidden" name="roomType" value="<?php echo e($selectedRoomType == 'hotelRooms' ? 'hotelRooms' : 'multipurposeRooms'); ?>">
                        <input type="hidden" name="outletName" value="<?php echo e($room->outletName); ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="hotelRoomID" value="<?php echo e($selectedRoomType == 'hotelRooms' ? $room->hotelRoomID : $room->specialRoomID); ?>">
                        <input type="hidden" name="checkinDate" value="<?php echo e(request()->input('checkinDate')); ?>">
                        <input type="hidden" name="checkoutDate" value="<?php echo e(request()->input('checkoutDate')); ?>">
                        <input type="hidden" name="quantity" id="quantityInput<?php echo e($index); ?>" value="0">
                        <button type="submit" class="addcart">Add to Cart</button>
                    </form>
                    <form action="<?php echo e(route('bookingForm')); ?>" method="get" class="booking-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="hotelRoomID" value="<?php echo e($room->hotelRoomID); ?>">
                        <input type="hidden" name="quantity" id="quantityInput<?php echo e($index); ?>" value="0">
                        <input type="hidden" name="roomType" value="<?php echo e($selectedRoomType); ?>">
                        <input type="hidden" name="outletName" value="<?php echo e($room->outletName); ?>">
                        <input type="hidden" name="checkinDate" value="<?php echo e(request()->input('checkinDate')); ?>">
                        <input type="hidden" name="checkoutDate" value="<?php echo e(request()->input('checkoutDate')); ?>">
                        <button type="submit" class="book">Book</button>
                    </form>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?php echo e(asset('js/plus-minus.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/options.blade.php ENDPATH**/ ?>