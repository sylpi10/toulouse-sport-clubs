<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\SportClub;
use App\Repository\CategoryRepository;
use App\Repository\SportClubRepository;
use App\Repository\PostalCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    public function __construct(
        protected EntityManagerInterface $manager,
        protected CategoryRepository $categoryRepo,
        protected PostalCodeRepository $postalRepo,
        protected SportClubRepository $clubRepo
    )
    {
    }

    #[Route("/", name:"api")]
    public function index(Request $request)
    {
        
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);


        $clubs = $this->clubRepo->findAll();
      

         if ($form->isSubmitted() && $form->isValid()) {
            
            $filtered = $this->postalRepo->filterClubs($data);
            $sport = $form->get('q')->getData();
            $postals = $form->get('postals')->getData();
            // $categories = $form->get('categories')->getData();

            return $this->render('api/result.html.twig', [
                    'filtered' => $filtered,
                    'form' => $form->createView(),
                    'postals' =>$postals,
                    'sport' => $sport,
                    'data' => $data,
                    'newSearch' => true
                    // 'categories' => $categories
                    ]);
        }


        $newSearch = false;
        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
            'newSearch' => $newSearch,
            'allclubs' => $clubs
        ]);

        if (!$clubs) {
            $result['clubs']['error'] = "no result";
        }else{
            $result['clubs'] = $this->getRealClubs($clubs);
        }

        return new Response(json_encode($result));
    }

    public function getRealClubs($clubs)
    {
        foreach ($clubs as $club) {
            $reaClubs[$club->getId()] = $club->getDiscipline();
        }
        return $reaClubs;
    }


    #[Route("/club/{id}", name:"detail", methods: ['GET'])]
    public function detail(SportClub $sportClub)
    {
        return $this->render('api/detail.html.twig', [
            'club' => $sportClub,
            'newSearch' => true
        ]);
    }
}
