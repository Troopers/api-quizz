<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $questionColour = new Question();
        $questionColour->setName('What is your favorite colour ?');
        $questionColour->setPosition(3);
        $manager->persist($questionColour);

        foreach (['red', 'blue', 'green', 'orange'] as $colour) {
            $answerColour = new Answer();
            $answerColour->setName($colour);
            $answerColour->setScore($colour == 'red' ? 1 :0);
            $answerColour->setQuestion($questionColour);
            $manager->persist($answerColour);
        }

        $questionQuest = new Question();
        $questionQuest->setName('What is your quest ?');
        $manager->persist($questionQuest);

        foreach (['to seek the Holy Grail', "I don't know", 'quest answer', 'quest answer'] as $quest) {
            $answerQuest = new Answer();
            $answerQuest->setName($quest);
            $answerQuest->setScore($quest == 'to seek the Holy Grail' ? 1 :0);
            $answerQuest->setQuestion($questionQuest);
            $manager->persist($answerQuest);
        }

        $question = new Question();
        $question->setName('What time is it ?');
        $manager->persist($question);

        $manager->flush();
    }
}
