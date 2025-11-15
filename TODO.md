# TODO List for Developing Two-Sided Application (Admin & User)

## Migration & Database

- [x] Create migration to alter users table add role field (INT, default 2)
- [x] Update UserSeeder to add role=1 for existing admin users

## Views Modifications

- [x] Modify app/Views/auth/register.php: Merge nama_users and nama_karyawan into single 'nama' field, add departemen_karyawan field, set role hidden=2
- [x] Add link to register page in app/Views/auth/login.php
- [x] Modify app/Views/layout/menusidebar.php: Make menu conditional based on user role (admin: all menus, user: Dashboard & Ticket)
- [x] Clean up unused code in app/Views/v_home.php (remove commented sections)

## Controllers & Models

- [x] Update app/Models/UsersModel.php: Add allowedFields including 'role'
- [x] Modify app/Controllers/Auth.php: Uncomment and activate register method, update insertdata to insert to users (plain password for role=2) and karyawan, update loginProcess to handle plain/hash passwords based on role

## Testing

- [ ] Test register functionality
- [ ] Test login as user and admin
- [ ] Verify menu display based on role
- [ ] Verify auto-insert to karyawan table
