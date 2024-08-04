<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $this->addFlash('info', 'Tentative de connexion avec : ' . $username); // msg flash pour debug

            $user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
            $this->addFlash('info', 'Utilisateur trouvé : ' . ($user ? 'oui' : 'non')); // msg flash pour debug

            if ($user) {
                $session->set('user', $user);
                return $this->redirectToRoute('leave_list');
            } else {
                $this->addFlash('error', 'Utilisateur non trouvé');
                return $this->redirectToRoute('login');
            }
        }

        return $this->render('security/login.html.twig');
    }



    #[Route('/logout', name: 'logout')]
    public function logout(SessionInterface $session): Response
    {
        $session->remove('user');
        return $this->redirectToRoute('login');
    }
}
