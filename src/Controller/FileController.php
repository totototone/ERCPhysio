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
    private function Genere_Password($size)
    {
        $password = "";
        // Initialisation des caractères utilisables
        $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

        for($i=0;$i<$size;$i++) //for (initialization; condition; increment-decrement){}The first part initializes the code. The second part is the condition that will continue to run the loop as long as it is true. The last part is what will be run after each iteration of the loop.
        {
            $password .= ($i%2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)]; //$password contains ($i%2), strtoupper: renvoie une chaîne en majuscules, array_rand: prend une ou plusieurs valeurs au hasard dans un tableau.
        }

        return $password;
    }



    /**
     * @Route("/upload", name="upload_new")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager(); // EntityManager pour la base de données

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
                $upload->setName($fileName);
                $em->persist($upload);
                $em->flush();
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
                                    "password" => $this->Genere_password(10),
                                    "mail" => $data[1],

                            );
                        }
                        /*$resultat = array($data[0], $data[1],$this->Genere_password(10));*/
                        echo "<pre>";
                        print_r($utilisateurs);
                        echo "</pre>";
                    }
                    fclose($handle);

                }


                $error = false;
                $reussis = array();
                $rates = array();

                // Lecture du tableau contenant les utilisateurs et ajout dans la base de données
                foreach ($utilisateurs as $utilisateur) {

                    // On crée un objet utilisateur
                    $user = new User();

                    // Encode le mot de passe
                    $password = $utilisateur["password"];
                    /*print_r($password);*/
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

    //pas testé
    private function Mail()
    {
    $email = 'noreply@ercphysio.com';
    $object = 'Inscription';
    $to = 'monstre-plante@live.fr';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    /*$message = $_POST['message'];*/
    $nom = ['username' => $user->getUsername()];
    $mail = ['email' => $user->getUsername()];
    $password = ['password' => $this->Genere_password(10)];


    $message = "Bonjour ". $nom .",voici vos informations de connexion sur ERCphysio : <br> Identifiant: ". $mail ." <br> Mot de passe: ". $password ."";

    if (mail($to, $object, $message, $headers)) {
        echo " ";
    }
    else {
        echo "Le mail n'a pas été envoyé";
    }
  }


}
?>
