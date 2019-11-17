<?php


class table_generator{

	public $css_class = '';
	public $table_ext = [];
	public $head = '';
	public $row = [];

	public function __construct($class = '', $ext = NULL){
		$this->css_class = $class;
		$this->table_ext = $ext;
	}

	public function init($class = '', $ext = NULL){
		$this->css_class = $class;
		$this->table_ext = $ext;
	}

	public function set_heading(){
		$this->head ='<thead>
	        <tr>
	            <th rowspan="2">Name</th>
	            <th colspan="2">Source</th>
	        </tr>
	        <tr>
	            <th>Size</th>
	            <th>Url</th>
	        </tr>
	    </thead>';
	    return $this->head;
	}

	public function gen_ext(){
		$ret = '';
		foreach ($this->table_ext as $k => $v) {
			$ret .= $k.' = "'; 
			$ret .= $v; 
			$ret .= '" '; 
		}
		return $ret;
	}

	public function add_row($row){
		$ret = '<tr>';
		$ret .= "<td rowspan=\"".sizeof($row['data'])."\" >$row[name]</td>";
			foreach ($row['data'] as $k => $v) {
				if($k>0){
					$ret .= '<tr>';
				}
				$ret .= "<td>$v[size]</td>";
				$ret .= "<td><a href=\"$v[url]\" class=\"btn btn-lg btn-success\" target=\"blank\">visit</a></td>";
				$ret .= '</tr>';
			}
		array_push($this->row, $ret);
	}


	public function generate(){
		$ret = '<table class="'.$this->css_class.'" '.$this->gen_ext().' >';

		$ret .= $this->set_heading();
		
		$ret .= join($this->row);

		$ret .= '</table>';
		return $ret;
	}

}


?>