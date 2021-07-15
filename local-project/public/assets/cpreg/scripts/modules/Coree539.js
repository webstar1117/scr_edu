function Core() {

  this.errorModule = null;
  this.validator = null;

  this.load = function () {
    coreSelf = this;
    coreSelf.errorModule = new ErrorModule();
    coreSelf.validator = new Validator();
    coreSelf.flipMultiLingualImgs();
  };

  this.getVal = function (element) {
    if (element.val() == element.attr('placeholder')) {
      return '';
    } else {
      return element.val();
    }
  };

  this.bindObject = function (parentId, obj) {
    var observable = ko.mapping.fromJS(obj);

    var parent = document.getElementById(parentId);
    ko.applyBindings(observable, parent);

    return observable;
  };

  this.bindJson = function (parentId, json) {
    var obj = jQuery.parseJSON(json);
    var observable = ko.mapping.fromJS(obj);

    var parent = document.getElementById(parentId);
    ko.applyBindings(observable, parent);

    return observable;
  };

  this.bindUpdateJson = function (json, observable) {
    var model = jQuery.parseJSON(json);
    ko.mapping.fromJS(model, observable);
  };

  this.bindUpdateList = function (newList, observableArray) {
    observableArray.removeAll();

    for (var i = 0; i < newList.length; i++) {
      var obs = ko.observable(newList[i]);
      observableArray.push(obs);
    }
  };

  this.validate = function (parentId) {
    var result = coreSelf.validator.validate(parentId);
    return result;
  };

  this.ignoreError = function (jqXHR) {
    // do checks
    if (jqXHR.readyState == 0 || jqXHR.status == 0) {
      return true;
    } else {
      return false;
    }
  };

  this.createErrorMessage = function (errors, lineBreak) {
    return coreSelf.errorModule.createErrorMessage(errors, lineBreak);
  };

  this.clearError = function (element) {
    coreSelf.errorModule.clearError(element);
  };

  this.setError = function (element, text) {
    coreSelf.errorModule.setError(element, text);
  };

  this.showError = function (element, text, hideElement) {
    coreSelf.errorModule.showError(element, text, hideElement);
  };

  this.showErrorInfo = function (jsonObj, showElement, hideElement) {
    return coreSelf.errorModule.showErrorInfo(jsonObj, showElement, hideElement);
  };

  this.showSingleErrorInfo = function (jsonObj, showElement, hideElement) {
    return coreSelf.errorModule.showSingleErrorInfo(jsonObj, showElement, hideElement);
  };

  this.replaceLineBreaksInHtml = function (selector) {
    $(selector).each(function () {
      var value = $(this).html();
      $(this).html(value.replace(/\n\r?/g, '<br />'));
    });
  };

  this.replaceAll = function (str, delimiter, replacer) {
    var tmpStr = str;
    if (delimiter != replacer) {
      while (tmpStr.indexOf(delimiter) >= 0) {
        tmpStr = tmpStr.replace(delimiter, replacer);
      }
    }
    return tmpStr;
  };

  this.showSpinner = function (selector, spinnerSelector) {
    $(selector).each(function (index, value) {
      $(value).hide();
    });

    $(spinnerSelector).show();
  };

  this.getFunctionsValue = function (value) {
    if (jQuery.isFunction(value)) {
      return value();
    }
    return value;
  };

  this.scrollToBottom = function () {
    $("html, body").animate({ scrollTop: $(document).height() - $(window).height() });
  };

  this.flipMultiLingualImgs = function () {
    var lang = $('.currentLanguage').text();
    var engFolder = '/img/';
    var afrFolder = '/img_afr/';

    if (lang == undefined
        || lang == ''
        || lang == 'English') {
      return;
    }

    $('.multilingual').each(function (index, value) {
      var control = $(value);
      if (control.is('img')) {
        var src = $(value).attr('src');

        if (src != undefined
        && src != '') {
          control.attr('src', src.replace(engFolder, afrFolder));
        }
      } else {

        var background = control.css('background');

        if (background != undefined
        && background != '') {
          control.css('background', background.replace(engFolder, afrFolder));
        }

        var backgroundImg = control.css('background-image');

        if (backgroundImg != undefined
        && backgroundImg != '') {
          control.css('background-image', backgroundImg.replace(engFolder, afrFolder));
        }
      }
    });
  };

  // Loops through errors in JSON string and assigns the descriptions to the relevant tags or to the error summary if a tag is not present for an error
  // Shows error summary if needed. Hides page contents on error if needed.
  this.processJsonErrorString = function (jsonErrorString, hidePageContentsOnError, pageContentId, errorControlId) {

    if (jsonErrorString.length) {
      var jsonErrors = JSON.parse(jsonErrorString);
      if (jsonErrors.length) {
        var elementToHide = null;
        if (hidePageContentsOnError) {
          elementToHide = $(pageContentId);
        }

        //process json error messages
        var hasError = jsonErrors.length;
        var summaryErrorMsg = '';
        for (var i = 0; i < jsonErrors.length; i++) {
          var labelId = '#' + jsonErrors[i].Tag;
          if (jsonErrors[i].Tag != null && $(labelId).length) {
            //label element found
            $(labelId).html(jsonErrors[i].Description);
          } else {
            //label not found or no tag id specified, add to summary error div
            summaryErrorMsg += jsonErrors[i].Description + '<br />';
          }
        }

        if (summaryErrorMsg.length) {
          core.showError(errorControlId, summaryErrorMsg, elementToHide);
          $(errorControlId).scrollTop;
        }
        return hasError;
      }
    }
  };

  this.formatCurrency = function (amount, currency) {
    var prefix = !currency ? "" : currency + " ";
    return prefix + Number(amount).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
  };
}