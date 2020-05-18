<?php
# app/Controller/UserController.php

namespace App\Controller;
use App\Entity\User;

class UserController extends Controller
{

    /**
     * Redirection vers la vue concernant la connexion utilisateur
     *
     * @return void
     */
    public function login()
    {
        echo $this->twig->render('connexion.front.twig');
    }

    /**
     * Connexion
     *
     * @return void
     */
    public function signIn()
    {
        $users = $this->userRepository->findAll();

        foreach($users as $user)
        {
            if (!empty($_POST['email']) && !empty($_POST['password']))
            {
                if ($_POST['email'] === $user->getEmail() && password_verify($_POST['password'], $user->getPassword()))
                {
                    $_SESSION['logged'] = true;
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['firstName'] = $user->getFirstName();
                    $_SESSION['lastName'] = $user->getLastName();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['admin'] = $user->getAdmin();

                    header('Location: ?p=home');
                }
                else
                {
                    $returnConnect = 'Désolé identifiant incorrect';
                    $colorConnect = 'danger';
                    echo $this->twig->render('connexion.front.twig', [
                        'returnConnect' => $returnConnect,
                        'colorConnect' => $colorConnect
                    ]);
                }
            }
            else
            {
                $returnConnect = 'Veuillez remplir tout les champs';
                $colorConnect = 'warning';
                echo $this->twig->render('connexion.front.twig', [
                    'returnConnect' => $returnConnect,
                    'colorConnect' => $colorConnect
                ]);
            }
        }
    }

    /**
     * Déconnexion de l'utilisateur et redirection vers la page d'accueil
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
        header('Location: ?p=home');
    }

    /**
     * Redirection vers la vue concernant l'inscription
     *
     * @return void
     */
    public function getInscription()
    {
        echo $this->twig->render('inscription.front.twig');
    }

    /**
     * Inscription d'un utilisateur
     *
     * @return void
     */
    public function register()
    {
        $users = $this->userRepository->findAll();
        $alreadyExist = false;

        if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password']))
        {
            if ($_POST['password'] === $_POST['passwordRepeat'])
            {
                foreach($users as $user)
                {
                    if ($_POST['email'] === $user->getEmail())
                    {
                        $alreadyExist = true;
                        $returnMessage = 'Désolé cette adresse e-mail est déjà utilisée';
                        $colorMessage = 'danger';
                        echo $this->twig->render('inscription.front.twig', [
                            'returnMessage' => $returnMessage,
                            'colorMessage' => $colorMessage
                        ]);
                    }
                    elseif ($alreadyExist === true)
                    {
                        $user = new User();
                        $user->setFirstName($_POST['firstName']);
                        $user->setLastName($_POST['lastName']);
                        $user->setEmail($_POST['email']);
                        $user->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                        $user->setAdmin(0);
                        $this->entityManager->persist($user);
                        $this->entityManager->flush();

                        $returnMessage = 'Vous êtes désormais inscrit ! Vous pouvez vous connecter';
                        $colorMessage = 'success';
                        echo $this->twig->render('home.front.twig', [
                            'returnMessage' => $returnMessage,
                            'colorMessage' => $colorMessage
                        ]);
                    }
                }
            }
            else
            {
                $returnMessage = 'Veuillez saisir deux mots de passe identiques';
                $colorMessage = 'warning';
                echo $this->twig->render('inscription.front.twig', [
                    'returnMessage' => $returnMessage,
                    'colorMessage' => $colorMessage
                ]);
            }
        }
        else
        {
            $returnMessage = 'Veuillez remplir tout les champs indiqués';
            $colorMessage = 'warning';
            echo $this->twig->render('inscription.front.twig', [
                'returnMessage' => $returnMessage,
                'colorMessage' => $colorMessage
            ]);
        }
    }

}