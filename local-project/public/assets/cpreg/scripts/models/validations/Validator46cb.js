function Validator() {

  this.validate = function(parentId) {

    var errors = new Array();

    // psueudo code:
    // element: <input type='text' data-validation="length:10 numeric:true" ...>
    // var elementsToValidate = $("#" + parentId).find(.... get all tagged elements (use class, or find on 'data-validation')
    // foreach(element in elementsToValidate)
    // {
    //  validations = $(element).data('validation');
    //  foreach(validation in validations
    //    split valiation (i.e. length_10) 
    //    validationType = validation[0] 
    //    valudationValue = validation[1]
    //    if(validationType = 'length')
    //    {
    //      if($(element).val() < parseInt(valudationValue))
    //      {
    //        errors.push('Error message, NB: localizations');
    //        $(element).tooltip('Error message, NB: localizations');
    //        $(element).addClass('validation-error');     
    //      }
    //    }
    //    
    // show errors on error label. (pass in error label id as well)

    return errors.length == 0;
  };

}