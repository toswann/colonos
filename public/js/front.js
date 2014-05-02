$(function() {
    $.i18n.init({
        lng: "es",
        resGetPath: '/public/locales/front/__lng__/__ns__.json'
    }).done(function() {
        window.lang = "es";
        $("body").i18n();

        $(".flag").click(function() {
            var newlang = $(this).attr("data-lang");
            console.log(newlang);
            if (newlang != window.lang) {
                $.i18n.setLng(newlang, function(t) {
                    $("body").i18n();
                    window.lang = newlang;
                });
            }
        });
    });
});