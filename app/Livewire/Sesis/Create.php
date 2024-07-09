<?php

namespace App\Livewire\Sesis;

use App\Models\Sesi;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Create extends Component
{
    //Tanggal Sesi
    #[Rule('required', message: 'Masukkan Tanggal Sesi')]
    public $tanggal_sesi;

    //Opening Total
    #[Rule('required', message: 'Masukkan Total Opening')]
    public $total_opening;

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $this->validate();

        //create post
        Sesi::create([
            'tanggal_sesi' => $this->tanggal_sesi,
            'total_opening' => $this->total_opening,
        ]);

        //flash message
        session()->flash('message', 'Sesi Berhasil Dibuat.');

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
        return view('livewire.sesis.create');
    }
}
