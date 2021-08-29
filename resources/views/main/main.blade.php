<!DOCTYPE html>
<html lang="en">
    @include('header')
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
    
  
    <div class="site-wrap" id="app">
      <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
  
      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body">
          <ul class="site-nav-wrap">
                  <li class="active"><router-link to="/" class="nav-link">Home</router-link></li>
                  <li class="has-children">
                    <a href="#" class="nav-link">Pinjam</a>
                      <ul class="dropdown">
                        <li><router-link to="/oxymeter" class="nav-link">Oxymeter</router-link></li>
                        <li><router-link to="/oxygen" class="nav-link">Oxygen</router-link></li>
                      <!-- <li class="has-children">
                        <a href="#">More Links</a>
                        <ul class="dropdown">
                          <li><a href="#">Menu One</a></li>
                          <li><a href="#">Menu Two</a></li>
                          <li><a href="#">Menu Three</a></li>
                        </ul>
                      </li> -->
                    </ul>
                  </li>
                  <li><router-link to="/konsultasi" class="nav-link">Konsultasi</router-link></li>
                  <li><router-link to="/donorplasma" class="nav-link">Donor Plasma</router-link></li>
                  <li><router-link to="/berita" class="nav-link">Tentang</router-link></li>
                  <li ><a  class="btn-login btn btn-primary px-4 py-2" style="color:white !important;"> Login</a></li>
                </ul>
        </div>
      </div>
  
      <header class="site-navbar light js-sticky-header site-navbar-target" role="banner">
  
        <div class="container">
          <div class="row align-items-center">
  
            <div class="col-6 col-xl-2">
              <div class="mb-0 site-logo"><a href="index.html" class="mb-0"><img src={{asset("images/logo.jpg")}} alt="" height="50px"></img></a></div>
            </div>
  
            <div class="col-12 col-md-10 d-none d-xl-block">
              <nav class="site-navigation position-relative text-right" role="navigation">
  
                <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                  <li class="active"><router-link to="/" class="nav-link">Home</router-link></li>
                  <li class="has-children">
                    <a href="#" class="nav-link">Pinjam</a>
                      <ul class="dropdown">
                        <li><router-link to="/oxymeter" class="nav-link">Oxymeter</router-link></li>
                        <li><router-link to="/oxygen" class="nav-link">Oxygen</router-link></li>
                      <!-- <li class="has-children">
                        <a href="#">More Links</a>
                        <ul class="dropdown">
                          <li><a href="#">Menu One</a></li>
                          <li><a href="#">Menu Two</a></li>
                          <li><a href="#">Menu Three</a></li>
                        </ul>
                      </li> -->
                    </ul>
                  </li>
                  <li><router-link to="/konsultasi" class="nav-link">Konsultasi</router-link></li>
                  <li><router-link to="/donorplasma" class="nav-link">Donor Plasma</router-link></li>
                  <li><router-link to="/berita" class="nav-link">Tentang</router-link></li>
                  <li ><a  class="btn-login btn btn-primary px-4 py-2" style="color:white !important;"> Login</a></li>
                </ul>
              </nav>
            </div>
  
  
            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a></div>
  
          </div>
        </div>
  
      </header>
  
      
      <router-view></router-view>
    
      {{-- @include("main.footer-content") --}}
  
    
    </div> <!-- .site-wrap -->
    
</body>
@include('footer')
</html>