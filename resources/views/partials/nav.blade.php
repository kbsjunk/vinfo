<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Vinfo</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
{{--<ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul> --}}
      @if(Auth::check())
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="search" class="form-control" placeholder="{{ trans('actions.search') }}">
        </div>
        <button type="submit" class="btn btn-link"><i class="fa fa-search"></i><span class="sr-only">{{ trans('actions.search') }}</span></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::user()->is_admin)
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          {{ trans('sections.configuration') }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.countries.index') }}">{{ trans('sections.countries') }}</a></li>
            <li><a href="{{ route('admin.currencies.index') }}">{{ trans('sections.currencies') }}</a></li>
            <li><a href="{{ route('admin.languages.index') }}">{{ trans('sections.languages') }}</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('admin.bottle_sizes.index') }}">{{ trans('sections.bottle_sizes') }}</a></li>
            <li><a href="{{ route('admin.consumed_reasons.index') }}">{{ trans('sections.consumed_reasons') }}</a></li>
            <li><a href="{{ route('admin.region_types.index') }}">{{ trans('sections.region_types') }}</a></li>
          </ul>
        </li>
        @endif
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/user.png') }}" class="img-circle img-avatar-xs">
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ url('auth/account') }}">{{ trans('sections.account') }}</a></li>
            {{-- <li><a href="{{ url('auth/settings') }}">{{ trans('sections.settings') }}</a></li> --}}
            @if(Auth::user()->is_admin)
            <li><a href="{{ route('admin.users.index') }}">{{ trans('sections.users') }}</a></li>
            @endif
            <li role="separator" class="divider"></li>
            <li><a href="{{ url('auth/logout') }}">{{ trans('actions.logout') }}</a></li>
          </ul>
        </li>
      </ul>
      @else
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ url('auth/login') }}">{{ trans('actions.login') }}</a></li>
        <li><a href="{{ url('auth/register') }}">{{ trans('actions.register') }}</a></li>
      </ul>
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>