<?php

namespace App\Controller;

use App\Entity\Leave;
use App\Form\LeaveType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LeaveController extends AbstractController
{
    #[Route('/leaves', name: 'leave_list')]
    public function list(EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $session->get('user');
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $leaves = $entityManager->getRepository(Leave::class)->findAll();
        return $this->render('leave/list.html.twig', [
            'leaves' => $leaves,
            'user' => $user,
        ]);
    }

    #[Route('/leave/new', name: 'leave_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $session->get('user');

        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $leave = new Leave();
        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $leave->setUser($user);
            $entityManager->persist($leave);
            $entityManager->flush();

            return $this->redirectToRoute('app_leave_index');
        }

        return $this->render('leave/new.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/leave/edit/{id}', name: 'leave_edit')]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $session->get('user');
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $leave = $entityManager->getRepository(Leave::class)->find($id);

        if (!$leave || $leave->getStatus() === 'Validé') {
            throw $this->createNotFoundException('Le congé n\'existe pas ou est déjà validé.');
        }

        $form = $this->createForm(LeaveType::class, $leave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('leave_list');
        }

        return $this->render('leave/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/leave/cancel/{id}', name: 'leave_cancel')]
    public function cancel(int $id, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $session->get('user');
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $leave = $entityManager->getRepository(Leave::class)->find($id);

        if (!$leave) {
            throw $this->createNotFoundException('Le congé n\'existe pas.');
        }

        $leave->setStatus('Annulé');
        $entityManager->flush();

        return $this->redirectToRoute('leave_list');
    }

    #[Route('/leave/delete/{id}', name: 'leave_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $session->get('user');
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $leave = $entityManager->getRepository(Leave::class)->find($id);

        if (!$leave) {
            throw $this->createNotFoundException('Le congé n\'existe pas.');
        }

        $entityManager->remove($leave);
        $entityManager->flush();

        return $this->redirectToRoute('leave_list');
    }
}
