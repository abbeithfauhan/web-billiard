# Image Upload Guide - Web Billiard

## Permasalahan yang Diperbaiki

Sebelumnya, gambar di turnamen tidak muncul ketika ditampilkan. Masalahnya adalah **symbolic link** yang menghubungkan folder `storage/app/public` ke folder `public/storage` belum di-buat.

## Solusi

### Step 1: Memahami Storage Configuration

Laravel menggunakan folder `storage/app/public` untuk menyimpan file yang dapat diakses secara publik. Agar file-file ini dapat diakses melalui web, Laravel membuat symbolic link ke folder `public/storage`.

**File Configuration**: `config/filesystems.php`

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
]
```

### Step 2: Membuat Symbolic Link

Symbolic link sudah dibuat secara otomatis oleh sistem. Jika belum ada, Anda bisa membuat dengan:

**Option A: Menggunakan Laravel Command**
```bash
php artisan storage:link
```

**Option B: Membuat Manual (jika tidak ada php)**
```bash
cd /path/to/project
ln -s ../storage/app/public public/storage
```

**Verifikasi**: Cek apakah file ada di `public/storage/` dengan membuka di browser:
```
http://localhost:8000/storage/
```

Jika menghasilkan folder listing, maka symbolic link sudah bekerja.

---

## Cara Upload Gambar Turnamen

### Admin Panel: Create/Edit Tournament

1. **Buka Admin Panel** → Navigate ke Manajemen Turnamen
2. **Klik "Create Tournament"** atau **Edit** Tournament yang sudah ada
3. **Upload Gambar**:
   - Pilih file gambar dari computer Anda
   - Format yang didukung: JPG, PNG, GIF, WebP
   - Ukuran maksimal: 2MB (configurable)
4. **Save**: Klik tombol "Save" untuk menyimpan

### Gambar akan disimpan di:
```
storage/app/public/tournaments/[filename.jpg]
```

### Gambar akan ditampilkan sebagai:
```
http://localhost:8000/storage/tournaments/[filename.jpg]
```

---

## Folder Structure

```
project/
├── public/
│   └── storage/  ← Symbolic link ke storage/app/public
├── storage/
│   └── app/
│       └── public/
│           └── tournaments/
│               ├── tournament-1.jpg
│               ├── tournament-2.png
│               └── ...
```

---

## Code Implementation

### Upload di Controller

Jika Anda ingin membuat controller yang menangani upload gambar:

```php
use Illuminate\Support\Facades\Storage;

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,gif,webp|max:2048',
    ]);

    // Upload gambar ke storage/app/public/tournaments/
    $imagePath = $request->file('image')->store('tournaments', 'public');

    Tournament::create([
        'name' => $validated['name'],
        'image' => $imagePath,  // Menyimpan relative path
    ]);

    return redirect()->route('tournaments.index')->with('success', 'Tournament created!');
}
```

### Menampilkan Gambar di View

```blade
@if($tournament->image)
    <img src="{{ asset('storage/' . $tournament->image) }}" 
         alt="{{ $tournament->name }}"
         class="w-full h-96 object-cover">
@else
    <img src="https://via.placeholder.com/400x250?text=No+Image" 
         alt="No Image Available">
@endif
```

---

## Views yang Sudah Diupdate

### 1. Tournament Index (`resources/views/tournaments/index.blade.php`)
```blade
<img src="{{ $tournament->image ? asset('storage/' . $tournament->image) : 'https://via.placeholder.com/400x250.png/1e293b/ffffff?text=Zone+Billiard' }}" 
     alt="Poster Turnamen">
```

### 2. Information Show (`resources/views/information/show.blade.php`)
```blade
@if($info->image)
    <img src="{{ asset('storage/' . $info->image) }}" 
         alt="{{ $info->title }}" 
         class="w-full h-96 object-cover">
@endif
```

---

## Troubleshooting

### Gambar Tidak Muncul?

**Issue 1: Symbolic Link Tidak Ada**
```bash
# Check apakah symbolic link sudah ada
ls -la public/storage

# Jika tidak ada, buat manual:
ln -s ../storage/app/public public/storage
```

**Issue 2: File Path Salah**
- Pastikan view menggunakan: `asset('storage/' . $model->image)`
- Bukan: `asset($model->image)` atau `$model->image` langsung

**Issue 3: Permissions**
```bash
# Jika ada permission error, set permissions:
chmod -R 755 storage/app/public
chmod -R 755 public/storage
```

**Issue 4: File Tidak Tersimpan**
```bash
# Check apakah folder storage/app/public writable:
ls -la storage/app/public

# Jika tidak, set permissions:
chmod -R 775 storage/app/public
```

---

## Storage Configuration Checklist

- [x] Symbolic link sudah dibuat (`public/storage`)
- [x] `config/filesystems.php` sudah configured dengan benar
- [x] `storage/app/public/` folder sudah writable (775 permissions)
- [x] Views menggunakan `asset('storage/' . $path)` untuk menampilkan gambar
- [x] Controller menggunakan `store('folder', 'public')` untuk menyimpan

---

## File Size & Validation

### Recommended Settings

```php
// Di model atau controller
$validated = $request->validate([
    'image' => 'required|image|mimes:jpeg,png,gif,webp|max:2048',
    // max:2048 = 2MB
]);

// Untuk file besar (hingga 5MB):
$validated = $request->validate([
    'image' => 'required|image|mimes:jpeg,png,gif,webp|max:5120',
    // max:5120 = 5MB
]);
```

---

## Security Considerations

1. **Always Validate File Type**
   ```php
   'image' => 'required|image|mimes:jpeg,png,gif,webp'
   ```

2. **Limit File Size**
   ```php
   'image' => 'max:2048'  // 2MB
   ```

3. **Never Trust User Input**
   ```php
   // Bad: $path = $request->file('image')->getClientOriginalName();
   // Good: $path = $request->file('image')->store('tournaments', 'public');
   ```

4. **Use Storage Facade** (Recommended)
   ```php
   use Illuminate\Support\Facades\Storage;
   
   $path = Storage::disk('public')->put('tournaments', $request->file('image'));
   ```

---

## Testing Upload

### Manual Test

1. Go to: `http://localhost:8000/admin/tournaments/create`
2. Fill tournament data
3. Upload image
4. Click Save
5. Check if image appears in tournament list
6. Click tournament to see image in detail

### Verify File Saved

```bash
# Check if file exists in storage
ls -la storage/app/public/tournaments/

# Check if symbolic link works
ls -la public/storage/tournaments/
```

---

## Performance Tips

1. **Compress Images Before Upload**
   - Use tool seperti: TinyPNG, ImageOptim, ImageMagick
   - Kurangi file size untuk performa lebih cepat

2. **Use CDN** (Production)
   - Upload ke S3, Cloudinary, atau CDN lainnya
   - Update `FILESYSTEM_DISK=s3` di `.env`

3. **Generate Thumbnails**
   - Gunakan library seperti: Image Intervention
   - Buat thumbnail untuk listing, full image untuk detail

---

## API Response

Ketika upload sukses, response akan berisi:

```json
{
    "success": true,
    "message": "Tournament created successfully",
    "tournament": {
        "id": 1,
        "name": "Tournament Name",
        "image": "tournaments/xyz123.jpg",
        "image_url": "http://localhost:8000/storage/tournaments/xyz123.jpg"
    }
}
```

---

## Summary

**Apa yang sudah diperbaiki:**
- Symbolic link dibuat untuk menghubungkan `storage/app/public` ke `public/storage`
- Views sudah menggunakan path yang benar dengan `asset('storage/' . $image)`
- Folder permissions sudah di-set untuk allow file uploads
- Storage configuration sudah benar di `config/filesystems.php`

**Hasil:**
- Gambar turnamen sekarang akan muncul dengan benar
- Gambar informasi juga akan ditampilkan dengan benar
- Upload baru akan tersimpan dan langsung tampil di aplikasi

---

**Last Updated**: 28 Juni 2026
**Status**: Ready to Use

