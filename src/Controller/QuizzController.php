<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Quizz;
use App\Repository\AnswerRepository;
use App\Repository\QuizzRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class QuizzController extends AbstractController
{
    /**
     * @Route("/quizz", name="app_quizz", methods={"POST"})
     */
    public function index(Request $request, AnswerRepository $answerRepository, QuizzRepository $quizzRepository): JsonResponse
    {
        $score = 0;
        // curl -d '{"quizz":[{"question":"question_id","answer":"answer_id"},{"question":"1","answer":"1"},{"question":"1","answer":"2"},{"question":"3","answer":"2"}]}' -H "Content-Type: application/json" -X POST http://localhost:8000/quizz
        $submittedQuizz = $request->get('quizz');
        $alreadyAnswered = [];
        foreach ($submittedQuizz as $data) {
            if (is_array($data) and array_key_exists('question', $data) && array_key_exists('answer', $data)) {
                $questionId = $data['question'];
                if (!array_key_exists($questionId, $alreadyAnswered)) {
                    $answerId = $data['answer'];
                    $answer = $answerRepository->findOneBy(['id' => $answerId, 'question' => $questionId]);
                    if (null != $answer) {
                        $score += $answer->getScore();
                        $alreadyAnswered[$questionId] = $answerId;
                    }
                }
            }
        }
        $quizz = new Quizz($score, Uuid::v4()->toBase32());
        $quizzRepository->add($quizz, true);

        return $this->json([
            'score' => $score,
            'code' => $quizz->getCode(),
        ]);
    }
}
