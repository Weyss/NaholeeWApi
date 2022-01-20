<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'form' => $this->searchBar(),
        ]);
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request, CallApiService $api)
    {
        $datas = null;
        $query = $request->request->all('form');
        
        if($query) {
            $datas = $api->getInfoTv($query['query']);
        }
        
        return $this->render('search.html.twig', [
            'form' => $this->searchBar(),
            'results' => $datas['results']
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detailMovie(int $id, CallApiService $api)
    {
        dump($api->getDetailInfoTv($id));
        return $this->render('detail.html.twig', [
            'form' => $this->searchBar(),
            'datas' => $api->getDetailInfoTv($id)
        ]);
    }
    /**
     * Fonction permettant la création et l'affichage d'une barre de recherche
     */ 
    private function searchBar(){
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('search'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->add('recherche', SubmitType::class)
            ->getForm();

        return $form->createView();
    }
}
