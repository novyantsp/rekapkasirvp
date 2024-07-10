<?php

namespace App\Livewire\Sesis;

use App\Models\Sesi;
use App\Models\Transaksi;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Detail extends Component
{
    //id post
    public $sesiID;
    public $total_pos;
    public $total_kasir;
    public $opening_next_day;

    //Tanggal Sesi
    #[Rule('required', message: 'Masukkan Tanggal Sesi')]
    public $tanggal_sesi;

    //Opening Total
    #[Rule('required', message: 'Masukkan Total Opening')]
    public $total_opening;

//    #[Rule('required', message: 'Pilih Jenis Transaksi')]
    public $jenis_transaksi;

//    #[Rule('required', message: 'Nominal Tidak Boleh Kosong')]
    public $nominal_transaksi;

//    #[Rule('required', message: 'Keterangan Tidak Boleh Kosong')]
    public $keterangan_transaksi;
    public $total_opening_a;
    public $total_pos_a;
    public $total_kasir_a;
    public $opening_next_day_a;


    public function mount($id): void
    {
        //get post
        $sesi = Sesi::find($id);

        //assign
        $this->sesiID = $sesi->id;
        $this->tanggal_sesi = $sesi->tanggal_sesi;
        $this->total_opening = number_format($sesi->total_opening, 0,'','.');
        $this->total_pos = number_format($sesi->total_pos,0,'','.');
        $this->total_kasir = number_format($sesi->total_kasir,0,'','.');
        $this->opening_next_day = number_format($sesi->opening_next_day,0,'','.');

        //angka
        $this->total_opening_a = $sesi->total_opening;
        $this->total_pos_a = $sesi->total_pos;
        $this->total_kasir_a = $sesi->total_kasir;
        $this->opening_next_day_a = $sesi->opening_next_day;

//        dd($this->selisih);
    }


    /**
     * update
     *
     * @return string
     */
    public function closeKasir(): string
    {
//        dd($this->only([
//            'tanggal_sesi',
//            str_replace('.','','total_opening'),
//            str_replace('.','','total_pos'),
//            str_replace('.','','total_kasir'),
//            str_replace('.','','opening_next_day'),
//            'sesiID'
//        ]));
        $total_uang_keluar = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 1)->sum('nominal_transaksi');
        $total_uang_masuk = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 2)->sum('nominal_transaksi');
        $total_uang_bank = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 3)->sum('nominal_transaksi');

        $this->validate();


        //get post
        $sesi = Sesi::find($this->sesiID);

        $total_opening = str_replace('.','',$this->total_opening);
        $total_pos = str_replace('.','',$this->total_pos);
        $total_kasir = str_replace('.','',$this->total_kasir);
        $opening_next_day = str_replace('.','',$this->opening_next_day);

        $total_perhitungan = ($total_opening + ($total_pos - $total_uang_bank) + ($total_uang_masuk - $total_uang_keluar));


        //update post
        $sesi->update([
            'tanggal_sesi' => $this->tanggal_sesi,
            'total_opening' => $total_opening,
            'total_pos' => $total_pos,
            'total_kasir' => $total_kasir,
            'opening_next_day' => $opening_next_day,
            'selisih' => $total_kasir - $total_perhitungan,
            'setoran' => $total_kasir - $opening_next_day,
        ]);


        //flash message
        session()->flash('message', 'Data Rekap telah diperbarui.');

        //redirect
//        return redirect(request()->header('Referer'));
        return url()->previous();
    }

    public function store_transaksi(): string
    {
//        dd($this->only(['jenis_transaksi', str_replace('.','','nominal_transaksi'), 'keterangan_transaksi', 'sesiID']));

        $this->validate([
            'jenis_transaksi' => 'required',
            'nominal_transaksi' => 'required',
            'keterangan_transaksi' => 'required'
        ]);

        //create post
        Transaksi::create([
            'jenis_transaksi' => $this->jenis_transaksi,
            'nominal_transaksi' => str_replace('.', '', $this->nominal_transaksi),
            'keterangan_transaksi' => $this->keterangan_transaksi,
            'sesi_id' => $this->sesiID
        ]);

        //flash message
        session()->flash('message', 'Transaksi Berhasil Dihapus.');

        //redirect
        return url()->previous();
    }

    public function destroy_transaksi($id): string
    {
        //destroy
        Transaksi::destroy($id);

        //flash message
        session()->flash('message', 'Transaksi Berhasil Dihapus.');

        //redirect
        return url()->previous();
    }

    /**
     * render
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|View
     */
    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|View|Application
    {
        $total_uang_keluar = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 1)->sum('nominal_transaksi');
        $total_uang_masuk = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 2)->sum('nominal_transaksi');
        $total_uang_bank = Transaksi::where('sesi_id', $this->sesiID)->where('jenis_transaksi', '=', 3)->sum('nominal_transaksi');
//        $selisih = $this->total_kasir_a - (($this->total_opening_a + ($this->total_pos_a - $total_uang_bank) + ($total_uang_masuk - $total_uang_keluar)));
//        $selisih = $this->total_kasir_a - $total_perhitungan;
//        $setoran = $this->total_kasir_a - $this->opening_next_day_a;

//        dd($selisih);

        return view('livewire.sesis.detail', [
            'transaksis' => Transaksi::where('sesi_id', $this->sesiID)->get(),
            'total_uang_keluar' => $total_uang_keluar,
            'total_uang_masuk' => $total_uang_masuk,
            'total_uang_bank' => $total_uang_bank,
            'selisih_baru' => Sesi::where('id', $this->sesiID)->get('selisih')[0]->selisih,
            'setoran_baru' => Sesi::where('id', $this->sesiID)->get('setoran')[0]->setoran,
        ]);
    }
}
