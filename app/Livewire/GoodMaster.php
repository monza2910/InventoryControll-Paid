<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Good;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


class GoodMaster extends Component
{

    use WithFileUploads;
    use WithPagination;

    
    public $name,$description,$image,$oldimage,$idGood,$deleteId;
    public $v_name, $v_desc, $v_image, $v_stok;
    public $search;
    
    protected $paginationTheme = 'bootstrap';

    //render all component

    public function render()
    {

        if (!empty($this->search)) {
            
            $goods= Good::where('name','like', '%' . $this->search . '%')->orderBy('id','desc')->paginate(5);
            
        } else {
            
            $goods = Good::orderBy('id','desc')->paginate(5);

        }
        
        

        return view('livewire.good-master',[
            'goods' => $goods,
        ])->layout('layouts.main');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function resetFields()
    {
        $this->idGood       = '';
        $this->name         = '';
        $this->image        = null;
        $this->oldimage     = null;
        $this->description  = '';
    }

    //tambah data barang
    public function storeGood()
    {               
        $this->validate([
            'name'          => 'required|unique:goods,name',
            'description'   => 'required',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = md5($this->image . microtime()).'.'.$this->image->extension();

        $this->image->storeAs('public/barang', $imageName);


        $payload = [
            'name'  => $this->name,
            'image' => $imageName,
            'description' => $this->description,
        ];

        Good::create($payload);

        session()->flash('message','Barang Sudah Ditambahkan ke Database');

        $this->dispatch('close-modal');
        $this->resetFields();
    }

    //show modal edit

    public function editGood($id)
    {
        $good = Good::where('id', $id)->first();

        $this->idGood = $good->id;
        $this->name = $good->name;
        $this->oldimage = $good->image;
        $this->description = $good->description;

        $this->dispatch('show-modal-edit');

    }

    //update data barang

    public function updateGood()
    {
        $this->validate([
            'name'          => 'required|unique:goods,name,'. $this->idGood,
            'description'   => 'required',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

       


        $payload = [
            'name'  => $this->name,
            'description' => $this->description,
        ];

        if ($this->image) {
            $imageName = md5($this->image . microtime()).'.'.$this->image->extension();
            $this->image->storeAs('public/barang', $imageName);
            
            Storage::delete('public/barang/' . basename($this->oldimage));

            $payload['image'] = $imageName;
        }

        Good::where('id',$this->idGood)->update($payload);

        session()->flash('message','Barang Sudah berhasil diupdate ke Database');

        $this->dispatch('close-modal-edit');
        $this->resetFields();

    }

    //cancel Delete Confirmation 

    public function cancel()
    {
        $this->deleteId = '';
        $this->dispatch('close-modal-delete');
    }

    //Delete Confirmation 

    public function deleteConfirmation($id)
    {
        $this->deleteId = $id;
        $this->dispatch('show-modal-delete');
    }

    //proses delete 

    public function deleteGood()
    {
        $good = Good::where('id',$this->deleteId)->first();
        $good->delete();
        $this->dispatch('close-modal-delete');
        session()->flash('message','Barang Sudah berhasil dihapus dari Database');
    }

    //view detail Barang

    public function detailGood($id)
    {
        $good = Good::where('id',$id)->first();
        $this->v_name   = $good->name;
        $this->v_image  = $good->image;
        $this->v_desc   = $good->description;
        $this->v_stok   = $good->qty;
    }

    //close Modal Detail

    public function closeDetail()
    {
        $this->v_name   = '';
        $this->v_image  = '';
        $this->v_desc   = '';
        $this->v_stok   = '';

        $this->dispatch('close-modal-detail');
    }

    public function closeCreate()
    {
        $this->resetFields();
    }
    
}
