<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['nama_produk']) && !empty($_POST['keterangan']) && $_POST['harga'] ? $_POST['jumlah'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
    $ket = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';

    // Insert new record into the produk table
    $stmt = $pdo->prepare('INSERT INTO produk VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id,$nama, $ket, $harga, $jumlah]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Produk</h2>
    <form action="create.php" method="post">
        <label type="text" for="nama_produk">Produk</label>
        <input  name="nama_produk" id="nama_produk">
        <label type="text" for="keterangan">Keterangan</label>
        <input  name="keterangan" id="keterangan">
        <label for="harga">Harga</label>
        <input type="varchar(100)" name="harga" id="harga">
        <label for="jumlah">Jumlah</label>
        <input type="varchar(100)" name="jumlah" id="jumlah">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>