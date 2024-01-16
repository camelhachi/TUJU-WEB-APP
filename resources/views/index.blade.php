<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}" />
    <title>Tuju Space</title>
</head>

<body>
    <div class="container">
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <!-- Navigation Bar -->
        <div class="navbar">
            <img src="elements/tujulogo.png" class="logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Locations</a></li>
                    <li><a href="">About Tuju</a></li>
                    <li><a href="">FAQ</a></li>
                </ul>
            </nav>
            <button class="signup">Sign Up</button>
            <img src="elements/shoppingcart.png" class="cart-icon">
            <img src="elements/profile2.png" class="profile-icon">
        </div>
    </div>
    <div class="bigcontainer">
        <!-- Home -->
        <div class="home">
            <h1>Cozy Work, Comfy Stay</h1>
            <div class="overlapboxmarketing">
                <div class="overlapmarketing">
                    <div class="room-selection">
                        <input type="radio" name="roomType" id="hotelRooms" value="hotelRooms" onclick="submitForm()">
                        <label for="hotelRooms" class="room-label">Hotel Room</label>

                        <input type="radio" name="roomType" id="multipurposeRooms" value="multipurposeRooms" onclick="submitForm()">
                        <label for="multipurposeRooms" class="room-label">Multipurpose Room</label>

                        <!-- You don't need the hidden input for selectedOutlet in this form -->

                        <div class="rectanglemark" id="highlight"></div>
                    </div>

                    <div class="component">
                        <div class="framemark4">
                            <div class="framemark5">
                                <img class="img" src="elements/search.png" />
                                <!-- Replace textwrapmark4 with the select element -->
                                <div class="dropdown">
                                    <div class="textwrapmark4">
                                        <form action="{{ route('findRooms') }}" method="get">

                                            <input type="hidden" name="roomType" id="selectedRoomType" value="hotelRooms">
                                            <select id="outlet" name="outlet">
                                                @foreach($outlets as $singleOutlet)
                                                <option value="{{ $singleOutlet }}">{{ $singleOutlet }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bottom">
                            <div class="framemark">
                                <form action="process.php" method="post">
                                    <div class="container">
                                        <label for="checkinDate">Check In: &nbsp;</label>
                                        <input type="date" id="checkinDate" name="checkinDate">
                                    </div>
                            </div>
                            <div class="framemark1">
                                <div class="container">
                                    <label for="checkoutDate">Check Out: &nbsp;</label>
                                    <input type="date" id="checkoutDate" name="checkoutDate">
                                </div>

                                <button type="submit">Find Rooms</button>
                                </form>
                            </div>
                        </div>
                        <div class="result" id="result"></div>
                    </div>
                </div>

                </form>
                <!-- locations -->
                <div id="locations" class="location">
                    <div class="textlocation">Locations</div>
                    <div class="grouplocation">
                        <div class="slider">
                            <div class="images">
                                <input type="radio" name="slide" id="img1" checked>
                                <input type="radio" name="slide" id="img2">
                                <input type="radio" name="slide" id="img3">

                                <img src="elements/location1.png" class="m1" alt="img1">
                                <img src="elements/location2.png" class="m2" alt="img2">
                                <img src="elements/location3.png" class="m3" alt="img3">
                            </div>
                            <div class="dots">
                                <label for="img1"></label>
                                <label for="img2"></label>
                                <label for="img3"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Home About Tuju -->
                <div class="mac">
                    <div id="aboutTuju">
                        <img class="rectangleHome" src="elements/about.webp" />
                        <img class="textwrapHome" src="elements/About Tuju.png" />
                        <div id="aboutHome" class="aboutHome">
                            <section class="accordion">
                                <input type="checkbox" name="collapse" id="handle1" checked="checked">
                                <h2 class="handle">
                                    <label for="handle1">&ensp;&ensp;&ensp;Lokasi Adalah Segalanya</label>
                                </h2>
                                <div class="content">
                                    <p> Kenyamanan Sahabat TUJU selalu menjadi yang utama!
                                        Itulah mengapa semua akomodasi kami memiliki lokasi strategis serta berjarak dekat
                                        dari perkantoran dan pusat keramaian yang sering dikunjungi seperti supermarket,
                                        rumah makan, transportasi umum, dan Rumah Sakit, sehingga aktivitas Sahabat TUJU tetap dapat berjalan dengan mudah.
                                    </p>
                                </div>
                            </section>
                            <section class="accordion">
                                <input type="checkbox" name="collapse2" id="handle2">
                                <h2 class="handle">
                                    <label for="handle2">&ensp;&ensp;&ensp;&ensp;&ensp;Nyaman Dan Bersih</label>
                                </h2>
                                <div class="content">
                                    <p>Akomodasi yang kami sediakan memiliki berbagai fasilitas demi kenyamanan setiap kunjungan Sahabat TUJU,
                                        seperti ruang kamar yang selalu bersih, tersedianya air hangat di kamar mandi, Internet WiFi (nirkabel)
                                        dan sarana TV di tiap kamarnya. Serta Meeting Room berkapasitas 10 orang yang dapat digunakan,
                                        lengkap dengan tempat bekerja yang bersih dan nyaman di area Common Room.</p>
                                </div>
                            </section>
                            <section class="accordion">
                                <input type="checkbox" name="collapse2" id="handle3">
                                <h2 class="handle">
                                    <label for="handle3">&ensp;&ensp;&ensp;Terjangkau Bagi Semua</label>
                                </h2>
                                <div class="content">
                                    <p> Dengan standar kualitas yang sangat baik, namun tetap dengan harga yang terjangkau,
                                        akomodasi kami tidak hanya menjadi pilihan yang smart, namun juga menjadi TUJUan tempat
                                        tinggal yang tepat bagi Sahabat TUJU. Hanya melalui sebuah aplikasi website,
                                        akan memudahkan Sahabat TUJU dalam melakukan pemesanan akomodasi terbaik dengan cepat.
                                        Kami juga menerapkan Kebijakan Syariah dengan tujuan memberikan keamanan dan kenyamanan bagi tamu dan lingkungan.</p>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- Frequently Asked Questions -->
                <div id="faq" class="mac2">
                    <img class="freqask" src="elements/faq.png" />
                    <div class="framewrapfaq">
                        <div class="div6faq">
                            <div class="div7faq">
                            </div>
                        </div>
                    </div>
                    <div class="FAQU">
                        <button class="faq">Section 1</button>
                        <div class="panelfaq">
                            <p>Check-In pada pukul 14:00, sedangkan Check-Out pada pukul 12:00.</p>
                        </div>
                        <button class="faq1">Section 2</button>
                        <div class="panelfaq">
                            <p>
                                Jika tiba sebelum waktunya Check-In, tamu akan dikenakan biaya tambahan:

                                Early Check-In di pukul 09:00 WIB, akan dikenakan charge 25% dari publish rate
                                Early Check-In di pukul 06:00 WIB, akan dikenakan charge 50% dari publish rate
                                Early Check-In sebelum pukul 06:00, akan dikenakan charge kamar satu malam</p>
                        </div>

                        <button class="faq1">Section 3</button>
                        <div class="panelfaq">
                            <p>Jika Check-Out melewati waktu yang telah ditentukan, tamu akan dikenakan biaya tambahan:

                                Late Check-Out di pukul 15:00 WIB, akan dikenakan charge 25% dari publish rate
                                Late Check-Out di pukul 18:00 WIB, akan dikenakan charge 25% dari publish rate
                                Late Check-Out setelah pukul 18:00 WIB, akan dikenakan charge 25% dari publish rate</p>
                        </div>
                        <button class="faq2">Section 4</button>
                        <div class="panelfaq">
                            <p>Properti ini tidak menerima tamu lawan jenis yang tidak atau belum menikah dalam satu kamar. Resepsionis dapat meminta informasi berupa surat nikah atau kartu identitas yang menunjukkan alamat yang sama. Hal ini dilakukan sebagai usaha untuk mencegah pelanggaran peraturan Syariah. Mohon pengertiannya. Mari kita saling menghormati demi kenyamanan bersama.</p>
                        </div>
                    </div>
                    <!-- footer -->
                    <footer class="footer">
                        <div class="overlapfooter">
                            <div class="elementfooter">
                                <p class="copyright">
                                    <span class="span">Cozy </span>
                                    <span class="textwrap5foot">Work</span>
                                    <span class="span">, Comfy </span>
                                    <span class="textwrap5foot">Stay</span>
                                </p>
                                <img class="socialmedia" src="elements/Social Media Container.png" />
                            </div>
                            <img class="logofooter" src="elements/tujulogo.png" />
                        </div>
                        <div class="div1foot">
                            <div class="footer-left">Copyright © 2020 Tuju</div>
                            <p class="footer-right">TUJU Group is affiliated under PT. Berkah Mulia Putra</p>
                        </div>
                        <img class="line-stroke-6" src="elements/Line 135 (Stroke).png" />
                        <div class="div2foot">
                            <div class="div3foot">
                                <div class="textwrapfoot">About Tuju</div>
                                <div class="textwrapfoot2">FAQ</div>
                                <div class="textwrapfoot2">Terms&amp; Conditions</div>
                                <div class="textwrapfoot2">Privacy Policy</div>
                            </div>
                            <div class="div3foot">
                                <div class="textwrapfoot">Our Hotels</div>
                                <div class="textwrapfoot2">Wijaya Kusuma Homes Syariah</div>
                                <div class="textwrapfoot2">Abuserin Syariah</div>
                                <div class="textwrapfoot2">Arteri Pods</div>
                            </div>
                            <div class="div3foot">
                                <div class="textwrapfoot">Contact Us</div>
                                <div class="div4foot">
                                    <img class="phone" src="elements/Email.png" />
                                    <div class="textwrapfoot3">contact@company.com</div>
                                </div>
                                <div class="div4foot">
                                    <img class="phone" src="elements/Phone.png" />
                                    <div class="textwrapfoot4">(414) 687 - 5892</div>
                                </div>
                            </div>
                        </div>
                        <img class="orange" src="elements/Vector.png" />
                    </footer>
                </div>
                <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>