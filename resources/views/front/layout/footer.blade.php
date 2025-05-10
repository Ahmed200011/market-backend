<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
            We are happy to answer all your inquiries and suggestions. Feel free to contact us at any time — we’ll be
            glad to assist you.

            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Cairo, Egypt</p>
            <a href="mailto:ahmorz02@gmail.com">
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>ahmorz02@gmail.com</p>
            </a>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>01009198079</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('page.home') }}"><i
                                class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-secondary mb-2" href="{{ route('page.shop.index') }}"><i
                                class="fa fa-angle-right mr-2"></i>Our Shop</a>

                        <a class="text-secondary mb-2" href="{{ route('page.cart.index') }}"><i
                                class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                        <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                        <a class="text-secondary" href="{{ route('page.contact') }}"><i
                                class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                    @if (Auth::user())
                        <p>{{ Auth::user()->name }}</p>
                        <p>{{ Auth::user()->email }}</p>
                    @else
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        </div>
                    @endif

                </div>
                <div class="col-md-4 mb-5">

                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="https://web.facebook.com/ahmd.mhmd.540699"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2"
                            href="https://www.linkedin.com/in/ahmedmuhamedrizk/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="https://github.com/Ahmed200011"><i
                                class="fab fa-github"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="https://ahmed200011.github.io/Portfolio/"><i
                                class="fas fa-user"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                by
                <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('front/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('front/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('front/mail/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('front/js/main.js') }}"></script>
</body>

</html>
