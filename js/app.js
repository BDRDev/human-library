//JQuery Code for scrolling up and down

$("nav a").click(function(e) {
    let btnID = e.currentTarget.id + "Section";
    $("html, body").animate({
        scrollTop: $("#" + btnID).offset().top
    }, 700);

});