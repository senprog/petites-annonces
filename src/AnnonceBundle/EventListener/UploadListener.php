<?php
/**
 * Created by Audry BABELA.
 * User: SENPROG
 * Date: 20/03/2017
 * Time: 12:50
 */

namespace AnnonceBundle\EventListener;

use AnnonceBundle\Entity\Photo;
use Oneup\UploaderBundle\Event\PreUploadEvent;
use Oneup\UploaderBundle\Event\PostUploadEvent;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class UploadListener
{

    /**
     * @var ObjectManager
     */
    private $om;

    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $file = $event->getFile();
        $photo = new Photo();
        $photo->setNom($file->getName());
        //$photo->setFile($file->getPathName());
        $photo->setPaths($file->getPathName());

        $this->om->persist($photo);
        $this->om->flush();

        //if everything went fine
        $response = $event->getResponse();
        $response['success'] = true;
        return $response;
    }
}