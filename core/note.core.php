<?php
class Note_Core 
{
	public function all() 
	{
		$data = Note::loadDataFile();		
		foreach($data as $feed_item_info)
		{
			$class_name = "Note";
			if ($feed_item_info[0] == $class_name) 
			{
				$feed_object = new $class_name($feed_item_info[1]);
				echo "<div>".$feed_object->feed_item()."</div>";				
			}
		}
	}
	
	public function one($id) 
	{
		$note = new Note($id);
		return $note->feed_item();
	}
	
	public function __call($func, $arg) 
	{
		header("HTTP/1.0 404 Not Found");
		die("Такой СТАТЬИ не обнаружено");
	}	
}
