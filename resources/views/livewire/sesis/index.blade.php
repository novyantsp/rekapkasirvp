@section('title')
    Data Sesi - Vyantpro Cafe
@endsection

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <!-- flash message -->
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <!-- end flash message -->

            <a href="/create" wire:navigate class="btn btn-md btn-success rounded shadow-sm border-0 mb-3">ADD NEW POST</a>
            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Tanggal Sesi</th>
                            <th scope="col">Total Opening</th>
                            <th scope="col" style="width: 15%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($sesis as $sesi)
                            <tr>
{{--                                <td class="text-center">--}}
{{--                                    <img src="{{ asset('/storage/posts/'.$sesi->image) }}" class="rounded" style="width: 150px">--}}
{{--                                </td>--}}
                                <td>{{ $sesi->tanggal_sesi }}</td>
                                <td>{!! $sesi->total_opening !!}</td>
                                <td class="text-center">
                                    <a href="/edit/{{ $sesi->id }}" wire:navigate class="btn btn-sm btn-primary">EDIT</a>
                                    <button class="btn btn-sm btn-danger">DELETE</button>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post belum Tersedia.
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
