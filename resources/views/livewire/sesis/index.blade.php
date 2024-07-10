@section('title')
    Data Sesi - Vyantpro Cafe
@endsection

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <!-- flash message -->
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('message') }}
                </div>
            @endif
            <!-- end flash message -->

            <a href="/create" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0 mb-3">Buat Sesi Baru</a>
            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <thead class="bg-dark text-white text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Sesi</th>
                            <th scope="col">Total Opening</th>
                            <th scope="col">Total POS</th>
                            <th scope="col">Opening Next Day</th>
                            <th scope="col" style="width: 15%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($sesis as $index => $sesi)
                            <tr>
{{--                                <td class="text-center">--}}
{{--                                    <img src="{{ asset('/storage/posts/'.$sesi->image) }}" class="rounded" style="width: 150px">--}}
{{--                                </td>--}}
                                <td class="text-center">{{ $index+1 }}</td>
                                <td>{{ $sesi->tanggal_sesi }}</td>
                                <td>{!! "Rp" . number_format($sesi->total_opening, 2, ",", ".") !!}</td>
                                <td>{!! "Rp" . number_format($sesi->total_pos, 2, ",", ".") !!}</td>
                                <td>{!! "Rp" . number_format($sesi->opening_next_day, 2, ",", ".") !!}</td>
                                <td class="text-center">
                                    <a href="/edit/{{ $sesi->id }}" wire:navigate class="btn btn-sm btn-primary bi bi-search"></a>
                                    <button class="btn btn-sm btn-danger" wire:click="destroy({{ $sesi->id }})"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger alert-dismissible">
                                Data Sesi belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $sesis->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

