## Introduction

This project shows a game where 3 users can guess a number. It is a complete web based application. Core classes are:
  - `ChallengeController`
  - `User`
  - `SessionUserRepository`
  
## Requirements

Needed 'software' on the computer are:

- composer

## Installing the game
Open a terminal and type at the desired location:
```
git clone git@github.com:gr8jen/guess-the-number.git
``` 
 Go to the root of this project:
```
cd guess-the-number/
```
Type the following command to install all the needed extra packages:
```
composer install
```
Copy the needed `.env` file:
```
cp .env.example .env
```
\
Generate a random string of 32 characters, at for example: http://www.unit-conversion.info/texttools/random-string-generator/
 and put it in `.env` after:
```
APP_KEY=
```

## Running the game
To show the game, run in the terminal:
```
 php -S localhost:8000 -t public
```

Open a browser and goto:

```
http://localhost:8000/
```
