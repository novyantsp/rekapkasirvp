<?php

namespace App\Livewire\Sesis;

use App\Models\Sesi;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Detail extends Component
{
    //id post
    public $sesiID;

    //Tanggal Sesi
    #[Rule('required', message: 'Masukkan Tanggal Sesi')]
    public $tanggal_sesi;

    //Opening Total
    #[Rule('required', message: 'Masukkan Total Opening')]
    public $total_opening;

    public function mount($id)
    {
        //get post
        $sesi = Sesi::find($id);

        //assign
        $this->sesiID   = $sesi->id;
        $this->tanggal_sesi    = $sesi->tanggal_sesi;
        $this->total_opening  = $sesi->total_opening;
    }

    /**
     * update
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        //get post
        $sesi = Sesi::find($this->sesiID);

        //update post
        $sesi->update([
            'tanggal_sesi' => $this->tanggal_sesi,
            'total_opening' => $this->total_opening,
        ]);

        //flash message
        session()->flash('message', 'Data Berhasil Diupdate.');

        //redirect
        return redirect()->route('sesis.index');
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.sesis.detail');
    }
}
