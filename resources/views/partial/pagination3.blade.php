<div class="card-footer d-flex align-items-center" style="z-index: 1;">
  <p class="m-0 text-secondary">Showing {{ $table3->currentPage() }} of {{ $table3->lastPage() }} pages</p>
  <ul class="pagination m-0 ms-auto">
    @if ($table3->onFirstPage())
    <li class="page-item disabled">
      <a class="page-link" href="javascript:void(0);" tabindex="-1" aria-disabled="true">
        <i class="ti ti-chevron-left" style="font-size: 20px;"></i>
      </a>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $table3->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
        <i class="ti ti-chevron-left" style="font-size: 20px;"></i>
      </a>
    </li>
    @endif

    @php
    $start = max($table3->currentPage() - 2, 1);
    $end = min($table3->currentPage() + 2, $table3->lastPage());
    @endphp

    @if ($start > 1)
    <li class="page-item"><a class="page-link" href="{{ $table3->url(1) }}">1</a></li>
    @if ($start > 2)
    <li class="page-item"><a class="page-link" href="#"><span class="page-link">...</span></a></li>
    @endif
    @endif

    @for ($page = $start; $page <= $end; $page++)
      @if ($page==$table3->currentPage())
      <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
      @else
      <li class="page-item"><a class="page-link" href="{{ $table3->url($page) }}">{{ $page }}</a></li>
      @endif
      @endfor

      @if ($end < $table3->lastPage())
        @if ($end < $table3->lastPage() - 1)
          <li class="page-item"><span class="page-link">...</span></li>
          @endif
          <li class="page-item"><a class="page-link"
              href="{{ $table3->url($table3->lastPage()) }}">{{ $table3->lastPage() }}</a></li>
          @endif

          @if ($table3->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $table3->nextPageUrl() }}">
              <i class="ti ti-chevron-right" style="font-size: 20px;"></i>
            </a>
          </li>
          @else
          <li class="page-item disabled">
            <a class="page-link" href="javascript:void(0);">
              <i class="ti ti-chevron-right" style="font-size: 20px;"></i>
            </a>
          </li>
          @endif
  </ul>
</div>
