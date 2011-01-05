<?php
class FileComponent extends Object {

  function upload($formdata, $filename)
		{
		$folder = WWW_ROOT.'uploads/'.date('Y').'/'.date('m');     
    if(!is_dir($folder))
      {
      mkdir($folder);  
      }
    	
		foreach($formdata['Upload'] as $file)
			{
			if(!$this->is_image($file['type']))
        {
        $return = 0;
        } else {
        if (is_uploaded_file($file['tmp_name']) AND move_uploaded_file($file['tmp_name'], $folder.'/'.$filename))
      		{
       		$return = 1;
       		} else {
       		$return = 0;
       		}
        }
      }
		return $return;
		}
    
  function is_image($type)
    {
		$allowed_types = array('image/gif', 'image/jpeg', 'image/png');
		return in_array($type, $allowed_types);
    }	
		
	function delete($filename)
		{
		if (unlink(WWW_ROOT.$filename))
		  {
		  return 1;
      } else {
      return 0;
      }
		}
    	
}
?>
