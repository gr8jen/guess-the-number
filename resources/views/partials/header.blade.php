<div class="container">
    <div class="row mt-5">
        <div class="col text-center">
            <h1 class=""><strong>Guess the number</strong></h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col text-center">
            <h1 class=""><strong>"The greatest guessing game ever!"</strong></h1>
        </div>
    </div>
    <div class="col d-flex justify-content-between">
            <span class="border-bottom border-primary">Game</span>
            <p class="js-error text-danger"></p>
            <a href="{{ route('challenge.renew-game') }}"
               class="btn btn-primary js-button mb-3 @if($playingIsDisabled) disabled @endif"> Start new game</a>

    </div>
    <div class="row">

    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="numberFoundModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center ">
                <h2 class="modal-title" id="numberFoundModalLabel">You win</h2>
                <div class="modal-body">
                    <img class="img-fluid" src="images\drawn-fireworks-transparent-background.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="border-bottom border-grey"></div>

