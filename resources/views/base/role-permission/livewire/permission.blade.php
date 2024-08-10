<div class="col-sm-3 pb-3">
    <div class="card h-100">
        <div class="card-header bg-transparent border-bottom pb-1">
            <h5 class="card-title">Permisiuni pentru {{ $name }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($permission as $key => $value)
                    @php
                        $check_value = $permission[strtolower($key)]['id'] ?? null;
                    @endphp
                    <div class="col-lg-6">
                        <div class="form-check form-checkbox-outline form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" wire:model="permission_check.{{ $value['name'] }}">
                            <label class="form-check-label" for="permission_check.{{ $value['name'] }}">{{ $key }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer bg-transparent border-top row justify-content-end">
            <div class="col-sm-12">
                <div class="text-sm-end">
                    <button type="button" class="btn btn-sm btn-success waves-effect waves-light" wire:click="save()"><i class="bx bx-save font-size-16 align-middle me-2"></i> Salveaza</button>
                </div>
            </div>
        </div>
    </div>
</div>