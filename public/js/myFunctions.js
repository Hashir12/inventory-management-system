/**
 * Created by Naveed-ul-Hassan Malik on 8/26/2015.
 * This file extends basic javascript objects
 */

if (!String.prototype.insert) {
    /**
     * {JSDoc}
     *
     * The splice() method changes the content of a string by removing a range of
     * characters and/or adding new characters.
     *
     * @this {String}
     * @param {number} start Index at which to start changing the string.
     * @param {number} delCount An integer indicating the number of old chars to remove.
     * @param {string} newSubStr The String that is spliced in.
     * @return {string} A new string with the spliced substring.
     */
    String.prototype.insert = function (start, delCount, newSubStr) {
        return this.slice(0, start) + newSubStr + this.slice(start + Math.abs(delCount));
    };
}

jQuery.fn.selectRange = function (start, end) {
    if (!end) end = start;
    return this.each(function () {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};

function log(msg) {
    for (var i = 0; i < arguments.length; i++) {
        var argument = arguments[i];
        console.log(argument);
    }
}

if (!Array.isArray) {
    Array.isArray = function (arg) {
        return Object.prototype.toString.call(arg) === '[object Array]';
    };
}

Date.prototype.getTimeAbsolute = function () {
    return this.getTime() - this.getTimezoneOffset() * 60000;
};

/*
* Checks if the array contains the searchElement
* */
Array.prototype.includes = Array.prototype.includes || function (searchElement, fromIndex) {
    'use strict';
    if (!this) {
        throw new TypeError('Array.prototype.includes called on null or undefined');
    }

    if (fromIndex === undefined) {
        var i = this.length;
        while (i--) {
            if (this[i] === searchElement) {
                return true
            }
        }
    } else {
        var i = fromIndex, len = this.length;
        while (i++ !== len) { // Addittion on hardware will perform as fast as, if not faster than subtraction
            if (this[i] === searchElement) {
                return true
            }
        }
    }
    return false;
};

/*
* Returns the intersection of the array with the given array
* */
Array.prototype.intersect = Array.prototype.intersect || function (arr) {
    var arr1 = this;
    return arr1.filter(function (elem) {
        return arr.includes(elem);
    });
};

/*
* Returns the union of the array with the given array
* */
Array.prototype.union = Array.prototype.union || function (arr) {
    var arr1 = this;
    var unique = arr.filter(function (elem) {
        return !arr1.includes(elem);
    });
    return arr1.concat(unique);
};

Array.prototype.addSetMember = Array.prototype.addSetMember || function (member) {
    if (!this.includes(member)) {
        this.push(member);
    }
};

/* updates existing or adds a new element */
Array.prototype.upsert = Array.prototype.upsert || function (item, idField) {
    var existing = this.findOne(function (i) {
        return i[idField] == item[idField];
    });

    if (!existing) {
        this.push(item);
        return;
    }

    for (var prop in item) {
        existing[prop] = item[prop];
    }
};

/*
* [{id:1, label:'label1'},{id:2, label:'label2'}].orderBy('id', 'desc')
* */
Array.prototype.orderBy = Array.prototype.orderBy || function (field, sortType) {
    var arr = this;
    var asc = sortType == 'asc';
    // sort ascending
    arr = _.sortBy(arr, function (message) {
        return message[field];
    });

    // sort descending
    if (!asc) {
        arr = arr.reverse();
    }

    return arr;
};

/*
* discards out any duplicate values in an array
* if the indexOf value for current item is same as the index, it means the element has been encountered first time, so it can be considered unique
* */
Array.prototype.uniqueValues = Array.prototype.uniqueValues || function () {
    var arr = this;
    return arr.filter(function (item, pos) {
        return arr.indexOf(item) == pos;
    });
};

/*
* Plucks an array of specific field from an array of objects
* [{id:1, label:'label1'},{id:2, label:'label2'}].pluck('label') returns
* ['label1','label2']
* */
Array.prototype.pluck = function (field) {
    var output = [];
    this.forEach(function (obj) {
        output.push(obj[field]);
    });
    return output;
};

String.prototype.capitalize = function () {
    return this.replace(
        /\w\S*/g,
        function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}
    );
};

Number.prototype.isBetween = function (min, max, notInclusive) {
    if( notInclusive ){
        return this > min && this < max;
    }
    return this >= min && this <= max;
};

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(searchElement, fromIndex) {
        var k;

        if (this == null) {
            throw new TypeError('"this" is null or not defined');
        }

        var O = Object(this);

        var len = O.length >>> 0;

        if (len === 0) {
            return -1;
        }

        var n = +fromIndex || 0;

        if (Math.abs(n) === Infinity) {
            n = 0;
        }

        if (n >= len) {
            return -1;
        }

        k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);

        while (k < len) {
            if (k in O && O[k] === searchElement) {
                return k;
            }
            k++;
        }
        return -1;
    };
}

if(!Array.prototype.remove){
    Array.prototype.remove = function (value) {
        var index = this.indexOf(value);
        if (index != -1) this.splice(index, 1);
    };
}

if(!Array.prototype.removeWhere){
    Array.prototype.removeWhere = function (callback) {
        var items = this.filter(callback);
        for( var $i = 0; $i < items.length; $i ++ ){
            this.remove(items[$i]);
        }
    };
}

if (!Array.prototype.filter) {
    Array.prototype.filter = function(fun/*, thisArg*/) {
        'use strict';

        if (this === void 0 || this === null) {
            throw new TypeError();
        }

        var t = Object(this);
        var len = t.length >>> 0;
        if (typeof fun !== 'function') {
            throw new TypeError();
        }

        var res = [];
        var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
        for (var i = 0; i < len; i++) {
            if (i in t) {
                var val = t[i];

                // NOTE: Technically this should Object.defineProperty at
                //       the next index, as push can be affected by
                //       properties on Object.prototype and Array.prototype.
                //       But that method's new, and collisions should be
                //       rare, so use the more-compatible alternative.
                if (fun.call(thisArg, val, i, t)) {
                    res.push(val);
                }
            }
        }

        return res;
    };
}

if (!Array.prototype.forEach) {

    Array.prototype.forEach = function (callback, thisArg) {

        var T, k;

        if (this == null) {
            throw new TypeError(' this is null or not defined');
        }

        // 1. Let O be the result of calling toObject() passing the
        // |this| value as the argument.
        var O = Object(this);

        // 2. Let lenValue be the result of calling the Get() internal
        // method of O with the argument "length".
        // 3. Let len be toUint32(lenValue).
        var len = O.length >>> 0;

        // 4. If isCallable(callback) is false, throw a TypeError
        exception. // See: http://es5.github.com/#x9.11
            if(typeof callback !== "function")
        {
            throw new TypeError(callback + ' is not a function');
        }

        // 5. If thisArg was supplied, let T be thisArg; else let
        // T be undefined.
        if (arguments.length > 1) {
            T = thisArg;
        }

        // 6. Let k be 0
        k = 0;

        // 7. Repeat, while k < len
        while (k < len) {

            var kValue;

            // a. Let Pk be ToString(k).
            //    This is implicit for LHS operands of the in operator
            // b. Let kPresent be the result of calling the HasProperty
            //    internal method of O with argument Pk.
            //    This step can be combined with c
            // c. If kPresent is true, then
            if (k in O) {

                // i. Let kValue be the result of calling the Get internal
                // method of O with argument Pk.
                kValue = O[k];

                // ii. Call the Call internal method of callback with T as
                // the this value and argument list containing kValue, k, and O.
                callback.call(T, kValue, k, O);
            }
            // d. Increase k by 1.
            k++;
        }
        // 8. return undefined
    };
}


Array.prototype.findOne = function (callback) {
    var result = this.filter(callback);
    if( result.length > 0 ) return result[0];
    return null;
};

Array.prototype.hasItem = function (item) {
    return this.indexOf(item) !== -1;
};

Array.prototype.countWhere = function (callback) {
    return this.filter(callback).length;
};

/*
* Get date or datetime from a string like:
* '2016-05-01 12:48:59' or '2016-05-01'
* */
Date.fromStr = function (dateStr) {
    var dateTime = dateStr.split(" ");
    var datePart = dateTime[0];
    var dateArr = datePart.split("-");
    var y = parseInt(dateArr[0]);
    var m = parseInt(dateArr[1]) - 1;
    var d = parseInt(dateArr[2]);
    var h = 0, min = 0, s = 0;
    if( dateTime.length > 1 ) {
        var timePart = dateTime[1];
        var timeArr = timePart.split(":");
        h = parseInt(timeArr[0]);
        min = parseInt(timeArr[1]);
        s = parseInt(timeArr[2]);
        return new Date(y, m, d, h, min, s);
    }
    return new Date(y, m, d);

};

Date.prototype.mySqlFormat = function () {
    var dd = this.getDate();
    var mm = this.getMonth()+1; //January is 0!
    var yyyy = this.getFullYear();

    if(dd<10) dd='0'+dd;
    if(mm<10) mm='0'+mm;

    return yyyy+'-'+mm+'-'+dd;
};

Date.prototype.isFutureDate = function () {
    var diff = this - new Date( Date.now() + 5*60*60*1000 );
    return diff > 0;
};

Date.monthsList = function (objects) {
    if(objects)
        return [{id: 1, month: 'January'}, {id: 2, month: 'February'}, {id: 3, month: 'March'}, {id: 4, month: 'April'}, {id: 5, month: 'May'}, {id: 6, month: 'June'}, {id: 7, month: 'July'}, {id: 8, month: 'August'}, {id: 9, month: 'September'}, {id: 10, month: 'October'}, {id: 11, month: 'November'}, {id: 12, month: 'December'}];
    return ['January','February','March','April','May','June', 'July','August','September','October','November','December'];
};

if (!Array.from) {
    Array.from = (function () {
        var toStr = Object.prototype.toString;
        var isCallable = function (fn) {
            return typeof fn === 'function' || toStr.call(fn) === '[object Function]';
        };
        var toInteger = function (value) {
            var number = Number(value);
            if (isNaN(number)) {
                return 0;
            }
            if (number === 0 || !isFinite(number)) {
                return number;
            }
            return (number > 0 ? 1 : -1) * Math.floor(Math.abs(number));
        };
        var maxSafeInteger = Math.pow(2, 53) - 1;
        var toLength = function (value) {
            var len = toInteger(value);
            return Math.min(Math.max(len, 0), maxSafeInteger);
        };

        // The length property of the from method is 1.
        return function from(arrayLike/*, mapFn, thisArg */) {
            // 1. Let C be the this value.
            var C = this;

            // 2. Let items be ToObject(arrayLike).
            var items = Object(arrayLike);

            // 3. ReturnIfAbrupt(items).
            if (arrayLike == null) {
                throw new TypeError("Array.from requires an array-like object - not null or undefined");
            }

            // 4. If mapfn is undefined, then let mapping be false.
            var mapFn = arguments.length > 1 ? arguments[1] : void undefined;
            var T;
            if (typeof mapFn !== 'undefined') {
                // 5. else
                // 5. a If IsCallable(mapfn) is false, throw a TypeError exception.
                if (!isCallable(mapFn)) {
                    throw new TypeError('Array.from: when provided, the second argument must be a function');
                }

                // 5. b. If thisArg was supplied, let T be thisArg; else let T be undefined.
                if (arguments.length > 2) {
                    T = arguments[2];
                }
            }

            // 10. Let lenValue be Get(items, "length").
            // 11. Let len be ToLength(lenValue).
            var len = toLength(items.length);

            // 13. If IsConstructor(C) is true, then
            // 13. a. Let A be the result of calling the [[Construct]] internal method of C with an argument list containing the single item len.
            // 14. a. Else, Let A be ArrayCreate(len).
            var A = isCallable(C) ? Object(new C(len)) : new Array(len);

            // 16. Let k be 0.
            var k = 0;
            // 17. Repeat, while k < len… (also steps a - h)
            var kValue;
            while (k < len) {
                kValue = items[k];
                if (mapFn) {
                    A[k] = typeof T === 'undefined' ? mapFn(kValue, k) : mapFn.call(T, kValue, k);
                } else {
                    A[k] = kValue;
                }
                k += 1;
            }
            // 18. Let putStatus be Put(A, "length", len, true).
            A.length = len;
            // 20. Return A.
            return A;
        };
    }());
}