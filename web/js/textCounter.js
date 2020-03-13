function textCounter(field,field2,maxlimit)
{
    var countfield = document.getElementById(field2);

    // if ( field.value.length > maxlimit ) {
    //     field.value = field.value.substring( 0, maxlimit );
    //     return false;
    // } else {
    //     // countfield.value = maxlimit - field.value.length;
    //     countfield.value = field.value.length + "/500";
    // }

    if ( field.value.length <= maxlimit ) {
        // countfield.value = maxlimit - field.value.length;
        countfield.value = field.value.length + "/500";
    } else {
        field.value = field.value.substring( 0, maxlimit );
        return false;
    }
}