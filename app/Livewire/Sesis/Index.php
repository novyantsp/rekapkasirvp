<?php

namespace App\Livewire\Sesis;

use App\Models\Sesi;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public function render()
    {
        return view('livewire.sesis.index', [
            'sesis' => Sesi::latest()->paginate(5)
        ]);
    }

    public function destroy($id)
    {
        //destroy
        Sesi::destroy($id);

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('sesis.index');
    }

}
