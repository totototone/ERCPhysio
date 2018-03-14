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

        //generate an array of all categories that will look like this :
        /*0 => ChampsClinique {#780 ▼
          -name: "Cardio-respiratoire"
          -id: 1
          +"categories": array:2 [▼
            0 => Categorie {#822 ▼
              -name: "Respiratoire"
              -id: 1
              -idChampsClinique: ChampsClinique {#780}
              +"souscategories": array:1 [▼
                0 => SousCategorie {#859 ▼
                  -name: "tous les tests"
                  -id: 9
                  -idCategorie: Categorie {#822}
                  +"test": array:3 [▼
                    0 => TestVideo {#898 ▼
                      -name: "test1"
                      -video: "dfff"
                      -id: 1
                      -idSousCategorie: SousCategorie {#859}
                    }
                    1 => TestVideo {#900 ▶}
                    2 => TestVideo {#901 ▶}
                  ]
                }
              ]
            }
            1 => Categorie {#824 ▶}
          ]
        }*/

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


        return $this->render('accueil.html.twig', array(
            'champs' => $champsCliniques
        ));

    }

}
