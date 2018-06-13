<?php
namespace AdminBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUpload
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return array(
            'path' => $this->getTargetDir(),
            'fileName' => $fileName
        );
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}