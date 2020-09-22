<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(HttpClientInterface $httpClient, Request $request)
    {

        $form = $this->createFormBuilder()
        ->add('code', TextType::class)
        ->add('sport', TextType::class)
        ->add('filter', SubmitType::class)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
       
        $code = $form->get('code')->getData();
        // $searchedSport = $form->get('sport')->getData();
        $sport= $form->get('sport')->getData();

        // if (str_contains($sport, $searchedSport) {
        //     # code...
        // }
        if ($sport) {
            $sport = strtoupper($sport);
        }
    
        $response = $httpClient->request(
            'GET', 
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000&refine&refine.uf_cp=' .$code); 
            
            $clubs = $response->toArray();

            return $this->render('api/index.html.twig', [
                'form' => $form->createView(),
                'clubs' => $clubs,
                'code' => json_decode($code),
                'sport' => $sport
            ]);
    }

    // $response = $httpClient->request(
    //     'GET', 
    //     'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000'); 
    //     $clubs = $response->toArray();

        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
            // 'clubs' => $clubs,
        ]);
    }


    /**
     * @Route("/club/{id}", name="detail")
     */
    public function detail($id, HttpClientInterface $client)
    {

        $response = $client->request('GET', "https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&rows=1000&recordid=" . $id);
        // dd($response->toArray());
        $club = $response->toArray();
        // dd($club);
        return $this->render('api/detail.html.twig', [
            'club' => $club,
            "id" => $id
        ]);
    }
  

   
}
