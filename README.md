## Introduction

This project shows a game where 3 users can guess a number. It is a complete web based application. Core classes are:
  - `ChallengeController`
  - `User`
  - `SessionUserRepository`
  
## Running the game

Open a terminal, go to the root of this project and type:
```
composer install
```

Generate a random string of 32 characters, at for example: http://www.unit-conversion.info/texttools/random-string-generator/
 and put it in `.env` after:
```
APP_KEY=
```

To show the game, run in the terminal:
```
 php -S localhost:8000 -t public
```

Open a browser and goto:

```
http://localhost:8000/
```
