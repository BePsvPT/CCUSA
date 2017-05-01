<footer class="page-footer orange">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l6">
        <h5 class="white-text">For you, for us</h5>

        <p class="grey-text text-lighten-4">國 立 中 正 大 學 學 生 會 © {{ $now->year }}</p>
      </div>

      <div class="col s6 l3">
        @include('footer.feedback')
      </div>

      <div class="col s6 l3">
        @include('footer.links')
      </div>
    </div>
  </div>
</footer>
