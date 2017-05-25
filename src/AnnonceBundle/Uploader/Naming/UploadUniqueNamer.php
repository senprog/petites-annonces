<?php

namespace AnnonceBundle\Uploader\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UploadUniqueNamer implements NamerInterface
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Creates a user directory name for the file being uploaded.
     *
     * @param FileInterface $file
     * @return string The directory name.
     */
    public function name(FileInterface $file)
    {
        $upload_files_path = $this->session->get('upload_files_path');
        $unique_name = uniqid();

        return sprintf('%s/%s_%s',
            $upload_files_path,
            $unique_name,
            $file->getClientOriginalName()
        );
    }
}