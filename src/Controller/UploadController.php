<?php
// src/Controller/UploadController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VideoType;
use Symfony\Flex\Response;
use App\Entity\TestVideo;

class UploadController extends Controller
{
    /**
     * @Route("/uploadvideo", name="upload_video")
     */
    public function new(Request $request)
    {
        $testvideo = new TestVideo();
        $form = $this->createForm(VideoType::class, $testvideo);
        $form->handleRequest($request);
        //dump($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded Video file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $testvideo->getName();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where files are stored
            if($file->move(
                $this->getParameter('video_directory'),
                $fileName
            )) {
                /*$videos = array(); // Tableau qui va contenir les éléments extraits du fichier Video
                $row = 0; // Représente la ligne
                // Import du fichier CSV 
                if (($handle = fopen($this->get('kernel')->getProjectDir() . '/public/upload_video/'.$fileName, "r")) !== FALSE) { // Lecture du fichier, à adapter
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Eléments séparés par un point-virgule, à modifier si necessaire
                        $num = count($data); // Nombre d'éléments sur la ligne traitée
                        $row++;
                        for ($c = 0; $c < $num; $c++) {
                            $videos[$row] = array(
                                    "scenarios" => $data[0],
                                    "video" => $data[1],                                                   
                            );
                        }
                    }
                    fclose($handle); 
                    
                }*/
            }            
        }        
                
                $em = $this->getDoctrine()->getManager(); // EntityManager pour la base de données
                
                // Lecture du tableau contenant les utilisateurs et ajout dans la base de données
                foreach ($videos as $video) {
                    
                    // On crée un objet 
                    $testvideo = new TestVideo();
            
                                        
                    // Hydrate l'objet avec les informations provenants du fichier
                    $testvideo->setScenariosName($videos["scenarios"]);
                    $testvideo->setVideo($videos["video"]);
                        
                    // Enregistrement de l'objet en vue de son écriture dans la base de données
                    $nameExists = $this->getDoctrine()
                    ->getRepository(TestVideo::class)
                    ->findBy(
                      ['scenarios_name' => $testvideo->getScenariosName()              
                    ]);

                    $videoExists = $this->getDoctrine()
                    ->getRepository(TestVideo::class)
                    ->findBy(
                      ['video' => $testvideo->getVideo()              
                    ]);


                    /*if(empty($userExists) && empty($emailExists)) {
                        $em->persist($user);
                        $em->flush();
                        array_push($reussis,$user);

                    }
                    else {
                        $error = true;
                        array_push($rates,$user);
                    }
                    
                    // Ecriture dans la base de données
                    
                } /*endforeach

                if($error) {
                    $message = "erreur";
                }
                else {
                    $message = "succès";
                }

                return $this->render("success.html.twig",array(
                    "message" => $message,
                    "reussis" => $reussis,
                    "rates" => $rates
                ));*/
            }

            // updates the 'name' property to store the CSV file name
            // instead of its contents
            $testvideo->setName($fileName);

            // ... persist the $upload variable or any other work

            //return $this->redirect($this->generateUrl('upload_list'));
       

        return $this->render('upload.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
?>