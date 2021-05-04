<?php

namespace App\Controller;

use App\Entity\Result;
use App\Entity\Answers;
use App\Entity\Questions;
use App\Form\QuestionsType;
use App\Repository\AnswersRepository;
use App\Repository\QuestionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/questions')]
class QuestionsController extends AbstractController
{
    #[Route('/', name: 'questions_index', methods: ['GET'])]
    public function index(QuestionsRepository $questionsRepository): Response
    {
        return $this->render('questions/index.html.twig', [
            'questions' => $questionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'questions_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('questions_index');
        }

        return $this->render('questions/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    //// a modifier ///////////
    #[Route('/result/{id}', name: 'questions_result', methods: ['GET'])]
    public function show(Questions $question): Response
    {
        return $this->render('questions/result.html.twig', [
            'question' => $question,
        ]);
    }

    //////////////////       //////////////////////////


    #[Route('/{id}/edit', name: 'questions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Questions $question): Response
    {
        $form = $this->createForm(QuestionsType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('questions_index');
        }

        return $this->render('questions/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/answer', name: 'questions_answer', methods: ['GET', 'POST'])]
    public function answer(Request $request, Questions $question,AnswersRepository $answersRepository): Response
    {
        if ($request->getMethod() === 'POST') {
            $formData = $request->request->get('answer');
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($formData as $choiceId) {
                $resultat = new Result();
                $resultat->setIdUsers($this->getUser());
                $resultat->setAdressIp($request->getClientIp());
                $resultat->setAnswer($answersRepository->find($choiceId));
                $resultat->setIdQuestions($question);
                $entityManager->persist($resultat);
                $entityManager->flush();
            }
            return $this->redirectToRoute('questions_index');
        }

        return $this->render('questions/answer.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{id}', name: 'questions_delete', methods: ['POST'])]
    public function delete(Request $request, Questions $question): Response
    {
        if ($this->isCsrfTokenValid('delete' . $question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('questions_index');
    }
}
