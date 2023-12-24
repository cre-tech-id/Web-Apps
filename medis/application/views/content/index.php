<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="<?= base_url('content/add'); ?>" class="btn btn-success">Tambah Data +</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <table class="table" id="data">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gambar</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Judul</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Deskripsi</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($content as $d): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <?php if ($d->img != Null): ?>
                                                        <img src="<?= base_url('assets/img/content/' . $d->img); ?>"
                                                            height="100" width="100">
                                                    <?php else: ?>
                                                        <p>Tidak ada Gambar.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $d->title ?>
                                        </td>
                                        <td>
                                            <?= $d->desc ?>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('content/up/' . $d->id); ?>">
                                                <i class="far fa-edit"></i></a> |
                                            <a href="<?= base_url('content/hapus/' . $d->id); ?>" onclick='return confirm("Apakah Yakin Dihapus?")'>
                                                <i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>