<div>

    @include('admin.goodIn.tambahiStokModal')
    @include('admin.goodIn.kurangiStokModal')
    @include('admin.goodIn.openDetail')

    <h1 class="mt-4">Data Barang Masuk/Keluar</h1>
        @if (session()->has('message'))
            <div class="alert alert-success text-center">
                {{session('message')}}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <input type="date" wire:model.live="date_start" style="width: 30%" class="form-control d-inline">
                        Ke
                        <input type="date" wire:model.live="date_finish" style="width: 30%" class="form-control d-inline">
                    </div>
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-primary d-inline float-right mx-2" data-toggle="modal" data-target="#tambahStok">
                            Tambah Stok
                        </button>
                        <button type="button" class="btn btn-primary d-inline float-right mx-2" data-toggle="modal" data-target="#kurangiStok">
                            Kurangi Stok
                        </button>
                        <input type="search" wire:model.live="search" style="width: 50%" 
                        placeholder="Masukan Keyword..." class="form-control d-inline float-right">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Stok Masuk/Keluar</th>
                                <th>Tipe Transaksi</th>
                                <th>Tanggal Masuk/Keluar</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @forelse($goodins as $item => $goodin)    
                            <tr>
                                <td>{{$item + 1}}</td>
                                <td>{{$goodin->good->name}}</td>
                                <td>
                                    @if ($goodin->good->image)
                                        <img style="width: 200px; height : 100px" src="{{ $goodin->good->image }}">
                                    @endif
                                </td>
                                <td>{{$goodin->qty}}</td>
                                <td>{{$goodin->type}}</td>
                                <td>{{$goodin->date_in}}</td>
                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailgoodin" 
                                    wire:click="detailgoodin({{$goodin->id}})">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="text-align: center">
                                    <span class="text-danger" >Data yang dicari tidak ada di database</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">

                {{ $goodins->links() }}
            </div>
        </div>
</div>

@push('scripts')

    <script>

        window.addEventListener('openDetail', event =>{
            $('#openDetail').modal('show');
        });

        //Create modal 
        window.addEventListener('close-modal-add', event =>{
            $('#tambahStok').modal('hide');
        });
        
        //Create modal 
        window.addEventListener('close-modal-min', event =>{
            $('#kurangiStok').modal('hide');
        });


    </script>
    
@endpush