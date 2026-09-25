<?php
require_once('function.php');
include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data User</h1>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <button type="button"
                class="btn btn-primary btn-icon-split"
                data-toggle="modal"
                data-target="#tambahModal">

                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>

                <span class="text">Tambah User</span>

            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered"
                    id="dataTable"
                    width="100%"
                    cellspacing="0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>User Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // penomoran auto-increment
                        $no = 1;

                        // Query untuk memanggil semua data dari tabel users
                        $users = query("SELECT * FROM users");

                        foreach ($users as $user) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['user_role'] ?></td>
                                <td>
                                    <a class="btn btn-success"
                                        href="edit-user.php?id=<?= $user['id_user'] ?>">Ubah</a>

                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        class="btn btn-danger"
                                        href="hapus-user.php?id=<?= $user['id_user'] ?>">Hapus</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>