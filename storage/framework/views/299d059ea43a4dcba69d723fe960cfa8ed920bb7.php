<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/signup.css')); ?>">
    <title>Sign Up</title>
</head>
<body>
    <!-- Background -->
    <div class="si">
        <div class="overlap-wrapper">
            <div class="overlap">
                <img class="bg" src="elements/signupbg.png" />

                <!-- Navbar -->
                <div class="navwrapper">
                    <div class="navbar">
                        <div class="overlapnavbar">
                            <div class="rectanglenavbar"></div>
                            <div class="divnavbar">
                                <div class="div2navbar">
                                    <img class="logo" src="elements/tujulogo.png" />
                                    <div class="navbartext">
                                        <div class="textwrapnavbar">Home</div>
                                        <div class="textwrapnavbar2">Locations</div>
                                        <div class="textwrapnavbar2">About Tuju</div>
                                        <div class="textwrapnavbar2">FAQ</div>
                                    </div>
                                </div>
                                <div class="signin">
                                    <div class="group">
                                        <div class="overlapgroupnavbar">
                                            <div class="textwrapnavbar3">Sign Up</div>
                                        </div>
                                    </div>
                                    <img class="bell" src="elements/shoppingcart.png" />
                                    <img class="notification" src="elements/profile.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="box">
                    <div class="overlapbox">
                        <div class="framebox1">
                            <!-- Form with Blade syntax -->
                            <form action="<?php echo e(route('customer.store')); ?>" method="post">
                                <?php echo csrf_field(); ?>

                                <div class="framebox2">
                                    <div class="textwrapbox">Name</div>
                                    <input type="text" id="customerName" name="customerName" class="rectanglebox" required>
                                </div>

                                <div class="framebox2">
                                    <div class="textwrapbox">Phone Number</div>
                                    <input type="tel" id="phoneNumber" name="phoneNumber" class="rectanglebox" required>
                                </div>

                                <div class="framebox2">
                                    <div class="textwrapbox">Email</div>
                                    <input type="email" id="emailAddress" name="emailAddress" class="rectanglebox" required>
                                </div>

                                <div class="framebox2">
                                    <div class="textwrapbox">Username</div>
                                    <input type="text" id="userName" name="userName" class="rectanglebox" required>
                                </div>

                                <div class="framebox2">
                                    <div class="textwrapbox">Password</div>
                                    <input type="password" id="password" name="password" class="rectanglebox" required>
                                </div>

                                <div class="framebox2">
                                    <div class="textwrapbox">Confirm Password</div>
                                    <input type="password" id="confirm_password" name="confirm_password" class="rectanglebox" required>
                                </div>

                                <div class="groupbox">
                                    <div class="overlapbox2">
                                        <div class="textwrapbox2">
                                            <button type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <p class="signup">
                            <span class="span">Already have an account?&nbsp;</span>
                            <a href="" class="textwrapbox3">Sign in here.</a>
                        </p>
                    </div>
                </div>
                <div class="textwrapbox4">Sign Up</div>
            </div>
        </div>
    </div>

    <!-- Include your JavaScript -->
    <script src="script/script.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/signup.blade.php ENDPATH**/ ?>