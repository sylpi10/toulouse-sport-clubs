<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\PostalCode;
use App\Form\SearchForm;
use App\Entity\SportClub;
use App\Repository\CategoryRepository;
use App\Repository\PostalCodeRepository;
use App\Service\ClubApiService;
use App\Repository\SportClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(HttpClientInterface $httpClient, 
    Request $request, ClubApiService $apiService, 
    EntityManagerInterface $manager,CategoryRepository $categRepo, PostalCodeRepository $postalRepo, SportClubRepository $clubRepo)
    {
        
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            
            // $categ = $categRepo->findCateg($data);
            $filtered = $postalRepo->filterClubs($data);
            $sport = $form->get('q')->getData();
            $postals = $form->get('postals')->getData();
    
            // $categories = $form->get('categories')->getData();
            // dd($filtered);
            // dd($data);

            return $this->render('api/result.html.twig', [
                    // 'clubs' => $filterclubs,
                    // 'categs' => $categ,
                    'filtered' => $filtered,
                    'form' => $form->createView(),
                    'postals' =>$postals,
                    'sport' => $sport,
                    'data' => $data,
                    // 'categories' => $categories
                    ]);
        }


        // $clubs = $postalRepo->findAll();
        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
            // 'clubs' => $clubs
        ]);
    }


    /**
     * @Route("/club/{id}", name="detail")
     */
    public function detail(SportClub $sportClub, SportClubRepository $repo)
    {
        return $this->render('api/detail.html.twig', [
            'club' => $sportClub,
        ]);
    }

   
}
