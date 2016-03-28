var themes = {
    "default": "//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css",
    "darkly": "//bootswatch.com/darkly/bootstrap.min.css",
    "cerulean": "//bootswatch.com/cerulean/bootstrap.min.css",
    "cosmo": "//bootswatch.com/cosmo/bootstrap.min.css",
    "cyborg": "//bootswatch.com/cyborg/bootstrap.min.css",
    "flatly": "//bootswatch.com/flatly/bootstrap.min.css",
    "journal": "//bootswatch.com/journal/bootstrap.min.css",
    "lumen": "//bootswatch.com/lumen/bootstrap.min.css",
    "paper": "//bootswatch.com/paper/bootstrap.min.css",
    "readable": "//bootswatch.com/readable/bootstrap.min.css",
    "sandstone": "//bootswatch.com/sandstone/bootstrap.min.css",
    "simplex": "//bootswatch.com/simplex/bootstrap.min.css",
    "slate": "//bootswatch.com/slate/bootstrap.min.css",
    "spacelab": "//bootswatch.com/spacelab/bootstrap.min.css",
    "superhero": "//bootswatch.com/superhero/bootstrap.min.css",
    "yeti": "//bootswatch.com/yeti/bootstrap.min.css",
    "united": "//bootswatch.com/united/bootstrap.min.css"
}
$(function () {
    var themesheet = $('<link href="' + themes['default'] + '" rel="stylesheet" />');
    themesheet.appendTo('head');
    $('.theme-link').click(function () {
        var themeurl = themes[$(this).attr('data-theme')];
        themesheet.attr('href', themeurl);
    });
});