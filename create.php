<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
    $malam = isset($_POST['malam']) ? $_POST['malam'] : '';
    $pagi = isset($_POST['pagi']) ? $_POST['pagi'] : '';
    $siang = isset($_POST['siang']) ? $_POST['siang'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $hari, $malam, $pagi, $siang]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create List</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="hari">Hari</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="hari" id="hari">
        <label for="malam">Malam</label>
        <label for="pagi">Pagi</label>
        <input type="text" name="malam" id="malam">
        <input type="text" name="pagi" id="pagi">
        <label for="siang">Siang</label>
        <input type="text" name="siang" id="siang">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>