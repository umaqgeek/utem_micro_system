<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);

} else {
header("location: login");
}
?>

<div class="row" style="margin-top: 5%;">
 <div class="col-md-8 col-md-offset-2">
 <h1 align="center">MICRO SYSTEM</h1>
<?php
echo "<br/>";
echo "You Login as  <b>".$username;
echo "</b><br/>";

?>        
        
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
        
<?php echo $output; ?>
        
    </div>
</div>