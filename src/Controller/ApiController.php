<?php

namespace App\Controller;

use App\Entity\SportClub;
use App\Repository\SportClubRepository;
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
    EntityManagerInterface $manager,SportClubRepository $repo)
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


        $response = $httpClient->request(
            'GET', 
            // 'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000&refine.uf_cp=' .$code); 
             'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=annuaire-des-associations-et-clubs-sportifs&q=&rows=1000'); 
             
             $clubs = $response->toArray();

            // TODO find by search
            $clubs = $repo->findAll();
             return $this->render('api/result.html.twig', [
                 'form' => $form->createView(),
                 'clubs' => $clubs,
                // 'code' => $code,
                'sport' => $sport,
                // 'districts' => $districts,
                // 'datas' => $datas
                ]);
            }
            

            // get values from api and send to our db
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
                if (isset($fields["complexe"])) {
                    $complex = $fields["complexe"];
                }
                if (isset($fields["rue_libelle"])) {
                    $street = $fields["rue_libelle"];
                }
                if (isset($fields["quartiers"])) {
                    $district = $fields["quartiers"];
                }
                if (isset($fields["seniors"])) {
                    if ($fields["seniors"] == "Oui") {
                        $seniors = true;
                    }else{
                        $seniors = false;
                    }
                }
                if (isset($fields["adultes"])) {
                    if ($fields["adultes"] =="Oui") {
                        $adults = true;
                    }else{
                        $adults = false;
                    }
                }
                if (isset($fields["juniors16_20ans"])) {
                    if ($fields["juniors16_20ans"] =="Oui") {
                        $j16_20 = true;
                    }else{
                        $j16_20 = false;
                    }
                }
                if (isset($fields["12_15ans"])) {
                    if ($fields["12_15ans"] =="Oui") {
                        $j12_15 = true;
                    }else{
                        $j12_15 = false;
                    }
                }
                if (isset($fields["6_12ans"])) {
                    if ($fields["6_12ans"] =="Oui") {
                        $j6_12 = true;
                    }else{
                        $j6_12 = false;
                    }
                }
                if (isset($fields["3_6ans"])) {
                    if ($fields["3_6ans"] =="Oui") {
                        $j3_6 = true;
                    }else{
                        $j3_6 = false;
                    }
                }
                if (isset($fields["0_3ans"])) {
                    if ($fields["0_3ans"] =="Oui") {
                        $j0_3 = true;
                    }else{
                        $j0_3 = false;
                    }
                }
                if (isset($fields["corpo"])) {
                    if ($fields["corpo"] =="Oui") {
                        $corpo = true;
                    }else{
                        $corpo = false;
                    }
                }
                if (isset($fields["handicapes"])) {
                    if ($fields["handicapes"] =="Oui") {
                        $handicap = true;
                    }else{
                        $handicap = false;
                    }
                }
    
                if (isset($fields["pers_internet"])) {
                    $weblink = $fields["pers_internet"];
                }

                // dump($discipline);

                $sportClub = new SportClub();
                $sportClub->setName($name);
                $sportClub->setDiscipline(strtolower($discipline));
                $sportClub->setComplex($complex);
                $sportClub->setPostalCode($postal);
                $sportClub->setAddress($street);
                $sportClub->setDistrict($district);
                $sportClub->setSeniors($seniors);
                $sportClub->setAdults($adults);
                $sportClub->setJ16to20($j16_20);
                $sportClub->setJ12to15($j12_15);
                $sportClub->setJ6to12($j6_12);
                $sportClub->setJ3to6($j3_6);
                $sportClub->setJ0to3($j0_3);
                $sportClub->setHandicap($handicap);
                $sportClub->setCorpo($corpo);
                $sportClub->setWeblink($weblink);
                $sportClub->setCreatedAt(date_create("now"));

                if (str_contains(strtolower($discipline), "foot") 
                    OR str_contains(strtolower($discipline), "handball")
                    OR str_contains(strtolower($discipline), "volley")
                    OR str_contains(strtolower($discipline), "rugby")
                    OR str_contains(strtolower($discipline), "basket")
                    OR str_contains(strtolower($discipline), "baseball")
                ) {
                    $sportClub->setCategory("Sports Collectifs");
                }
                elseif (str_contains(strtolower($discipline), "karat")
                OR str_contains(strtolower($discipline), "thai")
                OR str_contains(strtolower($discipline), "box")
                OR str_contains(strtolower($discipline), "arnis")
                OR str_contains(strtolower($discipline), "kali")
                OR str_contains(strtolower($discipline), "judo")
                OR str_contains(strtolower($discipline), "tae")
                OR str_contains(strtolower($discipline), "kwon")
                OR str_contains(strtolower($discipline), "savate")
                OR str_contains(strtolower($discipline), "kung")
                OR str_contains(strtolower($discipline), "chi")
                OR str_contains(strtolower($discipline), "viet vo dao")
                OR str_contains(strtolower($discipline), "aikido")
                OR str_contains(strtolower($discipline), "full contact")
                OR str_contains(strtolower($discipline), "kenjutsu")
                OR str_contains(strtolower($discipline), "qi gong")
                OR str_contains(strtolower($discipline), "jitsu")
                OR str_contains(strtolower($discipline), "lutte")
                OR str_contains(strtolower($discipline), "wushu")
                OR str_contains(strtolower($discipline), "yoga")
                OR str_contains(strtolower($discipline), "escrime")
                OR str_contains(strtolower($discipline), "kalarippayat")
                ) {
                    $sportClub->setCategory("Sports de Combat");
                }
                elseif (str_contains(strtolower($discipline), "skate")
                OR str_contains(strtolower($discipline), "ski")
                OR str_contains(strtolower($discipline), "snow")
                OR str_contains(strtolower($discipline), "neige")
                OR str_contains(strtolower($discipline), "roller")
                OR str_contains(strtolower($discipline), "patinage")
                OR str_contains(strtolower($discipline), "planche à voile")
                OR str_contains(strtolower($discipline), "voile")
                OR str_contains(strtolower($discipline), "hockey")
                ){
                    $sportClub->setCategory("Sports de Glisse");
                }
                elseif (str_contains(strtolower($discipline), "piscine")
                OR str_contains(strtolower($discipline), "natation")
                OR str_contains(strtolower($discipline), "plong")
                OR str_contains(strtolower($discipline), "swim")
                OR str_contains(strtolower($discipline), "aqua")
                OR str_contains(strtolower($discipline), "nage")
                OR str_contains(strtolower($discipline), "aquagym")
                OR str_contains(strtolower($discipline), "water-polo")
                OR str_contains(strtolower($discipline), "chasse sous-marine")
                ){
                    $sportClub->setCategory("Sports Aquatiques");
                }
                elseif (str_contains(strtolower($discipline), "vélo")
                OR str_contains(strtolower($discipline), "moto")
                OR str_contains(strtolower($discipline), "vtt")
                OR str_contains(strtolower($discipline), "cyclo")
                OR str_contains(strtolower($discipline), "cyclisme")
                OR str_contains(strtolower($discipline), "karting")
                ){
                    $sportClub->setCategory("Vélo, Moto");
                }
                elseif (str_contains(strtolower($discipline), "escalade")
                OR str_contains(strtolower($discipline), "alpinisme")
                OR str_contains(strtolower($discipline), "grimpe")
                OR str_contains(strtolower($discipline), "outdoor")
                OR str_contains(strtolower($discipline), "bloc")
                OR str_contains(strtolower($discipline), "falaise")
                OR str_contains(strtolower($discipline), "voie")
                OR str_contains(strtolower($discipline), "rando")
                OR str_contains(strtolower($discipline), "voltige")
                OR str_contains(strtolower($discipline), "spéléologie")
                ){
                    $sportClub->setCategory("Sports de Montagne");
                }
              
                elseif (str_contains(strtolower($discipline), "aviron")
                OR str_contains(strtolower($discipline), "canoe")
                OR str_contains(strtolower($discipline), "kayak")
                OR str_contains(strtolower($discipline), "rame")
                OR str_contains(strtolower($discipline), "bateau")
                ){
                    $sportClub->setCategory("Bateaux");
                }
                elseif (str_contains(strtolower($discipline), "tennis")
                OR str_contains(strtolower($discipline), "ping")
                OR str_contains(strtolower($discipline), "badminton")
                OR str_contains(strtolower($discipline), "squash")
                OR str_contains(strtolower($discipline), "raquette")
                OR str_contains(strtolower($discipline), "pelote")
                ){
                    $sportClub->setCategory("Sports de Raquettes");
                }
                elseif (str_contains(strtolower($discipline), "athl")
                OR str_contains(strtolower($discipline), "saut")
                OR str_contains(strtolower($discipline), "course")
                OR str_contains(strtolower($discipline), "endurance")
                OR str_contains(strtolower($discipline), "lancé")
                OR str_contains(strtolower($discipline), "perche")
                OR str_contains(strtolower($discipline), "mètres")
                ){
                    $sportClub->setCategory("Athlétisme");
                }
           
                elseif (str_contains(strtolower($discipline), "arc")
                OR str_contains(strtolower($discipline), "tir")
                ){
                    $sportClub->setCategory("Sports de Tir");
                }
                elseif (str_contains(strtolower($discipline), "danse")
                OR str_contains(strtolower($discipline), "jazz")
                OR str_contains(strtolower($discipline), "ballet")
                OR str_contains(strtolower($discipline), "hip-hop")
                OR str_contains(strtolower($discipline), "dance")
                OR str_contains(strtolower($discipline), "capoeira")
                ){
                    $sportClub->setCategory("Danses");
                }
                elseif (str_contains(strtolower($discipline), "billard")
                OR str_contains(strtolower($discipline), "bowling")
                OR str_contains(strtolower($discipline), "pétanque")
                OR str_contains(strtolower($discipline), "petanque")
                OR str_contains(strtolower($discipline), "golf")
                OR str_contains(strtolower($discipline), "provençal")
                OR str_contains(strtolower($discipline), "boules")
                OR str_contains(strtolower($discipline), "quilles de huit")
                ){
                    $sportClub->setCategory("Autres");
                }
                elseif (str_contains(strtolower($discipline), "gym")
                OR str_contains(strtolower($discipline), "muscu")
                ){
                    $sportClub->setCategory("Gym, Musculation");
                }
                elseif (str_contains(strtolower($discipline), "equitation")
                OR str_contains(strtolower($discipline), "équitation")
                OR str_contains(strtolower($discipline), "polo")
                ){
                    $sportClub->setCategory("Sports Equestres");
                }


                $manager->persist($sportClub);
                $manager->flush();
            }
            
        $clubs = $repo->findAll(); 
        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
            "clubs" => $clubs
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
