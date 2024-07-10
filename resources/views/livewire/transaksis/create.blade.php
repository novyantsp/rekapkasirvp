<div class="px-4 py-3 my-5 text-center">
    {{--    <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">--}}
    <h1 class="display-5 fw-bold text-body-emphasis">Sesi Baru</h1>
    <div class="mx-auto">
        <p class="lead mb-6">Isi Data Sesi Baru.</p>
        <div class="container">
            <form wire:submit="store" class="row gy-2 gx-3 align-items-center">
                <div class="col-6">
                    <label for="tanggal_sesi" class="form-label">Tanggal Session</label>
                    <input type="date" wire:model="tanggal_sesi" class="form-control" id="tanggal_sesi" placeholder="Tanggal Sesi">
                </div>
                <div class="col-6">
                    <label for="opening_total" class="form-label" id="default">Total Opening</label>
                    <div class="input-group">
                        <div class="input-group-text">Rp</div>
                        <input type="text" wire:model="total_opening" class="form-control input-currency" id="opening_total" placeholder="Total Opening">
                    </div>
                </div>
                <div class="b-example-divider"></div>
                @error('tanggal_sesi')
                <div class="alert alert-danger mt-2 alert-dismissible">
                    {{ $message }}
                </div>
                @enderror
                @error('total_opening')
                <div class="alert alert-danger mt-2 alert-dismissible">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>

        let opening_total = document.getElementById('opening_total');
        opening_total.addEventListener('keyup', function()
        {
            opening_total.value = formatRupiah(this.value, '');
        });

        function formatRupiah(angka, prefix)
        {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substring(0, sisa),
                ribuan = split[0].substring(sisa).match(/\d{3}/gi);

            let separator;

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    </script>

</div>


