<?php


class ClientController
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->$clientRepository = $clientRepository;
    }

    /**
     * @Route("/client/", name="add_clien", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $tel = $data['tel'];

        if (empty(nom) || empty(prenom) || empty($email) || empty($tel)) {
            throw new NotFoundHttpException('parametres attentus !!');
        }

        $this->clientRepository->saveCustomer($nom, $prenom, $email, $tel);

        return new JsonResponse(['status' => 'Client crée !'], Response::HTTP_CREATED);
    }
}

