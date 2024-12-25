<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ProgAccum - Welcome</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" type="image/x-icon" href="{{'img/logo/navican.png'}}">




    <!-- Vendor CSS Files -->
    <link href={{ asset("welcome/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
    <link href={{ asset("welcome/vendor/bootstrap-icons/bootstrap-icons.css")}} rel="stylesheet">
    <!-- <link href={{ asset("welcome/vendor/glightbox/css/glightbox.min.css")}} rel="stylesheet"> -->
    <!-- <link href={{ asset("welcome/vendor/swiper/swiper-bundle.min.css")}} rel="stylesheet"> -->

    <!-- Main CSS File -->
    <link href={{ asset("welcome/css/main.css")}} rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src={{ asset("welcome/img/logo.png")}} alt=""> -->
                <h1 class="sitename">ProgAccum</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>

                    <li> <a
                            href="{{ route('login') }}" style="margin-right: 20px;">
                            Log in
                        </a></li>


                    <li>
                        <a
                            href="{{ route('register') }}">
                            Register
                        </a>
                    </li>


                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src={{ asset("welcome/img/hero-bg-2.jpg")}} alt="" class="hero-bg">

            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100" style="
    width: 50%;
">
                        <img src={{ asset('img/logo/logoProgacuum.png')}} class="img-fluid animated" alt="">
                    </div>

                    <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                        <h1>Build and Accumulate Your Programming Skills with <span>ProgAccum</span></h1>
                        <p>A platform for programmers to practice and accumulate coding skills. Featuring interactive learning modules, personalized study plans, and real-time coding challenges to help you grow your knowledge and improve your skills.</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started">Get Started</a>

                        </div>
                    </div>

                </div>
            </div>

            <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28 " preserveAspectRatio="none">
                <defs>
                    <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="wave1">
                    <use xlink:href="#wave-path" x="50" y="3"></use>
                </g>
                <g class="wave2">
                    <use xlink:href="#wave-path" x="50" y="0"></use>
                </g>
                <g class="wave3">
                    <use xlink:href="#wave-path" x="50" y="9"></use>
                </g>
            </svg>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-xl-center gy-5">

                    <div class="col-xl-5 content">
                        <h3>About Us</h3>
                        <h2>Developing a Personalized Learning System</h2>
                        <p>We provide modern and convenient learning solutions, integrating technology to deliver the best user experience. From managing learning progress to innovative support tools, we are committed to accompanying you on your journey of knowledge development.</p>
                        <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="col-xl-7">
                        <div class="row gy-4 icon-boxes">

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon-box">
                                    <i class="bi bi-buildings"></i>
                                    <h3>System Management</h3>
                                    <p>Support for managing user accounts, question packages, and personalized features.</p>
                                </div>
                            </div> <!-- End Icon Box -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-clipboard-pulse"></i>
                                    <h3>Smart Learning</h3>
                                    <p>Provide tools to track learning progress and suggest tailored improvements.</p>
                                </div>
                            </div> <!-- End Icon Box -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-command"></i>
                                    <h3>Creative Tools</h3>
                                    <p>Enhance productivity with features for content creation and collaboration.</p>
                                </div>
                            </div> <!-- End Icon Box -->

                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <h3>Data Insights</h3>
                                    <p>Track user engagement and learning patterns to improve efficiency and outcomes.</p>
                                </div>
                            </div> <!-- End Icon Box -->

                        </div>
                    </div>

                </div>
            </div>

        </section>
        <!-- /About Section -->



        <!-- Details Section -->
        <section id="details" class="details section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Details</h2>
                <div><span>Check Our</span> <span class="description-title">Details</span></div>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                        <img src={{ asset("welcome/img/details-1.png") }} class="img-fluid" alt="Feature 1">
                    </div>
                    <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                        <h3>Enhance Your Learning with Innovative Tools</h3>
                        <p class="fst-italic">
                            Our platform is designed to simplify your learning experience and empower you with modern features.
                        </p>
                        <ul>
                            <li><i class="bi bi-check"></i><span> Easy-to-use interface for effective navigation and learning.</span></li>
                            <li><i class="bi bi-check"></i><span> Personalized suggestions to meet your individual learning needs.</span></li>
                            <li><i class="bi bi-check"></i><span> Reliable system ensuring secure and efficient operations.</span></li>
                        </ul>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
                        <img src={{ asset("welcome/img/details-01.png") }} class="img-fluid" alt="Feature 2">
                    </div>
                    <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
                        <h3>Comprehensive Solutions for Learning Management</h3>
                        <p class="fst-italic">
                            Unlock the full potential of your learning experience with our comprehensive tools and features.
                        </p>
                        <p>
                            Track your progress, collaborate with peers, and access a wide range of resources tailored to your needs. Our platform ensures seamless and productive engagement throughout your learning journey.
                        </p>
                    </div>
                </div><!-- Features Item -->

            </div>

        </section><!-- /Details Section -->


        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <div><span>Check Our</span> <span class="description-title">Contact</span></div>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>Da Nang, Viet Nam</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>0379147397</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>hoangtungmy123@gmail.com</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                    <div class="col-lg-8">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="200">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">ProgAccum</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Da Nang, Viet Nam</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>0379147397</span></p>
                        <p><strong>Email:</strong> <span>hoangtungmy123@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <img src={{ asset('img/logo/logoProgacuum.png')}} class="img-fluid animated" alt="">

                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Bootslander</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="">ProgAccum</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <!-- <script src={{ asset("welcome/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script> -->
    <!-- <script src={{ asset("welcome/vendor/php-email-form/validate.js")}}></script> -->
    <!-- <script src={{ asset("welcome/vendor/aos/aos.js")}}></script> -->
    <!-- <script src={{ asset("welcome/vendor/purecounter/purecounter_vanilla.js")}}></script> -->
    <!-- <script src={{ asset("welcome/vendor/swiper/swiper-bundle.min.js")}}></script> -->

    <!-- Main JS File -->
    <script src={{ asset("welcome/vendor/glightbox/js/glightbox.min.js")}}></script>
    <script src={{ asset("welcome/js/main.js")}}></script>

</body>

</html>