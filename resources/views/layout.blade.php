<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Add To Cart Function - ItSolutionStuff.com</title>

 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/theme.js') }}"></script>
 
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/style.css') }}">

 
</head>

<body>
 <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top" id="nav">
        <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}">MySite</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="About.html">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="contact.html">Contact</a>
              </li>
            </ul>
             <!-- User Dropdown -->
        <!--     <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="assets/image/user.png" alt="User Image" class="rounded-circle" width="35" height="35">
                  <span class="ms-2">User Name</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                  <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                  <li><a class="dropdown-item" href="transaction.html">Transactions</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
              </li>
            </ul>-->
            
            <!-- Cart Button -->
            <button type="button" class="btn btn-primary me-2" onclick="toggleCartDropdown()">
                <i class="fa fa-shopping-cart"></i> Cart <span class="badge bg-danger">  {{ count((array) session('cart')) }}</span>
              </button>
              <div class="cart-dropdown" id="cartDropdown">
               
                <div class="cart-items">
                  <!-- Cart items here -->
                  @if(session('cart'))
                  @foreach(session('cart') as $id => $details)
                  <div class="cart-item" data-id="{{ $id }}">
                    <img src="{{asset('assets/image') }}/{{ $details['photo'] }}" alt="Product 1">
                    <div>
                      <p class="mb-1 cart-title"  >{{ $details['product_name'] }}</p>
                      <div class="price-quantity">
                          <p class="cart-item-price">${{ $details['price'] }}</p>
                          <small class="cart-item-quantity">Qty: {{ $details['quantity'] }}</small>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @else
                  <li class="cart-item">No items in the cart</li>
                @endif
             
               
              </div>
              <div class="cart-footer">
                @php $total = 0 @endphp

                @foreach((array) session('cart') as $id => $details)

                    @php $total += $details['price'] * $details['quantity'] @endphp

                @endforeach
              <p id ="totallist"><strong>Total:  ${{ $total ?? 0 }}</strong></p>
              <a href="{{  route('cart') }}" class="btn btn-primary btn-sm">View Cart</a>
              <a href="checkout.html" class="btn btn-outline-primary btn-sm">Checkout</a>
             
          </div>
              
              </div>
            <a href="login.html" class="btn btn-outline-primary" type="button">Sign In</a>
          </div>
        </div>
 </nav>
      <!-- End Navigation Bar -->

      <div class="mt-5 pt-4"></div>
      <!-- End Navigation Bar -->

 
<div class="container">
    @if(session('success'))

        <div class="alert alert-success">

          {{ session('success') }}

        </div> 

    @endif

    @yield('content')

</div>

  @yield('scripts')

     
  <!-- Footer -->
  <footer class="bg-dark text-white text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h6 class="text-uppercase">Contact Us</h6>
                <p class="small">
                    <i class="fa fa-map-marker"></i> 123 Main Street, City, Country<br>
                    <i class="fa fa-phone"></i> +1 (555) 123-4567<br>
                    <i class="fa fa-envelope"></i> contact@mysite.com
                </p>
            </div>
            <!-- Quick Links -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h6 class="text-uppercase">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white small">About Us</a></li>
                    <li><a href="#" class="text-white small">Privacy Policy</a></li>
                    <li><a href="#" class="text-white small">Terms of Service</a></li>
                </ul>
            </div>
            <!-- Social Media Links -->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h6 class="text-uppercase">Follow Us</h6>
                <a href="#" class="text-white me-3 small"><i class="fa fa-facebook"></i></a>
                <a href="#" class="text-white me-3 small"><i class="fa fa-twitter"></i></a>
                <a href="#" class="text-white me-3 small"><i class="fa fa-instagram"></i></a>
                <a href="#" class="text-white small"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>
 
</body>

</html>