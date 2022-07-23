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
     * Méthode pour obtenir les reultats de la recherche
     *
     * @param Request $request
     * @param CallApiService $api
     * @return Response
     */
    public function search(Request $request, CallApiService $api): Response
    {
        /** @var array $dataTv */
        /** @var array $dataFilm */

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
            'isInDatabase' => $tvRepo->findOneBy(['idTmdb' => $id]),
            'formTv' => $form->createView()
        ]);
    }

    #[Route('/detail-film/{id}', name: 'detail_film')]
    /**
     * Méthode pour afficher les détails d'un film
     *
     * @param integer $id
     * @param CallApiService $api
     * @param FilmRepository $filmRepo
     * @return Response
     */
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
            'isInDatabase' => $filmRepo->findOneBy(['idTmdb' => $id]),
            'formFilm' => $form->createView()
        ]);
    }

    #[Route('/management/{id}', name: 'management')]
    /**
     * Méthode d'ajout ou d'édition d'une série / film
     *
     * @param Request $request
     * @param integer $id
     * @param CallApiService $api
     * @param StatueRepository $statueRepo
     * @param TvRepository $tvRepo
     * @param FilmRepository $filmRepo
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function management(Request $request, int $id, CallApiService $api, StatueRepository $statueRepo, TvRepository $tvRepo, FilmRepository $filmRepo, EntityManagerInterface $em): JsonResponse
    {
        $ajaxRequest = $request->request->all();
        /** @var Statue $statue */
        switch($ajaxRequest) 
        {
            // Si la requête pour l'ajout ou l'édition est faite pour une SERIE
            // alors on la traitre ici
            case isset($ajaxRequest['tv']):
                $statue = $statueRepo->find($ajaxRequest['tv']['statue']);

                /** @var array $countries */
                // Création d'un tableau dans la cas où il y aurait plusieurs pays de production
                foreach($api->getDetailInfoTv($id)['production_countries'] as $country) {
                    $countries[] = $country['iso_3166_1'];
                };
                
                /** @var array $genres */
                // Création d'un tableau qui récupere les genres afin de déterminer plus tard
                // si la serie contient le genre "Animation"
                foreach($api->getDetailInfoTv($id)['genres'] as $genre){
                    $genres[] = $genre['name'];
                }

                /** @var Tv $tv */
                $tv = $tvRepo->findOneBy(['idTmdb' => $id]);

                if(!$tv){
                    $tv = (new Tv())->setTitle($api->getDetailInfoTv($id)['name'])
                                    ->setIdTmdb($id)
                                    ->setStatue($statue)
                                    ->setCountry(implode(", " , $countries))
                                    ->setAnime(in_array("Animation", $genres))
                                    ->setMedia('tv');
            
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
            // Si la requête pour l'ajout ou l'édition est faite pour un FILM
            // alors on la traitre ici
            case isset($ajaxRequest['film']):
                $statue = $statueRepo->find($ajaxRequest['film']['statue']);

                /** @var array $countries */
                // Création d'un tableau dans la cas où il y aurait plusieurs pays de production
                foreach($api->getDetailInfoFilm($id)['production_countries'] as $country) {
                    $countries[] = $country['iso_3166_1'];
                };

                /** @var array $genres */
                // Création d'un tableau qui récupere les genres afin de déterminer plus tard
                // si le film contient le genre "Animation"
                foreach($api->getDetailInfoFilm($id)['genres'] as $genre){
                    $genres[] = $genre['name'];
                }

                /** @var Film $film */
                $film = $filmRepo->findOneBy(['idTmdb' => $id]);

                if(!$film){
                    $film = (new Film())->setTitle($api->getDetailInfoFilm($id)['title'])
                                        ->setIdTmdb($id)
                                        ->setStatue($statue)
                                        ->setCountry(implode(", " , $countries))
                                        ->setAnime(in_array('Animation', $genres))
                                        ->setMedia('film');
                                        
                                        
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
    

    #[Route('/results/seen/{type}', name: 'results')]
    /**
     * Méthode pour afficher les résultats demandés
     * depuis la barre de navigation pour le statue 'Vu'
     *
     * @param string $type
     * @param StatueRepository $statueRepo
     * @param FilmRepository $filmRepo
     * @param TvRepository $tvRepo
     * @return Response
     */
    public function resultsSeen(string $type, StatueRepository $statueRepo, FilmRepository $filmRepo, TvRepository $tvRepo): Response
    {

        return $this->render('/results.html.twig', [
            'form' => $this->searchBar(),
            'results' => $this->results('Vu', $type, $statueRepo, $filmRepo, $tvRepo)
        ]);

    }


    #[Route('/results/tosee/{type}', name: 'results_to_see')]
    /**
     * Méthode pour afficher les résultats demandés
     * depuis la barre de navigation pour le statue 'A voir'
     *
     * @param string $type
     * @param StatueRepository $statueRepo
     * @param FilmRepository $filmRepo
     * @param TvRepository $tvRepo
     * @return Response
     */
    public function resultsToSee(string $type, StatueRepository $statueRepo, FilmRepository $filmRepo, TvRepository $tvRepo): Response
    {
        return $this->render('/results.html.twig', [
            'form' => $this->searchBar(),
            'results' => $this->results('A voir', $type, $statueRepo, $filmRepo, $tvRepo)
        ]);

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

    /**
     * Méthode pour récupérer les résultats demandés
     * depuis la barre de navigation
     *
     * @param string $statue
     * @param mixed $type
     * @param StatueRepository $statueRepo
     * @param FilmRepository $filmRepo
     * @param TvRepository $tvRepo
     * @return array
     */
    private function results(string $statue, mixed $type, StatueRepository $statueRepo, FilmRepository $filmRepo, TvRepository $tvRepo): array
    {
        switch($type){
            case 'kr':
                return $statueRepo->findTitleByStatue($statue, $type);
            break;
            case 'jp':
                return  $statueRepo->findTitleByStatue($statue, $type);
            break;
            case 'tl':
                return  $statueRepo->findTitleByStatue($statue, $type);
            break;
            case 'ct':
                return  $statueRepo->findTitleByStatue($statue, $type);
            break;
            case 'anime':
                return  $statueRepo->findAnimeByStatue($statue);
            break;
            case 'tv':
                return  $tvRepo->findTvByStatue($statue);
            break;
            case 'film':
                return  $filmRepo->findFilmByStatue($statue);
            break;
        }
    }
}
