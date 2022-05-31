# API Quiz

## Récupérer les questions et réponses

GET /questions

## Poster une réponse

POST /quizz

### Règles

- Il est possible de ne pas répondre à toutes les questions.
- Si plusieurs réponses sont envoyées pour la même question : le système ne prend en compte que la première réponse.

### Exemple
`curl -d '{"quizz":[{"question":"question_id","answer":"answer_id"},{"question":"1","answer":"1"},{"question":"1","answer":"2"},{"question":"3","answer":"2"}]}' -H "Content-Type: application/json" -X POST http://localhost:8000/quizz`
