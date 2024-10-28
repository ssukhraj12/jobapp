$(document).ready(function () {
    if ($(".side-nav").length) {
        var navCollapse = $('.side-nav li .collapse');
        var navToggle = $(".side-nav li [data-bs-toggle='collapse']");
        navToggle.on('click', function (e) {
            return false;
        });

        // open one menu at a time only
        navCollapse.on({
            'show.bs.collapse': function (event) {
                var parent = $(event.target).parents('.collapse.show');
                $('.side-nav .collapse.show').not(event.target).not(parent).collapse('hide');
            }
        });

        // activate the menu in left side bar (Vertical Menu) based on url
        $(".side-nav a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("menuitem-active");
                $(this).parent().parent().parent().addClass("show");
                $(this).parent().parent().parent().parent().addClass("menuitem-active"); // add active to li of the current link

                // var firstLevelParent = $(this).parent().parent().parent().parent();
                // if (firstLevelParent.attr('id') !== 'sidebar-menu') firstLevelParent.addClass("show");
                //
                // $(this).parent().parent().parent().parent().parent().addClass("menuitem-active");
                //
                // var secondLevelParent = $(this).parent().parent().parent().parent().parent().parent().parent();
                // if (secondLevelParent.attr('id') !== 'wrapper') secondLevelParent.addClass("show");
                //
                // var upperLevelParent = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
                // if (!upperLevelParent.is('body')) upperLevelParent.addClass("menuitem-active");
            }
        });
    }
})
