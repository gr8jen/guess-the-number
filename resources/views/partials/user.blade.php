<div class="col">
    <form id="user" class="js-user" data-key="{{$key}}">
        <div class="row">
            <div class="col-sm m-5 p-5 border">
                <div class="text-center">
                    <img class="w-50" src="images\authenticate-icon-human.jpg">
                </div>
                <div class="col pb-4 pt-4">
                    <div class="form-group">
                        <input type="text" class="form-control-plaintext border-bottom text-center js-user-name"
                               name="username" placeholder="Insert name"
                               value="{{$user ? $user->getUserName(): ''}}">
                    </div>
                </div>
                <div class="col pb-4 pt-4">
                    <div class="form-group">
                        <input type="number" class="form-control text-center js-input" name="guessedNumber" min="1"
                               max="100"
                               @if($playingIsDisabled) disabled @endif>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <button type="button"
                                class="btn btn-primary btn-block js-guess js-button @if($playingIsDisabled) disabled @endif">
                            Guess Number
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm m-5 p-3 border js-higher d-none">
                <span class="text-danger">Higher!</span>
            </div>
            <div class="col-sm m-5 p-3 border js-lower d-none">
                <span class="text-danger">Lower!</span>
            </div>
        </div>
    </form>
</div>
