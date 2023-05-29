/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// custom menu active
var path = location.pathname.split('/')
var url = location.origin + '/' + path[1]
$('ul.sidebar-menu li a').each(function() {
    if($(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parent().parent('li').addClass('active')
    }
})
// console.log(url)

//datatables
$(document).ready( function () {
    $('#table1').DataTable({
        "pageLength": 10, // Atur jumlah baris per halaman, misal 10 baris
        "paginate":true, // Aktifkan fitur pagination
        "paging":true,
        "emptyRows":true,
        "language": {
            "emptyTable": "Data tidak ditemukan", // Pesan jika hasil pencarian kosong
            "zeroRecords": "Tidak ada data yang sesuai dengan pencarian Anda" // Pesan jika hasil pencarian tidak ditemukan
        },
        "searching": true,
    });   
});
 
// modal confirmation
function submitDel(id) {
    $('#del-'+id).submit()
}

function returnLogout() {
    var link = $('#logout').attr('href')
    $(location).attr('href', link)
}


// function summernote(){
// $(document).ready(function() {
//   $('#summernote').summernote();
// });
// }
