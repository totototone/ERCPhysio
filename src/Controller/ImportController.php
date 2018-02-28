<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Flex\Response;



class ImportController extends Controller
{
    /**
     * @Route("/import", name="registration")
     */


    public function importAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {    
        
        $utilisateurs = array(); // Tableau qui va contenir les éléments extraits du fichier CSV
        $row = 0; // Représente la ligne
        // Import du fichier CSV 
        if (($handle = fopen(__DIR__ . "/Utilisateurs.csv", "r")) !== FALSE) { // Lecture du fichier, à adapter
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
        
    
        
        //return= moyen idéal pour arrêter boucle
        /*return new Response('OK');*/
        
    }
}

?>