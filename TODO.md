# TODO: Update Ticketing PDF Print Filter Display

## Tasks

- [x] Update `app/Views/ticketing/v_print_tiket.php` to display comprehensive filter information including date filter, jenis filter, and custom date range below the title "Data Ticket IT"

## Details

- Modify the `.filter-info` div to show:
  - Date filter description (today, week, month, all, or custom range)
  - Jenis filter description if not 'all'
  - Custom date range when applicable

## Followup

- Test PDF print functionality to verify filter information displays correctly

---

# TODO: Inventory PDF Print Improvements

## Tasks

- [x] Modify the PDF print view for inventory to use A4 landscape orientation, increase font sizes, and remove vertical text rotation to improve readability.
- [x] Update the table layout to ensure data fits properly without truncation or overflow.
- [x] Add header and footer to the PDF for better presentation.
- [x] Create separate print buttons for Main Device and Support Device to avoid table truncation due to large data.
- [x] Add new routes for print-main and print-support.
- [x] Create new view files v_print_inventory_main.php and v_print_inventory_support.php.
- [x] Update controller with printMain() and printSupport() methods.
- [x] Update inventory view to use dropdown for print options.
- [x] Remove the original print() function and route, keeping only print-main and print-support.
- [x] Update column header colors: Main Device PDF (blue) and Support Device PDF (green).

## Details

- Created separate PDF views for main device and support device data to prevent table truncation.
- Added dropdown menu in inventory view for print options.
- Main device PDF includes: Nama, Departemen, Manufaktur, Jenis, CPU, RAM, OS, Lic.Win, Storage, Office, Lic.Off, IP Address, Hostname, Credential.
- Support device PDF includes: Nama, Departemen, Monitor, Keyboard, Mouse, USB Conv, Ext.Storage, Printer, Scanner.

## Followup

- Test PDF generation for both main and support device prints to ensure proper layout and data display.
