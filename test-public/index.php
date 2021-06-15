<?php
require_once '../vendor/autoload.php';

$fa = new \PlaygroundStudio\BlackBridge\Securities\Google2FA();




//$secret = $fa->generateSecretKey();
$secret = "QNVRVNWBIOLKTL3P";
echo "Secret: " . $secret . "<br>";
$fa->setSecretKey($secret);
echo "Link: " . $fa->getGeneratedLink('NSRU', 'napadon.k');

if(isset($_GET['key'])) {
    $key = $_GET['key'];
} else {
    $key = "";
}

?>

<form action="index.php">
    <input type="text" name="key" value="<?php echo $key ?>">
    <input type="submit">
</form>

<?php
if($key != '')
{
    var_dump($fa->verifyKey($key));
}
?>