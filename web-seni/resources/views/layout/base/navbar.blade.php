<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <!-- <img src="assets/images/logo-v1.png" alt=""> -->
                        <!-- Web Kesenian -->
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="{{route('index')}}" class="active">Home</a></li>
                        <ul class="scroll-to-section">
                            <!-- Dropdown -->
                            <li class="nav-item dropdown" id="myDropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Kesenian </a>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item" href="#"> Pemesanan &raquo; </a>
                                        <ul class="submenu dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('sewamusik')}}">Seni Musik</a></li>
                                            <li><a class="dropdown-item" href="{{route('sewasastra')}}">Seni Sastra</a></li>
                                            <li><a class="dropdown-item" href="{{route('sewatari')}}">Seni Tari</a></li>
                                            <li><a class="dropdown-item" href="{{route('sewateater')}}">Seni Teater</a></li>
                                            <li hidden><a class="dropdown-item" href="#"></a></li>
                                        </ul>
                                    </li>
                                    <li> <a class="dropdown-item" href="#"> Pembelian &raquo; </a>
                                        <ul class="submenu dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{route('musik')}}">Seni Musik</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('rupa')}}">Seni Rupa</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('sastra')}}">Seni Sastra</a>
                                            </li>
                                            <li hidden>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="#" hidden></a></li>
                                </ul>
                            </li>
                        </ul>
                        {{-- <li class="scroll-to-section"><a href="{{route('kesenian')}}">Kesenian</a></li>
                        <li class="scroll-to-section"><a href="{{route('karya')}}">Karya</a></li> --}}
                        <li class="scroll-to-section"><a href="#">About</a></li>
                        @if(Session::get('isLoggedin')==true)
                        <li class="scroll-to-section">
                            <a class="dropdown-toggle mb-4" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pesanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('pesanankarya')}}">Pemesanan Karya</a></li>
                                <li><a class="dropdown-item" href="{{route('pesanankesenian')}}">Penyewaan Jasa</a></li>
                                <li hidden><a class="dropdown-item" href="#"></a></li>
                            </ul>
                        </li>
                        <li class="scroll-to-section"><a href="{{route('listchat')}}">Chat</a></li>
                        <li class="scroll-to-section"><a href="{{route('userprofile')}}">Profil</a></li>
                        <li class="border-first-button"><a href="{{route('logout')}}">Sign Out</a></li>
                        @else
                        <li class="scroll-to-section">
                            <div class="border-first-button"><a href="{{route('login')}}">Sign In</a></div>
                        </li>
                        @endif
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    @media all and (min-width: 992px) {
        .dropdown-menu li {
            position: relative;
        }

        .nav-item .submenu {
            display: none;
            position: absolute;
            left: 100%;
            top: -7px;
        }

        .nav-item .submenu-left {
            right: 100%;
            left: auto;
        }

        .dropdown-menu>li:hover {
            background-color: #f1f1f1
        }

        .dropdown-menu>li:hover>.submenu {
            display: block;
        }
    }

    /* ============ desktop view .end// ============ */

    /* ============ small devices ============ */
    @media (max-width: 991px) {
        .dropdown-menu .dropdown-menu {
            margin-left: 0.7rem;
            margin-right: 0.7rem;
            margin-bottom: .5rem;
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function() {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }
        // end if 
    });
</script>