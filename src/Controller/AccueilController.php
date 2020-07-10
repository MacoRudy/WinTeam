<?php

namespace App\Controller;

use App\Entity\Inscriptions;
use App\Entity\Sorties;
use App\Form\AccueilType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        $sorties = $this->getDoctrine()
            ->getRepository(Sorties::class)
            ->findAll();
        $inscriptions = $this->getDoctrine()->getRepository(Inscriptions::class)->findAll();

        if (!$sorties) {
            throw $this->createNotFoundException(
                'Aucune sortie trouvée'
            );
        }

        $form = $this->createForm(AccueilType::class);

        return $this->render('accueil/index.html.twig', [
            'sorties' => $sorties, 'inscriptions' => $inscriptions,
             'accueilForm' => $form->createView(),
        ]);
    }
}
