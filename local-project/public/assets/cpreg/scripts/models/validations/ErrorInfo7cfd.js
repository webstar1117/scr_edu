function ErrorInfo(dto) {  
  this.Group = ko.observable(dto.Group);
  this.Code = ko.observable(dto.Code)
  this.Severity = ko.observable(dto.Severity);
  this.Description = ko.observable(dto.Description);  
}
