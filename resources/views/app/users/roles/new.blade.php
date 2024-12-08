<div class="modal modal-blur fade" id="newrole" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <form method="POST" action="{{ route('roles.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Role Name Field -->
                <div class="mb-3">
                    <label class="form-label" for="name">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" required>
                </div>

                <!-- Permissions Grouped by Category -->
                <div class="mb-3 mt-3">
                    <h1 class="form-label mr-5 pr-5" for="permissions" style="color:#f3b080;"> Assign Permissions</h1>
                    <div class="permission-groups">
                        @php
                            $permissions = \Spatie\Permission\Models\Permission::all();
                            $groupedPermissions = [];
                            foreach ($permissions as $permission) {
                                $parts = explode('_', $permission->name); // Split permission by '_'
                                $group = ucfirst($parts[count($parts) - 1]); // Get the last part for grouping
                                $groupedPermissions[$group][] = $permission;
                            }
                        @endphp
                        @foreach ($groupedPermissions as $group => $permissionsInGroup)
                            <div class="permission-group mt-2">
                                <h4 style="color:#f3b080">{{ $group }}</h4>
                                <div class="row">
                                    @foreach ($permissionsInGroup as $permission)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}">
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
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
