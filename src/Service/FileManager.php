<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

 class FileManager
{ 
    

    public function __construct(
        private readonly SluggerInterface $slugger,
        private readonly ParameterBagInterface $parameterBag,
        private readonly Filesystem $filesystem

        
    ){}
    public function upload(UploadedFile $file): string
    {
        $orinalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilname = $this->slugger->slug($orinalName);
        $now = new \DateTime();
        $filename = $newFilname . $now->format("Ymdhis"). ".". $file->guessClientExtension();

        $file->move(
             $this->parameterBag->get("profile_directory"),
             $filename
        );


        return $filename;

    }

    public function download(UploadedFile $file): string
    {
        $orinalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilname = $this->slugger->slug($orinalName);
        $now = new \DateTime();
        $filename = $newFilname . $now->format("Ymdhis"). ".". $file->guessClientExtension();

        $file->move(
             $this->parameterBag->get("cv_directory"),
             $filename
        );


        return $filename;

    }

    public function remove(string $filename): bool
    {
         $pathFile = $this->parameterBag->get("profile_directory") . $filename;
         if ($this->filesystem->exists($pathFile)) {
            $this->filesystem->remove($pathFile);
            return true;
         }
         return false;

    }
}