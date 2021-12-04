function createCookie(name,value,minutes) {
    if (minutes) {
        var date = new Date();
        date.setTime(date.getTime()+(minutes*60*1000));
        var expires = "; expires="+date.toGMTString();
    } else {
        var expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}


function CallMethod(url, successCallback) {

    // checking cookies to not calling the script every time the page refreshed..
    if (typeof Cookies.get('five_min') === 'undefined'){
        $.ajax({
            type: 'GET',
            url: url,
            contentType: 'application/json;',
            dataType: 'json',
            success: successCallback,
            error: function(xhr, textStatus, errorThrown) {
                console.log('error');
            }
        });

        Cookies.set('five_min', 'yes', { expires: 5 / 1440, path: '/' });
    } else {
        //
    }
    
    
}


function onSuccess(param) {
    if(param == 1 )
    {
        alert("There is a suggestion for upcoming event, please check the Events page.")
    }else{
        // alert("not");
    }
}

(function(){
    // do some stuff
    CallMethod(getAPI_URL_Event(), onSuccess);
    
    setTimeout(arguments.callee, 1000*60*5);
})();


