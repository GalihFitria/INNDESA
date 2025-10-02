<?php
namespace App\Http\Controllers\Admin_Kelompok;
use App\Http\Controllers\Controller;  

use Illuminate\Http\Request;
use App\Models\Kelompok;
use Illuminate\Support\Str;



use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EditLogoBackgroundController extends Controller
{

    
    
  public function edit($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        return view('Admin_Kelompok.edit_logo_background', compact('kelompok'));
    }


   public function update(Request $request, $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        /** =========================
     *   HANDLE HAPUS LOGO & BACKGROUND
     *  ========================= */
    if ($request->delete_logo == "1") { // 👈 tambahan
        if ($kelompok->logo && Storage::disk('public')->exists('logo/' . $kelompok->logo)) {
            Storage::disk('public')->delete('logo/' . $kelompok->logo);
        }
        $kelompok->logo = null;
    }

    if ($request->delete_background == "1") { // 👈 tambahan
        if ($kelompok->background && Storage::disk('public')->exists('background/' . $kelompok->background)) {
            Storage::disk('public')->delete('background/' . $kelompok->background);
        }
        $kelompok->background = null;
    }

        /** =========================
         *   HANDLE LOGO
         *  ========================= */
        if ($request->filled('cropped_logo')) {
            // Hapus file lama
            if ($kelompok->logo && Storage::disk('public')->exists('logo/' . $kelompok->logo)) {
                Storage::disk('public')->delete('logo/' . $kelompok->logo);
            }

            // Ambil nama file asli dari input hidden atau dari request->file jika ada
            $originalName = $request->input('logo_original_name', 'logo'); // <--- pastikan di JS kirimkan
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';

            // Pastikan tidak menimpa file yang sudah ada
            $fileName = $baseName . '.' . $extension;
            $counter = 1;
            while (Storage::disk('public')->exists('logo/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            // Simpan file hasil crop (base64)
            $imageData = $request->input('cropped_logo');
            $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
            Storage::disk('public')->put('logo/' . $fileName, base64_decode($image));

            $kelompok->logo = $fileName;
        } elseif ($request->hasFile('logo')) {
            if ($kelompok->logo && Storage::disk('public')->exists('logo/' . $kelompok->logo)) {
                Storage::disk('public')->delete('logo/' . $kelompok->logo);
            }

            $originalName = $request->file('logo')->getClientOriginalName();
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileName = $baseName . '.' . $extension;
            $counter = 1;
            while (Storage::disk('public')->exists('logo/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $request->file('logo')->storeAs('logo', $fileName, 'public');
            $kelompok->logo = $fileName;
        }

        /** =========================
         *   HANDLE BACKGROUND
         *  ========================= */
        if ($request->filled('cropped_background')) {
            if ($kelompok->background && Storage::disk('public')->exists('background/' . $kelompok->background)) {
                Storage::disk('public')->delete('background/' . $kelompok->background);
            }

            $originalName = $request->input('background_original_name', 'background');
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';

            $fileName = $baseName . '.' . $extension;
            $counter = 1;
            while (Storage::disk('public')->exists('background/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $imageData = $request->input('cropped_background');
            $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
            Storage::disk('public')->put('background/' . $fileName, base64_decode($image));

            $kelompok->background = $fileName;
        } elseif ($request->hasFile('background')) {
            if ($kelompok->background && Storage::disk('public')->exists('background/' . $kelompok->background)) {
                Storage::disk('public')->delete('background/' . $kelompok->background);
            }

            $originalName = $request->file('background')->getClientOriginalName();
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $request->file('background')->getClientOriginalExtension();

            $fileName = $baseName . '.' . $extension;
            $counter = 1;
            while (Storage::disk('public')->exists('background/' . $fileName)) {
                $fileName = $baseName . '_' . $counter . '.' . $extension;
                $counter++;
            }

            $request->file('background')->storeAs('background', $fileName, 'public');
            $kelompok->background = $fileName;
        }

        $kelompok->save();

        return redirect()->to("/Admin_Kelompok/kelompok/" . $kelompok->id_kelompok)
            ->with('success', 'Logo & Background berhasil diperbarui!');
    }

}
