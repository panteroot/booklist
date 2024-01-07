//SEARCH IN SELECT BOX
jQuery.fn.filterByText = function(textbox, selectSingleMatch, selectedSelect) {
  return this.each(function() {
	var select = this;
	var options = [];
	$(select).find('option').each(function() {
		options.push({value: $(this).val(), text: $(this).text()});
	});
	$(select).data('options', options);
	$(textbox).bind('change keyup', function() {
	  var options = $(select).empty().scrollTop(0).data('options');
	  var search = $.trim($(this).val());
	  var regex = new RegExp(search,'gi');

	  $.each(options, function(i) {
		var option = options[i];
		//console.log(options[i]);
		if(!optionExists( option.value, document.getElementById( selectedSelect ) )) {
			if(option.text.match(regex) !== null) {					
				$(select).append(
					$('<option>').text(option.text).val(option.value)
				);
			}
		}
	  });
	  if (selectSingleMatch === true && 
		  $(select).children().length === 1) {
		$(select).children().get(0).selected = true;
	  }
	});
  });
};

function optionExists ( needle, haystack )
{
	var optionExists = false,
		optionsLength = haystack.length;
	while ( optionsLength-- )
	{
		if ( haystack.options[ optionsLength ].value === needle )
		{
			optionExists = true;
			break;
		}
	}
	return optionExists;
}

// price text-box allow numeric and allow 2 decimal points only
function extractNumber(obj, decimalPlaces, allowNegative)
{
    var temp = obj.value;

    // avoid changing things if already formatted correctly
    var reg0Str = '[0-9]*';
    if (decimalPlaces > 0) {
        reg0Str += '\[\,\.]?[0-9]{0,' + decimalPlaces + '}';
    } else if (decimalPlaces < 0) {
        reg0Str += '\[\,\.]?[0-9]*';
    }
    reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
    reg0Str = reg0Str + '$';
    var reg0 = new RegExp(reg0Str);
    if (reg0.test(temp)) return true;

    // first replace all non numbers
    var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (decimalPlaces != 0 ? ',' : '') + (allowNegative ? '-' : '') + ']';
    var reg1 = new RegExp(reg1Str, 'g');
    temp = temp.replace(reg1, '');

    if (allowNegative) {
        // replace extra negative
        var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
        var reg2 = /-/g;
        temp = temp.replace(reg2, '');
        if (hasNegative) temp = '-' + temp;
    }

    if (decimalPlaces != 0) {
        var reg3 = /[\,\.]/g;
        var reg3Array = reg3.exec(temp);
        if (reg3Array != null) {
            // keep only first occurrence of .
            //  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
            var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
            reg3Right = reg3Right.replace(reg3, '');
            reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
            temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
        }
    }

    obj.value = temp;
}

function blockNonNumbers(obj, e, allowDecimal, allowNegative)
{
    var key;
    var isCtrl = false;
    var keychar;
    var reg;
    if(window.event) {
        key = e.keyCode;
        isCtrl = window.event.ctrlKey
    }
    else if(e.which) {
        key = e.which;
        isCtrl = e.ctrlKey;
    }

    if (isNaN(key)) return true;

    keychar = String.fromCharCode(key);

    // check for backspace or delete, or if Ctrl was pressed
    if (key == 8 || isCtrl)
    {
        return true;
    }

    reg = /\d/;
    var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
    var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
    var isFirstC = allowDecimal ? keychar == ',' && obj.value.indexOf(',') == -1 : false;
    return isFirstN || isFirstD || isFirstC || reg.test(keychar);
}

function blockInvalid(obj)
{
    var temp=obj.value;
    if(temp=="-")
    {
        temp="";
    }

    if (temp.indexOf(".")==temp.length-1 && temp.indexOf(".")!=-1)
    {
        temp=temp+"00";
    }
    if (temp.indexOf(".")==0)
    {
        temp="0"+temp;
    }
    if (temp.indexOf(".")==1 && temp.indexOf("-")==0)
    {
        temp=temp.replace("-","-0") ;
    }
    if (temp.indexOf(",")==temp.length-1 && temp.indexOf(",")!=-1)
    {
        temp=temp+"00";
    }
    if (temp.indexOf(",")==0)
    {
        temp="0"+temp;
    }
    if (temp.indexOf(",")==1 && temp.indexOf("-")==0)
    {
        temp=temp.replace("-","-0") ;
    }
    temp=temp.replace(",",".") ;
    obj.value=temp;
}
// end of price text-box allow numeric and allow 2 decimal points only

//VALIDATION
function hasHtml5Validation () {
  return typeof document.createElement('input').checkValidity === 'function';
}

if (hasHtml5Validation()) {
	var btnSubmit = document.getElementById('btnSubmit');
  $('form').submit(function (e) {
	if (!this.checkValidity()) {
		e.preventDefault();
		alert("Please fill up all fields or select one option.");
		if(btnSubmit) {
			btnSubmit.disabled=false;
		}
    } else {
		if(btnSubmit) {
			btnSubmit.disabled=false;
		}
    }
  });
}


