# TODO: Fix Log Display for Deleted Inventory

## Steps to Complete

- [ ] Create a new migration to add 'nama_karyawan' VARCHAR column to log table.
- [ ] Update LogModel to include 'nama_karyawan' in allowedFields.
- [ ] Update Inventory.php: in log() method, change query to select from log, join only users, and select log.nama_karyawan.
- [ ] In logging methods (insert, update, delete), add 'nama_karyawan' to logData.
- [ ] Change action_type to 'DELETE' in delete method.
- [ ] Update v_log.php to use $log['nama_karyawan'] instead of $log['nama_karyawan'] (already correct).
- [ ] Test by deleting an inventory and checking if log remains with 'DELETE' action.
