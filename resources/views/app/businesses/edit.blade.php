<div class="modal modal-blur fade" id="update{{ $row->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <form method="POST" action="{{ route('businesses.update', $row->id) }}" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label" for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $row->name }}">
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
          <i class="ti ti-device-floppy"></i>
          Save
        </button>
      </div>
    </form>
  </div>
</div>