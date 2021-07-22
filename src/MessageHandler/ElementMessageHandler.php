<?php
/**
 * Created by PhpStorm.
 * User: joserto86
 * Date: 22/07/21
 * Time: 19:39
 */

namespace App\MessageHandler;

use App\Entity\Element;
use App\Message\ElementMessage;
use App\Repository\ElementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;


class ElementMessageHandler implements MessageHandlerInterface
{
    private $em;

    private $elementRepository;

    public function __construct(EntityManagerInterface $em, ElementRepository $elementRepository)
    {
        $this->em = $em;
        $this->elementRepository = $elementRepository;
    }

    public function __invoke(ElementMessage $message)
    {
        $element = $this->elementRepository->findOneBy(['fid' => $message->getFid()]);

        $sleepTime = rand(3, 10);
        sleep($sleepTime);

        if (empty($element)) {
            $element = new Element();
            $element->setFid($message->getFid());
        }

        $element->setName($message->getName())
            ->setFno($message->getFno());

        $this->em->persist($element);
        $this->em->flush();
    }
}