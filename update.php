<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
        $malam = isset($_POST['malam']) ? $_POST['malam'] : '';
        $pagi= isset($_POST['pagi']) ? $_POST['pagi'] : '';
        $siang = isset($_POST['siang']) ? $_POST['siang'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, hari = ?, malam = ?, pagi = ?, siang = ? WHERE id = ?');
        $stmt->execute([$id, $hari, $malam, $pagi, $siang, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="hari">Hari</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="hari" value="<?=$contact['hari']?>" id="hari">
        <label for="malam">Malam</label>
        <label for="notelp">Pagi</label>
        <input type="text" name="malam" value="<?=$contact['malam']?>" id="malam">
        <input type="text" name="pagi" value="<?=$contact['pagi']?>" id="pagi">
        <label for="siang">Siang</label>
        <input type="text" name="siang" value="<?=$contact['siang']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>