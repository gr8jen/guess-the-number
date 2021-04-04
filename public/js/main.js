CHALLENGE = function () {
    return {
        init: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $('.js-user-name').on('blur', function (event) {
                event.preventDefault()
                let user = $(this).closest('.js-user')
                CHALLENGE.clearValidationErrors()
                CHALLENGE.signUp(user.data('key'), $(this).val())
            })
            $('.js-guess').on('click', function (event) {
                event.preventDefault()
                let user = $(this).closest('.js-user')
                let guessedNumber = user.find('input[name="guessedNumber"]').val()
                CHALLENGE.clearValidationErrors()
                CHALLENGE.guessNumber(user.data('key'), guessedNumber)
            })
        },
        signUp: function (key, userName) {
            $.ajax({
                type: 'POST',
                url: route.challenge.sign_up,
                data: { key, userName },
                dataType: 'json',
            }).done(function (data) {
                CHALLENGE.handleEnablingButtonsAndInput(data.playingIsDisabled)
            }).fail(function (error) {
                let encoded = error.responseJSON
                this.showValidationErrors(encoded)
            })
        },
        guessNumber: function (key, guessedNumber) {
            $.ajax({
                type: 'POST',
                url: route.challenge.guess_number,
                data: { key, guessedNumber },
                dataType: 'json',
            }).done(function (data) {
                if (data.guessIsCorrect) {
                    CHALLENGE.showGuessSuccess()
                } else {
                    CHALLENGE.showNumberDiffersInfo(data.key, data.numberCompare)
                }
            }).fail(function (error) {
                let encoded = error.responseJSON
                if (encoded.exception === 'Webmozart\\Assert\\InvalidArgumentException') {
                    $('.js-error').text(encoded.message)
                }
            })
        },
        showGuessSuccess: function () {
            this.hideAllNumberDiffersInfo()
            $('#numberFoundModal').modal('show')
        },
        showNumberDiffersInfo: function (key, numberCompare) {
            let form = $('form[data-key=\'' + key + '\']')

            if (numberCompare === -1) {
                form.find('.js-higher:not(.d-none)').addClass('d-none')
                form.find('.js-lower').removeClass('d-none')
            }
            if (numberCompare === 1) {
                form.find('.js-lower:not(.d-none)').addClass('d-none')
                form.find('.js-higher').removeClass('d-none')
            }
        },
        hideAllNumberDiffersInfo: function () {
            $('.js-higher:not(.d-none)').addClass('d-none')
            $('.js-lower:not(.d-none)').addClass('d-none')
        },
        handleEnablingButtonsAndInput (playingIsDisabled) {
            if (playingIsDisabled) {
                $('.js-button').addClass('disabled')
            } else {
                $('.js-button').removeClass('disabled')
            }
            $('.js-input').prop('disabled', playingIsDisabled)
        },
        showValidationErrors: function (encoded) {
            if (encoded.exception === 'Webmozart\\Assert\\InvalidArgumentException') {
                $('.js-error').text(encoded.message)
            }
        },
        clearValidationErrors: function () {
            $('.js-error').empty()
        },
    }
}()

CHALLENGE.init()
