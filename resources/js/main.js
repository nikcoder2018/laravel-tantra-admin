$.noConflict();

jQuery(document).ready(function($) {
  "use strict";

  [].slice
    .call(document.querySelectorAll("select.cs-select"))
    .forEach(function(el) {
      new SelectFx(el);
    });

  jQuery(".selectpicker").selectpicker;

  $("#menuToggle").on("click", function(event) {
    $("body").toggleClass("open");
  });

  $(".search-trigger").on("click", function(event) {
    event.preventDefault();
    event.stopPropagation();
    $(".search-trigger")
      .parent(".header-left")
      .addClass("open");
  });

  $(".search-close").on("click", function(event) {
    event.preventDefault();
    event.stopPropagation();
    $(".search-trigger")
      .parent(".header-left")
      .removeClass("open");
  });

  // $('.user-area> a').on('click', function(event) {
  // 	event.preventDefault();
  // 	event.stopPropagation();
  // 	$('.user-menu').parent().removeClass('open');
  // 	$('.user-menu').parent().toggleClass('open');
  // });

  let listIndex = 0;
  let isbundle = false;
  $("#btnAddFreebie").on("click", function() {
    let itemname = $("#f-item-name").val() ? $("#f-item-name").val() : "Noname";
    let itemindex = $("#f-item-index").val();
    let itemcount = $("#f-item-count").val() ? $("#f-item-count").val() : 1;
    let itemqty = $("#f-item-qty").val() ? $("#f-item-qty").val() : 0;
    if ($("#f-isbundle").is(":checked")) {
      isbundle = true;
    } else {
      isbundle = false;
    }
    if (itemindex != "") {
      let list =
        '<li class="list-group-item" id="listIndex-' +
        listIndex +
        '" data-name="' +
        itemname +
        '" data-index="' +
        itemindex +
        '" data-count="' +
        itemcount +
        '" data-qty="' +
        itemqty +
        '" data-isbundle="' +
        isbundle +
        '">';
      if (isbundle) {
        list +=
          "Item Name: " +
          itemname +
          " Index: " +
          itemindex +
          " Count: " +
          itemcount +
          " Bundle: " +
          itemqty;
      } else {
        list +=
          "Item Name: " +
          itemname +
          " Index: " +
          itemindex +
          " Count: " +
          itemcount;
      }
      list +=
        '<button type="button" class="btn btn-danger btn-sm float-right" onclick="removeFreebie(' +
        listIndex +
        ')"><i class="fa fa-trash"></i></button></li>';
      $("#listFreebies").append(list);
      freebieInputReset();
      listIndex++;
    } else {
      $("#f-item-index").addClass("is-invalid");
    }
  });
  function freebieInputReset() {
    $("#f-item-name").val("");
    $("#f-item-index").val("");
    $("#f-item-count").val("");
    isbundle = false;
    $("#f-isbundle").prop("checked", false);
    $("#f-item-qty").hide();
  }
  $("#f-item-index").on("keypress", function() {
    $("#f-item-index").removeClass("is-invalid");
  });
  $("#f-isbundle").on("change", function() {
    if (this.checked) {
      $("#f-item-qty").fadeIn();
    } else {
      $("#f-item-qty").fadeOut();
    }
  });
  $("#form-newpackage").on("submit", function(e) {
    e.preventDefault();
    let _token = $("input[name=_token]").val();
    let name = $("input[name=packagename]").val();
    let description = $("input[name=description]").val();
    let price = $("input[name=price]").val();
    let taney = $("input[name=taney]").val();
    let list = $("#listFreebies").find("li");
    let freebies = [];

    $.each(list, function() {
      freebies.push({
        itemname: $(this).data("name"),
        itemindex: $(this).data("index"),
        itemcount: $(this).data("count"),
        itemqty: $(this).data("qty"),
        isbundle: $(this).data("isbundle")
      });
    });
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: {
        _token,
        name,
        description,
        price,
        taney,
        freebies
      },
      success: function(response) {
        if (response.type == "success") {
          console.log(response);
          $("#newPackageModal")
            .find(".alert-success")
            .show();
          $("#newPackageModal")
            .find(".alert-success")
            .html(response.msg);

          setTimeout(function() {
            $("#newPackageModal")
              .find(".alert-success")
              .hide();
            $("#newPackageModal")
              .find("form")
              .trigger("reset");
            $("#newPackageModal").modal("hide");
            location.reload();
          }, 3000);
        }
        if (response.type == "fail") {
          $("#newPackageModal")
            .find(".alert-danger")
            .show();
          $("#newPackageModal")
            .find(".alert-danger")
            .html(response.msg);
        }
      }
    });
  });
});

$("#form-addtaney").on("submit", function(e) {
  e.preventDefault();
  let _token = $(this)
    .find("input[name=_token]")
    .val();
  let userid = $(this)
    .find("select[name=userid]")
    .find(":selected")
    .val();
  let taney = $(this)
    .find("input[name=taney]")
    .val();
  $(this)
    .find("button[type=submit]")
    .html("Saving...");
  $(this)
    .find("button[type=submit]")
    .prop("disabled", true);
  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    data: {
      _token,
      userid,
      taney
    },
    success: function(response) {
      if (response.type == "success") {
        $("#addTaneyModal")
          .find(".alert-success")
          .show();
        $("#addTaneyModal")
          .find(".alert-success")
          .html(response.msg);

        setTimeout(function() {
          $("#addTaneyModal")
            .find("button[type=submit]")
            .html("Save");
          $("#addTaneyModal")
            .find("button[type=submit]")
            .prop("disabled", false);
          $("#addTaneyModal")
            .find(".alert-success")
            .hide();
          $("#addTaneyModal")
            .find("form")
            .trigger("reset");
          $("#addTaneyModal").modal("hide");
          location.reload();
        }, 3000);
      }
      if (response.type == "fail") {
        $("#addTaneyModal")
          .find("button[type=submit]")
          .html("Save");
        $("#addTaneyModal")
          .find("button[type=submit]")
          .prop("disabled", false);

        $("#addTaneyModal")
          .find(".alert-danger")
          .show();
        $("#addTaneyModal")
          .find(".alert-danger")
          .html(response.msg);
      }
    }
  });
});

$("#form-removetaney").on("submit", function(e) {
  e.preventDefault();
  let _token = $(this)
    .find("input[name=_token]")
    .val();
  let userid = $(this)
    .find("select[name=userid]")
    .find(":selected")
    .val();
  let taney = $(this)
    .find("input[name=taney]")
    .val();
  $(this)
    .find("button[type=submit]")
    .html("Saving...");
  $(this)
    .find("button[type=submit]")
    .prop("disabled", true);
  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    data: {
      _token,
      userid,
      taney
    },
    success: function(response) {
      if (response.type == "success") {
        $("#removeTaneyModal")
          .find(".alert-success")
          .show();
        $("#removeTaneyModal")
          .find(".alert-success")
          .html(response.msg);

        setTimeout(function() {
          $("#removeTaneyModal")
            .find("button[type=submit]")
            .html("Save");
          $("#removeTaneyModal")
            .find("button[type=submit]")
            .prop("disabled", false);
          $("#removeTaneyModal")
            .find(".alert-success")
            .hide();
          $("#removeTaneyModal")
            .find("form")
            .trigger("reset");
          $("#removeTaneyModal").modal("hide");
          location.reload();
        }, 3000);
      }
      if (response.type == "fail") {
        $("#removeTaneyModal")
          .find("button[type=submit]")
          .html("Save");
        $("#removeTaneyModal")
          .find("button[type=submit]")
          .prop("disabled", false);

        $("#removeTaneyModal")
          .find(".alert-danger")
          .show();
        $("#removeTaneyModal")
          .find(".alert-danger")
          .html(response.msg);
      }
    }
  });
});
window.removeFreebie = function(index) {
  $("#listFreebies")
    .find("#listIndex-" + index)
    .remove();
};
window.showFreebies = function(package_id, package_name) {
  let showFreebiesModal = $("#showFreebiesModal");
  showFreebiesModal.find("#listFreebies").empty();
  showFreebiesModal.find("h3").remove();
  showFreebiesModal.modal("toggle");
  $.ajax({
    url: APP_URL + "/api/packages/" + package_id + "/freebies",
    type: "GET",
    success: function(response) {
      showFreebiesModal.find(".modal-title").html(response.package.name);
      if (!$.isEmptyObject(response.freebies)) {
        $.each(response.freebies, function(i, item) {
          let list = '<li class="list-group-item">';
          if (item.isBundle == "1") {
            list +=
              "Item Name: " +
              item.ItemName +
              " Index: " +
              item.ItemIndex +
              " Count: " +
              item.ItemCount +
              " Bundle: " +
              item.QtyPerBundle;
          } else {
            list +=
              "Item Name: " +
              item.ItemName +
              " Index: " +
              item.ItemIndex +
              " Count: " +
              item.ItemCount;
          }
          list += "</li>";
          showFreebiesModal.find("#listFreebies").append(list);
        });
      } else {
        showFreebiesModal
          .find(".modal-body")
          .append("<h3>This packages has no freebies..</h3>");
      }
    }
  });
};

window.archivePackage = function(id) {
  swal({
    title: "Are you sure?",
    text: "Package will be moved to archive list.",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then(willDelete => {
    if (willDelete) {
      $.ajax({
        url: APP_URL + "/topup/packages/archive/" + id,
        type: "GET",
        data: {
          id
        },
        success: function(response) {
          swal(response.msg, {
            icon: "success"
          }).then(value => {
            location.reload();
          });
        }
      });
    } else {
      swal("Your package is safe!");
    }
  });
};
window.undoPackage = function(id) {
  swal({
    title: "Are you sure?",
    text: "Package will be moved back to packages list.",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then(willDelete => {
    if (willDelete) {
      $.ajax({
        url: APP_URL + "/topup/packages/undo/" + id,
        type: "GET",
        data: {
          id
        },
        success: function(response) {
          swal(response.msg, {
            icon: "success"
          }).then(value => {
            location.reload();
          });
        }
      });
    }
  });
};
