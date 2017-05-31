<?php

namespace TweedeGolf\MediaBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File as UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Attachment.
 *
 * @ORM\MappedSuperclass
 * @Vich\Uploadable
 */
abstract class AbstractFile
{
    use TimestampableEntity;

    /**
     * @Assert\File(maxSize="20M", mimeTypes={
     *     "image/png",
     *     "image/jpg",
     *     "image/jpeg",
     *     "image/gif",
     *     "text/plain",
     *     "text/richtext",
     *     "audio/mpeg",
     *     "audio/mp3",
     *     "application/pdf",
     *     "application/x-pdf",
     *     "application/msword",
     *     "application/vnd.ms-excel",
     *     "application/vnd.ms-powerpoint",
     *     "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *     "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *     "application/vnd.openxmlformats-officedocument.presentationml.presentation"
     * })
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Vich\UploadableField(mapping="tgmedia_file", fileNameProperty="fileName")
     *
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $fileName;

    /**
     * @var string
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $fileSize;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $mimeType;

    /**
     * Return the string representation of this entity.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->fileName;
    }

    /**
     * Set file.
     *
     * @param UploadedFile $file
     *
     * @return $this
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        $this->setUpdatedAt(new \DateTime());

        if ($file) {
            $this->mimeType = $file->getMimeType();
            $this->fileSize = $file->getSize();
        } else {
            $this->mimeType = null;
            $this->fileSize = null;
        }

        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set fileName.
     *
     * @param string $fileName
     *
     * @return UploadedFile
     */
    public function setFileName($fileName = null)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Retrieve the extension of the file.
     *
     * @return string
     */
    public function getExtension()
    {
        if (!$this->fileName) {
            return;
        }

        return pathinfo($this->fileName, PATHINFO_EXTENSION);
    }

    /**
     * Get mimeType.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Get fileName.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Get fileSize.
     *
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Check if the file is an image based on its mime type.
     *
     * @return bool
     */
    public function isImage()
    {
        return in_array($this->mimeType, self::getImageMimetypes());
    }

    /**
     * Return valid image mime types.
     *
     * @return array[string]
     */
    public static function getImageMimetypes()
    {
        return [
            'image/jpg',
            'image/jpeg',
            'image/gif',
            'image/png',
        ];
    }

    /**
     * @param string $type
     *
     * @return File
     */
    public function setMimeType($type)
    {
        $this->mimeType = $type;

        return $this;
    }

    /**
     * @param int $size
     *
     * @return File
     */
    public function setFileSize($size)
    {
        $this->fileSize = $size;

        return $this;
    }
}
