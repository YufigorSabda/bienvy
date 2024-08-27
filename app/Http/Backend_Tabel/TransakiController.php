// app/Http/Controllers/TransaksiController.php

<?php

// namespace App\Http\Controllers;
//
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return response()->json($transaksis);
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($transaksi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'waktu' => 'required',
            'id_kawasan' => 'required',
            'jumlah_muatan' => 'required',
            'keterangan' => 'required',
        ]);

        $transaksi = Transaksi::create($request->all());
        return response()->json($transaksi, 201);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        $request->validate([
            'waktu' => 'required',
            'id_kawasan' => 'required',
            'jumlah_muatan' => 'required',
            'keterangan' => 'required',
        ]);

        $transaksi->update($request->all());
        return response()->json($transaksi, 200);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        $transaksi->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}
//