@include('includes.header.head')
@include('includes.header.nav-app')

<section class="lvds-section lvds-section--white">
  <div class="row">
    <div class="col-md-12">
      @yield('content')
    </div>
  </div>
</section>

@include('includes.footer.footer')
