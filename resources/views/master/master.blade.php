
@include('master.header')

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          @yield('main-content')
        </div>
        <div class="col-md-4">
           @include('master.sidebar') 
        </div>
      </div>        
    </div>
  </section>

@include('master.footer')
