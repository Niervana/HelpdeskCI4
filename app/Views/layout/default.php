<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <?= $this->renderSection('title') ?>
    <!-- General CSS Files -->
    <!-- client side css -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- nicescroll -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <!-- certain pages -->
    <?= $this->renderSection('CSS') ?>
    <!-- data tabel -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- izitoastr -->
    <script src="<?= base_url() ?>/template/node_modules/izitoast/dist/js/iziToast.min.js"></script>

    <!-- server side css -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fonta/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/izitoast/dist/css/iziToast.min.css">
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/components.css">
</head>

<?php $currentSegment = service('request')->getUri()->getSegment(1); ?>

<body class="noselect<?= ($currentSegment !== '') ? ' sidebar-minimize' : '' ?>">
    <div id="app">
        <?= $this->renderSection('header') ?>
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                            <i class="far fa-bell"></i>
                            <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <?php if (session()->get('role') == 1): ?>
                                    <div class="float-right">
                                        <a href="#" id="markAllRead">Mark All As Read</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message" id="notificationList">
                                <div class="text-center">
                                    <small>No notifications</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block"><?= userLogin() ? userLogin()->nama_users : 'Guest' ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Hallo <?= userLogin() ? userLogin()->nama_users : 'Guest' ?></div>
                            <div class="dropdown-divider"></div>
                            <a href="<?= site_url('Auth/logout') ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href=" <?= base_url('/'); ?>" class="logo">
                            <img src="<?= base_url() ?>/lgo.png" alt="LOGO" style="width: 150px; height: 50px; object-fit: contain; object-position: center center;" srcset='' fetchpriority="high">
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href=" <?= base_url('/'); ?>" class="logo">
                            <img alt="image" src="<?= base_url() ?>/lgo.png" alt="Willbes" width="40">
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <!--disini posisi sidebar -->
                        <?= $this->include('layout/menusidebar') ?>
                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content scrollable" style="overflow: hidden; outline: none;">
                <?= $this->renderSection('content') ?>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2025 <div class="bullet"></div> Developed By <a href="#">Nirvana Rahadian</a>
                    <a href="https://instagram.com/nirvhd"><i class="fa-brands fa-instagram"></i></a>
                    <a href="mailto:kharismanirvana@gmail.com"><i class="fa-regular fa-envelope"></i></a>
                </div>
                <div class="footer-right">
                    v1.0
                </div>
            </footer>
        </div>
    </div>
    <!-- server side script -->
    <script src="<?= base_url() ?>/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url() ?>/template/node_modules/NumberFormat.js"></script>
    <!-- client side script -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
    <!-- popperjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- momentjs -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->
    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>/template/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/custom.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/stisla.js"></script>
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- General JS Scripts -->
    <script>
        $("body").niceScroll({
            cursorcolor: "#93a9b5",
            cursorwidth: "8px"
        });
        $(document).ready(function() {
            $('#table1').DataTable();
            <?php if ($currentSegment !== ''): ?>
                $('body').addClass('sidebar-minimize');
            <?php endif; ?>
        });
    </script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/template/assets/js/page/components-table.js"></script>
    <script src="<?= base_url() ?>/template/assets/js/page/bootstrap-modal.js"></script>

    <!-- table -->
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <!-- certain pages JS Scripts -->
    <?= $this->renderSection('script') ?>

    <!-- Notification Script -->
    <script>
        $(document).ready(function() {
            // Load notifications on page load
            loadNotifications();

            // Auto refresh notifications every 30 seconds
            setInterval(loadNotifications, 30000);

            // Mark all as read
            $('#markAllRead').on('click', function(e) {
                e.preventDefault();
                markAllAsRead();
            });



            // Mark single notification as read when clicked
            $(document).on('click', '.notification-item', function() {
                var notifId = $(this).data('id');
                markAsRead(notifId);
            });
        });

        function loadNotifications() {
            $.ajax({
                url: '<?= base_url('api/notifications') ?>',
                type: 'GET',
                success: function(response) {
                    updateNotificationUI(response);
                },
                error: function() {
                    console.log('Error loading notifications');
                }
            });
        }

        function updateNotificationUI(data) {
            var badge = $('#notificationBadge');
            var list = $('#notificationList');

            if (data.unread_count > 0) {
                badge.text(data.unread_count).show();
                $('.message-toggle').addClass('beep');
            } else {
                badge.hide();
                $('.message-toggle').removeClass('beep');
            }

            if (data.notifications && data.notifications.length > 0) {
                var html = '';
                data.notifications.forEach(function(notif) {
                    var unreadClass = notif.is_read == 0 ? 'unread' : '';
                    html += '<a href="#" class="dropdown-item dropdown-item-unread notification-item ' + unreadClass + '" data-id="' + notif.id + '">' +
                        '<div class="dropdown-item-avatar">' +
                        '<img alt="image" src="<?= base_url() ?>/template/assets/img/avatar/avatar-1.png" class="rounded-circle">' +
                        '</div>' +
                        '<div class="dropdown-item-desc">' +
                        '<b>' + notif.title + '</b>' +
                        '<p>' + notif.message + '</p>' +
                        '<div class="time">' + formatTime(notif.created_at) + '</div>' +
                        '</div>' +
                        '</a>';
                });
                list.html(html);
            } else {
                list.html('<div class="text-center"><small>No notifications</small></div>');
            }
        }

        function markAsRead(id) {
            $.ajax({
                url: '<?= base_url('api/notifications/mark-read') ?>',
                type: 'POST',
                data: {
                    ids: [id]
                },
                success: function() {
                    loadNotifications();
                }
            });
        }

        function markAllAsRead() {
            $.ajax({
                url: '<?= base_url('api/notifications/mark-all-read') ?>',
                type: 'POST',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        loadNotifications();
                        console.log('All notifications marked as read');
                    } else {
                        console.error('Failed to mark all notifications as read');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error marking all notifications as read:', error);
                }
            });
        }



        function formatTime(dateString) {
            var date = new Date(dateString);
            var now = new Date();
            var diff = now - date;
            var minutes = Math.floor(diff / 60000);
            var hours = Math.floor(diff / 3600000);
            var days = Math.floor(diff / 86400000);

            if (minutes < 1) return 'Just now';
            if (minutes < 60) return minutes + ' minutes ago';
            if (hours < 24) return hours + ' hours ago';
            return days + ' days ago';
        }
    </script>
</body>

</html>