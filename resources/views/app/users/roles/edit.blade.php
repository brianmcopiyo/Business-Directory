<div class="modal modal-blur fade" id="updaterole{{ $role->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <form method="POST" action="{{ route('roles.update', $role->id) }}" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Role - {{ $role->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Role Name Field -->
                <div class="mb-3">
                    <label class="form-label" for="name">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" value="{{ old('name', $role->name) }}" required>
                </div>

                <!-- Permissions Grouped by Category -->
                <div class="mb-3">
                    <label class="form-label" for="permissions">Permissions</label>
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
                            <div class="permission-group">
                                <h6>{{ $group }}</h6>
                                <div class="row">
                                    @foreach ($permissionsInGroup as $permission)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}"
                                                       @if($role->hasPermissionTo($permission->name)) checked @endif>
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
                <button type="submit" class="btn btn-primary ms-auto">
                    <i class="ti ti-device-floppy"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
