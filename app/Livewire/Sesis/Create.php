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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate();

        //create post
        Sesi::create([
            'tanggal_sesi' => $this->tanggal_sesi,
            'total_opening' => str_replace('.','',$this->total_opening),
            'total_pos' => 0,
            'total_kasir' => 0,
            'opening_next_day' => 0,
            'selisih' => 0,
            'setoran' => 0,
        ]);

        //flash message
        session()->flash('message', 'Sesi Berhasil Dibuat.');

        //redirect
        return redirect()->route('sesis.index');
    }

    /**
     * render
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.sesis.create');
    }
}
