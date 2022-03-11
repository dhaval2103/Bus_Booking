@extends('auth.userlayout.master')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h3 class="mb-0">Payment Detail</h3>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                </ol>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <form role="form" action="{{ route('stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <input type="hidden" name="ticket_no" value="{{ $ticket_no }}">
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> <input class='form-control' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group card required'>
                                    <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number credit-card-number' type='text' name="number">
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc security-code' placeholder='ex. 311' type='text' name="cvc">
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> <input class='form-control expiration-month-and-year' placeholder='MM/YY' type='text' name="exp_month">
                                </div>
                            </div>
                            <div class="row">&nbsp;&nbsp;
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $(function() {
            var creditly = Creditly.initialize(
                ".expiration-month-and-year"
                , ".credit-card-number"
                , ".security-code"
                , ".card-type"
            );
            $(".payment__confirm").click(function(e) {
                e.preventDefault();
                var output = creditly.validate();
                $ele = $(".expiration-month-and-year");
                var today = new Date();
                if (output) {
                    // Your validated credit card output
                    console.log(output);
                    if (output.expiration_year < today.getFullYear()) {
                        $ele.next().show().text("Card is expired.");
                    } else {
                        $ele.next().hide();
                    }
                }
            });
        });
    });
    var Creditly = (function() {
        var getInputValue = function(e, selector) {
            var inputValue = $.trim($(selector).val());
            inputValue = inputValue + String.fromCharCode(e.which);
            return getNumber(inputValue);
        };

        var getNumber = function(string) {
            return string.replace(/[^\d]/g, "");
        };

        var reachedMaximumLength = function(e, maximumLength, selector) {
            return getInputValue(e, selector).length > maximumLength;
        };

        // Backspace, delete, tab, escape, enter, ., Ctrl+a, Ctrl+c, Ctrl+v, home, end, left, right
        var isEscapedKeyStroke = function(e) {
            return (
                $.inArray(e.which, [46, 8, 9, 0, 27, 13, 190]) !== -1 ||
                (e.which == 65 && e.ctrlKey === true) ||
                (e.which == 67 && e.ctrlKey === true) ||
                (e.which == 86 && e.ctrlKey === true) ||
                (e.which >= 35 && e.which <= 39)
            );
        };

        var isNumberEvent = function(e) {
            return /^\d+$/.test(String.fromCharCode(e.which));
        };

        var onlyAllowNumeric = function(e, maximumLength, selector) {
            e.preventDefault();
            // Ensure that it is a number and stop the keypress
            if (
                reachedMaximumLength(e, maximumLength, selector) ||
                e.shiftKey ||
                !isNumberEvent(e)
            ) {
                return false;
            }
            return true;
        };

        var isAmericanExpress = function(number) {
            return number.match("^(34|37)");
        };

        var shouldProcessInput = function(e, maximumLength, selector) {
            return (
                !isEscapedKeyStroke(e) && onlyAllowNumeric(e, maximumLength, selector)
            );
        };

        var CvvInput = (function() {
            var selector;
            var numberSelector;

            var createCvvInput = function(mainSelector, creditCardNumberSelector) {
                selector = mainSelector;
                numberSelector = creditCardNumberSelector;

                var getMaximumLength = function(isAmericanExpressCard) {
                    if (isAmericanExpressCard) {
                        return 4;
                    } else {
                        return 3;
                    }
                };

                $(selector).keypress(function(e) {
                    $(selector).removeClass("has-error");
                    var number = getInputValue(e, numberSelector);
                    var cvv = getInputValue(e, selector);
                    var isAmericanExpressCard = isAmericanExpress(number);
                    var maximumLength = getMaximumLength(isAmericanExpressCard);
                    if (shouldProcessInput(e, maximumLength, selector)) {
                        $(selector).val(cvv);
                    }
                });
            };

            return {
                createCvvInput: createCvvInput
            };
        })();

        var NumberInput = (function() {
            var selector;
            var americanExpressSpaces = [4, 10, 15];
            var defaultSpaces = [4, 8, 12, 16];

            var getMaximumLength = function(isAmericanExpressCard) {
                if (isAmericanExpressCard) {
                    return 15;
                } else {
                    return 16;
                }
            };

            var createNumberInput = function(mainSelector) {
                selector = mainSelector;
                $(selector).keypress(function(e) {
                    $(selector).removeClass("has-error");
                    var number = getInputValue(e, selector);
                    var isAmericanExpressCard = isAmericanExpress(number);
                    var maximumLength = getMaximumLength(isAmericanExpressCard);
                    if (shouldProcessInput(e, maximumLength, selector)) {
                        var newInput;
                        if (isAmericanExpressCard) {
                            newInput = addSpaces(number, americanExpressSpaces);
                        } else {
                            newInput = addSpaces(number, defaultSpaces);
                        }

                        $(selector).val(newInput);
                        $(selector).trigger("changed_input");
                    }
                });
            };

            var addSpaces = function(number, spaces) {
                var parts = [];
                var j = 0;
                for (var i = 0; i < spaces.length; i++) {
                    if (number.length > spaces[i]) {
                        parts.push(number.slice(j, spaces[i]));
                        j = spaces[i];
                    } else {
                        if (i < spaces.length) {
                            parts.push(number.slice(j, spaces[i]));
                        } else {
                            parts.push(number.slice(j));
                        }
                        break;
                    }
                }

                if (parts.length > 0) {
                    return parts.join(" ");
                } else {
                    return number;
                }
            };

            return {
                createNumberInput: createNumberInput
            };
        })();

        var Validation = (function() {
            var Validators = (function() {
                var expirationRegex = /(\d\d)\s*\/\s*(\d\d)/;

                var creditCardExpiration = function(selector, data) {
                    var expirationVal = $.trim($(selector).val());
                    var match = expirationRegex.exec(expirationVal);
                    var isValid = false;
                    var outputValue = ["", ""];
                    if (match && match.length === 3) {
                        var month = parseInt(match[1], 10);
                        var year = "20" + match[2];
                        if (month >= 0 && month <= 12) {
                            isValid = true;
                            var outputValue = [month, year];
                        }
                    }

                    return {
                        is_valid: isValid
                        , messages: [data["message"]]
                        , output_value: outputValue
                    };
                };

                var isValidSecurityCode = function(isAmericanExpress, securityCode) {
                    if (
                        (isAmericanExpress && securityCode.length == 4) ||
                        (!isAmericanExpress && securityCode.length == 3)
                    ) {
                        return true;
                    }
                    return false;
                };

                var creditCard = function(selector, data) {
                    var rawNumber = $(data["creditCardNumberSelector"]).val();
                    var number = $.trim(rawNumber).replace(/\D/g, "");
                    var rawSecurityCode = $(data["cvvSelector"]).val();
                    var securityCode = $.trim(rawSecurityCode).replace(/\D/g, "");
                    var messages = [];
                    var isValid = true;
                    var selectors = [];

                    if (!isValidCreditCardNumber(number)) {
                        messages.push(data["message"]["number"]);
                        selectors.push(data["creditCardNumberSelector"]);
                        isValid = false;
                    }

                    if (!isValidSecurityCode(isAmericanExpress(number), securityCode)) {
                        messages.push(data["message"]["security_code"]);
                        selectors.push(data["cvvSelector"]);
                        isValid = false;
                    }

                    result = {
                        is_valid: isValid
                        , output_value: [number, securityCode]
                        , selectors: selectors
                        , messages: messages
                    };
                    return result;
                };

                var isAmericanExpress = function(number) {
                    return number.length == 15;
                };

                // Luhn Algorithm.
                var isValidCreditCardNumber = function(value) {
                    if (value.length === 0) return false;
                    // accept only digits, dashes or spaces
                    if (/[^0-9-\s]+/.test(value)) return false;

                    var nCheck = 0
                        , nDigit = 0
                        , bEven = false;
                    for (var n = value.length - 1; n >= 0; n--) {
                        var cDigit = value.charAt(n);
                        var nDigit = parseInt(cDigit, 10);
                        if (bEven) {
                            if ((nDigit *= 2) > 9) nDigit -= 9;
                        }
                        nCheck += nDigit;
                        bEven = !bEven;
                    }
                    return nCheck % 10 == 0;
                };

                return {
                    creditCard: creditCard
                    , creditCardExpiration: creditCardExpiration
                };
            })();

            var ValidationErrorHolder = function() {
                var errorMessages = [];
                var selectors = [];

                var addError = function(selector, validatorResults) {
                    if (validatorResults.hasOwnProperty("selectors")) {
                        selectors = selectors.concat(validatorResults["selectors"]);
                    } else {
                        selectors.push(selector);
                    }

                    errorMessages.concat(validatorResults["messages"]);
                };

                var triggerErrorMessage = function() {
                    var errorsPayload = {
                        selectors: selectors
                        , messages: errorMessages
                    };
                    for (var i = 0; i < selectors.length; i++) {
                        $(selectors[i]).addClass("has-error");
                    }
                    $(".expiration-month-and-year")
                        .next()
                        .show()
                        .text("Date is not valid.");
                    $("body").trigger("creditly_client_validation_error", errorsPayload);
                };

                return {
                    addError: addError
                    , triggerErrorMessage: triggerErrorMessage
                };
            };

            var ValidationOutputHolder = function() {
                var output = {};

                var addOutput = function(outputName, value) {
                    var outputParts = outputName.split(".");
                    var currentPart = output;
                    for (var i = 0; i < outputParts.length; i++) {
                        if (!currentPart.hasOwnProperty(outputParts[i])) {
                            currentPart[outputParts[i]] = {};
                        }

                        // Either place the value into the output, or continue going down the
                        // search space.
                        if (i === outputParts.length - 1) {
                            currentPart[outputParts[i]] = value;
                        } else {
                            currentPart = currentPart[outputParts[i]];
                        }
                    }
                };

                var getOutput = function() {
                    return output;
                };

                return {
                    addOutput: addOutput
                    , getOutput: getOutput
                };
            };

            var processSelector = function(
                selector
                , selectorValidatorMap
                , errorHolder
                , outputHolder
            ) {
                if (selectorValidatorMap.hasOwnProperty(selector)) {
                    var currentMapping = selectorValidatorMap[selector];
                    var validatorType = currentMapping["type"];
                    var fieldName = currentMapping["name"];
                    var validatorResults = Validators[validatorType](
                        selector
                        , currentMapping["data"]
                    );

                    if (validatorResults["is_valid"]) {
                        if (currentMapping["output_name"] instanceof Array) {
                            for (var i = 0; i < currentMapping["output_name"].length; i++) {
                                outputHolder.addOutput(
                                    currentMapping["output_name"][i]
                                    , validatorResults["output_value"][i]
                                );
                            }
                        } else {
                            outputHolder.addOutput(
                                currentMapping["output_name"]
                                , validatorResults["output_value"]
                            );
                        }
                    } else {
                        errorHolder.addError(selector, validatorResults);
                        return true;
                    }
                }
            };

            var validate = function(selectorValidatorMap) {
                var errorHolder = ValidationErrorHolder();
                var outputHolder = ValidationOutputHolder();
                var anyErrors = false;
                for (var selector in selectorValidatorMap) {
                    if (
                        processSelector(
                            selector
                            , selectorValidatorMap
                            , errorHolder
                            , outputHolder
                        )
                    ) {
                        anyErrors = true;
                    }
                }
                if (anyErrors) {
                    errorHolder.triggerErrorMessage();
                    return false;
                } else {
                    return outputHolder.getOutput();
                }
            };

            return {
                validate: validate
            };
        })();

        var ExpirationInput = (function() {
            var maximumLength = 4;
            var selector;

            var createExpirationInput = function(mainSelector) {
                selector = mainSelector;
                $(selector).keypress(function(e) {
                    $(selector).removeClass("has-error");
                    if (shouldProcessInput(e, maximumLength, selector)) {
                        var inputValue = getInputValue(e, selector);
                        if (inputValue.length >= 2) {
                            var newInput = inputValue.slice(0, 2) + " / " + inputValue.slice(2);
                            $(selector).val(newInput);
                        } else {
                            $(selector).val(inputValue);
                        }
                    }
                });
            };

            var parseExpirationInput = function(expirationSelector) {
                var inputValue = getNumber($(expirationSelector).val());
                var month = inputValue.slice(0, 2);
                var year = "20" + inputValue.slice(2);
                return {
                    year: year
                    , month: month
                };
            };

            return {
                createExpirationInput: createExpirationInput
                , parseExpirationInput: parseExpirationInput
            };
        })();

        var CardTypeListener = (function() {
            var determineCardType = function(value) {
                if (/^(34|37)/.test(value)) {
                    return "American Express";
                } else if (/^4/.test(value)) {
                    return "Visa";
                } else if (/^5[0-5]/.test(value)) {
                    return "MasterCard";
                } else if (/^(6011|622|64[4-9]|65)/.test(value)) {
                    return "Discover";
                } else {
                    return "";
                }
            };

            var changeCardType = function(numberSelector, cardTypeSelector) {
                $(numberSelector).on(
                    "changed_input keypress keydown keyup"
                    , function(e) {
                        var data = $(numberSelector).val();
                        var cardType = determineCardType(getNumber(data));
                        $(cardTypeSelector).text(cardType);
                    }
                );
            };

            return {
                changeCardType: changeCardType
            };
        })();

        var initialize = function(
            expirationSelector
            , creditCardNumberSelector
            , cvvSelector
            , cardTypeSelector
            , options
        ) {
            createSelectorValidatorMap(
                expirationSelector
                , creditCardNumberSelector
                , cvvSelector
                , options
            );

            ExpirationInput.createExpirationInput(expirationSelector);
            NumberInput.createNumberInput(creditCardNumberSelector);
            CvvInput.createCvvInput(cvvSelector, creditCardNumberSelector);
            CardTypeListener.changeCardType(creditCardNumberSelector, cardTypeSelector);

            return this;
        };

        var selectorValidatorMap;

        var createSelectorValidatorMap = function(
            expirationSelector
            , creditCardNumberSelector
            , cvvSelector
            , options
        ) {
            var optionValues = options || {};
            optionValues["security_code_message"] =
                optionValues["security_code_message"] || "Your security code is invalid";
            optionValues["number_message"] =
                optionValues["number_message"] || "Your credit card number is invalid";
            optionValues["expiration_message"] =
                optionValues["expiration_message"] ||
                "Your credit card expiration is invalid";

            selectorValidatorMap = {};
            /*selectorValidatorMap[creditCardNumberSelector] = {
                "type": "creditCard",
                "data": {
                  "cvvSelector": cvvSelector,
                  "creditCardNumberSelector": creditCardNumberSelector,
                  "message": {
                    "security_code": optionValues["security_code_message"],
                    "number": optionValues["number_message"]
                  }
                },
                "output_name": ["number", "security_code"]
              };*/
            selectorValidatorMap[expirationSelector] = {
                type: "creditCardExpiration"
                , data: {
                    message: optionValues["expiration_message"]
                }
                , output_name: ["expiration_month", "expiration_year"]
            };
        };

        var validate = function() {
            return Validation.validate(selectorValidatorMap);
        };

        return {
            initialize: initialize
            , validate: validate
        };
    })();

</script>
@endpush
