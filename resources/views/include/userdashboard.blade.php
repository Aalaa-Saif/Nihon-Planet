
<nav class="navbar navbar-expand-lg nav py-4">
    <button class="navbar-toggler bg-light navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ __('messages.lang') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown1" role="menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}</a>
                  @endforeach
            </div>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('otaku profile') }}">{{ __('messages.profile') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('post') }}">{{ __('messages.posts') }}</a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="{{ url('otaku logout') }}">{{ __('messages.o_logout') }}</a>
       </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="" method="GET" role="search">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="{{ __('messages.search') }}" aria-label="Search">
        <button class="btn btn-outline-info text-dark my-2 my-sm-0" type="submit">{{ __('messages.search') }}</button>
      </form>
    </div>
  </nav>
