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
     * Vérification avant connection de l'utilisateur
     *
     * @param [type] $email -> Adresse e-mail reçu via l'utilisateur
     * @param [type] $password -> Mot de passe reçu via l'utilisateur
     * @return void
     */
    public function signIn($email, $password)
    {

        // Vérifie que les champs ne sont pas vides
        if(!empty($email) && !empty($password))
        {
            // Recherche un utilisateur via l'adresse e-mail
            $user = $this->userRepository->findBy([
                "email" => $email,
            ]);

            // Vérifie si l'adresse e-mail est valide et si le mot de passe correspond
            if($email === $user[0]->getEmail() && password_verify($password, $user[0]->getPassword()))
            {
                $_SESSION['logged'] = true;
                $_SESSION['id'] = $user[0]->getId();
                $_SESSION['firstName'] = $user[0]->getFirstName();
                $_SESSION['lastName'] = $user[0]->getLastName();
                $_SESSION['email'] = $user[0]->getEmail();
                $_SESSION['admin'] = $user[0]->getAdmin();

                $_SESSION['flash'] = "Vous êtes à présent connecter";
                $_SESSION['color'] = "success";
                header('Location: ?p=home&page=1');
            }
            else
            {
                $_SESSION['flash'] = "Désolé identifiant incorrect";
                $_SESSION['color'] = "warning";
                header('Location: ?p=connexion#td_connexion');
            }
        }
        else
        {
            $_SESSION['flash'] = "Veuillez remplir tout les champs";
            $_SESSION['color'] = "danger";
            header('Location: ?p=connexion#td_connexion');
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
        header('Location: ?p=home&page=1');
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
                        $_SESSION['flash'] = 'Désolé cette adresse e-mail est déjà utilisée';
                        $_SESSION['color'] = 'danger';
                        header('Location: ?p=inscription');
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

                        $_SESSION['flash'] = 'Vous êtes désormais inscrit ! Vous pouvez vous connecter';
                        $_SESSION['color'] = 'success';
                        header('Location: ?p=home&page=1');
                    }
                }
            }
            else
            {
                $_SESSION['flash'] = 'Veuillez saisir deux mots de passe identiques';
                $_SESSION['color'] = 'warning';
                header('Location: ?p=inscription');
            }
        }
        else
        {
            $_SESSION['flash'] = 'Veuillez remplir tout les champs indiqués';
            $_SESSION['color'] = 'danger';
            header('Location: ?p=inscription');
        }
    }

}