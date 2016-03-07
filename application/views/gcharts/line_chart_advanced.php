<h1>Sales Graph</h1>
<?php
    echo $this->gcharts->LineChart('Times')->outputInto('time_div');
    echo $this->gcharts->div(800, 500);

    if($this->gcharts->hasErrors())
    {
        echo $this->gcharts->getErrors();
    }
?>

<hr />

