/*
  http://stackoverflow.com/questions/1184624/convert-form-data-to-js-object-with-jquery
  Serialize form to JSON with jQuery
*/
jQuery.fn.serializeObject = function(){  
  var arrayData, objectData;
  arrayData = this.serializeArray();
  objectData = {};

  jQuery.each(arrayData, function() {
    var value;

    if (this.value != null) {
      value = this.value;
    } else {
      value = '';
    }

    if (objectData[this.name] != null) {
      if (!objectData[this.name].push) {
        objectData[this.name] = [objectData[this.name]];
      }

      objectData[this.name].push(value);
    } else {
      objectData[this.name] = value;
    }
  });

  return objectData;
}

