<footer class="footer footer-transparent d-print-none">
  <div class="container-xl">
    <div class="row text-center justify-content-center">
      <div class="col-auto">
        <ul class="list-inline list-inline-dots mb-0">
          <li class="list-inline-item">
            &copy; {{ date('Y') }}
            <a href="." class="link-secondary">{{ config()->get('app.name') }}</a>.
            All rights reserved.
          </li>
          <li class="list-inline-item">
            <a href="#" class="link-secondary" rel="noopener">
              {{ config()->get('app.version') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
