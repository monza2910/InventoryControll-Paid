<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Good;
use App\Models\StockControl;
use Carbon\Carbon;

class GoodIn extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $date_start, $date_finish;
    public $name, $image, $type, $good_id, $qty, $search, $note, $date_in;

    public function render()
    {

        if ($this->date_start != null && $this->date_finish != null && $this->search != null) {
            
            $goodins        = StockControl::with('good')->whereHas('Good', function($q){
                $q->where('name','LIKE','%'.$this->search.'%')
                ->whereBetween('date_in',[$this->date_start,$this->date_finish]);
            })->orderBy('id','desc')->paginate(5);;
            
        }elseif ($this->date_start != null && $this->date_finish != null) {
            $goodins        = StockControl::with('good')->whereHas('Good', function($q){
                $q->whereBetween('date_in',[$this->date_start,$this->date_finish]);
            })->orderBy('id','desc')->paginate(5);;
        }
        else { 
            $goodins        = StockControl::with('good')->whereHas('Good', function($q){
                $q->where('name','LIKE','%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);;
        }
        
        $addgoods  = Good::orderBy('id','desc')->get();
        return view('livewire.good-in',[
            'goodins'   => $goodins,
            'addgoods'     => $addgoods
        ])->layout('layouts.main');
    }

    public function resetFields()
    {
        $this->good_id = "";
        $this->qty = "";
        $this->note = "";

    }

    public function closeForm()
    {
        $this->resetFields();
        $this->dispatch('close-modal-min');
        $this->dispatch('close-modal-add');
    }

    public function tambahStok()
    {

        $good = Good::where('id',$this->good_id)->first();

        $this->validate([
            'good_id'       => 'required',
            'note'          => 'nullable',
            'qty'           => 'required|min:1',
        ]);

        $payload = [
            'good_id'       => $this->good_id,
            'note'          => $this->note,
            'qty'           => $this->qty,
            'date_in'       => Carbon::now(),
            'type'          => 'masuk'
        ];

        $qtyNow = $good->qty + $this->qty;

        $good->qty = $qtyNow;
        $good->save();
        
        StockControl::create($payload);
        
        session()->flash('message','Stok Barang Sudah berhasil diupdate ke Database');

        $this->resetFields();
        $this->dispatch('close-modal-add');
    }

    public function kurangiStok()
    {

        $good = Good::where('id',$this->good_id)->first();

        $this->validate([
            'good_id'       => 'required',
            'note'          => 'nullable',
            'qty'           => 'required|numeric|min:1|max:'.$good->qty,
        ]);

        $payload = [
            'good_id'       => $this->good_id,
            'note'          => $this->note,
            'qty'           => $this->qty,
            'date_in'       => Carbon::now(),
            'type'          => 'keluar'
        ];

        $qtyNow = $good->qty - $this->qty;

        $good->qty = $qtyNow;
        $good->save();
        
        StockControl::create($payload);
        session()->flash('message','Stok Barang Sudah berhasil diupdate ke Database');

        $this->resetFields();
        $this->dispatch('close-modal-min');
    }

    public function detailgoodin($id)
    {
        $good = StockControl::where('id',$id)->first();
        $this->name     = $good->good->name;
        $this->qty      = $good->qty;
        $this->note     = $good->note;
        $this->type     = $good->type;
        $this->date_in  = $good->date_in;
        $this->image    = $good->good->image;
        $this->dispatch('openDetail');

    }

    public function closeDetail()
    {
        $this->name     = '';
        $this->qty      = '';
        $this->note     = '';
        $this->type     = '';
        $this->date_in  = '';
        $this->image    = '';   
    }
}

