# TODO: Tambahkan Tombol Print dan Excel untuk Data Inventory

## Langkah-langkah yang perlu dilakukan:

1. **Edit app/Views/inventory/v_inventory.php**

   - Tambahkan tombol Print dan Excel di dalam card-body, setelah tabel.
   - Tombol hanya muncul jika data inventory tidak kosong (!empty($inventory)).
   - Tombol Print: Link ke route 'inventory/print'.
   - Tombol Excel: Link ke route 'inventory/excel'.

2. **Edit app/Config/Routes.php**

   - Tambahkan route untuk 'inventory/print' -> Inventory::print.
   - Tambahkan route untuk 'inventory/excel' -> Inventory::excel.

3. **Edit app/Controllers/Inventory.php**

   - Tambahkan method print(): Generate PDF menggunakan dompdf dari data inventory.
   - Tambahkan method excel(): Export data inventory sebagai CSV file.

## Status:

- [x] Step 1: Edit v_inventory.php
- [x] Step 2: Edit Routes.php
- [x] Step 3: Edit Inventory.php
