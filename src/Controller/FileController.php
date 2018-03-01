<?php
// src/Controller/FileController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Upload;
use App\Form\FichierType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Flex\Response;
use App\Entity\User;

class FileController extends Controller
{
    /**
     * @Route("/upload", name="upload_new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $upload = new Upload();
        $form = $this->createForm(FichierType::class, $upload);
        $form->handleRequest($request);
        //dump($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded CSV file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $upload->getName();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where files are stored
            if($file->move(
                $this->getParameter('uploads_directory'),
                $fileName
            )) {
                $utilisateurs = array(); // Tableau qui va contenir les éléments extraits du fichier CSV
                $row = 0; // Représente la ligne
                // Import du fichier CSV 
                if (($handle = fopen($this->get('kernel')->getProjectDir() . '/public/uploads/'.$fileName, "r")) !== FALSE) { // Lecture du fichier, à adapter
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) { // Eléments séparés par un point-virgule, à modifier si necessaire
                        $num = count($data); // Nombre d'éléments sur la ligne traitée
                        $row++;
                        for ($c = 0; $c < $num; $c++) {
                            $utilisateurs[$row] = array(
                                    "nom" => $data[0],
                                    "mail" => $data[1],
                                    "password" => $data[2],                            
                            );
                        }
                    }
                    fclose($handle); 
                    
                }        
                
                $em = $this->getDoctrine()->getManager(); // EntityManager pour la base de données

                $error = false;
                $reussis = array();
                $rates = array();
                
                // Lecture du tableau contenant les utilisateurs et ajout dans la base de données
                foreach ($utilisateurs as $utilisateur) {
                    
                    // On crée un objet utilisateur
                    $user = new User();
            
                    // Encode le mot de passe
                    $password = $utilisateur["password"];
                    $password = $passwordEncoder->encodePassword($user, $password);


                  
                    
                    
                    // Hydrate l'objet avec les informations provenants du fichier CSV
                    $user->setPassword($password);
                    $user->setUsername($utilisateur["nom"]);
                    $user->setEmail($utilisateur["mail"]);
                        
                    // Enregistrement de l'objet en vue de son écriture dans la base de données
                    $userExists = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findBy(
                      ['username' => $user->getUsername()              
                    ]);

                    $emailExists = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findBy(
                      ['email' => $user->getUsername()              
                    ]);


                    if(empty($userExists) && empty($emailExists)) {
                        $em->persist($user);
                        $em->flush();
                        array_push($reussis,$user);

                    }
                    else {
                        $error = true;
                        array_push($rates,$user);
                    }
                    
                    // Ecriture dans la base de données
                    
                } /*endforeach*/

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
                ));
            }

            // updates the 'name' property to store the CSV file name
            // instead of its contents
            $upload->setName($fileName);

            // ... persist the $upload variable or any other work

            //return $this->redirect($this->generateUrl('upload_list'));
        }

        return $this->render('file.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
?>