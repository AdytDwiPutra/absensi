$(function () {
    $(".material-card > .mc-btn-action").click(function () {
        var card = $(this).parent(".material-card");
        var icon = $(this).children("i");
        icon.addClass("fa-spin-fast");

        if (card.hasClass("mc-active")) {
            card.removeClass("mc-active");

            window.setTimeout(function () {
                icon.removeClass("fa-arrow-left")
                    .removeClass("fa-spin-fast")
                    .addClass("fa-bars");
            }, 800);
        } else {
            card.addClass("mc-active");

            window.setTimeout(function () {
                icon.removeClass("fa-bars")
                    .removeClass("fa-spin-fast")
                    .addClass("fa-arrow-left");
            }, 800);
        }
    });
});

var smallBreak = 800; // Your small screen breakpoint in pixels
var columns = $('.dataTable tr').length;
var rows = $('.dataTable th').length;

$(document).ready(shapeTable());
$(window).resize(function() {
    shapeTable();
});

function shapeTable() {
    if ($(window).width() < smallBreak) {
        for (i=0;i < rows; i++) {
            var maxHeight = $('.dataTable th:nth-child(' + i + ')').outerHeight();
            for (j=0; j < columns; j++) {
                if ($('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').outerHeight() > maxHeight) {
                    maxHeight = $('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').outerHeight();
                }
              	if ($('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').prop('scrollHeight') > $('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').outerHeight()) {
                    maxHeight = $('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').prop('scrollHeight');
                }
            }
            for (j=0; j < columns; j++) {
                $('.dataTable tr:nth-child(' + j + ') td:nth-child(' + i + ')').css('height',maxHeight);
                $('.dataTable th:nth-child(' + i + ')').css('height',maxHeight);
            }
        }
    } else {
        $('.dataTable td, .dataTable th').removeAttr('style');
    }
}

