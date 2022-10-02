<nav class="navbar navbar-expand-lg nav">
    <b> <a class="navbar-brand pl-2" href="{{ route('nihon') }}">{{ __('messages.nihon') }}</a> </b>
     <button class="navbar-toggler bg-light navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">

         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               {{ __('messages.lang') }}
             </a>
             <div class="dropdown-menu" aria-labelledby="navbarDropdown1" role="menu">
                 @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                   <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}</a>
                   @endforeach
             </div>
           </li>

         <li class="nav-item">
           <a class="nav-link" href="{{ url('food') }}">{{ __('messages.food') }}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{ url('city') }}">{{ __('messages.city') }}</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{ url('cloths') }}">{{ __('messages.cloths') }}</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{ url('otaku logout') }}">{{ __('messages.o_logout') }}</a>
          </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Nippon
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown" role="menu">
             <a class="dropdown-item" href="#">Action</a>
             <a class="dropdown-item" href="#">Another action</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="#">Something else here</a>
           </div>
         </li>

       </ul>
       <form class="form-inline my-2 my-lg-0">
         <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
       </form>
     </div>
   </nav>




<div>
    <nav class="navbar navbar-expand-md">
         <ul class="navbar-nav mx-5">
            <li class="nav-item">
                <a class="nav-link" href="otaku profile">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="post">Post</a>
            </li>
        </ul>
    </nav>
</div>
