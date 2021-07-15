function ProductSearch(core, parentId) {

  this.parentId = parentId;
  this.core = core;

  this.load = function () {
    me = this;
    
    CustomSelect.init();
    if (me.IntegratedReferer) {
      document.cookie = 'IntegratedReferrer=' + me.IntegratedReferer + '; path=/; domain=sanlam.co.za';
    }
    var productSearchTextBox = $("#" + me.ProductSearchTextBoxId);

    //Populate value if null
    if (!productSearchTextBox.val()) {
      productSearchTextBox.val(me.ProductSearchInitialText);
    }

    //On focus clears value if intial product search value
    productSearchTextBox.focus(function () {
      if (this.value == me.ProductSearchInitialText) {
        this.value = '';
      }

      $('#' + me.ExistingAccountPrnDivId).hide();
    });

    //On focus clears value if intial id search value
    $("#" + me.IdSearchTextBoxId).focus(function () {
      if (this.value == me.IdSearchInitialText) {
        this.value = '';
      }

      $('#' + me.ExistingAccountPrnDivId).hide();
    });
    
    //On focus for any personal info field, hide the existing account error message
    $(".searchByIdFields :input").focus(function () {
      $('#' + me.ExistingAccountPersonalInfoDivId).hide();
    });
  };

    this.validateProductNumber = function () {
        console.log(me.ProductSearchTextBoxId, me.ProductSearchInitialText, me.ProductSearchTooltip);
    var result = me.validate(me.ProductSearchTextBoxId, me.ProductSearchInitialText, me.ProductSearchTooltip);

    if (result) {
      core.showSpinner(['.rowGroup','.row'], '#spinner');
    }

    return result;
  };


  this.searchKeyPress = function(e) {
    // look for window.event in case event isn't passed in
    e = e || window.event;
    
    //keycode 13 is the enter key
    if (e.keyCode == 13) {
      var productSearchButton = $("#" + me.ProductSearchButtonId);
      productSearchButton.click();
      return false;
    }
    return true;
  };
  

  this.validateIdNumber = function () {
    var result = me.validate(me.IdSearchTextBoxId, me.IdSearchInitialText, me.IdSearchTooltip);

    if (result) {
      core.showSpinner(['.rowGroup', '.row'], '#spinner');
    }

    return result;
  };

  this.validate = function (textbox, initialText, tooltip) {
    //Close tooltips result div on click
    $('#' + tooltip).fadeOut(200);

    //Check if input value is valid
    var validateTextBox = $("#" + textbox);
    var result = true;
    if (!validateTextBox.val()) {
      result = false;
    } else if (validateTextBox.val() == initialText) {
      result = false;
    }

    //If invalid show tool tip
    if (!result) {
      $('#' + tooltip).fadeIn(200);
    }

    return result;
  };
}