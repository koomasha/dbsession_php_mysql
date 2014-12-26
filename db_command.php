<?php
class db_command{
	public static function ExecuteNonQuery($db,$sql,$params){
		$conn = $db->get_connection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		return  $stmt->rowCount();			
	}
	
	public static function ExecuteQuery($db,$sql,$params = array()){
		$conn = $db->get_connection();
		$field_names = array();	
		$result = array();
		
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);

		$col_num = $stmt-> columnCount();
		
		for($i = 0; $i < $col_num; $i++)
		{
			$col_name = $stmt->getColumnMeta($i);
			$field_names[] = $col_name['name']; 
		}
		
		foreach ($stmt as $row) {
			$data =array();
			
			for($i = 0; $i < $col_num ;$i++) 
			{
				$data[$field_names[$i]] = $row[$i];
			}
			$result[] = $data;
		
   		}
		return  $result;	
	}
	
	public static function PerformInsert($db, $sql,$params){
		$conn = $db->get_connection();
		$stmt = $conn->prepare($sql);
		$stmt->execute($params);
		return  $conn->lastInsertId();
		
	}
	
}
?>