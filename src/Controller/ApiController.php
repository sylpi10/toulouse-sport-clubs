<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Category;
use App\Entity\PostalCode;
use App\Form\SearchForm;
use App\Entity\SportClub;
use App\Service\ClubApiService;
use App\Repository\SportClubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="api")
     */
    public function index(HttpClientInterface $httpClient, 
    Request $request, ClubApiService $apiService, 
    EntityManagerInterface $manager,SportClubRepository $repo)
    {
        
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);

        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            
            $filterclubs = $repo->findSearch($data);
            $sport = $form->get('q')->getData();
            $postals = $form->get('postals')->getData();


            return $this->render('api/result.html.twig', [
                    'clubs' => $filterclubs,
                    'form' => $form->createView(),
                    'postals' =>$postals,
                    'sport' => $sport
                    ]);
        }

        // get values from api and send to our db
// $resp = $apiService->getClub();
// $records = $resp['records']; 
// $postalCode1 = new PostalCode();
// $postalCode2 = new PostalCode();
// $postalCode3 = new PostalCode();
// $postalCode4 = new PostalCode();
// $postalCode5 = new PostalCode();
// $postalCode6 = new PostalCode();
// $postalCode7 = new PostalCode();

// $categ1 = new Category();
// $categ2 = new Category();
// $categ3 = new Category();
// $categ4 = new Category();
// $categ5 = new Category();
// $categ6 = new Category();
// $categ7 = new Category();
// $categ8 = new Category();
// $categ9 = new Category();
// $categ10 = new Category();
// $categ11 = new Category();
// $categ12 = new Category();
// $categ13 = new Category();
// $categ14 = new Category();

// foreach ($records as $key => $club) {
// $id = $club['recordid'];
// $club = $club;
// $fields = $club['fields'];
// // dump($fields);
// $discipline = $fields["discipline"];
// $name = $fields["asso_nom"];

// if (isset($fields["uf_cp"]) && !empty($fields["uf_cp"])) {
//     $postal = $fields["uf_cp"];
// }else{
//     $postal = null;
// }
//     if (isset($fields["complexe"]) && !empty($fields["complexe"])) {
//             $complex = $fields["complexe"];
//         }else{
//             $complex = null;
//     }

// if (isset($fields["rue_libelle"]) && !empty($fields["rue_libelle"])) {
//     $street = $fields["rue_libelle"];
// }else{
//     $street = null;
// }

// if (isset($fields["quartiers"]) && !empty($fields["quartiers"])) {
//     $district = $fields["quartiers"];
// }else{
//     $district = null;
// }

// if (isset($fields["seniors"])) {
// if ($fields["seniors"] == "Oui") {
// $seniors = true;
// }else{
// $seniors = false;
// }
// }
// if (isset($fields["adultes"])) {
// if ($fields["adultes"] =="Oui") {
// $adults = true;
// }else{
// $adults = false;
// }
// }
// if (isset($fields["juniors16_20ans"])) {
// if ($fields["juniors16_20ans"] =="Oui") {
// $j16_20 = true;
// }else{
// $j16_20 = false;
// }
// }
// if (isset($fields["12_15ans"])) {
// if ($fields["12_15ans"] =="Oui") {
// $j12_15 = true;
// }else{
// $j12_15 = false;
// }
// }
// if (isset($fields["6_12ans"])) {
// if ($fields["6_12ans"] =="Oui") {
// $j6_12 = true;
// }else{
// $j6_12 = false;
// }
// }
// if (isset($fields["3_6ans"])) {
// if ($fields["3_6ans"] =="Oui") {
// $j3_6 = true;
// }else{
// $j3_6 = false;
// }
// }
// if (isset($fields["0_3ans"])) {
// if ($fields["0_3ans"] =="Oui") {
// $j0_3 = true;
// }else{
// $j0_3 = false;
// }
// }
// if (isset($fields["corpo"])) {
// if ($fields["corpo"] =="Oui") {
// $corpo = true;
// }else{
// $corpo = false;
// }
// }
// if (isset($fields["handicapes"])) {
// if ($fields["handicapes"] =="Oui") {
// $handicap = true;
// }else{
// $handicap = false;
// }
// }

// if (isset($fields["pers_internet"]) &&!empty($fields["pers_internet"]) ) {
//         $weblink = $fields["pers_internet"];
//     }else{
//         $weblink = null;
// }

// // dump($discipline);

// $sportClub = new SportClub();

// $sportClub->setName($name);
// $sportClub->setDiscipline(strtolower($discipline));

// if ($complex) {
//     $sportClub->setComplex($complex);
// }

// // $postalCode->setNumber($postal);
// if ($postal == 31000) {
// $postalCode1->setNumber(31000);
// $sportClub->setPostalCodes($postalCode1);
// }
// if ($postal == 31100) {
// $postalCode2->setNumber(31100);
// $sportClub->setPostalCodes($postalCode2);
// }
// if ($postal == 31170) {
// $postalCode3->setNumber(31170);
// $sportClub->setPostalCodes($postalCode3);
// }
// if ($postal == 31200 ) {
// $postalCode4->setNumber(31200);
// $sportClub->setPostalCodes($postalCode4);
// }
// if ($postal == 31300) {
// $postalCode5->setNumber(31300);
// $sportClub->setPostalCodes($postalCode5);
// }
// if ($postal == 31400) {
// $postalCode6->setNumber(31400);
// $sportClub->setPostalCodes($postalCode6);
// }
// if ($postal == 31500) {
// $postalCode7->setNumber(31500);
// $sportClub->setPostalCodes($postalCode7);
// }
// if ($street) {
//     $sportClub->setAddress($street);
// }
// if ($district) {
//     $sportClub->setDistrict($district);
// }
// if ($seniors) {
//     $sportClub->setSeniors($seniors);
// }
// if ($adults) {
//     $sportClub->setAdults($adults);
// }
// if ($j16_20) {
//     $sportClub->setJ16to20($j16_20);
// }
// if ($j12_15) {
//     $sportClub->setJ12to15($j12_15);
// }
// if ($j6_12) {
//     $sportClub->setJ6to12($j6_12);
// }
// if ($j3_6) {
//     $sportClub->setJ3to6($j3_6);
// }
// if ($j0_3) {
//     $sportClub->setJ0to3($j0_3);
// }
// if ($handicap) {
//     $sportClub->setHandicap($handicap);
// }
// if ($corpo) {
//     $sportClub->setCorpo($corpo);
// }

// if ($weblink) {
//     $sportClub->setWeblink($weblink);
// }
// $sportClub->setCreatedAt(date_create("now"));

// if (str_contains(strtolower($discipline), "foot") 
// OR str_contains(strtolower($discipline), "handball")
// OR str_contains(strtolower($discipline), "volley")
// OR str_contains(strtolower($discipline), "rugby")
// OR str_contains(strtolower($discipline), "basket")
// OR str_contains(strtolower($discipline), "baseball")
// ) {
//     $categ1->setName("Sports Collectifs");
//     $sportClub->setCategories($categ1);
// }
// elseif (str_contains(strtolower($discipline), "karat")
// OR str_contains(strtolower($discipline), "thai")
// OR str_contains(strtolower($discipline), "box")
// OR str_contains(strtolower($discipline), "arnis")
// OR str_contains(strtolower($discipline), "kali")
// OR str_contains(strtolower($discipline), "judo")
// OR str_contains(strtolower($discipline), "tae")
// OR str_contains(strtolower($discipline), "kwon")
// OR str_contains(strtolower($discipline), "savate")
// OR str_contains(strtolower($discipline), "kung")
// OR str_contains(strtolower($discipline), "chi")
// OR str_contains(strtolower($discipline), "viet vo dao")
// OR str_contains(strtolower($discipline), "aikido")
// OR str_contains(strtolower($discipline), "full contact")
// OR str_contains(strtolower($discipline), "kenjutsu")
// OR str_contains(strtolower($discipline), "qi gong")
// OR str_contains(strtolower($discipline), "jitsu")
// OR str_contains(strtolower($discipline), "lutte")
// OR str_contains(strtolower($discipline), "wushu")
// OR str_contains(strtolower($discipline), "escrime")
// OR str_contains(strtolower($discipline), "kalarippayat")
// ) {
//     $categ2->setName("Sports de Combat");
//     $sportClub->setCategories($categ2);
// }
// elseif (str_contains(strtolower($discipline), "skate")
// OR str_contains(strtolower($discipline), "ski")
// OR str_contains(strtolower($discipline), "snow")
// OR str_contains(strtolower($discipline), "neige")
// OR str_contains(strtolower($discipline), "roller")
// OR str_contains(strtolower($discipline), "patinage")
// OR str_contains(strtolower($discipline), "planche à voile")
// OR str_contains(strtolower($discipline), "voile")
// OR str_contains(strtolower($discipline), "hockey")
// ){
//     $categ3->setName("Sports de Glisse");
//     $sportClub->setCategories($categ3);
// }
// elseif (str_contains(strtolower($discipline), "piscine")
// OR str_contains(strtolower($discipline), "natation")
// OR str_contains(strtolower($discipline), "plong")
// OR str_contains(strtolower($discipline), "swim")
// OR str_contains(strtolower($discipline), "aqua")
// OR str_contains(strtolower($discipline), "nage")
// OR str_contains(strtolower($discipline), "aquagym")
// OR str_contains(strtolower($discipline), "water-polo")
// OR str_contains(strtolower($discipline), "chasse sous-marine")
// ){
//     $categ4->setName("Sports Aquatiques");
//     $sportClub->setCategories($categ4);
// }
// elseif (str_contains(strtolower($discipline), "vélo")
// OR str_contains(strtolower($discipline), "moto")
// OR str_contains(strtolower($discipline), "vtt")
// OR str_contains(strtolower($discipline), "cyclo")
// OR str_contains(strtolower($discipline), "cyclisme")
// OR str_contains(strtolower($discipline), "karting")
// ){
//     $categ5->setName("Vélo, Moto");
//     $sportClub->setCategories($categ5);
// }
// elseif (str_contains(strtolower($discipline), "escalade")
// OR str_contains(strtolower($discipline), "alpinisme")
// OR str_contains(strtolower($discipline), "grimpe")
// OR str_contains(strtolower($discipline), "outdoor")
// OR str_contains(strtolower($discipline), "bloc")
// OR str_contains(strtolower($discipline), "falaise")
// OR str_contains(strtolower($discipline), "voie")
// OR str_contains(strtolower($discipline), "rando")
// OR str_contains(strtolower($discipline), "voltige")
// OR str_contains(strtolower($discipline), "spéléologie")
// ){
//     $categ6->setName("Sports de Montagne");
//     $sportClub->setCategories($categ6);
// }
// elseif (str_contains(strtolower($discipline), "aviron")
// OR str_contains(strtolower($discipline), "canoe")
// OR str_contains(strtolower($discipline), "kayak")
// OR str_contains(strtolower($discipline), "rame")
// OR str_contains(strtolower($discipline), "bateau")
// ){
//     $categ7->setName("Bateaux");
//     $sportClub->setCategories($categ7);
// }
// elseif (str_contains(strtolower($discipline), "tennis")
// OR str_contains(strtolower($discipline), "ping")
// OR str_contains(strtolower($discipline), "badminton")
// OR str_contains(strtolower($discipline), "squash")
// OR str_contains(strtolower($discipline), "raquette")
// OR str_contains(strtolower($discipline), "pelote")
// ){
//     $categ8->setName("Sports de Raquettes");
//     $sportClub->setCategories($categ8);
// }
// elseif (str_contains(strtolower($discipline), "athl")
// OR str_contains(strtolower($discipline), "saut")
// OR str_contains(strtolower($discipline), "course")
// OR str_contains(strtolower($discipline), "endurance")
// OR str_contains(strtolower($discipline), "lancé")
// OR str_contains(strtolower($discipline), "perche")
// OR str_contains(strtolower($discipline), "mètres")
// ){
//     $categ9->setName("Athlétisme");
//     $sportClub->setCategories($categ9);
// }
// elseif (str_contains(strtolower($discipline), "arc")
// OR str_contains(strtolower($discipline), "tir")
// ){
//     $categ10->setName("Sports de Tir");
//     $sportClub->setCategories($categ10);
// }
// elseif (str_contains(strtolower($discipline), "danse")
// OR str_contains(strtolower($discipline), "jazz")
// OR str_contains(strtolower($discipline), "ballet")
// OR str_contains(strtolower($discipline), "hip-hop")
// OR str_contains(strtolower($discipline), "dance")
// OR str_contains(strtolower($discipline), "capoeira")
// ){
//     $categ11->setName("Danses");
//     $sportClub->setCategories($categ11);
// }
// elseif (str_contains(strtolower($discipline), "billard")
// OR str_contains(strtolower($discipline), "bowling")
// OR str_contains(strtolower($discipline), "pétanque")
// OR str_contains(strtolower($discipline), "petanque")
// OR str_contains(strtolower($discipline), "golf")
// OR str_contains(strtolower($discipline), "provençal")
// OR str_contains(strtolower($discipline), "boules")
// OR str_contains(strtolower($discipline), "quilles de huit")
// ){
//     $categ12->setName("Autres");
//     $sportClub->setCategories($categ12);
// }
// elseif (str_contains(strtolower($discipline), "gym")
// OR str_contains(strtolower($discipline), "muscu")
// OR str_contains(strtolower($discipline), "yoga")
// OR str_contains(strtolower($discipline), "cross fit")

// ){
//     $categ13->setName("Gym, Musculation");
//     $sportClub->setCategories($categ13);
// }
// elseif (str_contains(strtolower($discipline), "equitation")
// OR str_contains(strtolower($discipline), "équitation")
// OR str_contains(strtolower($discipline), "polo")
// ){
//     $categ14->setName("Sports Equestres");
//     $sportClub->setCategories($categ14);
// }

// $manager->persist($sportClub);

// }
// $manager->persist($postalCode1);
// $manager->persist($postalCode2);
// $manager->persist($postalCode3);
// $manager->persist($postalCode4);
// $manager->persist($postalCode5);
// $manager->persist($postalCode6);
// $manager->persist($postalCode7);

// $manager->persist($categ14);
// $manager->persist($categ13);
// $manager->persist($categ12);
// $manager->persist($categ11);
// $manager->persist($categ10);
// $manager->persist($categ9);
// $manager->persist($categ8);
// $manager->persist($categ7);
// $manager->persist($categ6);
// $manager->persist($categ5);
// $manager->persist($categ4);
// $manager->persist($categ3);
// $manager->persist($categ2);
// $manager->persist($categ1);

    

// $manager->flush();
    

        $clubs = $repo->findAll();
        return $this->render('api/index.html.twig', [
            'form' => $form->createView(),
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
