<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\SportClub;
use App\Entity\PostalCode;
use App\Service\ClubApiService;
use App\Repository\CategoryRepository;
use App\Repository\SportClubRepository;
use App\Repository\PostalCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(
    Request $request, EntityManagerInterface $manager,
    CategoryRepository $categRepo, 
    PostalCodeRepository $postalRepo, SportClubRepository $clubrepo)
    {
        
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);


        $clubs = $clubrepo->findAll();
      

         if ($form->isSubmitted() && $form->isValid()) {
            
            $filtered = $postalRepo->filterClubs($data);
            $sport = $form->get('q')->getData();
            $postals = $form->get('postals')->getData();
            $newSearch = true;
            // $categories = $form->get('categories')->getData();
            // dd($filtered);
            // dd($sport);

            return $this->render('api/result.html.twig', [
                    'filtered' => $filtered,
                    'form' => $form->createView(),
                    'postals' =>$postals,
                    'sport' => $sport,
                    'data' => $data,
                    'newSearch' => $newSearch
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



    /**
     * @Route("/club/{id}", name="detail")
     */
    public function detail(SportClub $sportClub, SportClubRepository $repo)
    {
        $newSearch = true;
        return $this->render('api/detail.html.twig', [
            'club' => $sportClub,
            'newSearch' => $newSearch

        ]);
    }

   
}
