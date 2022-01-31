<?php

namespace App\Controller;

use App\Entity\Tv;
use App\Form\TvType;
use App\Entity\Statue;
use App\Repository\StatueRepository;
use App\Service\CallApiService;
use App\Repository\TvRepository;
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
     * Méthode obtenir la recherche
     *
     * @param Request $request
     * @param CallApiService $api
     * @return Response
     */
    public function searchTv(Request $request, CallApiService $api): Response
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
            'action' => $this->generateUrl('management_tv', [
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



    // Ajouter la méthode qui ajoute une serie (voir vidéo Lior)
    #[Route('/management-tv/{id}', name: 'management_tv')]
    public function addTv(int $id, CallApiService $api, StatueRepository $statueRepo, TvRepository $tvRepo, EntityManagerInterface $em): JsonResponse
    {
        $data = $api->getDetailInfoTv($id);

        /** @var Tv $tv */
        $tv = $tvRepo->findOneBy(['idTvTmdb' => $id]);

        /** @var Statue $statue */
        $statue = $statueRepo->findOneBy(['id' => $_POST['tv']['statue']]);
        
        if(!$tv){
            $tv = (new Tv())->setTitle($data['name'])
                            ->setIdTvTmdb($id)
                            ->setStatue($statue);
        
            $em->persist($tv);
            $em->flush();
        
            return $this->json("La série a été ajouter à votre liste", 200); 
        } 
        else 
        {
            $tv->setStatue($statue);

            $em->persist($tv);
            $em->flush();

            return $this->json("Le statue de la serie à bien été modifié", 200);
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
