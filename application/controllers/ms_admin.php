<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms_admin extends MY_Controller 
{
    var $parent_page = "ms_admin";
	function __construct()
	{
            parent::__construct(); 
			// Load session library
			$this->load->library('session');
     	  $this->load->helper('url');
       	 $this->load->library('gcharts');
	
	}
        
    private function viewpage($page='ms_mainpage', $data=array())
    {
			echo $this->load->view('ms_header', $data, true);
            echo $this->load->view($this->parent_page.'/ms_menu', $data, true);
            echo $this->load->view($this->parent_page.'/'.$page, $data, true);
            echo $this->load->view('ms_footer', $data, true);
    }


        public function index()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
				
				    $crud = new grocery_CRUD();
					$crud->set_theme('datatables');
					$crud->set_table('users')
						->set_subject('Users')
						->columns('us_id','type_id','name','ic_no','address','email');
				 
					$crud->add_fields('us_id','type_id','name','ic_no');
					$crud->edit_fields('us_id','type_id','name');
				 
					$crud->required_fields('us_id','type_id');
					$crud->display_as('type_id','Type of User');
					$crud->set_relation('type_id','typeofuser','user_type');
					$crud->unset_fields('username','password');

					$output = $crud->render();
					$this->viewpage('ms_mainpage', $output);			
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function inventory()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');    
                $crud->set_table('inventory');
				$crud->set_relation('us_id','users','name');
				//$crud->columns('iv_id','item_name','price','us_id');
				/*$crud->field_type('body','multiselect',
            array('1' => 'active', '2' => 'private','3' => 'spam' , '4' => 'deleted'));*/

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function vendor()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');
                
                $crud->set_table('vendor');

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
        }
		public function sales()
	    {
			if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$password = ($this->session->userdata['logged_in']['password']);
			}
            try {
                $crud = new grocery_CRUD();

                $crud->set_theme('datatables');
                $crud->set_table('sales');
				$crud->unset_columns('sl_id');
				$crud->set_relation('iv_id','inventory','item_name');
				$crud->display_as('iv_id','Name of Item')
					 ->display_as('qty','quantity')
					 ->display_as('qty_sold','Quantity sold');

                $output = $crud->render();

                $this->viewpage('ms_mainpage', $output);
                
            } catch (Exception $e) {
                show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
            }
			
       	    }
/* ---------- Line Charts ---------- */
    public function line_chart_basic()
    {
        $this->gcharts->load('LineChart');

        $this->gcharts->DataTable('Stocks')
                      ->addColumn('number', 'Count', 'count')
                      ->addColumn('number', 'Projected', 'projected')
                      ->addColumn('number', 'Official', 'official');

        for($a = 1; $a < 25; $a++)
        {
            $data = array(
                $a,             //Count
                rand(800,1000), //Line 1's data
                rand(800,1000)  //Line 2's data
            );

            $this->gcharts->DataTable('Stocks')->addRow($data);
        }

        $config = array(
            'title' => 'Stocks'
        );

        $this->gcharts->LineChart('Stocks')->setConfig($config);

        $this->load->view('gcharts/line_chart_basic');
    }

    public function line_chart_advanced()
    {
        $this->gcharts->load('LineChart');

        $this->gcharts->DataTable('Times')
             ->addColumn('date', 'Dates', 'dates')
             ->addColumn('number', 'Run Time', 'run_time')
             ->addColumn('number', 'Schedule Time', 'schedule_time');

        for($a = 1; $a < 30; $a++)
        {
            $data = array(
                new jsDate(2013, 8, $a), //Date object
                rand(1,10),              //Line 1's data
                rand(1,10),              //Line 2's data
            );

            $this->gcharts->DataTable('Times')->addRow($data);
        }

        //Either Chain functions together to set configuration options
        $titleStyle = $this->gcharts->textStyle()
                                    ->color('#FF0A04')
                                    ->fontName('Georgia')
                                    ->fontSize(18);

        $legendStyle = $this->gcharts->textStyle()
                                     ->color('#F3BB00')
                                     ->fontName('Arial')
                                     ->fontSize(20);

        $legend = $this->gcharts->legend()
                                ->position('bottom')
                                ->alignment('start')
                                ->textStyle($legendStyle);

        //Or pass an array with the configuration options into the function
        $tooltipStyle = new textStyle(array(
                        'color' => '#C0C0B0',
                        'fontName' => 'Courier New',
                        'fontSize' => 10
                    ));

        $tooltip = new tooltip(array(
                        'showColorCode' => TRUE,
                        'textStyle' => $tooltipStyle
                    ));


        $config = array(
            'backgroundColor' => new backgroundColor(array(
                'stroke' => '#BBBBBB',
                'strokeWidth' => 8,
                'fill' => '#EFEFFF'
            )),
            'chartArea' => new chartArea(array(
                'left' => 100,
                'top' => 75,
                'width' => '85%',
                'height' => '55%'
            )),
            'titleTextStyle' => $titleStyle,
            'legend' => $legend,
            'tooltip' => $tooltip,
            'title' => 'Times for Deliveries',
            'titlePosition' => 'out',
            'curveType' => 'function',
            'width' => 1000,
            'height' => 450,
            'pointSize' => 3,
            'lineWidth' => 1,
            'colors' => array('#4F9CBB', 'green'),
            'hAxis' => new hAxis(array(
                'baselineColor' => '#fc32b0',
                'gridlines' => array(
                    'color' => '#43fc72',
                    'count' => 6
                ),
                'minorGridlines' => array(
                    'color' => '#b3c8d1',
                    'count' => 3
                ),
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#C42B5F',
                    'fontName' => 'Tahoma',
                    'fontSize' => 10
                )),
                'slantedText' => TRUE,
                'slantedTextAngle' => 30,
                'title' => 'Delivery Dates',
                'titleTextStyle' => new textStyle(array(
                    'color' => '#BB33CC',
                    'fontName' => 'Impact',
                    'fontSize' => 14
                )),
                'maxAlternation' => 6,
                'maxTextLines' => 2
            )),
            'vAxis' => new vAxis(array(
                'baseline' => 1,
                'baselineColor' => '#CF3BBB',
                'format' => '## hrs',
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#DDAA88',
                    'fontName' => 'Arial Bold',
                    'fontSize' => 10
                )),
                'title' => 'Delivery Time',
                'titleTextStyle' => new textStyle(array(
                    'color' => '#5C6DAB',
                    'fontName' => 'Verdana',
                    'fontSize' => 14
                )),
            ))
        );

        $this->gcharts->LineChart('Times')->setConfig($config);

        $this->load->view('gcharts/line_chart_advanced');
    }		
}
