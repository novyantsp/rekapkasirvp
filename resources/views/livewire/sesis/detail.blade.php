<div class="px-4 py-3 my-5 text-center">
    {{--    <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">--}}
    <h1 class="display-5 fw-bold text-body-emphasis">Sesi Baru</h1>
    <div class="mx-auto">
        <p class="lead mb-6">Isi Data Sesi Baru.</p>
        <div class="container">
            <form wire:submit="update" class="row gy-2 gx-3 align-items-center">
                <div class="col-6">
                    <label for="tanggal_sesi" class="form-label">Tanggal Session</label>
                    <input type="date" wire:model="tanggal_sesi" class="form-control" id="tanggal_sesi" placeholder="Tanggal Sesi">
                </div>
                <div class="col-6">
                    <label for="total_opening" class="form-label" id="default">Total Opening</label>
                    <div class="input-group">
                        <div class="input-group-text">Rp</div>
                        <input type="text" wire:model="total_opening" class="form-control input-currency" id="total_opening" placeholder="Total Opening">
                    </div>
                </div>
                <div class="b-example-divider"></div>
                @error('tanggal_sesi')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
                @error('total_opening')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
