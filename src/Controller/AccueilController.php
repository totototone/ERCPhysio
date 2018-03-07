<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\ChampsClinique;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\TestVideo;

class AccueilController extends Controller
{

	/**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {

        $champsCliniques = $this->getDoctrine()
        ->getRepository(ChampsClinique::class)
        ->findAll();

       // dump($champsCliniques);

        $testVideo = $this->getDoctrine()
        ->getRepository(TestVideo::class)
        ->findAll();

        $souscategories = $this->getDoctrine()
        ->getRepository(SousCategorie::class)
        ->findAll();

        foreach ($champsCliniques as $key => $ChampsClinique) {

            $champsCliniques[$key]->categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findBy(["idChampsClinique" => $ChampsClinique->getId()]);

            foreach ($champsCliniques[$key]->categories as $key2 => $categorie) {
                $champsCliniques[$key]->categories[$key2]->souscategories = $this->getDoctrine()
                ->getRepository(SousCategorie::class)
                ->findBy(["idCategorie" => $categorie->getId()]);;

                foreach ($champsCliniques[$key]->categories[$key2]->souscategories as $key3 => $souscategorie) {
                $champsCliniques[$key]->categories[$key2]->souscategories[$key3]->test = $this->getDoctrine()
                ->getRepository(TestVideo::class)
                ->findBy(["idSousCategorie" => $souscategorie->getId()]);;
                }
            }
        }

        dump($champsCliniques);
        

        //dump($categories);

        

        //dump($souscategories);

       




        return $this->render('accueil.html.twig', array(
            'champs' => $champsCliniques 
        ));
        // replace this line with your own code!
        //return $this->render('@Maker/demoPage.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);

    }
    
}