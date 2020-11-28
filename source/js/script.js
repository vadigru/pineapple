(function () {
  var inputEmail = document.querySelector('.form__email');
  var submitButton = document.querySelector('.form__submit');
  var errorMesasgeField = document.querySelector('.form__error-message');
  var form = document.querySelector('.form');
  var termsBox = document.querySelector('.terms__checkbox');
  var subscribeInProgress = document.querySelector('.subscribe-input');
  var subscribeCompleted = document.querySelector('.subscribe-done');

  var Message = {
    DEFAULT: '',
    EMPTY: 'Email address is required.',
    CHECKBOX: 'You must accept the terms and conditions.',
    MAIL: 'Please provide a valid e-mail address.',
    COLUMBIA: 'We are not accepting subscriptions from Colombia emails.',
  }

  var obj = {
    checkEmailEnding: function (email) {
      return email.toLowerCase().indexOf('@') !== -1 && email.toLowerCase().slice(-3) === '.co';
    },
    checkEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },
    checkField: function (value) {
      return value === '';
    },
    checkTermsCheckbox: function () {
      return termsBox.checked;
    },
    isFiledEmpty: function () {
      return this.checkField(inputEmail.value)
    },
    isEmailValid: function () {
      return this.checkEmail(inputEmail.value)
    },
    isEmailEndsWithCo: function () {
      return this.checkEmailEnding(inputEmail.value)
    },
    isTermsChecked: function () {
      return this.checkTermsCheckbox();
    },
  }

  // var checkEmailEnding = function (email) {
  //   return email.toLowerCase().includes('@') && email.toLowerCase().slice(-3) === '.co';
  // }

  // var checkEmail = function (email) {
  //   var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  //   return re.test(String(email).toLowerCase());
  // }

  // var checkField = function (value) {
  //   return value === '';
  // }

  // var checkTermsCheckbox = function () {
  //   return termsBox.checked;
  // }

  // var isFiledEmpty = checkField(inputEmail.value);
  // var isEmailValid = checkEmail(inputEmail.value);
  // var isEmailEndsWithCo = checkEmailEnding(inputEmail.value);
  // var isTermsChecked = checkTermsCheckbox();

  var validateInput = function (evt) {
    var errorMessage;

    if (obj.isFiledEmpty() || !obj.isEmailValid() || obj.isEmailEndsWithCo() || !obj.isTermsChecked()) {
      submitButton.disabled = true;

      if (!obj.isTermsChecked()) {
        errorMessage = Message.CHECKBOX;
      }
      if (obj.isEmailEndsWithCo()) {
        errorMessage = Message.COLUMBIA;
      }
      if (!obj.isEmailValid()) {
        errorMessage = Message.MAIL;
      }
      if (obj.isFiledEmpty()) {
        errorMessage = Message.EMPTY;
      }

      form.addEventListener('input', validateInput);
    } else {
      submitButton.disabled = false;
      errorMessage = Message.DEFAULT;
      form.removeEventListener('input', validateInput);
    }

    errorMesasgeField.innerText = errorMessage;
  }

  var performValidation = function (evt) {
    evt.preventDefault();

    if (!obj.isFiledEmpty() && obj.isEmailValid() && !obj.isEmailEndsWithCo() && obj.isTermsChecked()) {
      subscribeInProgress.style.display = 'none';
      subscribeCompleted.style.display = 'flex';
    } else {
      validateInput();
    }
  }

  form.addEventListener('submit', performValidation);
})()
