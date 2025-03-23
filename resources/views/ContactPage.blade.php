<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/ContactPage.css') }}">
</head>
<header>
    <nav class="navbar">
        <div class="logo">BrumBrumm</div>
        <ul class="nav-links">
            <li><a href= "{{ url("/") }}">Home</a></li>
            <li><a href="{{ url("/products") }}">Products</a></li>
            <li><a href="{{url("/aboutUs")}}">About Us</a></li>
            <li><a href="{{ url("/contact")}}" class="active" >Contact Us</a></li>
            <li><a href="{{ url("/basketPage") }}">Basket</a></li>
        </ul>

        <div class="nav-buttons">
            @if (Auth::check())
                @if(Auth::User()->user_type == 'customer')
                    <a href = "{{url('dashboard')}}" class="btn">Dashboard</a>
                @else
                    <a href = "{{url('admin')}}" class="btn">Dashboard</a>
                @endif
                <form method="POST" action = "{{route('userLogout')}}">
                    @csrf
                    <button id="loginButton" class = "btn">Logout</button>
                </form>

            @else
                <a href="{{ url('loginUser') }}" class="btn sign-in">Sign In</a>
                <a href="{{ url('registerUser') }}" class="btn register">Register</a>
        </div>
        @endif
    </nav>
</header>

<button id="theme-switch">
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/></svg>
<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/></svg>


</button>


<body>
<br>
@if(session('success'))
    <div class="alert-success" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
        <h2>{{ session('success') }}</h2>
    </div>
@endif

@if(session('error'))
    <div class="alert-error" style="background-color: #f8d7da; color: #721c24; border: 1px solid ">
        <h2>{{ session('error') }}</h2>
    </div>
@endif
<h1 id = "contactUsTitle">How would you like to contact BrumBrumm?</h1>


<div class = "container">
    <form class="contactForm" action="{{ route('contact.submit') }}" method="post" class="contact-form">
        @csrf
        <h2>Request assistance.</h2>
        <p id = "requestAssistancePTag">Give us some info so the right person can get back to you.</p>
        <div>
            <label for="FirstName">First Name</label>
            <input type="text" id="FirstName" name="FirstName" placeholder="First Name" required>
        </div>
        <br>
        <div>
            <label for="LastName">Last Name</label>
            <input type="text" id="LastName" name="LastName" placeholder="Last Name" required>
        </div>
        <br>
        <div>
            <label for="Email">Email</label>
            <input type="email" id="Email" name="Email" placeholder="Email" required>
        </div>
        <br>
        <div>
            <label for="PhoneNumber">Phone</label>
            <input type="tel" id="PhoneNumber" name="PhoneNumber" placeholder="Phone Number" pattern = '^[0-9]+$' required>
        </div>
        <br>
        <div>
            <label for="Query">Query</label>
            <input type="text" id="Query" name="Query" placeholder="Enter Your Query" required>
        </div>
        <br>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
    <div class = "rightColumn">
        <div class = "giveUsACall">
            <h2>Give us a call.</h2>
            <h2>+44 7847357490</h2>
            <p>Not in the UK? Please text us on Whatsapp.</p>
            <p>Get billing and tech support.</p>
        </div>
        <div class="container comment-section-container">
            <div class="comment-form">
                <h3>Leave a Comment</h3>
                <form action=" {{route('review.submit')}}" method="POST">
                    @csrf
                    <div class="rating">
                        <input type="hidden" name="rating" id="ratingValue">
                        <i class='bx bx-star star' data-index="1"></i>
                        <i class='bx bx-star star' data-index="2"></i>
                        <i class='bx bx-star star' data-index="3"></i>
                        <i class='bx bx-star star' data-index="4"></i>
                        <i class='bx bx-star star' data-index="5"></i>
                    </div>
                    <textarea name="comment" rows="4" placeholder="Please type your review here" required></textarea>
                    <div class="btn-group">
                        <button type="submit" class="btn submit">Submit Comment</button>
                    </div>
                </form>
            </div>
        </div>
        @php
            $reviews = \App\Models\WebReview::latest()->get();
        @endphp

        <div class="comment-display"></div>
        @foreach($reviews as $review)
            <div class="comment-item">
                <p class = "commentItemP"><strong>{{ $review->user ? $review->user->username : 'Anonymous' }}</strong> - <strong>Rating:</strong> {{ str_repeat('⭐', $review->rating) }}</p>
                <p class = "commentItemP">{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-left">
            <ul>
                <li><a href="https://www.instagram.com"><img src ="{{asset("assets/insta (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://www.facebook.com"><img src = "{{asset("assets/facebook (1).png")}}" height = "27" width = "27"></a></li>
                <li><a href="https://x.com/?lang=en"><img src = "{{asset("assets/X (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://telegram.org"><img src = "{{asset("assets/telegram (1).png")}}" height = "25" width = "25"></a></li>
                <li><a href="https://uk.linkedin.com"><img src = "{{asset("assets/linkedin (1).png")}}" height = "25" width = "25"></a></li>
            </ul>
        </div>
        <div class="footer-center">
            <h1>brumbrumm</h1>
            <p>&copy; 2024 BrumBrumm. All Rights Reserved.</p>
        </div>
        <div class="footer-right">
            <p>Email: BrumBrummManagement@gmail.com</p>
            <p>Phone: +44 7847357490</p>
        </div>
    </div>
</footer>

</body>
<script src="{{ asset('js/darkmode.js') }}"></script>
<script src="{{asset('js/comment.js')}}"></script>
</html>
