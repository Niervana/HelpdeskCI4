/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// custom menu active
var path = location.pathname.split("/");
var url = location.origin + "/" + path[1];
$("ul.sidebar-menu li a").each(function () {
  if ($(this).attr("href").indexOf(url) !== -1) {
    $(this)
      .parent()
      .addClass("active")
      .parent()
      .parent("li")
      .addClass("active");
  }
});
// console.log(url)

//datatables
$(document).ready(function () {
  $("#table1").DataTable({
    pageLength: 10, // Atur jumlah baris per halaman, misal 10 baris
    paginate: true, // Aktifkan fitur pagination
    paging: true,
    emptyRows: true,
    language: {
      emptyTable: "Data tidak ditemukan", // Pesan jika hasil pencarian kosong
      zeroRecords: "Tidak ada data yang sesuai dengan pencarian Anda", // Pesan jika hasil pencarian tidak ditemukan
    },
    searching: true,
  });
});

// modal confirmation
function submitDel(id) {
  $("#del-" + id).submit();
}

function returnLogout() {
  var link = $("#logout").attr("href");
  $(location).attr("href", link);
}
//datatables example
$(document).ready(function () {
  var table = $("#example").DataTable({
    responsive: true,
    dom:
      "<'row'<'col-6'l><'col-6'f><'col-3'B>>" +
      "<'row'<'col-12'tr>>" +
      "<'row'<'col-6'i><'col-6'p>>",
    buttons: [
      {
        extend: "print",
        exportOptions: {
          columns: ":visible:not(.no-export)", // Hanya kolom yang terlihat dan bukan kolom dengan kelas "no-export" yang akan di-print
        },
        className: "btn btn-danger mr-2",
        text: '<i class="fa fa-file-pdf-o"></i> Print',
      },
      {
        extend: "excelHtml5",
        exportOptions: {
          columns: ":visible:not(.no-export)", // Hanya kolom yang terlihat dan bukan kolom dengan kelas "no-export" yang akan di-export ke Excel
        },
        className: "btn btn-success",
        text: '<i class="fa fa-file-excel-o"></i> Excel',
      },
    ],
    columnDefs: [
      {
        targets: [14, 15],
        className: "no-export",
      },
    ],
  });
  $(".toggle-column").on("click", function () {
    var column = table.column($(this).data("column"));
    column.visible(!column.visible());
  });
});
//funtion show/hide categories
$(document).ready(function () {
  $(".dropdown-item").click(function () {
    $(this).toggleClass(
      "active"
    ); /* Tambahkan atau hapus kelas 'active' saat item diklik */
  });
});
