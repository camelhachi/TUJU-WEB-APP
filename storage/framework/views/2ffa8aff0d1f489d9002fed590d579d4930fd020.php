

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?php echo e(asset('css/signin.css')); ?>" />
</head>
<body>
    <!-- background -->
    <div class="si">
        
        <div class="overlap-wrapper">
            <div class="overlap">
                <img class="bg" src="elements/A6309979 1.png" />
                <!-- navbar -->
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
                <!-- sign-in form  -->
                <div class="box">
                    <div class="overlapbox">
                        <div class="framebox1">
                            <div class="framebox2">
                            <form method="post" action="<?php echo e(route('signin')); ?>">
                            <?php echo csrf_field(); ?>
                                <div class="textwrapbox">Username</div>
                                <input type="text" id="name" name="name" class="rectanglebox" required>

                            </div>

                            <div class="framebox2">
                                <div class="textwrapbox">Password</div>
                                <input type="password" id="password" name="password" class="rectanglebox" required>
                            </div>

                        </div>
                            <div class="groupbox">
                                <div class="overlapbox2">
                                    <div class="textwrapbox2">
                                        <input type="submit" value="Sign in" name="signin">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <p class="signup">
                            <span class="span">Don’t have an account?&nbsp;&nbsp;</span>
                            <a href="" class="textwrapbox3">Sign Up here.</a>
                        </p>
                    </div>
                    <div class="textwrapbox4">Sign In</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\laravelfinal\resources\views/signin.blade.php ENDPATH**/ ?>