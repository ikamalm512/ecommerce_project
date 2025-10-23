<header>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-left">
                <h2 class="logo">ShopEase</h2>
            </div>
            <div class="nav-center">
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            
            <div class="nav-right">
                <a href="#" class="cart"><i class="fa-solid fa-cart-shopping"></i></a>
                
                <div class="auth-buttons">
                    @auth
                        <a href="{{route('profile.edit')}}" class="talk-btn profile-btn"><i class="fa-solid fa-user"></i> Profile</a>
                        <a href="{{ route('logout') }}" class="talk-btn logout-btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="talk-btn login-btn"><i class="fa-solid fa-sign-in-alt"></i> Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>