<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);

} else {
header("location: ms_login");
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
echo $this->gcharts->LineChart('Stocks')->outputInto('stock_div');
echo $this->gcharts->div(600, 300);

if($this->gcharts->hasErrors())
{
    echo $this->gcharts->getErrors();
}?>
        
    </div>
</div>