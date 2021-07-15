function ErrorModule() {

  this.clearError = function (element) {
    if (element == undefined || element == false) {
      return;
    }
    if (element.find('.errorMessageDisplay').length > 0) {
      element.find('.errorMessageDisplay').html('');
    } else {
      element.html('');
    }
    element.fadeOut();
  };

  this.showError = function (element, text, hideElement) {
    if (element == undefined || element == false) {
      return;
    }
    coreSelf.setError(element, text);
    if (hideElement != undefined) {
      hideElement.fadeOut();
    }
    element.fadeIn();
  };

  this.showErrorInfo = function (jsonObj, showElement, hideElement) {
    var hasErrors = false;
    if (jsonObj == undefined ||
      jsonObj.UserFriendlyDisplayList == undefined ||
      jsonObj.UserFriendlyDisplayList == null ||
      jsonObj.UserFriendlyDisplayList.length == 0) {
      if (showElement != undefined && showElement != false) {
        showElement.fadeOut();
      }
      if (hideElement != undefined) {
        hideElement.show();
      }
    } else {
      hasErrors = true;
      var message = coreSelf.createErrorMessage(jsonObj.UserFriendlyDisplayList, '<br/>');
      if (hideElement != undefined) {
        hideElement.fadeOut();
      }
      if (showElement != undefined && showElement != false) {
        coreSelf.setError(showElement, message);
        showElement.fadeIn();
      }
    }

    return hasErrors;
  };

  this.showSingleErrorInfo = function (jsonObj, showElement, hideElement) {
    var hasErrors = false;
    if (jsonObj == undefined ||
      jsonObj.UserFriendlyDisplayList == undefined ||
      jsonObj.UserFriendlyDisplayList == null ||
      jsonObj.UserFriendlyDisplayList.length == 0) {
      if (showElement != undefined && showElement != false) {
        showElement.fadeOut();
      }
      if (hideElement != undefined) {
        hideElement.show();
      }
    } else {
      hasErrors = true;
      var message = coreSelf.createErrorMessage(jsonObj.UserFriendlyDisplayList, '');
      if (hideElement != undefined) {
        hideElement.fadeOut();
      }
      if (showElement != undefined && showElement != false) {
        coreSelf.setError(showElement, message);
        showElement.fadeIn();
      }
    }

    return hasErrors;
  };

  this.createErrorMessage = function (errors, lineBreak) {
    var message = "";
    if (errors != undefined && errors.length > 0) {
      for (var i = 0; i < errors.length; i++) {
        message = message + errors[i].Description;
        if (i + 1 < errors.length) {
          message = message + lineBreak;
        }
        if (errors[i].Tag != undefined && errors[i].Tag != null && errors[i].Tag.length > 0) {
          $(errors[i].Tag).addClass('error');
        }
      }
    }

    return message;
  };

  this.isValidDateSpan = function (start, end, minDate) {
    if (start == undefined ||
			start == '' ||
			end == undefined ||
			end == '' ||
			minDate == undefined) {
      return false;
    }

    var startDate = coreSelf.errorModule.validateDateString(start);
    if (startDate == null) {
      return false;
    }
    var endDate = coreSelf.errorModule.validateDateString(end);
    if (endDate == null) {
      return false;
    }

    return startDate >= minDate
		 && endDate <= new Date()
		 && startDate <= endDate;
  };

  this.isValidEmail = function (text) {
    if (text == undefined) {
      return false;
    }

    if (text.indexOf("@") === -1) {
      return false;
    }

    if (text.lastIndexOf("@") > text.lastIndexOf(".")) {
      return false;
    }

    return true;
  };

  this.isValidInternationalCellphoneNumber = function (text) {
    var telNo = text;

    if (telNo.indexOf(" ") !== -1
    || telNo.length < 11
    || telNo.charAt(0) != '+'
    || !$.isNumeric(telNo.substring(1))) {
      return false;
    }

    return true;
  };

  this.isValidCellphoneNumber = function (text) {
    var me = this;
    var telNo = text;

    if (me.isValidInternationalCellphoneNumber(telNo)) {
      return true;
    }

    if (telNo.indexOf(" ") !== -1
    || telNo.length < 10
    || telNo.charAt(0) != '0'
    || !$.isNumeric(telNo)) {
      return false;
    }

    return true;
  };

  this.lengthValidator = function (text, minimumLength, maximumLength) {

    if (!text) {
      return false;
    }

    var textWithnoWhiteSpace = text.replace(/\s/g, "");

    var valid = (textWithnoWhiteSpace.length >= minimumLength & textWithnoWhiteSpace.length <= maximumLength);

    if (!valid) {
      return false;
    }

    return true;
  };

  this.isTextBoxEmpty = function (text) {

    if (!text) {
      return false;
    }

    return true;
  };

  this.isStringAlphabetic = function (text) {

    if (!text) {
      return false;
    }

    var valid = /^[a-zA-Z \-'àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$/.test(text);

    if (!valid) {
      return false;
    }

    return true;
  };

  this.isNumeric = function (text) {

    if (!text) {
      return false;
    }

    var valid = /^([0-9]+(\.[0-9]*)?|(0\.[0-9]*)|0)$/.test(text);

    if (!valid) {
      return false;
    }

    return true;
  };

  this.isNumber = function (text) {

    if (!text) {
      return false;
    }

    var valid = /^(\-?[0-9]+)$/.test(text);

    if (!valid) {
      return false;
    }

    return true;
  };

  this.isSouthAfricanTelephone = function (text) {

    if (!text) {
      return false;
    }

    var valid = /^((?:\+27|27)|0)[87654321][123456789](\d{7})/.test(text);

    if (!valid) {
      return false;
    }

    return true;
  };

  this.isValidMoney = function (text, allowDecimal) {
    if (text == undefined) {
      return false;
    }

    if (text == '' || text == ' ') {
      return false;
    }

    var valid;
    
    //only takes numeric values
    //. is allowed(but not neccessary) for cents
    //max of 5 chars before the .
    //max of 2 chars after the dot
    if (allowDecimal) {
      valid = /^\d{0,9}(\.\d{0,2})?$/.test(text);
    } else {
      valid = /^\d{0,9}$/.test(text);
    }

    return valid;
  };

  this.checkCompulsoryControls = function (showElement) {
    var errors = [];
    var compulsoryText = $('input[data-compulsory]');
    compulsoryText.removeClass('error');
    compulsoryText.each(function () {
      var isError = false;

      if ($(this).attr('type') == 'text') {
        var text = $(this).val();
        if (text == undefined ||
            text == '') {
          isError = true;
        }
      }
      else if ($(this).attr('type') == 'checkbox') {
        var checked = $(this).attr('checked');
        if (checked == undefined ||
            checked != 'checked') {
          isError = true;
        }
      }

      if (isError) {
        $(this).addClass('error');
        errors.push(new jsError($(this).data('compulsory')));
      }
    });

    var compulsorySelect = $('select[data-compulsory]');
    compulsorySelect.next().removeClass('error');
    compulsorySelect.each(function () {
      var selected = $(this).val();
      if (selected == null ||
      selected == '0') {
        $(this).next().addClass('error');
        errors.push(new jsError($(this).data('compulsory')));
      }
    });

    var compulsorySelectOptionInput = $('input[data-option]');
    compulsorySelectOptionInput.removeClass('error');
    compulsorySelectOptionInput.each(function () {
      var input = $(this);
      var option = input.data('option').split(':');
      var selector = $('select[data-select="' + option[0] + '"]');
      var text = input.val();
      if ((text == undefined
        || text == '') &&
        selector.val() == option[1]) {
        input.addClass('error');
        var error = input.data('error');
        if (error == undefined
          || error == '') {
          errors.push(new jsError(selector.data('compulsory')));
        } else {
          errors.push(new jsError(error));
        }
      }
    });

    $('.select-option').removeClass('error');
    var compulsorySelectOptionSelect = $('select[data-option]');
    compulsorySelectOptionSelect.each(function () {
      var select = $(this);
      var option = select.data('option').split(':');
      var selector = $('select[data-select="' + option[0] + '"]');
      var value = select.val();
      if ((value == null ||
        value == '0' ||
        value == 'None') &&
        selector.val() == option[1]) {
        $(this).next().addClass('error');
        var error = select.data('error');
        if (error == undefined
          || error == '') {
          errors.push(new jsError(selector.data('compulsory')));
        } else {
          errors.push(new jsError(error));
        }
      }
    });

    var compulsoryRadio = $('div[data-compulsory]');
    compulsoryRadio.removeClass('error');
    compulsoryRadio.each(function () {
      var selected = $(this).children(':checked');
      if (selected == undefined ||
      selected.length == 0) {
        $(this).addClass('error');
        errors.push(new jsError($(this).data('compulsory')));
      }
    });

    if (errors.length > 0) {
      var message = coreSelf.createErrorMessage(errors, '<br/>');
      coreSelf.setError(showElement, message);
      showElement.fadeIn();
      return false;
    }

    return true;
  };

  this.setError = function (element, text) {
    if (element == undefined || element == false) {
      return;
    }
    if (element.find('.errorMessageDisplay').length > 0) {
      element.find('.errorMessageDisplay').html(text);
    } else {
      element.html(text);
    }
  };

  this.validateDateString = function (dateString) {
    if (dateString == undefined ||
			dateString == '') {
      return null;
    }

    //check dd/mm/yyyy format
    var validformat = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!validformat.test(dateString)) {
      return null;
    }

    //check values are correct
    var splitDate = dateString.split('/');
    var day = splitDate[0];
    var month = splitDate[1];
    var year = splitDate[2];
    var tmpDate = new Date(year, month - 1, day);
    if (tmpDate.getDate() != day ||
      tmpDate.getMonth() + 1 != month ||
      tmpDate.getFullYear() != year) {
      return null;
    }

    return tmpDate;
  };
}

function jsError(desc) {
  this.Description = desc;
}