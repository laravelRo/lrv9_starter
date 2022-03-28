 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
     <div class="container d-flex align-items-center justify-content-between">

         <a href="index.html" class="logo"><img src="/front/assets/img/logo.png" alt=""
                 class="img-fluid"></a>
         <!-- Uncomment below if you prefer to use text as a logo -->
         <!-- <h1 class="logo"><a href="index.html">Butterfly</a></h1> -->

         <nav id="navbar" class="navbar">
             <ul>
                 <li><a class="nav-link scrollto active" href="{{ route('home') }}">Home</a></li>
                 <li><a class="nav-link scrollto" href="#about">About</a></li>
                 <li><a class="nav-link scrollto" href="#services">Services</a></li>
                 <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
                 <li><a class="nav-link scrollto" href="#team">Team</a></li>

                 <li class="dropdown">
                     <a href="#">
                         <span>
                             <i class="bi bi-person-circle" style="font-size: 1rem;"></i>
                             {{ Auth::check() ? Auth::user()->name : 'User' }}
                         </span>
                         <i class="bi bi-chevron-down"></i>
                     </a>
                     <ul>
                         @auth
                             <li>
                                 <a href="{{ route('user.settings') }}">Settings</a>
                             </li>
                             <form class="d-none" action="{{ route('logout') }}" method="POST" id="logout-form">
                                 @csrf
                             </form>

                             <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                     href="#">Logout</a>
                             </li>
                         @endauth
                         @guest
                             <li><a href="{{ route('login') }}">Login</a></li>
                         @endguest

                     </ul>
                 </li>

             </ul>
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

     </div>
 </header><!-- End Header -->
