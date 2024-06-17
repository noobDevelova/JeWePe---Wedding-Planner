<?php include __DIR__ . '/../partials/header.php'; ?>
<h1>Tambah Produk</h1>
<div class="card shadow mb-4 p-3">
    <div class="card-header py-3 mb-3">
        <h6 class="m-0 font-weight-bold text-primary">Buat Produk Baru</h6>
    </div>
    <form action="index.php?controller=product&action=addProduct" method="POST" enctype="multipart/form-data">
        <div class="row mb-3 vertical-middle wrapper">
            <div class="col-6">
                <label for="namaPaket" class="form-label">Nama paket</label>
                <input type="text" class="form-control" name="package_name" id="namaPaket" placeholder="Nama Paket">
            </div>
            <div class="col-4">

                <label class="form-label">Gambar Paket</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="package_image">
                    <label class="custom-file-label">Pilih file...</label>
                </div>
            </div>
        </div>

        <input type="hidden" id="deskripsiHidden" name="description">

        <div id="editor" class="mb-2">

        </div>

        <div class="row">
            <div class="col-6">
                <label for="hargaPaket" class="form-label">Harga</label>
                <input type="number" class="form-control" name="price" id="hargaPaket" placeholder="Harga Paket">
            </div>

            <div class="col-6">
                <label for="exampleFormControlInput1" class="form-label">Status Paket</label>
                <select class="custom-select" name="status_publish" aria-label="Default select example">
                    <option value="showed">Ditampilkan</option>
                    <option value="drafted">Disimpan</option>
                </select>
            </div>

        </div>
        <div class="mt-3">
            <a href=" index.php?controller=product&action=index" class="btn btn-danger">Kembali</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    quill.on('text-change', function() {
        var html = quill.root.innerHTML;
        document.getElementById('deskripsiHidden').value = html; // Simpan nilai ke input tersembunyi
    });
</script>
<?php include __DIR__ . '/../partials/footer.php'; ?>