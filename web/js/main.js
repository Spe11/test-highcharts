
function enableButton($enable) {
    if($enable) {
        $("button").prop("disabled", false);
        $("button").removeClass('disable');
    } else {
        $("button").prop("disabled", true);
        $("button").addClass('disable');
    }
}

$("#file").change(function(){
    enableButton(true);
});

enableButton(false);
