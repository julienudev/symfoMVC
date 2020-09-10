<?php

namespace App\Controller;
use App\Entity\Client;

use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClientController
 * @package App\Controller
 *
 * @Route(path="/client")
 */
class ClientController
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @Route("/add", name="add_client", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $tel = $data['tel'];

        if (empty($nom) || empty($prenom) || empty($email) || empty($tel)) {
            throw new NotFoundHttpException('parametres attentus !!');
        }

        $this->clientRepository->saveClient($nom, $prenom, $email, $tel);

        return new JsonResponse(['status' => 'Client crée !'], Response::HTTP_CREATED);
    }
}

