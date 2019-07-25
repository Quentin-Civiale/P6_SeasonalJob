<?php

namespace P6\GeneralBundle\Listener;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use P6\GeneralBundle\Annotation\UploadableField;
use P6\GeneralBundle\Annotation\UploadAnnotationReader;
use P6\GeneralBundle\Handler\UploadHandler;
use Symfony\Component\PropertyAccess\PropertyAccess;

class UploadSubscriber implements EventSubscriber {

    /**
     * @var UploadAnnotationReader
     */
    private $reader;

    /**
     * @var UploadHandler
     */
    private $handler;

    public function  __construct(UploadAnnotationReader $reader, UploadHandler $handler)
    {
        $this->reader = $reader;
        $this->handler = $handler;
    }

    /**
     * Retourne un tableau d'évènement que le subscriber veut écouter.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
            'postRemove'
        ];
    }

    /**
     * @param LifecycleEventArgs $event
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $event) {
        $this->preEvent($event);
    }

    /**
     * @param LifecycleEventArgs $event
     * @throws \Exception
     */
    public function preUpdate(LifecycleEventArgs $event) {
        $this->preEvent($event);
    }

    /**
     * @param LifecycleEventArgs $event
     * @throws \Exception
     */
    private function preEvent(LifecycleEventArgs $event) {
        $entity = $event->getEntity();
        foreach($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->uploadFile($entity, $property, $annotation);
        }
    }

    /**
     * @param LifecycleEventArgs $event
     * @throws \Exception
     */
    public function postLoad(LifecycleEventArgs $event) {
        $entity = $event->getEntity();
        foreach($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->setFileFromFilename($entity, $property, $annotation);
        }
    }

    /**
     * @param LifecycleEventArgs $event
     * @throws \Exception
     */
    public function postRemove(LifecycleEventArgs $event) {
        $entity = $event->getEntity();
        foreach($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->removeFile($entity, $property);
        }
    }
}