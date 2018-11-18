function SmoothlyMenu() {
  if (!$('body').hasClass('mini-navbar') || $('body').hasClass('body-small')) {
    $('#side-menu').hide();
    setTimeout(
      function () {
        $('#side-menu').fadeIn(400);
      }, 200);
  } else if ($('body').hasClass('fixed-sidebar')) {
    $('#side-menu').hide();
    setTimeout(
      function () {
        $('#side-menu').fadeIn(400);
      }, 100);
  } else {
    $('#side-menu').removeAttr('style');
  }
}

function fix_height() {
  var heightWithoutNavbar = $("body > #wrapper").height() - 61;
  $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");

  var navbarHeigh = $('nav.navbar-default').height();
  var wrapperHeigh = $('#page-wrapper').height();

  if (navbarHeigh > wrapperHeigh) {
    $('#page-wrapper').css("min-height", navbarHeigh + "px");
  }

  if (navbarHeigh < wrapperHeigh) {
    $('#page-wrapper').css("min-height", $(window).height() + "px");
  }

  if ($('body').hasClass('fixed-nav')) {
    if (navbarHeigh > wrapperHeigh) {
      $('#page-wrapper').css("min-height", navbarHeigh - 60 + "px");
    } else {
      $('#page-wrapper').css("min-height", $(window).height() - 60 + "px");
    }
  }
}

$(document).ready(function () {

  if ($(this).width() < 769) {
    $('body').addClass('body-small fixed-sidebar fixed-nav');
    $('#navBarTop').removeClass().addClass('navbar navbar-fixed-top');
  } else {
    $('#navBarTop').removeClass().addClass('navbar navbar-static-top m-b-none');
  }

  $('#side-menu').metisMenu();

  $('.collapse-link').click(function () {
    var ibox = $(this).closest('div.ibox');
    var button = $(this).find('i');
    var content = ibox.find('div.ibox-content');
    content.slideToggle(200);
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    ibox.toggleClass('').toggleClass('border-bottom');
    setTimeout(function () {
      ibox.resize();
      ibox.find('[id^=map-]').resize();
    }, 50);
  });

  $('.close-link').click(function () {
    var content = $(this).closest('div.ibox');
    content.remove();
  });

  $('.fullscreen-link').click(function () {
    var ibox = $(this).closest('div.ibox');
    var button = $(this).find('i');
    $('body').toggleClass('fullscreen-ibox-mode');
    button.toggleClass('fa-expand').toggleClass('fa-compress');
    ibox.toggleClass('fullscreen');
    setTimeout(function () {
      $(window).trigger('resize');
    }, 100);
  });

  $('.close-canvas-menu').click(function () {
    $("body").toggleClass("mini-navbar");
    SmoothlyMenu();
  });

  $('body.canvas-menu .sidebar-collapse').slimScroll({
    height: '100%',
    railOpacity: 0.9
  });

  $('.right-sidebar-toggle').click(function () {
    $('#right-sidebar').toggleClass('sidebar-open');
  });

  $('.sidebar-container').slimScroll({
    height: '100%',
    railOpacity: 0.4,
    wheelStep: 10
  });

  $('.navbar-minimalize').click(function () {
    $("body").toggleClass("mini-navbar");
    SmoothlyMenu();
  });

  $('.modal').appendTo("body");

  fix_height();

  $(window).scroll(function () {
    if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav')) {
      $('#right-sidebar').addClass('sidebar-top');
    } else {
      $('#right-sidebar').removeClass('sidebar-top');
    }
  });

  $("[data-toggle=popover]").popover();

  $('.full-height-scroll').slimscroll({
    height: '100%'
  });

  if ($("#buildingsTable").length != 0) {
    var actionURL = $('#buildingsTable').attr('data-action');
    var columnDefs = [
      {
      "orderable": false,
      "targets": [4,5,6,7,-1]
      },
      {
        "targets": [4, 5, 6, 7],
        "visible": false
      }
    ];
    var orderColumn = [[0, "desc"]];
    var buildingsTable = $('#buildingsTable').DataTable({
      responsive: true,
      stateSave: true,
      pageLength: 25,
      processing: true,
      serverSide: true,
      order: orderColumn,
      ajax: {
        url: actionURL,
        type: 'POST'
      },
      language: dataTablesLangEsp,
      columnDefs: columnDefs
    });

    $('a.toggle-vis').on('click', function (e) {
      e.preventDefault();
      var column = buildingsTable.column($(this).attr('data-column'));
      column.visible(!column.visible());
    });

    $('#buildingsTable').on('draw.dt', function () {
      $('[data-toggle="tooltip"]').tooltip({
        html: true,
        placement: 'top',
        container: 'body'
      });
    });
  }
});

$(window).bind("resize", function () {
  if ($(this).width() < 769) {
    $('body').addClass('body-small');
  } else {
    $('body').removeClass('body-small');
  }
});

$(window).bind("load", function () {
  if ($("body").hasClass('fixed-sidebar')) {
    $('.sidebar-collapse').slimScroll({
      height: '100%',
      railOpacity: 0.9
    });
  }
});

$(window).bind("load resize scroll", function () {
  if (!$("body").hasClass('body-small')) {
    fix_height();
  }
});

if ($(".footable").length != 0) {
  var keyTable = $(".footable").attr("id");
  $(".footable").footable({
    "empty": "No hay registros...",
    "sorting": {
      "enabled": true
    },
    "paging": {
      "enabled": true,
      "countFormat": "{CP} / {TP}",
      "limit": 5,
      "size": 20
    },
    /*"state": {
        "enabled": true,
        "key": keyTable
    },*/
    "filtering": {
      "enabled": true,
      "delay": -1,
      "min": 3,
      "placeholder": "Buscador"
    }
  }).on('after.ft.paging', function (e) {
    $('[data-toggle="tooltip"]').tooltip({
      html: true,
      placement: 'top',
      container: 'body'
    });
  });

  $(".footable").keypress(function (event) {
    if (event.which == '13') {
      event.preventDefault();
      $('.fooicon-search').click();
    }
  });
}

$('[data-toggle="tooltip"]').tooltip({
  html: true,
  placement: 'top',
  container: 'body'
});
