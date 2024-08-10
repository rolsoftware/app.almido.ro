<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Filtrare</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Opituni de filtrare</h6>

        <div class="p-4">
            <form action="#" method="GET" id="form">

                <div class="mb-3">
                    <label for="filter-username" class="form-label">Utilizator</label>
                    <input id="filter-username" name="filter[username]" type="text" value="{{ old('filter.username',@$filter['username']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-name" class="form-label">Nume</label>
                    <input id="filter-name" name="filter[name]" type="text" value="{{ old('filter.name',@$filter['name']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-email" class="form-label">Email</label>
                    <input id="filter-email" name="filter[email]" type="text" value="{{ old('filter.email',@$filter['email']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-role" class="form-label">Rol</label>
                    <select id="filter-role" name="filter[role]" class="form-control">
                        <option value="0" {{ old('filter.role',@$filter['role']) == '0' ? 'selected' : ''}}>All</option>
                        @foreach ($roles as $key => $role)
                            <option value="{{ $role }}" {{ old('filter.role',@$filter['role']) == $role ? 'selected' : ''}}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="filter-active" class="form-label">Activ</label>
                    <select id="filter-active" name="filter[active]" class="form-control">
                        <option value="0" {{ old('filter.active',@$filter['active']) == '0' ? 'selected' : ''}}>All</option>
                        <option value="Yes" {{ old('filter.active',@$filter['active']) == 'Yes' ? 'selected' : ''}}>Da</option>
                        <option value="No" {{ old('filter.active',@$filter['active']) == 'No' ? 'selected' : ''}}>Nu</option>
                    </select>
                </div>

                <div class="row text-center mb-4">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success waves-effect"><i class="mdi mdi-filter"></i> Aplica</button>
                        <a class="btn btn-danger waves-effect" href="{{ route('user.index') }}" title="Reset"><i class="mdi mdi-filter-off"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@section('script')
    <script>
        $(document).ready(function () {
            $('#type_id').select2({
                dropdownParent: $('#form')
            });

            $('#filter-role').select2({
                dropdownParent: $('#form')
            });

            $('#filter-active').select2({
                dropdownParent: $('#form')
            });
        });
    </script>
@endsection
