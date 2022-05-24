<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/questions", name="app_question")
     */
    public function getQuestions(QuestionRepository $questionRepository): JsonResponse
    {
        $questions = $questionRepository->findAll();
        $responseArray = [];
        foreach ($questions as $question) {
            $answerArray = [];
            foreach ($question->getAnswers() as $answer) {
                $answerArray[] = [
                    'id' => $answer->getId(),
                    'name' => $answer->getName(),
                ];
            }
            $responseArray[] = [
                'id' => $question->getId(),
                'name' => $question->getName(),
                'description' => $question->getDescription(),
                'company' => $question->getCompany(),
                'position' => $question->getPosition(),
                'answers' => $answerArray,
            ];
        }

        return $this->json($responseArray);
    }
}
