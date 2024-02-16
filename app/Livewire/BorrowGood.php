<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Good;
use App\Models\BorrowedGood as ListPinjam;
use App\Models\Recipient as Peminjam;
use Carbon\Carbon;
use Auth;

class BorrowGood extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $good_id, $receipent_id, $qty, $note, $type;

    public $search, $date_start, $date_finish, $idTrans;

    public $good_name, $receipent_name, $receipent_cabang, $qtyPinjam, $date_pinjam, $date_back, $image, $status;

    public function render()
    {
        if ($this->date_start != null && $this->date_finish != null && $this->search != null) {
            
            $borrows        = ListPinjam::with('Recipient')->whereHas('Recipient', function($q){
                $q->where('name','LIKE','%'.$this->search.'%')
                ->whereBetween('date_out',[$this->date_start,$this->date_finish]);
            })->orderBy('id','desc')->paginate(5);
            
        }elseif ($this->date_start != null && $this->date_finish != null) {
            $borrows        = ListPinjam::with('Recipient')->whereHas('Recipient', function($q){
                $q->whereBetween('date_out',[$this->date_start,$this->date_finish]);
            })->orderBy('id','desc')->paginate(5);
        }
        else { 
            $borrows        = ListPinjam::with('Recipient')->whereHas('Recipient', function($q){
                $q->where('name','LIKE','%'.$this->search.'%');
            })->whereHas('Recipient', function($q){
                $q->where('name','LIKE','%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        }
        
        $goods      = Good::orderBy('id','desc')->get();
        $peminjams  = Peminjam::orderBy('id','desc')->get();

        return view('livewire.borrow-good',[
            'borrows'   => $borrows,
            'goods'     => $goods,
            'peminjams' => $peminjams
        ])->layout('layouts.main');
    }

    public function resetFields()
    {
        $this->good_id = '';
        $this->receipent_id = '';
        $this->qty = '';
        $this->type = '';
        $this->note = '';
    }

    public function close()
    {
        
        $this->resetFields();
        $this->dispatch('close-modal-pinjam');

    } 

    public function storePinjaman()
    {
        $good = Good::where('id',$this->good_id)->first();
        $this->validate([
            'type'      => 'required',
            'receipent_id' => 'required',
            'good_id'   => 'required|exists:goods,id',
            'qty'       => 'numeric|required|min:1|max:'. $good->qty,
            'note'      => 'nullable'
        ]);

        $payload = [
            'good_id'   => $this->good_id,
            'user_id'   => Auth::user()->id,
            'receipent_id' => $this->receipent_id,
            'qty'       => $this->qty,
            'note'      => $this->note,
            'type'      => $this->type,
            'date_out'  => Carbon::now(),
            'status'    => 'Dipinjam'    
        ];

        $goodNow = $good->qty - $this->qty;
        $good->qty = $goodNow;
        $good->save();
        ListPinjam::create($payload);

        session()->flash('message','Peminjaman berhasil dimasukan ke Database');
        $this->resetFields();
        $this->dispatch('close-modal-pinjam');
        
    }

    public function confirmKembali($id)
    {
        $this->idTrans = $id;
        $this->dispatch('show-modal-back');
    }

    public function closeConfirm()
    {
        $this->idTrans = '';

    }
    public function confirmProses()
    {
        $borrows = ListPinjam::where('id',$this->idTrans)->first();
        $good   = Good::where('id',$borrows->good_id)->first();

        $qtyNow = $borrows->qty + $good->qty;

        $good->qty =$qtyNow;
        $good->save();

        $borrows->date_back = Carbon::now();
        $borrows->status = 'Selesai';
        $borrows->save();
        
        $this->dispatch('close-modal-close-proses');
        session()->flash('message','Barang Sudah berhasil dikembalikan ke Database');
    }

    public function detailborrow($id)
    {
        $borrow = ListPinjam::where('id',$id)->first();

        // $good_name, $receipent_name, $receipent_cabang, $qtyPinjam, $date_pinjam, $date_back, $image, $status;
        $this->good_name = $borrow->good->name;
        $this->receipent_name = $borrow->recipient->name;
        $this->type = $borrow->type;
        $this->note = $borrow->note;
        $this->receipent_cabang = $borrow->recipient->cabang;
        $this->qtyPinjam   = $borrow->qty;
        $this->date_pinjam  = $borrow->date_out;
        $this->date_back  = $borrow->date_back;
        $this->image  = $borrow->good->image;
        $this->status  = $borrow->status;
        $this->dispatch('openDetail');
    }

    public function closeDetail()
    {
        $this->good_name = '';
        $this->receipent_name = '';
        $this->type = '';
        $this->note ='';
        $this->receipent_cabang = '';
        $this->qtyPinjam   = '';
        $this->date_pinjam  = '';
        $this->date_back  = '';
        $this->image  = '';
        $this->status  = '';
        $this->dispatch('closeDetail');

    }
}


