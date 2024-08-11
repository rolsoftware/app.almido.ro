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
                    <label for="filter-ean" class="form-label">EAN</label>
                    <input id="filter-ean" name="filter[ean]" type="text" value="{{ old('filter.ean',@$filter['ean']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-name" class="form-label">Nume</label>
                    <input id="filter-name" name="filter[name]" type="text" value="{{ old('filter.name',@$filter['name']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-brand" class="form-label">Brand</label>
                    <input id="filter-brand" name="filter[brand]" type="text" value="{{ old('filter.brand',@$filter['brand']) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="filter-category_id" class="form-label">Status</label>
                    <select id="filter-category_id" name="filter[category_id]" class="form-control">
                        <option value="0" {{ old('filter.category_id',@$filter['category_id']) == '0' ? 'selected' : ''}}>All</option>
                        @foreach ($category_list as $category)
                            <option value="{{ $category->id }}" {{ old('filter.category_id',@$filter['category_id']) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
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
            $('#filter-category_id').select2({
                dropdownParent: $('#form')
            });
            $('#filter-status').select2({
                dropdownParent: $('#form')
            });
        });
    </script>
@endsection
