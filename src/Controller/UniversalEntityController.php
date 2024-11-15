<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UniversalEntityController extends AbstractController
{
    #[Route('/api/{entity}', name: 'api_get_entities')]
    public function getEntities(EntityManagerInterface $entityManager, string $entity): Response
    {
        $entities = [
            'events' => 'App\Entity\Event',
            'guests' => 'App\Entity\Guest',
            'tables' => 'App\Entity\Table',
            'users' => 'App\Entity\User',
        ];

        if (!array_key_exists($entity, $entities)) {
            return new Response('Entity not found', 404);
        }
        $repository = $entityManager->getRepository($entities[$entity]);
        $entityData = $repository->findAll();
        if (empty($entityData)) {
            return new Response('No data found', 404);
        }

        $responseData = '';
        foreach ($entityData as $data) {
            $responseData .= $data->__toString() . '<br>';
        }

        return new Response($responseData);
    }
}

