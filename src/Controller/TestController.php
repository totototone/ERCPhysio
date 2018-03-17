<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\ChampsClinique;
use App\Entity\Categorie;
use App\Entity\TestVideo;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\CasClinique;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;


class TestController extends Controller
{


    /**
     * @Route("/test/{id}", name="test")
     */

    public function test($id, \Vich\UploaderBundle\Storage\StorageInterface $storageInterface)
    {
        //récupère la première question du test, les suivantes seront chargées en Ajax.

        $test = $this->getDoctrine()
        ->getRepository(TestVideo::class)
        ->findOneBy(["id" => $id]);

        $question = $this->getDoctrine()
        ->getRepository(Question::class)
        ->findOneBy(["testVideo" => $id]);

        $reponses = $this->getDoctrine()
        ->getRepository(Reponse::class)
        ->findBy(["question" => $question->getId()]);

        //créer un array des id de questions justes et un array des IDs de toute les questions.
        $justes = array();
        $allIds = array();

        foreach ($reponses as $key => $reponse) {
          if($reponse->getJuste()) {
            array_push($justes,$reponse->getId());
          }
          array_push($allIds,$reponse->getId());
        }

        $allIds = implode(",",$allIds);
        $justes = implode(",",$justes);


        return $this->render('test.html.twig', array(

            'test' => $test,
            'question' => $question,
            'reponses' => $reponses,
            "justes" => $justes,
            "allIds" => $allIds
        ));
    }


    /**
     * @Route("/getQuestion/{id_test}/{num_question}", name="getQuestion")
     */

    public function getQuestion($id_test, $num_question)
    {
        $questions = $this->getDoctrine()
        ->getRepository(Question::class)
        ->findBy([
            "testVideo" => $id_test
        ]);

        if(isset($questions[$num_question-1]) && !empty($questions[$num_question-1])) {
          $question = $questions[$num_question-1];
        }
        else {
          return new Response("<h1>Test terminé</h1>");
        }


        $reponses = $this->getDoctrine()
        ->getRepository(Reponse::class)
        ->findBy([
            "question" => $question
        ]);


        $liste = [];
        $juste = [];


        $string = "<div id='current' class='b'>";
        $string .= "<div id='numero'>";

            $total = 0;
            foreach ($questions as $question) {
                $total++;
            }

        $string .= $num_question . " / " . $total;
        $string .= "</div>";
        $string .= "<div id='score'>";

        /*$score = $_POST['score'];
        $string .= "Score = " . $score;*/

        $string .= "</div>";
        $string .= "<div id='question'>";


        $string .= $question . " :";


        $string .= "</div>";
        $string .= "<div id='reponses'>";
        $num_reponse = 0;
        foreach ($reponses as $reponse) {
            $num_reponse++;
            $string .= "<div class='blocrep'>";
            $string .= "<div id='num" . $reponse->getId() . "' class='num'>" . $num_reponse . "</div>";
            $string .= "<p>" . $reponse->getReponse() . "</p><br>";
            $string .= "</div>";
            array_push($liste, $reponse->getId());
        }

        foreach ($reponses as $reponse) {
            if ($reponse->getJuste() == 1) {
                array_push($juste, $reponse->getId());
            }
        }

        $liste = json_encode($liste);
        $juste = json_encode($juste);

        $q = $id_test;
        $x = $num_question;

        $string .= "</div>";
        $string .= "<input type='button' id='buttonq' class='button' value='Valider' data-juste=" . $juste . " data-liste=" . $liste . " data-q=" . $q . " data-x=" . $x . " >";
        $string .= "</div>";


        return new Response($string);
    }


    /**
     * @Route("/end/{score}/{total}", name="end")
     */
    public function end($score, $total) {

        $string = "<div id='end'>";
        $string .= "";
        $string .= "Votre score est de : " . $score . " / " . $total;
        $string .= "</div>";


        return new Response($string);

    }

}
