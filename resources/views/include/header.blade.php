<div class="backg_nav">
  <nav class="navbar navbar-expand-lg nav border-bottom py-5">
    <b> <a class="navbar-brand pl-2 nav-link" href="main page">Nihon</a> </b>
     <button class="navbar-toggler bg-light navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">

         <li class="nav-item">
           <a class="nav-link" href="food">{{ __('messages.food') }}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="city">{{ __('messages.city') }}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="cloths">{{ __('messages.cloths') }}</a>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle click_language" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('messages.lang') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown1" role="menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}</a>
                @endforeach
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="otaku login">{{ __('messages.o_login') }}</a>
          </li>
       </ul>
       <form class="form-inline my-2 my-lg-0" action="" method="GET" role="search">
        <a class="nav-link" href="admin login">{{ __('messages.a_login_register') }}</a>
         <input class="form-control mr-sm-2" type="search" placeholder="{{ __('messages.search') }}" name="search" aria-label="Search">
         <button class="btn btn-dark border my-2 my-sm-0" type="submit">{{ __('messages.search') }}</button>

       </form>
     </div>
   </nav>

</div>




