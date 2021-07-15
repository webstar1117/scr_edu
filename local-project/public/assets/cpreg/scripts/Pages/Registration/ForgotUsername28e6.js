function ForgotUsername(core, parentId) {

  this.self = null;
  this.parentId = parentId;
  this.core = core;

  this.load = function () {
    me = this;
    $('.progressBar').hide();
  };

  this.validate = function () {
       
    //check if hidden field has value
    var result = true;
    core.showSpinner(['.rowGroup', '.row'], '#spinner');

    return result;
  };

}