<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Recipient as penerima;
use Carbon\Carbon;

class Receipent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $cabang, $id, $search;

    public function render()
    {
        if (!empty($this->search)) {
            
            $receipents= penerima::where('name','like', '%' . $this->search . '%')->orderBy('id','desc')->paginate(5);
            
        } else {
            
            $receipents = penerima::orderBy('id','desc')->paginate(5);

        }

        return view('livewire.receipent',[
            'receipents' => $receipents,
        ])->layout('layouts.main');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->cabang = '';
        $this->id = '';
    }
    
    public function closeCreate()
    {
        $this->resetFields();
        $this->dispatch('close-modal-create');
    }

    public function storePeminjam()
    {
        $this->validate([
            'name'       => 'required|string|unique:recipients,name',
            'cabang'     => 'required',
        ]);

        $payload = [
            'name'  => $this->name,
            'cabang'    => $this->cabang
        ];

        penerima::create($payload);

        session()->flash('message','Penerima Sudah berhasil diupdate ke Database');

        $this->resetFields();
        $this->dispatch('close-modal-create');
        
    }
    
    public function closeEdit()
    {
        $this->resetFields();
    }

    public function editPeminjam($id)
    {
        
        $peminjam = penerima::where('id',$id)->first();
        $this->cabang = $peminjam->cabang;
        $this->name = $peminjam->name;
        $this->id   = $peminjam->id;
        
        $this->dispatch('show-modal-edit');


    }

    public function updatePeminjam()
    {
        $peminjam = penerima::where('id',$this->id)->first();
        
        $this->validate([
            'name'       => 'required|string|unique:recipients,name,'.$peminjam->id,
            'cabang'     => 'required',
        ]);

        $payload = [
            'name'  => $this->name,
            'cabang'    => $this->cabang
        ];

        $peminjam->update($payload);

        session()->flash('message','Penerima Sudah berhasil diupdate ke Database');

        
        $this->dispatch('close-modal-edit');
        $this->resetFields();
    }

    public function deleteConfirmation($id)
    {
        $this->id = $id;
        $this->dispatch('show-modal-delete');
    }

    public function cancel()
    {
        $this->id = "";
    }

    public function deletePenerima()
    {
        $penerima = penerima::where('id',$this->id)->first();
        $penerima->delete();
        $this->id = "";
        $this->dispatch('close-modal-delete');
        session()->flash('message','Penerima Sudah berhasil dihapus dari Database');
    }


}
