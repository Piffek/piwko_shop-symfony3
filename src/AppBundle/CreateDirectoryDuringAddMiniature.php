<?php

namespace AppBundle;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use AppBundle\Entity\MiniatureImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateDirectoryDuringAddMiniature implements DirectoryNamerInterface
{
	/**
	 * 
	 * @param MiniatureImage $miniature
	 */
	public function directoryName($miniature, PropertyMapping $mapping){
		return $miniature->getItem()->getId();
	}

	
}