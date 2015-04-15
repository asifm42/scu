    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
      <div class="col-xs-12 col-md-10 col-md-offset-1"
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button><!--
          <a class="navbar-brand" href="../public">Obsidian Black</a> -->
          <a class="navbar-brand" href="{{route('pages.home')}}">
            <img src={{ asset('assets/img/scu-logo-website-topBar-logo.png') }} alt="SCU">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong>ABOUT <span class="caret"></span></strong></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href={{ url('about') }}><strong>What is Ultimate?</strong></a></li>
                        <li><a href={{ url('about') }}><strong>What is SCU?</strong></a></li>
                        <li><a href={{ url('about') }}><strong>Meet the SCU Leaders</strong></a></li>
                    </ul>
                </li>
                <li><a href={{ url('news') }}><strong>NEWS</strong></a></li>
                <li><a href={{ url('events') }}><strong>EVENTS</strong></a></li>
                <li><a href={{ url('contactus') }}><strong>CONTACT US</strong></a></li>
                <li><a href={{ route('members.dashboard') }}><strong>DASHBOARD</strong></a></li>
          </ul>
         <!--  <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form> -->
          <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href={{ url('signin') }}><strong>SIGN IN/UP</strong></a></li>
          @endif
          @if (Auth::check())
            <li><a href={{ url('signout') }}><strong>SIGN OUT</strong></a></li>
            @endif

<!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li> -->
          </ul>
        </div>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>