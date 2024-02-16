<div>

    @include('admin.borrowed.createModal')
    @include('admin.borrowed.confirmModal')
    @include('admin.borrowed.openDetail')

    <h1 class="mt-4">Data Peminjaman</h1>
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
                        <button type="button" class="btn btn-primary d-inline float-right mx-2" data-toggle="modal" data-target="#tambahPinjaman">
                            Pinjam
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
                                <th>Nama & Cabang</th>
                                <th>Barang</th>
                                <th>Quantity</th>
                                <th>Type</th>
                                <th>Tanggal Dipinjam </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @forelse($borrows as $item => $borrow)    
                            <tr>
                                <td>{{$item+1}}</td>
                                <td>{{$borrow->recipient->name.'('.$borrow->recipient->cabang.')'}} </td>
                                <td>{{$borrow->good->name}}</td>
                                <td>{{$borrow->qty}}</td>
                                <td>{{$borrow->type}}</td>
                                <td>{{$borrow->date_out}}</td>
                                <td>{{$borrow->status}}</td>
                                <td>
                                    @if ($borrow->status == 'Dipinjam')
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmKembali" 
                                    wire:click="confirmKembali({{$borrow->id}})">
                                        Selsaikan
                                    </button>
                                    @endif
                                    <button type="button" class="btn btn-info" data-toggle="modal" 
                                    wire:click="detailborrow({{$borrow->id}})">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align: center">
                                    <span class="text-danger" >Data yang dicari tidak ada di database</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">

                {{ $borrows->links() }}
            </div>
        </div>
</div>

@push('scripts')

    <script>

        //Create modal 
        window.addEventListener('close-modal-pinjam', event =>{
            $('#tambahPinjaman').modal('hide');
        });

        //Create modal 
        window.addEventListener('show-modal-back', event =>{
            $('#confirmKembali').modal('show');
        });

        window.addEventListener('close-modal-close-proses', event =>{
            $('#confirmKembali').modal('hide');
        });
        //detail
        window.addEventListener('openDetail', event =>{
            $('#openDetail').modal('show');
        });
        window.addEventListener('closeDetail', event =>{
            $('#openDetail').modal('hide');
        });


    </script>
    
@endpush