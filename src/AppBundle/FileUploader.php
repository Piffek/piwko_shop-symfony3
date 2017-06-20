<?php

namespace AppBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
	private $targetDir;
	
	public function __construct($targetDir){
		$this->targetDir = $targetDir;
	}
	
	public function upload(UploadedFile $file){
		
		$filename = md5(uniqid()).'.'.$file->guessExtension();
		
		$file->move($this->targetDir, $filename);
		
		return $filename;
	}
	
	public function removeFile(UploadedFile $file)
	{
		$file_path = $this->targetDir.'/'.$file;
		 unlink($file_path->getClientOriginalName());
	}
	
	public function getTargetDir(){
		return $this->targetDir;
	}
}