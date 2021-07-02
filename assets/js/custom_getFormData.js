/*!
 * jQuery get data from form v1.0
 *
 *  Anish Maharjan
 */
 function getFormData(formId) {
 	return $('#' + formId).serializeArray().reduce(function (obj, item) {
 		var name = item.name,
 		value = item.value;

 		if (obj.hasOwnProperty(name)) {
 			if (typeof obj[name] == "string") {
 				obj[name] = [obj[name]];
 				obj[name].push(value);
 			} else {
 				obj[name].push(value);
 			}
 		} else {
 			obj[name] = value;
 		}	
 		return obj;
 	}, {});
 }