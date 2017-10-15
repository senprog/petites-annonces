<?php

/**
 * Created by Audry BABELA.
 * User: pc
 * Date: 17/06/17
 * Time: 23:24
 */

namespace AnnonceBundle\Naming;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;

class UploadNamer implements NamerInterface
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage){
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Creates a user directory name for the file being uploaded.
     *
     * @param FileInterface $file
     * @return string The directory name.
     */
    public function name(FileInterface $file)
    {
        $userId = $this->tokenStorage->getToken()->getUser()->getId();

        return sprintf('%s/%s.%s',
            $userId,
            uniqid(),
            $file->getExtension()
        );
    }

}