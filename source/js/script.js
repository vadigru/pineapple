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
    COLOMBIA: 'We are not accepting subscriptions from Colombia emails.',
  }

  submitButton.disabled = true;

  var Check = {
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

  var validateInput = function (evt) {
    var errorMessage;
    form.addEventListener('input', validateInput);

    if (Check.isFiledEmpty() || !Check.isEmailValid() || Check.isEmailEndsWithCo() || !Check.isTermsChecked()) {
      submitButton.disabled = true;

      if (!Check.isTermsChecked()) {
        errorMessage = Message.CHECKBOX;
      }
      if (Check.isEmailEndsWithCo()) {
        errorMessage = Message.COLOMBIA;
      }
      if (!Check.isEmailValid()) {
        errorMessage = Message.MAIL;
      }
      if (Check.isFiledEmpty()) {
        errorMessage = Message.EMPTY;
      }
    } else {
      submitButton.disabled = false;
      errorMessage = Message.DEFAULT;
    }

    errorMesasgeField.innerText = errorMessage;
  }

  var performSubmit = function(evt) {
    if (!Check.isFiledEmpty() && Check.isEmailValid() && !Check.isEmailEndsWithCo() && Check.isTermsChecked()) {
      subscribeInProgress.style.display = 'none';
      subscribeCompleted.style.display = 'flex';
      form.removeEventListener('input', validateInput);
    }
  }

  form.addEventListener('change', validateInput);
  form.addEventListener('submit', performSubmit);
})()
