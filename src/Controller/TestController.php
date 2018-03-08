<?php 

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\ChampsClinique;
use App\Entity\Categorie;
use App\Entity\Test;
use App\Entity\Questions;
use App\Entity\Reponses;
use App\Entity\CasClinique;
use App\Entity\Hypotheses;
use App\Entity\TestSpe;


class TestController extends Controller
{


    /**
     * @Route("/test", name="test")
     */

    public function test()
    {
        $champscliniques = $this->getDoctrine()
        ->getRepository(ChampsClinique::class)
        ->findAll();

        $categories = $this->getDoctrine()
        ->getRepository(Categorie::class)
        ->findAll();

        $tests = $this->getDoctrine()
        ->getRepository(Test::class)
        ->findAll();

        $questions = $this->getDoctrine()
        ->getRepository(Questions::class)
        ->findAll();

        $reponses = $this->getDoctrine()
        ->getRepository(Reponses::class)
        ->findAll();

        $cascliniques = $this->getDoctrine()
        ->getRepository(CasClinique::class)
        ->findAll();

        $hypotheses = $this->getDoctrine()
        ->getRepository(Hypotheses::class)
        ->findAll();

        $testspes = $this->getDoctrine()
        ->getRepository(TestSpe::class)
        ->findAll();


        dump($reponses);
        dump($tests);

        // $this->get('acme.js_vars')->chartData = $x;
            
        return $this->render('test.html.twig', array(
            'champscliniques' => $champscliniques,
            'categorie' => $categories,

            'tests' => $tests,
            'reponses' => $reponses,
            'questions' => $questions,

            'cascliniques' => $cascliniques,
            'hypotheses' => $hypotheses,

            'testspes' => $testspes,
        ));
    }


    /**
     * @Route("/getQuestion/{id_test}/{num_question}", name="getQuestion")
     */

    public function getQuestion($id_test, $num_question)
    {
        $questions = $this->getDoctrine()
        ->getRepository(Questions::class)
        ->findBy([
            "idTest" => $id_test
        ]);

        dump($questions);

        $question = $questions[$num_question-1];

       dump($question); 

        $reponses = $this->getDoctrine()
        ->getRepository(Reponses::class)
        ->findBy([
            "idQuestions" => $question
        ]);

        dump($reponses);

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

        $score = $_POST['score'];
        $string .= "Score = " . $score;

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
        $string .= "<input type='button' id='buttonq' value='Valider' data-juste=" . $juste . " data-liste=" . $liste . " data-q=" . $q . " data-x=" . $x . " data-score=" . $score . ">";
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