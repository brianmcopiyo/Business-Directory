<div class="modal modal-blur fade" id="new" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <form method="POST" action="{{ route('users.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="role">Role</label>
                    <select name="role" id="role" class="form-select">
                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                            @if (auth()->user()->hasRole('Admin') ||
                                 (auth()->user()->hasRole('Manager') && $role->name !== 'Admin') ||
                                 (!auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Manager') && !in_array($role->name, ['Admin', 'Manager'])))
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
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
