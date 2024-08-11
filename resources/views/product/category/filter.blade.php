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
                    <label for="filter-code" class="form-label">Cod</label>
                    <input id="filter-code" name="filter[code]" type="text" value="{{ old('filter.code',@$filter['code']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-name" class="form-label">Nume</label>
                    <input id="filter-name" name="filter[name]" type="text" value="{{ old('filter.name',@$filter['name']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-status" class="form-label">Activ</label>
                    <select id="filter-status" name="filter[status]" class="form-control">
                        <option value="0" {{ old('filter.status',@$filter['status']) == '0' ? 'selected' : ''}}>All</option>
                        <option value="Active" {{ old('filter.status',@$filter['status']) == 'Active' ? 'selected' : ''}}>Active</option>
                        <option value="Inactive" {{ old('filter.status',@$filter['status']) == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                    </select>
                </div>

                <div class="row text-center mb-4">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success waves-effect"><i class="mdi mdi-filter"></i> Aplica</button>
                        <a class="btn btn-danger waves-effect" href="{{ route('product-category.index') }}" title="Reset"><i class="mdi mdi-filter-off"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@section('script')
    <script>
        $(document).ready(function () {
            $('#filter-status').select2({
                dropdownParent: $('#form')
            });
        });
    </script>
@endsection
