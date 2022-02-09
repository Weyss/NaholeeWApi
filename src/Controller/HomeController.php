<?php

namespace App\Controller;

use App\Entity\Tv;
use App\Entity\Film;
use App\Form\TvType;
use App\Entity\Statue;
use App\Form\FilmType;
use App\Service\CallApiService;
use App\Repository\TvRepository;
use App\Repository\FilmRepository;
use App\Repository\StatueRepository;
use Symfony\Component\Form\FormView;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    /**
     * Méthode de rendu de la page d'acceuil
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'form' => $this->searchBar(),
        ]);
    }

    #[Route('/search', name: 'search')]
    /**
     * Méthode obtenir les reultats de la recherche
     *
     * @param Request $request
     * @param CallApiService $api
     * @return Response
     */
    public function search(Request $request, CallApiService $api): Response
    {
        $dataTv= null;
        $dataFilm = null;
        $query = $request->request->all('form');
        
        if(isset($query['query']))
        {
            $dataTv = $api->getInfoTv($query['query'])['results'];
            $dataFilm = $api->getInfoFilm($query['query'])['results'];
        }
          
        return $this->render('search.html.twig', [
            'form' => $this->searchBar(),
            'resultsTv' => $dataTv,
            'resultsFilm' => $dataFilm
        ]);
    }
    
    #[Route('/detail-tv/{id}', name: 'detail_tv')]
    /**
     * Méthode pour afficher les détails d'une serie
     *
     * @param integer $id
     * @param CallApiService $api
     * @param TvRepository $tvRepo
     * @return Response
     */
    public function detailTv(int $id, CallApiService $api, TvRepository $tvRepo): Response
    {
        $form = $this->createForm(TvType::class, null, [
            'action' => $this->generateUrl('management', [
                'id' => $id
            ])
        ]);
         
        return $this->render('/detail/detail-tv.html.twig', [
            'form' => $this->searchBar(),
            'data' => $api->getDetailInfoTv($id),
            'isInDatabase' => $tvRepo->findOneBy(['idTvTmdb' => $id]),
            'formTv' => $form->createView()
        ]);
    }

    #[Route('/detail-film/{id}', name: 'detail_film')]
    public function detailFilm(int $id, CallApiService $api, FilmRepository $filmRepo): Response
    {
        $form = $this->createForm(FilmType::class, null, [
            'action' => $this->generateUrl('management', [
                'id' => $id
            ])
        ]);

        return $this->render('/detail/detail-film.html.twig', [
            'form' => $this->searchBar(),
            'data' => $api->getDetailInfoFilm($id),
            'isInDatabase' => $filmRepo->findOneBy(['idFilmTmdb' => $id]),
            'formFilm' => $form->createView()
        ]);
    }

    #[Route('/management/{id}', name: 'management')]
    /**
     * Méthode de gestion d'ajout et d'édition d'une serie
     *
     * @param Request $request
     * @param integer $id
     * @param CallApiService $api
     * @param StatueRepository $statueRepo
     * @param TvRepository $tvRepo
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function management(Request $request, int $id, CallApiService $api, StatueRepository $statueRepo, TvRepository $tvRepo, FilmRepository $filmRepo, EntityManagerInterface $em): JsonResponse
    {
        $ajaxRequest = $request->request->all();
        
        /** @var Statue $statue */
        switch($ajaxRequest) 
        {
            case isset($ajaxRequest['tv']):
                $statue = $statueRepo->find($ajaxRequest['tv']['statue']);

                /** @var Tv $tv */
                $tv = $tvRepo->findOneBy(['idTvTmdb' => $id]);

                if(!$tv){
                    $tv = (new Tv())->setTitle($api->getDetailInfoTv($id)['name'])
                                    ->setIdTvTmdb($id)
                                    ->setStatue($statue);
            
                    $em->persist($tv);
                    $em->flush();
            
                    return $this->json("Ajouter", 200); 
                } 
                else 
                {
                    $tv->setStatue($statue);

                    $em->persist($tv);
                    $em->flush();

                    return $this->json("Modifier", 200);
                }
            break;
            case isset($ajaxRequest['film']):
                $statue = $statueRepo->find($ajaxRequest['film']['statue']);

                /** @var Film $film */
                $film = $filmRepo->findOneBy(['idFilmTmdb' => $id]);

                if(!$film){
                    $film = (new Film())->setTitle($api->getDetailInfoFilm($id)['title'])
                                        ->setIdFilmTmdb($id)
                                        ->setStatue($statue);
            
                    $em->persist($film);
                    $em->flush();
            
                    return $this->json("Ajouter", 200); 
                } 
                else 
                {
                    $film->setStatue($statue);

                    $em->persist($film);
                    $em->flush();

                    return $this->json("Modifier", 200);
                } 
            break;
        }  
    }
    
    /**
     * Méthode pour générer une barre de recherche
     *
     * @return FormView
     */
    private function searchBar(): FormView
    {
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
