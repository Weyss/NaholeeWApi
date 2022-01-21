<?php

namespace App\Controller;

use App\Repository\TvRepository;
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
    public function searchTv(Request $request, CallApiService $api)
    {
        $data = null;
        $query = $request->request->all('form');
        
        if(isset($query['query']))
            $data = $api->getInfoTv($query['query'])['results'];
 
        return $this->render('search.html.twig', [
            'form' => $this->searchBar(),
            'results' => $data
        ]);
    }

    #[Route('/detail-tv/{id}', name: 'detail_tv')]
    public function detailTv($id, CallApiService $api, TvRepository $tv)
    {
        dump($id);
        return $this->render('/detail/detail-tv.html.twig', [
            'form' => $this->searchBar(),
            //'datas' => $api->getDetailInfoTv($id),
            // 'inDb' =>  $tv->find($id)
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
