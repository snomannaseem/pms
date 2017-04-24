var isScrLock2 = false;
function mainAjax(frm_id, request_data, method_type, fn, complete_callback) {

    $('.msg').hide();
    if (!method_type) {
        method_type = 'GET';
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    status = 'error';

    $.ajax({
        type: method_type,
        url: pageURI,
        data: request_data,
        dataType: 'json',
        timeout: 0,
        beforeSend: function () {
        

            preloaderToggleSrcLock();
            $('.msg_ok , .msg_error').hide();
        },
        complete: function () {

           // toggleSrcLock();
            preloaderToggleSrcLock();
            if(typeof(complete_callback) == "function")
            {
                complete_callback();
            }
        },
        success: function (response, textStatus, jqXHR) {

            status = 'error';
            msg = 'Invalid response from server. Please contact CentricSource.';
            key = '';
            response_data = null;
            if (typeof(jqXHR) == 'object') {
                data = jQuery.parseJSON(jqXHR.responseText);

                if (typeof(data.code) != 'undefined') {
                    status = data.status;
                    msg = data.msg;
                    key = data.key;
                    response_data = data;
                    if (data.code == 200) {

                        response_data = data;
                        hideSucessDiv();
                    }
                    if (data.code == 301) {
                        if(msg=="Unauthorized"){                            
                            // popup_session('Error','Session Expired, taking you to login page again.',function(){window.location = data.url;});
                            popup("session_expire",350);
                            $("#session_expire").dialog("open");
                            window.location = data.url;
                            return false;
                        }

                        window.location = data.url;
                    }
                }

            }

            // Display message.
            remove_msg_class = 'success';
			status_class = 'danger';
			
            if (status == 'ok') {remove_msg_class = 'danger';status_class = 'success';}
			console.log(status_class,status);
            if ( (msg != "") && (typeof(msg)!='undefined')) {
                $('#' + "msg_" + frm_id).removeClass('alert alert-' + remove_msg_class ).addClass('alert alert-' + status_class).css('display', 'block').html(getFormatedMessages(msg)).delay(3000).fadeOut();
            }

            if (fn)  fn(response_data);

        },

        error: function (jqXHR, textStatus, errorThrown) {

            remove_msg_class = 'ok';
            msg = 'Invalid response from server. Please contact CentricSource.';
            key = '';

            if (textStatus === "timeout") msg = 'Connection Timeout, Please retry.';

            $('#' + "msg_" + frm_id).removeClass('msg_' + remove_msg_class).addClass('msg_' + status).css('display', 'block').html(getFormatedMessages(msg));

        }
    });
}

function toggleSrcLock() {
    if(isScrLock) {
        isScrLock = false;
        $('.loader').hide();
        return;
    }
    isScrLock = true;
    $('.loader').show();
}

function preloaderToggleSrcLock() {

    if(isScrLock2) {
        isScrLock2 = false;
        $('.preloader').hide();
        return;
    }
    isScrLock2 = true;
    $('.preloader').show();
}

// Messages
function getFormatedMessages(msg){
    if(msg){
        all_mass =  msg.split("|");
        var err = "<ul>";
        for(i=0;i<all_mass.length;i++){
            if(all_mass[i]) {
                err += "<li>" + all_mass[i] + "</li>";
            }
        }
        err+="</ul>";
        return err;
    }
}


// Function for login with "Enter" key.
function submit_key(pass_fld, login_btn){
    $('#'+pass_fld).keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#'+login_btn).trigger('click');
        }
    });
}

function set_focus_submit(pass_fld, login_btn){
    $('#'+pass_fld).focus();
    //setTimeout(function() { $("#"+pass_fld).focus(); },2000);
    /*
    $('#'+pass_fld).keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            $('#'+login_btn).trigger('click');
        }
    });
    */
}

function goToByScroll(id){
    // Remove "link" from the ID
    // id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
            scrollTop: $("#"+id).offset().top},
        1000);
}

window.mobileAndTabletcheck = function() {
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
}

function disable(ele){
    $(ele).attr('disabled', true);
};

function enable(ele) {
    $(ele).removeAttr('disabled');
};

function popWnd(title,details, ok_callback) {
    $('#dialog').html('').append(details);
    create_pop('dialog', title, ok_callback);
}

/* Dialog Box Wrapper */
create_pop = function(id, title, ok_callback){
    $( "#"+id ).dialog({
        title: title, modal: true,
        buttons: {
            Ok: function() {
                $( this ).dialog( "close" );
                if(typeof (ok_callback) == 'function')
                {
                    ok_callback();
                }
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }/*,open: function(event, ui) {
         setTimeout(function(){
         $('#dialog').dialog('close');
         }, 4000);
         }*/
    });
}

//
function nullCheck(temp, specificvalue){

    if(typeof(specificvalue)==='undefined') specificvalue = false;
    if(temp == null || temp == ''){

        if(specificvalue){
            return '0';
        }

        return "-";
    }
    return temp;
}

/* to convert date format as per given [mm/dd/yyyy] */
function changeDateFormat(val){

    if(val !="" && val != '0000-00-00'){

        var d  = new Date(val.split("-").join("/"));
        var day = d.getDate();
        if(day < 10){
            day = "0"+day;
        }
        var month = d.getMonth()+1;
        if(month < 10){
            month = "0"+month;
        }
        return month+"/"+day+"/"+d.getFullYear();
    }
    return "NA";
}

//1-Dec-2015
function changeDateFormatOther(date){

    if (date == null) {
        return;
    }
    var monthNames = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var currentdate = new Date(date);
    var date_format = currentdate.getDate()+ "-" + (monthNames[currentdate.getMonth()]) + "-" +currentdate.getFullYear();
    return date_format;
}


function _eg_formatDateTime(datetime_val, show_time, show_time_clock_icon) {


    /* Return if date is null */
    if(typeof(datetime_val)==='undefined') return "-";

    datetime_val = $.trim(datetime_val);
    if(datetime_val == '') return "-";

    if(typeof(show_time)==='undefined') show_time = false;
    if(typeof(show_time_clock_icon)==='undefined') show_time_clock_icon = false;

    datetime = datetime_val.split(" ");

    datesplit = datetime[0];
    timesplit = datetime[1];

    if(show_time){
        if(show_time_clock_icon){
            /* Return date time with clock icon. */
            return changeDateFormat(datesplit)+'<span class="fa fa-clock-o"></span>'+timesplit;
        }
        /* Return only date time. */
        return changeDateFormat(datesplit)+' '+timesplit;
    }
    /* Return only date. */
    return changeDateFormat(datesplit);
}

/*This function is use to change the daterange selection format to mysql format*/
function convert_date(date) {
    if (date == null) {
        return;
    }
    var month_list = "JanFebMarAprMayJunJulAugSepOctNovDec";
    var currentdate = new Date(date);
    var date_format = currentdate.getFullYear()+ "-" + (currentdate.getMonth() + 1) + "-" +currentdate.getDate();
    return date_format;
}
function stripHTML(oldString) {
    var result = oldString.replace(/(<([^>]+)>)|\n/ig, " ");
    result = result.replace(/\s+/ig, " ");
    return result;
}
function toTitleCase(str){
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
function popup_gen(content, type, call_back){


    $("#dialog-confirm").html(content);

    // Define the Dialog and its properties.
    $("#dialog-confirm").dialog({
        resizable: false,
        modal: true,
        title: "Confirmation Message",
        height: 200,
        width: 300,
        buttons: {
            Ok: function () {
                call_confirm(call_back);
                $(this).dialog("close");
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }

    });
};

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function getBookmarkfromURL() {
    var hash = window.location.hash.substring(1);
    return hash;
}

function nullCheck(temp, specificvalue){

    if(typeof(specificvalue)==='undefined') specificvalue = false;
    if(temp === null || temp === ''){

        if(specificvalue){
            return '0';
        }

        return "-";
    }
    return temp;
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}




        

function textWrap(txt, size){
    
    size += 4;
    if(txt == null){
        return;
    }

    txt = jQuery.trim(txt);
    if(txt.length > size){
        
        var txt_ret = jQuery.trim(txt).substring(0, size);
        return txt_ret+'...';
    }
    return txt;

}
function hideSucessDiv(){
    setTimeout(function() {
        try {
            $(".msg_ok").hide('blind', {}, 500)
        }
        catch($e)
        {

        }
    }, 5000);
}