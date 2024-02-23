<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                return $next($request);
            } else {
                return redirect('/');
            }
        });
    }
    public function index()
    {
        $Transaksis = Transaksi::with('barang')->get();
        return view('dashboard', compact('Transaksis'));
    }

    public function create()
    {
        $Barangs = Barang::all();
        return view('insertformtransaksi', compact('Barangs'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'barang' => 'required',
            'harga' => 'required|min:3',
            'total_item' => 'required|min:1',
            'total_harga' => 'required|min:3',
        ]);
        Transaksi::create([
            'id_barang' => $request->barang,
            'total_item' => $request->total_item,
            'total_harga' => $request->total_harga,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('home')->with(['success', 'Anjay Berhasil']);
    }

    public function destroy($id)
    {
        $Barangs = Transaksi::with('barang')->findOrFail($id);

        $Barangs->delete();

        return redirect()->route('home')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function NotaTransaksi($id)
    {
        $detail = Transaksi::where('id_transaksi', $id)->firstOrFail();
        $detail = Transaksi::where('id_transaksi', $id)->get();
        return view('nota', compact('detail'));
    }
}