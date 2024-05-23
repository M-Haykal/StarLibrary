<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Siswa;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function create_category(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories',
        ]);

        Category::create($validatedData);

        return redirect()->route('panel_kategori_petugas')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit_category(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|unique:categories,name,' . $id,
    ]);

    $category = Category::findOrFail($id);
    $category->name = $validatedData['name']; // Perbarui nama kategori
    $category->save(); // Simpan perubahan

    return redirect()->route('panel_kategori_petugas')->with('success', 'Kategori berhasil diperbarui');
}


    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('panel_kategori_petugas')->with('success', 'Kategori berhasil dihapus');
    }

}
