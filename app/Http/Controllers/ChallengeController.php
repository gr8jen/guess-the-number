<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Contracts\Repositories\UserRepository;
use App\Entities\User;
use App\Factories\UserFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store as Storage;
use Illuminate\Support\Collection;
use Laravel\Lumen\Http\ResponseFactory;
use Laravel\Lumen\Routing\Controller as BaseController;
use Webmozart\Assert\Assert;

final class ChallengeController extends BaseController
{
    private const MINIMUM_PLAYERS = 3;
    private const MINIMUM_NUMBER = 1;
    private const MAXIMUM_NUMBER = 100;
    private const GAME_NUMBER = 'number';
    private UserRepository $userRepository;
    private UserFactory $userFactory;
    private ViewFactory $viewFactory;
    private ResponseFactory $responseFactory;
    private Storage $storage;

    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory,
        ViewFactory $viewFactory,
        ResponseFactory $responseFactory,
        SessionManager $sessionManager
    ) {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->viewFactory = $viewFactory;
        $this->responseFactory = $responseFactory;
        $this->storage = $sessionManager->driver();
    }

    public function index(): View
    {
        $users = $this->userRepository->all();
        $playingIsDisabled = $this->playingIsDisabled($users);
        $minimumPlayers = self::MINIMUM_PLAYERS;

        return $this->viewFactory->make('index', compact(['users', 'playingIsDisabled', 'minimumPlayers']));
    }

    public function renewGame(): View
    {
        $users = $this->userRepository->all();
        $playingIsDisabled = $this->playingIsDisabled($users);
        $this->generateNumberToGuess();
        $minimumPlayers = self::MINIMUM_PLAYERS;

        return $this->viewFactory->make('index', compact(['users', 'playingIsDisabled', 'minimumPlayers']));
    }

    public function signUp(Request $request): JsonResponse
    {
        $key = $request->get('key');
        $userName = $request->get('userName');

        Assert::notNull($key);
        Assert::integerish($key);
        Assert::notNull($userName);

        $user = $this->userFactory->create((int)$key, $userName);
        $this->userRepository->save($user);
        $users = $this->userRepository->all();
        $playingIsDisabled = $this->playingIsDisabled($users);

        if ($playingIsDisabled === false) {
            $this->generateNumberToGuess();
        }

        return $this->responseFactory->json(['playingIsDisabled' => $playingIsDisabled]);
    }

    public function guessNumber(Request $request): JsonResponse
    {
        $guessedNumber = $request->get('guessedNumber');
        $key = $request->get('key');

        Assert::stringNotEmpty($guessedNumber);
        Assert::integerish($guessedNumber);
        Assert::range($guessedNumber, self::MINIMUM_NUMBER, self::MAXIMUM_NUMBER);
        Assert::notNull($key);
        Assert::integerish($key);

        $user = $this->userRepository->find((int)$key);
        $number = $this->storage->get(self::GAME_NUMBER);
        $numberCompare = $number <=> $guessedNumber;
        $guessIsCorrect = $numberCompare === 0;

        return $this->responseFactory->json(
            [
                'guessIsCorrect' => $guessIsCorrect,
                'key' => $user->getKey(),
                'numberCompare' => $numberCompare,
            ]
        );
    }

    private function playingIsDisabled(Collection $users): bool
    {
        $filteredUsers = $users->filter(
            function (User $user) {
                return $user->getUserName() !== '';
            }
        );

        return $filteredUsers->count() < self::MINIMUM_PLAYERS;
    }

    private function generateNumberToGuess(): void
    {
        $number = random_int(self::MINIMUM_NUMBER, self::MAXIMUM_NUMBER);
        $this->storage->put(self::GAME_NUMBER, $number);
    }
}
