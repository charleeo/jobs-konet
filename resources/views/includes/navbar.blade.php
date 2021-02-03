  <div id="slideout-menu">
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="{{route('about')}}">About</a></li>
      <li><a href="bloglist.html">Blog</a></li>
      <li><a href="/profile">Dashbaord</a></li>
      <li>
        <input type="text" placeholder="search here"/>
      </li>
    </ul>
    <div id="control-side-menu">
        <i class="fas fa-arrow-left fa-2x text-white"></i>
    </div>
  </div>

  <nav>
    <div id="logo-img">
      <a href="/">
        {{config('app.name','Jobs Hub Connect')}}
      </a>
    </div>
    <div id="menu-icon">
      <i class="fas fa-bars"></i>
    </div>
    <ul>
      <li><a href="/" class="active">Home</a></li>
      <li><a href="{{route('about')}}">About</a></li>
      <li><a href="blogpost.html">Blog</a></li>
      <li><a href="/profile">Dashboard</a></li>
      <li>
        <div id="search-icon"><i class="fas fa-search"></i></div>
      </li>
    </ul>
  </nav>
  <div id="searchbox">
    <input type="text" placeholder="search here">
  </div>
