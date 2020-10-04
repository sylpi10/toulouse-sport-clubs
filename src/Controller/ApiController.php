<?php

namespace App\Controller;

use App\Entity\SportClub;
use App\Service\ClubApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(HttpClientInterface $httpClient, 
    Request $request, ClubApiService $apiService, 
    EntityManagerInterface $manager
    )
    {

        $form = $this->createFormBuilder([
            "method" => 'POST'
        ])
        // ->add('code', TextType::class)
        ->add('31000', CheckboxType::class,[
            'label' => 'Toulouse Centre',
            'required' => false,
            'attr' => [
                'value' => '31000',
                'class' => 'checkbox check31000',
            ]
            ])
        ->add('31100', CheckboxType::class,[
            'label' => 'Toulouse Rive gauche',
            'required' => false,
            'attr' => [
                'value' => '31100',
                'class' => 'checkbox check31100'
            ]
            ])
        ->add('31200', CheckboxType::class,[
            'label' => 'Toulouse Nord',
            'required' => false,
            'attr' => [
                'value' => '31200',
                'class' => 'checkbox check31200'
            ]
            ])
        ->add('31500', CheckboxType::class,[
            'label' => 'Toulouse Est',
            'required' => false,
            'attr' => [
                'value' => '31500',
                'class' => 'checkbox check31500'
            ]
            ])
        ->add('31300', CheckboxType::class,[
            'label' => 'Toulouse Ouest',
            'required' => false,
            'attr' => [
                'value' => '31300',
                'class' => 'checkbox check31300'
            ]
            ])
        ->add('31400', CheckboxType::class,[
            'label' => 'Toulouse Sud Est',
            'required' => false,
            'attr' => [
                'value' => '31400',
                'class' => 'checkbox check31400'
            ]
            ])
        ->add('sport', TextType::class, [
            'attr' => [
                'placeholder' => 'Ex: Escalade',
            ]
        ])
        // ->add('filter', SubmitType::class)
        ->getForm();

    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        
        // $code = $form->get('code')->getData();
        $sport= $form->get('sport')->getData();
        $d31000 = $form->get('31000')->getData();
        $d31100 = $form->get('31100')->getData();
        $d31200 = $form->get('31200')->getData();
        $d31300 = $form->get('31300')->getData();
        $d31400 = $form->get('31400')->getData();
        $d31500 = $form->get('31500')->getData();
        
        $districts = array($d31000, $d31100, $d31200, $d31300, $d31400, $d31500);
        // dd ($districts);
        $datas = $form->getData();
        // dd($datas);
        if ($sport) {
            $sport = strtoupper($sport);
        }
        // foreach ($districts as $district) {
        //     $code = $district;
        // }

        // $response = $httpClient->request(
        //     'GET', 
        //     // 'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000&refine.uf_cp=' .$code); 
        //      'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000'); 
             
        //      $clubs = $response->toArray();
        //      return $this->render('api/result.html.twig', [
        //          'form' => $form->createView(),
        //         'clubs' => $clubs,
        //         // 'code' => $code,
        //         'sport' => $sport,
        //         'districts' => $districts,
        //         'datas' => $datas
        //         ]);
            }
            
            $resp = $apiService->getClub();
            $records = $resp['records'];    

            foreach ($records as $key => $club) {
                $id = $club['recordid'];
                $club = $club;
                $fields = $club['fields'];
                // dump($fields);
                $discipline = $fields["discipline"];
                $name = $fields["asso_nom"];

                if (isset($fields["uf_cp"])) {
                    $postal = $fields["uf_cp"];
                }
                // dump($discipline);

                $sportClub = new SportClub();
                $sportClub->setName($name);
                $sportClub->setDiscipline($discipline);
                $sportClub->setPostalCode($postal);

                $manager->persist($sportClub);
                $manager->flush();
            }
            
            
   
        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
            'records' => $records,
            'fields' => $fields,
            'discipline' => $discipline
        ]);
    }

    // /**
    //  *  @Route("/", name="home")
    //  */
    // public function home()
    // {
    //     return $this->render('api/index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }


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
