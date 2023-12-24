<div class="container-fluid py-4">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url('content/index'); ?>" class="btn btn-primary">Kembali</a>
                    <form action="<?= base_url('content/insert'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Gambar</label>
                                    <input class="form-control" type="file" name="img">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Judul</label>
                                    <input class="form-control" name="title" type="text">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-success btn-sm ms-auto">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>