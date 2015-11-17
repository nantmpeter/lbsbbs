$(function(){
    navigator.geolocation.getCurrentPosition(position);
    function position(p){
        var lat = p.coords.latitude.toString(),
            lon = p.coords.longitude.toString();
        $(".lat").val(lat.substr(0,10));
        $(".lon").val(lon.substr(0,10));
    }
});