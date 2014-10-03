<?php

class Tabler{

	function getBreak(){
		return "\n";
	}

	function getColumnNamesFromArray($arr){
		return array_keys($arr[0]);
	}

	function getLine($row){
		$str = '';
		foreach($row as $column){//
			$str.='+';
			for($i=0; $i<strlen($column)+2;$i++){
				$str.='-';
			}
		}
		return $str.='+'.$this->getBreak();
	}

	function getStringFromRow($row, $delimiter = ' | '){
		$str = $delimiter;
		$str.=join($delimiter, $row);
		$str.= $delimiter.$this->getBreak();

		return trim($str);
	}

	function arrangeRowToColumns($row, $columns){
		$r = array();
		foreach($columns as $column){
			$r[$column] = $row[$column];
		}

		return $r;
	}

	function generate($arr){
		// $arr must be an array
		if(!is_array($arr)){
			return false;
		}

		// passed array must not be empty
		if(!count($arr)>0){
			return false;
		}

		$result = '';
		$columns = $this->getColumnNamesFromArray($arr);
		$result.=$this->getLine($columns);
		$result.=$this->getStringFromRow($columns);

		foreach($arr as $row){
			$result.=$this->getBreak();
			$result.=$this->getLine($row);
			// arrange as per the columns
			$row = $this->arrangeRowToColumns($row, $columns);
			$result.=$this->getStringFromRow($row);

		}
		$result.=$this->getBreak();
		$result.=$this->getLine($columns);
		return $result;
	}

}

