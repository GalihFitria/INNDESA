<?php
namespace App\Http\Controllers\Admin_Kelompok;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\Kelompok;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
         *   HAPUS LOGO / BACKGROUND
         *  ========================= */
        if ($request->delete_logo == "1") {
            if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo)) {
                Storage::disk('public')->delete($kelompok->logo);
            }
            $kelompok->logo = null;
        }

        if ($request->delete_background == "1") {
            if ($kelompok->background && Storage::disk('public')->exists($kelompok->background)) {
                Storage::disk('public')->delete($kelompok->background);
            }
            $kelompok->background = null;
        }

        /** =========================
         *   HANDLE LOGO
         *  ========================= */
        if ($request->filled('cropped_logo')) {
            if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo)) {
                Storage::disk('public')->delete($kelompok->logo);
            }

            $originalName = $request->input('logo_original_name', 'logo.jpg');
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';

            $fileName = $this->uniqueFileName("logo/$baseName", $extension);

            $imageData = $request->input('cropped_logo');
            $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
            Storage::disk('public')->put($fileName, base64_decode($image));

            $kelompok->logo = $fileName;
        } elseif ($request->hasFile('logo')) {
            if ($kelompok->logo && Storage::disk('public')->exists($kelompok->logo)) {
                Storage::disk('public')->delete($kelompok->logo);
            }

            $originalName = $request->file('logo')->getClientOriginalName();
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $request->file('logo')->getClientOriginalExtension();

            $fileName = $this->uniqueFileName("logo/$baseName", $extension);

            // Simpan di folder "logo"
            $request->file('logo')->storeAs('logo', basename($fileName), 'public');
            $kelompok->logo = $fileName;
        }

        /** =========================
         *   HANDLE BACKGROUND
         *  ========================= */
        if ($request->filled('cropped_background')) {
            if ($kelompok->background && Storage::disk('public')->exists($kelompok->background)) {
                Storage::disk('public')->delete($kelompok->background);
            }

            $originalName = $request->input('background_original_name', 'background.jpg');
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = pathinfo($originalName, PATHINFO_EXTENSION) ?: 'jpg';

            $fileName = $this->uniqueFileName("background/$baseName", $extension);

            $imageData = $request->input('cropped_background');
            $image = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
            Storage::disk('public')->put($fileName, base64_decode($image));

            $kelompok->background = $fileName;
        } elseif ($request->hasFile('background')) {
            if ($kelompok->background && Storage::disk('public')->exists($kelompok->background)) {
                Storage::disk('public')->delete($kelompok->background);
            }

            $originalName = $request->file('background')->getClientOriginalName();
            $baseName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $request->file('background')->getClientOriginalExtension();

            $fileName = $this->uniqueFileName("background/$baseName", $extension);

            $request->file('background')->storeAs('background', basename($fileName), 'public');
            $kelompok->background = $fileName;
        }

        $kelompok->save();

        return redirect()->to("/Admin_Kelompok/kelompok/" . $kelompok->id_kelompok)
            ->with('success', 'Logo & Background berhasil diperbarui!');
    }

    /**
     * Generate nama file unik (pakai folder).
     */
    private function uniqueFileName($baseNameWithFolder, $extension)
    {
        $fileName = $baseNameWithFolder . '.' . $extension;
        $counter = 1;
        while (Storage::disk('public')->exists($fileName)) {
            $fileName = $baseNameWithFolder . '_' . $counter . '.' . $extension;
            $counter++;
        }
        return $fileName;
    }
}
