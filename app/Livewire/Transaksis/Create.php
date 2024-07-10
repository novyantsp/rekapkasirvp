<?php

namespace App\Livewire\Transaksis;

use App\Models\Transaksi;
use Livewire\Component;

class Create extends Component
{
    //Jenis Transaksi
    #[Rule('required', message: 'Pilih Jenis Transaksi')]
    public $jenis_transaksi;

    //Nominal Transaksi
    #[Rule('required', message: 'Masukkan Nominal Transaksi')]
    public $nominal_transaksi;

    /**
     * store
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->validate();

        //create post
        Transaksi::create([
            'jenis_transaksi' => $this->jenis_transaksi,
            'nominal_transaksi' => str_replace('.', '', $this->nominal_transaksi),
            'keterangan_transaksi' => $this->keterangan_transaksi,
            'sesi_id' => $this->sesi_id
        ]);

        //flash message
        session()->flash('message', 'Transaksi Berhasil Dicatat.');

        //redirect
        return redirect()->route('transaksi.index');
    }
    public function render()
    {
        return view('livewire.transaksis.create');
    }
}
